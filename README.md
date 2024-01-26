
# ArtWeb

ArtWeb is a fast, secure, feature rich, scalable web application framework for PHP, using Symfony2 components integrating with the best practices of MVC.

It is easy to start:

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

 - The initial setup is small but scalable. It can be used for large projects with more components easily scaling up.
 - The project can be extended by adding any number of components, installed and maintained with ```composer```.
 - More static libraries and components can be added to the projects specific static container.
 - The code and structure adhere to the proven best practices of OOP and MVC, creating highly maintainable code.
 - The operation flow and points of execution make debugging easier.
 - The Route manager is flexible and mimics functionalities of proven flexibility of development such as Django.
 - It contains a flexible and expendable Configuration manager that handles system values along with custom user values.
 - It is possible to use most popular Database management systems with it, the data manager is adaptable to any other ORM or SQL builder with any DBMS, including MySQL, PostgreSQL, SQLite etc.

<img alt="artweb" class="img-fluid" src="http://www.articulatedlogic.com/media/images/artweb.height-320.png">

### Requirements
----------------

Requires `PHP >= 8.2` or greater, `composer >= 7` or greater.


### Installation instruction
----------------------------

The repository contains appropriate docker configuration to deploy the development system.
Assuming the docker is installed and available on the command line, the following commands can be used
to deploy a running system:

```console
$ git clone https://github.com/aazhbd/ArtWeb.git && cd ArtWeb
$ docker-compose up
```

Once the installation is complete, the home page can be accessed by opening ```http://localhost:8080/```

### Components
--------------

An initial installation contains,

 - [Symfony](https://symfony.com/) components
 - [FluentPDO](https://github.com/envms/fluentpdo) is used with PDO database abstraction layer
 - [Twig](http://twig.sensiolabs.org/) is used as Template manager
 - [JQuery](https://jquery.com/) and [JQuery UI](https://jqueryui.com/) is used for front end controls including validation
 - Editor formatting with [markdown](https://simplemde.com/)


### License
-----------

The code is released under MIT License.


### Contact
-----------

Discuss the project with a [tweet](https://twitter.com/intent/tweet?hashtags=php&original_referer=http%3A%2F%2F127.0.0.1%3A91%2F&text=Check%20out%20ArtWeb%20MVC%20Framework!&tw_p=tweetbutton&url=http%3A%2F%2Fgithub.com%2Faazhbd%2FArtWeb&via=aazhbd) or share on [Facebook](https://www.facebook.com/sharer.php?u=https%3A%2F%2Fgithub.com%2Faazhbd%2FArtWeb).

> **Abdullah Al Zakir Hossain**

- Email:   <aazhbd@yahoo.com>
- Profile:   <https://de.linkedin.com/in/aazhbd>
