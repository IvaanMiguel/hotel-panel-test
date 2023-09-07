<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Log;
use Database\Seeders\HotelSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class HotelController extends Controller
{
    public $breadcrumb_info = [
        'main_title' => 'Hotels',
        'second_level' => '',
        'add_button' => false
    ];

    public function index()
    {

        $breadcrumb_info = $this->breadcrumb_info;

        $user = Auth::user();

        $is_admin = $user->isAdmin();

        $breadcrumb_info['add_button'] = ($is_admin);

        $hotels = Hotel::with('images')->get();

        LogController::store(Auth::user()->id, 'consultar', 0, 'consultar hoteles', 'hotels', request()->url());

        return view('hotels.index', get_defined_vars());
    }


    public function store(Request $request)
    {


        /*         $request->merge([
            'name' => 'asad',
            'email' => 'qweqweew'.time(),
            'slug' => 'aeqweqweqwe'.time(),
            'address' => 'qweqwe',
            'url_address' => 'qweqe',
            'phone_number' => '123123'
        ]);  */

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:hotels',
            'slug' => 'required|unique:hotels',
            'address' => 'required',
            'url_address' => 'required',
            'cover' => 'file'
        ]);

        // return $validator->errors();

        if ($validator->passes()) {

            $hotel = Hotel::create($request->all());

            if ($request->hasFile('cover')) {

                $file = $request->file('cover');

                $name_file = $hotel->slug . '_portada.' . $file->getClientOriginalExtension();

                $path = $request->file('cover')->storeAs(
                    'public/hotels/',
                    $name_file
                );

                $image = Image::create([
                    'url' => $name_file,
                    'type' => 'cover',
                    'imageable_type' => Hotel::class,
                    'imageable_id' => $hotel->id,
                    'is_cover' => true
                ]);
            }
            LogController::store(Auth::user()->id, 'Registrar', $hotel->id, 'registro de un nuevo hotel', 'hotels', request()->url());

            return back()->with('success', 'ok');
        }


        LogController::store(Auth::user()->id, 'Error', 0, 'Error al registrar un hotel', 'hotels', request()->url());
        return back()->with('status', 'error');
    }

    public function show($id)
    {
        $breadcrumb_info = $this->breadcrumb_info;

        $breadcrumb_info['second_level'] = 'Detalles';
        $breadcrumb_info['add_button'] = false;

        $hotel = Hotel::with('images')
            ->find($id);

        if ($hotel) {
            LogController::store(Auth::user()->id, 'Consultar', $hotel->id, 'consultar un hotel', 'hotels', request()->url());

            return view('hotels.show', get_defined_vars());
        }

        LogController::store(Auth::user()->id, 'Error', 0, 'Error en el servidor', 'hotels', request()->url());

        return back()->with('error', 'Error en el servidor');
    }

    public function update(Request $request)
    {

        /*     $request->merge([
            'id' => '1',
            'name' => 'asad',
            'email' => 'qweqweew'.time(),
            'slug' => 'aeqweqweqwe'.time(),
            'address' => 'qweqwe',
            'url_address' => 'qweqe',
            'phone_number' => '123123'
        ]); 
 */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:hotels,email,' . $request->id,
            'slug' => 'required|unique:hotels,slug,' . $request->id,
            'address' => 'required',
            'url_address' => 'required',
        ]);

        if ($validator->passes()) {

            $hotel = Hotel::find($request->id);

            if ($hotel && $hotel->update($request->all())) {

                if ($request->hasFile('cover')) {

                    $file = $request->file('cover');

                    $new_file_name = 'hotel_cover' . uniqid() . $hotel->id . '.' . $file->getClientOriginalExtension();

                    $path = $request->file('cover')->storeAs('public/hotels', $new_file_name);

                    $original_cover = $hotel->cover;


                    // error_log(public_path().'/storage/'.$original_cover->url);

                    if ($original_cover && File::exists(public_path() . '/storage/hotels/' . $original_cover->url)) {
                        File::delete(public_path() . '/storage/hotels/' . $original_cover->url);
                    }

                    if ($original_cover) {

                        $original_cover->update(['url' => $new_file_name]);
                        // error_log('updated');
                    } else {
                        // error_log('created');
                        Image::create([
                            'url' => $new_file_name,
                            'type' => 'cover',
                            'imageable_type' => Hotel::class,
                            'imageable_id' => $hotel->id
                        ]);
                    }
                }

                LogController::store(Auth::user()->id, 'Actualizar', $hotel->id, 'Actualizar un hotel', 'hotels', request()->url());
                return back()->with('status', 'ok');
            }
        }
        LogController::store(Auth::user()->id, 'Error', $request->id, 'Error al actualizar un hotel', 'hotels', request()->url());
        return back()->withErrors($validator->errors());
    }

    public function destroy($id)
    {

        $hotel = Hotel::find($id);

        if ($hotel) {

            $hotel->delete();

            LogController::store(Auth::user()->id, 'eliminar', $hotel->id, 'eliminar un hotel', 'hotels', request()->url());
            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 1,
                'data' => $id
            ]);
        }

        LogController::store(Auth::user()->id, 'Error', $id, 'error al eliminar un hotel', 'hotels', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }


    public function get($id)
    {

        $hotel = Hotel::find($id);

        if ($hotel) {

            LogController::store(Auth::user()->id, 'consultar', $id, 'consultar un hotel', 'hotels', request()->url());
            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => 1,
                'data' => $hotel
            ]);
        }

        LogController::store(Auth::user()->id, 'error', $id, 'Error al obtener hotel', 'hotels', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }
}
