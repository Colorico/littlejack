<?php

namespace LittleJack\Lib;

/**
 *  LittleJack Autoloading Function
 * 
 *  The LittleJack structure should be as followed :
 * 
 *  Type                Name                    File
 *  ----------------- | --------------------- | -------------------------
 *  Class             | Element               | element.class.php
 *  Abstract          | AbstractElement       | element.abstract.php
 *  Interface         | IElement              | element.interface.php
 *  Trait             | TraitElement          | element.trait.php
 *  ----------------- | --------------------- | -------------------------
 * 
 * */
function __autoload($_className) {
    $types = [];
    preg_match('/(LittleJack.*)\\(I|Abstract|Trait)?([A-Z][a-zA-Z]*)$/mg', $_className, $types);
    
    $path = 'lib' . DIRECTORY_SEPARATOR . str_replace('\\', '/', strtolower($_types[1])) . DIRECTORY_SEPARATOR;
    
    if (isset($types[2])) {
        if ($types[2] === 'I') {
            $path .= strtolower($types[3]) . DIRECTORY_SEPARATOR . '.interface.php';
        } else {
            $path .= strtolower($types[3]) . DIRECTORY_SEPARATOR . strtolower($types[2]) . '.php';
        }
    } else {
        $path .= strtolower($types[1]) . DIRECTORY_SEPARATOR . '.class.php';
    }
    
    require_once ($path);
}