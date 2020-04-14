<?php
use App\User;
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
/* Debugging Queries Only - Display all SQL executed in Eloquent
\Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
    var_dump($query->sql);
    var_dump($query->bindings);
    var_dump($query->time);
});
*/


Route::get('/','PagesController@home');
Route::get('/dashboard','DashboardController@router');
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('unauthorized', 'PagesController@unauthorized');

/* Public Forms */
Route::get('forms/{id}/signup', 'SignupsController@create');
Route::post('forms/signup', ['as' => 'signups.create', 'uses' => 'SignupsController@store']);
//Route::get('forms/{id}/site-description', 'SiteDescriptionsController@create');
//Route::post('forms/site-description', ['as' => 'site-descriptions.create', 'uses' => 'SiteDescriptionsController@store']);

//Route::get('map/selection','MapController@getSelectionMap');
//Route::post('map/selection', ['as' => 'map-selection.create', 'uses' => 'SiteDescriptionsController@storeSelection']);
Route::get('map/libraries','MapController@getLibrariesMap');
Route::get('map/site/{id}','MapController@getMapSite');
Route::get('map/site-description/{id}','MapController@getSiteDescriptionMap');

Route::get('datatables/map-sites-data', array('uses' => 'DatatablesController@getMapSitesData'));


Route::group( ['middleware' => 'auth'], function() {
    Route::get('profile', 'ProfileController@show');

    Route::group(['prefix' => 'librarian', 'namespace' => 'Librarian', 'middleware' => ['role:librarian|administrator']], function () {

        Route::get('dashboard', 'PagesController@dashboard');

        Route::get('profile', 'ProfileController@show');
        Route::get('profile/edit', 'ProfileController@edit');
        Route::patch('profile/edit', ['as' => 'librarian.profile.update', 'uses' => 'ProfileController@update']);

        Route::get('inventory', 'InventoryController@index');
        Route::get('inventory/{id}/edit', 'InventoryController@edit');
        Route::post('inventory/{id}/edit', 'InventoryController@update');

        Route::get('reservations', 'ReservationsController@index');
        Route::get('reservations/all', 'ReservationsController@index');
        Route::get('reservations/open', 'ReservationsController@open');
        Route::get('reservations/closed', 'ReservationsController@closed');

        Route::get('reservations/create/{inventory_id?}', 'ReservationsController@create');
        Route::get('reservations/create', 'ReservationsController@create');
        Route::get('reservations/{id}/show', 'ReservationsController@show');
        Route::post('reservations/create', ['as' => 'librarian.reservation.create', 'uses' => 'ReservationsController@store']);
        Route::get('reservations/{id}/{action}', 'ReservationsController@edit');

        Route::patch('reservations/{id}/update', 'ReservationsController@close');
        Route::delete('reservations/{id}', ['as' => 'librarian.reservations.destroy', 'uses' => 'ReservationsController@destroy']);

        Route::get('library', 'LibraryController@show');
        Route::get('library/{id}/edit', 'LibraryController@edit');
        Route::patch('library/{id}/edit', 'LibraryController@update');

        Route::get('volunteer/{id}/show', 'VolunteersController@show');

        Route::get('datatables/inventory/filter', 'DatatablesController@filterInventory');
        Route::get('datatables/reservations/all', 'DatatablesController@getReservations');
        Route::get('datatables/reservations/open', 'DatatablesController@getOpenReservations');
        Route::get('datatables/reservations/closed', 'DatatablesController@getClosedReservations');

    });

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['role:administrator']], function () {

        Route::get('dashboard', 'PagesController@dashboard');

        Route::get('users', ['as' => 'admin.users.index', 'uses' => 'UsersController@index']);
        Route::get('users/{id}/show', 'UsersController@show');
		Route::get('users/create', ['as' => 'admin.users.create', 'uses' => 'UsersController@create']);
		Route::post('users/create', 'UsersController@store');

        Route::get('users/{id}/edit',['as' => 'admin.users.edit', 'uses' => 'UsersController@edit']);
        Route::post('users/{id}/edit', 'UsersController@update');
         Route::delete('users/{id}', ['as' => 'admin.users.destroy', 'uses' => 'UsersController@destroy']);
//        Route::resource('users', 'UsersController');

        Route::resource('roles', 'RolesController');
        Route::resource('permissions', 'PermissionsController');

        Route::get('users/library/assign', 'UsersController@assignLibrary');
        Route::post('users/library/assign', ['as' => 'admin.user.assign', 'uses' => 'UsersController@storeAssignment']);
        Route::get('users/library/assign/{id}/edit', 'UsersController@editAssignment');
        Route::patch('users/library/assign/{id}/edit', 'UsersController@updateAssignment');
        Route::delete('users/library/assign/{id}', ['as' => 'admin.user.assignment.destroy', 'uses' => 'UsersController@destroyAssignment']);

        Route::get('cameras','CamerasController@index');
        Route::get('cameras/{id}/show', 'CamerasController@show');
        Route::get('cameras/create', 'CamerasController@create');
        Route::post('cameras/create', ['as' => 'cameras.create', 'uses' => 'CamerasController@store']);
        Route::get('cameras/{id}/edit', 'CamerasController@edit');
        Route::patch('cameras/{id}/edit', 'CamerasController@update');
        Route::delete('cameras/{id}', ['as' => 'admin.cameras.destroy', 'uses' => 'CamerasController@destroy']);

        Route::get('map-sites','MapSitesController@index');
        Route::get('map-sites/{id}/show', 'MapSitesController@show');
        Route::get('map-sites/create', 'MapSitesController@create');
        Route::post('map-sites/create', ['as' => 'mapSites.create', 'uses' => 'MapSitesController@store']);
        Route::get('map-sites/{id}/edit', 'MapSitesController@edit');
        Route::patch('map-sites/{id}/edit', 'MapSitesController@update');
        Route::delete('map-sites/{id}', ['as' => 'admin.map-sites.destroy', 'uses' => 'MapSitesController@destroy']);

        Route::get('signups','SignupsController@index');
        Route::get('signups/unactivated','SignupsController@unactivated');
        Route::get('signups/activated', 'SignupsController@activated');
        Route::get('signups/{id}/show', 'SignupsController@show');
        Route::get('signups/{id}/edit', 'SignupsController@edit');
        Route::patch('signups/{id}/edit', 'SignupsController@update');



        Route::get('signups/{id}/activate', 'SignupsController@activateSingleVolunteer');
        Route::delete('signups/{id}', ['as' => 'admin.signups.destroy', 'uses' => 'SignupsController@destroy']);



        Route::get('site-descriptions','SiteDescriptionsController@index');
        Route::get('site-descriptions/uploaders','SiteDescriptionsController@uploaders');
        Route::get('site-descriptions/nonuploaders','SiteDescriptionsController@nonuploaders');
        Route::get('site-descriptions/{id}/edit', 'SiteDescriptionsController@edit');
        Route::patch('site-descriptions/{id}/edit', 'SiteDescriptionsController@update');
        Route::get('site-descriptions/{id}/show', 'SiteDescriptionsController@show');
        Route::get('site-descriptions/{id}/activate', 'SiteDescriptionsController@activateSingleDeployment');



        Route::delete('site-descriptions/{id}', ['as' => 'admin.site-descriptions.destroy', 'uses' => 'SiteDescriptionsController@destroy']);



        Route::get('map-selections', 'MapSelectionsController@index');
        Route::get('map-selections/{id}/show', 'MapSelectionsController@show');
        Route::get('map-selections/{id}/edit', 'MapSelectionsController@edit');
        Route::patch('map-selections/{id}/edit', 'MapSelectionsController@update');
        Route::post('map-selections/change-status', 'MapSelectionsController@changeStatus');


        Route::get('datatables/signups-data', 'DatatablesController@getSignups');
        Route::get('datatables/unactivated-signups-data', 'DatatablesController@getUnactivatedSignups');
        Route::get('datatables/activated-signups-data', 'DatatablesController@getActivatedSignups');

        Route::get('datatables/site-descriptions-data', 'DatatablesController@getSiteDescriptions');
        Route::get('datatables/uploader/site-descriptions-data', 'DatatablesController@getUploaderSiteDescriptions');
        Route::get('datatables/nonuploader/site-descriptions-data', 'DatatablesController@getNonUploaderSiteDescriptions');

        Route::get('datatables/signups', 'DatatablesController@getSignups');
        Route::get('datatables/map-sites', 'DatatablesController@getMapSitesData');
        Route::get('datatables/map-selections-data', 'DatatablesController@getMapSelections');
        Route::get('datatables/map-selections-data/county/{county}', 'DatatablesController@getMapSelectionsByCounty');
        Route::get('datatables/deployments', 'DatatablesController@getDeployments');
        Route::get('datatables/volunteers', 'DatatablesController@getVolunteers');
        Route::get('datatables/volunteers/rewards', 'DatatablesController@getVolunteerRewards');
//        Route::get('datatables/site-descriptions/search', 'DatatablesController@searchSiteDescriptions');
        Route::get('datatables/cameras-data', 'DatatablesController@getCameras');
        Route::get('datatables/libraries-data', 'DatatablesController@getLibraries');
        Route::get('datatables/libraries/{library_id?}/assignments', 'DatatablesController@getLibraryVolunteers');
        Route::get('datatables/reservations/all', 'DatatablesController@getReservations');
        Route::get('datatables/reservations/open', 'DatatablesController@getOpenReservations');
        Route::get('datatables/reservations/closed', 'DatatablesController@getClosedReservations');
        Route::get('datatables/inventories-data', 'DatatablesController@getInventoriesData');

        // Hybrid Datatable Pairs
        Route::get('datatables/libraries-volunteers-data', 'DatatablesController@getLibrariesVolunteers');
        Route::get('libraries-volunteers', 'DatatablesController@librariesVolunteers');
        Route::get('datatables/libraries-users-data', 'DatatablesController@getLibrariesUsers');
        Route::get('libraries-users', 'DatatablesController@librariesUsers');

        Route::get('deployments','DeploymentsController@index');
        Route::get('deployments/{id}/show', 'DeploymentsController@show');
        Route::get('deployments/{id}/edit', 'DeploymentsController@edit');
        Route::patch('deployments/{id}/edit', 'DeploymentsController@update');
        Route::post('deployments/change-status', 'DeploymentsController@changeStatus');

        Route::get('deployments/create/single/{id}', 'DeploymentsController@createSingleDeployment');


        Route::delete('deployments/{id}', ['as' => 'admin.deployments.destroy', 'uses' => 'DeploymentsController@destroy']);

        Route::get('volunteers','VolunteersController@index');
        Route::get('volunteers/rewards','VolunteersController@rewards');
        Route::get('volunteers/{id}/show', 'VolunteersController@show');
        Route::get('volunteers/{id}/edit', 'VolunteersController@edit');
        Route::patch('volunteers/{id}/edit', 'VolunteersController@update');
        Route::delete('volunteers/{volunteer_id}/assignment/{assignment_id}/delete', ['as' => 'admin.volunteers.assignment.destroy', 'uses' => 'VolunteersController@deleteAssignment']);
        Route::delete('volunteers/{id}', ['as' => 'admin.volunteers.destroy', 'uses' => 'VolunteersController@destroy']);

        Route::get('assign/training', 'TrainingController@assign');

        Route::get('exports', 'ExportController@index');
        Route::get('export/signups','ExportController@exportSignups');
        Route::get('export/site-descriptions','ExportController@exportSiteDescriptions');
        Route::get('export/deployments','ExportController@exportDeployments');
        Route::get('export/volunteers','ExportController@exportVolunteers');
        Route::get('export/selected-sites','ExportController@exportSelectedSites');
        Route::post('export/training-assigned', ['as' => 'admin.export.training', 'uses' => 'ExportController@exportTrainingAssignmentsByDate']);
        Route::get('export/master-inventory','ExportController@exportMasterInventory');
        Route::get('apis', 'PagesController@getApiInformation');

        Route::get('libraries','LibrariesController@index');
        Route::get('libraries/{id}/show', 'LibrariesController@show');
        Route::get('libraries/create', 'LibrariesController@create');
        Route::post('libraries/create', ['as' => 'libraries.create', 'uses' => 'LibrariesController@store']);
        Route::get('libraries/{id}/edit', 'LibrariesController@edit');
        Route::patch('libraries/{id}/edit', 'LibrariesController@update');
        Route::delete('libraries/{id}', ['as' => 'admin.libraries.destroy', 'uses' => 'LibrariesController@destroy']);

        Route::get('libraries/assign/volunteer/{volunteer_id?}', 'LibrariesController@assignVolunteer');
        Route::post('libraries/assign/volunteer', ['as' => 'admin.libraries.assign.volunteer','uses' => 'LibrariesController@storeVolunteerAssignment']);
        Route::get('libraries/{id}/volunteers', 'VolunteersController@getAssignedVolunteers');
        Route::delete('libraries/{library_id}/assignment/{assignment_id}/delete', ['as' => 'admin.assignment.destroy', 'uses' => 'LibrariesController@deleteAssignment']);

        Route::post('libraries/inventory/add', 'LibrariesController@addInventory');
        Route::delete('inventory/{inventory_id?}/delete', ['as' => 'admin.library.inventory.destroy', 'uses' => 'LibrariesController@deleteInventory']);
        Route::get('libraries/assignments/{id}', 'LibrariesController@getAssignments');
        Route::get('libraries/{id}/inventory/available', 'InventoryController@getLibraryAvailableInventory');
        Route::get('libraries/{id}/inventory', 'InventoryController@getLibraryInventory');

        Route::get('reservations', 'ReservationsController@index');
        Route::get('reservations/all', 'ReservationsController@index');
        Route::get('reservations/open', 'ReservationsController@open');
        Route::get('reservations/closed', 'ReservationsController@closed');

        Route::get('reservations/all/library/{library_id?}', 'ReservationsController@libraryAll');
        Route::get('reservations/open/library/{library_id?}', 'ReservationsController@libraryOpen');
        Route::get('reservations/closed/library/{library_id?}', 'ReservationsController@libraryClosed');
        Route::get('datatables/reservations/{status_id}/library/{library_id}', 'DatatablesController@getLibraryReservations');
        Route::get('reservations/{id}/show', 'ReservationsController@show');

        Route::get('reservations/create', 'ReservationsController@create');
        Route::post('reservations/create', ['as' => 'admin.reservation.create', 'uses' => 'ReservationsController@store']);
        Route::get('reservations/{id}/edit', 'ReservationsController@edit');
        Route::patch('reservations/{id}/update','ReservationsController@update');
        Route::delete('reservations/{id}', ['as' => 'admin.reservation.destroy', 'uses' => 'ReservationsController@destroy']);

        Route::get('inventories','InventoryController@index');
        Route::get('inventories/add','InventoryController@create');
        Route::post('inventories/add', 'InventoryController@store');
        Route::post('inventories/add', ['as' => 'admin.inventory.add', 'uses' => 'InventoryController@store']);
        Route::get('inventories/{id}/show','InventoryController@show');
        Route::get('inventories/{id}/edit','InventoryController@edit');
        Route::patch('inventories/{id}/update','InventoryController@update');
        Route::delete('inventories/{id}', ['as' => 'admin.inventory.destroy', 'uses' => 'InventoryController@destroy']);

        Route::get('inventory/{library}', 'InventoryController@getLibraryInventory');
        Route::post('inventories/status/edit', 'InventoryController@changeStatus');
        Route::get('inventory/{id}/check', 'InventoryChecksController@edit');
        Route::patch('inventory/{id}/check', 'InventoryChecksController@update');

        // Datatables Editor Routes
        Route::get('signups/table', 'SignupsEditorController@index');
        Route::get('signups/table/data', 'SignupsEditorController@getSignupsData');
        Route::post('signups/table/store', 'SignupsEditorController@store');

    });
});


