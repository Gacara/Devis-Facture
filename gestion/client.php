<?php
session_start();

if(!isset($_SESSION['pseudo'])) {
    header('location: index.php');
}

include_once '../src/connect.php';

$req_client = "SELECT * FROM elfamosodevi_client";
$ps_client = $conn->prepare($req_client);
$ps_client->execute();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis - Liste clients</title>
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
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>CP</th>
            <th>Entreprise</th>
            <th>Forme Juridique</th>
            <th>Siret</th>
            <th>Statut</th>
            <th colspan="3">Action</th>
        </tr>
        <?php while($prd_client = $ps_client->fetch()) { ?>
            <tr>
                <th><?= ($prd_client['id']) ?></th>
                <td><?= ($prd_client['nom']) ?></td>
                <td><?= ($prd_client['prenom']) ?></td>
                <td><?= ($prd_client['telephone']) ?></td>
                <td><?= ($prd_client['mail']) ?></td>
                <td><?= ($prd_client['adresse']) ?></td>
                <td><?= ($prd_client['code_postal']) ?></td>
                <td><?= ($prd_client['nom_entreprise']) ?></td>
                <td><?= ($prd_client['forme_juridique']) ?></td>
                <td><?= ($prd_client['siret']) ?></td>
                <td><?= ($prd_client['statut']) ?></td>
                <td><a href="add-devis.php?client=<?= (base64_encode($prd_client['id'] . $salt)) ?>" class="">Facture</a></td>
                <td><a href="show-devis.php?client=<?= (base64_encode($prd_client['id'] . $salt)) ?>" class="">Liste devis</a></td>
                <!-- <td><a href="" class="">Factures</a></td> -->
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
