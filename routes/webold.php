<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Individual\DashboardController as IndividualDashboardController;
use App\Http\Controllers\Professional\DashboardController as ProfessionalDashboardController;
use App\Http\Controllers\Volunteer\DashboardController as VolunteerDashboardController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes - COMPLETE WITH PROFILE ROUTES
|--------------------------------------------------------------------------
*/

// Home & Authentication
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration
Route::get('/register/farmer', [RegisterController::class, 'showFarmerForm'])->name('register.farmer');
Route::post('/register/farmer', [RegisterController::class, 'registerFarmer']);
Route::get('/register/professional', [RegisterController::class, 'showProfessionalForm'])->name('register.professional');
Route::post('/register/professional', [RegisterController::class, 'registerProfessional']);
Route::get('/register/volunteer', [RegisterController::class, 'showVolunteerForm'])->name('register.volunteer');
Route::post('/register/volunteer', [RegisterController::class, 'registerVolunteer']);
Route::get('/register', fn() => redirect()->route('register.farmer'))->name('register');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/farmers', [AdminDashboardController::class, 'farmers'])->name('farmers');
    Route::get('/professionals/pending', [AdminDashboardController::class, 'pendingProfessionals'])->name('professionals.pending');
    Route::get('/professionals/{id}/review', [AdminDashboardController::class, 'reviewProfessional'])->name('professionals.review');
    Route::post('/professionals/{id}/approve', [AdminDashboardController::class, 'approveProfessional'])->name('professionals.approve');
    Route::post('/professionals/{id}/reject', [AdminDashboardController::class, 'rejectProfessional'])->name('professionals.reject');
    Route::get('/professionals', [AdminDashboardController::class, 'professionals'])->name('professionals.index');
    Route::get('/farm-records', [AdminDashboardController::class, 'farmRecords'])->name('farm-records.index');
    Route::get('/farm-records/pending', [AdminDashboardController::class, 'pendingFarmRecords'])->name('farm-records.pending');
    Route::get('/farm-records/{id}', [AdminDashboardController::class, 'showFarmRecord'])->name('farm-records.show');
    Route::post('/farm-records/{id}/approve', [AdminDashboardController::class, 'approveFarmRecord'])->name('farm-records.approve');
    Route::post('/farm-records/{id}/reject', [AdminDashboardController::class, 'rejectFarmRecord'])->name('farm-records.reject');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users.index');
    Route::get('/volunteers', [AdminDashboardController::class, 'volunteers'])->name('volunteers.index');
    Route::get('/volunteers/{id}', [AdminDashboardController::class, 'showVolunteer'])->name('volunteers.show');
    Route::post('/volunteers/{id}/deactivate', [AdminDashboardController::class, 'deactivateVolunteer'])->name('volunteers.deactivate');
    Route::get('/service-requests', [AdminDashboardController::class, 'serviceRequests'])->name('service-requests.index');
    Route::get('/analytics', [AdminDashboardController::class, 'analytics'])->name('analytics');
    Route::get('/statistics', [AdminDashboardController::class, 'statistics'])->name('statistics');
});

