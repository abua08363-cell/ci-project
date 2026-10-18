<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ==========================================
// 1. PUBLIC ROUTES (Halaman Utama & Login)
// ==========================================

// Alur 1: Halaman Utama Portofolio (Akses: http://localhost:8080/)
$routes->get('/', 'Home::index');

// Rute Detail Artikel Publik
$routes->get('/article/(:segment)', 'Home::articleDetail/$1');

// Alur 2: Halaman Login (Akses: http://localhost:8080/login)
$routes->get('/login', 'Auth::index');
$routes->post('/loginProcess', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');


// ==========================================
// 2. PROTECTED ROUTES (Harus Login Dulu)
// ==========================================

$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Alur 4: Halaman Dashboard / Pages setelah sukses login (Akses: http://localhost:8080/pages)
    $routes->get('pages', 'Pages::index');
    $routes->get('pages/about', 'Pages::about');
    $routes->get('pages/contact', 'Pages::contact');
    // Form kontak (dipanggil lewat fetch)
    $routes->post('pages/contact/send', 'ContactMessages::send');

    // Halaman admin pesan masuk
    $routes->group('admin', ['filter' => 'auth'], function ($routes) {
        $routes->get('messages', 'ContactMessages::index');
        $routes->post('messages/(:segment)/(:num)', 'ContactMessages::action/$1/$2');
    });

    // Untuk kirim pesan dari form contact
    $routes->post('pages/contact', 'Pages::kirimPesan');
    $routes->post('pages/contact/kirim', 'Pages::kirimPesan');

    // Users (CRUD)
    $routes->get('users', 'Users::index');
    $routes->get('users/create', 'Users::create');
    $routes->post('users/store', 'Users::store');
    $routes->get('users/edit/(:num)', 'Users::edit/$1');
    $routes->post('users/update/(:num)', 'Users::update/$1');
    $routes->post('users/delete/(:num)', 'Users::delete/$1');

    // Profil (CRUD)
    // Profil (CRUD)
    $routes->get('profil', 'Profil::index');
    $routes->get('profil/create', 'Profil::create');
    $routes->post('profil/save', 'Profil::save');
    $routes->get('profil/edit/(:num)', 'Profil::edit/$1');
    $routes->put('profil/(:num)', 'Profil::update/$1');
    $routes->put('profil/update/(:num)', 'Profil::update/$1'); // cadangan, boleh dihapus
    $routes->delete('profil/(:num)', 'Profil::delete/$1');

    // Articles (CRUD) - Menggunakan prefix admin/
    $routes->get('admin/articles', 'Admin\ArticleController::index');
    $routes->get('admin/articles/create', 'Admin\ArticleController::create');
    $routes->post('admin/articles/store', 'Admin\ArticleController::store');
    $routes->get('admin/articles/edit/(:num)', 'Admin\ArticleController::edit/$1');
    $routes->post('admin/articles/update/(:num)', 'Admin\ArticleController::update/$1');
    $routes->post('admin/articles/delete/(:num)', 'Admin\ArticleController::delete/$1');
});
