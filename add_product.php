<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartfarmer";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection to the database was successful.
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);     // If the connection failed, terminate the script and output an error message.
}

// Check if the request method is POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Retrieve the values from the POST request, or use an empty string  or 0 if it's not set.
    $name = $_POST['name'] ?? '';   
    $description = $_POST['description'] ?? '';     
    $price = $_POST['price'] ?? 0;    


    // Log the received data for debugging purposes.
    error_log("Received data: name=$name, description=$description, price=$price");

    $sql = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";  


    // Prepare the SQL statement to prevent SQL injection.
    $stmt = $conn->prepare($sql);
    if ($stmt === false)     // Check if the statement was prepared successfully.

    {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the parameters to the prepared statement.
    $stmt->bind_param("ssd", $name, $description, $price);    // 'ssd' indicates that the first two parameters are strings and the third is a double (float).


    // Execute the prepared statement.
    if ($stmt->execute())
    {
        echo "Product added successfully";
    } 
    else 
    {

        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} 
else // If the request method is not POST, output an error message.
{
    echo "Invalid request method";
}

$conn->close();
?>
