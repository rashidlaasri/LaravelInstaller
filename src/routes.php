<?php


Route::group(['prefix' => 'install', 'as' => 'LaravelInstaller::', 'middleware' => 'isInstalled', 'namespace' => 'RachidLaasri\LaravelInstaller\Controllers'], function()
{

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