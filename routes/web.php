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
use App\Http\Controllers\AttendanceRecordController;
use App\Http\Controllers\GeographyController;
use App\Http\Controllers\PerformanceReportController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\UtilitiesToolsController;
use App\Http\Controllers\HelpCenterController;
use App\Http\Controllers\MyAssistanceController;
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

    // Attendance Records
    Route::resource('attendance-records', AttendanceRecordController::class)->names([
        'index' => 'admin.attendance-records.index',
        'create' => 'admin.attendance-records.create',
        'store' => 'admin.attendance-records.store',
        'show' => 'admin.attendance-records.show',
        'edit' => 'admin.attendance-records.edit',
        'update' => 'admin.attendance-records.update',
        'destroy' => 'admin.attendance-records.destroy'
    ]);

    // Geography
    Route::resource('geography', GeographyController::class)->names([
        'index' => 'admin.geography.index',
        'create' => 'admin.geography.create',
        'store' => 'admin.geography.store',
        'show' => 'admin.geography.show',
        'edit' => 'admin.geography.edit',
        'update' => 'admin.geography.update',
        'destroy' => 'admin.geography.destroy'
    ]);

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

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

Auth::routes(['register' => false]);
