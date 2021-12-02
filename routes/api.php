<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolController;


Route::post('register', 'App\Http\Controllers\UsersController@register');
Route::post('login', 'App\Http\Controllers\UsersController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('users','App\Http\Controllers\UsersController@getAuthenticatedUser');

});
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});

//Route::get('/VerUsuarios',[UsuarioController::class,'readusers']);

//Route::get('/VerUsuario/{ID}',[UsuarioController::class,'readuser']);

//Route::Post('/Crearusuarios',[UsuarioController::class,'setUsuarios']);

//Route::Post('/UpdateUsuarios',[UsuarioController::class,'UpdateUsuario']);

//Route::delete('/DeleteUsuarios/{ID}',[UsuarioController::class,'DeleteUsuario']);

/////////////////////////////////////////////////////////////////////////////

//Route::get('/VerRoles',[RolController::class,'readrols']);

//Route::Post('/VerRol',[RolController::class,'readrol']);

//Route::Post('/CrearRoles',[RolController::class,'setRol']);

//Route::Post('/EliminarRoles',[RolController::class,'DeleteRol']);

//Route::Post('/ActualizarRoles',[RolController::class,'UpdateRol']);

/////////////////////////////////////////////////////////////////////////////

Route::get('/VerPermisos',[PermisoController::class,'readpermisos']);

Route::Post('/VerPermiso',[PermisoController::class,'readpermiso']);

Route::Post('/CrearPermisos',[PermisoController::class,'setpermisos']);

Route::Post('/ActualizarPermisos',[PermisoController::class,'UpdatePermiso']);

Route::Post('/EliminarPermisos',[PermisoController::class,'DeletePermiso']);













