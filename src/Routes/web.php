<?php

Route::group(['prefix' => 'install','as' => 'LaravelInstaller::','namespace' => 'RachidLaasri\LaravelInstaller\Controllers','middleware' => ['web', 'install']], function() {
    Route::get('/', [
        'as' => 'welcome',
        'uses' => 'WelcomeController@welcome'
    ]);

    Route::get('environment', [
        'as' => 'environment',
        'uses' => 'EnvironmentController@environmentMenu'
    ]);

    Route::get('environment/wizard', [
        'as' => 'environmentWizard',
        'uses' => 'EnvironmentController@environmentWizard'
    ]);

    Route::post('environment/saveWizard', [
        'as' => 'environmentSaveWizard',
        'uses' => 'EnvironmentController@saveWizard'
    ]);

    Route::get('environment/classic', [
        'as' => 'environmentClassic',
        'uses' => 'EnvironmentController@environmentClassic'
    ]);

    Route::post('environment/saveClassic', [
        'as' => 'environmentSaveClassic',
        'uses' => 'EnvironmentController@saveClassic'
    ]);

    Route::get('requirements', [
        'as' => 'requirements',
        'uses' => 'RequirementsController@requirements'
    ]);

    Route::get('permissions', [
        'as' => 'permissions',
        'uses' => 'PermissionsController@permissions'
    ]);

    Route::get('database', [
        'as' => 'database',
        'uses' => 'DatabaseController@database'
    ]);

    Route::get('final', [
        'as' => 'final',
        'uses' => 'FinalController@finish'
    ]);

});

Route::group(['prefix' => 'update','as' => 'LaravelUpdater::','namespace' => 'RachidLaasri\LaravelInstaller\Controllers','middleware' => 'web'],function() {
    Route::group(['middleware' => 'update'], function() {

        Route::get('/', [
            'as' => 'welcome',
            'uses' => 'UpdateController@welcome'
        ]);

        Route::get('overview', [
            'as' => 'overview',
            'uses' => 'UpdateController@overview'
        ]);

        Route::get('database', [
            'as' => 'database',
            'uses' => 'UpdateController@database'
        ]);
    });

    Route::get('final', [
        'as' => 'final',
        'uses' => 'UpdateController@finish'
    ]);
});
