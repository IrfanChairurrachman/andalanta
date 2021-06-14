<?php namespace App\Models;
use CodeIgniter\Model;
  
class Pesanan_model extends Model
{
    protected $table = 'kecamatan';
      
    public function getPesanan($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['pesanan_resi' => $id]);
        }   
    }
    public function insertPesanan($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updatePesanan($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['Pesanan_resi' => $id]);
    }
    public function deletePesanan($id)
    {
        return $this->db->table($this->table)->delete(['kecamatan_resi' => $id]);
    }
}
?>