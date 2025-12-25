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
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome Page & Authentication
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes - Role Specific
Route::get('/register/farmer', [RegisterController::class, 'showFarmerForm'])->name('register.farmer');
Route::post('/register/farmer', [RegisterController::class, 'registerFarmer']);

Route::get('/register/professional', [RegisterController::class, 'showProfessionalForm'])->name('register.professional');
Route::post('/register/professional', [RegisterController::class, 'registerProfessional']);

Route::get('/register/volunteer', [RegisterController::class, 'showVolunteerForm'])->name('register.volunteer');
Route::post('/register/volunteer', [RegisterController::class, 'registerVolunteer']);

// Legacy route - redirect to farmer registration
Route::get('/register', function () {
    return redirect()->route('register.farmer');
})->name('register');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Farmers
    Route::get('/farmers', [AdminDashboardController::class, 'farmers'])->name('farmers');
    
    // Animal Health Professionals
    Route::get('/professionals/pending', [AdminDashboardController::class, 'pendingProfessionals'])->name('professionals.pending');
    Route::get('/professionals/{id}/review', [AdminDashboardController::class, 'reviewProfessional'])->name('professionals.review');
    Route::post('/professionals/{id}/approve', [AdminDashboardController::class, 'approveProfessional'])->name('professionals.approve');
    Route::post('/professionals/{id}/reject', [AdminDashboardController::class, 'rejectProfessional'])->name('professionals.reject');
    Route::get('/professionals', [AdminDashboardController::class, 'professionals'])->name('professionals.index');
    
    // Farm Records
    Route::get('/farm-records', [AdminDashboardController::class, 'farmRecords'])->name('farm-records.index');
    Route::get('/farm-records/pending', [AdminDashboardController::class, 'pendingFarmRecords'])->name('farm-records.pending');
    Route::get('/farm-records/{id}', [AdminDashboardController::class, 'showFarmRecord'])->name('farm-records.show');
    Route::post('/farm-records/{id}/approve', [AdminDashboardController::class, 'approveFarmRecord'])->name('farm-records.approve');
    Route::post('/farm-records/{id}/reject', [AdminDashboardController::class, 'rejectFarmRecord'])->name('farm-records.reject');
    
    // Users
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users.index');
    
    // Volunteers
    Route::get('/volunteers', [AdminDashboardController::class, 'volunteers'])->name('volunteers.index');
    Route::get('/volunteers/{id}', [AdminDashboardController::class, 'showVolunteer'])->name('volunteers.show');
    Route::post('/volunteers/{id}/deactivate', [AdminDashboardController::class, 'deactivateVolunteer'])->name('volunteers.deactivate');
    
    // Service Requests
    Route::get('/service-requests', [AdminDashboardController::class, 'serviceRequests'])->name('service-requests.index');
    
    // Analytics & Statistics
    Route::get('/analytics', [AdminDashboardController::class, 'analytics'])->name('analytics');
    Route::get('/statistics', [AdminDashboardController::class, 'statistics'])->name('statistics');
});

