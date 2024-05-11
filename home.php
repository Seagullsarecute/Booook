<?php 

session_start();

$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="stylesheet/home.css" rel="stylesheet" type="text/css">
    <link href="stylesheet/nav.css" rel="stylesheet" type="text/css">
    <title>BOOOOK • Home</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div id="wrapper">
        <h1>Benvenuto <?php echo $nome . " " . $cognome ?></h1>
        <h2>Elenco di annunci:</h2>
        <div class="annunci-wrapper">
            <?php 
            $sql = "SELECT 
                        info_richiesto.titolo AS richiesto_titolo,
                        info_richiesto.autore AS richiesto_autore,
                        info_richiesto.genere AS richiesto_genere,
                        info_richiesto.casa_editrice AS richiesto_casa_editrice,
                        info_richiesto.src AS richiesto_src,
                        info_richiesto.id_info_libro AS richiesto_info_id,
                        info_scambiato.titolo AS scambiato_titolo,
                        info_scambiato.autore AS scambiato_autore,
                        info_scambiato.genere AS scambiato_genere,
                        info_scambiato.casa_editrice AS scambiato_casa_editrice,
                        info_scambiato.src AS scambiato_src,
                        utenti.nome,
                        utenti.cognome
                    FROM annunci
                    LEFT JOIN utenti ON annunci.fk_id_utente = utenti.id_utente
                    LEFT JOIN copia_libri AS copia_scambiato ON annunci.fk_id_copia_libro_scambiato = copia_scambiato.id_copia_libro
                    LEFT JOIN info_libri AS info_scambiato ON copia_scambiato.fk_id_info_libro = info_scambiato.id_info_libro
                    LEFT JOIN info_libri AS info_richiesto ON annunci.fk_id_info_libro_richiesto = info_richiesto.id_info_libro";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    echo "<div class='annuncio-singolo-wrapper'>";
                        echo "<h4><b>Offerto da:</b> " . $row['nome'] . " " . $row["cognome"]."</h4>";
                        echo "<div class='annuncio-singolo-scambiato'>";
                            echo "<img src='images/book_covers/" . $row['scambiato_src'] . "'>";
                            echo "<div class='annuncio-singolo-scambiato-info'>";
                                echo "<p><b>Titolo: </b>" . $row['scambiato_titolo'] . "</td>";
                                echo "<p><b>Autore: </b>" . $row['scambiato_autore'] . "</td>";
                                echo "<p><b>Genere: </b>" . $row['scambiato_genere'] . "</td>";
                                echo "<p><b>Casa editrice: </b>" . $row['scambiato_casa_editrice'] . "</td>";
                            echo "</div>";
                        echo "</div>";
                        echo "<div class='annuncio-singolo-richiesto'>";
                            echo "<p>Libro da cedere: <a href='pagina_libro.php?id_libro=".$row["richiesto_info_id"]."'>".$row["richiesto_titolo"]."</a></p>";
                            echo "<button class='btn-scambia'>ESEGUI SCAMBIO</button>";
                        echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>

</body>
</html>