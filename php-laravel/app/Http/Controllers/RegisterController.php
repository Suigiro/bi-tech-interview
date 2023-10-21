<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class RegisterController extends BaseApiController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Erro de Validação.', $validator->errors());
        }

        $input = $request->all();
        $password = Hash::make($request->password);

        $input['password'] = $password;
        $user = User::create($input);

        $success['token'] =  $user->createToken('paciente')->plainTextToken;
        $success['id']    =  $user->id;
        $success['name']  =  $user->name;
        $success['email']  =  $user->email;

        return $this->sendResponse($success, 'User register successfully.');
    }

     public function login(Request $request)
    {

        $password = Hash::make($request->password);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('paciente')->plainTextToken;
            $success['id']    =  $user->id;
            $success['name']  =  $user->name;
            $success['email']  =  $user->email;

            return $this->sendResponse($success, 'User login successfully.');
        } else{
            return $this->sendError('Unauthorised.', ['error'=> 'Unauthorised']);
        }
    }

}
