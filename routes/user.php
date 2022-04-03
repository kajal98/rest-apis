<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

// INITIALIZE THE API
$api = app('Dingo\Api\Routing\Router');

// INITIALIZE API VERSION
$api->version('v1', function ($api) {
    
    // AFTER LOGIN ROUTES FOR USER
    $api->group(
        [
            'prefix' => 'user',
            'middleware' =>
            [
                'jwt.verify',
                'user'
            ]
        ],
        function ($api) {
            
            $api->get('get-my-profile', 'App\Http\Controllers\Users@getMyProfile');
            $api->post('update-my-profile', 'App\Http\Controllers\Users@updateMyProfile');
        }
    );
});
