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
		return $this->table('dosen')->like('kode_dosen', $keyword)->orLike('nidn', $keyword)->orLike('nama_dosen', $keyword);
	}

   public function jadwalDosen()
   {
      return $this->db->table('jadwal')
            ->join('matkul', 'matkul.id_matkul = jadwal.id_matkul', 'left')
            ->join('prodi', 'prodi.id_prodi = jadwal.id_prodi', 'left')
            ->join('dosen', 'dosen.id_dosen = jadwal.id_dosen', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->join('kelas', 'kelas.id_kelas = jadwal.id_kelas', 'left')
            ->join('tahun_akademik', 'tahun_akademik.id_ta = jadwal.id_ta', 'left')
            ->where('dosen.nidn', session()->get('nidn'))
            ->get()->getResultArray();
   }

   public function detailJadwal($id_jadwal)
   {
      return $this->db->table('jadwal')
            ->join('matkul', 'matkul.id_matkul = jadwal.id_matkul', 'left')
            ->join('prodi', 'prodi.id_prodi = jadwal.id_prodi', 'left')
            ->join('dosen', 'dosen.id_dosen = jadwal.id_dosen', 'left')
            ->join('kelas', 'kelas.id_kelas = jadwal.id_kelas', 'left')
            ->join('tahun_akademik', 'tahun_akademik.id_ta = jadwal.id_ta', 'left')
            ->join('fakultas', 'fakultas.id_fakultas = prodi.id_fakultas', 'left')
            ->where('jadwal.id_jadwal', $id_jadwal)
            ->get()->getRowArray();
   }

   public function getMhsById($id_jadwal)
   {
      return $this->db->table('krs')
            ->join('mahasiswa', 'mahasiswa.id_mhs = krs.id_mhs', 'left')
            ->where('krs.id_jadwal', $id_jadwal)
            ->get()->getResultArray();
   }
}