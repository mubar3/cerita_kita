<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JSvalidation;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }

        $validator = JSvalidation::make([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        return view('login.login')->with([
            'title'     => $this->title,
            'validator' => $validator,
            'logo' => $this->logo,
        ]);
    }

    public function login(Request $r)
    {
        // print (Hash::make($r->password));
        // die();
        if (Auth::attempt([
            'email' => $r->username,
            'password' => $r->password,
            'status'   => 'y',
            'tipe'   => 'web'
            ])) {

            return redirect('/roles/pilihan');

        }else{
            return redirect(route('login'))->with([
                'pesan' => '<div class="alert alert-danger">Login gagal, username atau password salah!</div>'
            ]);
        }

        // return redirect(route('home'));
    }

    public function logout()
    {
        session()->flush();
        return redirect(route('login'));
    }
}
