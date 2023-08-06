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

// base Setting  
$routes->post('/hero_contact', 'HeroContent::storeKontak',['filter' => 'authGuard']);
$routes->post('/hero_profile', 'HeroContent::storeHeroContent',['filter' => 'authGuard']);
$routes->post('/hero_media', 'HeroContent::storeSocialMedia',['filter' => 'authGuard']);
$routes->post('/hero_media', 'HeroContent::storeSocialMedia',['filter' => 'authGuard']);
$routes->get('/hero_content', 'HeroContent::index',['filter' => 'authGuard']);
$routes->post('/hero_media_delete', 'HeroContent::deleteSocialMedia',['filter' => 'authGuard']);
$routes->post('/hero_media_edit', 'HeroContent::editSocialMedia',['filter' => 'authGuard']);


//icon
$routes->get('/icon', 'Icon::index',['filter' => 'authGuard']);
$routes->post('/icon_store', 'Icon::store',['filter' => 'authGuard']);
$routes->post('/icon_edit', 'Icon::edit',['filter' => 'authGuard']);
$routes->post('/icon_delete', 'Icon::delete',['filter' => 'authGuard']);
// visi misi
$routes->get('/visi_misi', 'VisiMisi::index',['filter' => 'authGuard']);
$routes->post('/visi_store', 'VisiMisi::storeVisi',['filter' => 'authGuard']);
$routes->post('/misi_store', 'VisiMisi::storeMisi',['filter' => 'authGuard']);
$routes->post('/visi_misi_edit', 'VisiMisi::edit',['filter' => 'authGuard']);
$routes->post('/visi_misi_delete', 'VisiMisi::delete',['filter' => 'authGuard']);

//partner
$routes->get('/partner', 'Partner::index',['filter' => 'authGuard']);
$routes->post('/partner_store', 'Partner::store',['filter' => 'authGuard']);
$routes->get('/partner_edit/(:num)', 'Partner::edit/$1',['filter' => 'authGuard']);
$routes->post('/partner_update', 'Partner::update',['filter' => 'authGuard']);
$routes->post('/partner_delete', 'Partner::delete',['filter' => 'authGuard']);

//kerjasama
$routes->get('/kerjasama', 'KerjasamaMitra::index',['filter' => 'authGuard']);
$routes->post('/kerjasama_store', 'KerjasamaMitra::store',['filter' => 'authGuard']);
$routes->get('/kerjasama_edit/(:num)', 'KerjasamaMitra::edit/$1',['filter' => 'authGuard']);
$routes->post('/kerjasama_update', 'KerjasamaMitra::update',['filter' => 'authGuard']);
$routes->post('/kerjasama_delete', 'KerjasamaMitra::delete',['filter' => 'authGuard']);
$routes->post('/status_edit', 'KerjasamaMitra::statusUpdate',['filter' => 'authGuard']);

//testimonial
$routes->get('/testimonial', 'Testimonial::index',['filter' => 'authGuard']);
$routes->post('/testimonial_store', 'Testimonial::store',['filter' => 'authGuard']);
$routes->get('/testimonial_edit/(:num)', 'Testimonial::edit/$1',['filter' => 'authGuard']);
$routes->post('/testimonial_update', 'Testimonial::update',['filter' => 'authGuard']);
$routes->post('/testimonial_delete', 'Testimonial::delete',['filter' => 'authGuard']);

//kegiatanpelatihan
$routes->get('/kegiatan_pelatihan', 'KegiatanPelatihan::index',['filter' => 'authGuard']);
$routes->post('/kegiatan_pelatihan_store', 'KegiatanPelatihan::store',['filter' => 'authGuard']);
$routes->get('/kegiatan_pelatihan_edit/(:num)', 'KegiatanPelatihan::edit/$1',['filter' => 'authGuard']);
$routes->post('/kegiatan_pelatihan_update', 'KegiatanPelatihan::update',['filter' => 'authGuard']);
$routes->post('/kegiatan_pelatihan_delete', 'KegiatanPelatihan::delete',['filter' => 'authGuard']);

//berita
$routes->get('/berita', 'Berita::index',['filter' => 'authGuard']);
$routes->post('/berita_store', 'Berita::store',['filter' => 'authGuard']);
$routes->post('/berita_delete', 'Berita::delete',['filter' => 'authGuard']);
$routes->get('/berita_edit/(:num)', 'Berita::edit/$1',['filter' => 'authGuard']);
$routes->post('/berita_update', 'Berita::update',['filter' => 'authGuard']);
$routes->post('/berita_upload', 'Berita::uploadGambar',['filter' => 'authGuard']);
$routes->post('/berita_gambar_delete', 'Berita::deleteGambar',['filter' => 'authGuard']);
$routes->get('/berita_create', 'Berita::create',['filter' => 'authGuard']);


//pejabat
$routes->get('/pejabat', 'Pejabat::index',['filter' => 'authGuard']);
$routes->post('/pejabat_store', 'Pejabat::store',['filter' => 'authGuard']);
$routes->get('/pejabat_edit/(:num)', 'Pejabat::edit/$1',['filter' => 'authGuard']);
$routes->post('/pejabat_update', 'Pejabat::update',['filter' => 'authGuard']);
$routes->post('/pejabat_delete', 'Pejabat::delete',['filter' => 'authGuard']);









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
