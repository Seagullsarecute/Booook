<?php 

session_start();

$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$email = $_SESSION['email'];
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet/area_admin.css">
    <link href="stylesheet/nav.css" rel="stylesheet" type="text/css">
    <title>BOOOOK • Area Admin</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div id="wrapper">
        <h1 id="title">BOOOOK</h1>
        <h2>Area Admin</h2>
        <p id="description">Benvenuto nell'area amministrativa di BOOOOK! Da qui puoi effettuare tutte le operazioni di tipo amministrativo come guardare i records di tutti gli scambi del sito, o aggiungere nuovi libri al database</p>
        <a href="records_admin.php"><button>Visualizza i records</button></a>
        <a href="create_book_admin.php"><button>Aggiungi libro</button></a>
    </div>
</body>
</html>