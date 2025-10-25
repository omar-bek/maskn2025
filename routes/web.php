<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\LandController;

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
use App\Http\Controllers\PricingController;
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


// Designs Routes - Public
Route::get('/designs', [DesignController::class, 'index'])->name('designs.index');

// Consultant Only Routes - Designs (specific routes first to avoid conflicts)
Route::middleware(['auth', 'consultant'])->group(function () {
    Route::get('/designs/create', [DesignController::class, 'create'])->name('designs.create');
    Route::post('/designs', [DesignController::class, 'store'])->name('designs.store');
    Route::get('/designs/{id}/edit', [DesignController::class, 'edit'])->name('designs.edit');
    Route::put('/designs/{id}', [DesignController::class, 'update'])->name('designs.update');
    Route::delete('/designs/{id}', [DesignController::class, 'destroy'])->name('designs.destroy');
});

// Designs Routes - Public (parameterized routes after specific ones)
Route::get('/designs/{id}/pricing', [DesignController::class, 'showWithPricing'])->name('designs.show-with-pricing');
Route::get('/designs/{id}', [DesignController::class, 'show'])->name('designs.show');

// Tenders Routes (Public)
Route::get('/tenders', [TenderController::class, 'index'])->name('tenders.index');
Route::get('/tenders/{id}', [TenderController::class, 'show'])->name('tenders.show');

// Client Only Routes - Tenders
Route::middleware(['auth'])->group(function () {
    Route::get('/tenders/create', [TenderController::class, 'create'])->name('tenders.create');
    Route::get('/tenders/create-from-design/{designId}', [TenderController::class, 'createFromDesign'])->name('tenders.create-from-design');
    Route::post('/tenders', [TenderController::class, 'store'])->name('tenders.store');
    Route::get('/tenders/{id}/edit', [TenderController::class, 'edit'])->name('tenders.edit');
    Route::put('/tenders/{id}', [TenderController::class, 'update'])->name('tenders.update');
    Route::delete('/tenders/{id}', [TenderController::class, 'destroy'])->name('tenders.destroy');
    Route::post('/tenders/{id}/close', [TenderController::class, 'close'])->name('tenders.close');
    Route::post('/tenders/{id}/award', [TenderController::class, 'award'])->name('tenders.award');
    Route::get('/tenders/{id}/compare-proposals', [TenderController::class, 'compareProposals'])->name('tenders.compare-proposals');
    Route::get('/tenders/{id}/export-pdf', [TenderController::class, 'exportPdf'])->name('tenders.export-pdf');
    Route::get('/tenders/{id}/export-excel', [TenderController::class, 'exportExcel'])->name('tenders.export-excel');
});

// Consultant Only Routes - Proposals
Route::middleware(['auth', 'consultant'])->group(function () {
    Route::get('/proposals', [ProposalController::class, 'index'])->name('proposals.index');
    Route::get('/tenders/{tenderId}/proposals/create', [ProposalController::class, 'create'])->name('proposals.create');
    Route::post('/tenders/{tenderId}/proposals', [ProposalController::class, 'store'])->name('proposals.store');
    Route::get('/proposals/{id}', [ProposalController::class, 'show'])->name('proposals.show');
    Route::get('/proposals/{id}/edit', [ProposalController::class, 'edit'])->name('proposals.edit');
    Route::put('/proposals/{id}', [ProposalController::class, 'update'])->name('proposals.update');
    Route::delete('/proposals/{id}', [ProposalController::class, 'destroy'])->name('proposals.destroy');
});

// Client Only Routes - Proposals Management
Route::middleware(['auth'])->group(function () {
    Route::get('/proposals/{id}/client-view', [ProposalController::class, 'showForClient'])->name('proposals.client-view');
    Route::post('/proposals/{id}/accept', [ProposalController::class, 'accept'])->name('proposals.accept');
    Route::post('/proposals/{id}/reject', [ProposalController::class, 'reject'])->name('proposals.reject');
});

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
    Route::get('/my-tenders', [ClientDashboardController::class, 'myTenders'])->name('my-tenders');
});

// Consultant Dashboard Routes
Route::prefix('consultant')->name('consultant.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Consultant\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\Consultant\DashboardController::class, 'profile'])->name('profile');
    Route::get('/projects', [App\Http\Controllers\Consultant\DashboardController::class, 'projects'])->name('projects');
    Route::get('/portfolio', [App\Http\Controllers\Consultant\DashboardController::class, 'portfolio'])->name('portfolio');
    Route::get('/inquiries', [App\Http\Controllers\Consultant\DashboardController::class, 'inquiries'])->name('inquiries');
    Route::get('/earnings', [App\Http\Controllers\Consultant\DashboardController::class, 'earnings'])->name('earnings');
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
