<?php

/* Include Auth Helpers and Product Controller */ 
require_once __DIR__ . "../helpers/Auth.php";
require_once __DIR__ .  "../controllers/ProductController.php";

/* Check if user is logged in */
Auth::checkToken();

/* Get all products */
ProductController::getProducts();