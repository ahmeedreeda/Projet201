<?php

    $server_Nom = 'localhost';
    $username = 'root';
    $password = '';
    $nom_DB = 'agence_voyage';
    try {
        $connexion = new PDO("mysql:host=$server_Nom", $username, $password);
        //echo"<h3 style='color: green;'>RAH TCONECTA</h3>";
    } catch (Exception $e) {
        echo"<h3 style='color: red;'>ERRROR</h3>". $e;
    }
    $connexion->exec("CREATE DATABASE IF NOT EXISTS $nom_DB");


    $connexion = new PDO("mysql:host=$server_Nom;dbname=$nom_DB", $username, $password);


    try {
        $connexion->exec("CREATE TABLE IF NOT EXISTS voyages(
                            codeVoyages INT PRIMARY KEY,
                            destination VARCHAR(30),
                            duree VARCHAR(4),
                            categorie VARCHAR(15),
                            prixHT FLOAT
                        );");
        $connexion->exec("CREATE TABLE IF NOT EXISTS  clients (
                            numclient INT PRIMARY KEY,
                            nomclient VARCHAR(30),
                            prenomClient VARCHAR(30),
                            dateNaiss DATE,
                            userName VARCHAR(30) UNIQUE,
                            PASSWORD VARCHAR(30) 
                        );");
        $connexion->exec("CREATE TABLE IF NOT EXISTS reservations  (
                            numclient INT,
                            codeVoyages INT,
                            nombrePersonnes INT,
                            datereservation DATE,
                            PRIMARY KEY (numclient, codeVoyages), 
                            FOREIGN KEY (numclient) REFERENCES clients(numclient),
                            FOREIGN KEY (codeVoyages) REFERENCES voyages(codeVoyages)
                        );");
            
        //echo"<h3 style='color: green;'>SAFI KOLCHI HOWA HADAK</h3>";

        } catch (Exception $ex) {
        echo"<h3 style='color: red;'>KAYEN MOCHKIL ===> </h3>". $e;
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light" style="text-align: center;">

  <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <h1 class="mb-4 text-primary">BIENVENUE SUR AGENCE VOYAGE</h1>
    <h2 class="mb-4">CRÉER UN COMPTE</h2>

    <form action="" method="post" class="w-50 bg-white p-4 rounded shadow">
      <div class="mb-3">
        <label class="form-label">Nom Client</label>
        <input type="text" name="nom_Client" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Prénom Client</label>
        <input type="text" name="prenom_Client" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Date de Naissance</label>
        <input type="date" name="date_Naissance" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Nom d'utilisateur</label>
        <input type="text" name="userName" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="passWord" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Créer le compte</button>

      <!-- Lien vers la page de connexion -->
      <div class="text-center mt-3">
        <span>Déjà inscrit ?</span>
        <a href="conexion.php" class="text-decoration-none">Se connecter</a>
      </div>
    </form>
  </div>

  <!-- Script Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    session_start();
    if (isset($_POST['nom_Client']) && isset($_POST['prenom_Client']) &&isset($_POST['date_Naissance'] ) && isset($_POST['userName'])  && isset($_POST['passWord'])){
        if (!empty($_POST['nom_Client']) && !empty($_POST['prenom_Client']) && !empty($_POST['date_Naissance'] ) && !empty($_POST['userName'])  && !empty($_POST['passWord'])){
            $nom_Client = $_POST['nom_Client'];
            $prenom_Client =$_POST['prenom_Client'];
            $date_Naissance =$_POST['date_Naissance'];
            $userName =$_POST['userName'];
            $passWord =$_POST['passWord'];

            $inscription_Client = $connexion->prepare('INSERT INTO clients (nomclient,prenomClient,dateNaiss,userName,PASSWORD) VALUES (:nom_Client,:prenom_Client, :date_Naissance,:userName,:passWord)');
            $inscription_Client->execute([
                ':nom_Client' => $nom_Client,
                ':prenom_Client' => $prenom_Client,
                ':date_Naissance' => $date_Naissance,
                ':userName' => $userName,
                ':passWord' => $passWord
            ]);
            echo "<h3 style='color: green; text-align: center' > Le Client a ete bien ajoutee !!!</h3>";
        }else{
            echo"Tous Les champs obligatoire";
            }

        
    }


?>



















