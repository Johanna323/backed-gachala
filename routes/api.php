<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserDocumentController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\KitInventoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\Api\TipoDocumentoController;
use App\Http\Controllers\Api\GeneroController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\SectorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('permissions', PermissionController::class);
Route::apiResource('user-documents', UserDocumentController::class);
Route::apiResource('beneficiaries', BeneficiaryController::class);
Route::apiResource('kit-inventories', KitInventoryController::class);
Route::apiResource('deliveries', DeliveryController::class);
Route::apiResource('audits', AuditController::class);
Route::apiResource('programas', ProgramaController::class);
Route::apiResource('sectores', SectorController::class);

Route::get('/', function () {
    return response()->json(['message' => 'Bienvenido a la API de Gachala']);
});

Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);

Route::get('/tipo-documentos', [TipoDocumentoController::class, 'index']);

Route::get('/generos', [GeneroController::class, 'index']);

Route::get('/deliveries/by-user/{userId}', [\App\Http\Controllers\DeliveryController::class, 'getByUserId']);

Route::get('/roles/{roleId}/has-permission/{permissionName}', [\App\Http\Controllers\RoleController::class, 'hasPermissionByName']);
