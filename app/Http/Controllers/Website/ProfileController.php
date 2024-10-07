<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\UserManagement\User\Models\UserAddressModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{

    // public function __construct() {
    //     $this->middleware('auth');
    // }

    public function profile()
    {
        return Inertia::render('Profile/Index', [
            'event' => [
                'title' => 'Profile',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function orders()
    {
        return Inertia::render('Profile/pages/Orders', [
            'event' => [
                'title' => 'Order History',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function order_details($orderId)
    {
        return Inertia::render('Profile/pages/OrderDetails', [
            'order_id' => $orderId,
            'event' => [
                'title' => 'Order History',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function wish_list()
    {
        return Inertia::render('Profile/pages/Wishlist', [
            'event' => [
                'title' => 'Wish List',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function compare_list()
    {
        return Inertia::render('Profile/pages/Comparelist', [
            'event' => [
                'title' => 'Compare List',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function account()
    {
        return Inertia::render('Profile/pages/Account', [
            'event' => [
                'title' => 'Account Information',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ],
            'user_info' => auth()->user(),
        ]);
    }

    public function address()
    {

        return Inertia::render('Profile/pages/Address', [
            'event' => [
                'title' => 'Order Address',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ],
        ]);
    }

    public function address_create()
    {

        return Inertia::render('Profile/pages/AddressForm', [
            'event' => [
                'title' => 'Order Address',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ],
        ]);
    }
    
    public function password()
    {
        return Inertia::render('Profile/pages/Password', [
            'event' => [
                'title' => 'Change Password',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function edit_account()
    {
        dd(request()->all(), auth()->user()->id);
        $this->validate(request(), [
            "name" => ['required'],
            "user_name" => ['required'],
            "email" => ['required', 'unique:users,email,' . auth()->user()->id],
            "phone_number" => ['required', 'unique:users,phone_number,' . auth()->user()->id],
        ]);

        $user = User::find(auth()->user()->id);
        // dd($user);
        $user->fill(request()->all());
        $user->save();

        return redirect()->back();
    }
    public function edit_address()
    {
        // dd(request()->all());
        $this->validate(request(), [
            "address" => ['required'],
            "country_id" => ['required'],
            "division_id" => ['required'],
            "district_id" => ['required'],
            "station_id" => ['required'],
        ]);

        $address = UserAddressModel::where('user_id', auth()->user()->id)->where('id', request()->id)->first();
        // dd($address);
        $address->fill(request()->all());
        $address->save();

        return redirect()->back();
    }
}
