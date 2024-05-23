<!doctype html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link href="stylesheet/nav.css" rel="stylesheet" type="text/css">
<link href="stylesheet/form_recensione.css" rel="stylesheet" type="text/css">
<title>BOOOOK • libro</title>
</head>
<?php 

session_start();

$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$email = $_SESSION['email'];
$id_libro= $_SESSION['id_libro'];

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
<?php include 'navbar.php' ?>
<?php
     $sql = "SELECT * FROM info_libri WHERE id_info_libro = $id_libro";

     $result= $conn->query($sql);

     while($row= $result->fetch_assoc())
  {
      echo "<h2>Stai recensendo il libro: ".$row["titolo"]."</h2>";
  }
   
?>

<h2></h2>
<form action='addComment.php' method= 'post'>
    <p>Rating:<p><input type='number' name='rating' min='1' max='5' value='1'/>
    <p>Commento:<p>
    <input id="comment-text" type="text" name="commento"><br>
    <input type ='hidden' name='id_libro' value=<?php echo $id_libro ?>>
    <input type="submit" value="Invia">
</form>
</body>
</html>