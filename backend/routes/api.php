<?php
// routes/api.php  — para el Arduino/dispositivo
use App\Http\Controllers\Api\MedicionController;
use App\Http\Controllers\Api\SesionController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mediciones',      [MedicionController::class, 'store']);
    Route::get('/sesiones/{id}',    [SesionController::class,   'show']);
});