<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
	protected $useTimestamps = true;

	public function cek_login($username, $password)
	{
		return $this->db->table('user')->where([
			'username' => $username,
			'password' => $password
		])->get()->getRowArray();
	}
}