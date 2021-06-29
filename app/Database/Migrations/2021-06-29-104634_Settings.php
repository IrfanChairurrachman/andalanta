<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Settings extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
            'setting_id'           => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ],
            'setting_name'          => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
			'setting_status'       => [
                'type'              => 'ENUM',
                'constraint'        => "'Open','Close'",
                'default'           => 'Open'
            ],
			'setting_image'         => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
			'setting_contact'       => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
			'setting_link'       => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
        ]);
		$this->forge->addKey('setting_id', TRUE);
        $this->forge->createTable('settings');
	}

	public function down()
	{
		//
		$this->forge->dropTable('settings');
	}
}
