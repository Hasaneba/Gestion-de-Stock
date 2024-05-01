<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $produit = getCategorie($_GET['id']);
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ? "../model/modifCategorie.php" : "../model/ajoutCategorie.php" ?>" method="post" enctype="multipart/form-data">
                <label for="libelle_categorie">Libelle</label>
                <input value="<?= !empty($_GET['id']) ? $produit['libelle_categorie'] : "" ?>" type="text" name="libelle_categorie" id="libelle_categorie" placeholder="veuillez saisir le nom">
                <input value="<?= !empty($_GET['id']) ? $produit['id'] : "" ?>" type="hidden" name="id" id="id" >
                
               

                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['msg_categorie']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['msg_categorie']['type'] ?>">
                        <?= $_SESSION['msg_categorie']['text'] ?>

                    </div>
                <?php
                }
                ?>
            </form>
        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Libelle</th>
                    <th colspan=2>Action</th>
                </tr>
                <?php

                $categories = getCategorie();

                if (!empty($categories) && is_array($categories)) {
                    foreach ($categories as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['libelle_categorie'] ?></td>
                            <td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a></td>
                            <td><a href="../model/supprimerCategorie.php?delete_id=<?php print($value['id']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer  ?')">
				<font color ="red"><i class='bx bx-trash-alt'></i></font></a>
                </td>
                        </tr>

                <?php
                    }
                }

                ?>
            </table>
        </div>
    </div>
</div>
</section>

<?php
include 'pied.php'
?>