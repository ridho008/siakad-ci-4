<?php namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

class Mahasiswa extends BaseController
{
	protected $mahasiswaModel;
	protected $prodiModel;

	public function __construct()
	{
		$this->mahasiswaModel = new MahasiswaModel();
		$this->prodiModel = new ProdiModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Mahasiswa',
			'mahasiswa' => $this->mahasiswaModel->joinMhsProdi(),
			'prodi' => $this->prodiModel->findAll(),
			'validation' => \Config\Services::validation()
		];
		return view('admin/mahasiswa/index', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'nim' => [
				'rules' => 'required|is_unique[mahasiswa.nim]',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.',
					'is_unique' => '{field} sudah terdaftar.'
				]
			],
			'prodi' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'foto' => [
				'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]|ext_in[foto,png,jpg,gif]'
			]
		])) {
			return redirect()->to('/admin/mahasiswa')->withInput();
		}

		// upload foto
		$foto = $this->request->getFile('foto');
		// dd($foto);
		// generate nama foto
		$generateFoto = $foto->getRandomName();
		// pindahkan ke folder
		$foto->move('img/mahasiswa', $generateFoto);

		$this->mahasiswaModel->save([
			'nim' => $this->request->getVar('nim'),
			'password' => sha1($this->request->getVar('password')),
			'nama_mhs' => $this->request->getVar('nama'),
			'id_prodi' => $this->request->getVar('prodi'),
			'foto_mhs' => $generateFoto,
		]);

		session()->setFlashdata('success', 'Data Mahasiswa Berhasil Ditambahkan.');
		return redirect()->to('/admin/mahasiswa');
	}

	public function update($id)
	{
		if(!$this->validate([
			'nim' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.',
					'is_unique' => '{field} sudah terdaftar.'
				]
			],
			'prodi' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'foto' => [
				'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg]|is_image[foto]|ext_in[foto,png,jpg,gif]'
			]
		])) {
			return redirect()->to('/admin/mahasiswa')->withInput();
		}

		// upload foto
		$foto = $this->request->getFile('foto');
		if($foto->getError() == 4) {
			$namaFoto = $this->request->getVar('fotoLama');
		} else {
			// generate nama foto
			$namaFoto = $foto->getRandomName();
			// pindahkan ke folder
			$foto->move('img/mahasiswa', $namaFoto);
			// hapus foto
			unlink('img/mahasiswa/' . $this->request->getVar('fotoLama'));
		}

		$this->mahasiswaModel->save([
			'id_mhs' => $this->request->getVar('id_mhs'),
			'nim' => $this->request->getVar('nim'),
			'password' => sha1($this->request->getVar('password')),
			'nama_mhs' => $this->request->getVar('nama'),
			'id_prodi' => $this->request->getVar('prodi'),
			'foto_mhs' => $namaFoto,
		]);

		session()->setFlashdata('success', 'Data Mahasiswa Berhasil Diedit.');
		return redirect()->to('/admin/mahasiswa');
	}

	public function destroy($id)
	{
		$mhs = $this->mahasiswaModel->find($id);
		if($mhs['foto_mhs']) {
			unlink('img/mahasiswa/' . $mhs['foto_mhs']);
		}
		$this->mahasiswaModel->delete($id);
		session()->setFlashdata('success', 'Data Mahasiswa Berhasil Dihapus.');
		return redirect()->to('/admin/mahasiswa');
	}

	//--------------------------------------------------------------------

}
