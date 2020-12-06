<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Gedung extends Migration
{
	public function up()
	{
		$this->forge->addField([
                'id_gedung'          => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'unsigned'       => true,
                        'auto_increment' => true,
                ],
                'gedung'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                ]
        ]);
        $this->forge->addKey('id_gedung', true);
        $this->forge->createTable('gedung');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('gedung');
	}
}
