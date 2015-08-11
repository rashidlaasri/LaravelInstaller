# Laravel Web Installer

## Installation

First, pull in the package through Composer.

```
"require": {
    "rachidlaasri/laravel-installer": "1.0.2"
}
```

And then, include the service provider within `app/config/app.php`.

```
'providers' => [
    RachidLaasri\LaravelInstaller\Providers\LaravelInstallerServiceProvider::class
];
```
## Usage

To use this package run :
```bash
php artisan vendor:publish
```

After that, you can edit :
 
 `app/config/installer.php`
 
And the language file :
 
 `resources/lang/en/messages.php`
 
And the views on :
 
 `resources/views/installer/`
