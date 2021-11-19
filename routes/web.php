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

Route::get('/', function () {
    if(Auth::user())
        return redirect(route('home'));
    else
        return view('auth.landing');
});



Route::get('/user/register', [
    'as' => 'register.form',
    'uses'=>'RegisterController@indexRegister'
]);

Route::post('/user/register/store', [
    'as' => 'register.formstore',
    'uses'=>'RegisterController@Registerstore'
]);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('import_emp','ImportEmpCtrl');
Route::resource('profile','ProfileController');



// MONITORING AUDIT

Route::group(['middleware'=>'auth'],function(){

    //Master
    //ADMIN
    Route::resource('user','Monitoring\UserController');


    //UJIAN
    Route::resource('ujian','UjianController');

    //Pertanyaan
    Route::get('/ujian/pertanyaan/{ujian_id}', [
        'as' => 'pertanyaanindex',
        'uses'=>'PertanyaanController@indexPertanyaan'
    ]);

    Route::get('/ujian/pertanyaan/create/{ujian_id}', [
        'as' => 'pertanyaan.create',
        'uses'=>'PertanyaanController@createPertanyaan'
    ]);

    Route::post('/ujian/pertanyaan/store/{ujian_id}', [
        'as' => 'pertanyaan.store',
        'uses'=>'PertanyaanController@storePertanyaan'
    ]);

    Route::delete('/ujian/pertanyaan/destroy/{id}', [
        'as' => 'pertanyaan.destroy',
        'uses'=>'PertanyaanController@destroyPertanyaan'
    ]);

    Route::get('/ujian/pertanyaan/edit/{ujian_id}', [
        'as' => 'pertanyaan.edit',
        'uses'=>'PertanyaanController@editPertanyaan'
    ]);

    Route::put('/ujian/pertanyaan/update/{ujian_id}', [
        'as' => 'pertanyaan.update',
        'uses'=>'PertanyaanController@updatePertanyaan'
    ]);


    //view Ujian

    Route::get('/ujian/viewUjian/{ujian_id}', [
            'as' => 'view.ujian',
            'uses'=>'UjianController@viewUjian'
    ]);

    Route::post('/ujian/viewUjian/store/{ujian_id}', [
        'as' => 'jawaban.store',
        'uses'=>'UjianController@storeJawaban'
    ]);

    Route::put('/ujian/viewUjian/store/{id}', [
        'as' => 'statusujian.update',
        'uses'=>'UjianController@updateStatusUjian'
    ]);

    //enrolled Ujian
    Route::get('/ujian/daftar/{id}', [
        'as' => 'daftar.store',
        'uses'=>'UjianController@updateDaftar'
    ]);


    //enrolled
    Route::resource('enrolled','UjianDaftarController');




    Route::get('/register', [
        'as' => 'registered.index',
        'uses'=>'RegisterController@indexRegistered'
    ]);

    Route::get('/register/store/{id}', [
        'as' => 'registered.store',
        'uses'=>'RegisterController@Userstore'
    ]);


    //mulai ujian
    Route::get('/ujian/mulai/{id}', [
        'as' => 'mulai.ujian',
        'uses'=>'UjianController@mulaiUjian'
    ]);

    Route::get('/ujian/selesai/{id}', [
        'as' => 'selesai.ujian',
        'uses'=>'UjianController@selesaiUjian'
    ]);


    //analisis
    Route::get('/ujian/analisis/{id}', [
        'as' => 'analisis.ujian',
        'uses'=>'UjianController@hitungAnalisis'
    ]);
    Route::get('/ujian/analisis/ujian{id}', [
        'as' => 'lihatanalisis.ujian',
        'uses'=>'UjianController@lihatAnalisis'
    ]);

    //Hasil
    Route::get('/enrolled/hasil/{id}', [
        'as' => 'hasil.ujian',
        'uses'=>'PertanyaanController@indexHasil'
    ]);
    Route::get('/ujian/enrolled/hasil/{id}', [
        'as' => 'hasiladmin.ujian',
        'uses'=>'PertanyaanController@adminHasil'
    ]);

    //Enrolled User
    Route::get('/ujian/enrolled/{id}', [
        'as' => 'ujian.enrolled',
        'uses'=>'UjianController@enrolledAdmin'
    ]);

});
