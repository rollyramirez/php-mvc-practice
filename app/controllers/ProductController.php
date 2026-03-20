<?php

/* Load Product model and helper response */
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../helpers/Response.php";

/* Create ProductController class */
class ProductController {

    /* Function to get all products */
    public static function getProducts() {

        try {
             /* Get products from model */
            $products = Product::getAll();

            /* Send JSON response */
            Response::json(true, "Product List", $products, 200);

        } catch (Exception $e) {

            Response::error("Server error", 500);

        }

    }

    /* Function to add product */
    public static function addProduct() {

        try {

            /* Check if name, price, or category is missing */
            if (
                !isset($_GET["name"]) ||
                !isset($_GET["price"]) ||
                !isset($_GET["category"])
            ) {
                /* Return error response */
                Response::json(false, "Missing data", null, 400);
            }

            /* Get and clean name */
            $name = trim($_GET["name"]);
            /* Get price to number */
            $priceInput = trim($_GET["price"]);
            /* Get and clean category */
            $category = trim($_GET["category"]);

            /* Check if input is valid */
            if ($name == "" || $priceInput == "" || $category == "" ) {

                /* Return invalid input error */
                Response::json(false, "Empty input", null, 400);
            }

            /* Validate number */
            if (!is_number($priceInput)) {
                Response::json(false, "Price must be number", null, 400);
            }

            /* Convert */
            $price = intval($priceInput);
            
            if ($price <= 0) {
                 /* Return invalid input price */
                Response::json(false, "Invalid price", null, 400);
            }

            /* Call model to add product */
            Product::add($name, $price, $category);

            /* Send success JSON response */
            Response::json(true, "Product added", null, 200);

        /* Catch errors if something fails */
        } catch (Exception $e) {

            /* Send server error response */
            Response::error("Server error", 500);
        }
    }
    
    /* Function to add product */ 
    public static function addProductPost() {

        /* Try to run code */
        try {

            /* Check if required fields exist */
            if (
                !isset($_POST["name"]) ||
                !isset($_POST["price"]) ||
                !isset($_POST["category"])
            ) {
                /* Send error JSON response */
                Response::json(false, "Missing data", null, 400);
            }

            /* Get name, priceInput, category (trim spaces) */
            $name = trim($_POST["name"]);
            $priceInput = trim($_POST["price"]);
            $category = trim($_POST["category"]);

            /**** Start - Validation ****/

            /* Check if inputs are empty */
            if ($name == "" || $priceInput == "" || $category == "") {

                /* Send error JSON response */
                Response::json(false, "Empty input", null, 400);
            }

            /* Check name length */
            if (strlen($name) < 2) {

                /* Send error JSON response */
                Response::json(false, "Name too short", null, 400);
            }

            /* Check if price is number */
            if (!is_numeric($priceInput)) {
                
                /* Send error JSON response */
                Response::json(false, "Price must be number", null, 400);
            }

            /* Convert price to integer */
            $price = intval($priceInput);

            /* Check price is positive */
            if ($price <= 0) {

                /* Send error JSON response */
                Response::json(false, "Price must be greater than 0", null, 400);
            }

            /**** End - Validation ****/
            
            /* Save product */
            Product::add($name, $price, $category);

            /* Send success JSON response */
            Response::json(true, "Product added", null, 200);

            /* Catch errors if something fails */
            } catch (Exception $e) {

            /* Send server error response */
            Response::error("Server error", 500);

        }
    }

    /* Function to get paginated product list */
    public static function getProductsPaginate() {

        /* Start try block for error handling */
        try {

        /* Validate authentication token */
        Auth::checkToken();

        /* Get current page from query, default = 1 */
        $page = isset($_GET["page"]) ? intval ($_GET["page"]) : 1;
        
        /* Get limit per page from query, default = 5 */
        $limit = isset($_GET["limit"]) ? intval ($_GET["limit"]) : 5;

        /* Get search keyword from query, default = empty */
        $search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

        /* Validate page and limit values */
        if ($page <= 0 || $limit <= 0) {
            /* Return error response if invalid */
            Response::json(false, "Invalid pagination", null, 400);
        }

        /* Fetch paginated products based on page, limit, and search */
        $products = Product::getAllPaginated($page, $limit, $search);

        /* Count total number of products (for pagination) */
        $total = Product::countProducts($search);

        /* Return successful JSON response with product data */
        Response::json(true, "Product list", [
            "page" => $page,
            "limit" => $limit,
            "total" => $total,
            "data" => $products
        ], 200);

        /* Catch any exception errors */
        } catch (Exception $e) {
            
            /* Return server error response */
            Response::error("Server error", 500);
        }
    }
}