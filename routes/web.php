<?php

use Illuminate\Support\Facades\Route;
use Spatie\PersonalDataExport\Jobs\CreatePersonalDataExportJob;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('filament-companies.auth_session'),
    'verified',
]);

Route::personalDataExports('personal-data-exports');
