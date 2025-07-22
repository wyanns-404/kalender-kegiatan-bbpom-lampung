<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;

Route::get('/', function () {
    return view('publicAgenda');
});

Route::get('/staff', function () {
    return view('staffAgenda');
});

Route::get('/agenda', [AgendaController::class, 'getPublicAgendas'])->name('agenda.public');
Route::get('/agenda/staff', [AgendaController::class, 'getStaffAgendas'])->name('agenda.staff');
