<?php

/* Start session */
session_start();

/* Set response type to JSON */
header("Content-Type: application/json");

/* Check if user is logged in */
if (isset($_SESSION["user"])) {

    /* Return success with user data */
    echo json_encode([
        /* Status is true */
        "status" => true,
        /* Return username */
        "user" => $_SESSION["user"],
        /* Return token */
        "token" => $_SESSION["token"]
    ]);
} else {

    /* Return error if not logged in */
    echo json_encode([
        /* Status is false */
        "status" => false,
        /* Error message */
        "message" => "No Session"
    ]);
}