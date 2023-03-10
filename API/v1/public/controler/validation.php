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
    
?>