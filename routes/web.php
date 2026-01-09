<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Models\DiagnosisHistory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// ==================== DIAGNOSIS ROUTES ====================
Route::prefix('diagnosis')->name('diagnosis.')->group(function () {

    // Halaman utama diagnosa
    Route::get('/', [DiagnosisController::class, 'index'])->name('index');

    // Form diagnosa
    Route::get('/create', [DiagnosisController::class, 'create'])->name('create');

    // Proses jawaban per gejala
    Route::post('/answer', [DiagnosisController::class, 'answer'])->name('answer');

    // Reset diagnosa
    Route::get('/reset', [DiagnosisController::class, 'reset'])->name('reset');

    // Riwayat diagnosa
    Route::get('/history', [DiagnosisController::class, 'history'])->name('history');

    // Detail riwayat (pakai controller)
    Route::get('/history/{id}', [DiagnosisController::class, 'showHistory'])
        ->name('history.detail');
});

// ==================== ADMIN ROUTES ====================

// Login Routes
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function (\Illuminate\Http\Request $request) {
    // Validasi input
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('web')->attempt($credentials)) {
        $user = Auth::user();

        // Cek role
        if ($user->role !== 'admin') {
            Auth::logout();
            return back()->withErrors(['email' => 'Hanya admin yang boleh login.']);
        }

        // Regenerate session supaya aman
        $request->session()->regenerate();

        // Redirect ke dashboard admin
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
})->name('admin.login.submit');

Route::post('/admin/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login');
})->name('admin.logout');

// ==================== ADMIN PROTECTED ROUTES ====================
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Diseases
    Route::get('/diseases', [AdminController::class, 'diseases'])->name('diseases');
    Route::get('/diseases/create', [AdminController::class, 'createDisease'])->name('diseases.create');
    Route::post('/diseases', [AdminController::class, 'storeDisease'])->name('diseases.store');
    Route::get('/diseases/{id}/edit', [AdminController::class, 'editDisease'])->name('diseases.edit');
    Route::put('/diseases/{id}', [AdminController::class, 'updateDisease'])->name('diseases.update');
    Route::delete('/diseases/{id}', [AdminController::class, 'destroyDisease'])->name('diseases.destroy');

    // Symptoms
    Route::get('/symptoms', [AdminController::class, 'symptoms'])->name('symptoms');
    Route::get('/symptoms/create', [AdminController::class, 'createSymptom'])->name('symptoms.create');
    Route::post('/symptoms', [AdminController::class, 'storeSymptom'])->name('symptoms.store');
    Route::get('/symptoms/{id}/edit', [AdminController::class, 'editSymptom'])->name('symptoms.edit');
    Route::put('/symptoms/{id}', [AdminController::class, 'updateSymptom'])->name('symptoms.update');
    Route::delete('/symptoms/{id}', [AdminController::class, 'destroySymptom'])->name('symptoms.destroy');

    // Diagnosis Histories
    Route::get('/histories', [AdminController::class, 'histories'])->name('histories');
    Route::delete('/histories/{id}', [AdminController::class, 'destroyHistory'])->name('histories.destroy');
    Route::get('/histories/export/csv', [AdminController::class, 'exportHistoriesCSV'])->name('histories.export.csv');
    Route::get('/histories/{id}', [AdminController::class, 'showHistory'])->name('histories.show');

    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
});
