<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $admin = [
		'username'          => 'required',
		'password'         => 'required',
	];
	 
	public $admin_errors = [
		'username'  => [
			'required'  => 'Username wajib diisi.'
		],
		'password' => [
			'required'  => 'Password wajib diisi.'
		],
	];

	public $pesanan = [
		'pesanan_nama'    => 'required',
		'pesanan_toko'    => 'required',
		'pesanan_kontak'  => 'required',
		'pesanan_alamat'  => 'required',
		'kecamatan_id'    => 'required',
		'pesanan_resi'    => 'required',
		'pesanan_sosmed'  => 'required',
	];

	public $pesanan_errors = [
		'username'  => [
			'required'  => 'Username wajib diisi.'
		],
		'password' => [
			'required'  => 'Password wajib diisi.'
		],
		'username'  => [
			'required'  => 'Username wajib diisi.'
		],
		'password' => [
			'required'  => 'Password wajib diisi.'
		],
		'username'  => [
			'required'  => 'Username wajib diisi.'
		],
		'password' => [
			'required'  => 'Password wajib diisi.'
		],
	];
}
