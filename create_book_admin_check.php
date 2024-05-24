<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; 
$pw = ""; 
$dbname = "booook";

$conn = new mysqli($servername, $username, $pw, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form inputs
$titolo = $_POST['titolo'];
$autore = $_POST['autore'];
$genere = $_POST['genere'];
$casa_editrice = $_POST['casa_editrice'];
$descrizione = $_POST['descrizione'];
$fileName = $_POST['fileName'];

// Validate file name (basic validation)
if (!preg_match('/^[\w,\s-]+\.[A-Za-z]{3,4}$/', $fileName)) {
    echo "Invalid file name.";
    exit;
}

// Default values for fields not provided by the form
$rating = NULL;
$casa_editrice = 'Unknown';

// Prepare an SQL statement
$stmt = $conn->prepare("INSERT INTO info_libri (titolo, autore, genere, descrizione, src, casa_editrice)
                        VALUES (?, ?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("ssssss", $titolo, $autore, $genere, $descrizione, $fileName, $casa_editrice);

// Execute the statement
if ($stmt->execute()) {
    header("Location: area_admin.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
