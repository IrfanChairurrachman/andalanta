<?php namespace App\Controllers;
 
use App\Models\Auth_model;
class Login extends BaseController
{
 
    public function __construct() {
        $this->auth = new Auth_model;
    }
 
    public function index()
    {
        $data['title'] = "Login Andalanta";
        return view('login', $data);
    }
     
    public function proses()
    {
        $username = htmlspecialchars($this->request->getPost('username'));
        $password = htmlspecialchars($this->request->getPost('password'));
 
        $cek_login = $this->auth->getLogin($username, $password);

        if(!empty($cek_login)){
 
            session()->set("id", $cek_login['id']);
            session()->set("username", $cek_login['username']);
            session()->set("password", $cek_login['password']);
            session()->set("role", $cek_login['role']);

            if($cek_login['role'] == 'Admin'){
                return redirect()->to(base_url('admin'));
            } elseif($cek_login['role'] == 'Kurir'){
                return redirect()->to(base_url('kurir'));
            }
 
        } else {
 
            return redirect()->to(base_url('login'));
         
        }
         
    }
     
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
 
}