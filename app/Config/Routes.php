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

// LOGIN ROUTE
$routes->get('login', 'Login::index');
$routes->post('login/proses', 'Login::proses');
$routes->get('/logout', 'Login::logout', ['filter' => 'ceklogin']);

// ADMIN ROUTE
$routes->get('admin', 'Home::admin', ['filter' => 'ceklogin']);
$routes->get('kurir', 'Kurir::index', ['filter' => 'ceklogin']);
$routes->post('kurir/jemput', 'Kurir::update', ['filter' => 'ceklogin']);
$routes->get('kurir/pesanan/(:num)', 'Kurir::show/$1', ['filter' => 'ceklogin']);
$routes->get('kurir/pesanan/proses/(:num)', 'Kurir::proses/$1', ['filter' => 'ceklogin']);
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
