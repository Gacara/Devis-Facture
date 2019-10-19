<?php


	//require('/gestion/add-devis.php');
	require('fpdf.php');
	
	// le mettre au debut car plante si on declare $mysqli avant !
	$pdf = new FPDF( 'P', 'mm', 'A4' );
/*
 if ( isset( $_GET['submit'] ) ) { // retrieve the form data by using the element's name attributes value as key 
 $ttc = $_GET['ttc']; $tva = $_GET['tva']; $tht = $_GET['tht']; $presta_montant = $_GET['presta_montant']; 
 $presta_quantite = $_GET['presta_quantite']; $presta_prix = $_GET['presta_prix']; $presta_nom = $_GET['presta_nom']; $nom_projet = $_GET['nom_projet'];

 echo '<h3>Form GET Method</h3>'; echo 'Prix ttc : ' . $ttc . '<br>' . 'tva : ' . $tva . '<br>' . 'tht : ' . $tht . '<br>' . 'presta_montant : ' . $presta_montant . '<br>' . 'presta_quantite : ' . $presta_quantite . '<br>' . 'presta_prix : ' . $presta_prix . '<br>' . 'presta_nom : ' . $presta_nom . '<br>' . 'nom_projet : ' . $nom_projet . '<br>' ;
}
	*/
if ( isset( $_GET['submit'] ) ) { // retrieve the form data by using the element's name attributes value as key 
 $prenom = base64_decode($_GET['prenom']); $nom = base64_decode($_GET['nom']); $telephone = base64_decode($_GET['telephone']); base64_decode($mail = $_GET['mail']); 
 $adresse = base64_decode($_GET['adresse']); $code_postal = base64_decode($_GET['code_postal']);

$nbpresta = $_GET['presta']; $converted_array = json_decode(stripslashes($_GET['converted_array']),true);

}


	// variables de l'input ttc  tva   tht  presta_montant presta_quantite presta_prix presta_nom  nom_projet

	// on sup les 2 cm en bas
	$pdf->SetAutoPagebreak(False);
	$pdf->SetMargins(0,0,0);

	// nb de page pour le multi-page : 18 lignes

	$nb_page = 1;
	
	$num_page = 1; $limit_inf = 0; $limit_sup = 18;


		$total_ht = 0;
		$total_tva = 0;
		$total_ttc = 0;

/*
		$rngproducts = random_int(2, 18);
		$nbproducts = range(1, $rngproducts);
		$products = array();

		foreach($nbproducts as $nbp){
    
			$libelle = "Joli cochon n°". $nbp;
			$qte = random_int(1, 3);
			$pu = random_int(100, 200);
			$taux_tva = 20;
           	$product = array($libelle,$qte,$pu,$taux_tva);
           	$products[] = $product;      
    		
           	$total_ht += $pu*$qte;
       
           
}

*/
$nbproducts = range(1, $nbpresta);

for($nb=0;$nb<$nbpresta;$nb++) {


			$libelle = $converted_array[$nb]['name'];
			$qte = $converted_array[$nb]['qte'];
			$pu = $converted_array[$nb]['prix'];
			$taux_tva = 20;
           	$product = array($libelle,$qte,$pu,$taux_tva);
           	$products[] = $product;      
           	$total_ht += $pu*$qte;

}