/*
|--------------------------------------------------------------------------
| Farmer Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:farmer'])->prefix('farmer')->name('individual.')->group(function () {
    Route::get('/dashboard', [IndividualDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [IndividualDashboardController::class, 'profile'])->name('profile');
    // // Livestock Registration Steps (NEW - FIXES YOUR ERROR)
    // Route::get('/livestock/step/{step}', [IndividualDashboardController::class, 'showStep'])->name('livestock.step');
    // Route::post('/livestock/step/{step}', [IndividualDashboardController::class, 'saveStep'])->name('livestock.step.save');
    // Route::post('/livestock/save-draft', [IndividualDashboardController::class, 'saveDraft'])->name('livestock.save-draft');
    // Route::post('/livestock/submit', [IndividualDashboardController::class, 'submitLivestock'])->name('livestock.submit');
    // // Livestock
    // Route::get('/livestock', [IndividualDashboardController::class, 'livestock'])->name('livestock.index');
    // Route::get('/livestock/create', [IndividualDashboardController::class, 'createLivestock'])->name('livestock.create');
    // Route::post('/livestock', [IndividualDashboardController::class, 'storeLivestock'])->name('livestock.store');
    // Route::get('/livestock/{id}/edit', [IndividualDashboardController::class, 'editLivestock'])->name('livestock.edit');
    // Route::put('/livestock/{id}', [IndividualDashboardController::class, 'updateLivestock'])->name('livestock.update');
    // Route::delete('/livestock/{id}', [IndividualDashboardController::class, 'destroyLivestock'])->name('livestock.destroy');
    // Livestock Management
    Route::get('/livestock', [IndividualDashboardController::class, 'livestock'])->name('livestock.index');
    Route::get('/livestock/create', [IndividualDashboardController::class, 'createLivestock'])->name('livestock.create');
    
    // Livestock Registration Steps - CORRECTED NAMES WITH HYPHENS
    Route::get('/livestock/step/{step}', [IndividualDashboardController::class, 'showStep'])->name('livestock.show-step');
    Route::post('/livestock/step/{step}', [IndividualDashboardController::class, 'saveStep'])->name('livestock.save-step');
    Route::post('/livestock/save-draft', [IndividualDashboardController::class, 'saveDraft'])->name('livestock.save-draft');
    Route::post('/livestock/submit', [IndividualDashboardController::class, 'submitLivestock'])->name('livestock.submit-final');
    
    // Also add dot notation versions for compatibility
    Route::get('/livestock/steps/{step}', [IndividualDashboardController::class, 'showStep'])->name('livestock.step');
    Route::post('/livestock/steps/{step}', [IndividualDashboardController::class, 'saveStep'])->name('livestock.step.save');
    Route::post('/livestock/final-submit', [IndividualDashboardController::class, 'submitLivestock'])->name('livestock.submit');
    
    // Livestock CRUD
    Route::post('/livestock', [IndividualDashboardController::class, 'storeLivestock'])->name('livestock.store');
    Route::get('/livestock/{id}', [IndividualDashboardController::class, 'showLivestock'])->name('livestock.show');
    Route::get('/livestock/{id}/edit', [IndividualDashboardController::class, 'editLivestock'])->name('livestock.edit');
    Route::put('/livestock/{id}', [IndividualDashboardController::class, 'updateLivestock'])->name('livestock.update');
    Route::delete('/livestock/{id}', [IndividualDashboardController::class, 'deleteLivestock'])->name('livestock.destroy');
    

    // Service Requests
    Route::get('/service-requests', [IndividualDashboardController::class, 'serviceRequests'])->name('service-requests.index');
    Route::get('/service-requests/create', [IndividualDashboardController::class, 'createServiceRequest'])->name('service-requests.create');
    Route::post('/service-requests', [IndividualDashboardController::class, 'storeServiceRequest'])->name('service-requests.store');
    
    // Farm Records
    // Route::get('/farm-records/step1', [IndividualDashboardController::class, 'farmRecordStep1'])->name('farm-records.step1');
    // Route::post('/farm-records/step1', [IndividualDashboardController::class, 'storeFarmRecordStep1'])->name('farm-records.step1.store');
    // Route::get('/farm-records/step2', [IndividualDashboardController::class, 'farmRecordStep2'])->name('farm-records.step2');
    // Route::post('/farm-records/step2', [IndividualDashboardController::class, 'storeFarmRecordStep2'])->name('farm-records.step2.store');
    // Route::get('/farm-records/step3', [IndividualDashboardController::class, 'farmRecordStep3'])->name('farm-records.step3');
    // Route::post('/farm-records/step3', [IndividualDashboardController::class, 'storeFarmRecordStep3'])->name('farm-records.step3.store');
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
| Animal Health Professional Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:animal_health_professional'])->prefix('professional')->name('professional.')->group(function () {
    Route::get('/dashboard', [ProfessionalDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfessionalDashboardController::class, 'profile'])->name('profile');
    
    // Pending approval message
    Route::get('/pending-approval', function () {
        return view('professional.pending-approval');
    })->name('pending-approval');
    
    // Farm Records (for approved professionals)
    Route::middleware(['approved.professional'])->group(function () {
        Route::get('/farm-records', [ProfessionalDashboardController::class, 'farmRecords'])->name('farm-records.index');
        Route::get('/farm-records/create', [ProfessionalDashboardController::class, 'createFarmRecord'])->name('farm-records.create');
        Route::post('/farm-records', [ProfessionalDashboardController::class, 'storeFarmRecord'])->name('farm-records.store');
        
        // Service Requests
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
    Route::get('/dashboard', [VolunteerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [VolunteerDashboardController::class, 'profile'])->name('profile');
    
    // Enroll Farmers
    Route::get('/enroll-farmer', [VolunteerDashboardController::class, 'showEnrollForm'])->name('enroll.farmer');
    Route::post('/enroll-farmer', [VolunteerDashboardController::class, 'enrollFarmer'])->name('enroll.farmer.submit');
    
    // View enrolled farmers
    Route::get('/my-farmers', [VolunteerDashboardController::class, 'myFarmers'])->name('my-farmers');
    Route::get('/my-farmers/{id}', [VolunteerDashboardController::class, 'showFarmer'])->name('my-farmers.show');
    
    // Activity
    Route::get('/activity', [VolunteerDashboardController::class, 'activity'])->name('activity');
});

/*
|--------------------------------------------------------------------------
| LEGACY ROUTE REDIRECTS
|--------------------------------------------------------------------------
*/

