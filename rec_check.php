<?php
   session_start();
   $id_libro= $_SESSION['id_libro'];
   $id_utente= 1;
   $rating= $_POST['rating'];
   $testo=$_POST['commento'];

    if(strlen($rating)!==0 && strlen($testo)!==0)
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
        $stmt->bind_param("isss", $rating, $testo, $id_utente, $id_libro);


        
        $sql= "SELECT rating FROM info_libri WHERE id_info_libro=$id_libro";
        $result= $conn->query($sql);

        $row = $result->fetch_assoc();

        $totrating= $row['rating'];

    if(is_null($totrating))
     {
           $sql = "UPDATE info_libri SET rating='$rating' WHERE id_info_libro=$id_libro";
           $conn->query($sql);
       }
       else{

        $sql= "SELECT rating FROM commenti";

        $result= $conn->query($sql);
        $row = $result->fetch_assoc();

        if($result->num_rows >0)
        {
            while($row= $result->fetch_assoc())
             {
                $temp+=$row['rating'];
             }

             $newrating=$temp/$result->num_rows;

             $sql = "UPDATE info_libri SET rating='$newrating' WHERE id_info_libro=$id_libro";
             $conn->query($sql);
        }
    }

        if ($stmt->execute() === TRUE) {
           header("Location: pagina_libro.php?id_libro=$id_libro");
        } else {
            echo "Errore durante l'inserimento dei dati: " . $conn->error;
        }

        $stmt->close();
    }
    else{
        header("Location: form_recensione.php");
    }
    
?>
