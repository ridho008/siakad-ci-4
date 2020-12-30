<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Krs extends Migration
{
  // public $pertemuan = ['p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15', 'p16', 'p17', 'p18'];
	public function up()
   {
     $this->forge->addField([
            'id_krs'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'id_mhs'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'id_jadwal'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'id_ta'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
            ],
            'p1'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p2'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p3'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p4'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p5'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p6'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p7'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p8'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p9'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p10'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p11'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p12'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p13'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p14'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p15'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p16'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p17'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'p18'       => [
                    'type'           => 'INT',
                    'constraint'     => 1,
                    'null' => true
            ],
            'nilai_absen'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'null' => true,
                    'default' => 0
            ],
            'nilai_tugas'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'null' => true,
                    'default' => 0
            ],
            'nilai_uts'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'null' => true,
                    'default' => 0
            ],
            'nilai_uas'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'null' => true,
                    'default' => 0
            ],
            'nilai_akhir'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'null' => true,
                    'default' => 0
            ],
            'nilai_huruf'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 11,
                    'null' => true,
                    'default' => '-'
            ],
            'bobot'       => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'null' => true,
                    'default' => 0
            ]
        ]);
        $this->forge->addKey('id_krs', true);
        $this->forge->createTable('krs');
   }

   //--------------------------------------------------------------------

   public function down()
   {
      $this->forge->dropTable('krs');
   }
}
