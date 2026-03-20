<?php

/* Load Auth helper (for token checking) */
require_once __DIR__ . "/../helpers/Auth.php";
/* Load Upload Controller */
require_once __DIR__ . "/../controllers/UploadController.php";

header("Content-Type: application/json");

/* Check if user token is valid */
Auth::checkToken();

/* Call upload function */
UploadController::uploadFile();