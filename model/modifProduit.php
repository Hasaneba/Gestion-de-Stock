<?php
include 'connexion.php';
if (
    !empty($_POST['nom_produit'])
    && !empty($_POST['id_categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix_unitaire'])
    && !empty($_POST['date_fabrication'])
    && !empty($_POST['date_expiration'])
    && !empty($_POST['id'])
) {
    $sql = "UPDATE  $nom_base_de_donne.produit SET nom_produit=?, id_categorie=?, quantite=?, prix_unitaire=?,
            date_fabrication=?, date_expiration=? WHERE id=?";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom_produit'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire'],
        $_POST['date_fabrication'],
        $_POST['date_expiration'],
        $_POST['id']

    ));

    if ( $req->rowCount()!=0) {
        $_SESSION['msg_produit'] ['text'] = "produit modifier avec succes";
        $_SESSION['msg_produit'] ['type'] = "success";
        
    } else {
        $_SESSION['msg_produit'] ['text'] = "Rien n'a ete modifier";
        $_SESSION['msg_produit'] ['type'] = "warning"; 
    }
} else {
    $_SESSION['msg_produit'] ['text'] = "Une information obligatoire non renseignee";
    $_SESSION['msg_produit'] ['type'] = "danger";
    
}

header('location: ../Monlogin/produit.php');
