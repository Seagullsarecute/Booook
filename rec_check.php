<?php
   session_start();
   $id_libro= $_SESSION['id_libro'];
   $id_utente= 1;
   $rating= $_SESSION['rating'];

        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "booook";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
        }
        
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

        $sql= "SELECT rating FROM commenti WHERE fk_id_info_libro=$id_libro";

        $result= $conn->query($sql);

        if($result->num_rows>0)
        {
            $temp = 0;

            while($row=$result->fetch_assoc())
             {
                $temp+=$row['rating'];
             }

             $newrating=$temp/($result->num_rows);
             $newrating= round($newrating, 1);

             $sql = "UPDATE info_libri SET rating='$newrating' WHERE id_info_libro=$id_libro";
             $conn->query($sql);
        }
    }

           header("Location: pagina_libro.php?id_libro=$id_libro");

        $stmt->close();
    
?>
