<?php
abstract class Enum {
    private static $constCacheArray = NULL;

    public static function getConstants() {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }

        $calledClass = get_called_class();

        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }

    public static function isValid($str) {
        $constants = self::getConstants();
        
        $retval = "";

        foreach($constants as $key => $value) {
            if (strtolower($key) == strtolower($str)) {
                $retval = $value;
            } 
        }
    
        return $retval;
    }
}
