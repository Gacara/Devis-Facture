<?php

include_once 'connect.php';

$nom = htmlspecialchars($_POST['client_nom'], ENT_QUOTES, "UTF-8");
$prenom = htmlspecialchars($_POST['client_prenom'], ENT_QUOTES, "UTF-8");
$phone = htmlspecialchars($_POST['client_tel'], ENT_QUOTES, "UTF-8");
$mail = htmlspecialchars($_POST['client_mail'], ENT_QUOTES, "UTF-8");
$adresse = htmlspecialchars($_POST['client_adr'], ENT_QUOTES, "UTF-8");
$cp = htmlspecialchars($_POST['client_cp'], ENT_QUOTES, "UTF-8");
$entreprise = htmlspecialchars($_POST['client_entr'], ENT_QUOTES, "UTF-8");
$juridique = htmlspecialchars($_POST['client_juridique'], ENT_QUOTES, "UTF-8");
$siret = htmlspecialchars($_POST['client_siret'], ENT_QUOTES, "UTF-8");



if(empty($nom) || empty($prenom) || empty($phone) || empty($mail) || empty($adresse) || empty($cp) || empty($entreprise) || empty($juridique) || empty($siret)){
    header('Location: ../gestion/add-client.php?msg=error');
    exit();
}
else{
    $req = $conn->prepare("INSERT INTO
    elfamosodevi_client (nom, prenom, telephone, mail, adresse, code_postal, nom_entreprise, forme_juridique, siret)
    VALUES ('$nom', '$prenom', '$phone', '$mail', '$adresse', '$cp', '$entreprise', '$juridique', '$siret')");
    $req->execute();

    header('Location: ../gestion/add-client.php?msg=success');
    exit();
}
