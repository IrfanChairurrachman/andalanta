<?php namespace App\Models;
use CodeIgniter\Model;
  
class Settings_model extends Model
{
    protected $table = 'settings';
      
    public function getSetting($id = false)
    {
        if($id === false){
            return $this->table('settings')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('settings')
                        ->where('setting_id', $id)
                        ->get()
                        ->getRowArray();
        }   
    }

    public function updateSetting($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['setting_id' => $id]);
    }

}
?>