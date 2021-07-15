<?php namespace App\Models;
use CodeIgniter\Model;
  
class Barang_model extends Model
{
    protected $table = 'barang';
      
    public function getBarang($id = false)
    {
        if($id === false){
            return $this->table('barang')
                        ->join('pesanan', 'barang.pesanan_id = pesanan.pesanan_id')
                        ->join('kecamatan', 'kecamatan.kecamatan_id = barang.kecamatan_id')
                        ->orderBy('barang.created_at', 'DESC')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('barang')
                        ->select('pesanan.pesanan_resi,barang.barang_id,pesanan.pesanan_id,barang.barang_kode,
                        barang.barang_name,barang.barang_harga,barang.barang_ongkir,barang.barang_status,
                        barang.barang_keterangan,barang.kurir_id,barang.kecamatan_id,kecamatan.kecamatan_name,barang.created_at')
                        ->join('pesanan', 'pesanan.pesanan_id = barang.pesanan_id')
                        ->join('kecamatan', 'kecamatan.kecamatan_id = barang.kecamatan_id')
                        ->where('barang.barang_id', $id)
                        ->get()
                        ->getRowArray();
        }   
    }
    public function insertBarang($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updateBarang($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['barang_id' => $id]);
    }
    public function deleteBarang($id)
    {
        return $this->db->table($this->table)->delete(['barang_id' => $id]);
    }
    public function getGrafik($bstart = false, $bend = false)
    {
        if($bstart === false){
            $query = $this->db->query("SELECT MONTHNAME(created_at) as month, COUNT(barang_id) as total FROM barang GROUP BY MONTHNAME(created_at) ORDER BY MONTH(created_at)");
            $hasil = [];
            if(!empty($query)){
                foreach($query->getResultArray() as $data) {
                    $hasil[] = $data;
                }
            }
            return $hasil;
        } else{
            $sql = "SELECT MONTHNAME(created_at) as month, COUNT(barang_id) as total FROM barang WHERE created_at BETWEEN ? AND ? GROUP BY MONTHNAME(created_at) ORDER BY MONTH(created_at)";
            $query = $this->db->query($sql, [$bstart, $bend])->getResultArray();
            return $query;
        }
    }

    public function getKecamatan($start = false, $end = false)
    {
        if($start === false){
            $query = $this->db->query("SELECT kecamatan.kecamatan_name as kecamatan, COUNT(barang.barang_id) as total FROM barang RIGHT JOIN kecamatan ON barang.kecamatan_id=kecamatan.kecamatan_id AND barang.barang_status != 'Terjemput' GROUP BY kecamatan.kecamatan_name ORDER BY kecamatan.kecamatan_name");
            $hasil = [];
            if(!empty($query)){
                foreach($query->getResultArray() as $data) {
                    $hasil[] = $data;
                }
            }
            return $hasil;
        } else{
            $sql = "SELECT kecamatan.kecamatan_name as kecamatan, COUNT(barang.barang_id) as total FROM barang RIGHT JOIN kecamatan ON barang.kecamatan_id=kecamatan.kecamatan_id AND barang.barang_status != 'Terjemput' AND barang.created_at BETWEEN ? AND ? GROUP BY kecamatan.kecamatan_name ORDER BY kecamatan.kecamatan_name";
            $query = $this->db->query($sql, [$start, $end])->getResultArray();
            return $query;
        }
    }

    public function getKecamatan2($start = false, $end = false)
    {
        if($start === false){
            $query = $this->db->query("SELECT kecamatan.kecamatan_name as kecamatan, COUNT(barang.barang_id) as total FROM barang RIGHT JOIN kecamatan ON barang.kecamatan_id=kecamatan.kecamatan_id AND barang.barang_status = 'Terjemput' GROUP BY kecamatan.kecamatan_name ORDER BY kecamatan.kecamatan_name");
            $hasil = [];
            if(!empty($query)){
                foreach($query->getResultArray() as $data) {
                    $hasil[] = $data;
                }
            }
            return $hasil;
        } else{
            $sql = "SELECT kecamatan.kecamatan_name as kecamatan, COUNT(barang.barang_id) as total FROM barang RIGHT JOIN kecamatan ON barang.kecamatan_id=kecamatan.kecamatan_id AND barang.barang_status = 'Terjemput' AND barang.created_at BETWEEN ? AND ? GROUP BY kecamatan.kecamatan_name ORDER BY kecamatan.kecamatan_name";
            $query = $this->db->query($sql, [$start, $end])->getResultArray();
            return $query;
        }
    }
}
?>