<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
	public function up()
   {
     $this->forge->addField([
            'id_kelas'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'nama_kelas'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
            ],
            'id_prodi'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'id_dosen'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'tahun_angkatan'       => [
                    'type'           => 'INT',
                    'constraint'     => 10,
                    'null' => true
            ]
        ]);
        $this->forge->addKey('id_kelas', true);
        $this->forge->createTable('kelas');
   }

   //--------------------------------------------------------------------

   public function down()
   {
      $this->forge->dropTable('kelas');
   }
}
