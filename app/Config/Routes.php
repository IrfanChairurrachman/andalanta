<?php

namespace Config;

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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('pesanan/store', 'Home::store');
$routes->post('pesanan/resi', 'Home::cekResi');

// LOGIN ROUTE
$routes->get('login', 'Login::index');
$routes->post('login/proses', 'Login::proses');
$routes->get('/logout', 'Login::logout', ['filter' => 'ceklogin']);

// ADMIN ROUTE
$routes->get('admin', 'Home::admin', ['filter' => 'ceklogin']);
$routes->post('admin', 'Home::adminpost', ['filter' => 'ceklogin']);
$routes->get('admin/pesanan', 'Admin::pesanan', ['filter' => 'ceklogin']);
$routes->post('admin/pesanan', 'Admin::pesananpost', ['filter' => 'ceklogin']);
$routes->get('admin/pesanan/create', 'Admin::create_pesanan', ['filter' => 'ceklogin']);
$routes->get('admin/pesanan/(:num)', 'Admin::show/$1', ['filter' => 'ceklogin']);
$routes->get('admin/pesanan/edit/(:num)', 'Admin::edit_pesanan/$1', ['filter' => 'ceklogin']);
$routes->post('admin/pesanan/update', 'Admin::update_pesanan', ['filter' => 'ceklogin']);
$routes->get('admin/pesanan/delete/(:num)', 'Admin::delete_pesanan/$1', ['filter' => 'ceklogin']);
$routes->post('admin/pesanan/export', 'Admin::export_pesanan', ['filter' => 'ceklogin']);

$routes->get('admin/barang', 'Admin::barang', ['filter' => 'ceklogin']);
$routes->post('admin/barang', 'Admin::barangpost', ['filter' => 'ceklogin']);
$routes->get('admin/barang/create', 'Admin::create_barang', ['filter' => 'ceklogin']);
$routes->get('admin/barang/(:num)', 'Admin::show_barang/$1', ['filter' => 'ceklogin']);
$routes->get('admin/barang/edit/(:num)', 'Admin::edit_barang/$1', ['filter' => 'ceklogin']);
$routes->post('admin/barang/update', 'Admin::update_barang', ['filter' => 'ceklogin']);
$routes->get('admin/barang/delete/(:num)', 'Admin::delete_barang/$1', ['filter' => 'ceklogin']);
$routes->post('admin/barang/export', 'Admin::export_barang', ['filter' => 'ceklogin']);

$routes->get('admin/settings', 'Admin::settings', ['filter' => 'ceklogin']);
$routes->get('admin/kurir/(:num)', 'Admin::show_kurir/$1', ['filter' => 'ceklogin']);
$routes->post('admin/kurir/(:num)', 'Admin::show_kurir_post/$1', ['filter' => 'ceklogin']);
$routes->get('admin/kurir/create', 'Admin::create_kurir', ['filter' => 'ceklogin']);
$routes->post('admin/store', 'Admin::store_user', ['filter' => 'ceklogin']);
$routes->get('admin/kurir/edit/(:num)', 'Admin::edit_kurir/$1', ['filter' => 'ceklogin']);
$routes->post('admin/kurir/update', 'Admin::update_kurir', ['filter' => 'ceklogin']);

$routes->get('admin/create', 'Admin::create_admin', ['filter' => 'ceklogin']);
$routes->get('admin/settings/(:num)', 'Admin::show_admin/$1', ['filter' => 'ceklogin']);
$routes->get('admin/settings/edit/(:num)', 'Admin::edit_admin/$1', ['filter' => 'ceklogin']);
$routes->get('admin/settings/delete/(:num)', 'Admin::delete_user/$1', ['filter' => 'ceklogin']);
$routes->get('admin/setting', 'Admin::edit_setting', ['filter' => 'ceklogin']);
$routes->post('admin/setting/update', 'Admin::update_setting', ['filter' => 'ceklogin']);


// KURIR ROUTE
$routes->get('kurir', 'Kurir::index', ['filter' => 'ceklogin']);
$routes->post('kurir/jemput', 'Kurir::update', ['filter' => 'ceklogin']);
$routes->get('kurir/pesanan/(:num)', 'Kurir::show/$1', ['filter' => 'ceklogin']);
$routes->get('kurir/pesanan/proses/(:num)', 'Kurir::proses/$1', ['filter' => 'ceklogin']);

