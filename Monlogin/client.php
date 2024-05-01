<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $produit = getClient($_GET['id']);
}
$byPage = 4;

$count = getTotal("client");

$pages = (int)ceil($count / $byPage);

$currentPage = $_GET['page'] ?? 1;


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

if ($currentPage > $pages) {

    $_SESSION['pag'] = "cette page n'existe pas";
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ? "../model/modifClient.php" : "../model/ajoutClient.php" ?>" method="post">
                <label for="nom">Nom</label>
                <input value="<?= !empty($_GET['id']) ? $produit['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="veillez saisir le nom">
                <input value="<?= !empty($_GET['id']) ? $produit['id'] : "" ?>" type="hidden" name="id" id="id">


                <label for="prenom">Prenom</label>
                <input value="<?= !empty($_GET['id']) ? $produit['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="veillez saisir le prenom">

                <label for="telephone">N' de Telephone</label>
                <input value="<?= !empty($_GET['id']) ? $produit['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="veillez saisir le N de telephone">

                <label for="adresse">Adresse</label>
                <input value="<?= !empty($_GET['id']) ? $produit['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder="veillez saisir l'adresse">

                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['msg_client']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['msg_client']['type'] ?>">
                        <?= $_SESSION['msg_client']['text'] ?>
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
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Telephone</th>
                        <th>Adresse</th>
                        <th colspan=2>Action</th>
                    </tr>
                    <?php
                    $clients = getClient();
                    $clients = pagination3($offset);

                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $key => $value) {
                    ?>
                            <tr>
                                <td><?= $value['nom'] ?></td>
                                <td><?= $value['prenom'] ?></td>
                                <td><?= $value['telephone'] ?></td>
                                <td><?= $value['adresse'] ?></td>
                                <td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a></td>
                                <td align="center">
                                    <a href="../model/supprimerclient.php?delete_id=<?php print($value['id']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer  ?')">
                                        <font color="red"><i class='bx bx-trash-alt'></i></font>
                                    </a>
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
</div>
</section>

<?php
include 'pied.php';
?>