<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    if (\auth()->guard('web')->check()) {
        return redirect()->route('admin.index');
    }

    return view('login');
});

Route::post("admin/execute-login", [AdminController::class, 'execute_login'])->name("execute.login");
Route::get("admin/logout", [AdminController::class, 'logout'])->name("logout");
Route::get("admin/register", [AdminController::class, 'register'])->name("register");
Route::post("admin/execute-register", [AdminController::class, 'execute_register'])->name("execute.register");

Route::group(['middleware' => [\App\Http\Middleware\CheckAdminLogin::class], 'prefix' => 'admin'], function () {
    Route::get("index", function () {
        return view("admin.dashboard");
    })->name("admin.index");

    Route::prefix('customer')->group(function () {
        Route::name("customer.")->group(function () {
            Route::get('view', [\App\Http\Controllers\CustomerController::class, 'getAllCustomer'])->name("view");
            Route::post('save', [\App\Http\Controllers\CustomerController::class, 'saveCustomer'])->name("save");
            Route::post('update', [\App\Http\Controllers\CustomerController::class, 'UpdateCustomer'])->name("update-admin");
            Route::get('delete/{id}', [\App\Http\Controllers\CustomerController::class, 'DeleteCustomer'])->name("delete");
            Route::get('export', [\App\Http\Controllers\CustomerController::class, 'export'])->name('export');
            //đổ dữ liệu phòng ra select2
            Route::get('get-room', [\App\Http\Controllers\CustomerController::class, 'getRoom'])->name("get.room.for.customer");
            Route::get('get-id-customer', [\App\Http\Controllers\CustomerController::class, 'getIDCustomer'])->name("get.id.customer");
        });
    });

    Route::prefix('service')->group(function () {
        Route::name("service.")->group(function () {
            Route::get('view', [\App\Http\Controllers\ServiceController::class, 'getAllService'])->name("view");
            Route::get('add', [\App\Http\Controllers\ServiceController::class, 'addService'])->name("add.service");
            Route::post('save', [\App\Http\Controllers\ServiceController::class, 'saveService'])->name("save.service");
            Route::get('edit/{id}', [\App\Http\Controllers\ServiceController::class, 'getEditService'])->name("edit");
            Route::post('update/{id}', [\App\Http\Controllers\ServiceController::class, 'UpdateService'])->name("update");
            Route::get('delete/{id}', [\App\Http\Controllers\ServiceController::class, 'DeleteService'])->name("delete");
        });
    });

    Route::prefix('room')->group(function () {
        Route::name("room.")->group(function () {
            Route::get('view', [\App\Http\Controllers\RoomController::class, 'getAllRoom'])->name("view");
            Route::get('add', [\App\Http\Controllers\RoomController::class, 'addRoom'])->name("add.room");
            Route::get('/customer', [\App\Http\Controllers\RoomController::class, 'roomCustomer'])->name("customer");
            Route::get('/customer/create', [\App\Http\Controllers\RoomController::class, 'createCustomerRoom'])->name("customer.create");
            Route::post('/customer/create', [\App\Http\Controllers\RoomController::class, 'handleCreateCustomerRoom'])->name("customer.handle-create");
            Route::get('{room_id}/customer/{customer_id}', [\App\Http\Controllers\RoomController::class, 'deleteRoomCustomer'])->name('customer.delete');
            Route::post('save', [\App\Http\Controllers\RoomController::class, 'saveRoom'])->name("save.room");
            Route::get('edit/{id}', [\App\Http\Controllers\RoomController::class, 'getEditRoom'])->name("edit");
            Route::post('update/{id}', [\App\Http\Controllers\RoomController::class, 'UpdateRoom'])->name("update");
            Route::get('delete/{id}', [\App\Http\Controllers\RoomController::class, 'DeleteRoom'])->name("delete");
            Route::get('images/{id}', [\App\Http\Controllers\RoomController::class, 'deleteRoomImage'])->name('room-images.delete');
        });
    });

    Route::group(['prefix' => 'contracts'], function () {
        Route::get('/', [\App\Http\Controllers\ContractController::class, 'list'])->name('contracts.list');
        Route::get('/create', [\App\Http\Controllers\ContractController::class, 'viewCreate'])->name('contracts.create');
        Route::get('/{id}/update', [\App\Http\Controllers\ContractController::class, 'viewUpdate'])->name('contracts.update');
        Route::post('/create', [\App\Http\Controllers\ContractController::class, 'handleCreate'])->name('contracts.handle-create');
        Route::get('{id}/delete', [\App\Http\Controllers\ContractController::class, 'destroy'])->name('contracts.delete');
        Route::post('{id}/update', [\App\Http\Controllers\ContractController::class, 'update'])->name('contracts.handle-update');
        Route::get('export/{id}', [\App\Http\Controllers\ContractController::class, 'export'])->name('contracts.export');
        Route::get('{id}/confirm', [\App\Http\Controllers\ContractController::class, 'confirm'])->name('contracts.confirm');
        Route::get('return', [\App\Http\Controllers\ContractController::class, 'returnList'])->name('contracts.return');
        Route::get('{id}/return-room', [\App\Http\Controllers\ContractController::class, 'confirmReturnRoom'])->name('contracts.confirm-return');
    });

    Route::group(['prefix' => 'bills'], function () {
        Route::get('/', [\App\Http\Controllers\BillController::class, 'list'])->name('bills.list');
        Route::get('/rooms/{id}', [\App\Http\Controllers\BillController::class, 'getRoom']);
        Route::post('/computed', [\App\Http\Controllers\BillController::class, 'computedBill']);
        Route::get('/create', [\App\Http\Controllers\BillController::class, 'viewCreate'])->name('bills.create');
        Route::post('/create', [\App\Http\Controllers\BillController::class, 'create'])->name('bills.handle-create');
        Route::get('{id}', [\App\Http\Controllers\BillController::class, 'viewUpdate'])->name('bills.update');
        Route::post('{id}', [\App\Http\Controllers\BillController::class, 'update'])->name('bills.handle-update');
        Route::get('{id}/delete', [\App\Http\Controllers\BillController::class, 'destroy'])->name('bills.delete');
        Route::get('/service-use/room/{id}', [\App\Http\Controllers\BillController::class, 'getUseService']);
    });
});

