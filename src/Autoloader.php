<?php

class Autoloader {

	static public function loader($className) {
        $fullClassName = dirname(__FILE__)."\\".$className;
        $filename = str_replace("\\", "/", $fullClassName) . ".php";
        if (file_exists($filename)) {
            require_once($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}

spl_autoload_register('Autoloader::loader');
