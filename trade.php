<?php

session_start();

$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];

$id_annuncio = $_POST['id_annuncio'];
$id_info_consegnato = $_POST['id_info_consegnato'];
$id_copia_ottenuto = $_POST['id_copia_ottenuto'];

$servername = "localhost";
$username = "root"; 
$pw = ""; 
$dbname = "booook";

$conn = new mysqli($servername, $username, $pw, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// TODO: QUESTA QUERY VA FIXATA, NON FUNZIONA
$sql = "UPDATE TOP(1) copia_libri SET fk_id_utente = (SELECT fk_id_utente FROM copia_libri WHERE id_copia_libro = $id_copia_ottenuto)
        WHERE fk_id_info_libro = $id_info_consegnato AND fk_id_utente = $user_id";
$conn->query($sql);

$sql = "UPDATE copia_libri SET fk_id_utente = $user_id WHERE id_copia_libro = $id_copia_ottenuto";
$conn->query($sql);

$sql = "DELETE FROM annunci WHERE id_annuncio = $id_annuncio";
$conn->query($sql);

header("Location: profilo.php");

