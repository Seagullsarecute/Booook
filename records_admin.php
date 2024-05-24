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
    <link rel="stylesheet" href="stylesheet/records_admin.css">
    <link href="stylesheet/nav.css" rel="stylesheet" type="text/css">
    <title>BOOOOK • Lista Scambi</title>
</head>
<body>
    <?php include 'navbar.php' ?>

    <div id="wrapper">
        <h1 id="title">BOOOOK</h1>
        <h2>Records Scambi</h2>
        <p id="description">Benvenuto nell'area amministrativa di BOOOOK! Da qui puoi visualizzare tutti i records degli scambi effettuati sul sito. <a href="area_admin.php">Torna all'area admin</a><br><br>
        Gli scambi sono ordinati per la data</p>
        <hr></hr>
        <table id="records-table">
            <tr>
                <th>Id Scambio</th>
                <th>Utente 1 (autore annuncio)</th>
                <th>Utente 2</th>
                <th>Libro 1</th>
                <th>Libro 2</th>
                <th>Data Scambio</th>
            </tr>
            <?php
            $sql = "SELECT 
                        id_scambio,
                        utente_poster.nome as poster_nome,
                        utente_poster.cognome as poster_cognome,
                        utente_accettatore.nome as accettatore_nome,
                        utente_accettatore.cognome as accettatore_cognome,
                        libro1.fk_id_info_libro as libro1_fk_id_info_libro,
                        libro2.fk_id_info_libro as libro2_fk_id_info_libro,
                        scambi.data as data_scambio
                    FROM scambi 
                    LEFT JOIN utenti AS utente_poster ON scambi.fk_id_utente1 = utente_poster.id_utente
                    LEFT JOIN utenti AS utente_accettatore ON scambi.fk_id_utente2 = utente_accettatore.id_utente
                    LEFT JOIN copia_libri AS libro1 ON scambi.fk_id_copia_libro1 = libro1.id_copia_libro
                    LEFT JOIN copia_libri AS libro2 ON scambi.fk_id_copia_libro2 = libro2.id_copia_libro
                    ORDER BY data DESC";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>". $row['id_scambio'] ."</td>";
                    echo "<td>". $row['poster_nome'] . " " . $row['poster_cognome'] ."</td>";
                    echo "<td>". $row['accettatore_nome'] . " " . $row['accettatore_cognome'] ."</td>";
                    echo "<td><a href='pagina_libro.php?id_libro=". $row['libro1_fk_id_info_libro'] ."'>INFO LIBRO</a></td>";
                    echo "<td><a href='pagina_libro.php?id_libro=". $row['libro2_fk_id_info_libro'] ."'>INFO LIBRO</a></td>";
                    echo "<td>". $row['data_scambio'] ."</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>
    
</body>
</html>