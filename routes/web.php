<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\CostCalculatorController;

// Admin Routes
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// Client Routes
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;

// Consultant Routes
use App\Http\Controllers\Consultant\DashboardController as ConsultantDashboardController;

// Contractor Routes
use App\Http\Controllers\Contractor\DashboardController as ContractorDashboardController;

// Supplier Routes
use App\Http\Controllers\Supplier\DashboardController as SupplierDashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Designs Routes
Route::get('/designs', [DesignController::class, 'index'])->name('designs.index');
Route::get('/designs/{id}', [DesignController::class, 'show'])->name('designs.show');
Route::get('/designs/create', [DesignController::class, 'create'])->name('designs.create');
Route::post('/designs', [DesignController::class, 'store'])->name('designs.store');

// Lands Routes
Route::get('/lands', [LandController::class, 'index'])->name('lands.index');
Route::get('/lands/create', [LandController::class, 'create'])->name('lands.create');
Route::post('/lands', [LandController::class, 'store'])->name('lands.store');
Route::get('/lands/{id}', [LandController::class, 'show'])->name('lands.show');
Route::get('/lands/{id}/edit', [LandController::class, 'edit'])->name('lands.edit');
Route::put('/lands/{id}', [LandController::class, 'update'])->name('lands.update');
Route::delete('/lands/{id}', [LandController::class, 'destroy'])->name('lands.destroy');
Route::get('/lands/my/ads', [LandController::class, 'myAds'])->name('lands.my-ads');
Route::get('/lands/my/offers', [LandController::class, 'myOffers'])->name('lands.my-offers');

// Land Offers Routes
Route::get('/lands/{land}/submit-offer', [LandController::class, 'showSubmitOffer'])->name('lands.submit-offer');
Route::post('/lands/{land}/offers', [LandController::class, 'submitOffer'])->name('lands.offers.store');
Route::put('/offers/{offerId}/status', [LandController::class, 'updateOfferStatus'])->name('offers.update-status');

// Cost Calculator Routes
Route::get('/cost-calculator', [CostCalculatorController::class, 'index'])->name('cost-calculator.index');
Route::post('/cost-calculator/calculate', [CostCalculatorController::class, 'calculate'])->name('cost-calculator.calculate');
Route::post('/cost-calculator/create-project', [CostCalculatorController::class, 'createProject'])->name('cost-calculator.create-project');

// Admin Dashboard Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::get('/user-types', [AdminDashboardController::class, 'userTypes'])->name('user-types');
});

// Client Dashboard Routes
Route::prefix('client')->name('client.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ClientDashboardController::class, 'profile'])->name('profile');
    Route::get('/saved-designs', [ClientDashboardController::class, 'savedDesigns'])->name('saved-designs');
    Route::get('/favorite-consultants', [ClientDashboardController::class, 'favoriteConsultants'])->name('favorite-consultants');
    Route::get('/projects', [ClientDashboardController::class, 'projects'])->name('projects');
    Route::get('/offers', [ClientDashboardController::class, 'offers'])->name('offers');
});

// Consultant Dashboard Routes
Route::prefix('consultant')->name('consultant.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ConsultantDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ConsultantDashboardController::class, 'profile'])->name('profile');
    Route::get('/projects', [ConsultantDashboardController::class, 'projects'])->name('projects');
    Route::get('/portfolio', [ConsultantDashboardController::class, 'portfolio'])->name('portfolio');
    Route::get('/inquiries', [ConsultantDashboardController::class, 'inquiries'])->name('inquiries');
    Route::get('/earnings', [ConsultantDashboardController::class, 'earnings'])->name('earnings');
});

// Contractor Dashboard Routes
Route::prefix('contractor')->name('contractor.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ContractorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ContractorDashboardController::class, 'profile'])->name('profile');
    Route::get('/projects', [ContractorDashboardController::class, 'projects'])->name('projects');
    Route::get('/bids', [ContractorDashboardController::class, 'bids'])->name('bids');
    Route::get('/team', [ContractorDashboardController::class, 'team'])->name('team');
    Route::get('/earnings', [ContractorDashboardController::class, 'earnings'])->name('earnings');
    Route::get('/equipment', [ContractorDashboardController::class, 'equipment'])->name('equipment');
});

// Supplier Dashboard Routes
Route::prefix('supplier')->name('supplier.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SupplierDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [SupplierDashboardController::class, 'profile'])->name('profile');
    Route::get('/products', [SupplierDashboardController::class, 'products'])->name('products');
    Route::get('/orders', [SupplierDashboardController::class, 'orders'])->name('orders');
    Route::get('/inventory', [SupplierDashboardController::class, 'inventory'])->name('inventory');
    Route::get('/revenue', [SupplierDashboardController::class, 'revenue'])->name('revenue');
    Route::get('/catalog', [SupplierDashboardController::class, 'catalog'])->name('catalog');
});

// Project Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::post('/projects/{project}/publish', [ProjectController::class, 'publish'])->name('projects.publish');
    Route::post('/projects/{project}/select-consultant/{offer}', [ProjectController::class, 'selectConsultant'])->name('projects.select-consultant');
    Route::post('/projects/{project}/select-contractor/{offer}', [ProjectController::class, 'selectContractor'])->name('projects.select-contractor');
    Route::post('/projects/{project}/select-supplier/{offer}', [ProjectController::class, 'selectSupplier'])->name('projects.select-supplier');
    Route::post('/projects/{project}/upload-design', [ProjectController::class, 'uploadDesign'])->name('projects.upload-design');
});

// Offer Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/projects/{project}/offers/create', [OfferController::class, 'create'])->name('offers.create');
    Route::post('/projects/{project}/offers', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/offers/{offer}', [OfferController::class, 'show'])->name('offers.show');
    Route::post('/offers/{offer}/respond', [OfferController::class, 'respond'])->name('offers.respond');
    Route::post('/offers/{offer}/withdraw', [OfferController::class, 'withdraw'])->name('offers.withdraw');
});
