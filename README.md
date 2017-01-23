#NaNoMVC

NaNo is a tiny application framework built for people who use an MVC pattern and aims to be as simple as possible to set up and use.

This work is based on "PIP" framework :
Visit [http://gilbitron.github.com/PIP](http://gilbitron.github.com/PIP/)

And the AltoRouter :
Visit [https://github.com/dannyvankooten/AltoRouter](https://github.com/dannyvankooten/AltoRouter/)

## Requirements

* PHP 5.3+ or greater
* MySQL 4.1.2 or greater
* The mod_rewrite Apache module

## Installation

* Download NaNoMVC and extract
* Navigate to `app/config/config.php` and fill in your `base_url`
* You are ready to rock! Point your browser to your `base_url` and hopefully see a welcome message.

## Documentation

* Edit the `app/config/routes.php` to customize your application
* Edit the `app/config/config.php` to add your database credentials
* Edit the `.htaccess` file to change the SetEnv `APP_ENVIRONMENT "PROD"` to reduce the log verbosity.

* You can use 3 render functions `renderHtml`, `renderJson`, `renderXml`
* For a custom 404 error parge you need to edit the `core/router.php` run() function.

## License

TODO
