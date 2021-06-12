<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
	public function up()
	{
		//
		$this->db->enableForeignKeyChecks();
        $this->forge->addField([
            'barang_id'            => [
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
			'pesanan_id'          => [
				'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => TRUE,
                'null'              => TRUE,
            ],
			'barang_kode'          => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
            'barang_name'          => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
			'barang_harga'          => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
			'barang_ongkir'          => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'barang_status'        => [
                'type'              => 'ENUM',
                'constraint'        => "'Antar','Sukses','Tunda','Cancel'",
            ],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('barang_id', TRUE);
        $this->forge->addForeignKey('kecamatan_id','kecamatan','kecamatan_id','CASCADE','CASCADE');
		$this->forge->addForeignKey('pesanan_id','pesanan','pesanan_id','CASCADE','CASCADE');
        $this->forge->createTable('barang');
	}

	public function down()
	{
		//
		$this->forge->dropTable('barang');
	}
}
