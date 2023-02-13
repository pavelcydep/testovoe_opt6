<?php
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Library\ApiHelpers;

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

Auth::routes();
Route::get('api/token', [ApiController::class, 'tokenAdd'])->middleware('auth');
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); 
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');



Route::post('orders/create', [OrderController::class, 'store']); 
Route::post('orders/update', [OrderController::class, 'update']); 
Route::delete('orders/{id}/destroy', [OrderController::class, 'destroy']); 


Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('api/orders', [ApiController::class, 'orderGet']);
    Route::get('api/orders/{id}', [ApiController::class, 'editApi']);
    Route::post('api/store', [ApiController::class, 'storeApi']);
    Route::delete('api/destroy/{id}', [ApiController::class, 'destroyApi']); 
});
