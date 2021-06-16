<?php namespace App\Models;
use CodeIgniter\Model;
  
class Barang_model extends Model
{
    protected $table = 'barang';
      
    public function getBarang($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->table('barang')
                        ->where('baran.barang_id', $id)
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