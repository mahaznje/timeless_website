



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <title>TimeLess Shop</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/produit.css">

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
                
      
            <!--produit-->
          
<!--Produit-->
<?php 
    include('serveur/connection.php');
    if(isset($_GET['produit_id'])){
        $produit_id = $_GET['produit_id'];
        $stmt = $mysqli->prepare("SELECT * FROM produit WHERE produit_id = ?");
        $stmt->bind_param("i", $produit_id);
        $stmt->execute();
        $produit = $stmt->get_result();
    }
    ?>

    <div class="un-produit">
        <?php while($row = $produit->fetch_assoc()){ ?>
            <div class="row-img">
                <img src="img/<?php echo $row['produit_img']; ?>" alt="produit">
            </div>
            <div class="row-detail">
                <h2><?php echo $row['produit_nom']; ?></h2>
                <h3><?php echo $row['produit_montant']; ?> CHF</h3>
                <span><?php echo $row['produit_description']; ?></span>
                <button id="openSizeModal">Sélectionnez votre taille </button>
                <div id="selectedSize"></div>
             
                <form method="POST" action="panier.php" id="produit-form">
                    <input type="hidden" name="produit_id" value="<?php echo $row['produit_id']; ?>">
                    <input type="hidden" name="produit_nom" value="<?php echo $row['produit_nom']; ?>">
                    <input type="hidden" name="produit_montant" value="<?php echo $row['produit_montant']; ?>">
                    <input type="hidden" name="produit_img" value="<?php echo $row['produit_img']; ?>">
                    <label for="produit_quantity" id="q-text"> Quantité </label>
                    <input type="number" name="produit_quantity" value="1" id="produit-quantity">
                    <input type="hidden" name="produit_size" id="produit_size">
                    <button class="buy-btn" type="submit" name="add_cart" id="add-to-cart">Ajoute au panier</button>
                </form>
            </div>
        <?php } ?>
    </div>

    <!-- Fenêtre modale -->

<div id="sizeModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Choisissez votre taille</h2>
        <div class="size-options">
            <span data-size="xs">XS</span>
            <span data-size="s">S</span>
            <span data-size="m">M</span>
            <span data-size="l">L</span>
            <span data-size="xl">XL</span>
        </div>
    </div>
</div>

                  <!--brands-->
                  <div class="brands">
               <div class="main-brands">
               <?php include('serveur/get_brands.php');?>

            <?php while($row = $featured_produit->fetch_assoc()) { ?>
           <div onclick="">
                   <div class="brands-c">
                   <img src="img/<?php echo $row['brand_img']; ?>">
                   </div>
                

               </div>
               <?php } ?>
            </div>
            </div>
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