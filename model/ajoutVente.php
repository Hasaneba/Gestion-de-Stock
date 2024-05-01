<?php
include 'connexion.php';
include_once "function.php";

if (
    !empty($_POST['id_produit'])
    && !empty($_POST['id_client'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix'])

) {

    $produit = getProduit($_POST['id_produit']);

    if (!empty($produit) && is_array($produit)) {
        if ($_POST['quantite'] > $produit['quantite']) {
            $_SESSION['msg_vente']['text'] = "La quantite a vendre n'est pas disponible";
            $_SESSION['msg_vente']['type'] = "danger";
        } else {
            $sql = "INSERT INTO $nom_base_de_donne.vente(id_produit, id_client, quantite, prix)
        VALUES(?, ?, ?, ?)";
            $req = $connexion->prepare($sql);

            $req->execute(array(
                $_POST['id_produit'],
                $_POST['id_client'],
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
                    $_SESSION['msg_vente']['text'] = "vente effectue avec succes";
                    $_SESSION['msg_vente']['type'] = "success";
                } else {
                    $_SESSION['msg_vente']['text'] = "impossible de faire une vente";
                    $_SESSION['msg_vente']['type'] = "danger";
                }
            } else {
                $_SESSION['msg_vente']['text'] = "Une erreur s'est produite lors de la vente";
                $_SESSION['msg_vente']['type'] = "danger";
            }
        }
    }
} else {
    $_SESSION['msg_vente']['text'] = "Une information obligatoire non renseignee";
    $_SESSION['msg_vente']['type'] = "danger";
}

header('location: ../Monlogin/vente.php');
