<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
{
	public function up()
   {
     $this->forge->addField([
            'id_jadwal'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'id_prodi'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'id_ta'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'id_kelas'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'id_matkul'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'id_dosen'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'hari'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
                    'null' => true
            ],
            'waktu'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
                    'null' => true
            ],
            'id_ruangan'       => [
                    'type'           => 'INT',
                    'constraint'     => 10,
                    'null' => true
            ],
            'quota'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'null' => true
            ]
        ]);
        $this->forge->addKey('id_jadwal', true);
        $this->forge->createTable('jadwal');
   }

   //--------------------------------------------------------------------

   public function down()
   {
      $this->forge->dropTable('jadwal');
   }
}
