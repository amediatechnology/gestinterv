<?php
include('../admin/id_bdd.php');  
	
//Création de la fiche client si les "_POST" ne sont pas vides
if ( count($_POST) != 0 )
{
	$nom		= $_POST["nom"];
	$prenom		= $_POST["prenom"];
	$telFixe	= $_POST["telFixe"];
	$telPort	= $_POST["telPort"];
	$adresse	= $_POST["adresse"];

// Ajout dans la base de données
	$add		= "INSERT INTO tclients VALUES ('','$nom','$prenom','$telFixe','$telPort','$adresse');" ;
	$Resultat1	= mysql_query ( $add )  or  die( mysql_error() ) ;
			
// Reprise du code client pour la redirection
	$client		= mysql_query ( "SELECT codeClient FROM tclients WHERE nom='$nom';" )  or  die( mysql_error() ) ;
	$ligne		= mysql_fetch_array( $client );
	  
//Stockage de l'enregistrement du codeClient dans une variable pour pouvoir rediriger
	$id			= $ligne['codeClient'];
}
?>

<!DOCTYPE>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Gestion des fiches d'intervention - MIS Informatique</title>
</head>

<body align="center">
<h2>Création d'une personne - REUSSITE ! -</h2> <!-- TITRE -->
<form action ="../index.php?p=ficheclient" method="post">
	<input type="hidden" name="id" value="<?php echo $id; ?>"> 
	<p> L'utilisateur <b><?php echo $nom; ?></b> a bien été créé !<br />
	Cliquez sur le bouton ci-dessous pour être rediriger vers sa fiche client.<br /><br />
	<input type="submit" name="redirection" value="Redirection">
	</p>
</form>
</body>
</html>
