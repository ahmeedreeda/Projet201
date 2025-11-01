<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - Agence Voyage</title>
  <!-- Lien CDN Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <h1 class="mb-4 text-primary">AGENCE VOYAGE</h1>
    <h2 class="mb-4">SE CONNECTER</h2>

    <form action="home.php" method="post" class="w-50 bg-white p-4 rounded shadow">
      <div class="mb-3">
        <label class="form-label">Nom d'utilisateur</label>
        <input type="text" name="userName" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="passWord" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Connexion</button>

      <!-- Lien vers l'inscription -->
      <div class="text-center mt-3">
        <span>Pas encore de compte ?</span>
        <a href="Inscription.php" class="text-decoration-none">Créer un compte</a>
      </div>
    </form>
  </div>

  <!-- Script Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<?php
    
        session_start();

            $server_Nom = 'localhost';
            $username = 'root';
            $password = '';
            $nom_DB = 'agence_voyage';
        if ( $_SERVER['REQUEST_METHOD'] == "POST"){
            $userName = $_POST['userName'];
            $passWord = $_POST['passWord'];
        }
        if(empty($userName) || empty($passWord)){
            //echo "tapez votre valeur";
            exit;
        }
        try {
                $connexion = new PDO("mysql:host=$server_Nom;dbname=$nom_DB", $username, $password);
                $sql = "SELECT * FROM clients WHERE userName = :userName AND passWord = :passWord";
                $vrf = $connexion->prepare($sql);
                $vrf->execute([
                    ':userName' => $userName,
                    ':passWord' => $passWord
                ]);
                $user = $vrf->fetch(PDO::FETCH_ASSOC);

                if ($user){
                    $_SESSION['userName'] = $user["userName"];
                    header("Location:home.php");
                    exit;
                }else{
                    echo "user or password incorect";
                    header("Location: conexion.php");

                    exit;
                }
            } catch (PDOException $ex) {
            echo $ex->getMessage();
            }
// dddd
    
    ?>
