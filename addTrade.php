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
    <link rel="stylesheet" href="stylesheet/addTrade.css">
    <link href="stylesheet/nav.css" rel="stylesheet" type="text/css">
    <title>BOOOOK • Nuovo annuncio</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <h2>Aggiungi un annuncio</h2>
    <p>Compila i campi sottostanti per creare un nuovo annuncio</p>
    <form action="addTradeCheck.php" method="GET">
        <label for="libro_richiesto">Libro Richiesto:</label>
        <select name="libro_richiesto" id="libro_richiesto" required>
            <?php
            // Lista di <options>, ciascuna corrispondente a un info_libro non appartenente all'utente $user_id
            $sql = "SELECT DISTINCT * FROM info_libri WHERE id_info_libro NOT IN (SELECT fk_id_info_libro FROM copia_libri WHERE fk_id_utente = $user_id) ORDER BY titolo ASC"; 
            $result= $conn->query($sql);
            if($result->num_rows >0) {
                echo "<option disabled selected value='none'>Selezionare un libro</option>";
                while($row= $result->fetch_assoc()) {
                    echo "<option value='". $row['id_info_libro'] ."'>". $row['titolo'] ."</option>";
                }
            }
            ?>
        </select>
        <label for="libro_offerto">Libro Offerto:</label>
        <select name="libro_offerto" id="libro_offerto" required>
            <?php
            // Lista di <options>, ciascuna corrispondente a un libro appartenente all'utente $user_id
            $sql = "SELECT DISTINCT * FROM copia_libri
                JOIN info_libri ON copia_libri.fk_id_info_libro = info_libri.id_info_libro
                WHERE fk_id_utente = $user_id AND id_copia_libro NOT IN (SELECT fk_id_copia_libro_scambiato FROM annunci) ORDER BY titolo ASC";
            $result= $conn->query($sql);
            if($result->num_rows >0) {
                echo "<option disabled selected value='none'>Selezionare un libro</option>";
                while($row= $result->fetch_assoc()) {
                    echo "<option value='". $row['id_copia_libro'] ."'>". $row['titolo'] ."</option>";
                }
            }
            ?>
        </select>
        <input type="submit" value="Pubblica">
    </form>
</body>
</html>