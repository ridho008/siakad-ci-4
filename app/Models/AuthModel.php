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

   public function cek_login_dosen($username, $password)
   {
      return $this->db->table('dosen')->where([
         'nidn' => $username,
         'password' => $password
      ])->get()->getRowArray();
   }

   public function cek_login_mahasiswa($username, $password)
   {
      return $this->db->table('mahasiswa')->where([
         'nim' => $username,
         'password' => $password
      ])->get()->getRowArray();
   }
}