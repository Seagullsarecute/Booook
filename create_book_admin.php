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
    <link rel="stylesheet" href="stylesheet/create_book_admin.css">
    <link href="stylesheet/nav.css" rel="stylesheet" type="text/css">
    <title>BOOOOK • Aggiungi libro admin</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div id="wrapper">
        <!-- Form per aggiungere un nuovo libro alla tabella info_libro -->
        <h1 id="title">BOOOOK</h1>
        <h2>Aggiungi libro</h2>
        <p id="description">Inserisci i dati del libro che vuoi aggiungere al database</p>
        <form id="add-book-form" action="create_book_admin_check.php" method="POST">
            <label for="titolo">Titolo:</label>
            <input type="text" id="titolo" name="titolo" required>
            <label for="autore">Autore:</label>
            <input type="text" id="autore" name="autore" required>
            <label for="genere">Genere:</label>
            <input type="text" id="genere" name="genere" required>
            <label for="casa_editrice">Casa editrice:</label>
            <input type="text" id="casa_editrice" name="casa_editrice" required>
            <label for="descrizione">Descrizione:</label>
            <textarea id="descrizione" name="descrizione" required></textarea>
            <label for="fileName">Nome file copertina (inserire "generic.png" per avere assegnata un'immagine di default):</label>
            <input type="text" id="fileName" name="fileName" required>
            <span id="error" class="error">Inserire un file valido con l'estensione!</span>
            <button type="submit">Aggiungi libro</button>
        </form>
    </div>
    <script>
        document.getElementById('add-book-form').addEventListener('submit', function(event) {
            const fileNameInput = document.getElementById('fileName');
            const errorElement = document.getElementById('error');
            const fileName = fileNameInput.value;
            const fileNamePattern = /^[\w,\s-]+\.[A-Za-z]{3,4}$/;

            if (!fileNamePattern.test(fileName)) {
                event.preventDefault();
                errorElement.style.display = 'inline';
            } else {
                errorElement.style.display = 'none';
            }
        });
    </script>
</body>
</html>