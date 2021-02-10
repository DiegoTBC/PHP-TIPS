<?php

use CoffeeCode\DataLayer\Connect;

require '../vendor/autoload.php';

$connect = Connect::getInstance();
$error = Connect::getError();

/*
 * CHECK connection/errors
 */
if ($error) {
    echo $error->getMessage();
    exit;
}