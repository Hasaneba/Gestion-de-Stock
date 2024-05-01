<?php 
$id=$_GET['delete_id'];
include 'connexion.php';


$sql = "DELETE FROM $nom_base_de_donne.fournisseur WHERE id=$id";

if ($connexion->exec($sql) == TRUE) {
  header('location: ../Monlogin/fournisseur.php');
} else {
  echo "Erreur de suppression: " . $connexion->errorCode();
}

	?>

	