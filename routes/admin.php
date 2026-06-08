<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "<h1>Admin Dashboard</h1>";
})->name('dashboard');