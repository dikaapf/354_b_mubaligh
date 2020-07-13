<?php

use Illuminate\Support\Facades\Input;
//Route::get('/', function () {
//
//    return view('welcome');
//});
//Route::get('/layanan', function () {
//
//    return view('welcome');
//});
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('qrcode', function () {
    return QrCode::size(300)->generate('A basic example of QR code!');
});

Route::get('qrcode-with-image', function () {
    $image = QrCode::format('png')
            ->merge(public_path('img\logo_jyw.png'), 0.2, true)
            ->size(800)->errorCorrection('H')
            ->generate('https://online.disdukcapil.jayawijayakab.go.id');

    return response($image)->header('Content-type', 'image/png');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'UserController@index')->name('userindex');
Route::get('/informasi', 'UserController@indexinformasi')->name('userindexinformasi');
Route::get('/info', 'HomeController@indexinfo')->name('homeinfo');
Route::get('/informasi/{id}/detail', 'HomeController@detailinfo')->name('detailinfo');
Route::get('data-pengajuan/cetaklabel', 'UserController@cetaklabel')->name('cetaklabel');


Auth::routes();

//admin auth cariPdk/*
Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/pengguna', 'AdminController@indexuser')->name('admin.indexuser');
});

//pengajar auth cariPdk/*
Route::prefix('pengajar')->group(function() {
    Route::get('/login', 'Auth\OperatorLoginController@showLoginForm')->name('pengajar.login');
    Route::post('/login', 'Auth\OperatorLoginController@login')->name('pengajar.login.submit');
    Route::get('/beranda', 'OperatorController@index')->name('pengajar.dashboard');
    Route::get('/logout', 'Auth\OperatorLoginController@logout')->name('pengajar.logout');
});

Route::get('user/logout', 'Auth\LoginController@userlogout')->name('user.logout');

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'HomeController@indexpublic')->name('public.index');
    Route::get('layanan/{id}/detail', 'HomeController@detaillayanan')->name('public.detaillayanan');
    Route::get('layanan/{id}/petunjuk', 'HomeController@downloadpetunjuk')->name('public.downloadpetunjuk');
    Route::get('layanan/{id}/pengajuan', 'UserController@indexpengajuan')->name('public.pengajuan');
    Route::post('/pengajuan', 'UserController@postpengajuan');
    Route::get('/pengajuan/{id}/detail', 'UserController@detailpengajuan');
    Route::post('/delete/{jenis}', 'HomeController@hapusdata');

    Route::get('formulir/{id}/download', 'HomeController@downloadformulir')->name('public.downloadformulir');

    Route::post('/pengajuan-layanan', 'JenislayananController@postpengajuan_layanan');
    Route::get('/layanan/{id}/aktif', 'HomeController@aktif_layanan')->name('layanan.aktif_layanan');
    Route::get('/layanan/{id}/nonaktif', 'HomeController@nonaktif_layanan')->name('layanan.nonaktif_layanan');


    Route::get('/help', 'HomeController@indexbantuan')->name('layanan.indexbantuan');
    Route::get('/bantuan', 'HomeController@bantuan')->name('layanan.bantuan');


    Route::get('/userlist', 'HomeController@indexuserlist')->name('user.list');
    Route::get('/user/add', 'HomeController@adduser')->name('user.add');

    //update instansi
    Route::patch('/updateinstansi/{id}', 'HomeController@updateinstansi');


