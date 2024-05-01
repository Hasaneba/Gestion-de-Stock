<?php 
$id=$_GET['delete_id'];
include 'connexion.php';


$sql = "DELETE FROM $nom_base_de_donne.client WHERE id=$id";

if ($connexion->exec($sql) == TRUE) {
  header('location: ../Monlogin/client.php');
} else {
  echo "Error deleting record: " . $connexion->errorCode();
}

	?>

	