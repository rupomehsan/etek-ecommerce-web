<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Modules\UserManagement\User\Models\Model as User;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| oAuth Routes
|--------------------------------------------------------------------------
|
*/


require_once __DIR__ . '/../app/Modules/Auth/GoogleAuth/Route.php';

require_once __DIR__ . '/../app/Modules/Auth/FacebookAuth/Route.php';
