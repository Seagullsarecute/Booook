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
<html lang="it">
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
        - Vuoi scambiare un tuo libro ma non trovi un annuncio che ti soddisfi? <a href="addTrade.php">Pubblica un annuncio</a> e attendi che un altro utente lo accetti!</p>
        <hr></hr>
        <h2 id="annunci-lista-titolo">Elenco di annunci</h2>
        <div id="filtri-wrapper">
            <h3>Filtri</h3>
            <form id="filtri-form" method="GET">
                <label for="only_available">Solo libri che possiedi:</label>
                <input type="checkbox" id="checkbox" name="only_available" value="true">
                <label for="genere">Genere:</label>
                <select id="genere" name="genere">
                    <?php
                    $sql = "SELECT DISTINCT genere FROM info_libri ORDER BY genere ASC";

                    $result= $conn->query($sql);
                    if($result->num_rows >0) {
                        echo "<option disabled selected value='none'>Selezionare un genere</option>";
                        while($row= $result->fetch_assoc()) {
                            echo "<option value='". strtolower($row['genere']) ."'>". ucfirst($row['genere']) ."</option>";
                        }
                    }
                    ?>
                </select>
                <label for="casa_editrice">Titolo:</label>
                <input type="text" name="titolo" placeholder="Selezionare un titolo">
                <input type="submit" value="Applica filtri">
                <a href="home.php" id="filter-reset-button">Reset</a>
            </form>

        </div>
        <div id="annunci-wrapper">
            <?php 
            $sql = "SELECT 
                        annunci.id_annuncio,
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
                        info_scambiato.id_info_libro AS scambiato_info_id,
                        copia_scambiato.id_copia_libro AS scambiato_copia_id,
                        utenti.nome,
                        utenti.cognome
                    FROM annunci
                    LEFT JOIN utenti ON annunci.fk_id_utente = utenti.id_utente
                    LEFT JOIN copia_libri AS copia_scambiato ON annunci.fk_id_copia_libro_scambiato = copia_scambiato.id_copia_libro
                    LEFT JOIN info_libri AS info_scambiato ON copia_scambiato.fk_id_info_libro = info_scambiato.id_info_libro
                    LEFT JOIN info_libri AS info_richiesto ON annunci.fk_id_info_libro_richiesto = info_richiesto.id_info_libro
                    WHERE annunci.fk_id_utente != ".$_SESSION['user_id']." ";
            if(isset($_GET['only_available']) && $_GET['only_available'] == 'true'){
                $sql .= "AND info_richiesto.id_info_libro IN (SELECT fk_id_info_libro FROM copia_libri WHERE fk_id_utente = ".$_SESSION['user_id'].")";
            }
            if(isset($_GET['genere']) && $_GET['genere'] != 'none'){
                $sql .= "AND info_scambiato.genere = '".$_GET['genere']."'";
            }
            if(isset($_GET['titolo']) && $_GET['titolo'] != ''){
                $sql .= "AND info_scambiato.titolo LIKE '%".$_GET['titolo']."%'";
            }
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    echo "<div class='annuncio-singolo-wrapper'>";
                        echo "<h4><b>Offerto da:</b> " . $row['nome'] . " " . $row["cognome"]."</h4>";
                        echo "<div class='annuncio-singolo-scambiato'>";
                            echo "<a href='pagina_libro.php?id_libro=".$row["scambiato_info_id"]."'><img class='annuncio-singolo-scambiato-img' src='images/book_covers/" . $row['scambiato_src'] . "'></a>";
                            echo "<div class='annuncio-singolo-scambiato-info'>";
                                echo "<p><b>Titolo: </b>" . $row['scambiato_titolo'] . "</td>";
                                echo "<p><b>Autore: </b>" . $row['scambiato_autore'] . "</td>";
                                echo "<p><b>Genere: </b>" . $row['scambiato_genere'] . "</td>";
                                echo "<p><b>Casa editrice: </b>" . $row['scambiato_casa_editrice'] . "</td>";
                            echo "</div>";
                        echo "</div>";
                        echo "<div class='annuncio-singolo-richiesto'>";
                            echo "<span>Libro da cedere: 
                                      <a href='pagina_libro.php?id_libro=".$row["richiesto_info_id"]."'>".$row["richiesto_titolo"]."</a>
                                  </span>
                                  <form method='POST' action='trade_confirmation.php'>
                                    <input type='hidden' name='id_annuncio' value='".$row['id_annuncio']."'>
                                    <input type='hidden' name='id_info_richiesto' value='".$row['richiesto_info_id']."'>
                                    <input type='hidden' name='id_info_scambiato' value='".$row['scambiato_info_id']."'>
                                    <input type='hidden' name='id_copia_scambiato' value='".$row['scambiato_copia_id']."'>";
                                    // Controllo che l'utente possieda il libro richiesto
                                    $sql_available = "SELECT * FROM copia_libri WHERE fk_id_info_libro = ".$row['richiesto_info_id']." AND fk_id_utente = ".$_SESSION['user_id'];
                                    $result_available = $conn->query($sql_available);
                                    if($result_available->num_rows > 0){
                                        echo "<input type='submit' class='btn-scambia' value='ESEGUI SCAMBIO'>";
                                    } else {
                                        echo "<input type='submit' class='btn-scambia' value='ESEGUI SCAMBIO' disabled>";
                                    }
                                  echo "</form>";
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