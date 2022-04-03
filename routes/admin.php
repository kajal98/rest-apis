<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

// INITIALIZE THE API
$api = app('Dingo\Api\Routing\Router');

// INITIALIZE API VERSION
$api->version('v1', function ($api) {
    
    // AFTER LOGIN ROUTES FOR ADMIN
    $api->group(
        [
            'prefix' => 'admin',
            'middleware' =>
            [
                'jwt.verify',
                'admin'
            ]
        ],
        function ($api) {
            
            $api->get('get-users', 'App\Http\Controllers\Admin@getUsers');
            $api->get('view-user', 'App\Http\Controllers\Admin@viewUser');
            $api->delete('delete-user', 'App\Http\Controllers\Admin@deleteUser');
        }
    );
});
