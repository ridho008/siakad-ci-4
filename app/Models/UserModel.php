<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'id_user';
	protected $allowedFields = ['nama_user', 'username', 'password', 'foto_user', 'role'];

	public function search($keyword)
	{
		return $this->table('fakultas')->like('fakultas', $keyword);
	}
}