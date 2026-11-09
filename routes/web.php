<?php

use App\Http\Controllers\StudentController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'studentCount' => Student::query()->count(),
        'activeStudentCount' => Student::query()->where('is_active', true)->count(),
    ]);
})->name('home');

Route::get('/siswa/{student}/konfirmasi-hapus', [StudentController::class, 'confirmDestroy'])
    ->name('siswa.confirm-destroy');

Route::resource('siswa', StudentController::class)
    ->parameters(['siswa' => 'student'])
    ->except('destroy');

Route::delete('/siswa/{student}', [StudentController::class, 'destroy'])
    ->name('siswa.destroy');
