<?php
include_once '../model/function.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>
        <?php
        echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
        ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/style.css" />
    <!-- Boxicons CDN Link -->

    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        
    </style>
</head>

<body>

    <div class="sidebar hidden-print">
        <div class="logo-details">
            <i class='bx bxs-business'></i>
            <span class="logo_name">TOP-LAIT</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="acceuil.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "acceuil.php" ? "active" : "" ?>">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Acceuil</span>
                </a>
            </li>
            <li>
                <a href="produit.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "produit.php" ? "active" : "" ?>">
                    <i class="bx bx-box"></i>
                    <span class="links_name">Produit</span>
                </a>
            </li>
            <li>
                <a href="client.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "client.php" ? "active" : "" ?>">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Client</span>
                </a>
            </li>
            <li>
                <a href="Vente.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "Vente.php" ? "active" : "" ?>">
                    <i class="bx bx-shopping-bag"></i>
                    <span class="links_name">Vente</span>
                </a>
            </li>
            <li>
                <a href="fournisseur.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "fournisseur.php" ? "active" : "" ?>">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Fournisseur</span>
                </a>
            </li>
            <li>
                <a href="Commande.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "Commande.php" ? "active" : "" ?>">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Commandes</span>
                </a>
            </li>
            <li>
                <a href="categorie.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "categorie.php" ? "active" : "" ?>">
                    <i class="bx bx-category"></i>
                    <span class="links_name">Categorie</span>
                </a>
            </li>
        
            <li class="log_out">
                <a href="logout.php">
                    <i class="bx bx-log-out"></i>
                    <span class="links_name">Déconnexion</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav class="hidden-print">
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="acceuil">
                    <?php
                    echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
                    ?>
                </span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Recherche..." />
                <i class="bx bx-search"></i>
            
        </nav>