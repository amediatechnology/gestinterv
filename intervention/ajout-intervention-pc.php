<?php
include('../admin/id_bdd.php');  

	// AJOUT D'UNE INTERVENTION
// Récupération des cases cochées - LOGICIELS
if (isset($_POST['logiciels']) && !empty($_POST['logiciels'])) // Si les POST_Logiciels existent & ne sont pas vides
{
	foreach ($_POST['logiciels'] as $logiciels) // Pour tous les POST_Logiciel devenu ici la variable "$logiciels"
		{ $tabLogiciels[] = $logiciels; } // Remplissage d'un tableau contenant les POST_logiciels

			// Tableau comprenant toutes les cases cochées - Regroupement en une seule ligne
			$strLogiciels = (implode(", ", $tabLogiciels));
			$strLogiciels = addslashes($strLogiciels);
				
			// Explosion de la chaîne de caractères
			// $strExplode = (explode(", ",$strLogiciels));
			// foreach ($strExplode as $logiciels) // Pour toutes les valeurs de la chaîne strExplode devenu la variable $logiciels
			// { echo $logiciels."<br>"; } 
}
else 
{ $strLogiciels = " "; } // Aucun statut de coché

// Récupération des cases cochées - MAJ
if (isset($_POST['maj']) && !empty($_POST['maj'])) // Si les POST_Logiciels existent & ne sont pas vides
{
	foreach ($_POST['maj'] as $maj) // Pour tous les POST_Logiciel devenu ici la variable "$logiciels"
		{ $tabMaj[] = $maj; }// Remplissage d'un tableau contenant les POST_logiciels

			// Tableau comprenant toutes les cases cochées - Regroupement en une seule ligne
			$strMaj = (implode(", ", $tabMaj));
			$strMaj = addslashes($strMaj);
}
else 
{ $strMaj = " "; } // Aucun statut de coché

// Récupération des cases cochées - VIRUS
if (isset($_POST['virus']) && !empty($_POST['virus'])) // Si les POST_Logiciels existent & ne sont pas vides
{
	// Informations complémentaires quant à la case "Fiabilité ..."
	$fiabilite = $_POST['fiabilite'];
	$fiabilite = addslashes($fiabilite);
	
	foreach ($_POST['virus'] as $virus) // Pour tous les POST_Logiciel devenu ici la variable "$logiciels"
		{ $tabVirus[] = $virus; }// Remplissage d'un tableau contenant les POST_logiciels

			// Tableau comprenant toutes les cases cochées - Regroupement en une seule ligne
			$strVirus = (implode(", ", $tabVirus));
			$strVirus = addslashes($strVirus);
			$strVirus .=' '.$fiabilite;
}
else 
{ $strVirus = " "; } // Aucun statut de coché

// Récupération des cases cochées - PERIPHERIQUES A REINSTALLER
if (isset($_POST['reinstall']) && !empty($_POST['reinstall'])) // Si les POST_Logiciels existent & ne sont pas vides
{
	foreach ($_POST['reinstall'] as $reinstall) // Pour tous les POST_Logiciel devenu ici la variable "$logiciels"
		{ $tabReinstall[] = $reinstall; }// Remplissage d'un tableau contenant les POST_logiciels

			// Tableau comprenant toutes les cases cochées - Regroupement en une seule ligne
			$strReinstall = (implode(", ", $tabReinstall));
			$strReinstall = addslashes($strReinstall);
}
else 
{ $strReinstall = " "; } // Aucun statut de coché

// Récupération des cases cochées - RAM
if (isset($_POST['ram']) && !empty($_POST['ram'])) // Si les POST_Logiciels existent & ne sont pas vides
{
	foreach ($_POST['ram'] as $ram) // Pour tous les POST_Logiciel devenu ici la variable "$logiciels"
		{ $tabRam[] = $ram; }// Remplissage d'un tableau contenant les POST_logiciels

			// Tableau comprenant toutes les cases cochées - Regroupement en une seule ligne
			$strRam = (implode(", ", $tabRam));
			$strRam = addslashes($strRam);
}
else 
{ $strRam = " "; } // Aucun statut de coché

// Récupération des données
$codePreInterv = $_POST["codePreInterv"];
$codeClient = $_POST["codeClient"];
$dateInterv = $_POST["dateInterv"];

$antivirusexterne = $_POST["antivirus-externe"];
	$antivirusinterne = $_POST["antivirus-interne"];
		$antivirus = "$antivirusinterne+$antivirusexterne";
$malwaresexterne = $_POST["malwares-externe"];
	$malwaresinterne = $_POST["malwares-interne"];
		$malwares = "$malwaresinterne+$malwaresexterne";
$spybot = $_POST["spybot"];
$intervention = $_POST["intervention"];;
$materiel = $_POST["materiel"];
$observation = $_POST["observation"];
	$observation = addslashes($observation);
$technicien = $_POST["technicien"];
$prix = $_POST["prix"];

$add_interv = "INSERT INTO tinterventions VALUES ('','$codeClient','$codePreInterv','$dateInterv','$antivirus','$malwares','$spybot','$strLogiciels','$strMaj','$strVirus','$strReinstall','$strRam','$intervention','$materiel','$observation','$technicien','$prix');";

$req = mysql_query ( $add_interv ) or die ( mysql_error() ) ;
	// FIN - AJOUT D'UNE INTERVENTION
$codeIntervention = mysql_insert_id(); // Reprise du code de l'intervention pour la redirection

// SUPPRESSION DE LA FICHE DE PRE-INTERVENTION CONCERNEE
$del = "DELETE FROM tpreinterv WHERE codePreInterv='$codePreInterv';";
$req = mysql_query ( $del )  or  die ( mysql_error() ) ;
?>

<!DOCTYPE>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Gestion des fiches d'intervention - MIS Informatique</title>
	<link href="../templatemo_style.css" rel="stylesheet" type="text/css" />
</head>

<body align="center">
<div id="templatemo_main">
    <div class="content_box">
    <h2>Création de la fiche d'intervention n° <?php echo $codeIntervention; ?> - REUSSITE ! -</h2> <!-- TITRE -->
		<div class="col_w340"> <!-- CONTENUS -->		
			<br /><hr /><br />
			<h4>Impression de la fiche</h4><br />
			L'intervention a bien été a bien été créée !<br />
			La fiche de pré-intervention a été <b>supprimée</b> !<br /><br />
			<form action="imprimer-intervention-pc.php" method="post"> <input type="hidden" name="id" value="<?php echo $codeIntervention; ?>"> <input type="submit" value="IMPRIMER" style="width:250px; height:50px;font-size:14px;"></form>
<hr />
<form action ="../index.php?p=showinterv" method="post">
			Cliquez sur le bouton ci-dessous pour être rediriger vers le récapitulatif des fiches d'intervention.<br /><br />
			<input type="submit" name="redirection" value="Redirection vers toutes les fiches" style="width:250px; height:50px;font-size:14px;">
			</form>
		</div>
    </div> <!-- end of a content box -->      
</div> <!-- end of main -->
</body>
</html>
