<?php
include('../admin/id_bdd.php');

// Récupération du code client
	$id			= $_GET["id"];

// Requête & éxecution de la requête de suppression
	$del		= "DELETE FROM tclients WHERE codeClient='$id';";
	$Resultat 	= mysql_query ( $del )  or  die( mysql_error() ) ;

	Header("Location: ../index.php?p=showclients");
?>
