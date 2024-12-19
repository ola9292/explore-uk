<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlaceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [PlaceController::class, 'index'])->name('place.index');
    Route::get('/places/create', [PlaceController::class, 'create'])->name('place.create');
    Route::get('/places/{id}', [PlaceController::class, 'show'])->name('place.show');
    Route::post('/places', [PlaceController::class, 'store'])->name('place.store');
    Route::get('/places/edit/{place}', [PlaceController::class, 'edit'])->name('place.edit')->middleware('can:edit,place');
    Route::put('/places/{id}', [PlaceController::class, 'update'])->name('place.update');
    Route::delete('/places/{place}', [PlaceController::class, 'destroy'])->name('place.destroy')->middleware('admin');
    Route::post('/places/{id}/toggle-like', [PlaceController::class, 'toggleLike'])->name('place.like');

});

require __DIR__.'/auth.php';
