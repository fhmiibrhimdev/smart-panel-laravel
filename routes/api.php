<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SolarPanelController;

Route::get('/solar-panel/micro-1/data', [SolarPanelController::class, 'store']);
Route::get('/solar-panel/micro-1/temp', [SolarPanelController::class, 'storeTemp']);
Route::get('/solar-panel/micro-1/voltage', [SolarPanelController::class, 'storeVoltage']);
Route::get('/solar-panel/micro-1/current', [SolarPanelController::class, 'storeCurrent']);
Route::get('/solar-panel/micro-2/irradiance', [SolarPanelController::class, 'storeIrradiance']);
