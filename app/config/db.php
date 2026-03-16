<?php

/* Create Database class */
class Database {

    /* Create connect function */
    public static function connect() {

        /* Connect to MySQL database */
        $conn = mysqli_connect(
            "localhost", // Server name
            "root",      // Username
            "",          // Password
            "php_backend_practice" // Database name
        );

        /* Check if connection failed */
        if (!$conn) {
            /* Stop program and show error */
            die("DB connection failed");
        }

        /* Return connection */
        return $conn;
    }

}