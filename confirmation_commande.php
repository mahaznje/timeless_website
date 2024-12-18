<?php
session_start();
include('serveur/connection.php');

if (!isset($_SESSION['user_id']) || !isset($_SESSION['commande_en_cours'])) {
    header('Location: panier.php');
    exit;
}


if (isset($_POST['confirmer_commande'])) {
    $user_id = $_SESSION['user_id'];
    $montant_total = $_SESSION['total'];
    $adresse_livraison = $_POST['adresse_livraison'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $mode_paiement = $_POST['mode_paiement'];

    // Insérer la commande
    $stmt = $mysqli->prepare("INSERT INTO commande (user_id, MontantTotal, adresse_livraison, code_postal, ville, pays, mode_paiement) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("idssiss", $user_id, $montant_total, $adresse_livraison, $code_postal, $ville, $pays, $mode_paiement);

    if ($stmt->execute()) {
        $commande_id = $mysqli->insert_id;

        // Insérer les détails de la commande
        
        $sql_detail = "INSERT INTO detailcommande (commande_id, produit_id, produit_nom, produit_img, produit_quantite, produit_montant, produit_size) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_detail = $mysqli->prepare($sql_detail);
        $error_occurred = false;
        var_dump($_SESSION['panier']); // Pour déboguer
       
        foreach ($_SESSION['panier'] as $produit_key => $produit) {
            $produit_id = $produit['produit_id'];
            $produit_nom = $produit['produit_nom'];
            $produit_img = $produit['produit_img'];
            $produit_quantity = $produit['produit_quantity'];
            $produit_montant = $produit['produit_montant'];
            $produit_size = $produit['produit_size'];
        
            $stmt_detail->bind_param("iissids", 
                $commande_id, 
                $produit_id, 
                $produit_nom, 
                $produit_img, 
                $produit_quantity, 
                $produit_montant, 
                $produit_size
            );
            
            if (!$stmt_detail->execute()) {
                $error_occurred = true;
                echo "Erreur lors de l'insertion du produit : " . $mysqli->error;
                var_dump($produit);
                break;
            }
        }
        if (!$error_occurred) {
            // Vider le panier après la commande
            if (isset($_SESSION['user_id'])) {
                $_SESSION['panier_' . $_SESSION['user_id']] = array();
            } else {
                $_SESSION['panier_temp'] = array();
            }
            $_SESSION['panier'] = array();
            $_SESSION['total'] = 0;
            unset($_SESSION['commande_en_cours']);
        
            // Forcer la sauvegarde de la session
            session_write_close();
        
            // Rediriger vers la page de compte
            header('Location: account.php');
            exit;
        } else {
            echo "Erreur lors de l'enregistrement des détails de la commande.";
        }
    } else {
        echo "Erreur lors de l'enregistrement de la commande : " . $mysqli->error;
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
           <div class="inscrit">
             <div class="container text-center mt-3 pt-3">
                     <h1>Confirmation de commande</h1>
            </div>
             <form method="post" action="" class="conf-adresse">
             <div class="form-group">
             <label for="adresse_livraison">Adresse de livraison :</label>
             <textarea name="adresse_livraison" id="adresse_livraison"  class="form-control" required></textarea> 
             </div>
              <div class="form-group">
               <label for="code_postal">Code postal :</label>
             <input type="text" name="code_postal" id="code_postal"  class="form-control" required>
             </div>
             <div class="form-group">
             <label for="ville">Ville :</label>
             <input type="text" name="ville" id="ville"  class="form-control" required>
             </div>
             <div class="form-group">
             <label for="pays">Pays :</label>
             <input type="text" name="pays" id="pays"  class="form-control" required>
             </div>
             <div class="form-group">
             <p>Mode de paiement :</p>
             <label>
                 <input type="radio" name="mode_paiement" value="Paiement à la livraison" checked required>
                 Paiement à la livraison
             </label>
             </div>
             <div class="form-group">
             <input type="submit" name="confirmer_commande" value="Confirmer la commande"  class="btn4">
             </div>
        </div>
        </form>
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