Route::get('login', function () {
    return view('customer.auth.login');
})->name('customer.login');
Route::get('register', function () {
    return view('customer.auth.register');
})->name('customer.register');
Route::post('login', [\App\Http\Controllers\Customer\CustomerController::class, 'login'])->name('customer.handle-login');
Route::post('register', [\App\Http\Controllers\Customer\CustomerController::class, 'register'])->name('customer.register');
Route::get('/', [\App\Http\Controllers\Customer\HomeController::class, 'index'])->name('home');
Route::get('rooms', [\App\Http\Controllers\Customer\CustomerController::class, 'getRooms'])->name('customer.rooms');
Route::get('rooms/{id}', [\App\Http\Controllers\Customer\CustomerController::class, 'getRoom'])->name('customer.rooms-detail');
Route::get('room/{id}/book', [\App\Http\Controllers\Customer\CustomerController::class, 'book'])->name('rooms.book-view');

Route::group(['middleware' => 'CheckCustomer'], function () {
    Route::get('logout', [\App\Http\Controllers\Customer\CustomerController::class, 'logout'])->name('customer.logout');
    Route::get('info', [\App\Http\Controllers\Customer\CustomerController::class, 'show'])->name('customer.show');
    Route::get('update', [\App\Http\Controllers\Customer\CustomerController::class, 'update'])->name('customer.update');
    Route::get('contracts/{id}', [\App\Http\Controllers\Customer\CustomerController::class, 'getContract'])->name('customer.contract-show');
    Route::get('contracts', [\App\Http\Controllers\Customer\CustomerController::class, 'getContracts'])->name('customer.contract-list');
    Route::get('bills', [\App\Http\Controllers\Customer\CustomerController::class, 'getBills'])->name('customer.bills-show');
    Route::get('change-password', function () {
        return view('customer.auth.changePassword');
    });
    Route::post('change-password', [\App\Http\Controllers\Customer\CustomerController::class, 'changePassword'])->name('customer.change-password');
    Route::get('bills/{id}', [\App\Http\Controllers\Customer\CustomerController::class, 'detailBill'])->name('customer.bills-detail');
    Route::get('bills/{id}/redirect-payment', [\App\Http\Controllers\Customer\CustomerController::class, 'payment'])
        ->name('customer.bills-payment');
    Route::get('bills/vnpay/callback', [\App\Http\Controllers\Customer\CustomerController::class, 'callbackPayment'])
        ->name('customer.bills-callback');
    Route::post('contracts/create', [\App\Http\Controllers\Customer\CustomerController::class, 'createBook'])->name('rooms.book');
    Route::get('contracts/vnpay/callback', [\App\Http\Controllers\Customer\CustomerController::class, 'createBookCallback'])->name('rooms.book-callback');

    Route::get('room/{id}/transplant', [\App\Http\Controllers\Customer\CustomerController::class, 'transplant'])->name('rooms.transplant');
    Route::get('room/{id}/transplant-update', [\App\Http\Controllers\Customer\CustomerController::class, 'transplantUpdate'])->name('rooms.transplant-update');
    Route::get('contract/{id}/return', [\App\Http\Controllers\Customer\CustomerController::class, 'returnRoom'])->name('rooms.return');
});