<?php
// Affichage de toutes les pré-interventions
	$preInterv = "SELECT * FROM tpreinterv ORDER BY dateRestitution ASC;" ;
	$Resultat2 = mysql_query ( $preInterv )  or  die ( mysql_error() ) ;
	
// Affiche du nom à côté de la pré-intervention concernée
	$client = "SELECT tclients.codeClient,tclients.nom FROM tclients,tpreinterv WHERE tclients.codeClient=tpreinterv.codeClient ORDER BY tpreinterv.dateRestitution ASC;" ;
	$Resultat3 = mysql_query ( $client )  or  die ( mysql_error() ) ;

// Affichage de toutes les interventions
	$interv = "SELECT * FROM tinterventions ORDER BY codeIntervention DESC LIMIT 0,25;" ;
	$Resultat0 = mysql_query ( $interv )  or  die ( mysql_error() ) ;

// Affiche du nom à côté de l'intervention concernée
	$client = "SELECT tclients.codeClient, tclients.nom FROM tclients, tinterventions WHERE tclients.codeClient=tinterventions.codeClient ORDER BY tinterventions.codeIntervention DESC limit 0,25" ;
	$Resultat1 = mysql_query ( $client )  or  die ( mysql_error() ) ;
?>
<fieldset><legend>﻿<h4>Recherche d'un client</h4></legend>
<center>

<form name="Recherche client par le NOM" action="index.php?p=seeknom" method="POST" class="form-seek">
<input type="text" name="nom" id="search" placeholder="NOM du client"> <input type="submit" value="Recherche" id="submit">
</form>

<form name="Recherche client par un TELEPHONE" action="index.php?p=seektel" method="POST" class="form-seek">
<input type="text" name="tel" id="search" placeholder="Téléphone FIXE" > <input type="submit" value="Recherche" id="submit">
</form>

</center>
</fieldset>

<br /><br />
<br />
<center>
<table border="1" rules="all"><legend><h3>Récapitulatif des <u><b>PRE-INTERVENTIONS</b></u></h3></legend>
<tr> <th> Date de<br>RESTITUTION </th> <th> CLIENT </th> <th> MATERIEL </th> <th> INTERVENTION </th> <th>OBSERVATIONS</th> <th colspan="2">SAUVEGARDE</th> <th colspan="3">ADMINISTRATION</th> </tr>
<tr> <th></th> <th></th> <th></th> <th></th> <th></th> <th> Mes DOCUMENTS </th> <th> Dossiers spécifiques </th> </tr>
<?php
	while (  ($preInterv = mysql_fetch_array($Resultat2)) && ($clt = mysql_fetch_array($Resultat3))  )
	{
		echo "<tr>" ;
		echo "<td align=center><b>" . $preInterv['dateDepot'] . "</b></td>" ;
		echo "<td align=center><b>" . $clt['nom'] . "</b></td>" ;
		echo "<td align=center>" . $preInterv['materiel'] . "</td>" ;
		echo "<td align=center>" . $preInterv['typeInterv'] . "</td>" ;
		echo "<td align=center>" . $preInterv['observations'] . "</td>" ;
		echo "<td align=center>" . $preInterv['dossierMesDocs'] . "</td>" ;
		echo "<td align=center>" . $preInterv['dossierClt'] . "</td>" ;
		echo "<td> <form action='index.php?p=addinterv2' method='POST'> <input type='hidden' name='id' value='" . $preInterv["codePreInterv"] . "'> <input type='submit' value='Effectuer l&apos;intervention'> </form></td>";
		echo "<td> <form action='interventions/print_preinterv.php' method='POST'> <input type='hidden' name='id' value='" . $preInterv["codePreInterv"] . "'> <input type='submit' value='Impression'> </form></td>";
		echo "<td align='center'>"."<form action='interventions/delpreinterv.php?id='" . $preInterv["codePreInterv"] . "' method='post'> <input type='hidden' name='id' value='" . $preInterv["codePreInterv"] . "'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression de la fiche ? - LA SUPPRESSION EST DEFINITIVE ET IRREMEDIABLE ! -'))\";> </form></td>" ;
		echo "</tr>" ;
  	} 
?>
</table>

<br /><hr /><br />

<table border="1" rules="all"><legend><h3>Récapitulatif des <u>25 dernières <b>INTERVENTIONS</b></u></h3></legend>
<tr> <th> DATE </th> <th> CLIENT </th> <th> INTERVENTION </th> <th>MATERIEL</th> <th>OBSERVATIONS</th> <th>PRIX</th> <th>TECHNICIEN</th> <th colspan="3">ADMINISTRATION</th> </tr>
<?php
	// Tant qu'il y a des interventions & des clients à côté... :
	while (  ($ligne0 = mysql_fetch_array($Resultat0)) && ($ligne1 = mysql_fetch_array($Resultat1)) )
	{
	// Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
		echo "<tr>" ;
		echo "<td align=center>" . $ligne0['dateInterv'] 		. "</td>" ;
		echo "<td align=center><b>" . $ligne1['nom'] 			. "</b></td>" ;
		echo "<td align=center>" . $ligne0['intervention'] 	. "</td>" ;
		echo "<td align=center>" . $ligne0['materiel'] 			. "</td>" ;
		echo "<td align=center>" . $ligne0['observations']	 	. "</td>" ;
		echo "<td align=center>" . $ligne0['prix'] 				. " €</td>" ;
		echo "<td align=center>" . $ligne0['technicien'] 		. "</td>" ;
		echo "<td> <form action='index.php?p=modifinterv' method='post'> <input type='hidden' name='id' value='" . $ligne0["codeIntervention"] . "'> <input type='submit' value='Modification'> </form></td>";

$materiel = $ligne0['materiel']	;

switch ($materiel) { // Selon le matériel qui a été sélectionné, la page ne sera pas la même.
	case 'PC FIXE':
	echo "<td> <form action='interventions/print_interv1.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Impression'> </form></td>";
	break;

	case 'PC PORTABLE':
	echo "<td> <form action='interventions/print_interv1.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Impression'> </form></td>";
	break;

	case 'IMPRIMANTE':
	echo "<td> <form action='interventions/print_interv2.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Impression'> </form></td>";
	break;
	
	case 'TABLETTE TACTILE':
	echo "<td> <form action='interventions/print_interv2.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Impression'> </form></td>";
	break;

	case 'PERIPHERIQUE':
	echo "<td> <form action='interventions/print_interv2.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Impression'> </form></td>";
	break;

	case 'AUTRES':
	echo "<td> <form action='interventions/print_interv2.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Impression'> </form></td>";
	break;
 }

		echo "</tr>" ;
  	} 
?>
</table>
</center>
