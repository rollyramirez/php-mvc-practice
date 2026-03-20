<?php

/* Create Database class */
class Database {

    /* Create connect function */
    public static function connect() {

        /* Load config */
        $config = require __DIR__ . '/env.php';

        /* Connect to MySQL database */
        $conn = mysqli_connect(
            $config["DB_HOST"],
            $config["DB_USER"],
            $config["DB_PASS"],
            $config["DB_NAME"]
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