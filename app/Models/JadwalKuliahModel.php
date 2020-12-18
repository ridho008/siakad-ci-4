<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalKuliahModel extends Model
{
	protected $table = 'jadwal_kuliah';
	protected $primaryKey = 'id_jadwal';
	protected $allowedFields = [];

   public function tahunAktif()
   {
      return $this->db->table('tahun_akademik')
               ->where('status', 1)->get()->getRowArray();
   }

   public function joinJadwalMatkul($id_prodi)
   {
      return $this->db->table('jadwal')
            ->join('matkul', 'matkul.id_matkul = jadwal.id_matkul', 'left')
            ->join('prodi', 'prodi.id_prodi = jadwal.id_prodi', 'left')
            ->join('dosen', 'dosen.id_dosen = jadwal.id_dosen', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->where('jadwal.id_prodi', $id_prodi)
            ->orderBy('matkul.smt', 'asc')
            ->get()->getResultArray();
   }

	public function search($keyword)
	{
		return $this->table('dosen')->like('kode_dosen', $keyword)->orLike('nidn', $keyword)->orLike('nama_dosen', $keyword);
	}
}