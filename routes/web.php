<?php

use Illuminate\Foundation\Console\RouteClearCommand;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\SampleController;
use Knp\Snappy\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('cases', [LegalController::class, 'index']);

Route::post('case', [LegalController::class,'store'])->name('case.store');


Route::delete('deletecase/{id}', [LegalController::class, 'destroy'])->name('delete.destoy');;

Route::get('editcase/{id}', [LegalController::class, 'edit'])->name('case.edit');

Route::get('pdf/{id}', [LegalController::class, 'pdf']);

Route::post('/updatecase', [LegalController::class, 'update'])->name('case.update');

Route::get('/pdf/{id}', [LegalController::class, 'pdf']);


Route::get('/home', function () {
    return view('home');
});

Route::get('/sample', function () {
    return view('sample');
});



// Route::get('/cases', [SampleController::class, 'index']);
// Route::delete('/case/{case}', [SampleController::class, 'destroy']);
