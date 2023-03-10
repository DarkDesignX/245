<?php
    require "util/database.php";

    function get_room($id) {
        global $database;

        $result = $database->query("SELECT * FROM room where id = $id;");

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

	function get_rooms() {
		global $database;

		$result = $database->query("SELECT * FROM room;");

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

    function create_room($name, $description, $floor, $seats) {
        global $database;

		$existing_room = $database->query("SELECT * FROM room WHERE 'name' = '$name'")->fetch_assoc();
        if ($existing_room) {
            error_function(400, "A room with the name '$name' already exists.");
            return false;
        }

        $result = $database->query("INSERT INTO room (name,description, floor, seats) VALUES ('$name','$description', '$floor', '$seats');");

		if (!$result) {
            error_function(400, "An error occurred while creating the room.");
            return false;
        }

		return true;
    }

    function delete_room($id) {
		global $database;

		$id = intval($id);

		$result = $database->query("DELETE FROM room WHERE id = $id");
        
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