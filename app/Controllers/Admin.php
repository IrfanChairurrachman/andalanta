<?php

namespace App\Controllers;
use App\Models\Kecamatan_model;
use App\Models\Pesanan_model;
use App\Models\Auth_model;
use App\Models\Barang_model;
use App\Models\Settings_model;
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
        $this->setting_model = new Settings_model();
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
        $data['barang'] = $this->barang_model->join('kecamatan', 'kecamatan.kecamatan_id = barang.kecamatan_id')
                                            ->where('pesanan_id', $id)->findAll();
        $data['kecamatan'] = $this->kecamatan_model->getKecamatan();
        $data['pesanan'] = $this->pesanan_model->getPesanan($id);
        $data['kurir'] = $this->user_model->where('role', 'Kurir')->findAll();
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
        // dd($data['kurir']);
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
            'pesanan_alamat' => $this->request->getPost('pesanan_alamat'),
            'pesanan_kontak' => $this->request->getPost('pesanan_kontak'),
            'pesanan_toko' => $this->request->getPost('pesanan_toko'),
            'pesanan_sosmed' => $this->request->getPost('pesanan_sosmed'),
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
        $data['setting'] = $this->setting_model->getSetting(1);
        $data['title'] = "Settings";
        // dd($data['setting']);
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

    public function create_kurir()
    {  
        $data['title'] = "Buat Kurir";

        echo view('admin/kurir_create', $data);
    }

    public function create_admin()
    {  
        $data['title'] = "Buat Admin";

        echo view('admin/admin_create', $data);
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

    public function store_user()
    {
        $data = array(
            'kode' => $this->request->getPost('kode'),
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'role' => $this->request->getPost('role'),
        );
        // dd($data);
        if($data){
            $simpan = $this->user_model->insertUser($data);
            // dd($simpan);
            if($simpan){
                session()->setFlashdata('success', 'User ditambahkan');
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

    public function delete_pesanan($id)
    {
        $hapus = $this->pesanan_model->deletePesanan($id);
        if($hapus)
        {
            session()->setFlashdata('warning', 'Pesanan Sukses Terhapus');
            return redirect()->to(base_url('admin/pesanan')); 
        }
    }

    public function delete_barang($id)
    {
        $hapus = $this->barang_model->deleteBarang($id);
        if($hapus)
        {
            session()->setFlashdata('warning', 'Barang Sukses Terhapus');
            return redirect()->to(base_url('admin/barang')); 
        }
    }

    public function delete_user($id)
    {
        if($id != 1){
            $hapus = $this->user_model->deleteUser($id);
            if($hapus)
            {
                session()->setFlashdata('warning', 'User Sukses Terhapus');
                return redirect()->to(base_url('admin/settings')); 
            }
        } else{
            session()->setFlashdata('warning', 'Tidak Bisa Menghapus User');
            return redirect()->to(base_url('admin/settings')); 
        }
    }

    public function edit_setting()
    {  
        $data['setting'] = $this->setting_model->getSetting(1);
        $data['title'] = "Setting Update";
        // dd($data);
        echo view('admin/setting_edit', $data);
    }

    public function update_setting()
    {
        $id = 1;
    
        $data = array(
            'setting_name' => $this->request->getPost('setting_name'),
            'setting_contact' => $this->request->getPost('setting_contact'),
            'setting_link' => $this->request->getPost('setting_link'),
            'setting_status' => $this->request->getPost('setting_status'),
        );
        // dd($data);
        if($data){
            $simpan = $this->setting_model->updateSetting($data, $id);
            // dd($simpan);
            if($simpan){
                session()->setFlashdata('success', 'Setting terupdate');
                return redirect()->to(base_url('admin/settings'));
            } else{
                session()->setFlashdata('errors', 'Tidak Terproses bung');
            }
        }
    }
}
