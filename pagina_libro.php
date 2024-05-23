<!doctype html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="stylesheet/nav.css" rel="stylesheet" type="text/css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="stylesheet/pagina_libro.css">
<title>BOOOOK • libro </title>
</head>
<?php 

session_start();
$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$email = $_SESSION['email'];
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
  echo "<div id='wrapper'>";
  while($row= $result->fetch_assoc())
  {
   echo "<div class='info'>";
   echo "<img id='book-img' src='images/book_covers/" . $row['src'] . "'>";
   echo "<div class='text'>";
   echo "<h2><b>Titolo: </b>".$row['titolo']."</h2>";
   echo "<h4><b>Autore: </b>".$row['autore']."</h4>";
   echo "<h4><b>Genere: </b>".$row['genere']."</h4>";
   echo "<h4><b>Casa Editrice: </b>".$row['casa_editrice']."</h4>";
   echo "<h4><b>RATING: </b>".$row['rating']." ★</h3>";
   echo "</div>";
   echo "</div>";
   echo "<hr></hr>";
   echo "<h3>DESCRIZIONE</h3>";
   echo "<h4>".$row['descrizione']."</h4>";
   echo "<hr size='10'></hr>";
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
  
  echo "<form action='form_recensione.php' method= 'post' class='comment-form'>
  <div style='text-align: right;'>
  <input type='submit' name='invio' value='Commenta'>
  </div>
  </form>";

  while($row= $result->fetch_assoc())
  {
  echo "<h3><b>".$row["nome"]." ".$row["cognome"]."</b> Rating di <b>".$row["rating"]." ★</b></h3>";
  echo "<h4>".$row["testo"]."</h4>";
  echo "<hr></hr>";
  }
} else{
  echo "<div id='review-header'>";
  echo "<h3>RECENSIONI</h3>";
  echo "<hr></hr>";
  echo "<form action='form_recensione.php' method= 'post'>
     <input type ='submit' name='invio' value='Commenta' class='postButton'/>
     </form>";
  echo "</div>";
  echo "The table is empty";
}
echo "</div>";

?>
</body>
