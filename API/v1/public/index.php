<?php

    function customError($errno, $errstr) {
        echo " ";
    }
    
    set_error_handler("customError");

    use Psr\Http\Message\ResponseInterface as Response; 
    use Psr\Http\Message\ServerRequestInterface as Request;

    use Slim\Factory\AppFactory;
    use ReallySimpletoken\Token;
 
    //connect with controller and modell documents
    require __DIR__ . "/../vendor/autoload.php";
    require_once "controler/validation.php";
    require "model/users.php";
	require "model/room.php";
    require "model/parking.php";
    require "model/reservation.php";
    require_once "controler/messages.php";

    header("Content-Type: application/json");

    $app = AppFactory::create();

    $app->setBasePath("/API/v1");

    //login funktion
    $app->post("/Login", function (Request $request, Response $response, $args) {

        $body_content = file_get_contents("php://input");
        $JSON_data = json_decode($body_content, true);

        if (isset($JSON_data["username"]) && isset($JSON_data["password"])) {
        } else {
            error_function(400, "Empty request");
        }

        $username = validate_string($JSON_data["username"]);
        $password = validate_string($JSON_data["password"]);

        //errors
        if (!$password) {
            error_function(400, "password is invalid");
        }
        if (!$username) {
            error_function(400, "username is invalid");
        }
            
        $password = hash("sha256", $password);

        $user = get_user_by_username($username);

        if ($user["Password"] !==  $password) {
            error_function(404, "'$password' + '$username' is not found");   
        }

        $token = create_token($username, $password, $user["ID"]);

        setcookie("token", $token, time() + 3600);

        //successfully massage
        message_function(200, "Successfully logged in and Token created. Time: 1h");

        return $response;
    });

    //user validation
    function user_validation($required_type = null) {
        $current_user_id = validate_token();
        $current_user_type = get_user_type($current_user_id);

        if ($required_type !== null && $current_user_type !== $required_type) {
            error_function(403, "Unauthenticated");
        }
        return $current_user;
    }
    
    //connect with routes documents
    require "controler/routes/users.php";
    require "controler/routes/parking_reservations.php";
    require "controler/routes/room_reservations.php";
    require "controler/routes/room.php";
    require "controler/routes/parking.php";

    //run the app
    $app->run();
?>