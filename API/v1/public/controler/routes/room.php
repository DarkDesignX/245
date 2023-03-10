<?php
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\ServerRequestInterface as Request;

	$app->get("/Room/{id}", function (Request $request, Response $response, $args) {
		$id = $args["id"];
		$room = get_room($id);

		if ($room) {
            echo json_encode($room);
		}
		else if (is_string($room)) {
			error($room, 500);
		}
		else {
			error("The ID "  . $id . " was not found.", 404);
		}

        return $response;
    });

	$app->get("/Rooms", function (Request $request, Response $response, $args) {

        $room = get_rooms();

        if ($room) {
            echo json_encode($room);
        }
        else if (is_string($room)) {
            error($room, 500);
        }
        else {
            error("There are no Rooms.", 404);
        }

        return $response;
    });

	$app->post("/Room", function (Request $request, Response $response, $args) {
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);
        $name = trim($request_data["name"]);
        $description = trim($request_data["description"]);
        $floor = trim($request_data["floor"]);
        $seats = trim($request_data["seats"]);
    
        if (empty($name)) {
            error_function(400, "The (name) field must not be empty.");
        } elseif (strlen($name) > 50) {
            error_function(400, "The (name) field must be less than 50 characters.");
        }
    
        if (empty($description)) {
            error_function(400, "The (description) field must not be empty.");
        } elseif (strlen($description) > 1000) {
            error_function(400, "The (description) field must be less than 1000 characters.");
        }
    
        if (empty($floor)) {
            error_function(400, "The (floor) field must not be empty.");
        } elseif (strlen($floor) > 10) {
            error_function(400, "The (floor) field must be less than 10 characters.");
        }

        if (empty($seats)) {
            error_function(400, "The (seats) field must not be empty.");
        } elseif (strlen($seats) > 1000) {
            error_function(400, "The (seats) field must be less than 1000 characters.");
        }
    
        if (create_room($name, $description, $floor, $seats) === true) {
            message_function(200, "The room was succsessfuly created.");
        } else {
            error_function(500, "An error occurred while saving the new room.");
        }
        return $response;        
    });

	$app->delete("/Room/{id}", function (Request $request, Response $response, $args) {
		
        validate_token();
		
		$id = intval($args["id"]);
		
		$result = delete_room($id);
		
		if (!$result) {
			error_function(404, "No room found for the ID " . $id . ".");
		}
		else {
            message_function(200, "The room was succsessfuly deleted.");
		}
		
		return $response;
	});
	
?>