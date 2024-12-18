<?php
session_start();


function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

if (!isset($_SESSION['user_id'])) {
    if (!isset($_SESSION['panier_temp'])) {
        $_SESSION['panier_temp'] = array();
    }
    $_SESSION['panier'] = &$_SESSION['panier_temp'];
} else {
    if (!isset($_SESSION['panier_' . $_SESSION['user_id']])) {
        $_SESSION['panier_' . $_SESSION['user_id']] = array();
    }
    $_SESSION['panier'] = &$_SESSION['panier_' . $_SESSION['user_id']];
}
// Fonction pour calculer le total du panier
function calculateTotalPanier() {
    $total = 0;
    if (!empty($_SESSION['panier'])) {
        foreach ($_SESSION['panier'] as $produit) {
            $total += ($produit['produit_montant'] ?? 0) * ($produit['produit_quantity'] ?? 0);
        }
    }
    $_SESSION['total'] = $total;
}
// Ajouter un produit au panier
if (isset($_POST['add_cart'])) {
    if (isset($_POST['produit_id'], $_POST['produit_nom'], $_POST['produit_montant'], $_POST['produit_img'], $_POST['produit_quantity'], $_POST['produit_size']) && !empty($_POST['produit_size'])) {
        $produit_id = $_POST['produit_id'];
        $produit_size = $_POST['produit_size'];
        $produit_key = $produit_id . '_' . $produit_size;
        $_SESSION['panier'][$produit_key] = array(
            'produit_id' => $produit_id,
            'produit_nom' => $_POST['produit_nom'],
            'produit_montant' => floatval($_POST['produit_montant']),
            'produit_img' => $_POST['produit_img'],
            'produit_quantity' => intval($_POST['produit_quantity']),
            'produit_size' => $produit_size
        );

        // Sauvegardez le panier mis à jour dans la session
        if (isset($_SESSION['user_id'])) {
            $_SESSION['panier_' . $_SESSION['user_id']] = $_SESSION['panier'];
        } else {
            $_SESSION['panier_temp'] = $_SESSION['panier'];
        }

        calculateTotalPanier();
        header('Location: panier.php');
        exit;
    }
}

// Supprimer un produit du panier
if (isset($_POST['delete_produit'])) {
    $produit_id = $_POST['produit_id'];
    $produit_size = $_POST['produit_size'];
    $produit_key = $produit_id . '_' . $produit_size;
    if (isset($_SESSION['panier'][$produit_key])) {
        unset($_SESSION['panier'][$produit_key]);
        // Sauvegardez le panier mis à jour
        if (isset($_SESSION['user_id'])) {
            $_SESSION['panier_' . $_SESSION['user_id']] = $_SESSION['panier'];
        } else {
            $_SESSION['panier_temp'] = $_SESSION['panier'];
        }
        calculateTotalPanier();
    }
    header('Location: panier.php');
    exit;
}
// Après la suppression d'un produit


// Modifier la quantité d'un produit dans le panier
if (isset($_POST['modif_produit'])) {
    $produit_id = $_POST['produit_id'];
    $produit_size = $_POST['produit_size'];
    $produit_key = $produit_id . '_' . $produit_size;
    $produit_quantity = $_POST['produit_quantity'];
    if (isset($_SESSION['panier'][$produit_key])) {
        $_SESSION['panier'][$produit_key]['produit_quantity'] = $produit_quantity;
        // Sauvegardez le panier mis à jour
        if (isset($_SESSION['user_id'])) {
            $_SESSION['panier_' . $_SESSION['user_id']] = $_SESSION['panier'];
        } else {
            $_SESSION['panier_temp'] = $_SESSION['panier'];
        }
        calculateTotalPanier();
    }
    header('Location: panier.php');
    exit;
}
// Affichage du panier

// commander
include('serveur/connection.php');
if (isset($_POST['commander']) && !empty($_SESSION['panier'])) {
    if (isUserLoggedIn()) {
        $user_id = $_SESSION['user_id'];
        $montant_total = $_SESSION['total'];
        $_SESSION['commande_en_cours'] = true;
        header('Location: confirmation_commande.php');
        exit;
    } else {
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="utf-8">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <title>TimeLess Shop</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/panier.css">

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
        <section class="panier-section">
                
    <form method="post" action="">

        <h1>Votre panier</h1>
       
        <?php if (!empty($_SESSION['panier'])): ?>
    <table>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Taille</th>
            <th>Prix</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php foreach ($_SESSION['panier'] as $produit_key => $produit): ?> 
             <tr>
            <td>
    
                    <div onclick="window.location.href='un_produit.php?produit_id=<?php echo htmlspecialchars($produit['produit_id'] ?? ''); ?>'" >
                     <img src="img/<?php echo htmlspecialchars($produit['produit_img'] ?? '');?>"> </div>
                            <?php echo htmlspecialchars($produit['produit_nom'] ?? '');?>          
                      </td>
                   
                    <td>
            <form method='post' action='panier.php'>
                <input type='hidden' name='produit_id' value='<?php echo htmlspecialchars($produit['produit_id'] ?? ''); ?>'>
                <input type='hidden' name='produit_size' value='<?php echo htmlspecialchars($produit['produit_size'] ?? '');?>'>
                <input type='number' name='produit_quantity' value='<?php echo htmlspecialchars($produit['produit_quantity'] ?? ''); ?>' min='1'>
                <input type='submit' name='modif_produit' value='Modifier' class='btn3 btn-update'>
            </form>
          </td><td><?php echo htmlspecialchars($produit['produit_size'] ?? ''); ?></td>
                     <td><?php echo number_format($produit['produit_montant'] ?? 0, 2); ?> CHF</td>
                     <td><?php echo number_format(($produit['produit_montant'] ?? 0) * ($produit['produit_quantity'] ?? 0), 2); ?> CHF</td>
                    <td>
            <form method='post' action='panier.php'>
                  <input type='hidden' name='produit_id' value='<?php echo htmlspecialchars($produit['produit_id'] ?? ''); ?>'>
                <input type='hidden' name='produit_size' value='<?php echo htmlspecialchars($produit['produit_size'] ?? '');?>'>
                <input type='submit' name='delete_produit' value='Supprimer' class='btn3 btn-delete'>
            </form>
          </td>
                </tr>
                <?php endforeach; ?>
        </table>
    <p class="total">Total : <?php echo number_format($_SESSION['total'] ?? 0, 2); ?> CHF</p>
    <button type="submit" name="commander" class="commander">Commander</button>
<?php  else:?>
    <p class='empty-cart'> Votre panier est vide.</p>
    <?php endif;?>

      
        </section>
    </main>


     
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