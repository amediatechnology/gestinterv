<?php 
include('../admin/id_bdd.php');

// Récupération de l'ID de l'intervention
	$id 		= $_POST["id"];

// Suppression de l'intervention
	$del		= "DELETE FROM tpreinterv WHERE codePreInterv='$id';";
	$Resultat	= mysql_query ( $del ) or die ( mysql_error() ) ;
	  
Header("Location: ../index.php?p=showinterv");
?>
