<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    public function index()
    {
        $users = Person::all();
        return response()->json([
            'status'=> 200,
            'users'=>$users,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',

        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);
        }
        else
        {
            $user= new Person;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Person Added Successfully',
            ]);
        }

    }



}
