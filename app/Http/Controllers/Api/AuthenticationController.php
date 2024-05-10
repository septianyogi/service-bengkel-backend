<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required',
            'alamat' => 'required',
            'no' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);

        $password = Hash::make($request->password);
        $request['password'] = $password;

        User::create($request->all());

        return $this->responseOk($request->all(), 'Registrasi berhasil');

    }

    public function login(Request $request) 
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            // throw ValidationException::withMessages([
            //     'message' => 'the provided credentials are invalid'
            // ]);

            return $this->responseError('the provided credentials are invalid');
        }

        $token = $user->createToken('user login')->plainTextToken;

        return $this->responseOk($this->respondWithToken($token), 'login berhasil',);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->responseOk(null, 'Logout berhasil');
    }

    protected function respondWithToken($token)
    {
        return [
            'user' => auth()->user(),
            'token' => $token
        ];
    }

    public function user()
    {
        return response()->json(Auth::user());
    }
}
