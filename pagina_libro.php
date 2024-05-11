<!doctype html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>BOOOOK • libro </title>
</head>
<?php 

session_start();
$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$id_libro= $_GET['id_libro'];
$_SESSION['id_libro']= $id_libro;


$servername = "localhost";
$username = "root"; 
$pw = ""; 
$dbname = "booook";

$conn = new mysqli($servername, $username, $pw, $dbname);

if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}
?>

<body>

<?php include "navbar.php"?>

<?php
  $sql = "SELECT * FROM info_libri WHERE id_info_libro = $id_libro";

  $result= $conn->query($sql);

  if($result->num_rows >0)
{
  while($row= $result->fetch_assoc())
  {
   echo "<div class='centre'><img src='images/book_covers/" . $row['src'] . "'></div></div>";
   echo "<h1>TITOLO</h1>";
   echo "<h1>".$row['titolo']."</h1>";
   echo "<h3>AUTORE</h3>";
   echo "<h3>".$row['autore']."</h3>";
   echo "<h3>GENERE</h3>";
   echo "<h3>".$row['genere']."</h3>";
   echo "<h3>DESCRIZIONE</h3>";
   echo "<h3>".$row['descrizione']."</h3>";
   echo "<h3>RATING</h3>";
   echo "<h3>".$row['rating']."</h3>";
   echo "<h3>CASA EDITRICE</h3>";
   echo "<h3>".$row['casa_editrice']."</h3>";
   echo "<hr></hr>";
  }
} else{
  echo "The table is empty";
}


$sql = "SELECT * FROM commenti
        JOIN utenti ON commenti.fk_id_utente= utenti.id_utente
        WHERE fk_id_info_libro = $id_libro";

$result= $conn->query($sql);
if($result->num_rows >0)
{
  echo "<div id='review-header'>";
  echo "<h2>RECENSIONI</h2>";
  echo "<form action='form_recensione.php' method= 'post'>
     <input type ='submit' name='invio' value='Recensione' class='postButton'/>
     </form>";
  echo "</div>";
  echo "<table class='table table-hover'> <tr> <th> UTENTE</th><th> RATING </th><th> COMMENTO </th></tr>";

  while($row= $result->fetch_assoc())
  {
  echo "<tr><td>".$row["nome"]." ".$row["cognome"]."</td><td>".$row["rating"]."</td><td>".$row["testo"]."</td></tr>";
  }
  echo "</table>";
} else{
  echo "<div id='review-header'>";
  echo "<h2>RECENSIONI</h2>";
  echo "<form action='form_recensione.php' method= 'post'>
     <input type ='submit' name='invio' value='Recensione' class='postButton'/>
     </form>";
  echo "</div>";
  echo "The table is empty";
}

?>
  </body>
