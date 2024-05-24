<nav id="nav-wrapper" class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="nav-link" href="home.php"><img width=80 height=80 src="images/logo.png"><span class="sr-only"> HOME</span></a>|
  <a class="nav-link" href="addTrade.php">Nuovo Annuncio</a>|
  <?php echo ($_SESSION['tipo'] == 'admin' ? '<a class="nav-link" href="area_admin.php">AREA ADMIN</a>' : "")?>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a id="nav-profilo" class="nav-link" href="profilo.php"><?php echo "$email" ?><span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a id="nav-logout" class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>