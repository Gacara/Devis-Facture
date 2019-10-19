
		<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
</head>

<body>

<header>
    <ul class="ul-decoration">
        <li class="li-decoration"><a href="gestion/index.php">Connexion</a></li>
        
    </ul>
</header>


<div class="secla" id="contenu">
   

    <?php







 if ( isset( $_GET['submit'] ) ) { // retrieve the form data by using the element's name attributes value as key 
 //$ttc = $_GET['ttc']; $tva = $_GET['tva']; $tht = $_GET['tht']; 

$presta_quantite = $_GET['presta_quantite']; $presta_prix = $_GET['presta_prix']; $presta_nom = $_GET['presta_nom']; $nom_projet = $_GET['nom_projet']; 
 $prenom = base64_decode($_GET['prenom']); $nom = base64_decode($_GET['nom']); $telephone = base64_decode($_GET['telephone']); base64_decode($mail = $_GET['mail']); 
 $adresse = base64_decode($_GET['adresse']); $code_postal = base64_decode($_GET['code_postal']);

$nbpresta = $_GET['presta']; $converted_array = json_decode(stripslashes($_GET['converted_array']),true); 

$products = array();


/*
foreach($converted_array as $array) {



			$libelle = $array[0]['name'];
			$qte = $array[0]['qte'];
			$pu = $array[0]['prix'];
			$taux_tva = 20;
           	$product = array($libelle,$qte,$pu,$taux_tva);
           	$products[] = $product;      
           	$total_ht += $pu*$qte;
           	echo $total_ht .'<br>';

}*/
 
for($nb=0;$nb<$nbpresta;$nb++) {

    echo "name:" . $converted_array[$nb]['name'], '<br>';
    echo "prix:" . $converted_array[$nb]['prix'], '<br>';
    echo "qte:" . $converted_array[$nb]['qte'], '<br>';
    echo "montant:" . $converted_array[$nb]['montant'], '<br>';
    echo '<br>';
 //echo $converted_array[0]['name'] . '<br>';
   
}
//echo $converted_array[0][0][name] ;  ${'file' . $nb}= $converted_array[$nb]['name'];

echo $nbpresta ;
echo '<pre>'; print_r($converted_array); echo '</pre>'; ;

 //echo '<h3>Form GET Method</h3>'; echo 'Prix ttc : ' . $ttc . '<br>' . 'tva : ' . $tva . '<br>' . 'tht : ' . $tht . '<br>' . 'presta_montant : ' . $presta_montant . '<br>' . 'presta_quantite : ' . $presta_quantite . '<br>' . 'presta_prix : ' . $presta_prix . '<br>' . 'presta_nom : ' . $presta_nom . '<br>' . 'nom_projet : ' . $nom_projet . '<br>' ;
/*echo $prenom . $nom . $adresse;

echo 'presta_quantite : ' . $presta_quantite . '<br>' . 'presta_prix : ' . $presta_prix . '<br>' . 'presta_nom : ' . $presta_nom . '<br>' . 'nom_projet : ' . $nom_projet . '<br>' ;

*/

}






/*
	$rngproducts = random_int(2, 18);

	$nbproducts = range(1, $rngproducts);
	//echo $nbproducts;
	$products = array();

foreach($nbproducts as $nbp){
       	
     

           //echo $nbp;

			$libelle = "Joli cochon n°". $nbp;
			$qte = random_int(1, 3);
			$pu = random_int(100, 200);
			$taux_tva = 20;

           	$product = array($libelle,$qte,$pu,$taux_tva);

           	$products[] = $product;
           	echo "echo de \$product[X] : ". $product[0] . " " . " qte : " . $product[1] . " prix/u : " . $product[2] . " € " . "TVA : " . $product[3] . " % <br>";
        
    }

 	?>	<br><br><br><?php

    		echo "echo de \$products[0][0] : " . $products[0][0] . "<br>";
    		echo "echo de \$products[2][2] : " . $products[2][2] . " € ";


	?>	<br><br><br><br><br><br><br><br><br><?php


		foreach($nbproducts as $nbp){

			echo "echo de \$products[$nbp][0] : " . $products[$nbp-1][0] . "<br>";
			echo "echo de \$products[$nbp][1] : " . $products[$nbp-1][1] . "<br>";
			echo "echo de \$products[$nbp][2] : " . $products[$nbp-1][2] . "<br>";
			echo "echo de \$products[$nbp][3] : " . $products[$nbp-1][3] . "<br>";

 		}*/



		 ?>

</div>


<footer>

</footer>
<script src="js/agency.min.js"></script>
</body>
</html>

