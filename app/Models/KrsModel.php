<?php

namespace App\Models;

use CodeIgniter\Model;

class KrsModel extends Model
{
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
}