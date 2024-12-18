<?php
include('serveur/connection.php');

if(isset($_GET['brand_id'])) {
    $brand_id = $_GET['brand_id'];
    
// Récupérer les informations de la marque
$brand_query = "SELECT * FROM brands WHERE brand_id = ?";
$stmt = $mysqli->prepare($brand_query);
$stmt->bind_param("i", $brand_id);
$stmt->execute();
$brand_result = $stmt->get_result();
$brand = $brand_result->fetch_assoc();
$brand_result->free();
$stmt->close();

// Récupérer les produits de la marque
$produits_query = "SELECT * FROM produit WHERE produit_brand = ?";
$stmt = $mysqli->prepare($produits_query);
$stmt->bind_param("s", $brand['brand_nom']);
$stmt->execute();
$produits_result = $stmt->get_result();

} else {
    // Rediriger vers la page des marques si aucun ID de marque n'est spécifié
    header("Location: brands.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <title>TimeLess Shop</title>
        <link rel="stylesheet" href="css/style.css">
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
     
    <?php


try {

    if ($brand) {
        echo " <section class='selling'>
        <div class='center-text'>
            <h2>Les produits de 
    " . htmlspecialchars($brand['brand_nom']) . "</h2>
    </div>
    <div class='selling-content'>

    ";
    } else {
        echo "<h2>Marque non trouvée</h2>";
    }
    
    // Assurez-vous que $stmt est toujours ouvert ici
    if ($produits_result->num_rows > 0) {
        while($produit = $produits_result->fetch_assoc()) {

            ?>

             <div class="col brand-p" onclick="window.location.href='un_produit.php?produit_id=<?php echo htmlspecialchars($produit['produit_id']); ?>'">
                <div class="col-img">
                <img src="img/<?php echo htmlspecialchars($produit['produit_img']); ?>" alt="<?php echo htmlspecialchars($produit['produit_nom']); ?>">
                </div>
                <div class="col-icon">
                   <a href="un_produit.php?produit_id=<?php echo htmlspecialchars($produit['produit_id']); ?>"> <i class="ri-eye-line"></i></a>
                </div>

            </div>
            
            <?php
        }
        echo " </div>
        </section>";
    } else {
        echo "<p>Aucun produit trouvé pour cette marque.</p>";
    }
    
    // Libérez le résultat et fermez le statement après utilisation
    mysqli_free_result($produits_result);
    $stmt->close();} catch (mysqli_sql_exception $e) {
    echo "Erreur MySQL : " . $e->getMessage();
    // Vous pouvez également logger l'erreur pour un débogage ultérieur
    error_log("Erreur MySQL dans brand_produits.php : " . $e->getMessage());
}
?>

            <!--Feature-->
            <section class="feature">
    <div class="feature-content">
        <div class="box">
            <div class="f-icon">
                <i class="ri-bank-card-fill"></i>
            </div>
            <div class="f-text">
            <h3>Paiement à la livraison</h3>
                <p>
                    Profitez de la commodité du paiement à la livraison. Commandez vos articles préférés en ligne et payez en toute sécurité lorsque vous les recevez chez vous.
                </p>
            </div>
        </div>
        <div class="box">
            <div class="f-icon">
                <i class="ri-customer-service-fill"></i>
            </div>
            <div class="f-text">
                <h3>35 jours de retour</h3>
                <p>
                    Achetez en toute confiance avec notre politique de retour de 35 jours. Si vous n'êtes pas entièrement satisfait de votre achat, retournez-le facilement pour un échange ou un remboursement.
                </p>
            </div>
        </div>
        <div class="box">
            <div class="f-icon">
                <i class="ri-truck-fill"></i>
            </div>
            <div class="f-text">
                <h3>Livraison gratuite</h3>
                <p>
                    Bénéficiez de la livraison gratuite sur toutes vos commandes. Nous nous engageons à vous offrir une expérience d'achat sans tracas, avec des livraisons rapides et fiables directement à votre porte.
                </p>
            </div>
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
        
         </main>

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