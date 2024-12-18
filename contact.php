<?php
session_start();

include('serveur/connection.php');
require 'vendor/autoload.php';

use SendGrid\Mail\Mail;

if(isset($_POST['submit_contact'])){
    $name = $_POST['name'];
    $userEmail = $_POST['email'];
    $message = $_POST['message'];

    $email = new Mail();
    $email->setFrom("timeless@gmail.com", "TimeLess Shop");
    $email->setSubject("Nouveau message de contact de $name");
    $email->addTo("Timeless@gmail.com", "Recipient Name");
    $email->addContent(
        "text/plain", 
        "Nom: $name\nEmail: $userEmail\n\nMessage:\n$message"
    );

    $sendgrid = new \SendGrid('YOUR_SENDGRID_API_KEY');

    try {
        $response = $sendgrid->send($email);
        $success_message = "Votre message a été envoyé avec succès. Nous vous contacterons bientôt.";
    } catch (Exception $e) {
        $error_message = "Une erreur s'est produite lors de l'envoi du message: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact - TimeLess Shop</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="index.php" class="logo">TimeLess Shop</a>
        <ul class="navlist">
            <li><a href="produits.php">Shop</a></li>
            <li><a href="produits.php">On Sale</a></li>
            <li><a href="index.php#brands">Brands</a></li>
            <li><a href="contact.php"> Contact</a></li>
        </ul>
        <div class="nav-right">
            <a href="panier.php"><i class="ri-shopping-cart-line"></i></a>
            <a href="login.php"><i class="ri-user-line"></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <main>
        <!-- Contact Section -->
       <section class="home">
            <div class="my-5 py-5 inscrit">
                <div class="container text-center mt-3 pt-3">
                    <h2 class="form-weight-bold">Contactez-nous</h2>
                    <hr class="mx-auto">
                </div>
                <div class="mx-auto container">
                    <?php if(isset($success_message)): ?>
                        <p style="color:green;"><?php echo $success_message; ?></p>
                    <?php endif; ?>
                    <?php if(isset($error_message)): ?>
                        <p style="color:red;"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <form action="contact.php" method="POST" id="contact-form">
                        <div class="form-group">
                            <label for="">Nom</label>
                            <input type="text" class="form-control" id="contact-name" name="name" placeholder="Votre nom" required>
                        </div>
                        <div class="form-group">
                            <label for="">E-mail</label>
                            <input type="email" class="form-control" id="contact-email" name="email" placeholder="Votre e-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea class="form-control" id="contact-message" name="message" placeholder="Votre message" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn4" id="contact-btn" value="Envoyer" name="submit_contact">
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="newsletter">
            <div class="newsletter-content">
                <div class="newsletter-text">
                    <h2>Rejoignez La liste!</h2>
                    <p>Inscrivez-vous avec votre adresse e-mail pour recevoir nos actualités.</p>
                </div>
                <form action="">
                    <input type="email" placeholder="email" required>
                    <input type="submit" value="Abonner vous" class="btnnn">
                </form>
            </div>
        </section>

    </main>

    <!-- Footer Section -->
    <div class="footer" id="footer">
        <!-- Footer content remains the same -->
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

    <!-- Copyright Section -->
    <div class="copyright">
        <div class="end-text">
            <p>Copyright 2024 by Timeless Shop</p>

        </div>
        <div class="end-img">
            <img src="../img/card.png" alt="">
        </div>

    </div>

    <!-- JavaScript -->
    <script src="../js/script.js"></script>

</body>

</html>

