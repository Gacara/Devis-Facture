<?php
session_start();
if(!isset($_SESSION['pseudo'])) {
    header('location: index.php');
}

include_once '../src/connect.php';
$id_client = $_GET['client'];
$decrypted_id_raw = base64_decode($id_client);
$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);


$req_client = "SELECT * FROM elfamosodevi_client WHERE id='$decrypted_id'";
$ps_client = $conn->prepare($req_client);
$ps_client->execute();

?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création Devis - ElFamosoDevi</title>
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
    <?php while($prd_client = $ps_client->fetch()) { ?>
  <?php // method="post" action="../src/add-devis.php" ?>
            <form>
                <input name="id_client" value="<?= $prd_client['id'] ?>" style="display: none">
                <table>
                    <tr>
                        <td>Devis</td>
                    </tr>
                  
                    <tr>
                        <td>Client : <?= ($prd_client['prenom'] . " " . $prd_client['nom']) ?></td>
                    </tr>
                    <tr>
                        <td>Contact : <?= ($prd_client['telephone'] . " / " . $prd_client['mail']) ?></td>
                    </tr>
                    <tr>
                        <td>Projet : <input type="text" name="nom_projet" placeholder="Nom projet"></td>
                    </tr>
                    <tr>
                        <td><?= ($prd_client['adresse'] . " " . $prd_client['code_postal']) ?></td>
                    </tr>
       
                 <tr>
                        <td>Désignation de la prestation</td>
                        <td>Prix unitaire HT</td>
                        <td>Quantité</td>
                        <td>Montant</td>
                    </tr>
                    <span id="gerard">
            <div class="allpresta">            
            <tr class="prestation 0">
                <td><input type="text" name="presta_nom" class="presta_nom" placeholder="Intitulé de la Prestation"></td>
                <td><input type="number" name="presta_prix" class="presta_prix 0" placeholder="Prix">€</td>
                <td><input type="number" name="presta_quantite" class="presta_quantite 0" value="1" placeholder="Quantité"></td>
                <td><input disabled="disabled" type="text" name="presta_montant" class="presta_montant 0" placeholder="Montant">€</td>
                <td><button type="button" class="btn-delete-presta">delete presta</button></td>
            </tr>
        </div>
            <tr class="btn_clone">
                <td><button type="button" class="btn-add-presta">add presta</button></td>
            </tr>
                </span>
                    <tr>
                        <td>Total Hors taxes</td>
                        <td></td>
                        <td></td>
                        <td><input disabled="disabled" type="text" name="montant_tht" id="montant_tht" placeholder="0,00" value="0"> €</td>
                    </tr>
                    <tr>
                        <td>TVA (20%)</td>
                        <td></td>
                        <td></td>
                        <td><input disabled="disabled" type="text" name="montant_tva" id="montant_tva" placeholder="0,00"> €</td>
                    </tr>
                    <tr>
                        <td>Net à payer TTC</td>
                        <td></td>
                        <td></td>
                        <td><input disabled="disabled" type="text" name="montant_ttc" id="montant_ttc" placeholder="0,00"> €</td>
                    </tr>

                    <tr>
                        <td colspan="4">Bon pour accord. Acceptation de la proposition tarifaire ainsi que des conditions de vente jointes et du règlement.</td>
                    </tr>
                    <tr>
                        <td colspan="4">Fait à ........................................................ Le ...........................................</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Signature + Cachet</td>
                    </tr>
                </table> 
    
          
        <input type="hidden" name="prenom" value="<?= base64_encode($prd_client['prenom'])?>">
        <input type="hidden" name="nom" value="<?= base64_encode($prd_client['nom'])?>">
        <input type="hidden" name="telephone" value="<?= base64_encode($prd_client['telephone'])?>">
        <input type="hidden" name="mail" value="<?= base64_encode($prd_client['mail'])?>">
        <input type="hidden" name="adresse" value="<?= base64_encode($prd_client['adresse'])?>">
        <input type="hidden" name="code_postal" value="<?= base64_encode($prd_client['code_postal'])?>">

                
                <br><br><br>
                 <button class="btn btn-success" name="submit" type="submit" formaction="../oui.php">Créer devis</button>
                <button type="button" class="btn-refresh_montant">Refresh Montant</button>
                <!--        <button class="btn btn-success" type="submit">Créer devis</button>-->
            </form>
     
    <?php } ?>
</div>

<script src="../js/adddevis.js"></script>
</body>
</html>
