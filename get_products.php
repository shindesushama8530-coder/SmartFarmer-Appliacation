<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartfarmer";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection to the database was successful.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  // If the connection failed, terminate the script and output an error message.
}

$sql = "SELECT id, name, description, price FROM products"; // Define an SQL query to select specific columns from the 'products' table.
$result = $conn->query($sql);

$products = array();

while ($row = $result->fetch_assoc()) // Loop through each row in the result set.
{
    $products[] = $row;  // Append the current row's data to the $products array.
}

echo json_encode($products);
$conn->close();
?>
