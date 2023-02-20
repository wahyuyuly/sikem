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

//Route::get('/', 'Frontend\HomeController@index')->name('f-home');
Route::get('/', function() {
    return redirect('login');
});
Route::get('file/public/{loc}/{file}', 'Backend\File\Download@filePublic')->name('file.public');
Route::get('/artikel', 'Frontend\ListController@index')->name('f-artikel');
Route::get('/artikel/detail/{slug}', 'Frontend\DetailController@index')->name('f-detail');
Route::get('/pengumuman', 'Frontend\ListController@pengumuman')->name('f-pengumuman');
Route::get('/pengumuman/detail/{slug}', 'Frontend\DetailController@indexAnnoun')->name('f-announ');
Route::get('/karir', 'Frontend\JobController@showJob')->name('f-job');

/**
 * Search route
 */
Route::get('/artikel/pencarian', 'Frontend\ListController@searchArticle')->name('f-artikelcari');


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => true, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/register', 'Auth\RegistController@index')->name('regist');
Route::post('/register', 'Auth\RegistController@create')->name('regist.create');
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'ajax-session-expired'])->prefix('dashboard')->group(function () { 
    Route::get('request-user', 'Backend\RequestUser\RequestController@index')->name('request-user.index');
    Route::patch('request-user/{id}', 'Backend\RequestUser\RequestController@update')->name('request-user.update');
    Route::post('request-user', 'Backend\RequestUser\RequestController@batchupdate')->name('request-user.batchupdate');
    Route::delete('request-user/{id}', 'Backend\RequestUser\RequestController@destroy')->name('request-user.destroy');
    Route::resource('mahasiswa', 'Backend\Mahasiswa\MahasiwaController');
    Route::get('list/mahasiswa', 'Backend\Mahasiswa\MahasiwaController@mahasiswaList')->name('mahasiswa.list');
    Route::get('alumni', 'Backend\Mahasiswa\AlumniController@index')->name('alumni.index')->middleware('permission:kelola-mahasiswa');
    
    //Route::get('file/mahasiswa', 'Backend\Mahasiswa\FileController@index')->name('mahasiswa.indexfile');
    //Route::get('file/mahasiswa/{id}/upload', 'Backend\Mahasiswa\FileController@create')->name('mahasiswa.file');
    //Route::post('file/mahasiswa/{id}/upload', 'Backend\Mahasiswa\FileController@upload')->name('mahasiswa.upload');
    //Route::delete('file/mahasiswa/{id}/destroy', 'Backend\Mahasiswa\FileController@destroy')->name('mahasiswa.filedestroy');

    Route::get('files/{id}/upload', 'Backend\Mahasiswa\FileController@create')->name('files.create');
    Route::resource('files', 'Backend\Mahasiswa\FileController')->except(['create', 'edit', 'update']);
    
    Route::get('/import/mahasiswa', 'Backend\Mahasiswa\ImportController@index')->name('mahasiswa.import')->middleware('permission:kelola-mahasiswa');
    Route::post('/import/mahasiswa', 'Backend\Mahasiswa\ImportController@store')->name('mahasiswa.importstore')->middleware('permission:kelola-mahasiswa');
    Route::resource('pengumuman', 'Backend\Pengumuman\PengumumanController');
    Route::get('pengumuman/kotak-sampah', 'Backend\Pengumuman\PengumumanController@trash')->name('pengumuman.trash');
    Route::resource('kategori-pengumuman', 'Backend\Pengumuman\KategoriPengumumanController');
    Route::post('chart', 'HomeController@chart')->name('homeChart');
});

Route::middleware(['auth', 'ajax-session-expired'])->prefix('lampiran')->group(function () { 
    Route::get('download/{file}', 'Backend\File\Download@index')->name('download.index');
    Route::get('mahasiswa/download/{file}', 'Backend\File\Download@fileMahasiswa')->name('download.mahasiswa');
    Route::get('profile/{file}', 'Backend\File\Download@attachment')->name('download.attachment');
});

