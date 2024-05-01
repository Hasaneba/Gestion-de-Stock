<?php
include 'connexion.php';

function getProduit($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_produit, libelle_categorie, quantite, prix_unitaire, date_fabrication, 
        date_expiration, images, id_categorie, a.id FROM gestion_stock_toplait.produit AS a, gestion_stock_toplait.categorie_produit AS c
        WHERE a.id_categorie=c.id AND a.id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_produit, libelle_categorie, quantite, prix_unitaire, date_fabrication, 
        date_expiration, images, id_categorie, a.id FROM gestion_stock_toplait.produit AS a, gestion_stock_toplait.categorie_produit AS c
        WHERE a.id_categorie=c.id ";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchALL();
    }
}

function getClient($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM gestion_stock_toplait.client WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {

        $sql = "SELECT * FROM gestion_stock_toplait.client";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchALL();
    }
}

function getVente($id = null, $searchDATA = array())
{
    if (!empty($id)) {
        $sql = "SELECT nom_produit, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone
        FROM gestion_stock_toplait.client AS c, gestion_stock_toplait.Vente AS v, gestion_stock_toplait.produit AS a WHERE  v.id_produit=a.id AND v.id_client=c.id AND v.id=? AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id, 1));

        return $req->fetch();
        return $req->fetch();
    } elseif (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);
        if (!empty($nom_produit)) $search .= "AND a.nom_produit LIKE '%$nom_produit%' ";
        if (!empty($nom)) $search .= "AND c.nom LIKE '%$nom%' ";
        if (!empty($quantite)) $search .= "AND v.quantite = $quantite ";
        if (!empty($prix)) $search .= "AND v.prix = $prix ";


        $sql = "SELECT nom_produit, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idProduit
        FROM gestion_stock_toplait.client AS c, gestion_stock_toplait.Vente AS v, gestion_stock_toplait.produit AS a WHERE v.id_produit=a.id $search AND v.id_client=c.id AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array(1));

        return $req->fetchALL();
    } else {
        $sql = "SELECT nom_produit, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idProduit
        FROM gestion_stock_toplait.client AS c, gestion_stock_toplait.Vente AS v, gestion_stock_toplait.produit AS a WHERE v.id_produit=a.id AND v.id_client=c.id AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array(1));

        return $req->fetchALL();
    }
}

function getFournisseur($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM gestion_stock_toplait.fournisseur WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM gestion_stock_toplait.fournisseur";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchALL();
    }
}


function getCommande($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_produit, nom, prenom, co.quantite, prix, date_commande, co.id, prix_unitaire, adresse, telephone
        FROM gestion_stock_toplait.fournisseur AS f, gestion_stock_toplait.commande AS co, gestion_stock_toplait.produit AS a WHERE  co.id_produit=a.id AND co.id_fournisseur=f.id AND co.id=? AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id, 1));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_produit, nom, prenom, co.quantite, prix, date_commande, co.id, a.id AS idProduit
        FROM gestion_stock_toplait.fournisseur  AS f, gestion_stock_toplait.commande AS co, gestion_stock_toplait.produit AS a WHERE co.id_produit=a.id AND co.id_fournisseur=f.id AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array(1));

        return $req->fetchALL();
    }
}

function getCategorie($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM gestion_stock_toplait.categorie_produit WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM gestion_stock_toplait.categorie_produit";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchALL();
    }
}

function getTotal($entityName)
{
    $sql = "SELECT count(*) FROM gestion_stock_toplait.$entityName";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute();
    $count = $req->fetchColumn();
    return (int)$count;
}

function pagination1($offset)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM gestion_stock_toplait.fournisseur WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM gestion_stock_toplait.fournisseur  LIMIT 4 OFFSET $offset";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchALL();
    }
}

function pagination2($offset)
{
    if (!empty($id)) {
        $sql = "SELECT nom_produit, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone
        FROM gestion_stock_toplait.client AS c, gestion_stock_toplait.Vente AS v, gestion_stock_toplait.produit AS a WHERE  v.id_produit=a.id AND v.id_client=c.id AND v.id=? AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id, 1));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_produit, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idProduit
        FROM gestion_stock_toplait.client AS c, gestion_stock_toplait.Vente AS v, gestion_stock_toplait.produit AS a WHERE v.id_produit=a.id AND v.id_client=c.id AND etat=?  LIMIT 4 OFFSET $offset";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array(1));

        return $req->fetchALL();
    }
}

function pagination3($offset)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM gestion_stock_toplait.client WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {

        $sql = "SELECT * FROM gestion_stock_toplait.client  LIMIT 4 OFFSET $offset";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchALL();
    }
}

function pagination4($offset)
{
    if (!empty($id)) {
        $sql = "SELECT nom_produit, libelle_categorie, quantite, prix_unitaire, date_fabrication, 
        date_expiration, images, id_categorie, a.id FROM gestion_stock_toplait.produit AS a, gestion_stock_toplait.categorie_produit AS c
        WHERE a.id_categorie=c.id AND a.id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_produit, libelle_categorie, quantite, prix_unitaire, date_fabrication, 
        date_expiration, images, id_categorie, a.id FROM gestion_stock_toplait.produit AS a, gestion_stock_toplait.categorie_produit AS c
        WHERE a.id_categorie=c.id  LIMIT 3 OFFSET $offset";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchALL();
    }
}

function pagination5($offset)
{
    if (!empty($id)) {
        $sql = "SELECT nom_produit, nom, prenom, co.quantite, prix, date_commande, co.id, prix_unitaire, adresse, telephone
        FROM gestion_stock_toplait.fournisseur AS f, gestion_stock_toplait.commande AS co, gestion_stock_toplait.produit AS a WHERE  co.id_produit=a.id AND co.id_fournisseur=f.id AND co.id=? AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id, 1));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_produit, nom, prenom, co.quantite, prix, date_commande, co.id, a.id AS idProduit
        FROM gestion_stock_toplait.fournisseur  AS f, gestion_stock_toplait.commande AS co, gestion_stock_toplait.produit AS a WHERE co.id_produit=a.id AND co.id_fournisseur=f.id AND etat=?
        LIMIT 4 OFFSET $offset";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array(1));

        return $req->fetchALL();
    }
}


function getALLCommande()
{
    $sql = "SELECT COUNT(*) AS nbre FROM  gestion_stock_toplait.commande";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getALLVente()
{
    $sql = "SELECT COUNT(*) AS nbre FROM  gestion_stock_toplait.vente WHERE etat=?";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetch();
}

function getALLProduit()
{
    $sql = "SELECT COUNT(*) AS nbre FROM  gestion_stock_toplait.produit";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getCA()
{
    $sql = "SELECT SUM(prix) AS prix FROM  gestion_stock_toplait.vente WHERE etat=?";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetch();
}

function getLastVente($id = null)
{

    $sql = "SELECT nom_produit, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idProduit
        FROM gestion_stock_toplait.client AS c, gestion_stock_toplait.Vente AS v, gestion_stock_toplait.produit AS a WHERE v.id_produit=a.id AND v.id_client=c.id AND etat=?
        ORDER BY date_vente DESC LIMIT 10";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetchALL();
}

function getMostVente($id = null)
{

    $sql = "SELECT nom_produit, SUM(prix) AS prix
        FROM gestion_stock_toplait.client AS c, gestion_stock_toplait.Vente AS v, gestion_stock_toplait.produit AS a WHERE v.id_produit=a.id AND v.id_client=c.id AND etat=?
       GROUP BY a.id
        ORDER BY SUM(prix) DESC LIMIT 10";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetchALL();
}