$total_tva = $total_ht * ($taux_tva/100);
$total_ttc += $total_ht + $total_tva;

	While ($num_page <= $nb_page)
	{
		$pdf->AddPage();
		
		// logo : 80 de largeur et 55 de hauteur
		$pdf->Image('src/devis.jpg', 10, 10, 80, 55);

		// n° page en haute à droite
		$pdf->SetXY( 120, 5 ); $pdf->SetFont( "Arial", "B", 12 ); $pdf->Cell( 160, 8, $num_page . '/' . $nb_page, 0, 0, 'C');
		
		// n° facture, date echeance et reglement et obs
		
		//date,numero,mnt_ttc,mnt_ht,mnt_tva,obs,reglement,date_echeance


		$date=random_int(2000, 2019) . "-" . random_int(1, 12) . "-" .random_int(1, 31);
		$numero=random_int(1000, 9999);
		$mnt_ttc=random_int(100, 200) ;
		$mnt_tva=20;
		$mnt_ht= $mnt_ttc*(100-$mnt_tva);
		$obs="";
		$reglement="";
		$date_echeance = random_int(2000, 2019) . "-" . random_int(1, 12) . "-" . random_int(1, 31);



		$champ_date = date_create($date); $annee = date_format($champ_date, 'Y');
		$num_fact = "FACTURE N° " . $annee .'-' . str_pad($numero, 4, '0', STR_PAD_LEFT);
		$pdf->SetLineWidth(0.1); $pdf->SetFillColor(192); $pdf->Rect(120, 15, 85, 8, "DF");
		$pdf->SetXY( 120, 15 ); $pdf->SetFont( "Arial", "B", 12 ); $pdf->Cell( 85, 8, $num_fact, 0, 0, 'C');
		
		// nom du fichier final
		$nom_file = "fact_" . $annee .'-' . str_pad($numero, 4, '0', STR_PAD_LEFT) . ".pdf";
		
		// date facture
		$champ_date = date_create($date); $date_fact = date_format($champ_date, 'd/m/Y');
		$pdf->SetFont('Arial','',11); $pdf->SetXY( 122, 30 );
		$pdf->Cell( 60, 8, "MA VILLE, le " . $date_fact, 0, 0, '');
		
		// si derniere page alors afficher total
		if ($num_page == $nb_page)
		{
			// les totaux, on n'affiche que le HT. le cadre après les lignes, demarre a 213
			$pdf->SetLineWidth(0.1); $pdf->SetFillColor(192); $pdf->Rect(5, 213, 90, 8, "DF");
			// HT, la TVA et TTC sont calculés après
			$nombre_format_francais = "Total HT : " .  number_format($total_ht, 2, ',', ' ') . " €";
			$pdf->SetFont('Arial','',10); $pdf->SetXY( 95, 213 ); $pdf->Cell( 63, 8, $nombre_format_francais, 0, 0, 'C');
			// en bas à droite
			$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 227 ); $pdf->Cell( 24, 6, number_format($total_ht, 2, ',', ' '), 0, 0, 'R');

			// trait vertical cadre totaux, 8 de hauteur -> 213 + 8 = 221
			$pdf->Rect(5, 213, 200, 8, "D"); $pdf->Line(95, 213, 95, 221); $pdf->Line(158, 213, 158, 221);

			// reglement
			$pdf->SetXY( 5, 225 ); $pdf->Cell( 38, 5, "Mode de Règlement :", 0, 0, 'R'); $pdf->Cell( 55, 5, $obs, 0, 0, 'L');
			// echeance
			$champ_date = date_create($date_echeance); $date_ech = date_format($champ_date, 'd/m/Y');
			$pdf->SetXY( 5, 230 ); $pdf->Cell( 38, 5, "Date Echéance :", 0, 0, 'R'); $pdf->Cell( 38, 5, $date_ech, 0, 0, 'L');
		}
		
		// observations
		$pdf->SetFont( "Arial", "BU", 10 ); $pdf->SetXY( 5, 75 ) ; $pdf->Cell($pdf->GetStringWidth("Observations"), 0, "Observations", 0, "L");
		$pdf->SetFont( "Arial", "", 10 ); $pdf->SetXY( 5, 78 ) ; $pdf->MultiCell(190, 4, $obs, 0, "L");

		// adr fact du client
	//select nom,adr1,adr2,adr3,cp,ville,num_tva

		$nom = $prenom . " " . $nom;
		$adr1 = "Bâtiment X";
		$adr2 = $adresse;
		$adr3 = "";
		$cp = $code_postal;
		$ville = "Ville";
		$num_tva = "";
		


		$pdf->SetFont('Arial','B',11); $x = 110 ; $y = 50;
		$pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, $nom, 0, 0, ''); $y += 4;
		if ($adr1) { $pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, $adr1, 0, 0, ''); $y += 4;}
		if ($adr2) { $pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, $adr2, 0, 0, ''); $y += 4;}
		if ($adr3) { $pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, $adr3, 0, 0, ''); $y += 4;}
		if ($cp || $ville) { $pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, $cp . ' ' .$ville , 0, 0, ''); $y += 4;}
		if ($num_tva) { $pdf->SetXY( $x, $y ); $pdf->Cell( 100, 8, 'N° TVA Intra : ' . $num_tva, 0, 0, '');}
		
		// ***********************
		// le cadre des articles
		// ***********************
		// cadre avec 18 lignes max ! et 118 de hauteur --> 95 + 118 = 213 pour les traits verticaux
		$pdf->SetLineWidth(0.1); $pdf->Rect(5, 95, 200, 118, "D");
		// cadre titre des colonnes
		$pdf->Line(5, 105, 205, 105);
		// les traits verticaux colonnes
		$pdf->Line(145, 95, 145, 213); $pdf->Line(158, 95, 158, 213); $pdf->Line(176, 95, 176, 213); $pdf->Line(187, 95, 187, 213);
		// titre colonne
		$pdf->SetXY( 1, 96 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 140, 8, "Libellé", 0, 0, 'C');
		$pdf->SetXY( 145, 96 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 13, 8, "Qté", 0, 0, 'C');
		$pdf->SetXY( 156, 96 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 22, 8, "PU HT", 0, 0, 'C');
		$pdf->SetXY( 177, 96 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 10, 8, "TVA", 0, 0, 'C');
		$pdf->SetXY( 185, 96 ); $pdf->SetFont('Arial','B',8); $pdf->Cell( 22, 8, "TOTAL HT", 0, 0, 'C');
		
		// les articles
		$pdf->SetFont('Arial','',8);
		$y = 97;
		// 1ere page = LIMIT 0,18 ;  2eme page = LIMIT 18,36 etc...
		// select libelle,qte,pu,taux_tva FROM ligne_facture where id_facture
		
		

		foreach($nbproducts as $nbp){

    // 0 = libelle 1 = quantité 2 = prix/u 3 = TVA
				
    			// libelle
			$pdf->SetXY( 7, $y+9 ); $pdf->Cell( 140, 5, $products[$nbp-1][0], 0, 0, 'L');
			// qte
			$pdf->SetXY( 145, $y+9 ); $pdf->Cell( 13, 5, strrev(wordwrap(strrev($products[$nbp-1][1]), 3, ' ', true)), 0, 0, 'R');
			// PU
			$nombre_format_francais = number_format($products[$nbp-1][2], 2, ',', ' ');
			$pdf->SetXY( 158, $y+9 ); $pdf->Cell( 18, 5, $nombre_format_francais, 0, 0, 'R');
			// Taux
			$nombre_format_francais = number_format($products[$nbp-1][3], 2, ',', ' ');
			$pdf->SetXY( 177, $y+9 ); $pdf->Cell( 10, 5, $nombre_format_francais, 0, 0, 'R');
			// total
			$nombre_format_francais = number_format($products[$nbp-1][1]*$products[$nbp-1][2], 2, ',', ' ');
			$pdf->SetXY( 187, $y+9 ); $pdf->Cell( 18, 5, $nombre_format_francais, 0, 0, 'R');
			
			$pdf->Line(5, $y+14, 205, $y+14);
			
			$y += 6;

    		
    		}

	

		// si derniere page alors afficher cadre des TVA
		if ($num_page == $nb_page)
		{
			// le detail des totaux, demarre a 221 après le cadre des totaux
			$pdf->SetLineWidth(0.1); $pdf->Rect(130, 221, 75, 24, "D");
			// les traits verticaux
			$pdf->Line(147, 221, 147, 245); $pdf->Line(164, 221, 164, 245); $pdf->Line(181, 221, 181, 245);
			// les traits horizontaux pas de 6 et demarre a 221
			$pdf->Line(130, 227, 205, 227); $pdf->Line(130, 233, 205, 233); $pdf->Line(130, 239, 205, 239);
			// les titres
			$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 221 ); $pdf->Cell( 24, 6, "TOTAL", 0, 0, 'C');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY( 105, 221 ); $pdf->Cell( 25, 6, "Taux TVA", 0, 0, 'R');
			$pdf->SetXY( 105, 227 ); $pdf->Cell( 25, 6, "Total HT", 0, 0, 'R');
			$pdf->SetXY( 105, 233 ); $pdf->Cell( 25, 6, "Total TVA", 0, 0, 'R');
			$pdf->SetXY( 105, 239 ); $pdf->Cell( 25, 6, "Total TTC", 0, 0, 'R');

			// les taux de tva et HT et TTC
		/*	$col_ht = 0; $col_tva = 0; $col_ttc = 0;
			$taux = 0; $tot_tva = 0; $tot_ttc = 0;*/
			$x = 130;
					
			
