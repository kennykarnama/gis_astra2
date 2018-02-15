<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/pusher', function() {
    event(new App\Events\ImportLaporanEvent('Hi there Pusher!'));
    return "Event has been sent!";
});

Route::get('/admin/login', ['uses' => 'Auth\AdminLoginController@showLoginForm'])->name('admin.login');

Route::post('/admin/login/submit', ['uses' => 'Auth\AdminLoginController@login'])->name('admin.login.submit');

Route::post('/admin/logout', ['uses' => 'Auth\AdminLoginController@logout'])->name('admin.logout');

Route::get('/', ['uses' => 'Pages\InterfaceController@test_dashboard'])->name('admin.dashboard');

Route::get('/informasi_arho', ['uses' => 'Pages\InformasiArhoController@index'])->name('admin.informasi_arho');

Route::get('/informasi_kecamatan', ['uses' => 'Pages\InformasiKecamatanController@index'])->name('admin.informasi_kecamatan');

Route::get('/informasi_kelurahan', ['uses' => 'Pages\InformasiKelurahanController@index'])->name('admin.informasi_kelurahan');

Route::get('/upload_file', ['uses' => 'Pages\ImportFileController@index'])->name('admin.upload_file');

Route::post('/upload_file/import', ['uses' => 'Pages\ImportFileController@import_excel'])->name('admin.upload_file.import');

Route::get('/visualisasi/umum', ['uses' => 'Pages\VisualisasiDataController@umum'])->name('admin.visualisasi.umum');

Route::post('/visualisasi/umum/fetch_customer_markers', ['uses' => 'Pages\VisualisasiDataController@fetch_customer_markers'])->name('admin.visualisasi.umum.fetch_customer_markers');

Route::get('/laporan/status_customer', ['uses' => 'Pages\StatusCustomerController@index'])->name('admin.laporan.status_customer');

Route::post('/laporan/status_customer/allCustomers', ['uses' => 'Pages\StatusCustomerController@allCustomers'])->name('admin.laporan.status_customer.allCustomers');

Route::post('/laporan/status_customer/ubah_status_customer', ['uses' => 'Pages\StatusCustomerController@ubah_status_customer'])->name('admin.laporan.status_customer.ubah_status_customer');

Route::get('/laporan/target_arho', ['uses' => 'Pages\TargetArhoController@index'])->name('admin.laporan.target_arho');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
