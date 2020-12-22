<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Krs extends Migration
{
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
