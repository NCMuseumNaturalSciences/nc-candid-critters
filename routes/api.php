<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| NC Candid API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api\v1', 'prefix' => '/v1'], function () {

    // datatype/module/type/status

    // Get Available Pre-selected Deployment Camera Sites
    Route::get('geojson/sites/all','MapDataController@getAllSites');
    Route::get('geojson/sites/available','MapDataController@getAvailableSites');
    Route::get('geojson/site/{id}','MapDataController@getMapSite');
    Route::get('geojson/site-description/{id}','MapDataController@getSiteDescription');

    Route::post('json/site/selection','MapDataController@storeSelection');
    Route::get('geojson/libraries','MapDataController@getLibraries');

    Route::get('libraries','LibrariesDataController@getLibraries');
    Route::get('libraries/search','LibrariesDataController@searchLibraries');

    Route::get('cameras','CamerasDataController@getCameras');
    Route::get('cameras/search','CamerasDataController@searchCameras');
	Route::get('cameras/test','CamerasDataController@searchTest');

    Route::get('signups','SignupsDataController@getSignups');
    Route::get('signups/training/unassigned','SignupsDataController@getTrainingUnassigned');
    Route::get('signups/volunteers/activated','SignupsDataController@getActivatedSignups');

    Route::get('training/assign','SignupsDataController@assignTraining');
    Route::get('training/completed','SignupsDataController@completedTraining');

    Route::get('site-descriptions/deployments','SiteDescriptionsDataController@getDeploymentsCreated');
    Route::get('site-descriptions/toggle/emammal','SiteDescriptionsDataController@toggleEmammalBoolean');


    Route::get('deployments/create','SiteDescriptionsDataController@createDeployments');


    Route::get('volunteers/activate','SignupsDataController@activateVolunteers');
    Route::get('volunteers/rewards/koozie-form/sent', 'VolunteersDataController@toggleKoozieFormSent');
    Route::get('volunteers/rewards/koozie/sent', 'VolunteersDataController@toggleKoozieSent');
    Route::get('volunteers/rewards/tshirt-form/sent', 'VolunteersDataController@toggleTshirtFormSent');
    Route::get('volunteers/rewards/tshirt/sent', 'VolunteersDataController@toggleTshirtSent');
    Route::get('volunteers/search', 'VolunteersDataController@searchVolunteers');

    Route::get('deployments/set-status','DeploymentsDataController@setStatus');
});