<?php

Route::group(['prefix' => 'install', 'as' => 'LaravelInstaller::', 'namespace' => 'RachidLaasri\LaravelInstaller\Controllers'], function()
{
    Route::group(['middleware' => 'canInstall'], function()
    {
        get('/', [
            'as' => 'welcome',
            'uses' => 'WelcomeController@welcome'
        ]);

        get('environment', [
            'as' => 'environment',
            'uses' => 'EnvironmentController@environment'
        ]);

        post('environment/save', [
            'as' => 'environmentSave',
            'uses' => 'EnvironmentController@save'
        ]);

        get('requirements', [
            'as' => 'requirements',
            'uses' => 'RequirementsController@requirements'
        ]);
        
        get('permissions', [
            'as' => 'permissions',
            'uses' => 'PermissionsController@permissions'
        ]);

        get('database', [
            'as' => 'database',
            'uses' => 'DatabaseController@database'
        ]);

        get('final', [
            'as' => 'final',
            'uses' => 'FinalController@finish'
        ]);
    });
});