<?php namespace App\Models;
use CodeIgniter\Model;
  
class Barang_model extends Model
{
    protected $table = 'barang';
      
    public function getBarang($id = false)
    {
        if($id === false){
            return $this->table('barang')
                        ->join('pesanan', 'pesanan.pesanan_id = barang.pesanan_id')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('barang')
                        ->join('pesanan', 'pesanan.pesanan_id = barang.pesanan_id')
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
}
?>