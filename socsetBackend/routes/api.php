<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;

// Маршруты для пользователей
Route::get('/users', [UserController::class, 'index']); // Получить список всех пользователей
Route::get('/users/{id}', [UserController::class, 'show']); // Получить конкретного пользователя по ID
Route::post('/users', [UserController::class, 'store']); // Создать нового пользователя
Route::put('/users/{id}', [UserController::class, 'update']); // Обновить информацию о пользователе
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Удалить пользователя

// Маршруты для фотографий
Route::get('/photos', [PhotoController::class, 'index']); // Получить список всех фотографий
Route::get('/photos/{id}', [PhotoController::class, 'show']); // Получить конкретную фотографию по ID
Route::post('/photos', [PhotoController::class, 'store']); // Загрузить новую фотографию
Route::put('/photos/{id}', [PhotoController::class, 'update']); // Обновить информацию о фотографии (например, изменить название)
Route::delete('/photos/{id}', [PhotoController::class, 'destroy']); // Удалить фотографию

// Дополнительные маршруты
Route::get('/users/{id}/photos', [UserController::class, 'userPhotos']); // Получить список фотографий конкретного пользователя
Route::get('/shared-photos', [PhotoController::class, 'sharedPhotos']); // Получить список фотографий, которыми пользователь поделился с другими
