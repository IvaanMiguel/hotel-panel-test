<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Mail\ContactAnswerMail;
use App\Models\Answer;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
      /*   $request->merge([
            'contact_id' => 1,
            'text' => 'hola',
            'user_id' => 3
        ]); */

        $request['user_id'] = $request['user_id'] ?? Auth::id();
        $validator = Validator::make($request->all(), [
            'contact_id' => 'required|exists:contacts,id',
            'text' => 'required',
            'user_id' => 'sometimes|exists:users,id',
        ]);


        if($validator->passes()){

            if($answer = Answer::create($request->all())){

                $contact = $answer->contact;

                if(isset($contact->client->email)){

                    Mail::to($contact->client->email)->send(new ContactAnswerMail($answer, $contact));
        
                    LogController::store(Auth::user()->id, 'registrar', $answer->id, 'registrar una respuesta' ,'answers', $request->url());
                    return back()->with('status', 'ok');
        
                }
            }
        }

        LogController::store(Auth::user()->id, 'error', 0, 'error al registrar una respuesta', 'answers', $request->url());
        return back()->withErrors($validator->errors());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
