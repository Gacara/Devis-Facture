<?php
include_once 'connect.php';

$myusername = $_POST['pseudo'];
$mypassword = $_POST['password'];
$mypassword = md5($mypassword);


if(empty($_POST['pseudo']) || empty($_POST['password'])) //Oublie d'un champ
{
    $message = 'Vous devez remplir tous les champs';
    header('Location: ../gestion/index.php?message=' . $message);
    exit();
}
else //On check le mot de passe
{
    $query = $conn->prepare('SELECT * FROM elfamosodevi_user WHERE pseudo = :pseudo');
    $query->bindValue(':pseudo', $myusername, PDO::PARAM_STR);
    $query->execute();
    $data = $query->fetch();
    if($data['password'] == $mypassword) // Acces OK !
    {
        session_start();
        $_SESSION['pseudo'] = $data['pseudo'];

        header('location: ../gestion/client.php');
        exit;
    }
    else // Acces pas OK !
    {
        $message = 'Le mot de passe ou le pseudo entré n\'est pas correcte.';
        header('Location: ../gestion/index.php?message=' . $message);
        exit();
    }
}
