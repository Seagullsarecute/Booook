<?php
   session_start();
   $id_libro= $_SESSION['id_libro'];
   $id_utente= 1;
   $_SESSION['rating']= $_POST['rating'];
   $testo=$_POST['commento'];

    if(strlen($_SESSION['rating'])!==0 && strlen($testo)!==0)
    {
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "booook";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
        }

        
        $stmt = $conn->prepare("INSERT INTO commenti (rating, testo, fk_id_utente, fk_id_info_libro) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $_SESSION['rating'], $testo, $id_utente, $id_libro);

        if ($stmt->execute() === TRUE) {
            header("Location: rec_check.php?id_libro=$id_libro");
         } else {
             echo "Errore durante l'inserimento dei dati: " . $conn->error;
         }
        
         $stmt->close();
    }
    else
    {
        header("Location: form_recensione.php");
        $stmt->close();
    }

?>