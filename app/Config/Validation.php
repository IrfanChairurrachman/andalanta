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
		'pesanan_name'    => 'required',
		'pesanan_toko'    => 'required',
		'pesanan_kontak'  => 'required',
		'pesanan_alamat'  => 'required',
		'kecamatan_id'    => 'required',
		'pesanan_sosmed'  => 'required',
	];

	public $pesanan_errors = [
		'pesanan_name'  => [
			'required'  => 'Nama wajib diisi.'
		],
		'pesanan_toko' => [
			'required'  => 'Toko wajib diisi.'
		],
		'pesanan_kontak'  => [
			'required'  => 'Kontak wajib diisi.'
		],
		'pesanan_alamat' => [
			'required'  => 'Alamat wajib diisi.'
		],
		'kecamatan_id'  => [
			'required'  => 'Kecamatan wajib diisi.'
		],
		'pesanan_sosmed' => [
			'required'  => 'Sosmed wajib diisi.'
		],
	];

	public $barang = [
		'barang_name'    => 'required',
		'barang_kode'    => 'required',
		'barang_harga'  => 'required',
		'barang_ongkir'  => 'required',
		'kecamatan_id'    => 'required',
	];

	public $barang_errors = [
		'barang_name'  => [
			'required'  => 'Nama wajib diisi.'
		],
		'barang_kode' => [
			'required'  => 'Kode wajib diisi.'
		],
		'barang_harga'  => [
			'required'  => 'Harga barang wajib diisi.'
		],
		'barang_ongkir' => [
			'required'  => 'Ongkir barang wajib diisi.'
		],
		'kecamatan_id'  => [
			'required'  => 'Kecamatan wajib diisi.'
		],
	];

	public $barang_update = [
		'barang_status'    => 'required',
	];

	public $barang_update_errors = [
		'barang_status'  => [
			'required'  => 'Status wajib diisi.'
		],
	];
	
}
