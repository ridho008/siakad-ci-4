<?php

namespace App\Models;

use CodeIgniter\Model;

class KrsModel extends Model
{
   protected $table = 'krs';
   protected $primaryKey = 'id_krs';
   protected $allowedFields = ['id_mhs', 'id_jadwal', 'id_ta'];

   public function dataMhs()
   {
      return $this->db->table('mahasiswa')
               ->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi')
               ->join('fakultas', 'fakultas.id_fakultas = prodi.id_fakultas')
               ->join('kelas', 'kelas.id_kelas = mahasiswa.id_kelas', 'left')
               ->join('dosen', 'dosen.id_dosen = kelas.id_dosen', 'left')
               ->where('nim', session()->get('nim'))
               ->orderBy('id_mhs', 'desc')
               ->get()->getRowArray();
   }

   public function daftarMatkul($id_ta, $id_prodi)
   {
      return $this->db->table('jadwal')
               ->join('prodi', 'prodi.id_prodi = jadwal.id_prodi', 'left')
               ->join('kelas', 'kelas.id_kelas = jadwal.id_kelas', 'left')
               ->join('dosen', 'dosen.id_dosen = jadwal.id_dosen', 'left')
               ->join('matkul', 'matkul.id_matkul = jadwal.id_matkul', 'left')
               ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
               ->where('id_ta', $id_ta)
               ->where('jadwal.id_prodi', $id_prodi)
               ->get()->getResultArray();
   }

   public function insertKrs($data)
   {
      $db      = \Config\Database::connect();
      $builder = $db->table('krs')->insert($data);
      // $this->db->table('krs')->insert($data);
   }

   public function getMhsById()
   {
      return $this->db->table('mahasiswa')
            ->where('nim', session()->get('nim'))
            ->get()->getRowArray();
   }

   public function dataKrs($id_mhs, $id_ta)
   {
      return $this->db->table('krs')
            ->join('jadwal', 'jadwal.id_jadwal = krs.id_jadwal', 'left')
            ->join('matkul', 'matkul.id_matkul = jadwal.id_matkul', 'left')
            ->join('kelas', 'kelas.id_kelas = jadwal.id_kelas', 'left')
            ->join('dosen', 'dosen.id_dosen = jadwal.id_dosen', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->join('tahun_akademik', 'tahun_akademik.id_ta = jadwal.id_ta', 'left')
            ->where('id_mhs', $id_mhs)
            ->where('krs.id_ta', $id_ta)
            ->get()->getResultArray();
   }
}