# Laravel Web Installer | A Web Installer [Package](https://packagist.org/packages/rachidlaasri/laravel-installer)

[![Total Downloads](https://poser.pugx.org/rachidlaasri/laravel-installer/d/total.svg)](https://packagist.org/packages/rachidlaasri/laravel-installer)
[![Latest Stable Version](https://poser.pugx.org/rachidlaasri/laravel-installer/v/stable.svg)](https://packagist.org/packages/rachidlaasri/laravel-installer)
[![License](https://poser.pugx.org/rachidlaasri/laravel-installer/license.svg)](https://packagist.org/packages/rachidlaasri/laravel-installer)

- [About](#about)
- [Requirements](#requirements)
- [Installation](#installation)
- [Routes](#routes)
- [Usage](#usage)
- [Contributing](#contributing)
- [Help](#help)
- [Screenshots](#screenshots)
- [License](#license)

### About

Do you want your clients to be able to install a Laravel project just like they do with WordPress or any other CMS?
This Laravel package allows users who don't use Composer, SSH etc to install your application just by following the setup wizard.
The current features are :

- Check For Server Requirements.
- Check For Folders Permissions.
- Ability to set database information.
- Migrate The Database.
- Seed The Tables.

### Requirements

* [Laravel 5.1, 5.2, 5.3, 5.4 or newer](https://laravel.com/docs/installation)


### Installation

1. From your projects root folder in terminal run:

```bash
    composer require rachidlaasri/laravel-installer
```

2. Register the package with laravel in `config/app.php` under `providers` with the following:

```php
	'providers' => [
	    RachidLaasri\LaravelInstaller\Providers\LaravelInstallerServiceProvider::class,

	];
```

3. Publish the packages views, config file, assets, and language files by running the following from your projects root folder:

```bash
    php artisan vendor:publish --tag=laravelinstaller
```

### Routes

* `/install`
* `/update`

### Usage

* **Install Routes Notes**
	* In order to install your application, go to the `/install` route and follow the instructions.
	* Once the installation has ran the empty file `installed` will be placed into the `/storage` directory. If this file is present the route `/install` will abort to the 404 page.

* **Update Route Notes**
	* In order to update your application, go to the `/update` route and follow the instructions.
	* The `/update` routes countes how many migration files exist in the `/database/migrations` folder and compares that count against the migrations table. If the files count is greater then the `/update` route will render, otherwise, the page will abort to the 404 page.


* Additional Files and folders published to your project :

|File|File Information|
|:------------|:------------|
|`config/installer.php`|In here you can set the requirements along with the folders permissions for your application to run, by default the array cotaines the default requirements for a basic Laravel app.|
|`public/installer/assets`|This folder contains a css folder and inside of it you will find a `main.css` file, this file is responsible for the styling of your installer, you can overide the default styling and add your own.|
|`resources/views/vendor/installer`|This folder contains the HTML code for your installer, it is 100% customizable, give it a look and see how nice/clean it is.|
|`resources/lang/en/installer_messages.php`|This file holds all the messages/text, currently only English is available, if your application is in another language, you can copy/past it in your language folder and modify it the way you want.|

### Contributing

* If you have any suggestions please let me know : https://github.com/RachidLaasri/LaravelInstaller/pulls.
* Please help us provide more languages for this awesome package please send a pull request https://github.com/RachidLaasri/LaravelInstaller/pulls.

### Help

* Cannot figure it out? Need more help? Here is a video tutorial: [Laravel Installer by Devdojo](https://www.youtube.com/watch?v=Jput5doFYLg)

### Screenshots

![Laravel web installer](http://i.imgur.com/3vYBPLn.png)

### License

Laravel Web Installer is licensed under the MIT license. Enjoy!