$routes->post('kurir/barang/store', 'Kurir::store', ['filter' => 'ceklogin']);
$routes->get('kurir/barang', 'Kurir::barang', ['filter' => 'ceklogin']);
$routes->post('kurir/barang/update', 'Kurir::update_barang', ['filter' => 'ceklogin']);
$routes->get('kurir/barang/show/(:num)', 'Kurir::show_barang/$1', ['filter' => 'ceklogin']);

$routes->group('mazer', ['namespace' => 'App\Controllers\Mazer'], function($routes) {
	$routes->get('/', 'Mazer::index');
	$routes->get('table', 'Table::index');
	$routes->get('datatable', 'Table::datatable');

	$routes->group('components', function($routes) {
		$routes->get('alert', 'Component::alert');
		$routes->get('badge', 'Component::badge');
		$routes->get('breadcrumb', 'Component::breadcrumb');
		$routes->get('button', 'Component::button');
		$routes->get('card', 'Component::card');
		$routes->get('carousel', 'Component::carousel');
		$routes->get('dropdown', 'Component::dropdown');
		$routes->get('list-group', 'Component::listGroup');
		$routes->get('modal', 'Component::modal');
		$routes->get('navs', 'Component::navs');
		$routes->get('pagination', 'Component::pagination');
		$routes->get('progress', 'Component::progress');
		$routes->get('spinner', 'Component::spinner');
		$routes->get('tooltip', 'Component::tooltip');
	});

	$routes->group('extra', function($routes) {
		$routes->group('components', function($routes) {
			$routes->get('avatar', 'Component::extra_avatar');
			$routes->get('sweet-alert', 'Component::extra_sweetAlert');
			$routes->get('toastify', 'Component::extra_toastify');
			$routes->get('rating', 'Component::extra_rating');
			$routes->get('divider', 'Component::extra_divider');
		});
	});

	$routes->group('layouts', function($routes) {
		$routes->get('default', 'Layout::default');
		$routes->get('1-column', 'Layout::oneColumn');
		$routes->get('vertical-navbar', 'Layout::verticalNavbar');
		$routes->get('horizontal', 'Layout::horizontal');
	});

	$routes->group('forms', function($routes) {
		$routes->get('input', 'Form::input');
		$routes->get('input-group', 'Form::inputGroup');
		$routes->get('select', 'Form::select');
		$routes->get('radio', 'Form::radio');
		$routes->get('checkbox', 'Form::checkbox');
		$routes->get('textarea', 'Form::textarea');
		$routes->get('layout', 'Form::layout');

		$routes->group('editor', function($routes) {
			$routes->get('quill', 'Form::editor_quill');
			$routes->get('ckeditor', 'Form::editor_ckeditor');
			$routes->get('summernote', 'Form::editor_summernote');
			$routes->get('tinymce', 'Form::editor_tinymce');
		});
	});

	$routes->group('ui', function($routes) {
		$routes->get('file-uploader', 'Widget::fileUploader');

		$routes->group('widgets', function($routes) {
			$routes->get('chatbox', 'Widget::chatbox');
			$routes->get('pricing', 'Widget::pricing');
			$routes->get('to-do-list', 'Widget::toDoList');
		});

		$routes->group('icons', function($routes) {
			$routes->get('bootstrap-icons', 'Icon::bootstrapIcons');
			$routes->get('fontawesome', 'Icon::fontawesome');
			$routes->get('dripicons', 'Icon::dripicons');
		});

		$routes->group('charts', function($routes) {
			$routes->get('chartjs', 'Chart::chartJs');
			$routes->get('apexcharts', 'Chart::apexCharts');
		});

		$routes->group('maps', function($routes) {
			$routes->get('google-map', 'Map::googleMap');
			$routes->get('jsvector-map', 'Map::jsVectorMap');
		});
	});

	$routes->group('applications', function($routes) {
		$routes->get('email', 'Application::email');
		$routes->get('chat', 'Application::chat');
		$routes->get('gallery', 'Application::gallery');
		$routes->get('checkout', 'Application::checkout');

		$routes->group('auth', function($routes) {
			$routes->get('login', 'Application::auth_login');
			$routes->get('register', 'Application::auth_register');
			$routes->get('forgot-password', 'Application::auth_forgotPassword');
		});

		$routes->group('errors', function($routes) {
			$routes->get('403', 'Application::error_403');
			$routes->get('404', 'Application::error_404');
			$routes->get('500', 'Application::error_500');
		});
	});
});

/*
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
