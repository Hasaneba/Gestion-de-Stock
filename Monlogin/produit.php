<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $produit = getProduit($_GET['id']);
}
$byPage = 3;

$count = getTotal("produit");
var_dump($count);
$pages = (int)ceil($count / $byPage);

$currentPage = $_GET['page'] ?? 1;


if (isset($_GET['next'])) {
    if ($currentPage < $pages) {
        $currentPage++;
    }
}

if (isset($_GET['pre'])) {

    if ($currentPage > 2) {
        $currentPage--;
    }
}

$offset = $byPage * ($currentPage - 1);

if ($currentPage > $pages) {

    $_SESSION['pag'] = "cette page n'existe pas";
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ? "../model/modifProduit.php" : "../model/ajoutProduit.php" ?>" method="post" enctype="multipart/form-data">
                <label for="nom_produit">Nom du produit</label>
                <input value="<?= !empty($_GET['id']) ? $produit['nom_produit'] : "" ?>" type="text" name="nom_produit" id="nom_produit" placeholder="veuillez saisir le nom">
                <input value="<?= !empty($_GET['id']) ? $produit['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_categorie">Categorie</label>
                <select name="id_categorie" id="id_categorie">
                    <?php
                    $categories = getCategorie();
                    if (!empty($categories) && is_array($categories)) {
                        foreach ($categories as $key => $value) {

                    ?>
                            <option <?= !empty($_GET['id']) &&  $produit['id_categorie'] == $value['id'] ? "selected" : "" ?> value="<?= $value['id'] ?>"><?= $value['libelle_categorie'] ?></option>

                    <?php
                        }
                    }

                    ?>
                </select>

                <label for="quantite">Quantite</label>
                <input value="<?= !empty($_GET['id']) ? $produit['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="veuillez saisir la quantite">

                <label for="prix_unitaire">Prix unitaire</label>
                <input value="<?= !empty($_GET['id']) ? $produit['prix_unitaire'] : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="veuillez saisir le prix">

                <label for="date_fabrication">Date fabrication</label>
                <input value="<?= !empty($_GET['id']) ? $produit['date_fabrication'] : "" ?>" type="datetime-local" name="date_fabrication" id="date_fabrication">

                <label for="date_expiration">Date d'expiration</label>
                <input value="<?= !empty($_GET['id']) ? $produit['date_expiration'] : "" ?>" type="datetime-local" name="date_expiration" id="date_expiration">

                <label for="images">Image</label>
                <input value="<?= !empty($_GET['id']) ? $produit['images'] : "" ?>" type="file" name="images" id="images">

                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['msg_produit']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['msg_produit']['type'] ?>">
                        <?= $_SESSION['msg_produit']['text'] ?>

                    </div>
                <?php
                }
                ?>
            </form>
        </div>
        <div style="margin-left:10px;" class="content">
            <div class="box">
                <table class="mtable">
                    <tr>
                        <th>Nom produit</th>
                        <th>categorie</th>
                        <th>quantite</th>
                        <th>Prix unitaire</th>
                        <th>Date fabrication</th>
                        <th>Date expiration</th>
                        <th>Image</th>
                        <th colspan='2'>Action</th>
                    </tr>
                    <?php

                    $produits = getProduit();
                    $produits = pagination4($offset);

                    if (!empty($produits) && is_array($produits)) {
                        foreach ($produits as $key => $value) {
                    ?>
                            <tr>
                                <td><?= $value['nom_produit'] ?></td>
                                <td><?= $value['libelle_categorie'] ?></td>
                                <td><?= $value['quantite'] ?></td>
                                <td><?= $value['prix_unitaire'] ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($value['date_fabrication'])) ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($value['date_expiration'])) ?></td>
                                <td><img width="80" height="80" src="<?= $value['images'] ?>" alt="<?= $value['nom_produit'] ?>"></td>
                                <td>
                                    <a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a>
                                </td>
                                <td> <a href="../model/supprimerProduit.php?delete_id=<?php print($value['id']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer  ?')">
                                        <font color="red"><i class='bx bx-trash-alt'></i></font>
                                    </a>

                                </td>
                                <!--<td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a></td>-->
                            </tr>

                    <?php
                        }
                    }

                    ?>
                </table>
            </div>
            <ul style="margin-top:10px" class="pagination">
                <li class="page-item"><a class="page-link" href="?pre">Previous</a></li>
                <?php for ($i = 1; $i <= $pages; $i++) : ?>
                    <li class="page-item <?php if ($i == $currentPage) : ?> <?= "active" ?> <?php endif ?> "><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor ?>
                <li class="page-item  <?php if ($currentPage == $pages) : ?> <?= "disabled" ?> <?php endif ?>  "><a class="page-link" href="?next">Next</a></li>
            </ul>
        </div>
    </div>
    </section>

    <?php
    include 'pied.php'
    ?>