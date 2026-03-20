<?php

/* Set response type to JSON */
header("Content-Type: application/json");

/* Load ProductController file */
require_once __DIR__ . "/../controllers/ProductController.php";

/* Call function to add product using POST */
ProductController::addProductPost();
