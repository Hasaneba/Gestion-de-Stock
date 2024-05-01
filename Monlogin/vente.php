<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $produit = getVente($_GET['id']);
}
$byPage = 4;

$count = getTotal("vente");

$pages = (int)ceil($count / $byPage);

$currentPage = $_GET['page'] ?? 1 ;


if (isset($_GET['next'])) {
    if ($currentPage < $pages) {
        $currentPage++;
    }
}

if (isset($_GET['pre'])) {
    
    if ($currentPage > 1) {
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
            <form action=" <?= !empty($_GET['id']) ? "../model/modifVente.php" : "../model/ajoutVente.php" ?>" method="post">
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
                <label for="id_client">Client</label>
                <select name="id_client" id="id_client">
                    <?php

                    $clients = getClient();
                    $clients = pagination3($offset);
                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $key => $value) {
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
                if (!empty($_SESSION['msg_vente']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['msg_vente']['type'] ?>">
                        <?= $_SESSION['msg_vente']['text'] ?>

                    </div>
                <?php
                }
                ?>
            </form>
        </div>
        <div style="margin-left:10px;" class="content">
        <div style="display: block;" class="box">
            <form action="" method="get">
                <!-- <table class="mtable">
                    <tr>
                        <th>Produit</th>
                        <th>Client</th>
                        <th>Quantite</th>
                        <th>Prix</th>
                    </tr>
                    <tr>
                        
                        <td>
                            <input type="text" name="nom_produit" id="nom_produit" placeholder="veuillez saisir le nom">
                        </td>
                        <td>
                            <input type="text" name="nom" id="nom" placeholder="veuillez saisir le nom">
                        </td>
                            
                        <td>
                            <input type="number" name="quantite" id="quantite" placeholder="veuillez saisir la quantite">
                        </td>
                        <td>
                            <input type="number" name="prix" id="prix" placeholder="veuillez saisir le prix">
                        </td>
                    </tr>

                </table>
                <br>
                <button type="submit">Valider</button>
            </form>
            <br> -->
            <table class="mtable">
        
                <tr>
                    <th>Produit</th>
                    <th>Client</th>
                    <th>Quantite</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                if (!empty($_GET)) {
                    $ventes = getVente(null, $_GET);
                } else {
                    $ventes = getVente();
                    
                }
                $ventes = pagination2($offset);

                
                if (!empty($ventes) && is_array($ventes)) {
                    foreach ($ventes as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['nom_produit'] ?></td>
                            <td><?= $value['nom'] . " " . $value['prenom'] ?></td>
                            <td><?= $value['quantite'] ?></td>
                            <td><?= $value['prix'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['date_vente'])) ?></td>
                            <td>
                                <a href="recuVente.php?id=<?= $value['id'] ?>"><i class='bx bx-receipt'></i></a>
                                <a onclick="annuleVente(<?= $value['id'] ?>, <?= $value['idProduit'] ?>, <?= $value['quantite'] ?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
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
                    <?php for ($i=1; $i <= $pages; $i++) :?>
                      <li class="page-item <?php if($i == $currentPage):?> <?="active"?> <?php endif ?> "><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
                    <?php endfor ?>
                  <li class="page-item  <?php if($currentPage == $pages):?> <?="disabled"?> <?php endif ?>  "><a class="page-link" href="?next">Next</a></li>
            </ul>
    </div>
</div>
</section>

<?php
include 'pied.php'
?>

<script>

    function annuleVente(idVente, idProduit, quantite) {
        if (confirm("Voulez-vous vraiment annuler cette vente ?")) {
            window.location.href = "../model/annuleVente.php?idVente="+idVente+"&idProduit="+idProduit+"&quantite="+quantite
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