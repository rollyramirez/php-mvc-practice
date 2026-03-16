<?php

/* Load database configuration */
require_once __DIR__ . "/../config/db.php";

/* Create Product class */
class Product {

    /* Function to get all products */
    public static function getAll() {

        /* Connect to database */
        $conn = Database::connect();

        /* Create SELECT query */
        $sql = "SELECT * FROM products";

        /* Run query */
        $result = mysqli_query($conn, $sql);

        /* Create empty array */
        $data = [];

        /* Loop through results */
        while ($row = mysqli_fetch_assoc($result)) {
            /* Add each row to array */
            $data[] = $row;
        }

        /* Return all products */
        return $data;
    }

    /* Function to add new product */
    public static function add($name, $price, $category) {

        /* Connect to database */
        $conn = Database::connect();

        /* Create INSERT query */
        $sql = "INSERT INTO products (name, price, category)
                VALUES (?, ?, ?)";

        /* Prepare query */
        $stmt = mysqli_prepare($conn, $sql);

        /* Bind values safely */
        mysqli_stmt_bind_param(
            $stmt,
            "sis",
            $name,
            $price,
            $category
        );

        /* Execute query */
        mysqli_stmt_execute($stmt);

        /* Return success */
        return true;

    }

    /* Function to update product */
public static function update($id, $name, $price, $category) {

    /* Connect to database */
    $conn = Database::connect();

    /* Create UPDATE query */
    $sql = "UPDATE products
            SET name=?, price=?, category=?
            WHERE id=?";

    /* Prepare the query */
    $stmt = mysqli_prepare($conn, $sql);

    /* Bind values safely */
    mysqli_stmt_bind_param(
        $stmt,
        "sisi",
        $name,
        $price,
        $category,
        $id
    );

    /* Execute the query */
    mysqli_stmt_execute($stmt);

    /* Return success */
    return true;
    
    }   

    /* Function to delete product */
    public static function delete($id) {

    /* Connect to database */
    $conn = Database::connect();

    /* Create DELETE query */
    $sql = "DELETE FROM products WHERE id=?";

    /* Prepare the query */
    $stmt = mysqli_prepare($conn, $sql);

    /* Bind ID safely */
    mysqli_stmt_bind_param($stmt, "i", $id);

    /* Execute the query */
    mysqli_stmt_execute($stmt);

    /* Return success */
    return true;
    
    }

}