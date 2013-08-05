<?php

$id = $_POST["id"]; // Récupération de la dernière fiche de pré-intervention saisie
	
// Affichage de toutes les interventions
	$intervention = mysql_query ( "SELECT * FROM tinterventions WHERE codeIntervention = '$id';" ) or die ( mysql_error() ) ;
	
// Affiche du nom à côté de l'intervention concernée
	$client = mysql_query ( "SELECT tclients.* FROM tclients, tinterventions WHERE tclients.codeClient=tinterventions.codeClient;" ) or die ( mysql_error() ) ;

while ( ($ligne = mysql_fetch_array($intervention)) && ($ligne1 = mysql_fetch_array($client)) )
{
?>
	<body>
	<form action="facturation/imprimer-facture.php" method="POST">
	Date de la facture : <input type="text" class="calendrier" name="dateFacturation" value="<?php echo date("d/m/Y") ?>" />
	</form>
<?php
} // Fin boucle
?>
	</body>