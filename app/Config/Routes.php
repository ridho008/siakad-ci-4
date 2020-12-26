<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', function() {
   echo "<h1>Selamat Datang Di Aplikasi SIAKAD CI4</h1>";
});

$routes->get('/admin/dashboard', 'Dashboard::index');
$routes->get('/admin/fakultas', 'Fakultas::index');
$routes->get('/admin/gedung', 'Gedung::index');
$routes->get('/admin/ruangan', 'Ruangan::index');
$routes->get('/admin/prodi', 'Prodi::index');
$routes->get('/admin/tahunaka', 'TahunAka::index');
$routes->get('/admin/matkul', 'Matkul::index');
$routes->get('/admin/user', 'User::index');
$routes->get('/admin/dosen', 'Dosen::index');
$routes->get('/admin/mahasiswa', 'Mahasiswa::index');
$routes->get('/admin/kelas', 'Kelas::index');
$routes->get('/admin/jadwal', 'JadwalKuliah::index');
$routes->get('/setting/tahunaka', 'TahunAka::settings');

// Dashboard Dosen
$routes->get('/dosen', 'Dosen/Dosen::index');

// Dashboard Mahasiswa
$routes->get('/mahasiswa', 'Mahasiswa/Mahasiswa::index');
$routes->get('/mahasiswa/krs', 'Mahasiswa/Krs::index');
$routes->add('/krs/create', 'Mahasiswa/Krs::tambahmatkul');
$routes->get('/krs/delete', 'Mahasiswa/Krs::destroy');
$routes->get('/krs/print', 'Mahasiswa/Krs::print');
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
