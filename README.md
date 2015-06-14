
# ArtWebApp

ArtWebApp is a fast, secure, feature rich, scalable web application framework for PHP5, using Symfony2 components integrating with the best practices of MVC.

It's easy to start:

```php
<?php

require_once('../ArtLibs/Application.php');

$app = new \ArtLibs\Application();

class test {
    function viewTest() {
        echo "Hello World!";
    }
}

$app->getRouteManager()->dispatchUrl(
	array(
        '/test' => './test/viewTest',
    )
);

```


### Requirements
----------------

Requires `PHP 5.3` or greater.


### Installation instruction
----------------------------

The following steps are applicable in both Windows and Linux (*nix) platforms, while git, php etc., are installed and accessible in command line.

* Step 1. The copy of ArtWebApp for your use can be obtained by making a clone from github. Assuming the git is installed the following command can be used:

	```
	$ git clone https://github.com/aazhbd/ArtWeb.git
	```

	This creates a folder named "ArtWebApp" which can be renamed to fit necessity.

* Step 2. The components for the framework has to be installed and/or updated through composer. Assuming PHP is installed in the commadline, the composer itself can be obtained by following command:

	```
	$ php -r "readfile('https://getcomposer.org/installer');" | php
	```

	While having the composer.json file obtained in the ArtWebApp folder and composer.phar is downloaded in the same directory, the following can be used to install the components:

	```
	$ php composer.phar install
	```

	This should create a vendor folder, and should automatically integrate itself with rest of the library. And the setup is ready to use.
	

* Step 3. Changing the browser to pointing the webroot folder should open an initial page, assuming conf.php and routes.php are as downloaded. This can be sorted by creating a virtualhost or changing apache DocumentRoot to point to webroot folder.


Change Configuration: There is a `conf.php` file that contains most common configuration values, like database credentials, paths for different folder etc., these can be changed to fit particular environment.

Change Routes/URLs: There is a `routes.php` file that contains the mapping of urls with methods. More  comma-separated key => value pairs can be added to address any number of urls.

Anytime if any of the components needs to updated and/or added the following can be used:

```
$ php composer.phar update
```

This is should create a clean initial setup for any Web Application software. It could be useful to be notified of any exceptions so that fixes can be added.


### License
-----------

The code is released under MIT License.


### Contact
-----------

	AAZH (aazhbd@yahoo.com)

