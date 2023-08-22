<?php
use Illuminate\Support\Facades\Route;
use Fieroo\Furnitures\Controllers\FurnishingController;
    
Route::group(['prefix' => 'admin', 'middleware' => ['web','auth']], function() {
    Route::resource('/furnishings', FurnishingController::class);
    Route::post('/furnishings/stands', [FurnishingController::class, 'getStandsList']);
    Route::post('/furnishings/stands_types', [FurnishingController::class, 'getStandType']);
    Route::get('/furnishings/{id}/variants', [FurnishingController::class, 'indexVariant']);
    Route::get('/furnishings/{id}/variants/create', [FurnishingController::class, 'createVariant']);
    Route::get('/furnishings/{id}/variants/{variant}/edit', [FurnishingController::class, 'editVariant']);
    Route::post('/furnishings/{id}/variants/storeVariant', [FurnishingController::class, 'storeVariant'])->name('furnishings.store-variant');
    Route::post('/furnishings/variants/{variant}/updateVariant', [FurnishingController::class, 'updateVariant'])->name('furnishings.update-variant');
    Route::delete('/furnishings/variants/{variant}/destroyVariant', [FurnishingController::class, 'destroyVariant'])->name('furnishings.destroy-variant');
});