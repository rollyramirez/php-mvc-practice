<?php

/* Load User model */
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../helpers/Response.php";

/* Create AuthController class */
class AuthController {

    /* Login function */
    public static function login() {

        /* Check if username or password is missing */
        if (
            !isset($_POST["username"]) ||
            !isset($_POST["password"]) 
        ) {

            /* Send error JSON response */
            Response::json(false, "Missing data", null, 400);
        }

        /* Get and clean username */
        $username = trim($_POST["username"]);

        /* Get and clean password */
        $password = trim($_POST["password"]);

        /* Call login function from User model */
        $login = User::login($username, $password);

        /* If login is successful */
        if ($login) {

            /* Save username in session */
            $_SESSION["user"] = $username;

            /* Send success JSON response */
            Response::json(false, "Login success", null, 200);

        } else {

            /* Send error JSON response */
            Response::json(false, "Invalid login", null, 400);

        }

    }

    /* Function to register a user */
    public static function register() {

        /* Try to run code */
        try {

         /* Check if username or password is missing */
        if (
            /* Username not set */
            !isset($_POST["username"]) ||
            /* Password not set */
            !isset($_POST["password"]) ||
            /* Email not set */
            !isset($_POST["email"])
        ) {

             /* Send error JSON response */
            Response::json(false, "Missing data", null, 400);
        }

        /* Get username (remove spaces) */
        $username = trim($_POST["username"]);

        /* Get password (remove spaces) */
        $password = trim($_POST["password"]);

        /* Get email (remove spaces) */
        $email = trim($_POST["email"]);

        /* Check if inputs are empty */
        if ($username == "" || $password == "" || $email == "") {

            /* Send error JSON response */
            Response::json(false, "Empty input", null, 400);

        }

        /**** Start - Validation ****/

        /* Check username length */
        if (strlen($username) < 3) {

            /* Send error JSON response */
            Response::json(false, "Username too short", null, 400);
        }

        /* Check password length */
        if (strlen($password) < 4) {

            /* Send error JSON response */
            Response::json(false, "Username too long", null, 400);
          
        }
        
        /* Check if email is valid */
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            /* Send error JSON response */
            Response::json(false, "Invalid email", null, 400);

        }

        /**** End - Validation ****/
        
        /* Save user */
        User::register($username, $password, $email);

         /* Send error JSON response */
            Response::json(false, "User registered", null, 200);

        /* Catch errors if something fails */
        } catch (Exception $e) {
             /* Send server error response */
            Response::error("Server error", 500);
        }

    }
    
    /* Login user and return token */
    public static function loginToken() {

            /* Try to run code */
            try {

            /* Check if username or password is missing */
            if (
                /* Username not set */
                !isset($_POST["username"]) ||
                /* Password not set */
                !isset($_POST["password"])
            ) {

                /* Send error JSON response */
                Response::json(false, "Invalid email", null, 400);

            }

            /* Get username */
            $username = $_POST["username"];

            /* Get password */
            $password = $_POST["password"];

            /* Call loginWithToken function */
            $data = User::loginWithToken($username, $password);

            /* Check if login successful */
            if ($data) {

                /* Save username, token and role in session */
                $_SESSION["user"] = $username;
                $_SESSION["token"] = $data["token"];
                $_SESSION["role"] = $data["role"];

                /* Send sucess JSON response */
                Response::json(
                    true,
                    "Login success",
                    $data,
                    200
                );

            } else {

                /* Send error JSON response */
                Response::json(
                    false,
                    "Invalid login",
                    null, 
                    401);
            }

            /* Catch errors if something fails */
            } catch (Exception $e) { 
                    /* Send server error response */
                    Response::error("Server error", 500);
            }
    }
}