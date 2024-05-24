<!doctype html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="stylesheet/nav.css">
<link rel="stylesheet" href="stylesheet/addBook.css">
<title>BOOOOK • libro</title>
</head>

<?php 
session_start();

$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$email = $_SESSION['email'];
$user_id= $_SESSION['user_id'];
?>

<?php include 'navbar.php' ?>

<?php
$servername = "localhost";
$username = "root"; 
$pw = ""; 
$dbname = "booook";

$conn = new mysqli($servername, $username, $pw, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "SELECT * FROM info_libri";

$result=$conn->query($sql);
echo "<h1>Aggiungi un libro al tuo inventario</h1>";
echo "<h5>Clicca sul pulsante + sotto il libro che desideri per aggiungerlo al tuo inventario, verrai reindirizzato alla tua pagina profilo con il tuo inventario aggiornato!</h5>";
echo "<h5>Clicca sulla copertina del libro per visualizzare le sue informazioni oppure <a href='profilo.php'>torna al tuo profilo</a></h5>";
echo "<hr></hr>";

if($result->num_rows >0)
{
    echo "<div class='wrp2'>";
    while($row= $result->fetch_assoc())
    {
        echo "<div class='info-libro'>";
        echo "<a href='pagina_libro.php?id_libro=".$row["id_info_libro"]."'><img src='images/book_covers/" . $row['src'] . "' class='book-img'></a>";
        echo "<h4>".$row['titolo']."</h4>";
        echo "<form action='addBookCheck.php' method= 'post'>
        <input type ='hidden' name='id_libro' value=".$row["id_info_libro"].">
        <input type='submit' value='+'>
        </form>";
        echo "</div>";
    }
    echo "</div>";
}
else{
    echo "the archive is empty";
}
?>

