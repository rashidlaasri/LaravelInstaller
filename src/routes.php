<?php

Route::group(['as' => 'LaravelInstaller::', 'namespace' => 'RachidLaasri\LaravelInstaller\Controllers'], function()
{
    Route::group(['prefix' => 'install'], function(){
        Route::group(['middleware' => 'canInstall'], function(){
            get('/', [
                'as' => 'welcome',
                'uses' => 'WelcomeController@welcome'
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

            get('environment', [
                'as' => 'environment',
                'uses' => 'EnvironmentController@environment'
            ]);

            post('environment/save', [
                'as' => 'environmentSave',
                'uses' => 'EnvironmentController@save'
            ]);
        });

        get('final', [
            'as' => 'final',
            'uses' => 'FinalController@finish'
        ]);
    });

    Route::group(['prefix' => 'upgrade', 'middleware' => 'canUpgrade'], function(){
        get('/', [
            'as' => 'upgrade',
            'uses' => 'UpgradeController@welcome'
        ]);
        get('process', [
            'as' => 'process',
            'uses' => 'UpgradeController@process'
        ]);
    });
});