<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
	public function run()
	{
		//
		$user_data = [
			[
				'username'     => 'admin',
				'name'   => 'Mamank Admin',
				'password' => 'admin123',
				'role' => 'Admin',
			],
			[
				'username'     => 'mangujang',
				'name'   => 'Mamank Ujang',
				'password' => 'ujang123',
				'role' => 'Kurir',
				'kode' => 'MU',
			]
		];
		foreach($user_data as $data){
			// insert semua data ke tabel
			$this->db->table('users')->insert($data);
		}
	}
}
