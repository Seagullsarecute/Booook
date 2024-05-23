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

$sql = "INSERT INTO scambi (data, ora, fk_id_utente1, fk_id_utente2, fk_id_copia_libro1, fk_id_copia_libro2) 
        VALUES 
            (CURDATE(), 
            CURTIME(), 
            (SELECT fk_id_utente FROM copia_libri WHERE id_copia_libro = $id_copia_ottenuto LIMIT 1), 
            $user_id, 
            $id_copia_ottenuto, 
            (SELECT id_copia_libro FROM copia_libri WHERE fk_id_info_libro = $id_info_consegnato AND fk_id_utente = $user_id LIMIT 1)
        )";
$conn->query($sql);

$sql = "UPDATE copia_libri SET fk_id_utente = (SELECT fk_id_utente FROM copia_libri WHERE id_copia_libro = $id_copia_ottenuto LIMIT 1)
        WHERE fk_id_info_libro = $id_info_consegnato AND fk_id_utente = $user_id LIMIT 1";
$conn->query($sql);

$sql = "UPDATE copia_libri SET fk_id_utente = $user_id WHERE id_copia_libro = $id_copia_ottenuto";
$conn->query($sql);

$sql = "DELETE FROM annunci WHERE id_annuncio = $id_annuncio";

if ($conn->query($sql) === TRUE) {
    header("Location: home.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}