<?php
include 'connexion.php';
if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['adresse'])
    && !empty($_POST['id'])
) {
    $sql = "UPDATE  $nom_base_de_donne.fournisseur SET nom=?, prenom=?, telephone=?, adresse=? WHERE id=?";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse'],
        $_POST['id']

    ));

    if ( $req->rowCount()!=0) {
        $_SESSION['msg_fournisseur'] ['text'] = "fournisseur modifier avec succes";
        $_SESSION['msg_fournisseur'] ['type'] = "success";
        
    } else {
        $_SESSION['msg_fournisseur'] ['text'] = "Rien n'a ete modifier";
        $_SESSION['msg_fournisseur'] ['type'] = "danger"; 
    }
} else {
    $_SESSION['msg_fournisseur'] ['text'] = "Une information obligatoire non renseignee";
    $_SESSION['msg_fournisseur'] ['type'] = "danger";
    
}

header('location: ../Monlogin/fournisseur.php');
