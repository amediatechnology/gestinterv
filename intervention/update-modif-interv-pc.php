<?php
include('../admin/id_bdd.php');  

// Récupération des cases cochées - LOGICIELS
if (isset($_POST['logiciels']) && !empty($_POST['logiciels'])) // Si les POST_Logiciels existent & ne sont pas vides
{
	foreach ($_POST['logiciels'] as $logiciels) // Pour tous les POST_Logiciel devenu ici la variable "$logiciels"
		{ $tabLogiciels[] = $logiciels; } // Remplissage d'un tableau contenant les POST_logiciels

			// Tableau comprenant toutes les cases cochées - Regroupement en une seule ligne
			$strLogiciels = addslashes( (implode(", ", $tabLogiciels)) );
}
else 
{ $strLogiciels = " "; } // Aucun statut de coché

// Récupération des cases cochées - MAJ


if (isset($_POST['maj']) && !empty($_POST['maj'])) // Si les POST_Logiciels existent & ne sont pas vides
{
	foreach ($_POST['maj'] as $maj) // Pour tous les POST_Logiciel devenu ici la variable "$logiciels"
		{ $tabMaj[] = $maj; }// Remplissage d'un tableau contenant les POST_logiciels

			// Tableau comprenant toutes les cases cochées - Regroupement en une seule ligne
			$strMaj = addslashes( (implode(", ", $tabMaj)) );
}
else 
{ $strMaj = " "; } // Aucun statut de coché

// Récupération des cases cochées - VIRUS
if (isset($_POST['virus']) && !empty($_POST['virus'])) // Si les POST_Logiciels existent & ne sont pas vides
{
	// Informations complémentaires quant à la case "Fiabilité ..."
	$fiabilite = addslashes($_POST['fiabilite']);
	
	foreach ($_POST['virus'] as $virus) // Pour tous les POST_Logiciel devenu ici la variable "$logiciels"
		{ $tabVirus[] = $virus; }// Remplissage d'un tableau contenant les POST_logiciels

			// Tableau comprenant toutes les cases cochées - Regroupement en une seule ligne
			$strVirus = addslashes( (implode(", ", $tabVirus)) );
			$strVirus .=' '.$fiabilite;
}
else 
{ $strVirus = " "; } // Aucun statut de coché

// Récupération des cases cochées - PERIPHERIQUES A REINSTALLER
if (isset($_POST['sauvegarde']) && !empty($_POST['sauvegarde'])) // Si les POST_Logiciels existent & ne sont pas vides
{
	foreach ($_POST['sauvegarde'] as $sauvegarde) // Pour tous les POST_Logiciel devenu ici la variable "$logiciels"
		{ $tabSauvegarde[] = $sauvegarde; }// Remplissage d'un tableau contenant les POST_logiciels

			// Tableau comprenant toutes les cases cochées - Regroupement en une seule ligne
			$strSauvegarde = addslashes( (implode(", ", $tabSauvegarde)) );
			}
else 
{ $strSauvegarde = " "; } // Aucun statut de coché

// Récupération des cases cochées - RAM
if (isset($_POST['ram']) && !empty($_POST['ram'])) // Si les POST_Logiciels existent & ne sont pas vides
{
	foreach ($_POST['ram'] as $ram) // Pour tous les POST_Logiciel devenu ici la variable "$logiciels"
		{ $tabRam[] = $ram; }// Remplissage d'un tableau contenant les POST_logiciels

			// Tableau comprenant toutes les cases cochées - Regroupement en une seule ligne
			$strRam = addslashes( (implode(", ", $tabRam)) );
			}
else 
{ $strRam = " "; } // Aucun statut de coché

// Récupération des données
$codeIntervention = $_POST["codeIntervention"];
$codeClient = $_POST["codeClient"];
$dateInterv = $_POST["dateInterv"];

if ( isset($_POST["cookies"]) ) { $cookies = $_POST["cookies"]; } // Si la case "Cookies traçeurs" a été cochée, alors on la récupère.

$antivirusexterne = $_POST["antivirus-externe"];
	$antivirusinterne = $_POST["antivirus-interne"];
		if ( isset($_POST["cookies"]) ) { $antivirus = "$antivirusinterne+$antivirusexterne+$cookies"; } // Si la case cookies a été cochée, une indication sera mise dans la colonne antivirus
		else { $antivirus = "$antivirusexterne+$antivirusinterne"; }

