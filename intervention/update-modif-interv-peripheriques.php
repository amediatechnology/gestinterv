<?php
include("../admin/id_bdd.php");

$strLogiciels = " ";
$strMaj = " ";
$strVirus = " ";
$strReinstall = " ";
$strRam = " ";

// Récupération des données

$codeIntervention = $_POST["codeIntervention"];
$codeClient = $_POST["codeClient"];
$dateInterv = $_POST["dateInterv"];
$antivirus = "0";
$malwares = "0";
$spybot = "0";
$intervention = $_POST["intervention"];
$materiel = $_POST["materiel"];
$observation = $_POST["observation"];
$technicien = $_POST["technicien"];
$prix = $_POST["prix"];
	  	
	$update = "UPDATE tinterventions SET dateInterv='$dateInterv', antivirus='$antivirus', malwares='$malwares', spybot='$spybot', logiciels='$strLogiciels', maj='$strMaj', virus='$strVirus', reinstall='$strReinstall', ram='$strRam', intervention='$intervention', materiel='$materiel', observations='$observation', technicien='$technicien', prix='$prix' WHERE codeIntervention='$codeIntervention' ;";
	$sql = mysql_query ( $update )  or  die(mysql_error() ) ;	

?>

<!DOCTYPE>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Gestion des fiches d'intervention - MIS Informatique</title>
</head>

<body align="center">
<h2>Modifications de la fiche d'intervention n° <?php echo $codeIntervention; ?> - REUSSITE ! -</h2> <!-- TITRE -->

<form action ="../index.php?p=modifinterv" method="POST">
	<input type="hidden" name="id" value="<?php echo $codeIntervention; ?>"> 
	<p> L'intervention a bien été a bien été modifiée !<br />
	Cliquez sur le bouton ci-dessous pour être rediriger vers la fiche d'intervention.<br /><br />
	<input type="submit" name="redirection" value="Redirection">
	</p>
</form>

</body>

</html>