<?php
include 'connexion.php';
if (
    !empty($_POST['libelle_categorie'])
) {
    $sql = "INSERT INTO $nom_base_de_donne.categorie_produit(libelle_categorie) VALUES(?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['libelle_categorie'],
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['msg_categorie']['text'] = "Categorie ajoute avec succes";
        $_SESSION['msg_categorie']['type'] = "success";
    } else {
        $_SESSION['msg_categorie']['text'] = "Une erreur s'est produite lors de l'ajout du categorie";
        $_SESSION['msg_categorie']['type'] = "danger";
    }
} else {
    $_SESSION['msg_categorie']['text'] = "Une information obligatoire nom renseigner";
    $_SESSION['msg_categorie']['type'] = "danger";
}


header('location: ../Monlogin/categorie.php');