if ( isset($_POST["malwaresbytes-mode"]) ) { $malwaresbytes_mode = $_POST["malwaresbytes-mode"]; } // Si le mode malwaresbytes a été choisi, alors on le récupère.

$malwaresexterne = $_POST["malwares-externe"];
	$malwaresinterne = $_POST["malwares-interne"];
		if ( isset($_POST["malwaresbytes-mode"]) ) { $malwares = "$malwaresinterne+$malwaresexterne+$malwaresbytes_mode"; } // Si le mode malwaresbytes a été choisi, alors une indication sera saisie dans la colonne
		else { $malwares = "$malwaresexterne+$malwaresinterne"; }

		
$spybot = $_POST["spybot"]; // Récupération du nombre de spywares
if ( isset($_POST["scan-redemarrage"]) ) // Si la case "Scan au redémarrage" a été cochée, alors on récupère le choix
{ $scan_redemarrage = $_POST["scan-redemarrage"];
$spybot = "$spybot+$scan_redemarrage"; } // et on ajoute l'information au nombre total de spywares détectés

$intervention = $_POST["intervention"];
$materiel = $_POST["materiel"];

$observation = addslashes($_POST["observation"]);

	if ( isset($_POST["adwcleaner"]) ) // Si la case ADW Cleaner a été cochée, alors on saisi l'information dans la case observations
	{ $adwcleaner = $_POST["adwcleaner"]; 
	$observation = "$observation || $adwcleaner"; }

	if ( isset($_POST["ccleaner"]) ) // Si la case CCLeaner a été cochée, alors on saisi l'information dans la case observations
	{ $ccleaner = $_POST["ccleaner"]; 
	$observation = "$observation || $ccleaner"; }

	if ( isset($_POST["nettoyage-annexe"]) ) // Si une information complémentaire quant aux nettoyages a été saisie, alors on la saisie dans la case observations
	{ $info_nettoyage = $_POST["nettoyage-annexe"]; 
	$observation = "$observation || $info_nettoyage"; }
	
	if ( isset($_POST["serveur"]) ) // Si une information complémentaire quant aux nettoyages a été saisie, alors on la saisie dans la case observations
	{ $nom_serveur = $_POST["serveur"];
	$sauvegarde = "Les fichiers sont sauvegardés sur le serveur ".$nom_serveur;
	$observation = "$observation || $sauvegarde"; }
	
	if ( isset($_POST["suppression-ancien-antivirus"]) ) // Si une information complémentaire quant aux nettoyages a été saisie, alors on la saisie dans la case observations
	{ 
		if ( ($_POST["suppression-ancien-antivirus"]) != "Non nécessaire" )
		{
			$nom_ancien_antivirus = $_POST["suppression-ancien-antivirus"];
			$ancien_antivirus = "|| L\'ancien antivirus ".$nom_ancien_antivirus." a été supprimé et remplacé par MSE.";
			$observation = "$observation $ancien_antivirus";
		}
	}

$technicien = $_POST["technicien"];
$prix = $_POST["prix"];
$statut = $_POST["statut"];
	  	
$update = "UPDATE tinterventions SET dateInterv='$dateInterv', antivirus='$antivirus', malwares='$malwares', spybot='$spybot', logiciels='$strLogiciels', maj='$strMaj', virus='$strVirus', sauvegarde='$strSauvegarde', ram='$strRam', intervention='$intervention', materiel='$materiel', observations='$observation', technicien='$technicien', prix='$prix', statut='$statut' WHERE codeIntervention='$codeIntervention' ;";
$sql = mysql_query ( $update ) or die ( mysql_error() ) ;	

?>

<!DOCTYPE>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Gestion des fiches d'intervention - MIS Informatique</title>
	<link href="../style.css" rel="stylesheet" type="text/css" />
</head>

<body align="center">
<h2>Modifications de la fiche d'intervention n° <?php echo $codeIntervention; ?> - REUSSITE ! -</h2> <!-- TITRE -->

<form action ="../index.php?p=modifinterv" method="POST">
	<input type="hidden" name="id" value="<?php echo $codeIntervention; ?>"> 
	L'intervention a bien été a bien été modifiée !<br />
	Cliquez sur le bouton ci-dessous pour être rediriger vers la fiche d'intervention.<br /><br />
	<center><button id="bouton">Redirection vers la fiche d'intervention en cours</button></center>
</form>

</body>
</html>