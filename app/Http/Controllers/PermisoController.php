<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;


class PermisoController extends Controller
{
    public function readpermisos()
    {
        return Permiso::all();

    }

    public function readpermiso(request $request)
    {
        return Permiso::find($request->ID);

    }

    public function setpermisos(request $request)
    {
        $Permisos = new Permiso;
        
        $Permisos->nombre = $request->nombre;
        $Permisos->save();

        return $Permisos;

    }
    public function DeletePermiso(request $request)
    {
        $Permisos = Permiso::find($request->ID);
        $Permisos->delete();
        
        return 'Registro eliminado';


    }

    public function UpdatePermiso(request $request)
    {

        $Permiso = Permiso::find($request->ID);
        $Permiso->nombre = $request->nombre;
        $Permiso->save();
        return $Permiso;
        
    }
}
