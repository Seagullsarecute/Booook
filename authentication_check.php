<?php
session_start();

$servername = "localhost";
$svusername = "root";
$svpassword = "";
$dbname = "booook";

$conn = new mysqli($servername, $svusername, $svpassword, $dbname);

if($_POST["action"] == "login") {

    // Get the email and password from $_POST variables
    $email = $_POST['email'];
    $pw = md5($_POST['pw']);

    // Create a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM utenti WHERE email = ? AND pw = ?");
    $stmt->bind_param("ss", $email, $pw);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists in the database
    if ($result->num_rows > 0) {
        // Fetch the user record
        $row = $result->fetch_assoc();

        // Save the record's column as $_SESSION variables
        $_SESSION['user_id'] = $row['id_utente'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['cognome'] = $row['cognome'];

        // Redirect to home.php
        header("Location: home.php");
        exit();
    } else {
        // Redirect to login_fail.php
        header("Location: login_fail.php");
        exit();
    }
}
else if ($_POST["action"] == "register") {

    // Get the email and password from $_POST variables
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $pw = md5($_POST['pw']);

    // Create a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM utenti WHERE email=?");

    $stmt->bind_param("s", $email);

    $stmt->execute();
    $result = $stmt->get_result();

    if(isset($result->num_rows) && $result->num_rows > 0){
        echo "<p>Utente già esistente!</p>";
        echo "<p>Torna a pagina di <a href=\"index.php\">login</a></p>";
    }
    else {
        $stmt = $conn->prepare("INSERT INTO utenti (nome, cognome, email, pw) Values (?, ?, ?, ?)");

        $stmt->bind_param("ssss", $nome, $cognome, $email, $pw);

        $stmt->execute();

        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $nome;
        $_SESSION['cognome'] = $cognome;
        header("Location: home.php");
    }
}
else {
    echo "<p>Ops! C'è stato un errore nell'elaborazione della tua richiesta, <a href='index.html'>riproviamo</a></p>";
}