<?php

namespace App\Controllers;
use App\Models\Kecamatan_model;
use App\Models\Pesanan_model;
use App\Models\Barang_model;
use App\Models\Settings_model;
use App\Models\Auth_model;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
	protected $helpers = [];
 
    public function __construct()
    {
        helper(['form']);
        $this->kecamatan_model = new Kecamatan_model();
        $this->pesanan_model = new Pesanan_model();
        $this->barang_model = new Barang_model();
        $this->setting_model = new Settings_model();
        $this->user_model = new Auth_model();
    }

	public function index()
	{
		$data['kecamatan'] = $this->kecamatan_model->getKecamatan();
        $data['setting'] = $this->setting_model->getSetting(1);
		return view('alt_index', $data);
	}

    public function cekResi()
	{
        $resi = $this->request->getPost('pesanan_resi');

        $data['barang'] = $this->barang_model
                                ->join('pesanan', 'pesanan.pesanan_id = barang.pesanan_id')
                                ->where('pesanan.pesanan_resi', $resi)->findAll();
        $data['pesanan'] = $this->pesanan_model->where('pesanan_resi', $resi)->get()->getRowArray();
        
        session()->setFlashdata('resi', $data);
        return redirect()->to(base_url('/'));
	}

	public function admin()
	{
        if(session()->get('role') != 'Admin'){
            $data['title'] = "Error";
            echo view('error-403', $data);
            exit;
        }
        $data['grafik_pesanan'] = $this->pesanan_model->getGrafik();
        $data['grafik_barang'] = $this->barang_model->getGrafik();
        $data['grafik_barang_kecamatan'] = $this->barang_model->getKecamatan();
        $data['grafik_pesanan_kecamatan'] = $this->pesanan_model->getKecamatan();
        $data['kurir'] = $this->user_model->where('role', 'Kurir')->countAllResults();
        $data['pesanan'] = $this->pesanan_model->where('pesanan_status', 'Sukses')->countAllResults();
        $data['barang'] = $this->barang_model->where('barang_status', 'Sukses')->countAllResults();

        $id = $_SESSION['id'];

        $data['user'] = $this->user_model->where('id', $id)->get()->getRowArray();

        $data['title'] = 'Dashboard';
        $data['bstart'] = '';
        $data['bend'] = '';
        $data['start'] = '';
        $data['end'] = '';
        // dd($data);
		return view('admin/new_index', $data);
	}

    public function adminpost()
	{
        if(session()->get('role') != 'Admin'){
            $data['title'] = "Error";
            echo view('error-403', $data);
            exit;
        }

        $data['start'] = $this->request->getPost('start');
        $data['end'] = $this->request->getPost('end');
        
        $data['bstart'] = $this->request->getPost('bstart');
        $data['bend'] = $this->request->getPost('bend');
        
        empty($data['start']) ? $start = '2021-01-01' : $start = $data['start'];
        empty($data['end']) ? $end = Time::today('Asia/Makassar')->toLocalizedString('yyyy-MM-dd') : $end = $data['end'];
        empty($data['bstart']) ? $bstart = '2021-01-01' : $bstart = $data['bstart'];
        empty($data['bend']) ? $bend = Time::today('Asia/Makassar')->toLocalizedString('yyyy-MM-dd') : $bend = $data['bend'];

        $data['grafik_pesanan'] = $this->pesanan_model->getGrafik($bstart, $bend);
        $data['grafik_barang'] = $this->barang_model->getGrafik($bstart, $bend);
        $data['grafik_barang_kecamatan'] = $this->barang_model->getKecamatan($start, $end);
        $data['grafik_pesanan_kecamatan'] = $this->pesanan_model->getKecamatan($start, $end);
        $data['kurir'] = $this->user_model->where('role', 'Kurir')->countAllResults();
        $data['pesanan'] = $this->pesanan_model->where('pesanan_status', 'Sukses')->countAllResults();
        $data['barang'] = $this->barang_model->where('barang_status', 'Sukses')->countAllResults();

        $id = $_SESSION['id'];

        $data['user'] = $this->user_model->where('id', $id)->get()->getRowArray();

        $data['title'] = 'Dashboard';
        
        // if(!empty($bstart)){
        //     echo "ADA";
        // } else{
        //     echo "TIDAK ADA";
        // }
        // dd($bstart);
		return view('admin/new_index', $data);
	}

	public function store()
    {
        $validation =  \Config\Services::validation();

		$n = 5;
        $resi = bin2hex(random_bytes($n));

        $data = array(
            'pesanan_name'     => $this->request->getPost('pesanan_name'),
            'kecamatan_id'   => $this->request->getPost('kecamatan'),
			'pesanan_toko'   => $this->request->getPost('pesanan_toko'),
			'pesanan_kontak'   => $this->request->getPost('pesanan_kontak'),
			'pesanan_alamat'   => $this->request->getPost('pesanan_alamat'),
            'pesanan_sosmed'   => $this->request->getPost('pesanan_sosmed'),
			'pesanan_resi'   => $resi,
        );

        // dd($data);

        if($validation->run($data, 'pesanan') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            if(session()->get('role') == 'Admin'){
                return redirect()->to(base_url('admin/pesanan/create'));
            } else{
                return redirect()->to(base_url('/'));
            }
        } else {
            $simpan = $this->pesanan_model->insertPesanan($data);
            if($simpan){
                session()->setFlashdata('success', 'Pesanan Telah Tercatat');
                session()->setFlashdata('info', 'Resi Anda '.$resi);
                if(session()->get('role') == 'Admin'){
                    return redirect()->to(base_url('admin/pesanan'));
                } else{
                    return redirect()->to(base_url('/'));
                }
            } else{
                session()->setFlashdata('errors', 'Tidak tersimpan bung');
            }
        }
    }
}