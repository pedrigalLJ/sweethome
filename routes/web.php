<?php

use App\Http\Controllers\Seeker\SeekerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Property\PropertyController;
use App\Http\Controllers\Agent\DocumentController;
use App\Http\Controllers\Seeker\FavoritePropertyController;
use App\Http\Controllers\Agent\AgentAppointmentController;
use App\Http\Controllers\Seeker\SeekerAppointmentController;
use App\Http\Controllers\Agent\PropertyMorePhotosController;
use App\Http\Controllers\Rating\RatingController;
use Illuminate\Support\Facades\Auth; 

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

Route::redirect('/', 'login');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified', 'check-approved'])->group(function () 
{
    
    Route::middleware(['is-seeker', 'prevent-back-history'])->prefix('seeker')->name('seeker.')->group(function()
    {
        Route::get('dashboard', [SeekerController::class, 'index'])->name('dashboard');
        Route::get('view-property/{id}', [SeekerController::class, 'viewProperty'])->name('view-property');
        Route::get('all-properties', [SeekerController::class, 'allProperties'])->name('all-properties');
        Route::get('all-agents', [SeekerController::class, 'allAgents'])->name('all-agents');
        Route::get('about-us', [SeekerController::class, 'aboutUs'])->name('about-us');
        Route::get('profile', [SeekerController::class, 'profile'])->name('profile');
        Route::get('change-password', [SeekerController::class, 'changePassword'])->name('change-password');

        Route::post('update-profile', [SeekerController::class, 'updateProfile'])->name('update-profile');
        Route::post('update-password', [SeekerController::class, 'updatePassword'])->name('update-password');

        Route::get('add-to-favorites/{id}', [FavoritePropertyController::class, 'addToFavorites'])->name('add-to-favorites');
        Route::get('remove-to-favorites/{id}', [FavoritePropertyController::class, 'removeToFavorites'])->name('remove-to-favorites');
        Route::get('my-favorites', [FavoritePropertyController::class, 'viewFavorites'])->name('my-favorites');
        Route::get('favorite-with-remove-btn/{id}', [SeekerController::class, 'viewPropertyWithBtnRemoveToFavorites'])->name('my-favorites-with-remove-btn');
        
        Route::get('appointments', [SeekerAppointmentController::class, 'appointments'])->name('appointments');
        Route::get('appointment-done/{id}', [SeekerAppointmentController::class, 'done'])->name('appointment-done');
        Route::get('appointment-cancel/{id}', [SeekerAppointmentController::class, 'cancel'])->name('appointment-cancel');
        Route::post('appointment-request', [SeekerAppointmentController::class, 'request'])->name('appointment-request');

        Route::get('agent-profile/{id}', [SeekerController::class, 'agentProfile'])->name('agent-profile');

        Route::post('add-rating', [RatingController::class, 'addRating'])->name('add-rating');

    });

    Route::middleware(['is-agent', 'check-approved', 'prevent-back-history'])->prefix('agent')->name('agent.')->group(function()
    {
        Route::get('dashboard', [AgentController::class, 'index'])->name('dashboard');
        Route::get('profile', [AgentController::class, 'profile'])->name('profile');
        Route::get('rate-and-comments', [AgentController::class, 'rateAndComments'])->name('rate-and-comments');
        Route::get('change-password', [AgentController::class, 'changePassword'])->name('change-password');
        Route::get('properties-not-available', [AgentController::class, 'notAvailable'])->name('properties-not-available');
        Route::get('properties/sold', [AgentController::class, 'sold'])->name('properties.sold');
        Route::resource('properties', PropertyController::class);
        
        Route::get('property-add-more-photos/{id}', [PropertyMorePhotosController::class, 'addMorePhotos'])->name('property-add-more-photos');
        Route::post('property-store-photos', [PropertyMorePhotosController::class, 'store'])->name('property-store-photos');
        Route::delete('property-remove-photo/{id}', [PropertyMorePhotosController::class, 'remove'])->name('property-remove-photo');
        
        Route::post('update-profile', [AgentController::class, 'updateProfile'])->name('update-profile');
        Route::post('update-password', [AgentController::class, 'updatePassword'])->name('update-password');
        
        Route::get('documents/download/{file}', [DocumentController::class, 'download'])->name('documents.download');
        Route::resource('documents', DocumentController::class);
        
        Route::get('appointments-need-approval', [AgentAppointmentController::class, 'needApproval'])->name('appointments-need-approval');
        Route::get('appointments-calendar', [AgentAppointmentController::class, 'calendar'])->name('appointments-calendar');
        Route::get('appointment-view/{id}', [AgentAppointmentController::class, 'view'])->name('appointment-view');
        Route::post('appointment-approve', [AgentAppointmentController::class, 'approve'])->name('appointment-approve');
        Route::post('appointment-decline', [AgentAppointmentController::class, 'decline'])->name('appointment-decline');


    });
});

Route::prefix('admin')->name('admin.')->group(function(){
       
    Route::middleware(['guest:admin','prevent-back-history'])->group(function(){
          Route::get('login',[AdminController::class,'login'])->name('login');
          Route::post('check',[AdminController::class,'check'])->name('check');
    });

    Route::middleware(['auth:admin','prevent-back-history'])->group(function()
    {
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('notifications', [AdminController::class, 'notifications'])->name('notifications');
        Route::post('mark-as-read', [AdminController::class, 'markNotifs'])->name('mark-as-read');
        Route::get('need-approval', [AdminController::class, 'needApproval'])->name('need-approval');
        Route::get('user-lists', [AdminController::class, 'userLists'])->name('user-lists');
        Route::get('user-lists-declined', [AdminController::class, 'userListsDeclined'])->name('user-lists-declined');
        Route::get('profile', [AdminController::class, 'profile'])->name('profile');
        Route::get('approve/{id}', [AdminController::class, 'approve'])->name('approve');
        Route::get('decline/{id}', [AdminController::class, 'decline'])->name('decline');
        Route::post('logout',[AdminController::class,'logout'])->name('logout');
        
    });

});