Route::get('test/email/{id}','EmailTestsController@sendBlankTest');
Route::get('test/email/admin/site-selection', 'EmailTestsController@sendMapSelectionAdminTest');
Route::get('test/email/user/site-selection', 'EmailTestsController@sendSiteSelectionConfirmationTest');
Route::get('test/email/singups/{formid}', 'EmailTestsController@sendTestSignupsConfirmation');
Route::get('emails/test/blank/{id}', 'EmailTestController@sendBlankTest');
Route::get('emails/test/map-selection', 'EmailTestsController@sendSiteSelectionConfirmationTest');

/*
Route::group(
[
    'prefix' => 'emammal_datas',
], function () {

    Route::get('/', 'EmammalDatasController@index')
         ->name('emammal_datas.emammal_data.index');

    Route::get('/create','EmammalDatasController@create')
         ->name('emammal_datas.emammal_data.create');

    Route::get('/show/{emammalData}','EmammalDatasController@show')
         ->name('emammal_datas.emammal_data.show')
         ->where('id', '[0-9]+');

    Route::get('/{emammalData}/edit','EmammalDatasController@edit')
         ->name('emammal_datas.emammal_data.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'EmammalDatasController@store')
         ->name('emammal_datas.emammal_data.store');

    Route::put('emammal_data/{emammalData}', 'EmammalDatasController@update')
         ->name('emammal_datas.emammal_data.update')
         ->where('id', '[0-9]+');

    Route::delete('/emammal_data/{emammalData}','EmammalDatasController@destroy')
         ->name('emammal_datas.emammal_data.destroy')
         ->where('id', '[0-9]+');

});
*/
