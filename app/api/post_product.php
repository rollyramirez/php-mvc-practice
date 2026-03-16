<?php

/* Connect to database */
include "db.php";

/* Get name from POST request */
$name = $_POST["name"];

/* Get price from POST request */
$price = $_POST["price"];

/* Get category from POST request */
$category = $_POST["category"];

/* Create SQL insert query */
$sql = "INSERT INTO products (name, price, category) VALUES (?, ?, ?)";

/* Prepare the SQL statement */
$stmt = mysqli_prepare($conn, $sql);

/* Bind values safely to query */
mysqli_stmt_bind_param($stmt, "sis", $name, $price, $category);

/* Execute the query */
mysqli_stmt_execute($stmt);

/* Show success message */
echo "POST insert success";

?>
