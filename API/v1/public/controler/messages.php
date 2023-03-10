<?php
    function error_function($status_code, $message) {
        $array = array("Error:" => $message);
        echo json_encode($array, true);
        http_response_code($status_code);
        die();
    }

    function message_function($status_code, $message) {
        $array = array("Message:" => $message);
        echo json_encode($array, true);
        http_response_code($status_code);
        die();
    }
?>