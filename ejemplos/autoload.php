<?php

function carga($class)
{
    $file = __DIR__ . "/{$class}.php";
    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('carga');

function imp($string){
    echo $string . '<br/>' . PHP_EOL;
}
