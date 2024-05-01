<?php
include 'connexion.php';

if (
    !empty($_POST['nom_produit'])
    && !empty($_POST['id_categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix_unitaire'])
    && !empty($_POST['date_fabrication'])
    && !empty($_POST['date_expiration'])
    && !empty($_FILES['images'])
) {
    $sql = "INSERT INTO $nom_base_de_donne.produit(nom_produit, id_categorie, quantite, prix_unitaire, date_fabrication, date_expiration, images)
            VALUES(?, ?, ?, ?, ?, ?, ?)";
    $req = $connexion->prepare($sql);

    $name =$_FILES['images']['name'];;
    $tmp_name =$_FILES['images']['tmp_name'];

    $folder = "../public/images/";
    $destination = "../public/images/$name";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    if (move_uploaded_file($tmp_name, $destination)) {
        $req->execute(array(
            $_POST['nom_produit'],
            $_POST['id_categorie'],
            $_POST['quantite'],
            $_POST['prix_unitaire'],
            $_POST['date_fabrication'],
            $_POST['date_expiration'],
            $destination
    
        ));
    
        if ( $req->rowCount()!=0) {
            $_SESSION['msg_produit'] ['text'] = "produit ajoute avec succes";
            $_SESSION['msg_produit'] ['type'] = "success";
            
        } else {
            $_SESSION['msg_produit'] ['text'] = "Une erreur s'est produite lors de l'ajout de l'produit";
            $_SESSION['msg_produit'] ['type'] = "danger"; 
        }
    }else {
        $_SESSION['msg_produit'] ['text'] = "Une erreur s'est produite lors de l'importation de l'image de l'produit";
        $_SESSION['msg_produit'] ['type'] = "danger"; 
    }

    
} else {
    $_SESSION['msg_produit'] ['text'] = "Une information obligatoire non renseignee";
    $_SESSION['msg_produit'] ['type'] = "danger";
    
}

header('location: ../Monlogin/produit.php');
