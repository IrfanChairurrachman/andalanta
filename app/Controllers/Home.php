<?php

namespace App\Controllers;
use App\Models\Kecamatan_model;

class Home extends BaseController
{
	protected $helpers = [];
 
    public function __construct()
    {
        helper(['form']);
        $this->kecamatan_model = new Kecamatan_model();
    }

	public function index()
	{
		$data['kecamatan'] = $this->kecamatan_model->getKecamatan();
		return view('index', $data);
	}

	public function admin()
	{
		return view('dashboard');
	}

	public function kurir()
	{
		return view('kurir/index');
	}

	
}
