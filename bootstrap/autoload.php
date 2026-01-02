<?php

$prefixes = require __DIR__ . '/path.php';

spl_autoload_register(function (string $class) use ($prefixes){
foreach($prefixes as $prefix => $baseDir){
    if (!str_starts_with($class, $prefix)) {
            continue; // check if class we use has started whit namespace
        }
    $relativeClass = substr($class, strlen($prefix)); //cut to set just path in  folder
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (file_exists($file)) {
    require_once $file;
    return;
}
}
});