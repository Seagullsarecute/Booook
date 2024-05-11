<?php 

session_start();

$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$email = $_SESSION['email'];

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
        <h1 id="title">BOOOOK</h1>
        <p id="description">Benvenuto nella home page di BOOOOK! In questo sito potrai scambiare i libri in tuo possesso (accedi alla tua <a href="profilo.php">area privata</a> 
        per controllare i libri nel tuo inventario) con libri di altri utenti, accettando gli annunci da loro postati. Puoi accettare un annuncio solo se possiedi il libro richiesto dall'utente che l'ha pubblicato.<br><br>
        - Vuoi scambiare un tuo libro ma non trovi un annuncio che ti soddisfi? <a href="#">WIP Pubblica un annuncio</a> e attendi che un altro utente lo accetti!</p>
        <hr></hr>
        <h2 id="annunci-lista-titolo">Elenco di annunci</h2>
        <div id="filtri-wrapper">
            <h3>Filtri</h3>
            <form id="filtri-form" method="GET">
                <label for="only_available">Solo libri che possiedi:</label>
                <input type="checkbox" id="checkbox" name="only_available" value="true">
                <label for="genere">Genere:</label>
                <select id="genere" name="genere">
                    <option value="none">Tutti</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="horror">Horror</option>
                    <option value="giallo">Giallo</option>
                    <option value="romantico">Romantico</option>
                    <option value="avventura">Avventura</option>
                    <option value="biografico">Biografico</option>
                    <option value="storia">Storia</option>
                    <option value="fantascienza">Fantascienza</option>
                    <option value="thriller">Thriller</option>
                    <option value="comico">Comico</option>
                    <option value="drammatico">Drammatico</option>
                    <option value="poesia">Poesia</option>
                    <option value="saggio">Saggio</option>
                    <option value="tecnico">Tecnico</option>
                    <option value="altro">Altro</option>
                </select>
                <label for="casa_editrice">Titolo:</label>
                <input type="text" name="titolo">
                <input type="submit" value="Applica filtri">
            </form>

        </div>
        <div id="annunci-wrapper">
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
                    if(isset($_GET['only_available']) && $_GET['only_available'] == 'true'){
                        $sql .= "WHERE richi";
                    }
                    if(isset($_GET['genere']) && $_GET['genere'] != 'none'){
                        $sql .= " WHERE richiesto_genere = '".$_GET['genere']."'";
                    }
                    if(isset($_GET['titolo']) && $_GET['titolo'] != ''){
                        $sql .= " WHERE richiesto_titolo LIKE '%".$_GET['titolo']."%'";
                    }
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    echo "<div class='annuncio-singolo-wrapper'>";
                        echo "<h4><b>Offerto da:</b> " . $row['nome'] . " " . $row["cognome"]."</h4>";
                        echo "<div class='annuncio-singolo-scambiato'>";
                            echo "<img class='annuncio-singolo-scambiato-img' src='images/book_covers/" . $row['scambiato_src'] . "'>";
                            echo "<div class='annuncio-singolo-scambiato-info'>";
                                echo "<p><b>Titolo: </b>" . $row['scambiato_titolo'] . "</td>";
                                echo "<p><b>Autore: </b>" . $row['scambiato_autore'] . "</td>";
                                echo "<p><b>Genere: </b>" . $row['scambiato_genere'] . "</td>";
                                echo "<p><b>Casa editrice: </b>" . $row['scambiato_casa_editrice'] . "</td>";
                            echo "</div>";
                        echo "</div>";
                        echo "<div class='annuncio-singolo-richiesto'>";
                            echo "<span>Libro da cedere: <a href='pagina_libro.php?id_libro=".$row["richiesto_info_id"]."'>".$row["richiesto_titolo"]."</a></span><button class='btn-scambia'>ESEGUI SCAMBIO</button>";
                        echo "</div>";
                        echo "<hr></hr>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>

    <script src="script/home.js"></script>
</body>
</html>