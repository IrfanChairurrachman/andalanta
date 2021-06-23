<?php

namespace App\Controllers;
use App\Models\Kecamatan_model;
use App\Models\Pesanan_model;
use App\Models\Auth_model;
use App\Models\Barang_model;
use CodeIgniter\I18n\Time;

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
        $kurir = $_SESSION['id'];  
        $data['barang'] = $this->barang_model->where('pesanan_id', $id)->findAll();
        $data['kecamatan'] = $this->kecamatan_model->getKecamatan();
        $data['pesanan'] = $this->pesanan_model->getPesanan($id);
        $data['kurir'] = $this->user_model->getUser($kurir);

        $data['date'] = Time::today('Asia/Makassar')->toLocalizedString('d/MMM/yyyy');

        $data['title'] = "Pesanan Detail";
        // dd($data);
        echo view('admin/p_show', $data);
    }

    public function edit_pesanan($id)
    {  
        $data['pesanan'] = $this->pesanan_model->getPesanan($id);
        $data['kecamatan'] = $this->kecamatan_model->getKecamatan();
        $data['title'] = "Pesanan Detail";
        // dd($data);
        echo view('admin/p_edit', $data);
    }

    public function create_pesanan()
    {  
        $data['kecamatan'] = $this->kecamatan_model->getKecamatan();
        $data['title'] = "Buat Pesanan";

        echo view('admin/p_create', $data);
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
        $data['title'] = "Barang Detail";
        // dd($data);
        echo view('admin/b_show', $data);
    }

    public function edit_barang($id)
    {  
        $data['barang'] = $this->barang_model->getBarang($id);
        $data['kecamatan'] = $this->kecamatan_model->getKecamatan();
        $data['title'] = "Barang Edit";
        // dd($data);
        echo view('admin/b_edit', $data);
    }

    public function update_barang()
    {
        $id = $this->request->getPost('barang_id');
    
        $data = array(
            'barang_kode' => $this->request->getPost('barang_kode'),
            'barang_name' => $this->request->getPost('barang_name'),
            'kecamatan_id' => $this->request->getPost('kecamatan_id'),
            'barang_status' => $this->request->getPost('barang_status'),
        );
        // dd($data);
        if($data){
            $simpan = $this->barang_model->updateBarang($data, $id);
            // dd($simpan);
            if($simpan){
                session()->setFlashdata('success', 'Barang terupdate');
                return redirect()->to(base_url('admin/barang'));
            } else{
                session()->setFlashdata('errors', 'Tidak Terproses bung');
            }
        }
    }

    public function settings()
    {
        $data['kurir'] = $this->user_model->where('role', 'Kurir')->findAll();
        $data['admin'] = $this->user_model->where('role', 'Admin')->findAll();
        $data['title'] = "Settings";
        // dd($data['barang']);
        echo view('admin/settings', $data);
    }

    public function show_kurir($id)
    {
        $data['kurir'] = $this->user_model->getUser($id);
        $data['title'] = "Kurir Show";
        // dd($data['barang']);
        echo view('admin/kurir_show', $data);
    }

    public function show_admin($id)
    {
        $data['admin'] = $this->user_model->getUser($id);
        $data['title'] = "Admin Show";
        // dd($data['barang']);
        echo view('admin/admin_show', $data);
    }

    public function edit_kurir($id)
    {  
        $data['kurir'] = $this->user_model->getUser($id);
        $data['title'] = "Kurir Edit";
        // dd($data);
        echo view('admin/kurir_edit', $data);
    }

    public function update_kurir()
    {
        $id = $this->request->getPost('id');
    
        $data = array(
            'kode' => $this->request->getPost('kode'),
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
        );
        // dd($data);
        if($data){
            $simpan = $this->user_model->updateUser($data, $id);
            // dd($simpan);
            if($simpan){
                session()->setFlashdata('success', 'User terupdate');
                return redirect()->to(base_url('admin/settings'));
            } else{
                session()->setFlashdata('errors', 'Tidak Terproses bung');
            }
        }
    }

    public function edit_admin($id)
    {  
        $data['admin'] = $this->user_model->getUser($id);
        $data['title'] = "Admin Edit";
        // dd($data);
        echo view('admin/admin_edit', $data);
    }

}
