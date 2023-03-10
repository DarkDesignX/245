<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    //get all users, validate token and send a error
    $app->get("/Users", function (Request $request, Response $response, $args) {
        validate_token(); 

        $users = get_all_users();

        if ($users) {
            echo json_encode($users);
        }
        else if (is_string($users)) {
            error($users, 500);
        }
        else {
            error("The User with the ID "  . $id . " was not found.", 404);
        }

        return $response;
    });

?>