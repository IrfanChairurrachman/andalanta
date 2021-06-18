<?php

namespace App\Controllers;
use App\Models\Kecamatan_model;
use App\Models\Pesanan_model;
use App\Models\Barang_model;

class Home extends BaseController
{
	protected $helpers = [];
 
    public function __construct()
    {
        helper(['form']);
        $this->kecamatan_model = new Kecamatan_model();
        $this->pesanan_model = new Pesanan_model();
        $this->barang_model = new Barang_model();
    }

	public function index()
	{
		$data['kecamatan'] = $this->kecamatan_model->getKecamatan();
		return view('index', $data);
	}

    public function cekResi()
	{
        $resi = $this->request->getPost('pesanan_resi');

        $data['barang'] = $this->barang_model
                                ->join('pesanan', 'pesanan.pesanan_id = barang.pesanan_id')
                                ->where('pesanan.pesanan_resi', $resi)->findAll();
        // dd($data);
        session()->setFlashdata('resi', $data['barang']);
        return redirect()->to(base_url('/'));
		// $data['kecamatan'] = $this->kecamatan_model->getKecamatan();
		// return view('index');
	}

	public function admin()
	{
		return view('dashboard');
	}

	public function kurir()
	{
		return view('kurir/index');
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

        if($data){
            $simpan = $this->pesanan_model->insertPesanan($data);
            if($simpan){
                session()->setFlashdata('success', 'Pesanan Telah Tercatat');
                session()->setFlashdata('info', 'Resi Anda '.$resi);
                return redirect()->to(base_url('/'));
            } else{
                session()->setFlashdata('errors', 'Tidak tersimpan bung');
            }
        }

        // if($validation->run($data, 'pesanan') == FALSE){
        //     session()->setFlashdata('inputs', $this->request->getPost());
        //     session()->setFlashdata('errors', $validation->getErrors());
        //     return redirect()->to(base_url('admin/pesanan/create'));
        // } else {
        //     $model = new pesanan_model();
        //     $simpan = $model->insertpesanan($data);
        //     if($simpan)
        //     {
        //         session()->setFlashdata('success', 'Created pesanan successfully');
        //         return redirect()->to(base_url('admin/pesanan')); 
        //     }
        // }
    }
}
