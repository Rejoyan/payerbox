<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('auth.login');
});
Route::get('testApi',[HomeController::class,'testApi']);

Route::middleware(['auth'])->group(function () {
    Route::get('/paybox', [HomeController::class,'paybox'])->name('paybox');
    Route::get('/payboxSearch', [HomeController::class,'payboxSearch'])->name('payboxSearch');
//    Route::get('/payboxpush', [HomeController::class,'payboxpush'])->name('payboxpush');
    Route::post('payboxpush-to-payout', [HomeController::class,'payboxpushToPayout'])->name('payboxpush-to-payout');
    Route::get('/bank-count', [HomeController::class,'bankCount'])->name('bank-count');
    Route::get('/bank-count-view', [HomeController::class,'bankCountView'])->name('bank-count-view');
    Route::get('/trx-status-veiw', [HomeController::class,'trxStatusView'])->name('trx-status-veiw');
    Route::get('/trx-rand-veiw', [HomeController::class,'trxRandView'])->name('trx-rand-veiw');
    Route::get('/trx-rand-veiw-signle/{ref}', [HomeController::class,'trxRandViewSingle'])->name('trx-rand-veiw-signle');
    Route::get('/success', [HomeController::class,'success'])->name('success');

    Route::post('import', [HomeController::class, 'import'])->name('import');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