/*
|--------------------------------------------------------------------------
| Farmer Routes (individual.* names)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:farmer'])->prefix('farmer')->name('individual.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [IndividualDashboardController::class, 'index'])->name('dashboard');
    
    // Profile with UPDATE route
    Route::get('/profile', [IndividualDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [IndividualDashboardController::class, 'updateProfile'])->name('profile.update');
    
    // Livestock
    Route::get('/livestock', [IndividualDashboardController::class, 'livestock'])->name('livestock.index');
    Route::get('/livestock/create', [IndividualDashboardController::class, 'createLivestock'])->name('livestock.create');
    Route::post('/livestock', [IndividualDashboardController::class, 'storeLivestock'])->name('livestock.store');
    Route::get('/livestock/{id}/edit', [IndividualDashboardController::class, 'editLivestock'])->name('livestock.edit');
    Route::put('/livestock/{id}', [IndividualDashboardController::class, 'updateLivestock'])->name('livestock.update');
    Route::delete('/livestock/{id}', [IndividualDashboardController::class, 'destroyLivestock'])->name('livestock.destroy');
    
    // Service Requests
    Route::get('/service-requests', [IndividualDashboardController::class, 'serviceRequests'])->name('service-requests.index');
    Route::get('/service-requests/create', [IndividualDashboardController::class, 'createServiceRequest'])->name('service-requests.create');
    Route::post('/service-requests', [IndividualDashboardController::class, 'storeServiceRequest'])->name('service-requests.store');
    
    // Farm Records - All 6 Steps
    Route::get('/farm-records/step1', [IndividualDashboardController::class, 'farmRecordStep1'])->name('farm-records.step1');
    Route::post('/farm-records/step1', [IndividualDashboardController::class, 'storeFarmRecordStep1'])->name('farm-records.step1.store');
    Route::get('/farm-records/step2', [IndividualDashboardController::class, 'farmRecordStep2'])->name('farm-records.step2');
    Route::post('/farm-records/step2', [IndividualDashboardController::class, 'storeFarmRecordStep2'])->name('farm-records.step2.store');
    Route::get('/farm-records/step3', [IndividualDashboardController::class, 'farmRecordStep3'])->name('farm-records.step3');
    Route::post('/farm-records/step3', [IndividualDashboardController::class, 'storeFarmRecordStep3'])->name('farm-records.step3.store');
    Route::get('/farm-records/step4', [IndividualDashboardController::class, 'farmRecordStep4'])->name('farm-records.step4');
    Route::post('/farm-records/step4', [IndividualDashboardController::class, 'storeFarmRecordStep4'])->name('farm-records.step4.store');
    Route::get('/farm-records/step5', [IndividualDashboardController::class, 'farmRecordStep5'])->name('farm-records.step5');
    Route::post('/farm-records/step5', [IndividualDashboardController::class, 'storeFarmRecordStep5'])->name('farm-records.step5.store');
    Route::get('/farm-records/step6', [IndividualDashboardController::class, 'farmRecordStep6'])->name('farm-records.step6');
    Route::post('/farm-records/step6', [IndividualDashboardController::class, 'storeFarmRecordStep6'])->name('farm-records.step6.store');
});

/*
|--------------------------------------------------------------------------
| Professional Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:animal_health_professional'])->prefix('professional')->name('professional.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ProfessionalDashboardController::class, 'index'])->name('dashboard');
    
    // Profile with UPDATE route
    Route::get('/profile', [ProfessionalDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [ProfessionalDashboardController::class, 'updateProfile'])->name('profile.update');
    
    // Pending approval
    Route::get('/pending-approval', [ProfessionalDashboardController::class, 'pendingApproval'])->name('pending-approval');
    Route::get('/pending', [ProfessionalDashboardController::class, 'pendingApproval'])->name('pending');
    
    // Protected routes (require approval)
    Route::middleware(['approved.professional'])->group(function () {
        Route::get('/farm-records', [ProfessionalDashboardController::class, 'farmRecords'])->name('farm-records.index');
        Route::get('/farm-records/create', [ProfessionalDashboardController::class, 'createFarmRecord'])->name('farm-records.create');
        Route::post('/farm-records', [ProfessionalDashboardController::class, 'storeFarmRecord'])->name('farm-records.store');
        Route::get('/service-requests', [ProfessionalDashboardController::class, 'serviceRequests'])->name('service-requests.index');
        Route::get('/service-requests/{id}', [ProfessionalDashboardController::class, 'showServiceRequest'])->name('service-requests.show');
    });
});

/*
|--------------------------------------------------------------------------
| Volunteer Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:volunteer'])->prefix('volunteer')->name('volunteer.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [VolunteerDashboardController::class, 'index'])->name('dashboard');
    
    // Profile with UPDATE route
    Route::get('/profile', [VolunteerDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [VolunteerDashboardController::class, 'updateProfile'])->name('profile.update');
    
    // Activity
    Route::get('/activity', [VolunteerDashboardController::class, 'activity'])->name('activity');
    
    // Farmer enrollment
    Route::get('/enroll-farmer', [VolunteerDashboardController::class, 'showEnrollForm'])->name('enroll.farmer');
    Route::post('/enroll-farmer', [VolunteerDashboardController::class, 'enrollFarmer'])->name('enroll.farmer.submit');
    
    // My farmers
    Route::get('/my-farmers', [VolunteerDashboardController::class, 'myFarmers'])->name('my-farmers');
    Route::get('/my-farmers/{id}', [VolunteerDashboardController::class, 'showFarmer'])->name('my-farmers.show');
});

/*
|--------------------------------------------------------------------------
| Legacy Route Redirects
|--------------------------------------------------------------------------
*/
Route::get('/register/individual', fn() => redirect()->route('register.farmer'))->name('register.individual');
Route::get('/register/data-collector', fn() => redirect()->route('register.professional'))->name('register.data-collector');
Route::redirect('/individual/vaccinations', '/farmer/dashboard')->name('individual.vaccinations.index');
Route::redirect('/individual/farm-records', '/farmer/farm-records/step1')->name('individual.farm-records.index');
Route::redirect('/individual/service-requests', '/farmer/service-requests')->name('individual.service-requests.index');
Route::redirect('/individual/livestock', '/farmer/livestock')->name('individual.livestock.index');
Route::redirect('/individual/dashboard', '/farmer/dashboard')->name('individual.dashboard');