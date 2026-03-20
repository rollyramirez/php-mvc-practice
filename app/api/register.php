<?php

/* Set response type to JSON */
header("Content-Type: application/json");

/* Load AuthController file */
require_once __DIR__ . "/../controllers/AuthController.php";

/* Call register function */
AuthController::register();