<?php

include_once 'connect.php';

$id_client = $_POST['id_client'];
//$pdf = htmlspecialchars($_POST['meta_lang'], ENT_QUOTES, "UTF-8");
$date_creation = date("Y-m-d");
$montant_ttc = $_POST['montant_ttc'];



//pdf
//date_creation
//montant_ttc
//acompte
//statut_acompte
//date_limite_reglement
//statut_reglement
//date_relance_mail
//date_premier_relance
//date_deuxieme_relance
//date_paiement_reel
//ecart_nb_jour
//id_client