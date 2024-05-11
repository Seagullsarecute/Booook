<?php

session_start();

$nome = $_SESSION['nome'];
$cognome = $_SESSION['cognome'];
$user_id = $_SESSION['user_id'];

echo "<script>alert(".$_SESSION['user_id'].")</script>";

$servername = "localhost";
$username = "root"; 
$pw = ""; 
$dbname = "booook";

$conn = new mysqli($servername, $username, $pw, $dbname);

if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>BOOOOK - Utente</title>
</head>
<body>
    
<?php 
/*
$sql = "SELECT * FROM utenti WHERE id_utente = $user_id";

$result=$conn->query($sql);

if($result->num_rows >0)
{
    while($row= $result->fetch_assoc())
    {
     echo "<div class='centre'><img src='images/book_covers/" . $row['srcUser'] . "'></div></div>";
    }
}else{
    echo "The table is empty";
}*/
?>
<?php include "navbar.php" ?>


</body>
</html>