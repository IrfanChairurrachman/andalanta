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

        if(session()->get('role') != 'Admin'){
            $data['title'] = "Error";
            echo view('error-403', $data);
            // echo "Akses Ditolak";
            exit;
        }
        $this->kecamatan_model = new Kecamatan_model();
        $this->pesanan_model = new Pesanan_model();
        $this->user_model = new Auth_model();
        $this->barang_model = new Barang_model();
        $this->setting_model = new Settings_model();
        
    }

	public function pesanan()
	{
        $data['jemput'] = $this->pesanan_model
                                ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
                                ->join('users', 'pesanan.kurir_id=users.id', 'left')
                                ->orderBy('pesanan.created_at', 'DESC')->get()->getResultArray();
		// $data['jemput'] = $this->pesanan_model->getPesanan();
        $data['title'] = "Pesanan";
        // dd($data['jemput']);
		return view('admin/pesanan', $data);
	}

    public function pesananpost()
	{
        $data['start'] = $this->request->getPost('start');
        $data['end'] = $this->request->getPost('end');

        empty($data['start']) ? $start = '2021-01-01' : $start = $data['start'];
        empty($data['end']) ? $end = Time::today('Asia/Makassar')->toLocalizedString('yyyy-MM-dd') : $end = $data['end'];

        $data['jemput'] = $this->pesanan_model
                                ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
                                ->join('users', 'pesanan.kurir_id=users.id', 'left')
                                ->where('pesanan.created_at >=', $start)
                                ->where('pesanan.created_at <=', $end)
                                ->orderBy('pesanan.created_at', 'DESC')->get()->getResultArray();
		// $data['jemput'] = $this->pesanan_model->getPesanan();
        $data['title'] = "Pesanan";
        // dd($data['jemput']);
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

        if(is_null($data['pesanan']['kurir_id'])){
            $data['pesanan']['name'] = "belum dijemput";
        } else{
            $data['pesanan'] = $this->pesanan_model
            ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
            ->join('users', 'users.id = pesanan.kurir_id')
            ->where('pesanan_id', $id)
            ->get()
            ->getRowArray();
        }

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

        $start = $this->request->getPost('start');
        $end = $this->request->getPost('end');

        empty($start) ? $start = '2021-01-01' : $start = $start;
        empty($end) ? $end = Time::today('Asia/Makassar')->toLocalizedString('yyyy-MM-dd') : $end = $end;

        // $sql = "SELECT * FROM pesanan WHERE pesanan.created_at BETWEEN ? AND ? JOIN kecamatan ON kecamatan.kecamatan_id=pesanan.kecamatan_id JOIN users ON users.id=pesanan.kurir_id ORDER BY MONTH(pesanan.created_at) DESC";
        // $pesanan = $this->pesanan_model->query($sql, [$start, $end])->getResultArray();

        // dd($pesanan);
        // // ambil data transaction dari database
        $pesanan = $this->pesanan_model
                        ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
                        ->join('users', 'users.id = pesanan.kurir_id', 'left')
                        ->where('pesanan.created_at >=', $start)
                        ->where('pesanan.created_at <=', $end)
                        ->orderBy('pesanan.created_at', 'DESC')
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
                    ->setCellValue('K1', 'Waktu')
                    ->setCellValue('L1', 'Status');
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
                        ->setCellValue('K' . $kolom, date('j F Y', strtotime($data['created_at'])))
                        ->setCellValue('L' . $kolom, $data['pesanan_status']);
    
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
        $validation =  \Config\Services::validation();
        if($validation->run($data, 'pesanan') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('admin/pesanan/create'));
        } else {
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
        $data['barang'] = $this->barang_model->join('users', 'barang.kurir_id=users.id', 'left')
                                        ->orderBy('barang.created_at', 'DESC')->get()->getResultArray();
        $data['title'] = "Barang";
        // dd($data['barang']);
        echo view('admin/barang', $data);
    }

    public function barangpost()
    {
        $data['start'] = $this->request->getPost('start');
        $data['end'] = $this->request->getPost('end');

        empty($data['start']) ? $start = '2021-01-01' : $start = $data['start'];
        empty($data['end']) ? $end = Time::today('Asia/Makassar')->toLocalizedString('yyyy-MM-dd') : $end = $data['end'];

        $data['barang'] = $this->barang_model->join('users', 'barang.kurir_id=users.id', 'left')
                                            ->where('barang.created_at >=', $start)
                                            ->where('barang.created_at <=', $end)
                                            ->orderBy('barang.created_at', 'DESC')
                                            ->get()->getResultArray();
        $data['title'] = "Barang";
        // dd($data['barang']);
        echo view('admin/barang', $data);
    }

    public function show_barang($id)
    {  
        $data['barang'] = $this->barang_model->getBarang($id);
        $data['title'] = "Barang Detail";
        if(is_null($data['barang']['kurir_id'])){
            $data['barang']['name'] = "belum diantar";
        } else{
            $data['barang'] = $this->barang_model
            ->join('pesanan', 'barang.pesanan_id = pesanan.pesanan_id')
            ->join('kecamatan', 'kecamatan.kecamatan_id = barang.kecamatan_id')
            ->join('users', 'users.id = barang.kurir_id')
            ->where('barang_id', $id)
            ->get()
            ->getRowArray();
        }
        // dd($data['barang']);
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
            'barang_harga' => $this->request->getPost('barang_harga'),
            'barang_ongkir' => $this->request->getPost('barang_ongkir'),
            'kecamatan_id' => $this->request->getPost('kecamatan_id'),
            'barang_status' => $this->request->getPost('barang_status'),
            'barang_keterangan' => $this->request->getPost('barang_keterangan')
        );
        // dd($data);
        $validation =  \Config\Services::validation();
        if($validation->run($data, 'barang') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            
            return redirect()->to(base_url('/admin/barang/edit/'.$id));
            
        } else{
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
        $start = $this->request->getPost('start');
        $end = $this->request->getPost('end');
        
        empty($start) ? $start = '2021-01-01' : $start = $start;
        empty($end) ? $end = Time::today('Asia/Makassar')->toLocalizedString('yyyy-MM-dd') : $end = $end;
        // ambil data transaction dari database
        $barang = $this->barang_model
                        ->select('pesanan.pesanan_resi,barang.barang_id,pesanan.pesanan_id,barang.barang_kode,
                        barang.barang_name,barang.barang_harga,barang.barang_ongkir,barang.barang_status,
                        barang.barang_keterangan,users.name,users.kode,barang.kecamatan_id,kecamatan.kecamatan_name,barang.created_at')
                        ->join('pesanan', 'pesanan.pesanan_id = barang.pesanan_id')
                        ->join('kecamatan', 'kecamatan.kecamatan_id = barang.kecamatan_id')
                        ->join('users', 'users.id = barang.kurir_id', 'left')
                        ->where('barang.created_at >=', $start)
                        ->where('barang.created_at <=', $end)
                        ->orderBy('barang.created_at', 'DESC')
                        ->get()
                        ->getResultArray();

        // dd($barang);
        
        // panggil class Sreadsheet baru
        $spreadsheet = new Spreadsheet;
        // Buat custom header pada file excel
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Resi')
                    ->setCellValue('C1', 'Kode')
                    ->setCellValue('D1', 'Nama')
                    ->setCellValue('E1', 'Harga')
                    ->setCellValue('F1', 'Ongkir')
                    ->setCellValue('G1', 'Kecamatan')
                    ->setCellValue('H1', 'Status')
                    ->setCellValue('I1', 'Keterangan')
                    ->setCellValue('J1', 'Nama Pengantar')
                    ->setCellValue('K1', 'Kode Kurir')
                    ->setCellValue('L1', 'Waktu');
        // define kolom dan nomor
        $kolom = 2;
        $nomor = 1;
        // tambahkan data transaction ke dalam file excel
        $otot = 0;
        $htot = 0;
        foreach($barang as $data) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, $data['pesanan_resi'])
                        ->setCellValue('C' . $kolom, $data['barang_kode'])
                        ->setCellValue('D' . $kolom, $data['barang_name'])
                        ->setCellValue('E' . $kolom, "Rp. ".number_format($data['barang_harga']))
                        ->setCellValue('F' . $kolom, "Rp. ".number_format($data['barang_ongkir']))
                        ->setCellValue('G' . $kolom, $data['kecamatan_name'])
                        ->setCellValue('H' . $kolom, $data['barang_status'])
                        ->setCellValue('I' . $kolom, $data['barang_keterangan'])
                        ->setCellValue('J' . $kolom, $data['name'])
                        ->setCellValue('K' . $kolom, $data['kode'])
                        ->setCellValue('L' . $kolom, date('j F Y', strtotime($data['created_at'])));
    
            $kolom++;
            $nomor++;
            $otot += $data['barang_ongkir'];
            $htot += $data['barang_harga'];
    
        }
        $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, 'Total')
                        ->setCellValue('E' . $kolom, "Rp. ".number_format($htot))
                        ->setCellValue('F' . $kolom, "Rp. ".number_format($otot));
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
        
        $data['pesanan'] = $this->pesanan_model->where('kurir_id', $id)->findAll();
        $data['barang'] = $this->barang_model->where('kurir_id', $id)->findAll();

        $data['barang_total'] = $this->barang_model->where('kurir_id', $id)->countAllResults();
        $data['pesanan_total'] = $this->pesanan_model->where('kurir_id', $id)->countAllResults();

        foreach($data['pesanan'] as $key => $row){
            $data['pesanan'][$key]['total'] = 0;
            // echo $data['pesanan'][$key]['total'];
            $barang = $this->barang_model->where('pesanan_id', $row['pesanan_id'])->findAll();
            foreach($barang as $k => $r){
                $data['pesanan'][$key]['total'] += $r['barang_harga'];
            }
        }
        // dd($data);
        echo view('admin/kurir_show', $data);
    }

    public function show_kurir_post($id)
    {
        $data['start'] = $this->request->getPost('start');
        $data['end'] = $this->request->getPost('end');
        
        empty($data['start']) ? $start = '2021-01-01' : $start = $data['start'];
        empty($data['end']) ? $end = Time::today('Asia/Makassar')->toLocalizedString('yyyy-MM-dd') : $end = $data['end'];

        $data['kurir'] = $this->user_model->getUser($id);
        $data['title'] = "Kurir Show";

        $data['pesanan'] = $this->pesanan_model->where('kurir_id', $id)
                                            ->where('pesanan.created_at >=', $start)
                                            ->where('pesanan.created_at <=', $end)->findAll();
        $data['barang'] = $this->barang_model->where('kurir_id', $id)
                                            ->where('barang.created_at >=', $start)
                                            ->where('barang.created_at <=', $end)->findAll();

        $data['barang_total'] = $this->barang_model->where('kurir_id', $id)
                                                ->where('barang.created_at >=', $start)
                                                ->where('barang.created_at <=', $end)->countAllResults();
        $data['pesanan_total'] = $this->pesanan_model->where('kurir_id', $id)
                                                ->where('pesanan.created_at >=', $start)
                                                ->where('pesanan.created_at <=', $end)->countAllResults();
        
        foreach($data['pesanan'] as $key => $row){
            $data['pesanan'][$key]['total'] = 0;
            // echo $data['pesanan'][$key]['total'];
            $barang = $this->barang_model->where('pesanan_id', $row['pesanan_id'])->findAll();
            foreach($barang as $k => $r){
                $data['pesanan'][$key]['total'] += $r['barang_harga'];
            }
        }
        // dd($data);
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
        $validation =  \Config\Services::validation();
        if($validation->run($data, 'user') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());

            if($this->request->getPost('role') == 'Kurir'){
                return redirect()->to(base_url('/admin/kurir/edit/'.$id));
            } else{
                return redirect()->to(base_url('/admin/settings/edit/'.$id));
            }
            
        } else {
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
        $validation =  \Config\Services::validation();
        if($validation->run($data, 'user') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());

            if($this->request->getPost('role') == 'Kurir'){
                return redirect()->to(base_url('admin/kurir/create/'));
            } else{
                return redirect()->to(base_url('admin/create'));
            }
            
        } else{
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
        $validation =  \Config\Services::validation();
        if($validation->run($data, 'setting') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());

            return redirect()->to(base_url('admin/setting'));
            
        } else {
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
