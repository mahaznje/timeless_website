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
                 <li><a href="#brands"> Brands</a></li>
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
                <div class="home-text">
                    <h6>L'élégance intemporelle à portée de main avec</h6>
                    <h1> Timeless Shop</h1>
                    <p id="brands">
                        Votre destination pour des vêtements élégants et durables. Notre collection soigneusement sélectionnée met en valeur des pièces classiques qui transcendent les tendances éphémères.
                    </p>
                    <a href="produits.php" class="btn"> Shop now <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </section>
            <!--brands-->
            <div class="brands" >
   <div class="main-brands">
    <?php include('serveur/get_brands.php');?>
    <?php while($row = $featured_produit->fetch_assoc()) { ?>
      <div>
        <a href="brand_produits.php?brand_id=<?php echo $row['brand_id']; ?>">
          <div class="brands-c">
            <img src="img/<?php echo $row['brand_img']; ?>" alt="<?php echo $row['brand_nom']; ?>">
          </div>
        </a>
      </div>
     <?php } ?>
    </div>
  </div>
            <!--produit-->
            <section class="n-produit">
                <?php include('serveur/index_get_produits.php');?>

  <!--un-->
    


                <div class="center-text">
                    <h2>Tous les produits</h2>
                </div>
                <div class="n-content">
    <?php while($row = $featured_produit->fetch_assoc()) { ?>
        <div onclick="window.location.href='un_produit.php?produit_id=<?php echo $row['produit_id']; ?>'" class="row">
            <div class="row-img">
                <img src="img/<?php echo $row['produit_img']; ?>">
            </div>
            <h3><?php echo $row['produit_nom']; ?></h3>
            <div class="stars">
                <?php
                $rating = $row['produit_stars'];
                $fullStars = floor($rating);
                $hasHalfStar = ($rating - $fullStars) >= 0.5;

                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $fullStars) {
                        echo '<a href="#"><i class="ri-star-fill"></i></a>';
                    } elseif ($i == $fullStars + 1 && $hasHalfStar) {
                        echo '<a href="#"><i class="ri-star-half-fill"></i></a>';
                    } else {
                        echo '<a href="#"><i class="ri-star-line"></i></a>';
                    }
                }
                ?>
            </div>
            <div class="row-in">
                <div class="row-left">
                    <a href="#">
                        <i class="ri-shopping-cart-fill"></i>
                    </a>
                </div>
                <div class="row-right">
                    <h6><?php echo $row['produit_montant']; ?> CHF</h6>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

             <div class="n-btn">
                 <a href="produits.php" class="btn2">Voir tout</a>

             </div>
            </section>
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
<!--best seller-->
    <?php include('serveur/produit_noter.php');?>
     <section class="selling">
        <div class="center-text">
            <h2>Les plus Noter</h2>
        </div>
        <div class="selling-content" >
            <?php 

        if ($result->num_rows > 0) {
            // Affichage des produits
            while($row = $result->fetch_assoc()) { ?>
            <div class="col" onclick="window.location.href='un_produit.php?produit_id=<?php echo $row['produit_id']; ?>'">
                <div class="col-img">
                    <img  src="img/<?php echo $row['produit_img']; ?>" >
                </div>
                <div class="col-icon">
                <a href="un_produit.php?produit_id=<?php echo htmlspecialchars($produit['produit_id']); ?>"> <i class="ri-eye-line"></i></a>
                   

                </div>

            </div>
<?php     }
        } else {
            echo "Aucun produit trouvé";
        }
        ?>
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
    <div class="footer-box" id="footer">
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