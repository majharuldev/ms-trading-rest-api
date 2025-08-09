<?php

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\API\Authentication\AuthController;
use App\Http\Controllers\{RentController, AccountController, PaymentController, CustomerController, StockProductController, AttendanceController, AdvanceSalaryController, BranchLedgerController, CustomerLedgerController, DailyExpenseController, DriverController, DriverLedgerController, EmployeeController, HelperController, LeaveController, OfficeController, VehicleController, TripController, PartsController, PaymentRecivedController, PurchaseController, RoleController, StockOutProductController, SupplierLedgerController, SupplyController, VendorBillController, VendorController, VendorLedgerController};

// Get Authenticated User
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    dd(Auth::user());
});


//Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});


Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::post('/users', 'store');
    Route::get('/users/{id}', 'show');
    Route::put('/users/{id}', 'update');
    Route::delete('/users/delete/{id}', 'destroy');
});




Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

//Vehicle
Route::prefix('vehicle')->controller(VehicleController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('edit/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});

//Driver
Route::prefix('driver')->controller(DriverController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('edit/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});

//Trip
Route::prefix('trip')->controller(TripController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::post('update/bill/{id}', 'Bill');
    Route::delete('delete/{id}', 'destroy');
});

//Parts
Route::prefix('parts')->controller(PartsController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});

//Vendor
Route::prefix('vendor')->controller(VendorController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});

//Rent
Route::prefix('rent')->controller(RentController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});

//Employee
Route::prefix('employee')->controller(EmployeeController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Attendance
Route::prefix('attendance')->controller(AttendanceController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Leave
Route::prefix('leave')->controller(LeaveController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//AdvanceSalary
Route::prefix('advanceSalary')->controller(AdvanceSalaryController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//StockProduct
Route::prefix('stockProduct')->controller(StockProductController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//StockOutProduct
Route::prefix('stockOutProduct')->controller(StockOutProductController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Purchase
Route::prefix('purchase')->controller(PurchaseController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Supply
Route::prefix('supply')->controller(SupplyController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Customer
Route::prefix('customer')->controller(CustomerController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Account
Route::prefix('account')->controller(AccountController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Office
Route::prefix('office')->controller(OfficeController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Ledger
Route::prefix('branch')->controller(BranchLedgerController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//SupplierLedger
Route::prefix('supplierLedger')->controller(SupplierLedgerController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{ref_id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Payment
Route::prefix('payment')->controller(PaymentController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Payment_Recived
Route::prefix('paymentRecived')->controller(PaymentRecivedController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
//Customer_ledger
Route::prefix('customerLedger')->controller(CustomerLedgerController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});


// driver ledger 
Route::prefix('driverLedger')->controller(DriverLedgerController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
// permission
Route::prefix('permission')->controller(RoleController::class)->group(function () {
    Route::get('list', 'index');
    Route::post('create', 'store');
    Route::get('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});

// role
Route::prefix('role')->controller(RoleController::class)->group(function () {
    Route::get('list', 'AllRole');
    Route::post('create', 'AddRole');
    Route::get('show/{id}', 'showRole');
    Route::post('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');

    Route::get('add/role/permission', 'AddRolesPermission');
});

// expense
Route::prefix('expense')->name('daily.expense.')->controller(DailyExpenseController::class)->group(function () {
    Route::get('/list', 'index')->name('list');
    Route::post('/create', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');
});


// vendor_bill
Route::prefix('vendorBill')->name('daily.expense.')->controller(VendorBillController::class)->group(function () {
    Route::get('/list', 'index')->name('list');
    Route::post('/create', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');
});

// vendor ledger
Route::prefix('vendorLedger')->controller(VendorLedgerController::class)->group(function () {
    Route::get('/list', 'index')->name('list');
});


// helper
Route::prefix('helper')->controller(HelperController::class)->group(function () {
    Route::get('/list', 'index')->name('list');
    Route::post('/create', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');
});
