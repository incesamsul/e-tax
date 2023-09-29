<?php

if (!session_id()) {
    session_name('e-session');

    session_start();
}

require_once 'app/init.php';

$app = new App;
