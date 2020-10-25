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
$routes->get('(:num)', 'Home::index/$1');

$routes->add('login-admin', 'Auth::viewLoginAdmin');
$routes->add('login', 'Auth::login');
$routes->add('registrasi', 'Auth::viewRegistrasiPelanggan');
$routes->add('regist-pelanggan', 'Auth::registerPelanggan');
$routes->add('login-pelanggan', 'Auth::viewLoginPelanggan');

$routes->add('logout-pelanggan', 'Auth::pelangganLogout', ['filter' => 'pelangganlogin']);

$routes->add('tambah-keranjang/(:num)', 'Keranjang::tambahKeranjang/$1', ['filter' => 'pelangganlogin']);
$routes->add('keranjang', 'Keranjang::index', ['filter' => 'pelangganlogin']);
$routes->add('kurang-pesanan/(:num)', 'Keranjang::min/$1', ['filter' => 'pelangganlogin']);
$routes->add('tambah-pesanan/(:num)', 'Keranjang::plus/$1', ['filter' => 'pelangganlogin']);
$routes->add('hapus-pesanan/(:num)', 'Keranjang::remove/$1', ['filter' => 'pelangganlogin']);
$routes->add('proses-pesan', 'Keranjang::prosesPesan', ['filter' => 'pelangganlogin']);
$routes->add('histori-pesan', 'Home::histori', ['filter' => 'pelangganlogin']);

$routes->add('clear', 'Keranjang::clearCart', ['filter' => 'pelangganlogin']);

$routes->group('admin',['filter' => 'adminlogin'], function($page){
	$page->add('/', 'Admin\Dashboard::index');
	$page->add('logout', 'Auth::adminLogout');
	$page->group('kategori',['filter' => 'aksesadmin'], function($links){
		$links->add('/', 'Admin\Kategori::index');
		$links->add('tambah', 'Admin\Kategori::formInsert');
		$links->add('edit/(:num)', 'Admin\Kategori::formUpdate/$1');
		$links->add('hapus/(:num)', 'Admin\Kategori::hapus/$1');
		$links->add('aksi', 'Admin\Kategori::aksi');
	});
	$page->group('menu',['filter' => 'aksesadmin'], function($links){
		$links->add('/', 'Admin\Menu::index');
		$links->add('tambah', 'Admin\Menu::formInsert');
		$links->add('edit/(:num)', 'Admin\Menu::formUpdate/$1');
		$links->add('hapus/(:num)', 'Admin\Menu::hapus/$1');
		$links->add('aksi', 'Admin\Menu::aksi');
	});
	$page->group('pelanggan',['filter' => 'aksesadmin'], function($links){
		$links->add('/', 'Admin\Pelanggan::index');
		$links->add('hapus/(:num)/(:num)', 'Admin\Pelanggan::hapus/$1/$2');
		$links->add('status/(:num)/(:num)', 'Admin\Pelanggan::ubahStatus/$1/$2');
	});
	$page->group('order',['filter' => 'akseskasir'], function($links){
		$links->add('/', 'Admin\Order::index');
		$links->add('bayar/(:num)', 'Admin\Order::formBayar/$1');
		$links->add('proses-bayar', 'Admin\Order::prosesBayar');
	});
	$page->group('orderdetail', function($links){
		$links->add('/', 'Admin\Orderdetail::index');
	});
	$page->group('user',['filter' => 'aksesadmin'], function($links){
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
