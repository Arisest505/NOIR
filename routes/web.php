<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RecursosHumano\CreateRHController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecursosHumano\OcuPerController;
use App\Http\Controllers\RecursosHumano\AccessUserController;
use App\Http\Controllers\LOGISTIC\MESSAGE\MessageController;
use App\Http\Controllers\LOGISTIC\WAREHOUSE\WarehouseController;
use App\Http\Controllers\LOGISTIC\WAREHOUSE\InformationWarehouseController;
use App\Http\Controllers\CONTACT\ContactController;
Auth::routes();
// Ruta raíz

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



//Rutas principales
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('recursoshumanos')->name('recursoshumanos.')->middleware('permission:manage_recursoshumanos')->group(function () {
    Route::get('/createuser', [CreateRHController::class, 'index'])->name('createuser');
    Route::post('/createuser', [CreateRHController::class, 'store'])->name('users.store');
    Route::post('/staff/store', [CreateRHController::class, 'storeStaff'])->name('staff.store');
    Route::get('/listusers', [CreateRHController::class, 'listUsers'])->name('users.list');
    Route::get('/accesouser/{id}', [AccessUserController::class, 'show'])->name('users.access');
    Route::put('/accesouser/{id}', [AccessUserController::class, 'update'])->name('users.update');
    Route::get('/ocuper', [OcuPerController::class, 'index'])->name('ocuper');
    Route::post('/ocuper', [OcuPerController::class, 'store'])->name('ocuper.store');
    Route::post('/permisos', [OcuPerController::class, 'storePermission'])->name('permisos.store');
    Route::delete('/ocuper/{id}', [OcuPerController::class, 'destroy'])->name('ocuper.destroy');
    Route::delete('/permisos/{id}', [OcuPerController::class, 'destroyPermission'])->name('permisos.destroy');
});
//Rutas de Warehouse
Route::prefix('logistic/warehouse')->group(function () {
    Route::get('/warehouses', [WarehouseController::class, 'index'])->name('Warehouses');
    Route::post('/warehouses', [WarehouseController::class, 'store'])->name('Warehouses.store');
    Route::put('/warehouses/update/{id}', [WarehouseController::class, 'update'])->name('Warehouses.update');
    Route::delete('/warehouses/{id}', [WarehouseController::class, 'destroy'])->name('Warehouses.destroy');
    Route::get('/logistic/warehouse/{id}/info', [InformationWarehouseController::class, 'show'])->name('warehouses.show');
});

//Rutas de Message y Notifications
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

//Ruta de Contact
Route::resource('contacts', ContactController::class);

