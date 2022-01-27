<?php

use App\Http\Controllers\DomainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\OpinionController;
use Illuminate\Support\Facades\Route;

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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('/', function () {return view('Home')->with('filterValue', 5);});
Route::get('/home/{filterValue}', [HomeController::class, 'index']);
Route::get('/domain', [DomainController::class,'index']);
Route::get('/domain/{slug}',[DomainController::class,'index']);
Route::get('/practices', [PracticeController::class,'index'])->middleware(['auth']);
Route::get('/practice/{id}',[PracticeController::class,'show']);
Route::get('/practice/{id}/publish',[PracticeController::class,'publish']);
Route::get('/practice/{practiceId}/opinions',[PracticeController::class,'OpenPracticeOpinionsPage']);
Route::resource('/references', ReferenceController::class)->middleware(['auth']);
Route::post('/practice/{practiceId}/opinion/{opinionId}', [OpinionController::class,'addComment'])->name("opinions.addComment")->middleware(['auth']);
Route::get('/practice/{practiceId}/update',function(){abort(403);});
Route::post('/practice/{practiceId}/update',[PracticeController::class,'update']);
