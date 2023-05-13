<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\CaisseController;
use App\Http\Controllers\Backend\CongeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\EstheticienController;
use App\Http\Controllers\Backend\FactureController;
use App\Http\Controllers\Backend\FournisseurController;
use App\Http\Controllers\Backend\PlaningController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductTypeController;
use App\Http\Controllers\Backend\ReservationController;
use App\Http\Controllers\Backend\SoinController;
use App\Http\Controllers\Backend\TypeSoinController;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\HomeComtroller;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [FrontController::class, 'home'])
    ->name('home');
Route::get('/startreservation', [FrontController::class, 'startreservation'])
    ->name('startreservation');
Route::get('/cart', [FrontController::class, 'cart'])
    ->name('cart');
Route::get('/detailsoin', [FrontController::class, 'detailsoin'])
    ->name('detailsoin');
Route::get('/checkoutsession', [FrontController::class, 'checkoutsession'])
    ->name('checkoutsession');
Route::get('/calculplaning', [FrontController::class, 'calculplaning'])
    ->name('calculplaning');
Route::get('/contact', [FrontController::class, 'contact'])
    ->name('contact');
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
Route::get('/app/login', [AuthController::class, 'logincustomer'])
    ->name('logincustomer');
Route::get('/destroy', [AuthController::class, 'destroy'])
    ->name('destroy');
Route::post('/loginstore', [AuthController::class, 'loginstore'])
    ->name('loginstore');
Route::post('/loginstorecustomer', [AuthController::class, 'loginstorecustomer'])
    ->name('loginstorecustomer');
Route::match(array('GET', 'POST'), '/app/register', [AuthController::class, 'register'])
    //->middleware('guest')
    ->name('register');
Route::match(array('GET', 'POST'), '/reset_password', [AuthController::class, 'reset_password'])
    ->name('reset_password');
Route::match(array('GET', 'POST'), '/changeimage', [AuthController::class, 'changeimage'])
    ->name('changeimage');
