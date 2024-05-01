<?php 
$id=$_GET['delete_id'];
include 'connexion.php';


$sql = "DELETE FROM $nom_base_de_donne.categorie_produit WHERE id=$id";

if ($connexion->exec($sql) == TRUE) {
  header('location: ../Monlogin/categorie.php');
} else {
  echo "Erreur de suppression: " . $connexion->errorCode();
}

	?>

	