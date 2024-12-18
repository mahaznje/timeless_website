<?php
include('connection.php');

$stmt = $mysqli->prepare("SELECT * FROM produit LIMIT 8");

$stmt->execute();

$featured_produit = $stmt->get_result();


?>