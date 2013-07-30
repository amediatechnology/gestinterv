<?php
$id = $_POST["id"]; // Code PRE-INTERVENTION

// Affichage de la pré-intervention voulue
	$preInterv = "SELECT * FROM tpreinterv WHERE codePreInterv='$id';" ;
	$Resultat = mysql_query ( $preInterv ) or die ( mysql_error() ) ;
?>
<center>
<table border="1" rules="all">
<tr> <th colspan="3">Coordonnées du client</th> </tr>
	<?php
	// Affichage du client à modifier à partir de son code client
	$seek_client = "SELECT * FROM tclients,tpreinterv WHERE tpreinterv.codeClient=tclients.codeClient AND tpreinterv.codeClient='$id';" ;
		$Resultat1 = mysql_query ( $seek_client )  or  die ( mysql_error() ) ;
			$clt = mysql_fetch_array($Resultat1);
			$codeclt = $clt['codeClient'];

	$client = mysql_query ( "SELECT tclients.* FROM tclients,tpreinterv WHERE tclients.codeClient=tpreinterv.codeClient AND tpreinterv.codePreInterv='$id';" ) or die ( mysql_error() ) ;
	$ligne = mysql_fetch_array($client);
		  
	// Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
	echo "<tr>" ;
	echo "<td align='center'><b>"	. $ligne['nom']	. "</b> " . $ligne['prenom'] . "</td>" ;
	echo "<td align='center'>"	. $ligne['telFixe'] . "<br>" . $ligne['telPort'] . "</td>" ;
	echo "<td align='center'>"	. $ligne['adresse'] . "</td>" ;
	?>
</table>
</center>

<br /><hr><br />

<table border="1" rules="all"><caption><h3>Rappel - Pré-intervention sélectionnée</h3></caption>
<tr> <th> Date de<br>RESTITUTION </th> <th> MATERIEL </th> <th> INTERVENTION </th> <th>OBSERVATIONS</th> <th colspan="2">SAUVEGARDE</th> </tr>
<tr> <th colspan="4"> </th> <th> Dossier Mes DOCUMENTS </th> <th> Dossiers spécifiques </th> </tr>
<?php
	while ($preInterv = mysql_fetch_array($Resultat))
	{ // Reprise de toutes les infos de la pré-intervention
		echo "<tr>" ;
		echo "<td align=center><b>" . $preInterv['dateRestitution'] . "</b></td>" ;
		echo "<td align=center>" . $preInterv['materiel'] . "</td>" ;
		echo "<td align=center>" . $preInterv['typeInterv'] . "</td>" ;
		echo "<td align=center>" . $preInterv['observations'] . "</td>" ;
		echo "<td align=center>" . $preInterv['dossierMesDocs'] . "</td>" ;
		echo "<td align=center>" . $preInterv['dossierClt'] . "</td>" ;
		echo "</tr>" ;

	$materiel = $preInterv['materiel']; // Variable reprenant le nom du matériel pour le switch
?>	

</table>
<br /> <br />

<?php
		switch ($materiel) { // Selon le matériel qui a été sélectionné, la page ne sera pas la même.
			case 'PC FIXE':
			include ('pc.php'); // Page complète (logiciels, virus, obs...)
			break;

			case 'PC PORTABLE':
			include ('pc.php'); // Page complète (logiciels, virus, obs...)
			break;

			case 'IMPRIMANTE':
			include ('peripheriques.php'); // Page personnalisée (Observations, technicien)
			break;

			case 'PERIPHERIQUE':
			include ('peripheriques.php'); // Page personnalisée (Observations, technicien)
			break;

			case 'TABLETTE TACTILE':
			include ('peripheriques.php'); // Page personnalisée (Observations, technicien)
			break;

			case 'AUTRES':
			include ('peripheriques.php'); // Page personnalisée (Observations, technicien)
			break;

		} // FIN - Reprise de toutes les infos de la pré-intervention
	}
?>