// Registration redirects
Route::get('/register/individual', fn() => redirect()->route('register.farmer'))->name('register.individual');
Route::get('/register/data-collector', fn() => redirect()->route('register.professional'))->name('register.data-collector');

// Vaccination routes (redirect to farmer dashboard)
Route::redirect('/individual/vaccinations', '/farmer/dashboard')->name('individual.vaccinations.index');
Route::redirect('/individual/vaccinations/create', '/farmer/dashboard')->name('individual.vaccinations.create');
Route::redirect('/individual/vaccinations/{id}', '/farmer/dashboard')->name('individual.vaccinations.show');
Route::redirect('/individual/vaccinations/{id}/edit', '/farmer/dashboard')->name('individual.vaccinations.edit');

// Farm Records routes
Route::redirect('/individual/farm-records', '/farmer/farm-records/step1')->name('individual.farm-records.index');
Route::redirect('/individual/farm-records/create', '/farmer/farm-records/step1')->name('individual.farm-records.create');
Route::redirect('/individual/farm-records/{id}', '/farmer/farm-records/{id}')->name('individual.farm-records.show');
Route::redirect('/individual/farm-records/{id}/edit', '/farmer/farm-records/{id}/edit')->name('individual.farm-records.edit');

// Service Request routes
Route::redirect('/individual/service-requests', '/farmer/service-requests')->name('individual.service-requests.index');
Route::redirect('/individual/service-requests/create', '/farmer/service-requests/create')->name('individual.service-requests.create');
Route::redirect('/individual/service-requests/{id}', '/farmer/service-requests/{id}')->name('individual.service-requests.show');

// Livestock routes
Route::redirect('/individual/livestock', '/farmer/livestock')->name('individual.livestock.index');
Route::redirect('/individual/livestock/create', '/farmer/livestock/create')->name('individual.livestock.create');
Route::redirect('/individual/livestock/{id}', '/farmer/livestock/{id}')->name('individual.livestock.show');
Route::redirect('/individual/livestock/{id}/edit', '/farmer/livestock/{id}/edit')->name('individual.livestock.edit');

// Dashboard route
Route::redirect('/individual/dashboard', '/farmer/dashboard')->name('individual.dashboard');

// Data Collector (Professional) routes
Route::redirect('/data-collector/dashboard', '/professional/dashboard')->name('data-collector.dashboard');
Route::redirect('/data-collector/farm-records', '/professional/farm-records')->name('data-collector.farm-records.index');
Route::redirect('/data-collector/service-requests', '/professional/service-requests')->name('data-collector.service-requests.index');