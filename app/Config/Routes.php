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
$routes->get('/', 'Home::index');

$routes->add('login-admin', 'Auth::viewLoginAdmin');
$routes->add('login', 'Auth::login');

$routes->group('admin',['filter' => 'adminlogin'], function($page){
	$page->add('/', 'Admin\Dashboard::index');
	$page->add('logout', 'Auth::adminLogout');
	$page->group('kategori', function($links){
		$links->add('/', 'Admin\Kategori::index');
		$links->add('tambah', 'Admin\Kategori::formInsert');
		$links->add('edit/(:num)', 'Admin\Kategori::formUpdate/$1');
		$links->add('hapus/(:num)', 'Admin\Kategori::hapus/$1');
		$links->add('aksi', 'Admin\Kategori::aksi');
	});
	$page->group('menu', function($links){
		$links->add('/', 'Admin\Menu::index');
		$links->add('tambah', 'Admin\Menu::formInsert');
		$links->add('edit/(:num)', 'Admin\Menu::formUpdate/$1');
		$links->add('hapus/(:num)', 'Admin\Menu::hapus/$1');
		$links->add('aksi', 'Admin\Menu::aksi');
	});
	$page->group('user', function($links){
		$links->add('/', 'Admin\User::index');
		$links->add('tambah', 'Admin\User::formInsert');
		$links->add('ubah-password', 'Admin\User::formUbahPassword');
		$links->add('aksi', 'Admin\User::aksi');
		$links->add('status/(:num)/(:num)', 'Admin\User::ubahStatus/$1/$2');
		$links->add('hapus/(:num)/(:num)', 'Admin\User::hapus/$1/$2');
	});
});

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
