<?php

namespace App\Controllers;
use App\Models\Kecamatan_model;
use App\Models\Pesanan_model;
use App\Models\Auth_model;
use App\Models\Barang_model;
use CodeIgniter\I18n\Time;

class Kurir extends BaseController
{
	protected $helpers = [];
 
    public function __construct()
    {
        helper(['form']);
        $this->kecamatan_model = new Kecamatan_model();
        $this->pesanan_model = new Pesanan_model();
        $this->user_model = new Auth_model();
        $this->barang_model = new Barang_model();
    }

	public function index()
	{
        $id = $_SESSION['id'];

        // $curr_date = Time::today('Asia/Makassar')->toLocalizedString('Y-m-d');
        $myTime = Time::today('Asia/Makassar');

        // $curr_date = $date->format('Y-m-d');

        $data['kurir'] = $this->user_model->getUser($id);
		$data['jemput'] = $this->pesanan_model
                                ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
                                ->where('pesanan_status', 'Jemput')
                                ->findAll();
        $data['antar'] = $this->pesanan_model
                                ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
                                ->where('pesanan_status', 'On Process')
                                ->where('kurir_id', $id)
                                ->orGroupStart()
                                    ->where('pesanan_status', 'Sukses')
                                    ->where('DATE(created_at)', $myTime)
                                    ->where('kurir_id', $id)
                                ->groupEnd()
                                ->findAll();
        
        $data['title'] = 'Dashboard';

        // dd($data);

		return view('kurir/new_index', $data);
	}

    public function show($id)
    {  
        $data['pesanan'] = $this->pesanan_model->getPesanan($id);
        $data['title'] = "Pesanan Detail";
        // dd($data);
        echo view('kurir/p_show', $data);
    }

    public function proses($id)
    {
        $kurir = $_SESSION['id'];  
        $data['barang'] = $this->barang_model->join('kecamatan', 'kecamatan.kecamatan_id = barang.kecamatan_id')
                                ->where('pesanan_id', $id)->findAll();
        $data['kecamatan'] = $this->kecamatan_model->getKecamatan();
        $data['pesanan'] = $this->pesanan_model->getPesanan($id);
        $data['kurir'] = $this->user_model->getUser($kurir);

        $data['date'] = Time::today('Asia/Makassar')->toLocalizedString('d/MMM/yyyy');

        $data['title'] = 'Proses';
        // dd($data);
        echo view('kurir/proses', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('pesanan_id');
    
        $data = array(
            'pesanan_status' => $this->request->getPost('pesanan_status'),
            'kurir_id' => $this->request->getPost('pesanan_kurir'),
        );
        
        if($data){
            $simpan = $this->pesanan_model->updatePesanan($data, $id);
            if($simpan){
                session()->setFlashdata('success', 'Pesanan Dijemput');
                return redirect()->to(base_url('/kurir'));
            } else{
                session()->setFlashdata('errors', 'Tidak Terproses bung');
            }
        }
    }

    public function store()
    {
        $id = $_SESSION['id'];
        // echo $id;
        $role = $this->user_model->getUser($id)['role'];

        $pesanan_id = $this->request->getPost('pesanan_id');
        $barang_kode = $this->request->getPost('barang_kode') . $this->request->getPost('kode');
        
        $ongkir = str_replace('.', '',$this->request->getPost('barang_ongkir'));
        $harga = str_replace('.', '',$this->request->getPost('barang_harga'));

        $data = array(
            'pesanan_id' => $this->request->getPost('pesanan_id'),
            'barang_kode' => $barang_kode,
            'barang_name' => $this->request->getPost('barang_name'),
            'barang_harga' => $harga,
            'barang_status' => 'Terjemput',
            'barang_ongkir' => $ongkir,
            'kecamatan_id' => $this->request->getPost('kecamatan_id'),
        );

        // dd($data);

        $validation =  \Config\Services::validation();
        if($validation->run($data, 'barang') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());

            if($role == 'Kurir'){
                return redirect()->to(base_url('/kurir/pesanan/proses/'.$pesanan_id));
            } else{
                return redirect()->to(base_url('/admin/pesanan/'.$pesanan_id));
            }
        } else{
            $simpan = $this->barang_model->insertBarang($data);
            if($simpan){
                if($role == 'Kurir'){
                    session()->setFlashdata('success', 'Barang Masuk');
                    return redirect()->to(base_url('/kurir/pesanan/proses/'.$pesanan_id));
                } else{
                    session()->setFlashdata('success', 'Barang Masuk');
                    return redirect()->to(base_url('/admin/pesanan/'.$pesanan_id));
                }
            } else{
                session()->setFlashdata('errors', 'Tidak Terproses bung');
            }
        }
    }

