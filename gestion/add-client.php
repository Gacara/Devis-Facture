<?php
session_start();
if(!isset($_SESSION['pseudo'])) {
    header('location: index.php');
}

include_once '../src/connect.php';
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création Client - ElFamosoDevi</title>
    <link type="text/css" rel="stylesheet" href="style.css"/>
    <script src="../js/jquery-3.4.1.min.js"></script>
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
    <div id="msg-info">
        <?php
        if(!empty($_GET['msg'])) {
            $message = $_GET['msg'];
            switch ($message) {
                case "success":
                    echo '<p class="info-succes">Un client à bien été créé</p>';
                    break;
                case "error":
                    echo '<p class="info-error">Une erreur est survenue</p>';
                    break;
            }
        } ?>
    </div>
    <form method="post" action="../src/add-client.php">
        <input type="text" name="client_nom" placeholder="Nom" required autofocus>
        <input type="text" name="client_prenom" placeholder="Prénom" required>
        <input type="tel" name="client_tel" placeholder="Téléphone" required>
        <input type="email" name="client_mail" placeholder="Email" required>
        <input type="text" name="client_adr" placeholder="Adresse" required>
        <input type="text" name="client_cp" placeholder="Code Postal" required>
        <input type="text" name="client_entr" placeholder="Nom Entreprise" required>
        <input type="text" name="client_juridique" placeholder="Forme Juridique" required>
        <input type="text" name="client_siret" placeholder="Siret" required>
        <button type="submit">Créer Client</button>
    </form>

</div>


<footer>

</footer>
</body>
</html>
