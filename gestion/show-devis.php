<?php
session_start();

if(!isset($_SESSION['pseudo'])) {
    header('location: index.php');
}

include_once '../src/connect.php';
$id_client = $_GET['client'];
$decrypted_id_raw = base64_decode($id_client);
$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);

$req_devis = "SELECT * FROM elfamosodevi_devis AS devis,elfamosodevi_client AS client
WHERE devis.id_client=$decrypted_id
AND client.id=$decrypted_id";
$ps_devis = $conn->prepare($req_devis);
$ps_devis->execute();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis - Liste des devis</title>
    <link type="text/css" rel="stylesheet" href="style.css"/>
</head>

<body>

<header>
    <ul class="ul-decoration">
        <li class="li-decoration"><a href="client.php">Client</a></li>
        <li class="li-decoration"><a href="add-client.php">Créer Client</a></li>
        <li class="li-decoration"><a href="../src/logout.php">Déconnexion</a></li>
    </ul>
</header>


<div id="contenu">
    Client n°<?=$decrypted_id?>
    Devis:
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Montant</th>
            <th>Acompte</th>
            <th>Statut</th>
            <th>Reste</th>
            <th>Limite</th>
            <th>Statut</th>
            <th>Relance 1</th>
            <th>Relance 2</th>
            <th>Paiement</th>
            <th>Action</th>
        </tr>
        <?php while($prd_devis = $ps_devis->fetch()) { ?>
            <tr>
                <td><?= ($prd_devis['id_devis']) ?></td>
                <td><?= ($prd_devis['montant_ttc']) ?></td>
                <td><?= ($prd_devis['acompte']) ?></td>
                <td><?= ($prd_devis['statut_acompte']) ?></td>
                <td>reste</td>
                <td><?= ($prd_devis['date_limite_reglement']) ?></td>
                <td><?= ($prd_devis['statut_reglement']) ?></td>
                <td><?= ($prd_devis['date_premier_relance']) ?></td>
                <td><?= ($prd_devis['date_deuxieme_relance']) ?></td>
                <td><?= ($prd_devis['date_paiement_reel']) ?></td>
                <td><a href="" class="">DL</a></td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
