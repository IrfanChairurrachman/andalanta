<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kecamatan extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
            'kecamatan_id'          => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ],
            'kecamatan_name'        => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
		]);
        $this->forge->addKey('kecamatan_id', TRUE);
        $this->forge->createTable('kecamatan');
	}

	public function down()
	{
		//
		$this->forge->dropTable('kecamatan');
	}
}
