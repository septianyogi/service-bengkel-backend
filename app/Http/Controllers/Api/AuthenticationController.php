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
            'password' => 'required|min:8'
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

        $role = $user->role;

        $token = $user->createToken('user login')->plainTextToken;

        return $this->responseOk($this->respondWithToken($user, $role,  $token), 'login berhasil',);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->responseOk(null, 'Logout berhasil');
    }

    protected function respondWithToken($user,$role, $token)
    {
        return [
            'user' => $user,
            'role' => $role,
            'token' => $token
        ];
    }

    public function profile($id)
    {
        $user = User::where('id', $id)->first();
        return $this->responseOk($user,'profile data');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'password' => 'min:8'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $user->update($request->all());

        return $this->responseOk($user, 'Update berhasil');
    }
}
