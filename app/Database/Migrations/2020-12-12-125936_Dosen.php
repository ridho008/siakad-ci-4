<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dosen extends Migration
{
	public function up()
   {
      $this->forge->addField([
            'id_dosen'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'kode_dosen'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 20,
            ],
            'nidn'       => [
                    'type'           => 'INT',
                    'constraint'     => 20,
            ],
            'nama_dosen'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
            ],
            'foto_dosen'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 255,
            ],
            'password'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 255,
            ]
        ]);
        $this->forge->addKey('id_dosen', true);
        $this->forge->createTable('dosen');
   }

   //--------------------------------------------------------------------

   public function down()
   {
      $this->forge->dropTable('dosen');
   }
}
