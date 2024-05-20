<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::get('/reset', 'reset')->name('reset');
    Route::post('/store', 'store')->name('store');
    Route::post('/updatePassword', 'updatePassword')->name('updatePassword');
    Route::get('/logins', 'logins')->name('logins');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/dashboard2', 'dashboard2')->name('dashboard2');
    
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('ajax-crud-datatable', [BarangController::class, 'index'])->name('ajax-crud-datatable');
Route::post('store', [BarangController::class, 'store']);
Route::post('edit', [BarangController::class, 'edit']);
Route::post('delete', [BarangController::class, 'destroy']);


Route::get('ajax-crud-customer', [CustomerController::class, 'index'])->name('ajax-crud-customer');
Route::post('store', [CustomerController::class, 'store']);
Route::post('edit', [CustomerController::class, 'edit']);
Route::post('delete', [CustomerController::class, 'destroy']);

Route::get('ajax-crud-transaksi', [TransaksiController::class, 'index'])->name('ajax-crud-transaksi');
Route::get('create', [TransaksiController::class, 'create'])->name('create');
Route::post('store', [TransaksiController::class, 'store'])->name('store');


Route::get('ajax-crud-transaksi2', [TransaksiController::class, 'indexUser'])->name('ajax-crud-transaksi2');
// Route::get('create2', [TransaksiController::class, 'create2'])->name('create2');
// Route::post('store2', [TransaksiController::class, 'store'])->name('store');



Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
