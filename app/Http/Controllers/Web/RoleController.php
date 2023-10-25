<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\error;
use function Ramsey\Uuid\v1;


class RoleController extends Controller
{
    public $breadcrumb_info = [
        'main_title' => 'Roles',
        'second_level' => '',
        'add_button' => false
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();

        $permissions = Permission::get()->groupBy('modulo');

        $breadcrumb_info = $this->breadcrumb_info;

        LogController::store(Auth::user()->id, 'Consultar',0, 'Contular todos los perfiles', 'roles' , request()->url());

        return view('roles.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
/* 
        $request->merge([
            'name' => 'Admin'.uniqid(),
            'permissions' => [1,2,3]
        ]); */



        // error($request->name);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permissions.*' => 'sometimes|exists:permissions,id'
        ]);

        if($validator->passes()){
            $role = Role::create($request->only(['name']));

            if($request->has('permissions')){
                $role->givePermissionTo($request->permissions);
            }
            LogController::store(Auth::user()->id, 'Crear', 0, 'Creacion de un nuevo perfil', 'roles', request()->url());

            return back()->with('stauts', 'ok');
        }

        LogController::store(Auth::user()->id, 'error', 0, 'error al registrar rol', 'roles', request()->url());
        return back()->withErrors($validator->errors()); 
       }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::find($id);
        
        if($role){

            $breadcrumb_info = $this->breadcrumb_info;

            LogController::store(Auth::user()->id, 'Consultar', $role->id, 'consultar un rol', 'roles', request()->url());
            
            return view('roles.show', get_defined_vars());
        }

        LogController::store(Auth::user()->id,'Error', $id ,'intento consultar un rol', 'roles', request()->url());

        return back()->with('status', 'error');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       
 /*         $request->merge([
            'id' => 1,
            'name' => 'Sistema2321s',
            'permissions' => [1,3]
        ]);  */
 
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$request->id,
            'permissions.*' => 'sometimes|exists:permissions,id'
        ]);

        if($validator->passes()){

            $role = Role::find($request->id);
            
            if($role && $role->update($request->only('name'))){
                

                if($request->has('permissions')){

                    $role->syncPermissions($request->permissions);
                }


                LogController::store(Auth::user()->id, 'Actualizar', $role->id, 'Actualizo un rol', 'roles', request()->url());
             
                // return $role;
                return back()->with('status', 'ok');
            }
        }

        LogController::store(Auth::user()->id, 'error', $request->id, 'intento actualizar un rol', 'roles', request()->url());


        return back()->withErrors($validator->errors());
     /*    return [
            $validator->passes(), 
            $validator->errors()->all()
        ]; */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if($role) {

            $role->delete();
        
            LogController::store(Auth::user()->id, 'eliminar', $id, 'Eliminar un rol', 'roles', request()->url());
            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 1,
                'data' => $id
            ]);
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al eliminar un rol', 'roles', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }

    public function get($id){
        
        $role = Role::with(['permissions'])->find($id);

        if($role){

            
            LogController::store(Auth::user()->id, 'consultar', $id, 'consultar un rol', 'roles', request()->url());
            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => 1,
                'data' => $role
            ]);
        }

        LogController::store(Auth::user()->id, 'error', $id, 'Error al consultar rol', 'roles', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }
}
