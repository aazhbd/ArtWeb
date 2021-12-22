
# ArtWeb

ArtWeb is a fast, secure, feature rich, scalable web application framework for PHP, using Symfony2 components integrating with the best practices of MVC.

It's easy to start:

```php
<?php

require_once('../ArtLibs/Application.php');

use ArtLibs\Controller;

$app = new \ArtLibs\Application();

class test extends Controller {
    function viewTest($params, $app) {
        $app->setTemplateData(array('body_content' => 'Hello World'));
        $this->display($app, 'home.twig');
    }
}

$app->getRouteManager()->dispatchUrl(
	array('/test' => './test/viewTest')
);

```

### Features
------------

 - The initial setup is very small but scalable. It can be used for very large project with more components easily.
 - The project can be extended by adding any number of components, installed and maintained with ```composer```.
 - More static libraries and components can be added in project specific static container.
 - The code and structure adheres to the proven best practices of OOP and MVC, creating highly maintainable code.
 - The operation flow and points of execution makes debugging easier.
 - The Route manager is flexible and mimics functionalities of proven flexibility of development such as Django.
 - It contains a flexible and expendable Configuration manager that handles system values along with custom user values.
 - The datamanager is adaptable to any other ORM or SQL builder with any DBMS, including MySQL, PostgreSQL, SQLite etc.

<img alt="artweb" class="img-fluid" src="/media/images/artweb.height-320.png">

### Requirements
----------------

Requires `PHP 5.3` or greater, `composer 1.2` or greater.


### Installation instruction
----------------------------

The following steps are applicable in both Windows and Linux (*nix) platforms, while git, php etc., are installed and accessible in command line.

* Step 1. The copy of ArtWeb for your use can be obtained by making a clone from github. Assuming the git is installed the following command can be used:

	```
	$ git clone https://github.com/aazhbd/ArtWeb.git
	```

	This creates a folder named "ArtWeb" which can be renamed to fit necessity.

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


### Components
--------------

An initial installation contains,

 - [Symfony](https://symfony.com/) 3 components
 - [FluentPDO](https://github.com/envms/fluentpdo) is used with PDO database abstraction layer
 - [Twig](http://twig.sensiolabs.org/) is used as Template manager
 - [JQuery](https://jquery.com/) and [JQuery UI](https://jqueryui.com/) is used for front end controls including validation
 - Editor formatting with [markdown](https://simplemde.com/)


### License
-----------

The code is released under MIT License.


### Contact
-----------

Discuss about the project with a [tweet](https://twitter.com/intent/tweet?hashtags=php&original_referer=http%3A%2F%2F127.0.0.1%3A91%2F&text=Check%20out%20ArtWeb%20MVC%20Framework!&tw_p=tweetbutton&url=http%3A%2F%2Fgithub.com%2Faazhbd%2FArtWeb&via=aazhbd) or share on [Facebook](https://www.facebook.com/sharer.php?u=https%3A%2F%2Fgithub.com%2Faazhbd%2FArtWeb).

> **Abdullah Al Zakir Hossain**

- Email:   <aazhbd@yahoo.com>
- Profile:   <https://de.linkedin.com/in/aazhbd>
