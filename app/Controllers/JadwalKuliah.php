<?php namespace App\Controllers;

use App\Models\JadwalKuliahModel;
use App\Models\TahunAkaModel;
use App\Models\ProdiModel;
use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\RuanganModel;

class JadwalKuliah extends BaseController
{
	protected $jadwalkuliahModel;
	protected $tahunAkaModel;
	protected $prodiModel;
	protected $dosenModel;
	protected $kelasModel;
	protected $ruanganModel;

	public function __construct()
	{
		$this->jadwalkuliahModel = new JadwalKuliahModel();
		$this->tahunAkaModel = new TahunAkaModel();
		$this->prodiModel = new ProdiModel();
		$this->dosenModel = new DosenModel();
		$this->kelasModel = new KelasModel();
		$this->ruanganModel = new RuanganModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Jadwal Kuliah',
			'validation' => \Config\Services::validation(),
			'tahunAkademik' => $this->jadwalkuliahModel->tahunAktif(),
			'prodi' => $this->prodiModel->joinProdiFakultas()
		];
		return view('admin/jadwal_kuliah/index', $data);
	}

	public function detail($id_prodi)
	{
		$data = [
			'title' => 'Jadwal Kuliah',
			'validation' => \Config\Services::validation(),
			'tahunAkademik' => $this->jadwalkuliahModel->tahunAktif(),
			'jadwal' => $this->jadwalkuliahModel->joinJadwalMatkul($id_prodi),
			'prodi' => $this->prodiModel->joinProdiFakultasWhereId($id_prodi),
			'matkul' => $this->jadwalkuliahModel->matkul($id_prodi),
			'dosen' => $this->dosenModel->findAll(),
			'kelas' => $this->jadwalkuliahModel->kelas($id_prodi),
			'ruangan' => $this->ruanganModel->findAll()
		];
		return view('admin/jadwal_kuliah/detail', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'matkul' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'kelas' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'dosen' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'hari' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'waktu' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'ruangan' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'quota' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/jadwalKuliah/detail/' . $this->request->getVar('id_prodi'))->withInput();
		}

		$this->jadwalkuliahModel->save([
			'id_prodi' => $this->request->getVar('id_prodi'),
			'id_ta' => $this->request->getVar('id_ta'),
			'id_kelas' => $this->request->getVar('kelas'),
			'id_matkul' => $this->request->getVar('matkul'),
			'id_dosen' => $this->request->getVar('dosen'),
			'hari' => $this->request->getVar('hari'),
			'waktu' => $this->request->getVar('waktu'),
			'id_ruangan' => $this->request->getVar('ruangan'),
			'quota' => $this->request->getVar('quota')
		]);

		session()->setFlashdata('success', 'Data Jadwal Kuliah Berhasil Ditambahkan.');
		return redirect()->to('/jadwalKuliah/detail/' . $this->request->getVar('id_prodi'));
	}

	public function destroy($id_jadwal)
	{
		$this->jadwalkuliahModel->delete($id_jadwal);
		session()->setFlashdata('success', 'Data Jadwal Kuliah Berhasil Dihapus.');
		return redirect()->to('/jadwalKuliah/detail/' . $this->request->getVar('id_prodi'));
	}

	//--------------------------------------------------------------------

}