Route::middleware(['auth', 'ajax-session-expired'])->prefix('dashboard/permohonan')->group(function () { 
    //Route::resource('surat', 'Backend\Permohonan\Surat\SuratController');
    Route::resource('legalisir', 'Backend\Permohonan\Surat\LegalisirController');
    Route::patch('upload/legalisir/{id}', 'Backend\Permohonan\Surat\LegalisirController@upload')->name('legalisir.upload');
    Route::get('print/bukti/legalisir/{id}', 'Backend\Permohonan\Surat\LegalisirController@generateBukti')->name('legalisir.print');
});

Route::middleware(['auth', 'ajax-session-expired'])->prefix('dashboard/artikel')->group(function () {    
    Route::resource('kategori', 'Backend\Artikel\KategoriController')->except(['show'])->middleware('permission:kelola-berita');
    Route::resource('artikel', 'Backend\Artikel\ArtikelController')->except(['show'])->middleware('permission:kelola-berita');
    Route::get('kotak-sampah', 'Backend\Artikel\ArtikelTrashController@trash')->name('artikel.trash')->middleware('permission:kelola-berita');
    Route::delete('force-delete/{id}', 'Backend\Artikel\ArtikelTrashController@force')->name('artikel.force')->middleware('permission:kelola-berita');
    Route::delete('trashdestroy/{id}', 'Backend\Artikel\ArtikelTrashController@multidestroy')->name('artikel.trashdestroy')->middleware('permission:kelola-berita');
    Route::post('restore/{id}', 'Backend\Artikel\ArtikelTrashController@restore')->name('artikel.restore')->middleware('permission:kelola-berita');
});

Route::middleware(['auth', 'ajax-session-expired'])->prefix('dashboard/pengaturan')->group(function () {
    Route::resource('pengguna', 'Backend\Pengaturan\PenggunaController');
    Route::resource('master-jurusan', 'Backend\Pengaturan\MasterJurusanController')->except(['show'])->middleware('permission:kelola-master');
    Route::resource('master-prodi', 'Backend\Pengaturan\MasterProdiController')->except(['show'])->middleware('permission:kelola-master');
    Route::resource('master-ukm', 'Backend\Pengaturan\MasterUkmController')->except(['show'])->middleware('permission:kelola-master');
});

Route::middleware(['auth', 'ajax-session-expired'])->prefix('dashboard/kemahaiswaan')->group(function () {    
    Route::get('capaian-semester/create/{id?}', 'Backend\Kemahasiswaan\SemesterController@create')->name('capaian-semester.create');
    Route::post('capaian-semester/detail', 'Backend\Kemahasiswaan\SemesterController@detail')->name('capaian-semester.detail');
    Route::resource('capaian-semester', 'Backend\Kemahasiswaan\SemesterController')->except(['create']);
    Route::get('pendidikan-non-formal/create/{id?}', 'Backend\Kemahasiswaan\PendidikanNonFormalController@create')->name('pendidikan-non-formal.create');
    Route::resource('pendidikan-non-formal', 'Backend\Kemahasiswaan\PendidikanNonFormalController')->except(['create']);
    Route::get('riwayat-ukm/create/{id?}', 'Backend\Kemahasiswaan\UkmController@create')->name('riwayat-ukm.create');
    Route::resource('riwayat-ukm', 'Backend\Kemahasiswaan\UkmController')->except(['create']);
    Route::get('prestasi/create/{id?}', 'Backend\Kemahasiswaan\PrestasiController@create')->name('prestasi.create');
    Route::resource('prestasi', 'Backend\Kemahasiswaan\PrestasiController')->except(['create']);
    Route::get('organisasi/create/{id?}', 'Backend\Kemahasiswaan\OrganisasiController@create')->name('organisasi.create');
    Route::resource('organisasi', 'Backend\Kemahasiswaan\OrganisasiController')->except(['create']);
});

Route::middleware(['auth', 'ajax-session-expired'])->prefix('dashboard/report')->group(function () {    
    Route::get('export', 'Backend\Report\ExportController@index')->name('export.index');
    Route::post('export', 'Backend\Report\ExportController@create')->name('export.create');
});

Route::get('/pencarian/wilayah', 'Backend\Pengaturan\WilayahController@index')->name('wilayah');
