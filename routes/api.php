<?php

use App\Http\Controllers\ProjectController;
    use App\Http\Controllers\ProjectDonationController;
    use App\Http\Controllers\ProjectImageController;
    use App\Http\Controllers\ProjectTypeController;
    use App\Http\Controllers\ProjectUpdateController;
    use Illuminate\Support\Facades\Route;

Route::apiResource('project-type', ProjectTypeController::class);
Route::apiResource('project', ProjectController::class);
Route::prefix('project/{project}')->group(function () {
    Route::apiResource('donation', ProjectDonationController::class)->parameters([
        'donation' => 'projectDonation',
    ]);
    Route::apiResource('update', ProjectUpdateController::class)->parameters([
        'update' => 'projectUpdate',
    ]);
    Route::apiResource('image', ProjectImageController::class)->parameters([
        'image' => 'projectImage',
    ]);
});
