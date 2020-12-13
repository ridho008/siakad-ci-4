<?php namespace App\Controllers;

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
		$currentPage = $this->request->getVar('page_dosen') ? $this->request->getVar('page_dosen') : 1;

		$keyword = $this->request->getVar('keyword');
		if($keyword) {
			$dosen = $this->dosenModel->search($keyword);
		} else {
			$dosen = $this->dosenModel;
		}

		$data = [
			'title' => 'Dosen',
			'dosen' => $dosen->paginate(2, 'dosen'),
			'pager' => $this->dosenModel->pager,
			'currentPage' => $currentPage,
			'validation' => \Config\Services::validation()
		];
		return view('admin/dosen/index', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'kode' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'nidn' => [
				'rules' => 'required|is_unique[dosen.nidn]',
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
		// dd($foto);
		// generate nama foto
		$generateFoto = $foto->getRandomName();
		// pindahkan ke folder
		$foto->move('img/dosen', $generateFoto);

		$this->dosenModel->save([
			'kode_dosen' => $this->request->getVar('kode'),
			'nidn' => $this->request->getVar('nidn'),
			'nama_dosen' => $this->request->getVar('nama'),
			'foto_dosen' => $generateFoto,
			'password' => sha1($this->request->getVar('password'))
		]);

		session()->setFlashdata('success', 'Data Dosen Berhasil Ditambahkan.');
		return redirect()->to('/admin/dosen');
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
		$dosen = $this->dosenModel->find($id);
		if($dosen['foto_dosen'] != 'default.jpg') {
			unlink('img/dosen/' . $dosen['foto_dosen']);
		}
		$this->dosenModel->delete($id);
		session()->setFlashdata('success', 'Data Dosen Berhasil Dihapus.');
		return redirect()->to('/admin/dosen');
	}

	//--------------------------------------------------------------------

}
