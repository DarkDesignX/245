<?php
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\ServerRequestInterface as Request;

	$app->get("/RoomReservation/{room_reservation_id}", function (Request $request, Response $response, $args) {
        
        $id = $args["room_reservation_id"];
		$room = get_room_reservation($id);

		if ($room) {
            echo json_encode($room);
		}
		else if (is_string($room)) {
			error($room, 500);
		}
		else {
			error("The room reservation with the "  . $id . " was not found.", 404);
		}

        return $response;
    });

	$app->get("/AllRoomReservations", function (Request $request, Response $response, $args) {

        $id = intval($args["room_reservation_id"]);
        $room = get_all_room_reservations();

		if ($room) {
            echo json_encode($room);
		}
		else if (is_string($room)) {
			error($room, 500);
		}
		else {
			error("The room reservation with the "  . $id . " was not found.", 404);
		}

        return $response;
    });

    $app->post("/RoomReservation", function (Request $request, Response $response, $args) {

        $request_body_string = file_get_contents("php://input");
        $request_data = json_decode($request_body_string, true);
        $room_reservation = trim($request_data["room_reservation"]);
        $room_name = trim($request_data["room_name"]);
        $name = trim($request_data["name"]);
        $time_start = trim($request_data["time_start"]);
        $time_end = trim($request_data["time_end"]);
        $comment = trim($request_data["comment"]);

        if (empty($room_reservation)) {
            error_function(400, "The (room_reservation) field must not be empty.");
        } elseif (strlen($room_reservation) > 100) {
            error_function(400, "The (room_reservation) field must be less than 100 characters.");
        }

        if (empty($room_name)) {
            error_function(400, "The (room_name) field must not be empty.");
        } elseif (strlen($room_name) > 50) {
            error_function(400, "The (room_name) field must be less than 50 characters.");
        }

        if (empty($name)) {
            error_function(400, "The (name) field must not be empty.");
        } elseif (strlen($name) > 256) {
            error_function(400, "The (name) field must be less than 256 characters.");
        }

        if (empty($time_start)) {
            error_function(400, "The (time_start) field must not be empty.");
        } elseif (strlen($time_start) > 256) {
            error_function(400, "The (time_start) field must be less than 256 characters.");
        }

        if (empty($time_end)) {
            error_function(400, "The (time_end) field must not be empty.");
        } elseif (strlen($time_end) > 256) {
            error_function(400, "The (time_end) field must be less than 256 characters.");
        }

        if (empty($comment)) {
            error_function(400, "The (comment) field must not be empty.");
        } elseif (strlen($comment) > 1000) {
            error_function(400, "The (comment) field must be less than 256 characters.");
        }
    
        if (create_room_reservation($room_number, $room_name, $name, $time_start, $time_end, $comment) === true) {
            message_function(200, "The room reservation was succsessfuly created.");
        } else {
            error_function(500, "An error occurred while saving the new reservation.");
        }
        return $response;        
    });

    $app->put("/RoomReservation/{room_reservation_id}", function (Request $request, Response $response, $args) {
		
		$id = $args["room_reservation_id"];
		
		$room = get_room_reservation($id);
		
		if (!$room) {
			error("No room reservation found for the ID " . $id . ".", 404);
		}
		
		$request_body_string = file_get_contents("php://input");
		
		$request_data = json_decode($request_body_string, true);

        if (isset($request_data["room_reservation"])) {
			$room_reservation = strip_tags(addslashes($request_data["room_reservation"]));
			if (strlen($room_reservation) > 100) {
                error_function(400, "The (room_reservation) field must be less than 100 characters.");
            }
            $room["room_reservation"] = $room_reservation;

        }

        if (isset($request_data["room_name"])) {
			$room_name = strip_tags(addslashes($request_data["room_name"]));
			if (strlen($room_name) > 256) {
                error_function(400, "The (room_name) field must be less than 256 characters.");
            }
            $room["room_name"] = $name;

        }

        if (isset($request_data["name"])) {
			$name = strip_tags(addslashes($request_data["name"]));
			if (strlen($name) > 256) {
                error_function(400, "The (name) field must be less than 256 characters.");
            }
            $room["name"] = $name;
        }

        if (isset($request_data["time_start"])) {
            $time_start = strip_tags(addslashes($request_data["time_start"]));
            if (strlen($time_start) > 1000) {
                error_funciton(400, "The (time_start) field must be less than 1000 characters.");
            }
            $room["time_start"] = $time_start;
        }

        if (isset($request_data["time_end"])) {
			$time_end = strip_tags(addslashes($request_data["time_end"]));
			if (strlen($time_end) > 1000) {
				error_funciton(400, "The (time_end) field must be less than 1000 characters.");
			}
			$room["time_end"] = $time_end;
		}

        if (isset($request_data["comment"])) {
			$comment = strip_tags(addslashes($request_data["comment"]));
			if (strlen($comment) > 1000) {
				error_funciton(400, "The (time_end) field must be less than 1000 characters.");
			}
			$room["comment"] = $comment;
		}
		
		if (update_room_reservation($id, $room["room_resrvation"], $room["room_number"], $room["room_name"], $room["name"], $room["time_start"], $room["time_end"], $room["comment"])) {
			message_function(200, "The room reservation data were successfully updated");
		}
		else {
			error_function(500, "An error occurred while saving the room reservation data.");
		}
		
		return $response;
	});

    $app->delete("/RoomReservation/{room_reservation_id}", function (Request $request, Response $response, $args) {
		
		$id = intval($args["room_reservation_id"]);
		$result = delete_room_reservation($id);
		
		if (!$result) {
			error_function(404, "No room reservation found for the ID " . $id . ".");
		}
		else {
            message_function(200, "The room reservation was succsessfuly deleted.");
        }
		return $response;
	});

?>