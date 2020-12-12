<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
	protected $table = 'mahasiswa';
	protected $primaryKey = 'id_mhs';
	protected $allowedFields = ['nim', 'nama_mhs', 'id_prodi', 'foto_mhs'];

   public function joinMhsProdi()
   {
      return $this->db->table('mahasiswa')
               ->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi')
               ->orderBy('id_mhs', 'desc')
               ->get()->getResultArray();
   }

	public function search($keyword)
	{
		return $this->table('fakultas')->like('fakultas', $keyword);
	}
}