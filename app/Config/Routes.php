<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->post('login', 'Login::auth');
$routes->get('logout', 'Login::logout');

$routes->add('/home', 'Home::index',['filter' => 'authGuard']);
$routes->get('/dashboard', 'Dashboard::index',['filter' => 'authGuard']);

// contact 
$routes->post('/hero_store', 'HeroContent::storeKontak',['filter' => 'authGuard']);
$routes->get('/hero_content', 'HeroContent::index',['filter' => 'authGuard']);

//icon
$routes->get('/icon', 'Icon::index',['filter' => 'authGuard']);
$routes->post('/icon_store', 'Icon::store',['filter' => 'authGuard']);
$routes->post('/icon_edit', 'Icon::edit',['filter' => 'authGuard']);
$routes->post('/icon_delete', 'Icon::delete',['filter' => 'authGuard']);
// visi misi
$routes->get('/visi_misi', 'VisiMisi::index',['filter' => 'authGuard']);

//kerjasama
$routes->get('/kerja_sama', 'KerjaSama::index',['filter' => 'authGuard']);

//testimonial
$routes->get('/testimonial', 'Testimonial::index',['filter' => 'authGuard']);

//kegiatanpelatihan
$routes->get('/kegiatan_pelatihan', 'KegiatanPelatihan::index',['filter' => 'authGuard']);

//berita
$routes->get('/berita', 'Berita::index',['filter' => 'authGuard']);









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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
