<!doctype html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="loginStyle.css">
<title>Booook ● libro </title>
</head>
<?php 

session_start();
$_SESSION['nome']="MEOW";
$_SESSION['cognome']="BAU";

$nome= $_SESSION['nome'];
$cognome= $_SESSION['cognome'];
$id_libro= $_GET['id_libro'];

    $servername = "localhost";
    $username = "root"; 
    $pw = ""; 
    $dbname = "booook";

    $conn = new mysqli($servername, $username, $pw, $dbname);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }




    $sql = "SELECT * FROM info_libri WHERE id_info_libro = $id_libro";

    $result= $conn->query($sql);

    if($result->num_rows >0)
{
} else{
    echo "The table is empty";
}
?>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href=""><?php echo "$nome"." "."$cognome" ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link" href="annunci.php">Annunci<span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="profilo.php">Profilo<span class="sr-only"></span></a>
    </li>
      </ul>
      </div>
</nav>

