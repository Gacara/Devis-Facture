<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link type="text/css" rel="stylesheet" href="../css/style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Anton|Ramabhadra&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

<header  style="background: black">
    <ul class="ul-decoration">
        <li class="li-decoration">
            <a href="index.php">Connexion</a>
        </li>
    </ul>
</header>


<div id="contenu">
<!--    <form method="post" action="../src/login.php">-->
<!--        <input type="text" name="pseudo" placeholder="Pseudo" autofocus>-->
<!--        <input type="password" name="password" placeholder="Password">-->
<!--        <button type="submit">Connexion</button>-->
<!--    </form>-->
    
    <form id="login" class="col-md-4" method="post" action="../src/login.php">
        <h3>Log In</h3>
        <div class="form-group">
            <input class="form-control" type="text" name="pseudo" placeholder="Pseudo" autofocus>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>
    
    <?php
    if(!empty($_GET['message'])) {
        $message = $_GET['message'];
        echo '<p class="msg-error">' . $message . '</p>';
    } ?>
</div>


<footer>

</footer>
<script src="js/agency.min.js"></script>
</body>
</html>
