<?php namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;

class Dosen extends BaseController
{
   protected $dosenModel;

   public function __construct()
   {
      $this->dosenModel = new DosenModel();
   }

   public function index()
   {
      $data = [
         'title' => 'Dashboard Dosen'
      ];
      return view('dosen/index', $data);
   }

   public function jadwalMengajar()
   {
      $data = [
         'title' => 'Jadwal Mengajar',
         'jadwal' => $this->dosenModel->jadwalDosen()
      ];
      return view('dosen/jadwal_mengajar', $data);
   }

   public function absenKelas()
   {
      $data = [
         'title' => 'Absen Kelas',
         'absen' => $this->dosenModel->jadwalDosen()
      ];
      return view('dosen/absen_kelas', $data);
   }

   public function absensi()
   {
      $id_jadwal = $this->request->getVar('id_jadwal');
      $jadwal = $this->dosenModel->detailJadwal($id_jadwal);
      $data = [
         'title' => 'Absensi Kelas ' . $jadwal['nama_kelas']. ' ' . $jadwal['tahun_aka'],
         'jadwal' => $jadwal,
         'mhs' => $this->dosenModel->getMhsById($id_jadwal)
      ];
      return view('dosen/absensi', $data);
   }

   //--------------------------------------------------------------------

}