//Operator
    Route::get('/pengguna', 'OperatorController@indexuserlist')->name('user.list');
    Route::get('/pengguna/tambah', 'OperatorController@adduser')->name('user.add');
    Route::get('/pengguna/{id}/edit', 'OperatorController@edituser')->name('user.edituser');
    Route::get('/pengguna/{id}/detail', 'OperatorController@showuser')->name('user.showuser');
    Route::get('/pengguna/{id}/hapus', 'OperatorController@deluser')->name('user.deluser');
    Route::get('/pengguna/{id}/verifikasi', 'OperatorController@verifyuser')->name('user.verifyuser');
    Route::get('/pengguna/{id}/pending', 'OperatorController@pendingyuser')->name('user.pendingyuser');
    Route::get('/pengguna/{id}/batalverifikasi', 'OperatorController@batalverifyuser')->name('user.batalverifyuser');
    Route::get('/daftar-pengajuan', 'PengajuanController@index')->name('pengajuan.daftar');
    Route::get('/daftar-pengajuan/{id}/detail', 'PengajuanController@detailpengajuan')->name('pengajuan.detail');

    Route::get('/data-layanan/{id}/petunjuk', 'PengajuanController@cetakpetunjuk')->name('pengajuan.cetakpetunjuk');

    Route::get('/daftar-pengajuan/{id}/print', 'PengajuanController@printdetailpengajuan')->name('pengajuan.printdetail');
    Route::get('/data-pengajuan/cetak/{id}/pdf', 'PengajuanController@cetakdetailpengajuan')->name('pengajuan.cetakpdf');
    Route::get('/data-pengajuan/cetak/{id}/cetak', 'UserController@cetakdetailpengajuan')->name('pengajuan.cetakpdf');
    Route::get('/data-pengajuan/cetaklabel/{id}', 'UserController@cetaklabelalamat')->name('pengajuan.cetaklabelalamat');
    Route::patch('/data-pengajuan/status/{id}', 'PengajuanController@updatestatus')->name('pengajuan.updatestatus');
    Route::patch('/data-pengajuan/proses/{id}', 'PengajuanController@updateproses')->name('pengajuan.updateproses');
    Route::patch('/data-pengajuan/ambildok/{id}', 'PengajuanController@ambildok')->name('pengajuan.ambildok');
    Route::post('/data-pengajuan/uploaddok/{id}', 'PengajuanController@uploaddok')->name('pengajuan.uploaddok');


    Route::get('/pengajarlist', 'HomeController@pengajarlist')->name('pengajar.list');
    Route::get('/pengajar/add', 'HomeController@addpengajar')->name('pengajar.add');
    Route::get('/instansi', 'HomeController@instansi')->name('instansi');
    Route::get('/pengajar/{id}/edit', 'HomeController@editpengajar')->name('pengajar.edit');

    Route::post('/adduser', 'HomeController@postadduser');
    Route::post('/addpengajar', 'HomeController@postaddpengajar');

//updatepengajar 
    Route::patch('/updatepengajar/{id}', 'HomeController@updatepengajar');
    Route::get('/pengajar/{id}/verifikasi', 'HomeController@verifyuser')->name('user.verifyuser');
    Route::get('/pengajar/{id}/batalverifikasi', 'HomeController@batalverifyuser')->name('user.batalverifyuser');


    //sms gateway
    Route::post('/sms/verifikasi', 'OperatorController@verifikasiuser');
    Route::get('/sms/inbox', 'OperatorController@inbox');
    Route::get('/sms/sent', 'OperatorController@sentitem');
    Route::post('/sms/kirimpesan', 'OperatorController@kirimpesan');
    Route::post('/sms/balaspesan', 'OperatorController@balaspesan');




    Route::resource('jenislayanan', 'JenislayananController');
//    Route::resource('syaratlayanan', 'SyaratlayananController');
//    Route::resource('mekanismelayanan', 'MekanismelayananController');
//    Route::resource('formulirlayanan', 'FormulirlayananController');
//    Route::resource('formisian', 'FormisianController');
//    Route::resource('dokumenupload', 'DokumenuploadController');
//    Route::resource('soplayanan', 'SoplayananController');
//    Route::resource('dokumenlayanan', 'DokumenlayananController');
//    Route::resource('statuspengajuan', 'StatuspengajuanController');
//    Route::resource('pengajuan', 'PengajuanController');
//    Route::resource('historypengajuan', 'HistorypengajuanController');
//    Route::resource('riwayatproses', 'RiwayatprosesController');
//    Route::resource('ambildok', 'AmbildokController');
//    Route::resource('dokumen', 'DokumenController');
//    Route::resource('uploaddok', 'UploaddokController');
//	Route::resource('informations', 'InformationsController');
    Route::resource('pengumuman', 'PengumumanController');

    Route::resource('bantuan', 'BantuanController');
});


Route::group(['middleware' => ['web']], function () {
    Route::resource('kategori', 'KategoriController');
});

Route::group(['middleware' => ['web']], function () {
	Route::resource('pengajar', 'PengajarController');
});