<?php
    require "util/database.php";

    function get_parking($id) {
        global $database;

        $result = $database->query("SELECT * FROM parking where id = $id;");

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

	function get_parkings() {
		global $database;

		$result = $database->query("SELECT * FROM parking;");

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

    function create_parking($position) {
        global $database;

        $existing_parking = $database->query("SELECT * FROM parking WHERE 'position' = '$position'")->fetch_assoc();
        if ($existing_parking) {
            error_function(400, "A parking with the position '$position' already exists.");
            return false;
        }

        $result = $database->query("INSERT INTO parking (position) VALUES ('$position');");

		if (!$result) {
            error_function(400, "An error occurred while creating the parking.");
            return false;
        }

		return true;
    }

    function delete_parking($id) {
		global $database;

		$id = intval($id);

		$result = $database->query("DELETE FROM parking WHERE id = $id");
        
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