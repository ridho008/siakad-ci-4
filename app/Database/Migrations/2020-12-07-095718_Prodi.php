<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Prodi extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_prodi'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'id_fakultas'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'kode_prodi'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 20,
            ],
            'prodi'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
            ],
            'jenjang'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
            ],
            'ketua_prodi'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
            ]
        ]);
        $this->forge->addKey('id_prodi', true);
        $this->forge->createTable('prodi');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('prodi');
	}
}
