<?php
include 'connexion.php';

if (
    !empty($_GET['idVente']) &&
    !empty($_GET['idProduit']) &&
    !empty($_GET['quantite'])
) {

    $sql = "UPDATE  gestion_stock_toplait.vente SET etat=? WHERE id=?";
    $req = $connexion->prepare($sql);
    $req->execute(array(0,$_GET['idVente']));

    if ($req->rowCount() != 0) {
        $sql = "UPDATE  gestion_stock_toplait.produit SET quantite=quantite+? WHERE id=?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET['quantite'], $_GET['idProduit']));
    }
}
header('location: ../Monlogin/vente.php');
