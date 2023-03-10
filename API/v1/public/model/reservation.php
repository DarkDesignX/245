<?php
    //connect with database.php
    require "util/database.php";

    //function to get parking reservations by id
    function get_parking_reservation($id) {
        global $database;

        $result = $database->query("SELECT * FROM parking_reservations where parking_reservation_id = $id;");

        //errors
        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                $result_array = array();
				while ($user = $result->fetch_assoc()) {
                    $result_array[] = $user;
                }
                return $result_array;
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }

    }

    //function to get all parking reservations
	function get_all_parking_reservations() {
		global $database;

        $result = $database->query("SELECT * FROM parking_reservations;");

        //errors
        if ($result == false) {
            error_function(500, "Error");
        } else if ($result !== true) {
            if ($result->num_rows > 0) {
                $result_array = array();
                while ($parking = $result->fetch_assoc()) {
                    $result_array[] = $parking;
                }
                return $result_array;
            } else {
                error_function(404, "not Found");
            }
        } else {
            error_function(404, "not Found");
        }
    }

    //function to create parking reservations
    function create_parking_reservation($parking_number, $name, $time_start, $time_end) {
        global $database;

        $result = $database->query("INSERT INTO parking_reservations (parking_number,name, time_start, time_end) VALUES ('$parking_number','$name', '$time_start', '$time_end');");

        //error
        if (!$result) {
            error_function(400, "An error occurred while creating the parking reservation.");
            return false;
        }

		return true;
    }

    //function to update parking reservations
    function update_parking_reservation($id, $parking_number, $name, $time_start, $time_end) {
		global $database;

		$result = $database->query("UPDATE parking_reservations SET parking_number = '$parking_number', name = '$name', time_start = '$time_start', time_end = '$time_end' WHERE parking_reservation_id = '$id';");

		if (!$result) {
			return false;
		}
		
		return true;
	}

    //function to delet parking reservations by id
    function delete_parking_reservation($id) {
		global $database;

		$id = intval($id);

		$result = $database->query("DELETE FROM parking_reservations WHERE parking_reservation_id = $id");
        
        //errors
		if (!$result) {
			return false;
		}
		else if ($database->affected_rows == 0) {
			return null;
		}
		else {
			return true;
		}
	}

    //function to get room reservations by id
    function get_room_reservation($id) {
        global $database;

        $result = $database->query("SELECT * FROM room_reservations where room_reservation_id = $id;");

        //errors
        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                $result_array = array();
				while ($user = $result->fetch_assoc()) {
                    $result_array[] = $user;
                }
                return $result_array;
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }

    }

    //function to get all room reservations
	function get_all_room_reservations() {
		global $database;

        $result = $database->query("SELECT * FROM room_reservations;");

        //errors
        if ($result == false) {
            error_function(500, "Error");
        } else if ($result !== true) {
            if ($result->num_rows > 0) {
                $result_array = array();
                while ($room = $result->fetch_assoc()) {
                    $result_array[] = $room;
                }
                return $result_array;
            } else {
                error_function(404, "not Found");
            }
        } else {
            error_function(404, "not Found");
        }
    }

    //function to create room reservations
    function create_room_reservation($room_number, $room_name, $name, $time_start, $time_end) {
        global $database;

        $result = $database->query("INSERT INTO room_reservations (room_number,room_name, name, time_start, time_end) VALUES ('$room_number','$room_name', '$name', '$time_start', '$time_end');");

        //error
        if (!$result) {
            error_function(400, "An error occurred while creating the room reservation.");
            return false;
        }

		return true;
    }

    //function to update room reservations
    function update_room_reservation($id, $room_number, $room_name, $name, $time_start, $time_end){
		global $database;

		$result = $database->query("UPDATE room_reservations SET room_number = '$room_number', room_name = '$room_name', name = '$name', time_start = '$time_start', time_end = '$time_end' WHERE room_reservation_id = '$id';");

        //error
		if (!$result) {
			return false;
		}
		
		return true;
	}

    //function to delet room reservations by id
    function delete_room_reservation($id) {
		global $database;

		$id = intval($id);

		$result = $database->query("DELETE FROM room_reservations WHERE room_reservation_id = $id");
        
        //errors
    
		if (!$result) {
			return false;
		}
		else if ($database->affected_rows == 0) {
			return null;
		}
		else {
			return true;
		}
	}

?>