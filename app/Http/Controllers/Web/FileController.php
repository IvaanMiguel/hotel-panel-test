<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Filable;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mockery\CountValidator\AtMost;
use Psy\CodeCleaner\ValidFunctionNamePass;

use function Laravel\Prompts\error;

class FileController extends Controller
{
      public $breadcrum_info = array(
        "main_title" => "Archivos",
        "second_level" => "",
        "add_button" => false
    );
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $breadcrum_info = $this->breadcrum_info;

        $files = File::with('filables')->get();
    
        LogController::store(Auth::user()->id, 'consultar', 0, 'consultar archivos', 'files', $request->url());
   
        return view('files.index', get_defined_vars());
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
       
      /*    $request->merge([
            'models' => [
                [
                    'name' => 'App\Models\User',
                    'id' => 1
                ],
                [
                    'name' => 'App\Models\Contact',
                    'id' => 1 
                ]
            ]
        ]); */
        // + 'file' => {archivo}
     
        $validator = Validator::make($request->all(), [
            'file' => 'required|file'
        ]);
        
        if($validator->passes()){

            $uploaded_file = $request->file('file');

            $request['name'] = uniqid().'_'.time().'.'.$uploaded_file->getClientOriginalExtension();
            
            if($file = File::create($request->all())){

                foreach($request->models as $model){
                    
                    if($model['name']::find($model['id'])){

                        $filable = Filable::create([
                            'file_id' => $file->id,
                            'filable_type' => $model['name'],
                            'filable_id' => $model['id']
                        ]);
                    }
                    
                }
                $uploaded_file->storeAs('/public/files/'. $request->name);
                LogController::store(Auth::user()->id, 'registrar', $file->id, 'registrar un archivo', 'files', $request->url());
                return back()->with('status', 'ok');
            }
        }
        LogController::store(Auth::user()->id, 'error', 0, 'error al registrar un archivo', 'files', $request->url());
        return back()->withErrors($validator->errors());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // return 4242342
        $breadcrum_info = $this->breadcrum_info;
        $breadcrum_info['second_level'] = 'Detalles de archivo';
        $file = File::with('filables')->find($id);

        if($file){
            LogController::store(Auth::user()->id, 'consultar', $file->id, 'consultar un archivo', 'files', request()->url());
            return view('files.show', get_defined_vars());
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al eliminar un archivo', 'files', request()->url());
        return back()->with('status', 'error');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       /*    $request->merge([
            'id' => 1,
            'models' => [
                [
                    'name' => 'App\Models\User',
                    'id' => 1
                ],
                [
                    'name' => 'App\Models\Contact',
                    'id' => 1 
                ]
            ]
        ]);  */
        // + 'file' => {archivo}
    
    
        $validator = Validator::make($request->all(), [
            'file' => 'required|file'
        ]);

        if($validator->passes()){

            $uploaded_file = $request->file('file');

            $request['name'] = uniqid().'_'.time().'.'.$uploaded_file->getClientOriginalExtension();

            $file = File::find($request->id);
            
            if($file){
                
                //eliminar archivo anterior
                if(FacadesFile::exists(public_path().'/storage/files/'.$file->name)){
                    FacadesFile::delete(public_path().'/storage/files/'.$file->name);
                }


                $file->update($request->all());
                $file->filables()->delete();

                foreach($request->models as $model){

                    if($model['name']::find($model['id'])){

                        $filable = Filable::create([
                            'file_id' => $file->id,
                            'filable_type' => $model['name'],
                            'filable_id' => $model['id']
                        ]);
                    }
                }

                $uploaded_file->storeAs('public/files/', $request->name);
                LogController::store(Auth::user()->id, 'registrar', $file->id, 'actualizar un archivo', 'files', $request->url());
                return back()->with('status', 'ok');
            }
        }

        LogController::store(Auth::user()->id, 'error', 0, 'error al registrar un archivo', 'files', $request->url());
        return back()->withErrors($validator->errors());
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = File::find($id);

        if($file){

            $file->delete();
            
            LogController::store(Auth::user()->id, 'eliminar', $id, 'eliminar un archivo', 'files', request()->url());
            return response()->json([
                'message' => 'Registro eliminado correctamete',
                'code' => 1,
                'data' => $id
            ]);
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al eliminar un archivo', 'files', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }
}

