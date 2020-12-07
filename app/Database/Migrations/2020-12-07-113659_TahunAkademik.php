<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TahunAkademik extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_ta'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'tahun_aka'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 10,
            ],
            'semester'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 20,
            ]
        ]);
        $this->forge->addKey('id_ta', true);
        $this->forge->createTable('tahun_akademik');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tahun_akademik');
	}
}
