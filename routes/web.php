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

//Web Site

Route::get('/generarbecarios','GetPublicController@generarbecarios')->name('generarbecarios');

Route::get('/','SitioWebController@index')->name('home');

Route::get('/nosotros', function(){
    return view('web_site.nosotros')->with('route','nosotros');

})->name('nosotros');


Route::get('/programas', function(){
    return view('web_site.programas')->with('route','programas');

})->name('programas');

Route::get('/membresias', function(){
    return view('web_site.membresias')->with('route','membresias');

})->name('membresias');

Route::get('/contactenos', function(){
    return view('web_site.contactenos')->with('route','contactenos');

})->name('contactenos');

Route::get('/noticias','SitioWebController@noticias')->name('noticias');

Route::get('noticia/{slug}/','SitioWebController@showNoticia')->name('showNoticia');



Route::get('/foo', function () {
    $exitCode = Artisan::call('cache:clear');
});


// Get Noticia para obtener todas las noticias en el datatable
Route::get('datatable/getNoticia/{tip?}', 'GetPublicController@getNoticias')->name('datatable/getNoticia');

//Rutas del Sistema de Administracion
Route::group(["prefix"=>"sisbeca",'middleware'=>'auth'],function ()
{
    Route::get('/',[
        'uses'=> 'SisbecaController@index',
        'as' =>'sisbeca'
    ]);


    //Estas Rutas solo seran accedidas por el Administrador (admin es un middleware
    // creado recordar registrar el middleware creado por el programador en la carpeta Kernel
    Route::group(['middleware'=>'admin'],function ()
    {
    Route::Resource('mantenimientoUser', 'MantenimientoUserController');
    Route::get('mantenimientoUser/{id}/destroy', [
        'uses' => 'MantenimientoUserController@destroy',
        'as' => 'mantenimientoUser.destroy'
    ]);
        // Get Data
        Route::get('datatable/getdata', 'MantenimientoUserController@getUsers')->name('datatable/getdata');

     });

    //Estas Rutas solo seran accedidas por el Editor (editor es un middleware
    // creado recordar registrar el middleware creado por el programador en la carpeta Kernel
    Route::group(['middleware'=>'editor'],function ()
    {
        Route::Resource('mantenimientoNoticia', 'MantenimientoNoticiaController');
        Route::get('mantenimientoNoticia/{id}/destroy', [
            'uses' => 'MantenimientoNoticiaController@destroy',
            'as' => 'mantenimientoNoticia.destroy'
        ]);

        Route::get('viewCostos', [
            'uses' => 'SisbecaController@viewCostos',
            'as' => 'costos.show'
        ]);

        Route::any('costos/createOrUpdate/{id?}', [
            'uses' => 'SisbecaController@createOrUpdateCostos',
            'as' => 'costos.createOrUpdate'
        ]);


    });

    Route::group(['middleware'=>'directivo'],function ()
    {
        Route::get('nomina/generar/mes/{mes}/anho/{anho}', [
            'uses' => 'NominaController@generartodo',
            'as' => 'nomina.generar.todo'
        ]);

        Route::get('nomina/listar', [
            'uses' => 'NominaController@listar',
            'as' => 'nomina.listar'
        ]);
       
        Route::get('nomina/consultar/mes/{mes}/anho/{anho}', [
            'uses' => 'NominaController@consultar',
            'as' => 'nomina.consultar'
        ]);

        Route::get('nomina/pdf/mes/{mes}/anho/{anho}', [
            'uses' => 'NominaController@pdf',
            'as' => 'nomina.pdf'
        ]);

        Route::get('nomina/cambiar-estatus', [
            'uses' => 'NominaController@cambiar',
            'as' => 'nomina.cambiar'
        ]);

        Route::get('becarios/listar', [
            'uses' => 'BecarioController@listar',
            'as' => 'becarios.listar'
        ]);
     });



});
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

//esta ruta sirve para desloguear al usuario

//Route::get('/home', 'HomeController@index')->name('home');
