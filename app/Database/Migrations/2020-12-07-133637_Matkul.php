<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Matkul extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_matkul'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'kode_matkul'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 20,
            ],
            'matkul'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
            ],
            'sks'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'kategori'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 20,
            ],
            'smt'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'semester'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
            ],
            'id_prodi'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ]
        ]);
        $this->forge->addKey('id_matkul', true);
        $this->forge->createTable('matkul');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('matkul');
	}
}
