<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Fakultas extends Migration
{
	public function up()
	{
		$this->forge->addField([
                'id_fakultas'          => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'unsigned'       => true,
                        'auto_increment' => true,
                ],
                'fakultas'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                ]
        ]);
        $this->forge->addKey('id_fakultas', true);
        $this->forge->createTable('fakultas');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('fakultas');
	}
}
