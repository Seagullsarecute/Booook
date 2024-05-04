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
    <title>BOOOOK • Home</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div id="wrapper">
        <h1>Benvenuto <?php echo $nome . " " . $cognome ?></h1>
        <h2>Elenco di annunci:</h2>
        <table>
            <tr>
                <th>Copertina</th>
                <th>Titolo</th>
                <th>Autore</th>
                <th>Genere</th>
                <th>Casa Editrice</th>
                <th>Utente</th>
            </tr>
            <?php 
            $sql = "SELECT 
                        info_richiesto.titolo AS richiesto_titolo,
                        info_richiesto.autore AS richiesto_autore,
                        info_richiesto.genere AS richiesto_genere,
                        info_richiesto.casa_editrice AS richiesto_casa_editrice,
                        info_richiesto.src AS richiesto_src,
                        info_scambiato.titolo AS scambiato_titolo,
                        info_scambiato.autore AS scambiato_autore,
                        info_scambiato.genere AS scambiato_genere,
                        info_scambiato.casa_editrice AS scambiato_casa_editrice,
                        info_scambiato.src AS scambiato_src,
                        utenti.nome,
                        utenti.cognome
                    FROM annunci
                    LEFT JOIN utenti ON annunci.fk_id_utente = utenti.id_utente
                    LEFT JOIN copia_libri AS copia_richiesto ON annunci.fk_id_copia_libro_scambiato = copia_richiesto.id_copia_libro
                    LEFT JOIN info_libri AS info_richiesto ON copia_richiesto.fk_id_info_libro = info_richiesto.id_info_libro
                    LEFT JOIN info_libri AS info_scambiato ON annunci.fk_id_info_libro_richiesto = info_scambiato.id_info_libro";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='images/book_covers/" . $row['richiesto_src'] . "'></td>";
                    echo "<td>" . $row['richiesto_titolo'] . "</td>";
                    echo "<td>" . $row['richiesto_autore'] . "</td>";
                    echo "<td>" . $row['richiesto_genere'] . "</td>";
                    echo "<td>" . $row['richiesto_casa_editrice'] . "</td>";
                    echo "<td>" . $row['nome'] . " " . $row['cognome'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>

</body>
</html>