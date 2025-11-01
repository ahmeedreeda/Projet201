<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil - Agence Voyage</title>
  <!-- Lien CDN Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>




  <!-- Barre de navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Agence Voyage</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reservation.php">Réserver</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Déconnexion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contenu principal -->




  
  <div class="container mt-5 text-center">
<?php
    session_start();

    if (!isset($_SESSION['userName'])) {
        header("Location: conexion.php");
        exit();
    }

    $user = $_SESSION['userName'];
    echo "<h1 class='text-primary'>Bienvenue sur Agence Voyage " . htmlspecialchars($user) . "</h1>";
    ?>
    <p class="lead">Réservez vos voyages facilement et rapidement !</p>

    <div class="mt-4">
      <a href="reservation.php" class="btn btn-success btn-lg">Faire une réservation</a>
    </div>
  </div>
  

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
