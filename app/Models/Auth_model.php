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

    public function insertUser($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function getUser($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->table('users')
                        ->where('users.id', $id)
                        ->get()
                        ->getRowArray();
        }   
    }
    public function updateUser($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }

    public function deleteUser($id)
    {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }
}