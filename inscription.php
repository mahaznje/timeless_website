<?php

session_start();

include('serveur/connection.php');
if ($mysqli->connect_error) {
    die('Erreur de connexion à la base de données : ' . $mysqli->connect_error);
} else if (isset($_POST['inscrit_page'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $adresse = $_POST['adresse'];
    $tel = $_POST['tel']; // Ajoutez cette ligne si ce n'est pas déjà fait

    if ($password != $confirmpassword) {
        header('Location: inscription.php?error=Les mots de passe ne sont pas compatibles.');
    } else {
        $stmt1 = $mysqli->prepare("SELECT count(*) FROM users WHERE user_email=?");
        if ($stmt1) {
            $stmt1->bind_param('s', $email);
            $stmt1->execute();
            $stmt1->store_result();
            $stmt1->bind_result($num_rows);
            $stmt1->fetch();
        }
        if ($num_rows != 0) {
            header('Location: inscription.php?error=L\'adresse e-mail est déjà enregistrée');
        } else {
            $hashed_password = md5($password); // Hashage du mot de passe
            
            $stmt2 = $mysqli->prepare("INSERT INTO users (user_nom, user_email, user_password, user_adresse, user_tel) VALUES (?, ?, ?, ?, ?)");
            if ($stmt2) {
                $stmt2->bind_param('sssss', $nom, $email, $hashed_password, $adresse, $tel);
                if ($stmt2->execute()) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_nom'] = $nom;
                    $_SESSION['logged_in'] = true;
                    header('Location: account.php?inscrit_page=Vous avez été enregistré avec succès.');
                } else {
                    header('Location: inscription.php?error=Une erreur s\'est produite lors de la création du compte.');
                }
            } else {
                header('Location: inscription.php?error=Erreur lors de la préparation de la requête d\'insertion.');
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <title>TimeLess Shop</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/login.css">

        <!--boxin-icon-link-->
        <link rel="stylesheet"
        href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <!--remix-icon-link-->
        <link  href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
        <!--google font-icon-link-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      
    </head>
    <body>
    <header>
             <a href="index.php" class="logo"> TimeLess Shop </a>
             <ul class="navlist">
                 <li><a href="produits.php"> Shop</a></li>
                 <li><a href="produits.php"> On Sale</a></li>
                 <li><a href="index.php#brands"> Brands</a></li>
                 <li><a href="contact.php"> Contact</a></li>
          </ul>
          <div class="nav-right">
              <a href="panier.php"> <i class="ri-shopping-cart-line"></i></a>
              <a href="login.php"> <i class="ri-user-line"></i></a>
              <div class="bx bx-menu" id="menu-icon"></div>

          </div>
        </header>
        <main>
            <!--home-->
            <section class="home">
               <!--Inscription-->
<section class="my-5 py-5 inscrit">
   <div class="container text-center mt-3 pt-3">
       <h2 class="form-weight-bold"> Inscrivez-Vous </h2>
   </div>
   <div class="mx-auto container">
   
       <form id="inscrit-form" method="POST" action="inscription.php">
         <p style="color:red;"> <?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p>
        <div class="form-group">
            <label>Nom </label>
            <input type="text" class="form-control" id="inscrit-nom" name="nom" placeholder="name" required>
    
        </div>
           <div class="form-group">
               <label >E-mail </label>
               <input type="text" class="form-control" id="inscrit-email" name="email" placeholder="E-mail" required>

           </div>
           <div class="form-group">
            <label>Mot de passe </label>
            <input type="password" class="form-control" id="inscrit-password" name="password" placeholder="Mot de passe" required>

        </div>
        <div class="form-group">
            <label>Confirmez le Mot de passe </label>
            <input type="password" class="form-control" id="inscrit-conform-password" name="confirmpassword" placeholder="Confirmez le Mot de passe" required>

        </div>
        <div class="form-group">
          <label>Votre Adresse </label>
          <input type="text" class="form-control" id="inscrit-adresse" name="adresse" placeholder="Adresse" required>

      </div>
      <div class="form-group">
          <label>Numero de Téléphone </label>
          <input type="text" class="form-control" id="inscrit-tel" name="tel" placeholder="Téléphone" required>

      </div>
        <div class="form-group">
            <button type="submit" class="btn4" id="inscrit-btn" name="inscrit_page" > inscrivez vous</button>

        </div>
        <div class="form-group">
            <a href="login.php" id="login-url" class="btn4">vous avez un compte ? connectez-vous.</a>
   
           </div>
       </form>
   </div>
</section>


     

        </main>
        <div class="footer"  id="footer">> 
    <div class="footer-box">
        <h3>Entreprise</h3>
        <a href="#">À propos</a>
        <a href="#">Nos services</a>
        <a href="#">Réalisations</a>
        <a href="#">Carrières</a>
    </div>
    <div class="footer-box">
        <h3>FAQ</h3>
        <a href="#">Questions fréquentes</a>
        <a href="#">Livraison</a>
        <a href="#">Retours</a>
        <a href="#">Paiement</a>
    </div>
    <div class="footer-box">
        <h3>Ressources</h3>
        <a href="#">Blog</a>
        <a href="#">Guide des tailles</a>
        <a href="#">Entretien des vêtements</a>
        <a href="#">Lookbook</a>
    </div>
    <div class="footer-box">
        <h3>Réseaux sociaux</h3>
        <div class="social">
            <a href="#"><i class="ri-facebook-fill"></i></a>
            <a href="#"><i class="ri-instagram-fill"></i></a>
            <a href="#"><i class="ri-twitter-fill"></i></a>
        </div>
    </div>
</div>

    <!--copyright-->
    <div class="copyright">
        <div class="end-text">
            <p>CopyRight 2024 by Timeless Shop</p>

        </div>
        <div class="end-img">
            <img src="img/card.png">

        </div>
    </div>
      <script src="js/script.js"></script>
    </body>
</html>