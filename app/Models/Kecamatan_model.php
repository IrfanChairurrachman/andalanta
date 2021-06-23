<?php namespace App\Models;
use CodeIgniter\Model;
  
class Kecamatan_model extends Model
{
    protected $table = 'kecamatan';
      
    public function getKecamatan($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['kecamatan_id' => $id]);
        }   
    }
    public function insertKecamatan($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updateKecamatan($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['kecamatan_id' => $id]);
    }
    public function deleteKecamatan($id)
    {
        return $this->db->table($this->table)->delete(['kecamatan_id' => $id]);
    }
    public function getGrafik()
    {
        $query = $this->db->query("SELECT MONTHNAME(created_at) as month, COUNT(barang_id) as total FROM barang GROUP BY MONTHNAME(created_at) ORDER BY MONTH(created_at)");
        $hasil = [];
        if(!empty($query)){
            foreach($query->getResultArray() as $data) {
                $hasil[] = $data;
            }
        }
        return $hasil;
    }
}
?>