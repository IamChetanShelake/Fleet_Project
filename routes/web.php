<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\DrivingTeamController;
use App\Http\Controllers\BillingEntityController;
use App\Http\Controllers\VehicleMonitoringController;
use App\Http\Controllers\PeakAccountController;
use App\Http\Controllers\TyreMaintenanceController;
use App\Http\Controllers\TyreStockController;
use App\Http\Controllers\FleetManagementController;
use App\Http\Controllers\TransportManagementController;
use App\Http\Controllers\VehicleMaintenanceController;
use App\Http\Controllers\ExpenseTrackingController;
use App\Http\Controllers\GeographyController;
use App\Http\Controllers\PerformanceReportController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\UtilitiesToolsController;
use App\Http\Controllers\HelpCenterController;
use App\Http\Controllers\MyAssistanceController;
use App\Http\Controllers\NewConsignmentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);

// Admin Routes (Protected by Authentication)
Route::prefix('admin')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Team Member Management
    Route::resource('team-members', TeamMemberController::class)->names([
        'index' => 'admin.team-members.index',
        'create' => 'admin.team-members.create',
        'store' => 'admin.team-members.store',
        'show' => 'admin.team-members.show',
        'edit' => 'admin.team-members.edit',
        'update' => 'admin.team-members.update',
        'destroy' => 'admin.team-members.destroy'
    ]);

    // Team Member Status Toggle
    Route::post('team-members/{id}/toggle-status', [TeamMemberController::class, 'toggleStatus'])->name('admin.team-members.toggle-status');

    // Driving Team Management
    Route::resource('driving-team', DrivingTeamController::class)->names([
        'index' => 'admin.driving-team.index',
        'create' => 'admin.driving-team.create',
        'store' => 'admin.driving-team.store',
        'show' => 'admin.driving-team.show',
        'edit' => 'admin.driving-team.edit',
        'update' => 'admin.driving-team.update',
        'destroy' => 'admin.driving-team.destroy'
    ]);

    // KYC Approval Route
    Route::post('driving-team/{id}/approve-kyc', [DrivingTeamController::class, 'approveKyc'])->name('admin.driving-team.approve-kyc');

    // Billing Entities
    Route::resource('billing-entities', BillingEntityController::class)->names([
        'index' => 'admin.billing-entities.index',
        'create' => 'admin.billing-entities.create',
        'store' => 'admin.billing-entities.store',
        'show' => 'admin.billing-entities.show',
        'edit' => 'admin.billing-entities.edit',
        'update' => 'admin.billing-entities.update',
        'destroy' => 'admin.billing-entities.destroy'
    ]);

    // Vehicle Monitoring
    Route::resource('vehicle-monitoring', VehicleMonitoringController::class)->names([
        'index' => 'admin.vehicle-monitoring.index',
        'create' => 'admin.vehicle-monitoring.create',
        'store' => 'admin.vehicle-monitoring.store',
        'show' => 'admin.vehicle-monitoring.show',
        'edit' => 'admin.vehicle-monitoring.edit',
        'update' => 'admin.vehicle-monitoring.update',
        'destroy' => 'admin.vehicle-monitoring.destroy'
    ]);

    // Individual Vehicle Details
    Route::get('vehicle-monitoring/vehicle/{id}', [VehicleMonitoringController::class, 'showVehicle'])->name('admin.vehicle-monitoring.show-vehicle');

    // Vehicle Status Update
    Route::put('vehicle-monitoring/{id}/status', [VehicleMonitoringController::class, 'updateStatus'])->name('admin.vehicle-monitoring.update-status');

    // Driver Status Update
    Route::put('vehicle-monitoring/driver/{id}/status', [VehicleMonitoringController::class, 'updateDriverStatus'])->name('admin.vehicle-monitoring.update-driver-status');

    // Peak Accounts
    Route::resource('peak-accounts', PeakAccountController::class)->names([
        'index' => 'admin.peak-accounts.index',
        'create' => 'admin.peak-accounts.create',
        'store' => 'admin.peak-accounts.store',
        'show' => 'admin.peak-accounts.show',
        'edit' => 'admin.peak-accounts.edit',
        'update' => 'admin.peak-accounts.update',
        'destroy' => 'admin.peak-accounts.destroy'
    ]);

    // Tyre Maintenance
    Route::resource('tyre-maintenance', TyreMaintenanceController::class)->names([
        'index' => 'admin.tyre-maintenance.index',
        'create' => 'admin.tyre-maintenance.create',
        'store' => 'admin.tyre-maintenance.store',
        'show' => 'admin.tyre-maintenance.show',
        'edit' => 'admin.tyre-maintenance.edit',
        'update' => 'admin.tyre-maintenance.update',
        'destroy' => 'admin.tyre-maintenance.destroy'
    ]);

    // Tyre Stock
    Route::resource('tyre-stock', TyreStockController::class)->names([
        'index' => 'admin.tyre-stock.index',
        'create' => 'admin.tyre-stock.create',
        'store' => 'admin.tyre-stock.store',
        'show' => 'admin.tyre-stock.show',
        'edit' => 'admin.tyre-stock.edit',
        'update' => 'admin.tyre-stock.update',
        'destroy' => 'admin.tyre-stock.destroy'
    ]);

    // Fleet Management
    Route::resource('fleet-management', FleetManagementController::class)->names([
        'index' => 'admin.fleet-management.index',
        'create' => 'admin.fleet-management.create',
        'store' => 'admin.fleet-management.store',
        'show' => 'admin.fleet-management.show',
        'edit' => 'admin.fleet-management.edit',
        'update' => 'admin.fleet-management.update',
        'destroy' => 'admin.fleet-management.destroy'
    ]);

    // Transport Management
    Route::resource('transport-management', TransportManagementController::class)->names([
        'index' => 'admin.transport-management.index',
        'create' => 'admin.transport-management.create',
        'store' => 'admin.transport-management.store',
        'show' => 'admin.transport-management.show',
        'edit' => 'admin.transport-management.edit',
        'update' => 'admin.transport-management.update',
        'destroy' => 'admin.transport-management.destroy'
    ]);

    // Vehicle Maintenance
    Route::resource('vehicle-maintenance', VehicleMaintenanceController::class)->names([
        'index' => 'admin.vehicle-maintenance.index',
        'create' => 'admin.vehicle-maintenance.create',
        'store' => 'admin.vehicle-maintenance.store',
        'show' => 'admin.vehicle-maintenance.show',
        'edit' => 'admin.vehicle-maintenance.edit',
        'update' => 'admin.vehicle-maintenance.update',
        'destroy' => 'admin.vehicle-maintenance.destroy'
    ]);

    // Expense Tracking
    Route::resource('expense-tracking', ExpenseTrackingController::class)->names([
        'index' => 'admin.expense-tracking.index',
        'create' => 'admin.expense-tracking.create',
        'store' => 'admin.expense-tracking.store',
        'show' => 'admin.expense-tracking.show',
        'edit' => 'admin.expense-tracking.edit',
        'update' => 'admin.expense-tracking.update',
        'destroy' => 'admin.expense-tracking.destroy'
    ]);


    // Geography
    Route::get('geography/cities', [GeographyController::class, 'cities'])->name('admin.geography.cities');
    Route::get('geography/hubs', [GeographyController::class, 'hubs'])->name('admin.geography.hubs');
    Route::post('geography/{id}/toggle-status', [GeographyController::class, 'toggleStatus'])->name('admin.geography.toggle-status');
    Route::post('cities/{id}/toggle-status', [GeographyController::class, 'toggleCityStatus'])->name('admin.cities.toggle-status');
    Route::post('hubs/{id}/toggle-status', [GeographyController::class, 'toggleHubStatus'])->name('admin.hubs.toggle-status');
    Route::resource('geography', GeographyController::class)->names([
        'index' => 'admin.geography.index',
        'create' => 'admin.geography.create',
        'store' => 'admin.geography.store',
        'show' => 'admin.geography.show',
        'edit' => 'admin.geography.edit',
        'update' => 'admin.geography.update',
        'destroy' => 'admin.geography.destroy'
    ]);

    // Countries
    Route::get('countries', [GeographyController::class, 'index'])->name('admin.countries.index');
    Route::get('countries/create', [GeographyController::class, 'createCountry'])->name('admin.countries.create');
    Route::post('countries', [GeographyController::class, 'storeCountry'])->name('admin.countries.store');
    Route::get('countries/{id}', [GeographyController::class, 'showCountry'])->name('admin.countries.show');
    Route::get('countries/{id}/edit', [GeographyController::class, 'editCountry'])->name('admin.countries.edit');
    Route::put('countries/{id}', [GeographyController::class, 'updateCountry'])->name('admin.countries.update');
    Route::delete('countries/{id}', [GeographyController::class, 'destroyCountry'])->name('admin.countries.destroy');

    // Cities
    Route::get('cities/create', [GeographyController::class, 'createCity'])->name('admin.cities.create');
    Route::post('cities', [GeographyController::class, 'storeCity'])->name('admin.cities.store');
    Route::get('cities/{id}', [GeographyController::class, 'showCity'])->name('admin.cities.show');
    Route::get('cities/{id}/edit', [GeographyController::class, 'editCity'])->name('admin.cities.edit');
    Route::put('cities/{id}', [GeographyController::class, 'updateCity'])->name('admin.cities.update');
    Route::delete('cities/{id}', [GeographyController::class, 'destroyCity'])->name('admin.cities.destroy');

    // Hubs
    Route::get('hubs/create', [GeographyController::class, 'createHub'])->name('admin.hubs.create');
    Route::post('hubs', [GeographyController::class, 'storeHub'])->name('admin.hubs.store');
    Route::get('hubs/{id}', [GeographyController::class, 'showHub'])->name('admin.hubs.show');
    Route::get('hubs/{id}/edit', [GeographyController::class, 'editHub'])->name('admin.hubs.edit');
    Route::put('hubs/{id}', [GeographyController::class, 'updateHub'])->name('admin.hubs.update');
    Route::delete('hubs/{id}', [GeographyController::class, 'destroyHub'])->name('admin.hubs.destroy');
    Route::get('hubs-by-country/{countryId}', [GeographyController::class, 'getHubsByCountry'])->name('admin.hubs.by-country');
    Route::get('cities-by-country/{countryId}', [GeographyController::class, 'getCitiesByCountry'])->name('admin.cities.by-country');

    // Performance Reports
    Route::resource('performance-reports', PerformanceReportController::class)->names([
        'index' => 'admin.performance-reports.index',
        'create' => 'admin.performance-reports.create',
        'store' => 'admin.performance-reports.store',
        'show' => 'admin.performance-reports.show',
        'edit' => 'admin.performance-reports.edit',
        'update' => 'admin.performance-reports.update',
        'destroy' => 'admin.performance-reports.destroy'
    ]);

    // Admin Panel
    Route::resource('admin-panel', AdminPanelController::class)->names([
        'index' => 'admin.admin-panel.index',
        'create' => 'admin.admin-panel.create',
        'store' => 'admin.admin-panel.store',
        'show' => 'admin.admin-panel.show',
        'edit' => 'admin.admin-panel.edit',
        'update' => 'admin.admin-panel.update',
        'destroy' => 'admin.admin-panel.destroy'
    ]);

    // Utilities & Tools
    Route::resource('utilities-tools', UtilitiesToolsController::class)->names([
        'index' => 'admin.utilities-tools.index',
        'create' => 'admin.utilities-tools.create',
        'store' => 'admin.utilities-tools.store',
        'show' => 'admin.utilities-tools.show',
        'edit' => 'admin.utilities-tools.edit',
        'update' => 'admin.utilities-tools.update',
        'destroy' => 'admin.utilities-tools.destroy'
    ]);

    // Help Center
    Route::resource('help-center', HelpCenterController::class)->names([
        'index' => 'admin.help-center.index',
        'create' => 'admin.help-center.create',
        'store' => 'admin.help-center.store',
        'show' => 'admin.help-center.show',
        'edit' => 'admin.help-center.edit',
        'update' => 'admin.help-center.update',
        'destroy' => 'admin.help-center.destroy'
    ]);

    // My Assistance
    Route::resource('my-assistance', MyAssistanceController::class)->names([
        'index' => 'admin.my-assistance.index',
        'create' => 'admin.my-assistance.create',
        'store' => 'admin.my-assistance.store',
        'show' => 'admin.my-assistance.show',
        'edit' => 'admin.my-assistance.edit',
        'update' => 'admin.my-assistance.update',
        'destroy' => 'admin.my-assistance.destroy'
    ]);

    // New Consignment
    Route::resource('new-consignment', NewConsignmentController::class)->names([
        'index' => 'admin.new-consignment.index',
        'create' => 'admin.new-consignment.create',
        'store' => 'admin.new-consignment.store',
        'show' => 'admin.new-consignment.show',
        'edit' => 'admin.new-consignment.edit',
        'update' => 'admin.new-consignment.update',
        'destroy' => 'admin.new-consignment.destroy'
    ]);

    // Brands Management
    Route::resource('brands', BrandController::class)->names([
        'index' => 'admin.brands.index',
        'create' => 'admin.brands.create',
        'store' => 'admin.brands.store',
        'show' => 'admin.brands.show',
        'edit' => 'admin.brands.edit',
        'update' => 'admin.brands.update',
        'destroy' => 'admin.brands.destroy'
    ]);

    // Role Management
    Route::resource('roles', RoleController::class)->names([
        'index' => 'admin.roles.index',
        'create' => 'admin.roles.create',
        'store' => 'admin.roles.store',
        'show' => 'admin.roles.show',
        'edit' => 'admin.roles.edit',
        'update' => 'admin.roles.update',
        'destroy' => 'admin.roles.destroy'
    ]);

    // Freight & Assignment
    Route::get('freight-assignment', [NewConsignmentController::class, 'freightAssignment'])->name('admin.freight-assignment.index');
    Route::post('freight-assignment', [NewConsignmentController::class, 'storeFreightAssignment'])->name('admin.freight-assignment.store');

    // Charges & Advance
    Route::get('charges-advance', [NewConsignmentController::class, 'chargesAdvance'])->name('admin.charges-advance.index');
    Route::post('charges-advance', [NewConsignmentController::class, 'storeChargesAdvance'])->name('admin.charges-advance.store');

    // Booking Confirmed
    Route::get('booking-confirmed', [NewConsignmentController::class, 'bookingConfirmed'])->name('admin.booking-confirmed.index');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

Auth::routes(['register' => false]);
