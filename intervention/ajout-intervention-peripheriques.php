<?php
include('../admin/id_bdd.php');  

	// AJOUT D'UNE INTERVENTION
$strLogiciels = " ";

$strMaj = " ";

$strVirus = " ";

$strReinstall = " ";

$strRam = " ";

// Récupération des données
$codePreInterv = $_POST["codePreInterv"];
$codeClient = $_POST["codeClient"];
$dateInterv = $_POST["dateInterv"];
$antivirus = "0";
$malwares = "0";
$spybot = "0";
$intervention = $_POST["intervention"];;
$materiel = $_POST["materiel"];
$observation = $_POST["observation"];
	$observation = addslashes($observation);
$technicien = $_POST["technicien"];
$prix = $_POST["prix"];

$add_interv = "INSERT INTO tinterventions VALUES ('','$codeClient','$codePreInterv','$dateInterv','$antivirus','$malwares','$spybot','$strLogiciels','$strMaj','$strVirus','$strReinstall','$strRam','$intervention','$materiel','$observation','$technicien','$prix','$statut');";

$req = mysql_query ( $add_interv ) or die ( mysql_error() ) ;
	// FIN - AJOUT D'UNE INTERVENTION
	
$codeIntervention = mysql_insert_id(); // Reprise du code de l'intervention pour la redirection

// SUPPRESSION DE LA FICHE DE PRE-INTERVENTION CONCERNEE
$del = "DELETE FROM tpreinterv WHERE codePreInterv='$codePreInterv';";
$req = mysql_query ( $del ) or die ( mysql_error() ) ;
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
			<form action="imprimer-intervention-peripheriques.php" method="post"> <input type="hidden" name="id" value="<?php echo $codeIntervention; ?>"> <input type="submit" value="IMPRIMER" style="width:250px; height:50px;font-size:14px;"></form>
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
