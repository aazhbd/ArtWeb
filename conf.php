<?php

$conf = array(
    'production' => array(
        'db_name' => 'prod_db',
        'development_mode' => false
    ),
    'development' => array(
        'db_name' => 'dbname',
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => '123',
        'development_mode' => true
    ),
    'staging' => array(
        'db_name' => 'dev_db',
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => '1234',
        'development_mode' => true
    )
);

return $conf['development'];

