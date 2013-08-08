<?php //Création de la fiche client si les "_POST" ne sont pas vides
include "../admin/id_bdd.php";

if ( (isset($_POST['verif'])) && ($_POST['verif']=='add-formulaire-nouveau-client') && (count($_POST) != 0) )
{
	$nom		= addslashes($_POST["nom"]);
	$telFixe	= addslashes($_POST["telFixe"]);
	$telPort	= addslashes($_POST["telPort"]);
	$adresse 	= addslashes($_POST["adresse"]);

	$ajout_nouveau_client = mysql_query( "INSERT INTO tclients VALUES ('','$nom','','$telFixe','$telPort','$adresse');" ) or die ( mysql_error() ) ;
	$lastadd_client = mysql_insert_id();
	$id_client	= $lastadd_client;
			
// PRE-INTERVENTION
	$dateDepot = $_POST["dateDepot"];
	$dateRestitution = $_POST["dateRestitution"];
	$materiel = $_POST["materiel"];
	$password = addslashes($_POST["password"]);
	$typeInterv = $_POST["typeInterv"];
	$observations = addslashes($_POST["observations"]);

	if ( !empty($_POST['dossierMesDocs']) )
	{ $dossierMesDocs = addslashes($_POST['dossierMesDocs']); }
	else { $dossierMesDocs = "Pas de fichiers à sauvegarder - ACCORD CLIENT OK."; }
		
	if ( !empty($_POST['dossiersClt']) )
	{ $dossiersClt = addslashes($_POST['dossiersClt']); }
	else { $dossiersClt = "Aucun document ou dossier spécifique à sauvegarder - ACCORD CLIENT OK."; }
	
	$ajout2	= mysql_query ( "INSERT INTO tpreinterv VALUES ('','$id_client','$dateDepot','$dateRestitution','$materiel','$typeInterv','$observations','$password','$dossierMesDocs','$dossiersClt');" ) or die ( mysql_error() ) ;
	
	$lastadd_preinterv = mysql_insert_id(); // Reprise du code de l'intervention pour la redirection
	
	echo "<hr /><center><h2> Ajout réussi !</h2><br />
	Cliquez sur le bouton pour imprimer : <form action='print_preinterv.php' method='POST'> <input type='hidden' name='id' value='".$lastadd_preinterv."'> <input type='submit' value='IMPRIMER' style='width:250px; height:50px;font-size:14px;'></form>
	</center><hr />";
}

else
{
	if ( (isset($_POST['verif'])) && ($_POST['verif']=='add-formulaire-client-connu') && (count($_POST) != 0) )
	{
		$nom		= addslashes($_POST["nom"]);
		$telFixe	= addslashes($_POST["telFixe"]);
		$telPort	= addslashes($_POST["telPort"]);
		$adresse 	= addslashes($_POST["adresse"]);

		$client		= mysql_query( "SELECT codeClient FROM tclients WHERE nom='$nom' OR telFixe = '$telFixe';" ) or die ( mysql_error() ) ;
		$ligne		= mysql_fetch_array($client);
		$id_client	= $ligne['codeClient'];
			
	// PRE-INTERVENTION
		$dateDepot = $_POST["dateDepot"];
		$dateRestitution = $_POST["dateRestitution"];
		$materiel = $_POST["materiel"];
		$password = addslashes($_POST["password"]);
		$typeInterv = $_POST["typeInterv"];
		$observations = addslashes($_POST["observations"]);

		if ( !empty($_POST['dossierMesDocs']) )
		{ $dossierMesDocs = addslashes($_POST['dossierMesDocs']); }
		else { $dossierMesDocs = "Aucun document à sauvegarder - ACCORD CLIENT."; }
			
		if ( !empty($_POST['dossiersClt']) )
		{ $dossiersClt = addslashes($_POST['dossiersClt']); }
		else { $dossiersClt = "Aucun document à sauvegarder - ACCORD CLIENT."; }
		
		$ajout2	= mysql_query ( "INSERT INTO tpreinterv VALUES ('','$id_client','$dateDepot','$dateRestitution','$materiel','$typeInterv','$observations','$password','$dossierMesDocs','$dossiersClt');" ) or die ( mysql_error() ) ;
		
		$lastadd = mysql_insert_id(); // Reprise du code de l'intervention pour la redirection
		
		echo "<hr /><center><h2> Ajout réussi !</h2><br />
		Cliquez sur le bouton pour imprimer : <form action='print_preinterv.php' method='post'> <input type='hidden' name='id' value='".$lastadd."'> <input type='submit' value='IMPRIMER' style='width:250px; height:50px;font-size:14px;'></form>
		</center><hr />";
	}
}
?>