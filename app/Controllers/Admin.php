<?php

namespace App\Controllers;
use App\Models\Kecamatan_model;
use App\Models\Pesanan_model;
use App\Models\Auth_model;
use App\Models\Barang_model;

class Admin extends BaseController
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

	public function pesanan()
	{
		$data['jemput'] = $this->pesanan_model->getPesanan();
        // dd($data);
        $data['title'] = "Pesanan";
		return view('admin/pesanan', $data);
	}

    public function show($id)
    {  
        $data['pesanan'] = $this->pesanan_model->getPesanan($id);
        $data['title'] = "Pesanan Detail";
        // dd($data);
        echo view('admin/p_show', $data);
    }

    public function edit_pesanan($id)
    {  
        $data['pesanan'] = $this->pesanan_model->getPesanan($id);
        $data['kecamatan'] = $this->kecamatan_model->getKecamatan();
        // dd($data);
        echo view('admin/pesanan_edit', $data);
    }

    public function proses($id)
    {
        $kurir = $_SESSION['id'];  
        $data['barang'] = $this->barang_model->where('pesanan_id', $id)->findAll();;
        $data['kecamatan'] = $this->kecamatan_model->getKecamatan();
        $data['pesanan'] = $this->pesanan_model->getPesanan($id);
        $data['kurir'] = $this->user_model->getUser($kurir);
        // dd($data);
        echo view('kurir/pesanan_proses', $data);
    }

    public function update_pesanan()
    {
        $id = $this->request->getPost('pesanan_id');
    
        $data = array(
            'pesanan_name' => $this->request->getPost('pesanan_name'),
            'kecamatan_id' => $this->request->getPost('kecamatan_id'),
        );
        
        // dd($data);
        if($data){
            $simpan = $this->pesanan_model->updatePesanan($data, $id);
            if($simpan){
                session()->setFlashdata('success', 'Pesanan Terupdate');
                return redirect()->to(base_url('/admin/pesanan'));
            } else{
                session()->setFlashdata('errors', 'Tidak Terproses bung');
            }
        }
    }

    public function store()
    {
        $pesanan_id = $this->request->getPost('pesanan_id');

        $data = array(
            'pesanan_id' => $this->request->getPost('pesanan_id'),
            'barang_kode' => $this->request->getPost('barang_kode'),
            'barang_name' => $this->request->getPost('barang_name'),
            'barang_harga' => $this->request->getPost('barang_harga'),
            'barang_status' => '',
            'barang_ongkir' => $this->request->getPost('barang_ongkir'),
            'kecamatan_id' => $this->request->getPost('kecamatan_id'),
        );
        
        // dd($pesanan_id);
        if($data){
            $simpan = $this->barang_model->insertBarang($data);
            if($simpan){
                session()->setFlashdata('success', 'Barang Masuk');
                return redirect()->to(base_url('/kurir/pesanan/proses/'.$pesanan_id));
            } else{
                session()->setFlashdata('errors', 'Tidak Terproses bung');
            }
        }
    }

    public function barang()
    {
        $data['barang'] = $this->barang_model->getBarang();
        $data['title'] = "Barang";
        // dd($data['barang']);
        echo view('admin/barang', $data);
    }

    public function show_barang($id)
    {  
        $data['barang'] = $this->barang_model->getBarang($id);
        // dd($data);
        echo view('admin/pesanan_show', $data);
    }

    public function update_barang()
    {
        $id = $this->request->getPost('barang_id');
    
        $data = array(
            'barang_status' => $this->request->getPost('barang_status'),
        );
        // dd($data);
        if($data){
            $simpan = $this->barang_model->updateBarang($data, $id);
            // dd($simpan);
            if($simpan){
                session()->setFlashdata('success', 'Barang terupdate');
                return redirect()->to(base_url('/kurir/barang'));
            } else{
                session()->setFlashdata('errors', 'Tidak Terproses bung');
            }
        }
    }
}
