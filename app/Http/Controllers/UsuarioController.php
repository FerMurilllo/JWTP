<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;


class UsuarioController extends Controller
{
    public function readusers()
    {

        return Usuario::Select('usuarios.id','usuarios.nombre as Usuario', 'roles.nombre as Rol','permisos.nombre as Permiso')
        -> join ('roles','roles.id','=','usuarios.rol')
        -> join ('permisos','permisos.id','=','usuarios.permiso')
        ->get() ;


    }

    public function readuser($ID)
    {

           return Usuario::Select('usuarios.id','usuarios.nombre as Usuario', 'roles.nombre as Rol','permisos.nombre as Permiso')
        -> join ('roles','roles.id','=','usuarios.rol')
        -> join ('permisos','permisos.id','=','usuarios.permiso')
        -> where ('usuarios.id','=',$ID)
        ->get() ;

    }
    

    public function setUsuarios(request $request)
    {
        $Usuario = new Usuario;
        
        $Usuario->Nombre = $request->nombre;
        $Usuario->rol = $request->rol;
        $Usuario->permiso = $request->permiso;
        $Usuario->save();

        return $Usuario;

    }

    public function DeleteUsuario($ID)
    {
        $Usuario = Usuario::find($ID);
        $Usuario->delete();
        
        return 'Registro eliminado';
 

    }

    public function UpdateUsuario(request $request)
    {

        $Usuario = Usuario::find($request->ID);

        $Usuario->Nombre = $request->nombre;
        $Usuario->rol = $request->rol;
        $Usuario->permiso = $request->permiso;
        $Usuario->save();

        return $Usuario;
        
    }
    public function authenticate(Request $request)
    {
    $credentials = $request->only('email', 'password');
    try {
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 400);
        }
    } catch (JWTException $e) {
        return response()->json(['error' => 'could_not_create_token'], 500);
    }
    return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
        }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('usuario'));
    }


    public function register(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'nombre' => $request->get('nombre'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }
    
}
