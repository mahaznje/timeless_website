<?php
session_start();
include('connection.php');

if (isset($_POST['annuler']) && isset($_POST['command_id'])) {
    $commande_id = $_POST['command_id'];
    
    // Vérifiez le statut de la commande
    $stmt = $mysqli->prepare("SELECT StatutCommande FROM commande WHERE `command_id` = ?");
    $stmt->bind_param("i", $commande_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
        
    if ($row && $row['StatutCommande'] == 'En cours') {
        // Supprimez les détails de la commande
        $stmt = $mysqli->prepare("DELETE FROM detailcommande WHERE `commande_id` = ?");
        $stmt->bind_param("i", $commande_id);
        $stmt->execute();
        
        // Supprimez la commande
        $stmt = $mysqli->prepare("DELETE FROM commande WHERE `command_id` = ?");
        $stmt->bind_param("i", $commande_id);
        $stmt->execute();
        
        $_SESSION['message'] = "La commande a été annulée avec succès.";
    } else {
        $_SESSION['message'] = "La commande ne peut plus être annulée ou n'existe pas.";
    }
} else {
    $_SESSION['message'] = "Erreur: Données de commande non fournies.";
}

// Redirigez l'utilisateur vers la page des commandes
header('Location: /timeless/account.php');
exit();
?>