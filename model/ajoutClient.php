<?php
include 'connexion.php';

if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['adresse'])
) {

$sql = "INSERT INTO $nom_base_de_donne.client(nom, prenom, telephone, adresse)
        VALUES(?, ?, ?, ?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse']
        
    ));

    if ( $req->rowCount()!=0) {
      $_SESSION['msg_client']['text'] = "client ajouter avec succes";
      $_SESSION['msg_client']['type'] = "success";
      
    }else {
        $_SESSION['msg_client']['text'] = "Une erreur s'est produite lors de l'ajout du client";
        $_SESSION['msg_client']['type'] = "danger"; 
    }
    
}else {
    $_SESSION['msg_client']['text'] = "Une information obligatoire non renseignee";
    $_SESSION['msg_client']['type'] = "danger";
}

header('location: ../Monlogin/client.php');
