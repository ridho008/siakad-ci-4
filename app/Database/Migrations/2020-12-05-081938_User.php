<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
                'id_user'          => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'unsigned'       => true,
                        'auto_increment' => true,
                ],
                'nama_user'       => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 50,
                ],
                'username' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 30,
                ],
                'password' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 255,
                ],
                'foto_user' => [
                        'type'           => 'VARCHAR',
                        'constraint'     => 255,
                ],
                'role' => [
                        'type'           => 'INT',
                        'constraint'     => 5,
                        'null' => true
                ]
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('user');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
