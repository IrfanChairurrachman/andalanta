<?php

namespace App\Controllers;
use App\Models\Kecamatan_model;
use App\Models\Pesanan_model;
use App\Models\Auth_model;

class Kurir extends BaseController
{
	protected $helpers = [];
 
    public function __construct()
    {
        helper(['form']);
        $this->kecamatan_model = new Kecamatan_model();
        $this->pesanan_model = new Pesanan_model();
        $this->user_model = new Auth_model();
    }

	public function index()
	{
        $id = $_SESSION['id'];

        $data['kurir'] = $this->user_model->getUser($id);
		$data['jemput'] = $this->pesanan_model->where('pesanan_status', 'Jemput')->findAll();
        $data['antar'] = $this->pesanan_model->where('pesanan_status', 'On Process')->where('pesanan_kurir', $id)->findAll();

        // dd($data);
		return view('kurir/index', $data);
	}

    public function show($id)
    {  
        $data['pesanan'] = $this->pesanan_model->getPesanan($id);
        // dd($data);
        echo view('kurir/pesanan_show', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('pesanan_id');
    
        $data = array(
            'pesanan_status' => $this->request->getPost('pesanan_status'),
            'pesanan_kurir' => $this->request->getPost('pesanan_kurir'),
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

}
