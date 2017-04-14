<?php

# Graham L.:
# Error reporting would obviously be disabled if this project were ever
# in an actual production setting but we probably don't need to touch it.
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

define('DB_TYPE', 'mysql');
define('DB_HOST', 'sdickerson.ddns.net');
define('DB_PORT', '1338');
define('DB_NAME', 'SS');
define('DB_USER', 'root');
define('DB_PASS', 'qPD1&Lm4QOoMrPy%eD!4q^ob');
define('DB_CHARSET', 'utf8');
