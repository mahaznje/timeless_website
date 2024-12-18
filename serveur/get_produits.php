<?php
include('connection.php');

$stmt = $mysqli->prepare("SELECT * FROM produit");

$stmt->execute();

$featured_produit = $stmt->get_result();


?>