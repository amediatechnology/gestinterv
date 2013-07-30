<?php
// ID Intervention
$id = $_POST["id"];
	
// Affichage du client à modifier à partir de son code client
$interv = mysql_query ( "SELECT * FROM tinterventions WHERE codeIntervention='$id';" ) or die ( mysql_error() );
$ligne = mysql_fetch_array($interv);
$materiel = $ligne["materiel"];

switch ($materiel) { // Selon le matériel qui a été sélectionné, la page ne sera pas la même.
	case "PC FIXE":
	include ("pc-modif.php"); // Page complète (logiciels, virus, obs...)
	break;

	case "PC PORTABLE":
	include ("pc-modif.php"); // Page complète (logiciels, virus, obs...)
	break;

	case "IMPRIMANTE":
	include ("peripheriques-modif.php"); // Page personnalisée (Observations, technicien)
	break;

	case "PERIPHERIQUE":
	include ("peripheriques-modif.php"); // Page personnalisée (Observations, technicien)
	break;

	case "TABLETTE TACTILE":
	include ("peripheriques-modif.php"); // Page personnalisée (Observations, technicien)
	break;

	case "AUTRES":
	include ("peripheriques-modif.php"); // Page personnalisée (Observations, technicien)
	break;
}
?>