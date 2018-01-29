<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="../index.php">HOME</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="index.php">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="TN News portal">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#news_dropdown" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-file"></i>
          <span class="nav-link-text">TN News portal</span>
        </a>
        <ul class="sidenav-second-level collapse" id="news_dropdown">
          <li>
            <a href="./news.php">Pregledaj članke</a>
          </li>
          <li>
            <a href="news.php?source=add_news.php">Dodaj članak</a>
          </li>
        </ul>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Kategorije">
        <a class="nav-link" href="categories.php">
          <i class="fa fa-fw fa-sitemap"></i>
          <span class="nav-link-text">Kategorije</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Komentari">
        <a class="nav-link" href="comments.php">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Komentari</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Korisnici">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#users_dropdown" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">Korisnici</span>
        </a>
        <ul class="sidenav-second-level collapse" id="users_dropdown">
          <li>
            <a href="users.php">Dohvati sve korisnike</a>
          </li>
          <li>
            <a href="users.php?source=add_user">Ddodaj novog korisnika</a>
          </li>
        </ul>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Moj profil">
        <a class="nav-link" href="profile.php">
          <i class="fa fa-fw fa-wrench"></i>
          <span class="nav-link-text">Moj profil</span>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>

    <!-- Top Menu Items -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle mr-lg-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i> <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?> <b class="caret"></b></a>
            <ul class="dropdown-menu" aria-labelledby="alertsDropdown">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Odjava</a>
                </li>
            </ul>
        </li>

      <!-- <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-fw fa-sign-out"></i>Logout</a>
      </li> -->
    </ul>
  </div>
</nav>
