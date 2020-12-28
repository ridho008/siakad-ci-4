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
      // dd($id_jadwal);
      $id_jadwal = $this->request->getVar('id_jadwal');
      $jadwal = $this->dosenModel->detailJadwal($id_jadwal);
      $data = [
         'title' => 'Absensi Kelas ' . $jadwal['nama_kelas']. ' ' . $jadwal['tahun_aka'],
         'jadwal' => $jadwal,
         'mhs' => $this->dosenModel->getMhsById($id_jadwal),
         'validation' => \Config\Services::validation()
      ];
      return view('dosen/absensi', $data);
   }

   public function simpanAbsensi()
   {
      $id_jadwal = $this->request->getVar('id_jadwal');
      $mhs = $this->dosenModel->getMhsById($id_jadwal);
      foreach ($mhs as $key => $value) {
         $data = [
            'id_krs' => $this->request->getVar('id_krs' . $value['id_krs']),
            'p1' => $this->request->getVar($value['id_krs'] . 'p1'),
            'p2' => $this->request->getVar($value['id_krs'] . 'p2'),
            'p3' => $this->request->getVar($value['id_krs'] . 'p3'),
            'p4' => $this->request->getVar($value['id_krs'] . 'p4'),
            'p5' => $this->request->getVar($value['id_krs'] . 'p5'),
            'p6' => $this->request->getVar($value['id_krs'] . 'p6'),
            'p7' => $this->request->getVar($value['id_krs'] . 'p7'),
            'p8' => $this->request->getVar($value['id_krs'] . 'p8'),
            'p9' => $this->request->getVar($value['id_krs'] . 'p9'),
            'p10' => $this->request->getVar($value['id_krs'] . 'p10'),
            'p11' => $this->request->getVar($value['id_krs'] . 'p11'),
            'p12' => $this->request->getVar($value['id_krs'] . 'p12'),
            'p13' => $this->request->getVar($value['id_krs'] . 'p13'),
            'p14' => $this->request->getVar($value['id_krs'] . 'p14'),
            'p15' => $this->request->getVar($value['id_krs'] . 'p15'),
            'p16' => $this->request->getVar($value['id_krs'] . 'p16'),
            'p17' => $this->request->getVar($value['id_krs'] . 'p17'),
            'p18' => $this->request->getVar($value['id_krs'] . 'p18'),
         ];
         $this->dosenModel->simpanAbsensi($data);
      }
      session()->setFlashdata('success', 'Data Absensi Berhasil Diperbarui.');
      return redirect()->to('/dosen/absen');
   }

   //--------------------------------------------------------------------

}
