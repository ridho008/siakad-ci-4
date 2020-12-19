<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalKuliahModel extends Model
{
	protected $table = 'jadwal';
	protected $primaryKey = 'id_jadwal';
	protected $allowedFields = ['id_prodi', 'id_ta', 'id_kelas', 'id_matkul', 'id_dosen', 'hari', 'waktu', 'id_ruangan', 'quota'];

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
            ->join('kelas', 'kelas.id_kelas = jadwal.id_kelas', 'left')
            ->where('jadwal.id_prodi', $id_prodi)
            ->orderBy('matkul.smt', 'asc')
            ->get()->getResultArray();
   }

   public function matkul($id_prodi)
   {
      return $this->db->table('matkul')
               ->where('id_prodi', $id_prodi)
               ->orderBy('matkul.smt', 'asc')
               ->get()->getResultArray();
   }

   public function kelas($id_prodi)
   {
      return $this->db->table('kelas')
               ->where('id_prodi', $id_prodi)
               ->orderBy('nama_kelas', 'asc')
               ->get()->getResultArray();
   }

	public function search($keyword)
	{
		return $this->table('dosen')->like('kode_dosen', $keyword)->orLike('nidn', $keyword)->orLike('nama_dosen', $keyword);
	}
}