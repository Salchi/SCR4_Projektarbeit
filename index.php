<?php

spl_autoload_register(function($className) {
    // A\B\C\D -> include <ROOT>/src/A/B/C/D.php

    $file = __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($file)) {
        require_once($file);
    }
});

\MVC\MVC::handleRequest();
