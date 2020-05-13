<header>
  <div class="container-fluid d-block d-md-flex position-relative no-side-padding">

    <a href="#" class="logo"><img src="assets/images/logo.png" alt="Logo Image"></a>

    <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

    <ul class="main-menu visible-on-click" id="main-menu">
      <li><a href="index.php">Skelbimai</a></li>
      <?php if (login_v()): ?>
      <li><a href="feedback.php">Atsiliepimai</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown">
          Profilis
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="myprofile.php">Mano profilis</a>
          <a class="dropdown-item" href="collection.php">Mano kolekcija</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Atsijungti</a>
        </div>
      </li>

      <?php endif; ?>
      <?php if (login_v()): ?>
      <li class="special"><span class=""><?php echo $_SESSION['u_name']; ?> </span></li>
      <?php endif; ?>
      <?php if (!login_v()): ?>
      <li><a href="signup.php">Registruotis</a></li>
      <li><a href="login.php">Prisijungti</a></li>
      <?php endif; ?>
    </ul><!-- main-menu -->


  </div><!-- container -->
</header>
