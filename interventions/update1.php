<?php
include("../admin/id_bdd.php");

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

$codeIntervention = $_POST["codeIntervention"];
$codeClient = $_POST["codeClient"];
$dateInterv = $_POST["dateInterv"];
$antivirusexterne = $_POST["antivirus-externe"];
	$antivirusinterne = $_POST["antivirus-interne"];
		$antivirus = "$antivirusinterne+$antivirusexterne";
$malwaresexterne = $_POST["malwares-externe"];
	$malwaresinterne = $_POST["malwares-interne"];
		$malwares = "$malwaresinterne+$malwaresexterne";
$spybot = $_POST["spybot"];
$intervention = $_POST["intervention"];
$materiel = $_POST["materiel"];
$observation = $_POST["observation"];
$technicien = $_POST["technicien"];
$prix = $_POST["prix"];
	  	
	$update = "UPDATE tinterventions SET dateInterv='$dateInterv', antivirus='$antivirus', malwares='$malwares', spybot='$spybot', logiciels='$strLogiciels', maj='$strMaj', virus='$strVirus', reinstall='$strReinstall', ram='$strRam', intervention='$intervention', materiel='$materiel', observations='$observation', technicien='$technicien', prix='$prix' WHERE codeIntervention='$codeIntervention' ;";
	$sql = mysql_query ( $update )  or  die(mysql_error() ) ;	

?>

<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Gestion des fiches d'intervention - MIS Informatique</title>
	<link href="../templatemo_style.css" rel="stylesheet" type="text/css" />
</head>

<body align="center">
<div id="templatemo_main">
    <div class="content_box">
    <h2>Modifications de la fiche d'intervention n° <?php echo $codeIntervention; ?> - REUSSITE ! -</h2> <!-- TITRE -->
		<div class="col_w340"> <!-- CONTENUS -->		
			<form action ="../index.php?p=modifinterv" method="POST">
				<input type="hidden" name="id" value="<?php echo $codeIntervention; ?>"> 
				<p> L'intervention a bien été a bien été modifiée !<br />
				Cliquez sur le bouton ci-dessous pour être rediriger vers la fiche d'intervention.<br /><br />
				<input type="submit" name="redirection" value="Redirection">
				</p>
			</form>
		</div>
    </div> <!-- end of a content box -->      
</div> <!-- end of main -->
</body>
</html>
