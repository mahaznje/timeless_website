<?php 

include('connection.php');

 $stmt = $mysqli->prepare("SELECT * FROM produit ORDER BY produit_stars DESC LIMIT 4");
 $stmt->execute();
 $result = $stmt->get_result();

?>