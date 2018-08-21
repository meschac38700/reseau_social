<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Boom social Network</a>

  <div class="navbar-collapse collapse" id="navbarColor02" style="">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/index.php')?'active':'' ?>">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>
      <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/inscription.php')?'active':'' ?>">
        <a class="nav-link" href="inscription.php">Inscription</a>
      </li>
      <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/connexion.php')?'active':'' ?>">
        <a class="nav-link" href="connexion.php">Connexion</a>
      </li>
      <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/deconnexion.php')?'active':'' ?>">
        <a class="nav-link" href="deconnexion.php">Deconnexion</a>
      </li>
    </ul>
  </div>
</nav>