// 0 = titre 1 = quantité 2 = prix/u 3 = TVA

			{
				$pdf->SetXY( $x, 221 ); $pdf->Cell( 17, 6, $mnt_tva . ' %', 0, 0, 'C');
				

				$nombre_format_francais = number_format($total_ht, 2, ',', ' ');
				$pdf->SetXY( $x, 227 ); $pdf->Cell( 17, 6, $nombre_format_francais, 0, 0, 'R');
				
				
				
				$nombre_format_francais = number_format($total_tva, 2, ',', ' ');
				$pdf->SetXY( $x, 233 ); $pdf->Cell( 17, 6, $nombre_format_francais, 0, 0, 'R');
				
			
				$nombre_format_francais = number_format($total_ttc, 2, ',', ' ');
				$pdf->SetXY( $x, 239 ); $pdf->Cell( 17, 6, $nombre_format_francais, 0, 0, 'R');
				
				
				
				$x += 17;
			}
			
		



			$nombre_format_francais = "Net à payer TTC : " . number_format($total_ttc, 2, ',', ' ') . " €";
			$pdf->SetFont('Arial','B',12); $pdf->SetXY( 5, 213 ); $pdf->Cell( 90, 8, $nombre_format_francais, 0, 0, 'C');
			// en bas à droite
			$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 239 ); $pdf->Cell( 24, 6, number_format($total_ttc, 2, ',', ' '), 0, 0, 'R');
			// TVA
			$nombre_format_francais = "Total TVA : " . number_format($total_tva, 2, ',', ' ') . " €";
			$pdf->SetFont('Arial','',10); $pdf->SetXY( 158, 213 ); $pdf->Cell( 47, 8, $nombre_format_francais, 0, 0, 'C');
			// en bas à droite
			$pdf->SetFont('Arial','B',8); $pdf->SetXY( 181, 233 ); $pdf->Cell( 24, 6, number_format($total_tva, 2, ',', ' '), 0, 0, 'R');
		}








		// **************************
		// pied de page
		// **************************
		$pdf->SetLineWidth(0.1); $pdf->Rect(5, 260, 200, 6, "D");
		$pdf->SetXY( 1, 260 ); $pdf->SetFont('Arial','',7);
		$pdf->Cell( $pdf->GetPageWidth(), 7, "Clause de réserve de propriété (loi 80.335 du 12 mai 1980) : Les marchandises vendues demeurent notre propriété jusqu'au paiement intégral de celles-ci.", 0, 0, 'C');
		
		$y1 = 270;
		//Positionnement en bas et tout centrer
		$pdf->SetXY( 1, $y1 ); $pdf->SetFont('Arial','B',10);
		$pdf->Cell( $pdf->GetPageWidth(), 5, "REF BANCAIRE : FR76 xxx - BIC : xxxx", 0, 0, 'C');
		
		$pdf->SetFont('Arial','',10);
		
		$pdf->SetXY( 1, $y1 + 4 ); 
		$pdf->Cell( $pdf->GetPageWidth(), 5, "NOM SOCIETE", 0, 0, 'C');
		
		$pdf->SetXY( 1, $y1 + 8 );
		$pdf->Cell( $pdf->GetPageWidth(), 5, $adresse . " " . $code_postal . " VILLE", 0, 0, 'C');

		$pdf->SetXY( 1, $y1 + 12 );
		$pdf->Cell( $pdf->GetPageWidth(), 5, "Tel + Mail + SIRET", 0, 0, 'C');

		$pdf->SetXY( 1, $y1 + 16 );
		$pdf->Cell( $pdf->GetPageWidth(), 5, "Adresse web", 0, 0, 'C');
		
		// par page de 18 lignes
		$num_page++; $limit_inf += 18; $limit_sup += 18; 
	}
	
	$pdf->Output("I", $nom_file);
?>


