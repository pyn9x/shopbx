<?php

require "../App/autoload.php";
require '../App/routes.php';

$response = App\Lib\Application::run();
$response->flush();


