<?php

/* Load database configuration */
require_once __DIR__ . "/../config/db.php";

/* Create User class */
class User {

    /* Login function */
    public static function login($username, $password) {

        /* Connect to database */
        $conn = Database::connect();

        /* Create SQL query to find user */
        $sql = "SELECT * FROM users WHERE username=?";

        /* Prepare SQL query */
        $stmt = mysqli_prepare($conn, $sql);

        /* Bind username parameter */
        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $username
        );

        /* Execute the query */
        mysqli_stmt_execute($stmt);

        /* Get query result */
        $result = mysqli_stmt_get_result($stmt);

        /* Check if user exists */
        if ($row = mysqli_fetch_assoc($result)) {

            /* Verify password with hashed password */
            if (password_verify($password, $row["password"])) {
                return true;
            }

        }

        /* Return false if login fails */
        return false;
    }

    /* Function to register new user */
    public static function register($username, $password, $email, $role = "user") { 

        /* Connect to database */
        $conn = Database::connect();

        /* Hash the password for security */
        $hash = password_hash($password, PASSWORD_DEFAULT);

        /* Create INSERT query */
        $sql = "INSERT INTO users (username, password, email, role)
                VALUES (?, ?, ?, ?)";

        /* Prepare the query */
        $stmt = mysqli_prepare($conn, $sql);

        /* Bind username and hashed password */
        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $username,
            $hash,
            $email,
            $role
        );

        /* Execute the query */
        mysqli_stmt_execute($stmt);

        /* Return success */
        return true;
    }

    /* Login user with token */
    public static function loginWithToken($username, $password) {

        /* Connect to database */
        $conn = Database::connect();

        /* SQL query to find user */
        $sql = "SELECT * FROM users WHERE username=?";

        /* Prepare statement */
        $stmt = mysqli_prepare($conn, $sql);

        /* Bind username */
        mysqli_stmt_bind_param($stmt, "s", $username);

        /* Execute query */
        mysqli_stmt_execute($stmt);

        /* Get result */
        $result = mysqli_stmt_get_result($stmt);

        /* Check if user exists */
        if ($row = mysqli_fetch_assoc($result)) {

            /* Verify password */
            if (password_verify($password, $row["password"])) {

                /* Generate token */
                $token = bin2hex(random_bytes(16));

                /* SQL to update token */
                $updateSql = "UPDATE users SET token=? WHERE id=?";

                /* Prepare update statement */
                $updateStmt = mysqli_prepare($conn, $updateSql);

                /* Bind token and user ID */
                mysqli_stmt_bind_param(
                    $updateStmt,
                    "si", 
                    $token, 
                    $row["id"
                ]);

                /* Execute update */
                mysqli_stmt_execute($updateStmt);

                /* Return token and user role */
                return [
                    /* Return token */
                    "token" => $token,
                    /* Return user role */
                    "role" => $row["role"]
                ];
            }
        }

        /* Return false if login fails */
        return false;
    }

    /* Get user using token */
    public static function getUserByToken($token) {

        /* Connect to database */
        $conn = Database::connect();

        /* SQL to find user by token */
        $sql = "SELECT * FROM users WHERE token=?";

        /* Prepare SQL statement */
        $stmt = mysqli_prepare($conn, $sql);

        /* Bind token parameter */
        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $token
        );

        /* Execute query */
        mysqli_stmt_execute($stmt);

        /* Get result */
        $result = mysqli_stmt_get_result($stmt);

        /* Check if user found */
        if ($row = mysqli_fetch_assoc($result)) {

            /* Return user data */
            return $row;
        }

        /* Return false if not found */
        return false;
    }

}