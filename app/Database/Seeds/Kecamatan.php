<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kecamatan extends Seeder
{
	public function run()
	{
		//
		$kecamatan_data = [
			[
				'kecamatan_name'   => 'Biring Kanaya',
			],
			[
				'kecamatan_name'   => 'Bontoala',
			],
			[
				'kecamatan_name'   => 'Kepulauan Sangkarrang',
			],
			[
				'kecamatan_name'   => 'Makassar',
			],
			[
				'kecamatan_name'   => 'Mamajang',
			],
			[
				'kecamatan_name'   => 'Manggala',
			],
			[
				'kecamatan_name'   => 'Mariso',
			],
			[
				'kecamatan_name'   => 'Panakkukang',
			],
			[
				'kecamatan_name'   => 'Rappocini',
			],
			[
				'kecamatan_name'   => 'Tallo',
			],
			[
				'kecamatan_name'   => 'Tamalanrea',
			],
			[
				'kecamatan_name'   => 'Tamalate',
			],
			[
				'kecamatan_name'   => 'Ujung Pandang',
			],
			[
				'kecamatan_name'   => 'Ujung Tanah',
			],
			[
				'kecamatan_name'   => 'Wajo',
			]
		];
		foreach($kecamatan_data as $data){
			// insert semua data ke tabel
			$this->db->table('kecamatan')->insert($data);
		}
	}
}
