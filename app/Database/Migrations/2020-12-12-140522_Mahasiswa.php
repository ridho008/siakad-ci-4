<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
   public function up()
   {
	  $this->forge->addField([
            'id_mhs'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'nim'       => [
                    'type'           => 'INT',
                    'constraint'     => 20,
            ],
            'password'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 255,
            ],
            'nama_mhs'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
            ],
            'id_prodi'       => [
                    'type'           => 'INT',
                    'constraint'     => 10,
            ],
            'foto_mhs'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 255,
                    'null' => true
            ],
            'id_kelas'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'null' => true
            ]
        ]);
        $this->forge->addKey('id_mhs', true);
        $this->forge->createTable('mahasiswa');
   }

   //--------------------------------------------------------------------

   public function down()
   {
      $this->forge->dropTable('mahasiswa');
   }
}
