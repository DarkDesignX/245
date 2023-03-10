<?php
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\ServerRequestInterface as Request;

    //get parkings by id or send a error
	$app->get("/Parking/{id}", function (Request $request, Response $response, $args) {
		$id = $args["id"];
		$parking = get_parking($id);

		if ($parking) {
            echo json_encode($parking);
		}
		else if (is_string($parking)) {
			error($parking, 500);
		}
		else {
			error("The parking with the "  . $id . " was not found.", 404);
		}

        return $response;
    });

    //get parkings or send a error
	$app->get("/Parkings", function (Request $request, Response $response, $args) {

        $parking = get_parkings();

        if ($parking) {
            echo json_encode($parking);
        }
        else if (is_string($parking)) {
            error($parking, 500);
        }
        else {
            error("There are no Parkings.", 404);
        }

        return $response;
    });

    //create or update room
    $app->post("/Parking", function (Request $request, Response $response, $args) {
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);
        $position = trim($request_data["position"]);
    
        //error by empty position
        if (empty($position)) {
            error_function(400, "The (position) field must not be empty.");
        } elseif (!ctype_digit($position)) {
            error_function(400, "The (position) field must contain only numbers.");
        } elseif (strlen($position) > 11) {
            error_function(400, "The (position) field must be less than 11 characters.");
        }
  
        //message by successfully creating of parking
        if (create_parking($position) === true) {
            message_function(200, "The parking was succsessfuly created.");
        } else {
            error_function(500, "An error occurred while saving the parking.");
        }
        return $response;        
    });

    //delete parking by id and validate token
    $app->delete("/Parking/{id}", function (Request $request, Response $response, $args) {
        validate_token();
		
		$id = intval($args["id"]);
		$result = delete_parking($id);
		
        //error or success message
		if (!$result) {
			error_function(404, "No parking found for the ID " . $id . ".");
		}
		else {
            message_function(200, "The parking was succsessfuly deleted.");
        }
		return $response;
	});

?>