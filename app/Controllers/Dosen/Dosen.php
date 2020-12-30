<?php namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\JadwalKuliahModel;

class Dosen extends BaseController
{
   protected $dosenModel;
   protected $jadwalKuliahModel;

   public function __construct()
   {
      $this->dosenModel = new DosenModel();
      $this->jadwalKuliahModel = new JadwalKuliahModel();
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
      $ta = $this->jadwalKuliahModel->tahunAktif();
      $data = [
         'title' => 'Jadwal Mengajar',
         'jadwal' => $this->dosenModel->jadwalDosen($ta['id_ta']),
         'tahunAktif' => $ta
      ];
      return view('dosen/jadwal_mengajar', $data);
   }

   public function absenKelas()
   {
      $ta = $this->jadwalKuliahModel->tahunAktif();
      $data = [
         'title' => 'Absen Kelas',
         'tahunAktif' => $ta,
         'absen' => $this->dosenModel->jadwalDosen($ta['id_ta']),
      ];
      return view('dosen/absenKelas/absen_kelas', $data);
   }

   public function absensi()
   {
      // dd($id_jadwal);
      $ta = $this->jadwalKuliahModel->tahunAktif();
      $id_jadwal = $this->request->getVar('id_jadwal');
      $jadwal = $this->dosenModel->detailJadwal($id_jadwal);
      $data = [
         'title' => 'Absensi Kelas ' . $jadwal['nama_kelas']. ' ' . $jadwal['tahun_aka'],
         'tahunAktif' => $this->jadwalKuliahModel->tahunAktif(),
         'jadwal' => $jadwal,
         'mhs' => $this->dosenModel->getMhsById($id_jadwal),
         'validation' => \Config\Services::validation()
      ];
      return view('dosen/absenKelas/absensi', $data);
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
            'p18' => $this->request->getVar($value['id_krs'] . 'p18')
         ];
         $this->dosenModel->simpanAbsensi($data);
      }
      session()->setFlashdata('success', 'Data Absensi Berhasil Diperbarui.');
      return redirect()->to('/dosen/absen');
   }

   public function print_absensi()
   {
      $id_jadwal = $this->request->getVar('id_jadwal');
      $jadwal = $this->dosenModel->detailJadwal($id_jadwal);
      $data = [
         'title' => 'Print Absensi',
         'jadwal' => $jadwal,
         'mhs' => $this->dosenModel->getMhsById($id_jadwal),
         'validation' => \Config\Services::validation()
      ];
      return view('dosen/absenKelas/print_absensi', $data);
   }

   // Menu Nilai Mahasiswa
   public function nilaiMhs()
   {
      $ta = $this->jadwalKuliahModel->tahunAktif();
      $data = [
         'title' => 'Nilai Mahasiswa',
         'tahunAktif' => $ta,
         'absen' => $this->dosenModel->jadwalDosen($ta['id_ta']),
      ];
      return view('dosen/nilaiMahasiswa/nilai_mahasiswa', $data);
   }

   public function dataNilai()
   {
      $ta = $this->jadwalKuliahModel->tahunAktif();
      $id_jadwal = $this->request->getVar('id_jadwal');
      $jadwal = $this->dosenModel->detailJadwal($id_jadwal);
      $data = [
         'title' => 'Data Nilai ' . $jadwal['nama_kelas']. ' ' . $jadwal['tahun_aka'],
         'tahunAktif' => $this->jadwalKuliahModel->tahunAktif(),
         'jadwal' => $jadwal,
         'mhs' => $this->dosenModel->getMhsById($id_jadwal),
         'validation' => \Config\Services::validation()
      ];
      return view('dosen/nilaiMahasiswa/data_nilai', $data);
   }

   public function simpanNilai()
   {
      $id_jadwal = $this->request->getVar('id_jadwal');
      $mhs = $this->dosenModel->getMhsById($id_jadwal);
      foreach ($mhs as $key => $value) {
         $abs = $this->request->getVar('nilai_absen' . $value['id_krs']);
         $tugas = $this->request->getVar('nilai_tugas' . $value['id_krs']);
         $uts = $this->request->getVar('nilai_uts' . $value['id_krs']);
         $uas = $this->request->getVar('nilai_uas' . $value['id_krs']);
         // na = nilai akhir
         $na = ($abs * 15 / 100) * ($tugas * 15 / 100) * ($uts * 30 / 100) * ($uas * 40 / 100);
         // nh = nilai huruf
         if($na >= 85) :
            $nh = "A";
         elseif ($na < 85 && $na >= 75 ) :
            $nh = "B";
         elseif ($na < 75 && $na >= 65 ) :
            $nh = "C";
         elseif ($na < 65 && $na >= 55 ) :
            $nh = "D";
         else :
            $nh = "E";
         endif;
         $data = [
            'id_krs' => $this->request->getVar('id_krs' . $value['id_krs']),
            'nilai_absen' => $this->request->getVar('nilai_absen' . $value['id_krs']),
            'nilai_tugas' => $this->request->getVar('nilai_tugas' . $value['id_krs']),
            'nilai_uts' => $this->request->getVar('nilai_uts' . $value['id_krs']),
            'nilai_uas' => $this->request->getVar('nilai_uas' . $value['id_krs']),
            'nilai_akhir' => number_format($na,0),
            'nilai_huruf' => $nh
         ];
         $this->dosenModel->simpanAbsensi($data);
      }
      session()->setFlashdata('success', 'Data Nilai Mahasiswa Berhasil Disimpan.');
      return redirect()->to('/dosen/nilaimhs');
   }

   public function printNilai()
   {
      $id_jadwal = $this->request->getVar('id_jadwal');
      $jadwal = $this->dosenModel->detailJadwal($id_jadwal);
      $data = [
         'title' => 'Print Nilai Mahasiswa',
         'tahunAktif' => $this->jadwalKuliahModel->tahunAktif(),
         'jadwal' => $jadwal,
         'mhs' => $this->dosenModel->getMhsById($id_jadwal)
      ];
      return view('dosen/nilaiMahasiswa/print_nilai', $data);
   }

   //--------------------------------------------------------------------

}
