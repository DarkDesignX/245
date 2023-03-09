<?php
    function validate_string($_string) {
        $_string = addslashes($_string);
        $_string = strip_tags($_string);
        if (!(isset($_string) && !(strlen($_string) < 1) && !(empty($_string)))) {
            return false;
        }
        return $_string;
    }

    function validate_number($_integer) {
        $_integer = intval($_integer);
        return $_integer;
    }

    function validate_float($_float) {
        $_float = floatval($_float);
        return $_float;
    }
    
    require_once "controler/secret.php";

    function create_token($username, $password_hash, $id) {
        global $secret;
        $token = $username . $secret . $password_hash;
        $token = hash("sha256", $token);
        $token = $token . "[tr]" . $id;
        return $token;
    }

    function validate_token($token = false) {

        $the_set_token = validate_string($_COOKIE["token"]);
        
        if ($the_set_token === false) {
            error_function(403, "no token");
        }

        $token_exploded = explode("[tr]", $the_set_token);

        $user = get_user_by_id($token_exploded[1]); 

        $user_token = create_token($user["Username"], $user["Password"], $token_exploded[1]);


        if ($user_token === $the_set_token) {
            return $token_exploded[1];
        }
        error_function(403, "Authentication failed");
    }
?>