<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;


class RolController extends Controller
{
    public function readrols()
    {
        return rol::all();

    }

    public function readrol(request $request)
    {

        return rol::find($request->ID);

    }

    public function setRol(request $request)
    {
        $Rol = new Rol;
        
        $Rol->nombre = $request->nombre;
        $Rol->save();

        return $Rol;

    }

    public function DeleteRol(request $request)
    {
        $Rol = Rol::find($request->ID);
        $Rol->delete();
        
        return 'Registro eliminado';
 

    }

    public function UpdateRol(request $request)
    {

        $Rol = Rol::find($request->ID);
        $Rol->nombre = $request->nombre;
        $Rol->save();
        return $Rol;
        
    }
}