Route::group(['middleware' => ['checkCustomer']], function () {
    Route::get('/app/account', [AccountController::class, 'account'])
        ->name('account');
    Route::match(array('GET', 'POST'),'/checkout', [FrontController::class, 'checkout'])
        ->name('checkout');
});
Route::group(['middleware' => ['auth','isAdmin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('/reservation', [ReservationController::class, 'index'])
        ->name('reservation');
    Route::get('/reservation/pending', [ReservationController::class, 'pending'])
        ->name('reservation_pending');
    Route::get('/reservation/reject', [ReservationController::class, 'reject'])
        ->name('reservation_reject');
    Route::get('/reservation/edit/{id}', [ReservationController::class, 'edit'])
        ->name('reservation.edit');
    Route::get('/reservation/show/{id}', [ReservationController::class, 'show'])
        ->name('reservation.show');
    Route::get('/reservation/getuserbyreservation', [ReservationController::class, 'getuserbyreservation'])
        ->name('reservation.getuserbyreservation');
    Route::post('/reservation/affecter', [ReservationController::class, 'affecter'])
        ->name('reservation.affecter');
    Route::get('/planingown', [PlaningController::class, 'planingown'])
        ->name('planingown');
    Route::get('/planing', [PlaningController::class, 'index'])
        ->name('planing');
    Route::get('/planing_week/{id}', [PlaningController::class, 'planing_week'])
        ->name('planing_week');
    Route::get('/planing_add', [PlaningController::class, 'planing_add'])
        ->name('planing_add');
    Route::get('/planing_remove', [PlaningController::class, 'planing_remove'])
        ->name('planing_remove');
    Route::get('/planing_change', [PlaningController::class, 'planing_change'])
        ->name('planing_change');
    Route::group(['prefix' => 'conge', 'as' => 'conge.'],function (){
        Route::match(array('GET', 'POST'), 'create', [CongeController::class, 'create'])
            ->name('create');
        Route::get('/list', [CongeController::class, 'index'])
            ->name('index');
        Route::get('/edit/{id}', [CongeController::class, 'edit'])
            ->name('edit');
        Route::post('/update/{id}', [CongeController::class, 'update'])
            ->name('update');
        Route::post('/store', [CongeController::class, 'store'])
            ->name('store');

    });
    Route::group(['prefix' => 'customer', 'as' => 'customer.'],function (){
        Route::match(array('GET', 'POST'), 'create', [CustomerController::class, 'create'])
            ->name('create');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])
            ->name('edit');
        Route::post('/update/{id}', [CustomerController::class, 'update'])
            ->name('update');
        Route::get('/list', [CustomerController::class, 'index'])
            ->name('index');
        Route::post('/store', [CustomerController::class, 'store'])
            ->name('store');
        Route::delete('/destroy', [CustomerController::class, 'destroy'])
            ->name('destroy');

    });
    Route::group(['prefix' => 'estheticien', 'as' => 'estheticien.'],function (){
        Route::match(array('GET', 'POST'), 'create', [EstheticienController::class, 'create'])
            ->name('create');
        Route::get('/edit/{id}', [EstheticienController::class, 'edit'])
            ->name('edit');
        Route::post('/update/{id}', [EstheticienController::class, 'update'])
            ->name('update');
        Route::get('/list', [EstheticienController::class, 'index'])
            ->name('index');
        Route::post('/store', [EstheticienController::class, 'store'])
            ->name('store');
        Route::delete('/destroy', [EstheticienController::class, 'destroy'])
            ->name('destroy');

    });
    Route::group(['prefix' => 'facturation', 'as' => 'facturation.'],function (){
        Route::match(array('GET', 'POST'), 'create', [FactureController::class, 'create'])
            ->name('create');
        Route::get('/edit/{id}', [FactureController::class, 'edit'])
            ->name('edit');
        Route::post('/update/{id}', [FactureController::class, 'update'])
            ->name('update');
        Route::get('/list', [FactureController::class, 'index'])
            ->name('index');
        Route::match(array('GET', 'POST'), '/customer', [FactureController::class, 'customer'])
            ->name('customer');
        Route::post('/store', [FactureController::class, 'store'])
            ->name('store');
        Route::delete('/destroy', [FactureController::class, 'destroy'])
            ->name('destroy');

    });
    Route::group(['prefix' => 'product_type', 'as' => 'product_type.'],function (){
        Route::match(array('GET', 'POST'), 'create', [ProductTypeController::class, 'create'])
            ->name('create');
        Route::get('/edit/{id}', [ProductTypeController::class, 'edit'])
            ->name('edit');
        Route::post('/update/{id}', [ProductTypeController::class, 'update'])
            ->name('update');
        Route::get('/list', [ProductTypeController::class, 'index'])
            ->name('index');
        Route::post('/store', [ProductTypeController::class, 'store'])
            ->name('store');
        Route::delete('/destroy', [ProductTypeController::class, 'destroy'])
            ->name('destroy');

    });
    Route::group(['prefix' => 'fournisseur', 'as' => 'fournisseur.'],function (){
        Route::match(array('GET', 'POST'), 'create', [FournisseurController::class, 'create'])
            ->name('create');
        Route::get('/edit/{id}', [FournisseurController::class, 'edit'])
            ->name('edit');
        Route::post('/update/{id}', [FournisseurController::class, 'update'])
            ->name('update');
        Route::get('/list', [FournisseurController::class, 'index'])
            ->name('index');
        Route::post('/store', [FournisseurController::class, 'store'])
            ->name('store');
        Route::delete('/destroy', [FournisseurController::class, 'destroy'])
            ->name('destroy');

    });
    Route::group(['prefix' => 'product', 'as' => 'product.'],function (){
        Route::match(array('GET', 'POST'), 'create', [ProductController::class, 'create'])
            ->name('create');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])
            ->name('edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])
            ->name('update');
        Route::get('/list', [ProductController::class, 'index'])
            ->name('index');
        Route::post('/store', [ProductController::class, 'store'])
            ->name('store');
        Route::delete('/destroy', [ProductController::class, 'destroy'])
            ->name('destroy');

    });
    Route::group(['prefix' => 'caisse', 'as' => 'caisse.'],function (){
        Route::match(array('GET', 'POST'), 'create', [CaisseController::class, 'create'])
            ->name('create');
        Route::get('/edit/{id}', [CaisseController::class, 'edit'])
            ->name('edit');
        Route::post('/update/{id}', [CaisseController::class, 'update'])
            ->name('update');
        Route::get('/list', [CaisseController::class, 'index'])
            ->name('index');
        Route::post('/store', [CaisseController::class, 'store'])
            ->name('store');
        Route::delete('/destroy', [CaisseController::class, 'destroy'])
            ->name('destroy');

    });
    Route::group(['prefix' => 'soin', 'as' => 'soin.'],function (){
        Route::match(array('GET', 'POST'), 'create', [SoinController::class, 'create'])
            ->name('create');
        Route::get('/list', [SoinController::class, 'index'])
            ->name('index');
        Route::get('/edit/{id}', [SoinController::class, 'edit'])
            ->name('edit');
        Route::post('/update/{id}', [SoinController::class, 'update'])
            ->name('update');
        Route::post('/store', [SoinController::class, 'store'])
            ->name('store');
        Route::delete('/destroy', [SoinController::class, 'destroy'])
            ->name('destroy');
    });
    Route::group(['prefix' => 'typesoin', 'as' => 'typesoin.'],function (){
        Route::match(array('GET', 'POST'), 'create', [TypeSoinController::class, 'create'])
            ->name('create');
        Route::get('/list', [TypeSoinController::class, 'index'])
            ->name('index');
        Route::get('/edit/{id}', [TypeSoinController::class, 'edit'])
            ->name('edit');
        Route::post('/update/{id}', [TypeSoinController::class, 'update'])
            ->name('update');
        Route::post('/store', [TypeSoinController::class, 'store'])
            ->name('store');
        Route::delete('/destroy', [TypeSoinController::class, 'destroy'])
            ->name('destroy');
    });
    Route::group(['prefix' => 'planing', 'as' => 'planing.'],function (){
        Route::match(array('GET', 'POST'), 'create', [SoinController::class, 'create'])
            ->name('create');
        Route::get('/list', [SoinController::class, 'index'])
            ->name('index');
        Route::post('/store', [SoinController::class, 'store'])
            ->name('store');
    });

    Route::get('/connexions', [HomeComtroller::class, 'connexion'])
        ->name('connexion');
    Route::get('/users', [HomeComtroller::class, 'users'])
        ->name('users');

    Route::get('/deletecalandar', [HomeComtroller::class, 'deleteCalandar'])
        ->name('deletecalandar');
    Route::match(array('GET', 'POST'), '/profil', [AuthController::class, 'profil'])
        ->name('profil');
    Route::match(array('GET', 'POST'), '/changepassword', [AuthController::class, 'changepassword'])
        ->name('changepassword');

    Route::get('/report/calendar', [HomeComtroller::class, 'reportCalendar'])
        ->name('reportcalandar');
});
Route::group(['middleware' => 'isAdmin'], function () {
    Route::match(array('GET', 'POST'), '/conge', [HomeComtroller::class, 'conge'])
        ->name('conge');
    Route::match(array('GET', 'POST'), '/periode', [HomeComtroller::class, 'periode'])
        ->name('periode');
    Route::match(array('GET', 'POST'), '/periode_edit/{id}', [HomeComtroller::class, 'periode_edit'])
        ->name('periode_edit');
    Route::match(array('GET', 'POST'), '/conge_edit/{id}', [HomeComtroller::class, 'conge_edit'])
        ->name('conge_edit');
    Route::match(array('GET', 'POST'), '/users/activate/{id}', [HomeComtroller::class, 'activate_or_desactivate'])
        ->name('activate_or_desactivate');
    Route::get('/delete_conge', [HomeComtroller::class, 'delete_conge'])
        ->name('delete_conge');
    Route::get('/delete_periode', [HomeComtroller::class, 'delete_periode'])
        ->name('delete_periode');
    Route::get('/connexions', [HomeComtroller::class, 'connexion'])
        ->name('connexion');
    Route::get('/users', [HomeComtroller::class, 'users'])
        ->name('users');
    Route::post('/users/sendmail', [HomeComtroller::class, 'sendmail'])
        ->name('sendmail');

});

