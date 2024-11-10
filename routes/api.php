<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\ProgressController;
use App\Http\Controllers\Admin\VideoController;

Route::get('courses', [CourseController::class, 'index']);
Route::get('courses/{id}', [CourseController::class, 'show']);
Route::post('comments', [CommentController::class, 'store']);
Route::post('likes', [LikeController::class, 'store']);
Route::post('progress', [ProgressController::class, 'update']);

Route::middleware('auth:sanctum')->group(function() {
    // Listar cursos
    Route::get('courses', [CourseController::class, 'index']);
    Route::get('courses/{course}', [CourseController::class, 'show']);

    // Ver videos de un curso
    Route::get('courses/{course}/videos', [VideoController::class, 'index']);
    Route::get('videos/{video}', [VideoController::class, 'show']);

    // Registrar comentario en un video
    Route::post('comments', [CommentController::class, 'store']);

    // Dar like a un video
    Route::post('likes', [LikeController::class, 'store']);

    // Manejar el progreso del usuario en un curso
    Route::post('progress', [ProgressController::class, 'update']);
});
