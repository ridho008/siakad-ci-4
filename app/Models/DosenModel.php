<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
	protected $table = 'dosen';
	protected $primaryKey = 'id_dosen';
	protected $allowedFields = ['kode_dosen', 'nidn', 'nama_dosen', 'foto_dosen', 'password'];

	public function search($keyword)
	{
		return $this->table('fakultas')->like('fakultas', $keyword);
	}
}