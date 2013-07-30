<?php
// Affichage de toutes les pré-interventions
	$preInterv = "SELECT * FROM tpreinterv ORDER BY dateRestitution ASC;" ;
	$Resultat2 = mysql_query ( $preInterv ) or die ( mysql_error() ) ;
	
// Affiche du nom à côté de la pré-intervention concernée
	$client = "SELECT tclients.codeClient,tclients.nom FROM tclients,tpreinterv WHERE tclients.codeClient=tpreinterv.codeClient ORDER BY tpreinterv.dateRestitution ASC;" ;
	$Resultat3 = mysql_query ( $client ) or die ( mysql_error() ) ;

// Affichage de toutes les interventions
	$interv = "SELECT * FROM tinterventions ORDER BY codeIntervention DESC LIMIT 0,25;" ;
	$Resultat0 = mysql_query ( $interv ) or die ( mysql_error() ) ;

// Affiche du nom à côté de l'intervention concernée
	$client = "SELECT tclients.codeClient, tclients.nom FROM tclients, tinterventions WHERE tclients.codeClient=tinterventions.codeClient ORDER BY tinterventions.codeIntervention DESC limit 0,25" ;
	$Resultat1 = mysql_query ( $client ) or die ( mysql_error() ) ;
?>

<center>
<fieldset style="width:600px; text-align:justify;"><center><h3>Recherche du client</h3></center>
	<form action="index.php?p=recherche" method="POST">
		Rercherche par le <b>NOM</b> : <input type="text" size="25" name="nom-client" placeholder="NOM du client" /> <input type="submit" value="Rechercher" /><br />
	</form>
	
	<form action="index.php?p=recherche" method="POST">
		Rercherche par le <b>TÉLÉPHONE FIXE</b> : <input type="text" size="25" name="tel-client" placeholder="Téléphone FIXE du client" /> <input type="submit" value="Rechercher" />
	</form>
</fieldset>
</center>

<br />
<center>
<table border="1" rules="all"><legend><h3>Récapitulatif des <u><b>PRE-INTERVENTIONS</b></u></h3></legend>
<tr> <th> Date de<br>RESTITUTION </th> <th> CLIENT </th> <th> MATERIEL </th> <th> INTERVENTION </th> <th>OBSERVATIONS</th> <th colspan="2">SAUVEGARDE</th> <th colspan="3">ADMINISTRATION</th> </tr>
<tr> <th colspan="5"> </th> <th>Mes DOCUMENTS </th> <th> Dossiers spécifiques </th> </tr>
<?php
	while ( ($preInterv = mysql_fetch_array($Resultat2)) && ($clt = mysql_fetch_array($Resultat3)) )
	{
		echo "<tr>" ;
		echo "<td align=center><b>" . $preInterv['dateRestitution'] . "</b></td>" ;
		echo "<td align=center><b>" . $clt['nom'] . "</b></td>" ;
		echo "<td align=center>" . $preInterv['materiel'] . "</td>" ;
		echo "<td align=center>" . $preInterv['typeInterv'] . "</td>" ;
		echo "<td align=center>" . $preInterv['observations'] . "</td>" ;
		echo "<td align=center>" . $preInterv['dossierMesDocs'] . "</td>" ;
		echo "<td align=center>" . $preInterv['dossierClt'] . "</td>" ;
		echo "<td> <form action='index.php?p=interv-preinterv' method='POST'> <input type='hidden' name='id' value='".$preInterv["codePreInterv"]."' /> <input type='submit' value='Effectuer l&apos;intervention' /> </form></td>";
		echo "<td> <form action='preintervention/print_preinterv.php' method='POST'> <input type='hidden' name='id' value='" . $preInterv["codePreInterv"] . "'> <input type='submit' value='Impression'> </form></td>";
		echo "<td> <form action='intervention/suppression-preinterv.php?id='".$preInterv["codePreInterv"]."' method='post'> <input type='hidden' name='id' value='".$preInterv["codePreInterv"]."'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression de la fiche de pré-intervention ? - LA SUPPRESSION EST DEFINITIVE ET IRREMEDIABLE ! -'))\";> </form></td>" ;
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
		$materiel = $ligne0['materiel']	;
		
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

		switch ($materiel) { // Selon le matériel qui a été sélectionné, la page ne sera pas la même.
			case 'PC FIXE':
			echo "<td> <form action='intervention/imprimer-intervention-pc.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;

			case 'PC PORTABLE':
			echo "<td> <form action='intervention/imprimer-intervention-pc.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;

			case 'IMPRIMANTE':
			echo "<td> <form action='intervention/imprimer-intervention-peripheriques.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;
			
			case 'TABLETTE TACTILE':
			echo "<td> <form action='intervention/imprimer-intervention-peripheriques.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;

			case 'PERIPHERIQUE':
			echo "<td> <form action='intervention/imprimer-intervention-peripheriques.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;

			case 'AUTRES':
			echo "<td> <form action='intervention/imprimer-intervention-peripheriques.php' method='POST'> <input type='hidden' name='id' value='" . $ligne0['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;
		 }
		echo "</tr>" ;
  	} 
?>
</table>
</center>
