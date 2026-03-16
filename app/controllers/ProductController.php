<?php

/* Load Product model */
require_once __DIR__ . "/../models/Product.php";

/* Create ProductController class */
class ProductController {

    /* Function to get all products */
    public static function getProducts() {

        /* Get products from model */
        $products = Product::getAll();

        /* Convert to JSON and display */
        echo json_encode($products);

    }

    /* Function to add product */
public static function addProduct() {

    /* Check if name, price, or category is missing */
    if (
        !isset($_GET["name"]) ||
        !isset($_GET["price"]) ||
        !isset($_GET["category"])
    ) {
        /* Return error response */
        echo json_encode([
            "status" => false,
            "message" => "Missing data"
        ]);

        /* Stop function */
        return;
    }

    /* Get and clean name */
    $name = trim($_GET["name"]);

    /* Convert price to number */
    $price = intval($_GET["price"]);

    /* Get and clean category */
    $category = trim($_GET["category"]);

    /* Check if input is valid */
    if ($name == "" || $price <= 0) {

        /* Return invalid input error */
        echo json_encode([
            "status" => false,
            "message" => "Invalid input"
        ]);

        /* Stop function */
        return;
    }

    /* Call model to add product */
    Product::add($name, $price, $category);

    /* Return success response */
        echo json_encode([
            "status" => true,
            "message" => "Product added"
        ]);
    
    }

    /* Function to update product */
    public static function updateProduct() {

    /* Check if ID is missing */
    if (!isset($_GET["id"])) {
        /* Show error message */
        echo "Missing ID";
        /* Stop function */
        return;
    }

    /* Get ID and convert to number */
    $id = intval($_GET["id"]);

    /* Get name from URL */
    $name = $_GET["name"];

    /* Get price and convert to number */
    $price = intval($_GET["price"]);

    /* Get category from URL */
    $category = $_GET["category"];

    /* Call model to update product */
    Product::update($id, $name, $price, $category);

    /* Show success message */
    echo "Product updated";
    
    }

    /* Function to delete product */
    public static function deleteProduct() {

    /* Check if ID is missing */
    if (!isset($_GET["id"])) {
        /* Show error message */
        echo "Missing ID";
        /* Stop function */
        return;
    }

    /* Get ID and convert to number */
    $id = intval($_GET["id"]);

    /* Call model to delete product */
    Product::delete($id);

    /* Show success message */
    echo "Product deleted";
}

}