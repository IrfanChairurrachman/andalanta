<?php
  
namespace App\Models;
  
use CodeIgniter\Model;
  
class Auth_model extends Model{
  
    protected $table = "users";
    protected $primaryKey = "id";
  
    public function getLogin($username, $password)
    {
        return $this->db->table($this->table)->where(['username' => $username, 'password' => $password])->get()->getRowArray();
    }

    public function getUser($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }   
    }
    public function updateUser($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }
  
}