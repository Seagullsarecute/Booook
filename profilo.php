<?php

session_start();

$nome = $_SESSION['nome'];
$cognome = $_SESSION['cognome'];
$user_id = $_SESSION['user_id'];


$servername = "localhost";
$username = "root"; 
$pw = ""; 
$dbname = "booook";

$conn = new mysqli($servername, $username, $pw, $dbname);

if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

?>
<?php include "navbar.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>BOOOOK - Utente</title>
</head>
<body>
    
<?php 

$sql = "SELECT * FROM utenti WHERE id_utente = $user_id";

$result=$conn->query($sql);

if($result->num_rows >0)
{
    while($row= $result->fetch_assoc())
    {
     echo "<div class='wrapper'>";
     echo "<div class='img'><img src='images/users_img/" . $row['srcUser'] . "'></div>";
     echo "<div class='text'>";
     echo "<h2>".$row['nome']." ".$row['cognome']."</h2>";
     echo "<h3>".$row['email']."</h3>";
     echo "</div>";
     echo "</div>";
     echo "<hr></hr>";
    }
}else{
    echo "The table is empty";
}

$sql = "SELECT src,titolo FROM copia_libri
        JOIN info_libri ON fk_id_info_libro= id_info_libro
        WHERE fk_id_utente = $user_id";


$result=$conn->query($sql);

if($result->num_rows >0)
{
    echo "<div class='wrp2'>";
    while($row= $result->fetch_assoc())
    {
        echo "<div class='info-libro'>";
        echo "<img src='images/users_img/" . $row['src'] . "'>";
        echo "<h4>".$row['titolo']."</h4>";
        echo "</div>";
    }
    echo "</div>";
}else{
    echo "The inventario is empty";
}

?>
</body>
</html>