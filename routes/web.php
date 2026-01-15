<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\WorkController;


Route::get('/', function () { return view('welcome');});

Route::get('/contact',[ContactsController::class, 'index'])->name('contact.page');
Route::get('/agency',[AgencyController::class, 'index'])->name('agency.page');
Route::get('/case-studies',[WorkController::class, 'index'])->name('case-studies.page');
