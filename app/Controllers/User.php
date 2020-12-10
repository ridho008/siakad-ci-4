<?php namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
	protected $gedungModel;

	public function __construct()
	{
		$this->userModel = new UserModel();
	}

	public function index()
	{
		$data = [
			'title' => 'User',
			'user' => $this->userModel->findAll(),
			'validation' => \Config\Services::validation()
		];
		return view('admin/user/index', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'username' => [
				'rules' => 'required|is_unique[user.username]',
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
			return redirect()->to('/admin/user')->withInput();
		}

		// upload foto
		$foto = $this->request->getFile('foto');
		// dd($foto);
		// generate nama foto
		$generateFoto = $foto->getRandomName();
		$foto->move('img/user', $generateFoto);

		$this->userModel->save([
			'nama_user' => $this->request->getVar('nama'),
			'username' => $this->request->getVar('username'),
			'password' => sha1($this->request->getVar('password')),
			'foto_user' => $generateFoto,
			'role' => 2
		]);

		session()->setFlashdata('success', 'Data User Berhasil Ditambahkan.');
		return redirect()->to('/admin/user');
	}

	public function update($id)
	{
		if(!$this->validate([
			'gedung' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/gedung')->withInput();
		}

		$this->gedungModel->save([
			'id_gedung' => $this->request->getVar('id_gedung'),
			'gedung' => $this->request->getVar('gedung')
		]);

		session()->setFlashdata('success', 'Data Gedung Berhasil Diedit.');
		return redirect()->to('/gedung');
	}

	public function delete($id)
	{
		$this->gedungModel->delete($id);
		session()->setFlashdata('success', 'Data Gedung Berhasil Dihapus.');
		return redirect()->to('/gedung');
	}

	//--------------------------------------------------------------------

}
