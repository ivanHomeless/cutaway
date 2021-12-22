<?php


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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Backend
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function () {

    // Authenticate for admin
    Route::get('/login', [\App\Http\Controllers\Admin\AdminController::class, 'showLoginForm']);
    Route::post('/login', [\App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');

    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        Route::group(['namespace' => 'Users'], function () {
            Route::resource('users', 'UserController')->names('admin.users');
        });

        Route::group(['namespace' => 'Cutaway', 'prefix' => 'cutaway'], function () {
            Route::resource('contacts', 'ContactController')->names('admin.cutaway.contacts');
        });
    });

});

// Пользователи



Route::middleware('auth')->group(function () {
    Route::name('edit')->get('/edit/{profileId}', [\App\Http\Controllers\Cutaway\CutawayController::class, 'edit']);

    Route::name('edit.profile')->get('/profile/{profileId}', [\App\Http\Controllers\Cutaway\CutawayController::class, 'profile']);
    Route::name('edit.profile')->post('/profile/{profileId}', [\App\Http\Controllers\Cutaway\CutawayController::class, 'save']);

    Route::name('edit.contacts')->post('/contacts/{profileId}', [\App\Http\Controllers\Cutaway\CutawayController::class, 'contacts']);
    Route::name('edit.add-contact')->get('/add-contact/{profileId}/{contactId}', [\App\Http\Controllers\Cutaway\CutawayController::class, 'addContact']);

    Route::name('edit.edit-contact')->get('/edit-contact/{profileId}/{contactId}', [\App\Http\Controllers\Cutaway\CutawayController::class, 'editContact']);
    Route::name('edit.edit-contact')->post('/edit-contact/{profileId}/{contactId}', [\App\Http\Controllers\Cutaway\CutawayController::class, 'saveContact']);
    Route::name('edit.delete-contact')->delete('/edit-contact/{profileId}/{contactId}', [\App\Http\Controllers\Cutaway\CutawayController::class, 'deleteContact']);


});


Route::get('/{link}', [App\Http\Controllers\Cutaway\CutawayController::class, 'show']);
