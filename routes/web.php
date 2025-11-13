<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ConcernController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Agenda Module Routes
|--------------------------------------------------------------------------
| Roles:
| - Admin (Secretariat): full CRUD access
| - Member (Agent/User): can view agendas and comment/raise concerns
| - Viewer: can only view agendas
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return view('welcome');
});

// Shared dashboard
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// One shared agendas resource for all roles
Route::middleware(['auth'])->group(function () {

    //----------for page viewing
    Route::prefix('/app')->group(function () {

        Route::get('/home', function () { return view('v2.pages.home'); })->name('home');

        Route::get('/create-agenda', function () { return view('v2.pages.agenda.create'); })->name('agenda.create');
        Route::get('/view-agenda', function () { return view('v2.pages.agenda.view-all'); })->name('agenda.view-all');
        Route::get('/view-agenda/{agenda_id}', [AgendaController::class, 'clickedAgenda'])->name('agenda.view');

        Route::get('/concerns', function () { return view('v2.pages.concerns.all-concerns'); })->name('concerns.all-concerns');
        Route::get('/concerns/me', function () { return view('v2.pages.concerns.my-concerns'); })->name('concerns.my-concerns');

        Route::get('/calendar', function () { return view('v2.pages.calendar'); })->name('calendar');

        Route::get('/history', function () { return view('v2.pages.archives.history'); })->name('archives.history');
        Route::get('/reports', function () { return view('v2.pages.archives.reports'); })->name('archives.reports');

        Route::get('/users', function () { return view('v2.pages.people'); })->name('people');

        Route::get('/profile', function () { return view('v2.pages.settings.profile'); })->name('settings.profile');
        Route::get('/security', function () { return view('v2.pages.settings.security'); })->name('settings.security');
        
    });

    //----------for api routes
    Route::get('/agendas/archived', [AgendaController::class, 'archived'])->name('agendas.archived');
    Route::put('/agendas/{id}/restore', [AgendaController::class, 'restore'])->name('agendas.restore');
    Route::resource('agendas', AgendaController::class);

    //----Json api
    Route::get('/agenda-load', [AgendaController::class, 'loadAgendas'])->name('agendas.load');
  
    Route::prefix('concerns')->group(function () {
        // Specific routes FIRST
        Route::get('/your', [ConcernController::class, 'yourConcerns'])->name('concerns.your');
        Route::get('/all', [ConcernController::class, 'allConcerns'])->name('concerns.all');

        // Then the dynamic routes
        Route::get('/{agenda_id}', [ConcernController::class, 'index'])->name('concerns.index');
        Route::get('/{agenda_id}/create', [ConcernController::class, 'create'])->name('concerns.create');
        Route::post('/', [ConcernController::class, 'store'])->name('concerns.store');
        Route::get('/edit/{id}', [ConcernController::class, 'edit'])->name('concerns.edit');
        Route::put('/{id}', [ConcernController::class, 'update'])->name('concerns.update');
        Route::delete('/{id}', [ConcernController::class, 'destroy'])->name('concerns.destroy');
        Route::get('/show/{id}', [ConcernController::class, 'show'])->name('concerns.show');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');

});

// Admin dashboard
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

require __DIR__.'/auth.php';