<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ruangan extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_ruangan'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'id_gedung'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'ruangan'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 20,
            ]
        ]);
        $this->forge->addKey('id_ruangan', true);
        $this->forge->createTable('ruangan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('ruangan');
	}
}
