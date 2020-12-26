<?php namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\JadwalKuliahModel;
use App\Models\KrsModel;

class Mahasiswa extends BaseController
{
   protected $jadwalKuliahModel;
   protected $krsModel;

   public function __construct()
   {
      $this->jadwalKuliahModel = new JadwalKuliahModel();
      $this->krsModel = new KrsModel();
   }

   public function index()
   {
      $data = [
         'title' => 'Dashboard Mahasiswa'
      ];
      return view('mahasiswa/index', $data);
   }

   public function absensi()
   {
      $mhs = $this->krsModel->getMhsById();
      $ta = $this->jadwalKuliahModel->tahunAktif();
      $data = [
         'title' => 'Absensi Mahasiswa',
         'validation' => \Config\Services::validation(),
         'tahunAka' => $this->jadwalKuliahModel->tahunAktif(),
         'mhs' => $this->krsModel->dataMhs(),
         'matkulMhs' => $this->krsModel->dataKrs($mhs['id_mhs'], $ta['id_ta'])
      ];
      return view('mahasiswa/absen/index', $data);
   }

   //--------------------------------------------------------------------

}
