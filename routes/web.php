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

Route::get('/', ['uses' => 'Pages\InterfaceController@dashboard'])->name('admin.dashboard');


Route::get('/informasi_arho', ['uses' => 'Pages\InformasiArhoController@index'])->name('admin.informasi_arho');

Route::get('/meong', ['uses' => 'Pages\VisualisasiArhoController@meong'])->name('admin.meong');

Route::post('/informasi_arho/list_arho', ['uses' => 'Pages\InformasiArhoController@all_arho'])->name('admin.informasi_arho.list_arho.all_arho');

Route::post('/informasi_arho/simpan', ['uses' => 'Pages\InformasiArhoController@simpan_arho'])->name('admin.informasi_arho.simpan');

Route::post('/informasi_arho/hapus', ['uses' => 'Pages\InformasiArhoController@hapus_arho'])->name('admin.informasi_arho.hapus');

Route::post('/informasi_arho/fetch', ['uses' => 'Pages\InformasiArhoController@fetch_arho_by_id'])->name('admin.informasi_arho.fetch');

Route::post('/informasi_arho/update', ['uses' => 'Pages\InformasiArhoController@update_arho'])->name('admin.informasi_arho.update');


Route::get('/informasi_kecamatan', ['uses' => 'Pages\InformasiKecamatanController@index'])->name('admin.informasi_kecamatan');

Route::post('/informasi_kecamatan/list_kecamatan', ['uses' => 'Pages\InformasiKecamatanController@all_kecamatan'])->name('admin.informasi_kecamatan.list_kecamatan.all_kecamatan');

Route::post('/informasi_kecamatan/simpan', ['uses' => 'Pages\InformasiKecamatanController@simpan_kecamatan'])->name('admin.informasi_kecamatan.simpan');

Route::post('/informasi_kecamatan/hapus', ['uses' => 'Pages\InformasiKecamatanController@hapus_kecamatan'])->name('admin.informasi_kecamatan.hapus');

Route::post('/informasi_kecamatan/fetch', ['uses' => 'Pages\InformasiKecamatanController@fetch_kecamatan_by_id'])->name('admin.informasi_kecamatan.fetch');

Route::post('/informasi_kecamatan/update', ['uses' => 'Pages\InformasiKecamatanController@update_kecamatan'])->name('admin.informasi_kecamatan.update');

Route::get('/informasi_kelurahan', ['uses' => 'Pages\InformasiKelurahanController@index'])->name('admin.informasi_kelurahan');

Route::post('/informasi_kelurahan/list_kelurahan', ['uses' => 'Pages\InformasiKelurahanController@all_kelurahan'])->name('admin.informasi_kelurahan.list_kelurahan');

Route::post('/informasi_kelurahan/simpan', ['uses' => 'Pages\InformasiKelurahanController@simpan_kelurahan'])->name('admin.informasi_kelurahan.simpan');

Route::post('/informasi_kelurahan/hapus', ['uses' => 'Pages\InformasiKelurahanController@hapus_kelurahan'])->name('admin.informasi_kelurahan.hapus');

Route::post('/informasi_kelurahan/fetch', ['uses' => 'Pages\InformasiKelurahanController@fetch_kelurahan_by_id'])->name('admin.informasi_kelurahan.fetch');

Route::post('/informasi_kelurahan/update', ['uses' => 'Pages\InformasiKelurahanController@update_kelurahan'])->name('admin.informasi_kelurahan.update');


Route::get('/upload_file', ['uses' => 'Pages\ImportFileController@index'])->name('admin.upload_file');

Route::post('/upload_file/import', ['uses' => 'Pages\ImportFileController@import_excel'])->name('admin.upload_file.import');

Route::get('/import_file_handling_arho', ['uses' => 'Pages\ImportFileHandlingArhoController@index'])->name('admin.import_file_handling_arho');

Route::post('/import_file_handling_arho/import', ['uses' => 'Pages\ImportFileHandlingArhoController@import_excel'])->name('admin.import_file_handling_arho.import');

Route::get('/import_data_customer', ['uses' => 'Pages\ImportDataCustomerController@index'])->name('admin.import_data_customer');

Route::post('/import_data_customer/import', ['uses' => 'Pages\ImportDataCustomerController@import_excel'])->name('admin.import_data_customer.import');

