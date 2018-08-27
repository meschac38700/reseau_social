<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">Boom social Network</a>

  <div class="navbar-collapse collapse" id="navbarColor02" style="">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo (active('')) ?>">
        <a class="nav-link" href="/">Accueil</a>
      </li>
      <?php if($_SERVER["REQUEST_URI"] != "/profile.php"):?>
      <li class="nav-item <?php echo (active('inscription.php'))?>">
        <a class="nav-link" href="inscription.php">Inscription</a>
      </li>

        <li class="nav-item <?php echo (active('connexion.php'))?>">
          <a class="nav-link" href="connexion.php">Connexion</a>
        </li>
      <?php endif?>
        <li class="nav-item <?php echo (active('deconnexion.php'))?>">
          <a class="nav-link" href="deconnexion.php">Deconnexion</a>
        </li>
    </ul>
  </div>
</nav>