<?php
class db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:host=sdickerson.ddns.net;port=1338;dbname=SS', 'root', 'qPD1&Lm4QOoMrPy%eD!4q^ob', $pdo_options);
        }
        return self::$instance;
    }
}