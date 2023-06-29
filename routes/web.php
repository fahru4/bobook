<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Admin\Book\IndexController;
use App\Http\Controllers\Admin\Book\UpdateController;
use App\Http\Controllers\Member\Transaction\StoreController;
use App\Http\Controllers\Admin\Book\StoreController as AdminStoreController;
use App\Http\Controllers\Member\UpdateController as AdminMemberDeleteController;

use App\Http\Controllers\Admin\Member\IndexController as AdminMemberIndexController;
use App\Http\Controllers\Admin\Member\StoreController as AdminMemberStoreController;
use App\Http\Controllers\Admin\Member\UpdateController as AdminMemberUpdateController;
use App\Http\Controllers\Admin\Transaction\IndexController as AdminTransactionController;
use App\Http\Controllers\Member\Transaction\IndexController as TransactionIndexController;

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
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('admin/login', [AuthController::class, 'formAdminLogin']);
Route::get('member/login', [AuthController::class, 'formMemberLogin'])->name('login');
Route::post('admin/login', [AuthController::class, 'adminLogin'])->name('admin-login');
Route::post('member/login', [AuthController::class, 'memberLogin'])->name('member-login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return view('welcome');
});

// Routes Admin
Route::group(['prefix' => 'admin','middleware' => ['auth:admin']], function() {
    Route::get('index', [AdminController::class, 'index'])->name('admin-index');
    Route::get('book', [IndexController::class, 'index'])->name('admin-book-index');
    Route::get('book/create', [ AdminStoreController::class, 'store'])->name('admin-book-form');
    Route::get('book/edit/{id}', [ UpdateController::class, 'update'])->name('admin-book-edit');
    Route::post('book/update/{id}', [ UpdateController::class, 'update'])->name('admin-book-update');
    Route::post('book/store', [ AdminStoreController::class, 'store'])->name('admin-book-store');
    Route::delete('delete-book/{id}', [IndexController::class, 'delete'])->name('admin-book-delete');

    Route::get('member', [AdminMemberIndexController::class, 'index'])->name('admin-member-index');
    Route::get('member/create', [ AdminMemberStoreController::class, 'store'])->name('admin-member-form');
    Route::post('member/store', [ AdminMemberStoreController::class, 'store'])->name('admin-member-store');
    Route::get('member/edit/{id}', [ AdminMemberUpdateController::class, 'update'])->name('admin-member-edit');
    Route::post('member/update/{id}', [ AdminMemberUpdateController::class, 'update'])->name('admin-member-update');
    Route::delete('delete-member/{id}', [AdminMemberIndexController::class, 'delete'])->name('admin-member-delete');

    Route::get('transaction', [AdminTransactionController::class, 'index'])->name('admin-transaction-index');
    Route::post('transaction/status/{id}', [AdminTransactionController::class, 'status'])->name('admin-transaction-status');
});

// Routes Member
Route::group(['prefix' => 'member','middleware' => ['auth:member']], function() {
    Route::get('index', [MemberController::class, 'index'])->name('member-index');
    Route::get('transaction', [TransactionIndexController::class, 'index'])->name('member-transaction');
    Route::get('transaction/form', [StoreController::class, 'store'])->name('member-transaction-form');
    Route::post('transaction/store',[StoreController::class, 'store'])->name('member-transaction-store');
    // Route::post('transaction/areate', [StoreController::class, 'store'])->name('member-transaction-store');
});
