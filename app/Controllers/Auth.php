<?php namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
	protected $authModel;

	public function __construct()
	{
		$this->authModel = new AuthModel();
	}

	public function index()
	{
		$data = [
			'validation' => \Config\Services::validation()
		];
		return view('auth/login', $data);
	}

	public function login()
	{
		if(!$this->validate([
			'username' => [
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
			]
		])) {
			return redirect()->to('/auth')->withInput();
		}

		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');
		$user = $this->authModel->cek_login($username, sha1($password));
		
		if($user) {
			// set session
			session()->set('log', true);
			session()->set('username', $user['username']);
			session()->set('nama_user', $user['nama_user']);
			session()->set('role', $user['role']);
			session()->set('foto', $user['foto_user']);
			/*
			1 = admin
			2 = dosen
			3 = mahasiswa
			*/
			if($user['role'] == 1) {
				return redirect()->to('/');
			} else if($user['role'] == 2) {
				return redirect()->to('/user');
			} else if($user['role'] == 3) {
				return redirect()->to('/dosen');
			}
		} else {
			session()->setFlashdata('pesan', 'Username/Password Salah!');
			return redirect()->to('/auth');
		}
	}

	public function logout()
	{
		session()->remove('log');
		session()->remove('username');
		session()->remove('nama_user');
		session()->remove('role');
		session()->remove('foto');
		session()->setFlashdata('berhasil', 'Berhasil Logout.');
			return redirect()->to('/auth');
	}

	//--------------------------------------------------------------------

}
