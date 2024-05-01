<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $produit = getCommande($_GET['id']);
}
$byPage = 4;

$count = getTotal("commande");

$pages = (int)ceil($count / $byPage);

$currentPage = $_GET['page'] ?? 1 ;


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

if($currentPage > $pages){

  $_SESSION['pag'] = "cette page n'existe pas";
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ? "../model/modifCommande.php" : "../model/ajoutCommande.php" ?>" method="post">
                <input value="<?= !empty($_GET['id']) ? $produit['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_produit">Produit</label>
                <select onchange="setPrix()" name="id_produit" id="id_produit">
                    <?php

                    $produits = getProduit();
                    $produits = pagination4($offset);
                    if (!empty($produits) && is_array($produits)) {
                        foreach ($produits as $key => $value) {
                    ?>
                            <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>"><?= $value['nom_produit'] . " -" . $value['quantite'] .  "  disponible" ?></option>
                    <?php
                        }
                    }

                    ?>
                </select>
                <label for="id_fournisseur">Fournisseur</label>
                <select name="id_fournisseur" id="id_fournisseur">
                    <?php

                    $fournisseurs = getFournisseur();
                    $fournisseurs = pagination1($offset);
                    if (!empty($fournisseurs) && is_array($fournisseurs)) {
                        foreach ($fournisseurs as $key => $value) {
                    ?>
                            <option value="<?= $value['id'] ?>"><?= $value['nom'] . " " . $value['prenom'] ?></option>
                    <?php
                        }
                    }


                    ?>
                </select>

                <label for="quantite">Quantite</label>
                <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $produit['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="veuillez saisir la quantite">

                <label for="prix">Prix</label>
                <input value="<?= !empty($_GET['id']) ? $produit['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="veuillez saisir la prix">


                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['msg_commande']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['msg_commande']['type'] ?>">
                        <?= $_SESSION['msg_commande']['text'] ?>

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
                    <th>Produit</th>
                    <th>Fournisseur</th>
                    <th>Quantite</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php

                $commandes = getCommande();
                $commandes = pagination5($offset);

                if (!empty($commandes) && is_array($commandes)) {
                    foreach ($commandes as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['nom_produit'] ?></td>
                            <td><?= $value['nom'] . " " . $value['prenom'] ?></td>
                            <td><?= $value['quantite'] ?></td>
                            <td><?= $value['prix'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['date_commande'])) ?></td>
                            <td>
                            <a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a>
                                <a onclick="annuleCommande(<?= $value['id'] ?>, <?= $value['idProduit'] ?>, <?= $value['quantite'] ?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
                            </td>
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

<script>

    function annuleCommande(idCommande, idProduit, quantite) {
        if (confirm("Voulez-vous vraiment annuler cette commande ?")) {
            window.location.href = "../model/annuleCommande.php?idCommande="+idCommande+"&idProduit="+idProduit+"&quantite="+quantite
        }
    }

    function setPrix() {
        var produit = document.querySelector('#id_produit');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = produit.options[produit.selectedIndex].getAttribute('data-prix');

        prix.value = Number(quantite.value) * Number(prixUnitaire);

    }
</script>