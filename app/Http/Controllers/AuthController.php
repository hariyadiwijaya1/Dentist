<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\UserDetail;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ApiResource;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Client\Request as ClientRequest;

class AuthController extends Controller
{
    public function login()
    {
        // request()->validate([
        //     'email'     => request('email'),
        //     'password'  => request('password'),
        // ]);

        $data = [
            'email'     => request('email'),
            'password'  => request('password'),
        ];

        if (!auth()->attempt($data))
        {
            return response()->json(new ApiResource(false,'Username atau password tidak cocok', null), 401);
        }

        if (Auth::check())
        {
            auth()->user()->tokens->each(function($token, $key)
            {
                $token->delete();
            });
        }

        $token = auth()->user()->createToken('token')->accessToken;

        $data = [
            'token' => $token,
            'user' => auth()->user(),
        ];

        return new ApiResource(true, 'Berhasil Login', $data);
    }

    public function register()
    {
        //untuk menangkap beberapa data sehingga dapat menghandle error
        try{
            DB::transaction(function () {
                $user = User::create([
                    'name'      => request('name'),
                    'email'     => request('email'),
                    'password'  => bcrypt(request('password')),
                    'role'      => 0
                ]);

                UserDetail::create([
                    'id'            => $user->id,
                    'user_number'   => request('user_number'),
                    'gender'        => request('gender'),
                    'blood_group'   => request('blood_group'),
                    'address'       => request('address'),
                    'phone'         => request('phone'),
                    'photo'         => request()->file('photo')->store('img/users'),
                ]);
            });
        } catch(Exception $e){
            return response( new ApiResource(false,'Error',$e), 400);
        }
        return new ApiResource(true, 'Berhasil Registrasi User');
    }

    public function logout()
    {
        if (auth()->user())
        {
            auth()->user()->tokens->each(function($token, $key){
                $token->delete();
            });
        }
        return new ApiResource(true, 'Berhasil Logout');
    }
}
