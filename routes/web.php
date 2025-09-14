<?php

use App\Livewire\Export\Csv;
use App\Livewire\Example\Example;
use App\Livewire\Profile\Profile;
use App\Livewire\MasterData\Produk;
use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Livewire\Control\User as ControlUser;
use App\Http\Controllers\TemperatureExportController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/export/csv', Csv::class)->name('export.csv');
    Route::get('/profile', Profile::class);
    Route::get('/exports/temperatures.csv', [TemperatureExportController::class, 'export'])
        ->name('temperatures.export');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // Route::get('/example', Example::class);
    // Route::get('/control-user', ControlUser::class);
    // Route::get('produk', Produk::class)->name('produk');
});

Route::group(['middleware' => ['auth', 'role:user']], function () {});
require __DIR__ . '/auth.php';
