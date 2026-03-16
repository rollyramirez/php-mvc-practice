<?php

/* Load ProductController file */
require_once __DIR__ . "/../controllers/ProductController.php";

/* Call function to get and display products */
ProductController::getProducts();