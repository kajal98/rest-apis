<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

// INITIALIZE THE API
$api = app('Dingo\Api\Routing\Router');

// INITIALIZE API VERSION
$api->version('v1', function ($api) {

    // AUTH ROUTES FOR TUTOR AND STUDENTS
        $api->post('registration', 'App\Http\Controllers\Sessions@registration');
        $api->post('verify-account/{token}', 'App\Http\Controllers\Sessions@verifyAccount');
        $api->post('create-password', 'App\Http\Controllers\Sessions@createPassword');
        $api->post('login', 'App\Http\Controllers\Sessions@login');
        $api->post('refresh-token', 'App\Http\Controllers\Sessions@refreshToken');
        $api->post('forgot-password', 'App\Http\Controllers\Sessions@forgotPassword');
        $api->post('reset-password/{token}', 'App\Http\Controllers\Sessions@resetPassword');
});
