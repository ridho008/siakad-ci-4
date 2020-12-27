<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
	protected $table = 'mahasiswa';
	protected $primaryKey = 'id_mhs';
	protected $allowedFields = ['nim', 'password', 'nama_mhs', 'id_prodi', 'foto_mhs'];

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

   public function countMhs()
   {
      return $this->db->table('mahasiswa')
               ->countAllResults();
   }

   public function updateFoto($foto)
   {
      $db      = \Config\Database::connect();
      $builder = $db->table('mahasiswa');
      $builder->set('foto_mhs', $foto);
      $builder->where('nim', session()->get('nim'));
      $builder->update();
   }
}