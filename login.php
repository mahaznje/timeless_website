
<?php

session_start();

include('serveur/connection.php');

if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}

if(isset($_POST['login_btn'])){

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $mysqli->prepare("SELECT user_id,user_nom,user_email,user_password FROM users WHERE user_email= ? AND user_password = ? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);


  if($stmt->execute()){
    $stmt->bind_result($user_id,$user_nom,$user_email,$user_password);
    $stmt->store_result();

    if($stmt->num_rows() == 1){
      $row = $stmt->fetch();
      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_nom'] = $user_nom;
      $_SESSION['user_email'] = $user_email;
      $_SESSION['logged_in'] = true;
      header('location:account.php?message=Vous avez été connecté avec succès');


    }else{


    }

    header('location:login.php?error=Impossible de vérifier votre compte');


  }else{
    header('location:login.php?error=Une erreur s\'est produite');

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
             <!--Login-->
<div class="my-5 py-5 inscrit">
   <div class="container text-center mt-3 pt-3">
       <h2 class="form-weight-bold"> Connecter-Vous </h2>
       <hr class="mx-auto">
   </div>
   <div class="mx-auto container">
       <form action="login.php" method="POST" id="login-form">
       <p style="color:red;"> <?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p>

           <div class="form-group">
               <label for="">E-mail </label>
               <input type="text" class="form-control" id="login-email" name="email" placeholder="E-mail" required>

           </div>
           <div class="form-group">
            <label for="">Mot de passe </label>
            <input type="password" class="form-control" id="login-password" name="password" placeholder="Mot de passe" required>

        </div>
        <div class="form-group">
            <input type="submit" class="btn4" id="login-btn" value="Login"  name="login_btn">

        </div>
        <div class="form-group">
         <a href="inscription.php" id="register-url" class="btn4">vous n'avez pas de compte ? inscrivez-vous.</a>

        </div>
       </form>
   </div>
</div>




            </section>


     
<!-- newsletter section-->
<section class="newsletter">
         <div class="newsletter-content">
             <div class="newsletter-text">
                 <h2>
                 Rejoignez La liste!

                 </h2>
                 <p>Inscrivez-vous avec votre adresse e-mail pour recevoir nos actualités.</p>
             </div>
             <form action="">
                 <input type="email" placeholder="email" required>
                 <input type="submit" value="Abonner vous" class="btnnn">
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