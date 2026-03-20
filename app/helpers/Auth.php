<?php 

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/Response.php";

/* Define Auth class */
class Auth {

    /* Check token */
    public static function checkToken() {

        /* If no token in URL */
        if (!isset($_GET["token"])) {
            Response::json(false, "No token", null, 401);
        }

        /* Get token from URL */
        $token = $_GET["token"];

        /* Connect to database */
        $conn = Database::connect();

        /* Query User by token */
        $sql = "SELECT * FROM users WHERE token=?";

        /* Prepare query */
        $stmt = mysqli_prepare($conn, $sql);

        /* Bind token value */
        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $token
        );

        /* Run Query */
        mysqli_stmt_execute($stmt);

        /* Get result */
        $result = mysqli_stmt_get_result($stmt);

        /* If user found */
        if($row = mysqli_fetch_assoc($result)) {
            return true;
        }

        /* If invalid token */
        Response::json(false, "Invalid token", null, 401);
    }

    /* Check if user is admin */
    public static function requiredAdmin() {

        /* Get user from token */
        $user = self::checkToken();

        /* If user role is not admin */
        if ($user["role"] != "admin") {
            Response::json(false, "Access Denied", null, 403);
        }

        /* Return user data */
        return $user;
    }

    /* Check if users has required role */
    public static function requireRole($role) {

        /* Get user from token */
        $user = self::checkToken();
        
        /* If user role does not match */
        if($user["role"] != $role) {
            /* Deny Access */
            Response::json(false, "Access Denied", null, 403);
        }

        /*Return user */
        return $user;
    }
}   