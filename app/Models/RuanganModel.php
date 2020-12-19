<?php

namespace App\Models;

use CodeIgniter\Model;

class RuanganModel extends Model
{
	protected $table = 'ruangan';
	protected $primaryKey = 'id_ruangan';
	protected $allowedFields = ['ruangan', 'id_gedung'];

	public function get_join()
	{
		return $this->table('ruangan')
			 ->join("gedung", "gedung.id_gedung = ruangan.id_gedung")
			 ->orderBy("gedung.id_gedung", 'asc')
			 ->get()->getResultArray();
	}

	public function getTable($table)
	{
		return $this->db->table($table);
	}

	public function countRuangan()
   {
      return $this->db->table('ruangan')
               ->countAllResults();
   }
}