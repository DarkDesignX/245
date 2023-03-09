<?php
    require "util/database.php";

    function get_all_users() {
        global $database;

        $result = $database->query("SELECT ID, Username, Usertype FROM users;");

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

    function get_user_by_username($Username) {
        global $database;

        $result = $database->query("SELECT * FROM users WHERE Username = '$Username';");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }
    }

    function get_user_by_ID($ID) {
        global $database;

        $result = $database->query("SELECT * FROM users WHERE ID = '$ID';");

        if ($result == false) {
            error_function(500, "Error");
		} else if ($result !== true) {
			if ($result->num_rows > 0) {
                return $result->fetch_assoc();
			} else {
                error_function(404, "not Found");
            }
		} else {
            error_function(404, "not Found");
        }

        $result = $result->fetch_assoc();

	    echo json_decode($result);
    }

    function get_user_type($id) {
        global $database;
    
        $result = $database->query("SELECT Usertype FROM users WHERE id = '$id';");
    
        if ($result == false) {
            error_function(500, "Error");
        } else if ($result !== true) {
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                return $user['Usertype'];
            } else {
                error_function(404, "not Found");
            }
        } else {
            error_function(404, "not Found");
        }
    }
?>