    public function barang()
    {
        $id = $_SESSION['id'];

        $myTime = Time::today('Asia/Makassar');

        $data['barang'] = $this->barang_model
                                ->select('pesanan.pesanan_resi,barang.barang_id,pesanan.pesanan_id,barang.barang_kode,
                                barang.barang_name,barang.barang_harga,barang.barang_ongkir,barang.barang_status,
                                barang.barang_keterangan,barang.kurir_id,barang.kecamatan_id,kecamatan.kecamatan_name,barang.created_at')
                                ->join('pesanan', 'pesanan.pesanan_id = barang.pesanan_id')
                                ->join('kecamatan', 'kecamatan.kecamatan_id = barang.kecamatan_id')
                                ->where('barang_status', 'Terjemput')
                                ->orderBy('barang.created_at', 'ASC')->findAll();
        // $data['antar'] = $this->barang_model
        //                         ->join('pesanan', 'pesanan.pesanan_id = barang.pesanan_id')
        //                         ->join('kecamatan', 'kecamatan.kecamatan_id = barang.kecamatan_id')
        //                         ->where('barang_status !=', 'Terjemput')
        //                         ->where('barang.kurir_id', $id)->findAll();
        
        $data['antar'] = $this->barang_model
                        ->select('pesanan.pesanan_resi,barang.barang_id,pesanan.pesanan_id,barang.barang_kode,
                        barang.barang_name,barang.barang_harga,barang.barang_ongkir,barang.barang_status,
                        barang.barang_keterangan,barang.kurir_id,barang.kecamatan_id,kecamatan.kecamatan_name,barang.created_at')
                        ->join('pesanan', 'pesanan.pesanan_id = barang.pesanan_id')
                        ->join('kecamatan', 'kecamatan.kecamatan_id = barang.kecamatan_id')
                        ->where('barang.kurir_id', $id)
                        ->groupStart()
                            ->where('barang_status !=', 'Antar')
                            ->where('barang_status !=', 'Terjemput')
                            ->where('barang_status !=', 'Tunda')
                            ->where('DATE(barang.created_at)', $myTime)
                            ->orGroupStart()
                                ->where('barang_status !=', 'Sukses')
                                ->where('barang_status !=', 'Cancel')
                                ->where('barang_status !=', 'Terjemput')
                            ->groupEnd()
                        ->groupEnd()
                        ->orderBy('barang.created_at', 'ASC')
                        ->findAll();
        // dd($data['barang']);
        $data['title'] = 'Barang';
        echo view('kurir/new_barang', $data);
    }

    public function show_barang($id)
    {  
        $data['barang'] = $this->barang_model->getBarang($id);
        $data['title'] = "Barang Detail";
        // dd($data);
        echo view('kurir/barang_show', $data);
    }

    public function update_barang()
    {
        $kurir = $_SESSION['id'];
        $id = $this->request->getPost('barang_id');
        $pesanan_id = $this->request->getPost('pesanan_id');
        $status = $this->request->getPost('barang_status');

        // $myTime = Time::today('Asia/Makassar');
        $myTime = Time::now('Asia/Makassar', 'id_ID');
        
        $data = array(
            'barang_status' => $this->request->getPost('barang_status'),
            'barang_keterangan' => $this->request->getPost('barang_keterangan'),
            'kurir_id' => $kurir,
        );

        if($status == 'Sukses'){
            $data += ['created_at' => $myTime];
        }

        $validation =  \Config\Services::validation();
        if($validation->run($data, 'barang_update') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('kurir/barang/show')."/".$id);
        } else{
            $simpan = $this->barang_model->updateBarang($data, $id);

            $pesanan = $this->barang_model->where('pesanan_id', $pesanan_id)
                                    ->countAllResults();

            $sukses = $this->barang_model->where('pesanan_id', $pesanan_id)
                                    ->where('barang_status', 'Sukses')->countAllResults();

            if($pesanan == $sukses){
                $data = array(
                        'pesanan_status' => 'Sukses',
                );

                $simpan_pesanan = $this->pesanan_model->updatePesanan($data, $pesanan_id);
            }

            if($simpan){
                session()->setFlashdata('success', 'Barang terupdate');
                return redirect()->to(base_url('kurir/barang'));
            } else{
                session()->setFlashdata('errors', 'Tidak Terproses bung');
            }
        }

    }
}
