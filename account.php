<?php
session_start();
include('serveur/connection.php');


if (isset($_SESSION['message'])) {
  echo "<p>" . $_SESSION['message'] . "</p>";
  unset($_SESSION['message']);

}
if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
  exit;
}
if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_nom']);
    unset($_SESSION['user_email']);
    unset($_SESSION['paniers'][$_SESSION['user_id']]);
    unset($_SESSION['user_id']);
    header('location: login.php');
    exit;
  }
}
function transferTempCart($user_id) {
  if (isset($_SESSION['panier_temp']) && !empty($_SESSION['panier_temp'])) {
      if (!isset($_SESSION['panier_' . $user_id])) {
          $_SESSION['panier_' . $user_id] = array();
      }
      $_SESSION['panier_' . $user_id] = array_merge($_SESSION['panier_' . $user_id], $_SESSION['panier_temp']);
      unset($_SESSION['panier_temp']);
  }
}


if (isset($_SESSION['commande_success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['commande_success'] . "</div>";
    unset($_SESSION['commande_success']);
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
        <section class="user-section">
  <div class="user-container">
    <div class="user-info">
      <h3>Espace utilisateur</h3>
      <hr>
      <div class="account-info" id="account-info">
        <p>Nom : <span><?php if(isset($_SESSION['user_nom'])){ echo $_SESSION['user_nom'];} ?></span></p>
        <p>E-mail : <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email'];} ?></span></p>
        <a href="account.php?logout=1" id="logout-btn" class="logout-btn">Déconnection</a>
      </div>
    </div>
    
    <div class="user-orders">
      <h3>Vos commandes</h3>
      <hr>
      <div class="order-tables">
        <?php 
        $user_id = $_SESSION['user_id'];
        $query_commandes = "SELECT * FROM commande WHERE user_id = ? ORDER BY `DateCommande` DESC";
        $stmt = $mysqli->prepare($query_commandes);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result_commandes = $stmt->get_result();

        if ($result_commandes && $result_commandes->num_rows > 0) {
        ?>
          <table class="command-table">
            <tr>
              <th>N° de commande</th>
              <th>Date de commandes</th>
              <th>Status</th>
              <th>Total payé</th>
            </tr>
            <?php while ($commande = $result_commandes->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $commande['command_id']; ?> </td>
                <td><?php echo $commande['DateCommande']; ?></td>
                <td><?php echo $commande['StatutCommande']; ?>
                <?php if ($commande['StatutCommande'] == 'En cours') { ?>
            <form method="post" action="serveur/annuler_commande.php">
                <input type="hidden" name="command_id" value="<?php echo $commande['command_id']; ?>">
                <input type="submit" name="annuler" class="btn-annule" value="Annuler la commande">
            </form> <?php } ?>
              </td>
                <td><?php echo $commande['MontantTotal']; ?> CHF</td>
        
              </tr>
            <?php } ?>
          </table>
            </div>
          <?php
          // Réinitialiser le pointeur de résultat
          $result_commandes->data_seek(0);
          while ($commande = $result_commandes->fetch_assoc()) {
          ?>
            <div class="commande">
              <h2>Commande #<?php echo $commande['command_id']; ?></h2>
              <table class="detail-table">
                <tr>
                  <th>Produits</th>
                  <th>Quantité</th>
                  <th>Prix unitaire</th>
                  <th>Total</th>
                </tr>
                <?php 
                $query_details = "SELECT d.*, p.produit_nom FROM detailcommande d 
                                  JOIN produit p ON d.produit_id = p.produit_id 
                                  WHERE d.commande_id = ?";
                $stmt_details = $mysqli->prepare($query_details);
                $stmt_details->bind_param("i", $commande['command_id']);
                $stmt_details->execute();
                $result_details = $stmt_details->get_result();
                
                if ($result_details && $result_details->num_rows > 0) {
                  while ($detail = $result_details->fetch_assoc()) {
                ?>
                  <tr>
                    <td class="cmd-detail">
                    <div onclick="window.location.href='un_produit.php?produit_id=<?php echo $detail['produit_id']; ?>'" >
                     <img class="cmd-img" src="img/<?php echo $detail['produit_img'];?>"> </div>
                            <?php echo $detail['produit_nom'];?>          
                    </td>
                    <td><?php echo $detail['produit_quantite']; ?></td>
                    <td><?php echo $detail['produit_montant']; ?> CHF</td>
                    <td><?php echo $detail['produit_quantite'] * $detail['produit_montant']; ?> CHF</td>
                  </tr>
                <?php 
                  }
                } else {
                  echo "<tr><td colspan='4'>Aucun détail de commande trouvé.</td></tr>";
                }
                ?>
              </table>
            </div>
          <?php
          }
        } else {
          echo "<p>Aucune commande n'a été faite.</p>";
        }
        ?>
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
        <div class="footer" id="footer">
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