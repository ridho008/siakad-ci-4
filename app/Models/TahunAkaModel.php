<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAkaModel extends Model
{
	protected $table = 'tahun_akademik';
	protected $primaryKey = 'id_ta';
	protected $allowedFields = ['tahun_aka', 'semester', 'status'];

	public function search($keyword)
	{
		return $this->table('tahun_akademik')->like('tahun_aka', $keyword)->orLike('semester', $keyword);
	}

   public function activeStatus($data, $id_ta)
   {
      $db      = \Config\Database::connect();
      $builder = $db->table('tahun_akademik');
      $builder->set('status', 1);
      $builder->where('id_ta', $id_ta);
      $builder->update($data);
   }

   public function resetStatus()
   {
      $this->db->table('tahun_akademik')->update(['status' => null]);
   }
}