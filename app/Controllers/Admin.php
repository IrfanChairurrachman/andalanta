<?php

namespace App\Controllers;
use App\Models\Kecamatan_model;
use App\Models\Pesanan_model;
use App\Models\Auth_model;
use App\Models\Barang_model;
use App\Models\Settings_model;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function export_pesanan()
    {  
        // ambil data transaction dari database
        $pesanan = $this->pesanan_model
                        ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
                        ->join('users', 'users.id = pesanan.kurir_id')
                        ->get()
                        ->getResultArray();

        // dd($pesanan);
        
        // panggil class Sreadsheet baru
        $spreadsheet = new Spreadsheet;
        // Buat custom header pada file excel
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Resi')
                    ->setCellValue('C1', 'Nama')
                    ->setCellValue('D1', 'Toko')
                    ->setCellValue('E1', 'Kecamatan')
                    ->setCellValue('F1', 'Kontak')
                    ->setCellValue('G1', 'Alamat')
                    ->setCellValue('H1', 'Sosmed')
                    ->setCellValue('I1', 'Nama Penjemput')
                    ->setCellValue('J1', 'Kode Kurir')
                    ->setCellValue('K1', 'Waktu');
        // define kolom dan nomor
        $kolom = 2;
        $nomor = 1;
        // tambahkan data transaction ke dalam file excel
        foreach($pesanan as $data) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, $data['pesanan_resi'])
                        ->setCellValue('C' . $kolom, $data['pesanan_name'])
                        ->setCellValue('D' . $kolom, $data['pesanan_toko'])
                        ->setCellValue('E' . $kolom, $data['kecamatan_name'])
                        ->setCellValue('F' . $kolom, $data['pesanan_kontak'])
                        ->setCellValue('G' . $kolom, $data['pesanan_alamat'])
                        ->setCellValue('H' . $kolom, $data['pesanan_sosmed'])
                        ->setCellValue('I' . $kolom, $data['name'])
                        ->setCellValue('J' . $kolom, $data['kode'])
                        ->setCellValue('K' . $kolom, date('j F Y', strtotime($data['created_at'])));
    
            $kolom++;
            $nomor++;
    
        }
        // download spreadsheet dalam bentuk excel .xlsx
        $writer = new Xlsx($spreadsheet);
    
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Pesanan.xlsx"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');

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
        $pesanan_id = $this->request->getPost('pesanan_id');
    
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
                return redirect()->to(base_url('admin/barang'));
            } else{
                session()->setFlashdata('errors', 'Tidak Terproses bung');
            }
        }
    }

    public function export_barang()
    {  
        // ambil data transaction dari database
        $barang = $this->barang_model
                        ->join('kecamatan', 'kecamatan.kecamatan_id = barang.kecamatan_id')
                        ->join('users', 'users.id = barang.kurir_id')
                        ->get()
                        ->getResultArray();

        // dd($barang);
        
        // panggil class Sreadsheet baru
        $spreadsheet = new Spreadsheet;
        // Buat custom header pada file excel
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Kode')
                    ->setCellValue('C1', 'Nama')
                    ->setCellValue('D1', 'Harga')
                    ->setCellValue('E1', 'Ongkir')
                    ->setCellValue('F1', 'Kecamatan')
                    ->setCellValue('G1', 'Status')
                    ->setCellValue('H1', 'Keterangan')
                    ->setCellValue('I1', 'Nama Pengantar')
                    ->setCellValue('J1', 'Kode Kurir')
                    ->setCellValue('K1', 'Waktu');
        // define kolom dan nomor
        $kolom = 2;
        $nomor = 1;
        // tambahkan data transaction ke dalam file excel
        foreach($barang as $data) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, $data['barang_kode'])
                        ->setCellValue('C' . $kolom, $data['barang_name'])
                        ->setCellValue('D' . $kolom, "Rp. ".number_format($data['barang_harga']))
                        ->setCellValue('E' . $kolom, "Rp. ".number_format($data['barang_ongkir']))
                        ->setCellValue('F' . $kolom, $data['kecamatan_name'])
                        ->setCellValue('G' . $kolom, $data['barang_status'])
                        ->setCellValue('H' . $kolom, $data['barang_keterangan'])
                        ->setCellValue('I' . $kolom, $data['name'])
                        ->setCellValue('J' . $kolom, $data['kode'])
                        ->setCellValue('K' . $kolom, date('j F Y', strtotime($data['created_at'])));
    
            $kolom++;
            $nomor++;
    
        }
        // download spreadsheet dalam bentuk excel .xlsx
        $writer = new Xlsx($spreadsheet);
    
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Barang.xlsx"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');

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
