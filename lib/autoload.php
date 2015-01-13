<?php

namespace LittleJack\Lib;

function __autoload($_className) {
    $path = 'lib' . DIRECTORY_SEPARATOR . str_replace('\\', '/', strtolower($_className));
    
    $types = [];
    preg_match('/\\(I|Abstract|Trait)[A-Z][a-zA-Z]*/g', $_className, $types);
    
    if ($types[1] === 'I') {
        $path .= '.interface.php';
    } elseif ($types[1] === 'Abstract') {
        $path .= '.abstract.php';
    } elseif ($types[1] === 'Trait') {
        $path .= '.trait.php';
    } else {
        $path .= '.class.php';
    }
    
    require_once ($path);
}