<?php
include 'connexion.php';
include_once "function.php";

if (
    !empty($_POST['id_produit'])
    && !empty($_POST['id_fournisseur'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix'])

) {

    $sql = "INSERT INTO $nom_base_de_donne.commande(id_produit, id_fournisseur, quantite, prix)
        VALUES(?, ?, ?, ?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['id_produit'],
        $_POST['id_fournisseur'],
        $_POST['quantite'],
        $_POST['prix']
    ));

    if ($req->rowCount() != 0) {

        $sql = "UPDATE  $nom_base_de_donne.produit SET quantite=quantite-? WHERE id=?";
        $req = $connexion->prepare($sql);

        $req->execute(array(
            $_POST['quantite'],
            $_POST['id_produit'],
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['msg_commande']['text'] = "commande effectue avec succes";
            $_SESSION['msg_commande']['type'] = "success";
        } else {
            $_SESSION['msg_commande']['text'] = "impossible de faire une commande";
            $_SESSION['msg_commande']['type'] = "danger";
        }
    } else {
        $_SESSION['msg_commande']['text'] = "Une erreur s'est produite lors de la commande";
        $_SESSION['msg_commande']['type'] = "danger";
    }
} else {
    $_SESSION['msg_commande']['text'] = "Une information obligatoire non renseignee";
    $_SESSION['msg_commande']['type'] = "danger";
}

header('location: ../Monlogin/commande.php');
