<?php

use App\Mail\TestMail;
use App\User;
use Illuminate\Support\Facades\Route;

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
    $user = User::first();
    return view('welcome', compact('user'));
    // $name = 'Esto es una prueba';
    // Mail::to('jprendon9@gmail.com')->send(new TestMail($name));
})->name('welcome');
// Route::get('/vista', function () {
//     return view('vista');
// });
// Route::resource('empresa', 'EmpresaController')->only([
//     'index',
// ])->names('empresa');
Route::resource('areas', 'AreaController')->except([
    'show',
])->names('admin.areas');
Route::resource('dependencias', 'DependenciaController')->except([
    'show',
])->names('admin.dependencias');

Route::resource('estandar', 'EstandarController')->except([
    'show',
])->names('admin.estandares');
Route::resource('soporte', 'FuenteController')->except([
    'show',
])->names('admin.fuentes');
Route::resource('mapas', 'PlanadquisicioneController')->names('planadquisiciones');
Route::get('exportar_planadquisiciones_excel/{planadquisicion}', 'PlanadquisicioneController@exportar_planadquisiciones_excel')->name('exportar_planadquisiciones_excel');
Route::get('importar_datos', function () {
    return view('admin.importar_datos');
})->name('importar_datos');
Route::resource('ciudades', 'CiudadController')->except([
    'show',
])->names('admin.ciudades');

Auth::routes();
// Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

// Mail::to($request->user())->send(new MailableClass);
// Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth', 'verified']);
Route::get('/estadistica', 'EmpresaController@index')->name('estadistica');
// Route::get('obtener_estandares', 'AjaxController@obtener_estandares')->name('obtener_estandares');
// Route::get('obtener_tipoEmisoras', 'AjaxController@obtener_tipoEmisoras')->name('obtener_tipoEmisoras');
// Route::get('obtener_emisora', 'AjaxController@obtener_emisora')->name('obtener_emisora');
// Route::get('obtener_codigo', 'AjaxController@obtener_codigo')->name('obtener_codigo');

Route::get('/get-estandares/{ciudad_id}', 'AjaxController@obtener_estandares');
Route::get('/get-tipos-emisora/{estandar_id}', 'AjaxController@obtener_tipoEmisoras');
Route::get('/get-emisoras/{tipoemisora_id}', 'AjaxController@obtener_emisora');




Route::resource('users', 'UserController')->names('users');
// ================== rutas para importar datos 
Route::post('potencia_import', 'ImportExcelController@potencia_import')->name('planadquisicione.import.excel');


//new
Route::get('inventario-export', 'PlanadquisicioneController@export')->name('planadquisiciones.export');
Route::put('update-profile/{user}', 'UserController@updateProfile')->name('update.profile');
// Route::get('inventario/areas/{areaId}', 'PlanadquisicioneController@indexByArea')->name('planadquisiciones.indexByArea');
// Route::get('inventario/onlyadmin', 'PlanadquisicioneController@showOnlyAdmin')->name('planadquisiciones.showOnlyAdmin');
// Route::get('inventario', 'PlanadquisicioneController@index')->name('planadquisiciones.index');
// Route::get('inventario/area/{areaId}', 'PlanadquisicioneController@indexByArea')->name('planadquisiciones.indexByArea');

// Route::get('ciudades/{ciudad}/editar', 'CiudadController@update')->name('admin.ciudades.update');
// Route::get('ciudades/{ciudad}/editar', 'CiudadController@edit')->name('admin.ciudades.edit');


// Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
