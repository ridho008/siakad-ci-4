<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAkaModel extends Model
{
	protected $table = 'tahun_akademik';
	protected $primaryKey = 'id_ta';
	protected $allowedFields = ['tahun_aka', 'semester'];

	public function search($keyword)
	{
		return $this->table('tahun_akademik')->like('tahun_aka', $keyword)->orLike('semester', $keyword);
	}
}