<?php

namespace App\Models;

use CodeIgniter\Model;

class GedungModel extends Model
{
	protected $table = 'gedung';
	protected $primaryKey = 'id_gedung';
	protected $allowedFields = ['gedung'];

   public function countGedung()
   {
      return $this->db->table('gedung')
               ->countAllResults();
   }

	public function search($keyword)
	{
		return $this->table('gedung')->like('gedung', $keyword);
	}
}