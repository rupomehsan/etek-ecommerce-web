<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login()
    {

        session()->put('prev_url', url()->previous());
        return Inertia::render('Auth/Login', [
            'event' => [
                'title' => 'ETEK Login',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function register()
    {

        session()->put('prev_url', url()->previous());

        return Inertia::render('Auth/Register', [
            'event' => [
                'title' => 'ETEK Login',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function retailerRegister()
    {

        session()->put('prev_url', url()->previous());

        return Inertia::render('Auth/RetailerRegister', [
            'event' => [
                'title' => 'ETEK Login',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);

    }
}
