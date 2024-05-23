<?php 

session_start();

$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];

$id_copia_libro = $_GET['libro_offerto'];
$id_info_libro = $_GET['libro_richiesto'];

/*(strcmp($id_copia_libro, "none") || strcmp($id_info_libro, "none")){
    header("Location: addTrade.php");
    exit();
}*/

$servername = "localhost";
$username = "root"; 
$pw = ""; 
$dbname = "booook";

$conn = new mysqli($servername, $username, $pw, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "INSERT INTO annunci (fk_id_utente, fk_id_copia_libro_scambiato, fk_id_info_libro_richiesto) VALUES ($user_id, $id_copia_libro, $id_info_libro)";
sleep(10);

if ($conn->query($sql) === TRUE) {
    header("Location: home.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}