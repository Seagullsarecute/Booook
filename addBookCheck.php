<?php
   session_start();
   $id_libro= $_POST['id_libro'];
   $id_utente= $_SESSION['user_id'];
   echo $id_libro."- ".$id_utente; 
 
    if($id_libro!==null && $id_utente!==null)
    {
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "booook";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
        }

       
        
        $stmt = $conn->prepare("INSERT INTO copia_libri(fk_id_info_libro, fk_id_utente) VALUES (?, ?)");
        $stmt->bind_param("ii", $id_libro, $id_utente);

        if ($stmt->execute() === TRUE) {
            header("Location: profilo.php");
         } else {
             echo "Errore durante l'inserimento dei dati: " . $conn->error;
         }
        
         $stmt->close();
    }
    else
    {
        header("Location: addBook.php");
        $stmt->close();
    }

?>