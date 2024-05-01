<?php
include 'connexion.php';
if (
    !empty($_POST['libelle_categorie'])
    && !empty($_POST['id'])
) {
    $sql = "UPDATE  $nom_base_de_donne.categorie_produit SET libelle_categorie=? WHERE id=?";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['libelle_categorie'],
        $_POST['id']

    ));

    if ($req->rowCount() != 0) {
        $_SESSION['msg_categorie']['text'] = "categorie modifier avec succes";
        $_SESSION['msg_categorie']['type'] = "success";
    } else {
        $_SESSION['msg_categorie']['text'] = "Rien n'a ete modifier";
        $_SESSION['msg_categorie']['type'] = "danger";
    }
} else {
    $_SESSION['msg_categorie']['text'] = "Une information obligatoire non renseignee";
    $_SESSION['msg_categorie']['type'] = "danger";
}

header('location: ../Monlogin/categorie.php');
