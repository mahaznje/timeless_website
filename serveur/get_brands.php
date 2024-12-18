<?php
include('connection.php');

$stmt = $mysqli->prepare("SELECT * FROM brands");

$stmt->execute();

$featured_produit = $stmt->get_result();


?>