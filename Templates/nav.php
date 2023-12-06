<!-- navbar section -->
<nav class="navbar navbar-expand-lg sticky bg-warning">
  <div class="container-lg mt-2 mb-2">
    <a class="navbar-brand" href="index.php" alt="brand">
      <img src="../Assets/logo.svg">
    </a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class='bx bx-menu-alt-left'></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link me-4" aria-current="page" href="../subscribe/subscribePetSitter.php">Devenez pet sitter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-4" href="../subscribe/subscribeMaster.php">S’inscrire</a>
        </li>
        
        <li class="nav-item dropdown text-end">
        <?php
        if (!isset($_SESSION['user'])){ 
         echo '<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="../subscribe/login.php" role="button" aria-haspopup="true" aria-expanded="false">Se connecter</a>';
        }
        ?>

          
            <?php
            if (isset($_SESSION['user'])){
            ?>
            <div class="dropdown-menu" data-bs-popper="static">
            <a class="dropdown-item" href="#">Mon profil</a>
            <a class="dropdown-item" href="#">Mes réservations</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Me déconnecter</a>
            <?php
            }
            ?>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>