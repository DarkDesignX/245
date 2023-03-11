<?php

    function customError($errno, $errstr) {
        echo " ";
    }
    
    set_error_handler("customError");

    use Psr\Http\Message\ResponseInterface as Response; 
    use Psr\Http\Message\ServerRequestInterface as Request;

    use Slim\Factory\AppFactory;
    use ReallySimpletoken\Token;

    require __DIR__ . "/../vendor/autoload.php";
    require_once "controler/validation.php";
    require "model/users.php";
	require "model/room.php";
    require "model/parking.php";
    require "model/reservation.php";
    require_once "controler/messages.php";

    header("Content-Type: application/json");

    $app = AppFactory::create();

    $app->setBasePath("/admin/API/v1");

    require "controler/routes/users.php";
    require "controler/routes/parking_reservations.php";
    require "controler/routes/room_reservations.php";
    require "controler/routes/room.php";
    require "controler/routes/parking.php";

    $app->run();
?>