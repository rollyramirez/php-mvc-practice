<?php

/* Set response type to JSON */
header("Content-type: application/json");

/* Include User model */
require_once __DIR__ . "/../models/User.php";

/* Check if token is missing */
if (!isset($_GET["token"])) {

    /* Return error response */
    echo json_encode([

        /* Status failed */
        "status" => false,
        /* Error message */
        "message" => "Token required"
    ]);

    /* Stop script */
    exit;
}

/* Get token from URL */
$token = $_GET["token"];

/* Get user using token */
$user = User::getUserByToken($token);

/* Check if user not found */
if (!$user) {

     /* Return invalid token error */
    echo json_encode([

        /* Status failed */
        "status" => false,
        /* Error message */
        "message" => "Invalid token"
    ]);

    /* Stop script */
    exit;
}

    /* Return success with username */
    echo json_encode([

        /* Status success */
        "status" => true,
        /* Return username */
        "user" => $user["username"]
]);

