<?php

/* Today we do:

1. session_start()
2. save user in session after login
3. check session (protected API)
4. logout */

// Start session
session_start();

/* Set response type to JSON */
header("Content-Type: application/json");

/* Load AuthController file */
require_once __DIR__ . "/../controllers/AuthController.php";

/* Call login function */
AuthController::login();