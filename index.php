<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

define('APP', ROOT . '' . DIRECTORY_SEPARATOR);

require './config.php';

require './application.php';
require './controllers/Controller.php';
require './models/Model.php';

$app = new Application();
