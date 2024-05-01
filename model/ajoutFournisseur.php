<?php
include 'connexion.php';

if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['adresse'])
) {

$sql = "INSERT INTO $nom_base_de_donne.fournisseur(nom, prenom, telephone, adresse)
        VALUES(?, ?, ?, ?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse']
        
    ));

    if ( $req->rowCount()!=0) {
      $_SESSION['msg_fournisseur']['text'] = "fournisseur ajouter avec succes";
      $_SESSION['msg_fournisseur']['type'] = "success";
      
    }else {
        $_SESSION['msg_fournisseur']['text'] = "Une erreur s'est produite lors de l'ajout du fournisseur";
        $_SESSION['msg_fournisseur']['type'] = "danger"; 
    }
    
}else {
    $_SESSION['msg_fournisseur']['text'] = "Une information obligatoire non renseignee";
    $_SESSION['msg_fournisseur']['type'] = "danger";
}

header('location: ../Monlogin/fournisseur.php');
