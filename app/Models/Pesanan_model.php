<?php namespace App\Models;
use CodeIgniter\Model;
  
class Pesanan_model extends Model
{
    protected $table = 'pesanan';
      
    public function getPesanan($id = false)
    {
        if($id === false){
            return $this->table('pesanan')
                        ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('pesanan')
                        ->join('kecamatan', 'kecamatan.kecamatan_id = pesanan.kecamatan_id')
                        ->where('pesanan.pesanan_id', $id)
                        ->get()
                        ->getRowArray();
        }   
    }
    public function insertPesanan($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updatePesanan($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['pesanan_id' => $id]);
    }
    public function deletePesanan($id)
    {
        return $this->db->table($this->table)->delete(['pesanan_id' => $id]);
    }
}
?>