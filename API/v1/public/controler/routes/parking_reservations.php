<?php
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\ServerRequestInterface as Request;

	$app->get("/ParkingReservation/{parking_reservation_id}", function (Request $request, Response $response, $args) {
        validate_token(); 

        $id = $args["parking_reservation_id"];
		$parking = get_parking_reservation($id);

		if ($parking) {
            echo json_encode($parking);
		}
		else if (is_string($parking)) {
			error($parking, 500);
		}
		else {
			error("The parking reservation with the "  . $id . " was not found.", 404);
		}

        return $response;
    });

	$app->get("/AllParkingReservations", function (Request $request, Response $response, $args) {
        validate_token(); 

        $id = intval($args["parking_reservation_id"]);
        $parking = get_all_parking_reservations();

		if ($parking) {
            echo json_encode($parking);
		}
		else if (is_string($parking)) {
			error($parking, 500);
		}
		else {
			error("The parking reservation with the "  . $id . " was not found.", 404);
		}

        return $response;
    });

    $app->post("/ParkingReservation", function (Request $request, Response $response, $args) {
        validate_token();

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);
        $parking_number = trim($request_data["parking_number"]);
        $name = trim($request_data["name"]);
        $time_start = trim($request_data["time_start"]);
        $time_end = trim($request_data["time_end"]);
    
        if (empty($parking_number)) {
            error_function(400, "The (parking_number) field must not be empty.");
        } elseif (!ctype_digit($parking_number)) {
            error_function(400, "The (parking_number) field must contain only numbers.");
        } elseif (strlen($parking_number) > 11) {
            error_function(400, "The (parking_number) field must be less than 11 characters.");
        }

        if (empty($name)) {
            error_function(400, "The (name) field must not be empty.");
        } elseif (strlen($name) > 256) {
            error_function(400, "The (name) field must be less than 256 characters.");
        }

        if (empty($time_start)) {
            error_function(400, "The (time_start) field must not be empty.");
        } elseif (strlen($name) > 256) {
            error_function(400, "The (time_start) field must be less than 256 characters.");
        }

        if (empty($time_end)) {
            error_function(400, "The (time_end) field must not be empty.");
        } elseif (strlen($time_end) > 256) {
            error_function(400, "The (time_end) field must be less than 256 characters.");
        }
    
        if (create_parking_reservation($parking_number, $name, $time_start, $time_end) === true) {
            message_function(200, "The parking reservation was succsessfuly created.");
        } else {
            error_function(500, "An error occurred while saving the new reservation.");
        }
        return $response;        
    });

    $app->put("/ParkingReservation/{parking_reservation_id}", function (Request $request, Response $response, $args) {

        validate_token();
		
		$id = $args["parking_reservation_id"];
		
		$parking = get_parking_reservation($id);
		
		if (!$parking) {
			error(404, "No parking reservation found for the ID " . $id . ".");
		}
		
		$request_body_string = file_get_contents("php://input");
		
		$request_data = json_decode($request_body_string, true);

        if (isset($request_data["parking_number"])) {
			$parking_number = strip_tags(addslashes($request_data["parking_number"]));
            if (strlen($parking_number) > 11) {
				error_function(400, "The (parking_number) field must be less than 11 characters.");
			}
			$parking["parking_number"] = $parking_number;
		}

        if (isset($request_data["name"])) {
			$name = strip_tags(addslashes($request_data["name"]));
			if (strlen($name) > 256) {
                error_function(400, "The (name) field must be less than 256 characters.");
            }
            $parking["name"] = $name;
        }

        if (isset($request_data["time_start"])) {
            $time_start = strip_tags(addslashes($request_data["time_start"]));
            if (strlen($time_start) > 1000) {
                error_funciton(400, "The (time_start) field must be less than 1000 characters.");
            }
            $parking["time_start"] = $time_start;
        }

        if (isset($request_data["time_end"])) {
			$time_end = strip_tags(addslashes($request_data["time_end"]));
			if (strlen($time_end) > 1000) {
				error_funciton(400, "The (time_end) field must be less than 1000 characters.");
			}
			$parking["time_end"] = $time_end;
		}
		
		if (update_parking_reservation($id, $parking["parking_number"], $parking["name"], $parking["time_start"], $parking["time_end"])) {
			message_function(200, "The parking reservation data were successfully updated");
		}
		else {
			error_function(500, "An error occurred while saving the parking reservation data.");
		}
		
		return $response;

	});

    $app->delete("/ParkingReservation/{parking_reservation_id}", function (Request $request, Response $response, $args) {
        validate_token();
		
		$id = intval($args["parking_reservation_id"]);
		$result = delete_parking_reservation($id);
		
		if (!$result) {
			error_function(404, "No parking reservation found for the ID " . $id . ".");
		}
		else {
            message_function(200, "The parking reservation was succsessfuly deleted.");
        }
		return $response;
	});

?>