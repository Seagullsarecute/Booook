<?php 

session_start();

$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$email = $_SESSION['email'];

$trade_id = $_POST['id_annuncio'];
$id_info_richiesto = $_POST['id_info_richiesto'];
$id_info_scambiato = $_POST['id_info_scambiato'];
$id_copia_scambiato = $_POST['id_copia_scambiato'];

$servername = "localhost";
$username = "root"; 
$pw = ""; 
$dbname = "booook";

$conn = new mysqli($servername, $username, $pw, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Salvo le informazioni del libro RICHIESTO in delle variabili
$info_consegnato = array();

$sql = "SELECT * FROM info_libri WHERE id_info_libro = $id_info_richiesto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $info_consegnato["titolo"] = $row['titolo'];
    $info_consegnato["autore"] = $row['autore'];
    $info_consegnato["genere"] = $row['genere'];
    $info_consegnato["casa_editrice"] = $row['casa_editrice'];
    $info_consegnato["src"] = $row['src'];
}

// Salvo le informazioni del libro SCAMBIATO in delle variabili
$info_ottenuto = array();

$sql = "SELECT * FROM info_libri WHERE id_info_libro = $id_info_scambiato";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $info_ottenuto["titolo"] = $row['titolo'];
    $info_ottenuto["autore"] = $row['autore'];
    $info_ottenuto["genere"] = $row['genere'];
    $info_ottenuto["casa_editrice"] = $row['casa_editrice'];
    $info_ottenuto["src"] = $row['src'];
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet/trade_confirmation.css" type="text/css">
    <link href="stylesheet/nav.css" rel="stylesheet" type="text/css">
    <title>BOOOOK • Conferma Scambio</title>
</head>
<body>
    <?php include "navbar.php" ?>
    <div id="wrapper">
        <h1 id="title">BOOOOK</h1>
        <h2 id="subtitle">Confermi lo scambio?</h2>
        <div id="trade-visual-wrapper">
            <div class="trade-visual-book" style="background:rgb(50, 149, 39)">
                <h2>Libro che otterrai</h2>
                <img height=400 width=230 src="images/book_covers/<?php echo $info_ottenuto["src"] ?>">
                <h3><b><?php echo $info_ottenuto["titolo"] ?></b></h3>
                <p><b>Autore:</b> <?php echo $info_ottenuto["autore"] ?></p>
                <p><b>Genere:</b> <?php echo $info_ottenuto["genere"] ?></p>
                <p><b>Casa editrice:</b> <?php echo $info_ottenuto["casa_editrice"] ?></p>
            </div>
            <span id="visual-wrapper-icon">⇆</span>
            <div class="trade-visual-book" style="background:rgb(255, 70, 70)">
                <h2>Libro che consegnerai</h2>
                <img height=400 width=230 src="images/book_covers/<?php echo $info_consegnato["src"] ?>">
                <h3><b><?php echo $info_consegnato["titolo"] ?></b></h3>
                <p><b>Autore:</b> <?php echo $info_consegnato["autore"] ?></p>
                <p><b>Genere:</b> <?php echo $info_consegnato["genere"] ?></p>
                <p><b>Casa editrice:</b> <?php echo $info_consegnato["casa_editrice"] ?></p>
            </div>
        </div>
        <form method="POST" action="trade.php">
            <input type="hidden" name="id_annuncio" value="<?php echo $trade_id ?>">
            <input type="hidden" name="id_info_consegnato" value="<?php echo $id_info_richiesto ?>">
            <input type="hidden" name="id_copia_ottenuto" value="<?php echo $id_copia_scambiato ?>">
            <input type="submit" value="CONFERMA" id="trade-confirmation-button">
        </form>
    </div>
</body>
</html>