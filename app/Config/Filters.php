<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	// Makes reading things below nicer,
	// and simpler to change out script that's used.
	public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
		'adminfilter' => \App\Filters\AdminFilter::class,
		'dosenfilter' => \App\Filters\DosenFilter::class,
		'mahasiswafilter' => \App\Filters\MahasiswaFilter::class
	];

	// Always applied before every request
	public $globals = [
		// sebelum login tidak bisa mengakses controller, wajib login dulu.
		'before' => [
			'adminfilter' => ['except' => [
				'/',
				'auth', 'auth/*'
			]],
			'dosenfilter' => ['except' => [
				'/',
				'auth', 'auth/*'
			]],
			'mahasiswafilter' => ['except' => [
				'/',
				'auth', 'auth/*'
			]]
			//'honeypot'
			// 'csrf',
		],
		// setelah login, kamu tidak bisa mengakses auth/halaman login
		'after'  => [
			'adminfilter' => ['except' => [
				'admin/dashboard', 'dashboard/*',
				'admin/dosen', 'dosen/*',
				'admin/fakultas', 'fakultas/*',
				'admin/prodi', 'prodi/*',
				'admin/gedung', 'gedung/*',
				'admin/ruangan', 'ruangan/*',
				'admin/tahunaka', 'tahunAka/*',
				'admin/matkul', 'matkul/*',
				'admin/kelas', 'kelas/*',
				'admin/jadwal', 'jadwalKuliah/*',
				'admin/mahasiswa', 'mahasiswa/*',
				'admin/user', 'user/*',
				'setting/tahunaka', 'tahunAka/*'
			]],
			'dosenfilter' => ['except' => [
				'dosen', 'dosen/dosen/*',
				'dosen/jadwal', 'dosen/dosen/jadwalMengajar/*',
				'dosen/absen', 'dosen/dosen/absenKelas/*',
				'dosen/absensi', 'dosen/dosen/absensi/*',
				'dosen/saveabsen', 'dosen/dosen/simpanAbsensi/*',
				'dosen/print', 'dosen/dosen/print_absensi/*',
				'dosen/nilaimhs', 'dosen/dosen/nilaiMhs/*',
				'dosen/datanilai', 'dosen/dosen/dataNilai/*',
				'dosen/simpannilai', 'dosen/dosen/simpanNilai/*',
				'dosen/printnilai', 'dosen/dosen/printNilai/*'
			]],
			'mahasiswafilter' => ['except' => [
				'mahasiswa', 'mahasiswa/mahasiswa/*',
				'mahasiswa/krs', 'mahasiswa/krs/*',
				'krs/create', 'mahasiswa/krs/tambahmatkul*',
				'krs/delete', 'mahasiswa/krs/destroy/*',
				'krs/print', 'mahasiswa/krs/print/*',
				'mahasiswa/absensi', 'mahasiswa/mahasiswa/absensi/*',
			]],
			'toolbar',
			//'honeypot'
		],
	];

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
	public $filters = [];
}
