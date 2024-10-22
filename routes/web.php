<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
});

Route::get('/faleconosco', function () {
    return view('faleconosco');
});