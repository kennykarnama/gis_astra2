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

Route::get('/upload_warna_arho', ['uses' => 'Pages\WarnaArhoController@indexHome'])->name('admin.laporan.upload_warna_arho');

Route::post('/upload_warna_arho/update_warna_arho', ['uses' => 'Pages\WarnaArhoController@update_warna_arho'])->name('admin.laporan.upload_warna_arho.update_warna_arho');

Route::get('/visualisasi/umum', ['uses' => 'Pages\VisualisasiDataController@umum'])->name('admin.visualisasi.umum');

Route::post('/visualisasi/umum/fetch_customer_markers', ['uses' => 'Pages\VisualisasiDataController@fetch_customer_markers'])->name('admin.visualisasi.umum.fetch_customer_markers');

Route::post('/visualisasi/umum/fetch_arho_markers', ['uses' => 'Pages\VisualisasiDataController@fetch_arho_markers'])->name('admin.visualisasi.umum.fetch_arho_markers');

Route::get('/visualisasi/arho', ['uses' => 'Pages\VisualisasiArhoController@indexHome'])->name('admin.visualisasi.arho');

Route::post('/visualisasi/arho/get_laporan_arho', ['uses' => 'Pages\VisualisasiArhoController@get_laporan_arho'])->name('admin.visualisasi.arho.get_laporan_arho');

Route::post('/visualisasi/arho/fetch_markers', ['uses' => 'Pages\VisualisasiArhoController@fetch_markers'])->name('admin.visualisasi.arho.fetch_markers');

Route::get('/visualisasi/arho/detail_laporan/{arho}/{kecamatan}', ['uses' => 'Pages\VisualisasiArhoController@detail_laporan'])->name('admin.visualisasi.arho.detail_laporan');


Route::get('/laporan/status_customer', ['uses' => 'Pages\StatusCustomerController@index'])->name('admin.laporan.status_customer');

Route::post('/laporan/status_customer/allCustomers', ['uses' => 'Pages\StatusCustomerController@allCustomers'])->name('admin.laporan.status_customer.allCustomers');

Route::post('/laporan/status_customer/ubah_status_customer', ['uses' => 'Pages\StatusCustomerController@ubah_status_customer'])->name('admin.laporan.status_customer.ubah_status_customer');

Route::get('/laporan/target_arho', ['uses' => 'Pages\TargetArhoController@index'])->name('admin.laporan.target_arho');

Route::post('/laporan/target_arho/update_target', ['uses' => 'Pages\TargetArhoController@update_target_arho'])->name('admin.laporan.target_arho.update_target');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
