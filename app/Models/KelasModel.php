<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
	protected $table = 'kelas';
	protected $primaryKey = 'id_kelas';
	protected $allowedFields = ['nama_kelas', 'id_prodi', 'id_dosen', 'tahun_angkatan'];

   public function joinKelas()
   {
      return $this->db->table('kelas')
               ->join('prodi', 'prodi.id_prodi = kelas.id_prodi')
               ->join('dosen', 'dosen.id_dosen = kelas.id_dosen')
               ->orderBy('kelas.id_kelas', 'desc');
   }

   public function joinKelasById($id_kelas)
   {
      return $this->db->table('kelas')
               ->join('prodi', 'prodi.id_prodi = kelas.id_prodi')
               ->where('kelas.id_kelas', $id_kelas)
               ->get()->getRowArray();
   }

   public function getMhsById($id_kelas)
   {
      return $this->db->table('mahasiswa')
               ->join('kelas', 'kelas.id_kelas = mahasiswa.id_kelas')
               ->where('kelas.id_kelas', $id_kelas)
               ->orderBy('id_mhs', 'desc');
   }

   public function getMhsByZero()
   {
      return $this->db->table('mahasiswa')
               ->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi')
               ->where('mahasiswa.id_kelas', null)
               ->orderBy('id_mhs', 'desc')
               ->get()->getResultArray();
   }

   public function deleteMhsById($id_mhs)
   {
      $db      = \Config\Database::connect();
      $builder = $db->table('mahasiswa');
      $builder->set('id_kelas', null);
      $builder->where('id_mhs', $id_mhs);
      $builder->update();
   }

   public function upByIdKelas($data)
   {
      $db      = \Config\Database::connect();
      $builder = $db->table('mahasiswa');
      $builder->where('id_mhs', $data['id_mhs']);
      $builder->update($data);
   }

	public function search($keyword)
	{
		return $this->table('dosen')->like('kode_dosen', $keyword)->orLike('nidn', $keyword)->orLike('nama_dosen', $keyword);
	}
}