Route::post('/import_laporan_handling/import', ['uses' => 'Pages\ImportLaporanHandlingController@import_excel'])->name('admin.import_laporan_handling.import');

Route::get('/import_laporan_handling', ['uses' => 'Pages\ImportLaporanHandlingController@index'])->name('admin.import_laporan_handling');

Route::get('/upload_file_osa', ['uses' => 'Pages\UploadFileOsaController@index'])->name('admin.upload_file_osa');

Route::post('/upload_file_osa/import', ['uses' => 'Pages\UploadFileOsaController@import_excel'])->name('admin.upload_file_osa.import');

Route::get('/upload_warna_arho', ['uses' => 'Pages\WarnaArhoController@indexHome'])->name('admin.laporan.upload_warna_arho');

Route::post('/upload_warna_arho/update_warna_arho', ['uses' => 'Pages\WarnaArhoController@update_warna_arho'])->name('admin.laporan.upload_warna_arho.update_warna_arho');

Route::get('/visualisasi/umum', ['uses' => 'Pages\VisualisasiDataController@umum'])->name('admin.visualisasi.umum');

Route::post('/visualisasi/umum/fetch_customer_markers', ['uses' => 'Pages\VisualisasiDataController@fetch_customer_markers'])->name('admin.visualisasi.umum.fetch_customer_markers');

Route::post('/visualisasi/umum/fetch_arho_markers', ['uses' => 'Pages\VisualisasiDataController@fetch_arho_markers'])->name('admin.visualisasi.umum.fetch_arho_markers');

Route::get('/visualisasi/arho', ['uses' => 'Pages\VisualisasiArhoController@indexHome'])->name('admin.visualisasi.arho');
Route::get('/visualisasi/arho/hitung_laporan', ['uses' => 'Pages\VisualisasiArhoController@hitung_laporan_arho'])->name('admin.visualisasi.arho.hitung_laporan');

Route::post('/visualisasi/arho/get_laporan_arho', ['uses' => 'Pages\VisualisasiArhoController@get_laporan_arho'])->name('admin.visualisasi.arho.get_laporan_arho');

Route::post('/visualisasi/arho/fetch_markers', ['uses' => 'Pages\VisualisasiArhoController@fetch_markers'])->name('admin.visualisasi.arho.fetch_markers');

Route::get('/visualisasi/arho/detail_laporan/{arho}/{kecamatan}', ['uses' => 'Pages\VisualisasiArhoController@detail_laporan'])->name('admin.visualisasi.arho.detail_laporan');

Route::get('/visualisasi/kecamatan', ['uses' => 'Pages\VisualisasiKecamatanController@indexHome'])->name('admin.visualisasi.kecamatan');

Route::post('/visualisasi/kecamatan/get_list_kecamatan', ['uses' => 'Pages\VisualisasiKecamatanController@get_list_kecamatan'])->name('admin.visualisasi.kecamatan.get_list_kecamatan');

Route::get('/visualisasi/kecamatan/detail_kecamatan/{kecamatan}', ['uses' => 'Pages\VisualisasiKecamatanController@detail_kecamatan'])->name('admin.visualisasi.kecamatan.detail_kecamatan');

Route::get('/visualisasi/customer', ['uses' => 'Pages\VisualisasiCustomerController@indexHome'])->name('admin.visualisasi.customer');


Route::post('/visualisasi/customer/fetch_markers', ['uses' => 'Pages\VisualisasiCustomerController@fetch_markers'])->name('admin.visualisasi.customer.fetch_markers');


Route::get('/laporan/status_customer', ['uses' => 'Pages\StatusCustomerController@index'])->name('admin.laporan.status_customer');

Route::post('/laporan/status_customer/allCustomers', ['uses' => 'Pages\StatusCustomerController@allCustomers'])->name('admin.laporan.status_customer.allCustomers');

Route::post('/laporan/status_customer/ubah_status_customer', ['uses' => 'Pages\StatusCustomerController@ubah_status_customer'])->name('admin.laporan.status_customer.ubah_status_customer');

Route::get('/laporan/target_arho', ['uses' => 'Pages\TargetArhoController@index'])->name('admin.laporan.target_arho');

Route::post('/laporan/target_arho/update_target', ['uses' => 'Pages\TargetArhoController@update_target_arho'])->name('admin.laporan.target_arho.update_target');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
