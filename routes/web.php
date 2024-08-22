<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/booking', function() {
    return Inertia::render('Booking');
});

Route::get('/reservations', function(){
    return Inertia::render('Reservations');
});