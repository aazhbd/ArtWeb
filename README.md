# ArtWebApp
------------

	A Web Application framework for PHP powered by Symfony2 components.


### Installation instruction
-----------------------------

* Step 1. The copy of ArtWebApp for your use can be obtained by making a clone from github. Assuming the git is installed the following command can be used:

	```$ git clone https://github.com/aazhbd/ArtWebApp.git```

	This creates a folder named "ArtWebApp" which can be renamed to fit necessity.

* Step 2. The components for the framework has to be installed and/or updated through composer. Assuming PHP is installed in the commadline, the composer itself can be obtained by following command:

	```$ php -r "readfile('https://getcomposer.org/installer');" | php```

	While having the composer.json file obtained in the ArtWebApp folder and composer.phar is downloaded in the same directory, the following can be used to install the components:

	```$ php composer.phar install```

	This should create a vendor folder, and should automatically integrate itself with rest of the library. And the setup is ready to use. Anytime if any of the components needs to updated and/or added the following can be used:

	```$ php composer.phar update```

* Step 3. Change Configuration: There is a conf.php file that contains most common configuration values, like database credentials, paths for different folder etc., these can be changed to fit particular environment.

* Step 4. Change Routes/URLs: There is a routes.php file that contains the mapping of urls with methods. More  comma-separated key => value pairs can be added to address any number of urls.

* Step 5. Changing the browser to pointing the webroot folder should open an initial page, assuming conf.php and routes.php are as downloaded. This can be sorted by creating a virtualhost or changing apache DocumentRoot to point to webroot folder.

This is should create a clean inital setup for any Web Application software. It could be useful to be notified of any exceptions so that fixes can be added.


### Contact:
------------
	* AAZH (aazhbd@yahoo.com)

