<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/login', 'Auth::index');
$routes->post('/loginProcess', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

// Pages
// $routes->get('/', 'Home::index');             // Halaman utama

$routes->group('', ['filter' => 'auth'], function ($routes) {
    // Routes yang memerlukan autentikasi (login) ditempatkan di sini

    $routes->get('/', 'Pages::index');             // Halaman utama
    $routes->get('/pages', 'Pages::index');         // Halaman pages
    $routes->get('/pages/about', 'Pages::about');   // Halaman about
    $routes->get('/pages/contact', 'Pages::contact'); // Halaman contact

    // untuk kirim pesan dari form contact
    $routes->post('/pages/contact', 'Pages::kirimPesan');
    $routes->post('/pages/contact/kirim', 'Pages::kirimPesan');


    // Komik (CRUD)
    $routes->get('/komik', 'Komik::index');                 // Tampil daftar komik

    $routes->get('/komik/create', 'Komik::create');             // Form tambah komik
    $routes->post('/komik/save', 'Komik::save');                // Simpan komik baru
    $routes->get('/komik/edit/(:segment)', 'Komik::edit/$1');   // Form edit komik
    $routes->post('/komik/update/(:num)', 'Komik::update/$1');  // Simpan perbaikan komik
    $routes->delete('/komik/(:num)', 'Komik::delete/$1');       // Hapus komik
    $routes->get('/komik/(:segment)', 'Komik::detail/$1');      // Tampil detail komik


    //profil (CRUD)
    $routes->get('/profil', 'Profil::index');                 // Tampil profil

    $routes->get('/profil/create', 'Profil::create');             // Form tambah profil
    $routes->post('/profil/save', 'Profil::save');               // Simpan profil baru
    $routes->get('/profil/edit/(:num)', 'Profil::edit/$1');     // Form edit profil
    $routes->put('/profil/update/(:num)', 'Profil::update/$1'); // Simpan perbaikan profil
    $routes->delete('/profil/(:num)', 'Profil::delete/$1');       // Hapus profil   
});
