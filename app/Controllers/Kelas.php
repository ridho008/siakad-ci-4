<?php namespace App\Controllers;

use App\Models\KelasModel;
use App\Models\ProdiModel;
use App\Models\DosenModel;

class Kelas extends BaseController
{
	protected $dosenModel;

	public function __construct()
	{
		$this->kelasModel = new KelasModel();
		$this->prodiModel = new ProdiModel();
		$this->dosenModel = new DosenModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Kelas',
			'kelas' => $this->kelasModel->joinKelas()->get()->getResultArray(),
			'prodi' => $this->prodiModel->findAll(),
			'dosen' => $this->dosenModel->findAll(),
			'validation' => \Config\Services::validation()
		];
		return view('admin/kelas/index', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'kelas' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'prodi' => [
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
			'tahun' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.',
					'is_unique' => '{field} sudah terdaftar.'
				]
			]
		])) {
			return redirect()->to('/admin/kelas')->withInput();
		}

		$this->kelasModel->save([
			'nama_kelas' => $this->request->getVar('kelas'),
			'id_prodi' => $this->request->getVar('prodi'),
			'id_dosen' => $this->request->getVar('dosen'),
			'tahun_angkatan' => $this->request->getVar('tahun')
		]);

		session()->setFlashdata('success', 'Data Kelas Berhasil Ditambahkan.');
		return redirect()->to('/admin/kelas');
	}

	public function update($id)
	{
		if(!$this->validate([
			'kode' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'nidn' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.',
					'is_unique' => '{field} sudah terdaftar.'
				]
			],
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.',
					'is_unique' => '{field} sudah terdaftar.'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'foto' => [
				'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg]|is_image[foto]|ext_in[foto,png,jpg,gif]'
			]
		])) {
			return redirect()->to('/admin/dosen')->withInput();
		}

		// upload foto
		$foto = $this->request->getFile('foto');
		if($foto->getError() == 4) {
			$namaFoto = $this->request->getVar('fotoLama');
		} else {
			// generate nama foto
			$namaFoto = $foto->getRandomName();
			// pindahkan ke folder
			$foto->move('img/dosen', $namaFoto);
			// hapus foto
			unlink('img/dosen/' . $this->request->getVar('fotoLama'));
		}

		$this->dosenModel->save([
			'id_dosen' => $this->request->getVar('id_dosen'),
			'kode_dosen' => $this->request->getVar('kode'),
			'nidn' => $this->request->getVar('nidn'),
			'nama_dosen' => $this->request->getVar('nama'),
			'foto_dosen' => $namaFoto,
			'password' => sha1($this->request->getVar('password'))
		]);

		session()->setFlashdata('success', 'Data Dosen Berhasil Diedit.');
		return redirect()->to('/admin/dosen');
	}

	public function destroy($id)
	{
		$this->kelasModel->delete($id);
		session()->setFlashdata('success', 'Data Kelas Berhasil Dihapus.');
		return redirect()->to('/admin/kelas');
	}

	// Rincian Kelas
	public function mahasiswa($id_kelas)
	{
		$rincianMhs = $this->kelasModel->find($id_kelas);
		$data = [
			'title' => 'Rombongan Kelas ' . $rincianMhs['nama_kelas'],
			'kelas' => $this->kelasModel->joinKelasById($id_kelas),
			'mahasiswa' => $this->kelasModel->getMhsById($id_kelas)->get()->getResultArray(),
			'jml' => $this->kelasModel->getMhsById($id_kelas)->countAllResults(),
			'mhsZero' => $this->kelasModel->getMhsByZero()
		];
		return view('admin/kelas/kelas_mahasiswa', $data);
	}

	public function deletemhs($id_mhs)
	{
		$this->kelasModel->deleteMhsById($id_mhs);
		session()->setFlashdata('success', 'Data Mahasiswa Berhasil Dihapus.');
		return redirect()->to('/kelas/mahasiswa/' . $id_mhs);
	}

	public function savemhs($id_mhs)
	{
		$data = [
			'id_mhs' => $id_mhs,
			'id_kelas' => $this->request->getVar('id_kelas')
		];
		$this->kelasModel->upByIdKelas($data);
		session()->setFlashdata('success', 'Data Mahasiswa Berhasil Dihapus.');
		return redirect()->to('/kelas/mahasiswa/' . $id_mhs);
	}

	//--------------------------------------------------------------------

}
