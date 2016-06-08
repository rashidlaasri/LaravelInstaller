# Laravel Web Installer
Do you want your clients to be able to install a Laravel project just like they do with WordPress or any other CMS?
This Laravel package allows users who don't use Composer, SSH etc to install your application just by following the setup wizard.
The current features are : 

	- Check For Server Requirements.
	- Check For Folders Permissions.
	- Ability to set database information.
	- Migrate The Database.
	- Seed The Tables.

If you have any suggestions please let me know : https://github.com/RachidLaasri/LaravelInstaller/pulls.

## Installation

First, pull in the package through Composer.

```
"require": {
    "rachidlaasri/laravel-installer": "1.4.1"
}
```

And then run :

```
composer update
```

After that, include the service provider within `config/app.php`.

```
'providers' => [
    RachidLaasri\LaravelInstaller\Providers\LaravelInstallerServiceProvider::class,
];
```

You can't figure it out? You need more help? Here is a video tutorial for you : [Laravel Installer by Devdojo](https://www.youtube.com/watch?v=Jput5doFYLg)

## Usage

Before using this package you need to run :
```bash
php artisan vendor:publish --provider="RachidLaasri\LaravelInstaller\Providers\LaravelInstallerServiceProvider"
```

You will notice additional files and folders appear in your project :
 
 - `config/installer.php` : In here you can set the requirements along with the folders permissions for your application to run, by default the array cotaines the default requirements for a basic Laravel app.
 - `public/installer/assets` : This folder contains a css folder and inside of it you will find a `main.css` file, this file is responsible for the styling of your installer, you can overide the default styling and add your own.
 - `resources/views/vendor/installer` : This folder contains the HTML code for your installer, it is 100% customizable, give it a look and see how nice/clean it is.
 - `resources/lang/en/messages.php` : This file holds all the messages/text, currently only English is available, if your application is in another language, you can copy/past it in your language folder and modify it the way you want. If you wanna help us provide more languages for this awesome package please send a pull request https://github.com/RachidLaasri/LaravelInstaller/pulls.

## Screenshots
 
![Laravel web installer](http://i.imgur.com/3vYBPLn.png)

## TODO
- [ ] Create Wiki.
- [ ] Support more languages.
