<?php
    require "util/database.php";

    function get_parking_reservation($id) {
        global $database;

        $result = $database->query("SELECT * FROM parking_reservations where parking_reservation_id = $id;");

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

	function get_all_parking_reservations() {
		global $database;

        $result = $database->query("SELECT * FROM parking_reservations;");

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

    function create_parking_reservation($parking_reservation, $parking_number, $name, $time_start, $time_end, $comment) {
        global $database;

        $result = $database->query("INSERT INTO parking_reservations (parking_reservation, parking_number, name, time_start, time_end, comment) VALUES ('$parking_reservation','$parking_number','$name', '$time_start', '$time_end', '$comment');");

        if (!$result) {
            error_function(400, "An error occurred while creating the parking reservation.");
            return false;
        }

        // Reservation created successfully, generate ICS file and send confirmation email to user
        $to = "morhaf.alnhlawe@gmail.com";
        $subject = "Parking Reservation Confirmation";
        $message = $message = "Sehr geehrte Damen und Herren
        \n\nDas Parkplatz $parking_number ist durch $name reserviert.
        \nVon: $time_start\nBis: $time_end
        \n\nFreundliche Gruesse
        \nBDM Reservations Team";
        $headers = "From: morhaf.alnhlawe@gmail.com";
        $filename = "parking_reservation.ics";
        $uid = uniqid();
    
        $ics_content = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Our Company//NONSGML Event Calendar//EN
BEGIN:VEVENT
UID:" . $uid . "
DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z
DTSTART:$time_start
DTEND:$time_end
SUMMARY:Parking Reservation
DESCRIPTION:$comment
LOCATION:Parking spot #$parking_number
END:VEVENT
END:VCALENDAR";
            
                $attachment = chunk_split(base64_encode($ics_content));
            
                $headers .= "\nMIME-Version: 1.0\nContent-Type: multipart/mixed;\n boundary=\"mixed-".md5($filename)."\"";
                $message = "--mixed-".md5($filename)."\nContent-Type: multipart/alternative;\n boundary=\"alt-".md5($filename)."\"\n\n--alt-".md5($filename)."\nContent-Type: text/plain; charset=\"iso-8859-1\"\nContent-Transfer-Encoding: 7bit\n\n".$message."\n\n--alt-".md5($filename)."--\n\n--mixed-".md5($filename)."\nContent-Type: text/calendar; name=\"$filename\"\nContent-Transfer-Encoding: base64\nContent-Disposition: attachment;\n filename=\"$filename\"\n\n$attachment\n\n--mixed-".md5($filename)."--";
            
                if (!mail($to, $subject, $message, $headers)) {
                    error_function(500, "An error occurred while sending the confirmation email.");
                    return false;
                }

		return true;
    }

    function update_parking_reservation($id, $parking_reservation, $parking_number, $name, $time_start, $time_end, $comment) {
		global $database;

		$result = $database->query("UPDATE parking_reservations SET parking_reservation = '$parking_reservation', parking_number = '$parking_number', name = '$name', time_start = '$time_start', time_end = '$time_end', comment = '$comment' WHERE parking_reservation_id = '$id';");

		if (!$result) {
			return false;
		}
		
		return true;
	}

    function delete_parking_reservation($id) {
		global $database;

		$id = intval($id);

		$result = $database->query("DELETE FROM parking_reservations WHERE parking_reservation_id = $id");
        
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

    function get_room_reservation($id) {
        global $database;

        $result = $database->query("SELECT * FROM room_reservations where room_reservation_id = $id;");

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

	function get_all_room_reservations() {
		global $database;

        $result = $database->query("SELECT * FROM room_reservations;");

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

    function create_room_reservation($room_reservation, $room_name, $name, $time_start, $time_end, $comment) {
        global $database;

        $result = $database->query("INSERT INTO room_reservations (room_reservation, room_name, name, time_start, time_end, comment) VALUES ('$room_reservation','$room_name', '$name', '$time_start', '$time_end', '$comment');");

        if (!$result) {
            error_function(400, "An error occurred while creating the room reservation.");
            return false;
        }

        // Reservation created successfully, generate ICS file and send confirmation email to user
        $to = "morhaf.alnhlawe@gmail.com";
        $subject = "Room Reservation Confirmation";
        $message = "Sehr geehrte Damen und Herren
        \n\nDas Zimmer $room_name ist durch $name reserviert.
        \nVon: $time_start
        \nBis: $time_end
        \n\nFreundliche Gruesse
        \nBDM Reservations Team";
        $headers = "From: morhaf.alnhlawe@gmail,com";
        $filename = "room_reservation.ics";
        
        $ics_content = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Our Company//NONSGML Event Calendar//EN
BEGIN:VEVENT
UID:" . uniqid() . "@yourdomain.com
DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z
DTSTART:$time_start
DTEND:$time_end
SUMMARY:Room Reservation
DESCRIPTION:$comment
LOCATION:$room_name
END:VEVENT
END:VCALENDAR";
            
                $attachment = chunk_split(base64_encode($ics_content));
            
                $headers .= "\nMIME-Version: 1.0\nContent-Type: multipart/mixed;\n boundary=\"mixed-".md5($filename)."\"";
                $message = "--mixed-".md5($filename)."\nContent-Type: multipart/alternative;\n boundary=\"alt-".md5($filename)."\"\n\n--alt-".md5($filename)."\nContent-Type: text/plain; charset=\"iso-8859-1\"\nContent-Transfer-Encoding: 7bit\n\n".$message."\n\n--alt-".md5($filename)."--\n\n--mixed-".md5($filename)."\nContent-Type: text/calendar; name=\"$filename\"\nContent-Transfer-Encoding: base64\nContent-Disposition: attachment;\n filename=\"$filename\"\n\n$attachment\n\n--mixed-".md5($filename)."--";
            
                if (!mail($to, $subject, $message, $headers)) {
                    error_function(500, "An error occurred while sending the confirmation email.");
                    return false;
                }
                    
		return true;
    }

    function update_room_reservation($id, $room_reservation, $room_name, $name, $time_start, $time_end, $comment){
		global $database;

		$result = $database->query("UPDATE room_reservations SET room_reservation = '$room_reservation', room_name = '$room_name', name = '$name', time_start = '$time_start', time_end = '$time_end', comment = '$comment' WHERE room_reservation_id = '$id';");

		if (!$result) {
			return false;
		}
		
		return true;
	}

    function delete_room_reservation($id) {
		global $database;

		$id = intval($id);

		$result = $database->query("DELETE FROM room_reservations WHERE room_reservation_id = $id");
        
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