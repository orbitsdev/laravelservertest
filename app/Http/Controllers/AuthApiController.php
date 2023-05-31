<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{


    public function getUsers(){


        $users = User::all();

        return response()->json(['data'=> $users]);

    }

    public function register(CreateUserRequest $request)
    {
        
        
        // return response()->json([$request->all()]);
    $validatedData = $request->validated();
    $password = $validatedData['password'];

    unset($validatedData['password']);

    $user = new User($validatedData);
    $user->password = Hash::make($password);
    $user->save();


     return  response()->json([
        'success'=> true,
     ], 200);
    
    
    

    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $user->createToken($request->device_name)->plainTextToken;

    }

    public function logout(Request $request){
        $accessToken = $request->bearerToken();
        if ($accessToken) {
            $token = PersonalAccessToken::findToken($accessToken);
            if ($token) {
                $token->delete();
            }
            // $request->       user()->tokens()->delete();
            // $token = PersonalAccessToken::findToken($accessToken);
            // $token->delete();
            // // $request->user()->tokens()->delete();
        }
        // Revoke token

        return response()->json(['success']);
        // return new UserResource(['success']);
    }




    public function testUpload(Request $request){


        if($request->hasFile('file')){
            
            $file = $request->file('file');
            FileController::testUpload($file);
            return response()->json(['file  uploaded'],200);
            
        }else{
            return response()->json(['no file']);
        }
    }
   




}
