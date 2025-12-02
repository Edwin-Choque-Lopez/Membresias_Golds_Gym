<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::resource('/staff', App\Http\Controllers\StaffController::class)->names('staff');
Route::resource('/clients', App\Http\Controllers\PeopleController::class)->names('clients');
Route::resource('/memberships', App\Http\Controllers\MembershipController::class)->names('memberships');
Route::get('/clientmemberships/form',[App\Http\Controllers\ClientMembershipController::class, 'form'])->name('forms');
Route::post('/clientmemberships/individualmembership',[App\Http\Controllers\ClientMembershipController::class, 'individual'])->name('individual_membership');
Route::get('/clientmemberships/form/{id}/membership',[App\Http\Controllers\ClientMembershipController::class, 'individual_form'])->name('individual_membership_form');
Route::post('/clientmemberships/createindividualmembership',[App\Http\Controllers\ClientMembershipController::class, 'create'])->name('create_individual_membership');
Route::get('/clientmemberships/activemembreships',[App\Http\Controllers\ClientMembershipController::class, 'active'])->name('active_membership');
Route::get('/clientmemberships/pendingmembreships',[App\Http\Controllers\ClientMembershipController::class, 'pending'])->name('pending_membership');    
//Route::resource('/clientmemberships',App\Http\Controllers\ClientMembershipController::class)->names('clientmemberships');

