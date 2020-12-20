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
		// jika ada session kembalikan ke dashboard
		if(session()->get('role') == 1) {
			return redirect()->to('/');
		}
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
			'role' => [
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

		$role = $this->request->getVar('role');
		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');
		
		if($role == 1) {
			$user = $this->authModel->cek_login($username, sha1($password));
			if($user) {
				// set session
				session()->set('username', $user['username']);
				session()->set('nama', $user['nama_user']);
				session()->set('role', $role);
				session()->set('foto', $user['foto_user']);
				return redirect()->to('/admin/dashboard');
			} else {
				session()->setFlashdata('pesan', 'Username/Password Salah!');
				return redirect()->to('/auth');
			}
			/*
			1 = admin
			2 = dosen
			3 = mahasiswa
			*/
			// if($user['role'] == 1) {
			// } else if($user['role'] == 2) {
			// 	return redirect()->to('/user');
			// } else if($user['role'] == 3) {
			// 	return redirect()->to('/mahasiswa');
			// }
		} else if($role == 2) {
			$dosen = $this->authModel->cek_login_dosen($username, sha1($password));
			if($dosen) {
				// set session
				session()->set('nidn', $dosen['nidn']);
				session()->set('nama', $dosen['nama_dosen']);
				session()->set('role', $role);
				session()->set('foto', $dosen['foto_dosen']);
				return redirect()->to('/dosen');
			} else {
				session()->setFlashdata('pesan', 'Username/Password Dosen Salah!');
				return redirect()->to('/auth');
			}
		} else if($role == 3) {
			$mahasiswa = $this->authModel->cek_login_mahasiswa($username, sha1($password));
			if($mahasiswa) {
				// set session
				session()->set('nim', $mahasiswa['nim']);
				session()->set('nama', $mahasiswa['nama_mhs']);
				session()->set('role', $role);
				session()->set('foto', $mahasiswa['foto_mhs']);
				return redirect()->to('/mahasiswa');
			} else {
				session()->setFlashdata('pesan', 'Username/Password Mahasiswa Salah!');
				return redirect()->to('/auth');
			}
		}
	}

	public function logout()
	{
		session()->remove('username');
		session()->remove('nama');
		session()->remove('role');
		session()->remove('foto');

		session()->remove('nim');
		session()->remove('nidn');
		session()->remove('kode');
		session()->setFlashdata('berhasil', 'Berhasil Logout.');
			return redirect()->to('/auth');
	}

	//--------------------------------------------------------------------

}
