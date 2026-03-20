<?php

/* Session start */
session_start();

/* Set response type to JSON */
header("Content-Type: application/json");

/* Include AuthController file */
require_once __DIR__ . "/../controllers/AuthController.php";

/* Call loginToken function */
AuthController::loginToken();