<?php namespace App\Controllers;
 
use App\Models\Auth_model;
class Login extends BaseController
{
 
    public function __construct() {
        $this->auth = new Auth_model;
    }
 
    public function index()
    {
        return view('v_login');
    }
     
    public function proses()
    {
        $username = htmlspecialchars($this->request->getPost('username'));
        $password = htmlspecialchars($this->request->getPost('password'));
        $role = htmlspecialchars($this->request->getPost('role'));
 
        $cek_login = $this->auth->getLogin($username, $password, $role);

        if($role == 'Admin' && !empty($cek_login)){
            // dd($cek_login);
            echo "Masuk admin";
        }
        elseif($role == 'Kurir' && !empty($cek_login)){
            // dd($cek_login);
            echo "Masuk Kurir";
        }
        if(!empty($cek_login)){
 
            session()->set("id", $cek_login['id']);
            session()->set("username", $cek_login['username']);
            session()->set("password", $cek_login['password']);

            if($role == 'Admin'){
                return redirect()->to('/admin');
            } elseif($role == 'Kurir'){
                return redirect()->to('/kurir');
            }
 
        } else {
 
            return redirect()->to('/login');
         
        }
         
    }
     
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
 
}