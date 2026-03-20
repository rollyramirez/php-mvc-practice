<?php

/* Include authentication helper file */
require_once __DIR__ . "/../helpers/Auth.php";
/* Include product controller file */
require_once __DIR__ . "/../controllers/ProductController.php";

/* Call function to fetch paginated products */
ProductController::getProductsPaginate();