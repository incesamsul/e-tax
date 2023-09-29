<?php


require_once 'config/config.php';
require_once 'orm/NotifikasiOrm.php';
spl_autoload_register(function ($class) {
    require_once 'core/' . $class . '.php';
});
