<?php

/* Define Response class */
class Response {

     /* Function to return JSON response */
    public static function json($status, $message, $data = null, $code = 200) {

        /* Set HTTP status code */
        http_response_code($code);

        /* Set response type to JSON */
        header("Content-Type: application/json");

        /* Output JSON data */
        echo json_encode([
            /* Status value */
            "status" => $status,
            /* Message text */
            "message" => $message,
            /* Extra data */
            "data" => $data
        ]);

        /* Stop script */
        exit;
    }

    /* Function to send error response */
    public static function error($message = "Server error", $code = 500) {

        /* Set HTTP status code */
        http_response_code($code);

        /* Set response type to JSON */
        header("Content-Type: application/json");

        /* Output JSON data */
        echo json_encode([
            /* Error status */
            "status" => "false",
            /* Error message */
            "message" => $message
        ]);

        /* Stop script */
        exit;
    }
}