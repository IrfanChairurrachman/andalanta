<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pesanan extends Migration
{
	public function up()
	{
		//
		$this->db->enableForeignKeyChecks();
        $this->forge->addField([
            'pesanan_id'            => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ],
            'kecamatan_id'          => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => TRUE,
                'null'              => TRUE,
            ],
            'pesanan_name'          => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
			'pesanan_toko'          => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
			'pesanan_kontak'          => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
			'pesanan_alamat'   => [
				'type'              => 'TEXT',
				'null'              => TRUE,
			],
			'pesanan_resi'          => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'pesanan_status'        => [
                'type'              => 'ENUM',
                'constraint'        => "'Jemput','On Process','Sukses'",
                'default'           => 'Jemput'
            ],
			'pesanan_sosmed'          => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'kurir_id'          => [
				'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => TRUE,
                'null'              => TRUE,
            ],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('pesanan_id', TRUE);
        $this->forge->addForeignKey('kecamatan_id','kecamatan','kecamatan_id','CASCADE','CASCADE');
        $this->forge->addForeignKey('kurir_id','users','id','CASCADE','CASCADE');
        $this->forge->createTable('pesanan');
	}

	public function down()
	{
		//
		$this->forge->dropTable('pesanan');
	}
}
