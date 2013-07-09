<?php
	include('../admin/id_bdd.php');

// UPDATE DE LA FICHE D'UN CLIENT
	$id			= $_POST["id"];
	$nom		= $_POST["nom"];
	$prenom		= $_POST["prenom"];
	$telFixe	= $_POST["telFixe"];
	$telPort	= $_POST["telPort"];
	$adresse	= $_POST["adresse"];
			   	
	$maj_client = "UPDATE tclients SET nom='$nom', prenom='$prenom', telFixe='$telFixe', telPort='$telPort', adresse='$adresse' WHERE codeClient='$id';" ;
	$Resultat 	= mysql_query ( $maj_client ) or die( mysql_error() ) ;	
	
// Reprise du code client pour la redirection
	$client 	= mysql_query ( "SELECT codeClient FROM tclients WHERE nom='$nom';" )  or  die( mysql_error() ) ;
	$ligne 		= mysql_fetch_array($client);
	  
//Stockage de l'enregistrement du codeClient dans une variable pour pouvoir rediriger
	$id 		= $ligne['codeClient'];	
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
    <h2>Modification d'une personne - REUSSITE ! -</h2><!-- TITRE -->
		<div class="col_w340">	<!-- CONTENUS -->		
			<form action ="../index.php?p=addinterv" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>"> 
				<p> L'utilisateur <b><?php echo $nom; ?></b> a bien été modifié !<br />
				Cliquez sur le bouton ci-dessous pour être rediriger vers ses fiches d'intervention.<br /><br />
				<input type="submit" name="redirection" value="Redirection">
				</p>
			</form>	
		</div>
    </div> <!-- end of a content box --> 
</div> <!-- end of main -->
</body>
</html>