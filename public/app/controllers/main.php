<?php

if (!isset($_SERVER['PHP_AUTH_USER'])) {

    header("Location: http://localhost/views/welcome.php");

    exit();
}

include ('app/views/navigation.html');
