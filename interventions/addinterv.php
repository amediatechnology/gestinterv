<?php
$idclient = $_POST["id"]; // Code CLIENT

// Affichage du client à modifier à partir de son code client
$client = mysql_query ( "SELECT * FROM tclients WHERE codeClient='$idclient';" )  or  die( mysql_error() ) ;
$ligne0 = mysql_fetch_array($client);
?>
<center><table border="1" rules="all">
<tr> <th colspan="3">Coordonnées du client</th> </tr>	  
<?php 
	echo "<tr>" ;
	echo "<td align='center'><b>"	. $ligne0['nom'] . "</b> " . $ligne0['prenom'] . "</td>" ;
	echo "<td align='center'>"	. $ligne0['telFixe'] . "<br>" . $ligne0['telPort'] . "</td>" ;
	echo "<td align='center'>"	. $ligne0['adresse'] . "</td>" ;
?>
</table></center>
<br /><hr><br />
<table border="1" rules="all">
<caption> <b> LISTE DES INTERVENTIONS </b> </caption>
<tr> <th>DATE</th> <th>INTERVENTION</th> <th>OBSERVATIONS</th> <th>VIRUS</th> <th>MALWARES</th> <th>SPYWARES</th> <th>MATERIEL</th> <th>TECHNICIEN(S)</th> <th>COÛT</th> <th colspan="2">ADMINISTRATION</th> </tr>
<?php
// Affichage des interventions du client sélectionné
$Resultat = mysql_query ( "SELECT * FROM tinterventions WHERE codeClient='$idclient' ORDER BY codeIntervention;" )  or  die (mysql_error() ) ;

while ($ligne = mysql_fetch_array($Resultat))
{
	echo "<tr>" ;
	echo "<td align='center'>" . $ligne['dateInterv']	. "</td>" ;
	echo "<td align='center'>" . $ligne['intervention']	. "</td>" ;
	echo "<td align='center'>" . $ligne['observations']	. "</td>" ;
	echo "<td align='center'>" . $ligne['antivirus']	. "</td>" ;
	echo "<td align='center'>" . $ligne['malwares']		. "</td>" ;
	echo "<td align='center'>" . $ligne['spybot']		. "</td>" ;
	echo "<td align='center'>" . $ligne['materiel']		. "</td>" ;
	echo "<td align='center'>" . $ligne['technicien']	. "</td>" ;
	echo "<td align='center'>" . $ligne['prix']		. " €</td>" ;
	echo "<td> <form action='index.php?p=modifinterv' method='post'> <input type='hidden' name='id' value='" . $ligne["codeIntervention"] . "'> <input type='submit' value='Modification'> </form></td>";
	echo "<td align='center'>"."<form action='interventions/delinterv.php?id=" . $ligne["codeIntervention"] . "' method='post'> <input type='hidden' name='id' value='" . $ligne["codeIntervention"]."'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ;
	echo "</tr>" ;
} 
?>
</table>
<br /><hr><br />

<!-- PC FIXES ET PC PORTABLES -->

<form action="interventions/add2.php" method="POST">
<!-- Variables "cachées" - lien entre les tables / informations -->
<input type="hidden" name="codePreInterv" value="0"> <!-- Code pré-intervention -->
<input type="hidden" name="codeClient" value="<?php echo $idclient; ?>"> <!-- Code Client -->

<fieldset> <legend><h1>Nouvelle intervention</h1></legend>
	<b>Date de l'intervention</b> : <input name="dateInterv" type="text" size="8" class="calendrier" value="<?php echo date('d/m/Y'); ?>" size="5"> (date du jour)<br />
	
	<br />
	
	<fieldset><legend><h3>Partie 1 - Analyses antivirus / anti-spywares</h3></legend>
		<table border="1" rules="rows">
		<tr> <td>&nbsp;</td> <td>Analyses<br />internes</td> <td>Analyses<br />externes</td> </tr>
		<tr> <td>Virus</td> <td><input name="antivirus-interne" type="text" size="6"></td> <td><input name="antivirus-externe" type="text" size="6"></td> </tr>
		<tr> <td>Malwares</td> <td><input name="malwares-interne" type="text" size="6"></td> <td><input name="malwares-externe" type="text" size="6"></td> </tr>
		<tr> <td>Spybot</td> <td><input name="spybot" type="text" size="6"></td> </tr>
		</table>
	</fieldset>

	<br />

	<fieldset><legend><h3>Partie 2 - Installation / Mise à jour logiciels</h3></legend>
	<?php
	// Requête d'affichage des LOGICIELS
		$logiciels = mysql_query ( "SELECT * FROM tlogiciels ;" )  or  die ( mysql_error() ) ;
	// Boucle d'affichage
		while ( $logiciel_affichage = mysql_fetch_array($logiciels) )
		{ echo "<label> <label><input type='checkbox' name='logiciels[]' value='" . $logiciel_affichage['nom'] . "' /> <b>" . $logiciel_affichage['nom'] ."</label></b> ----> <label><input type='checkbox' name='logiciels[]' value='Installation' /> Installation</label> || <label><input type='checkbox' name='logiciels[]' value='MàJ' /> MàJ</label> </label><br />" ; }
	?>
	<label><input type="checkbox" name="maj[]" value="Mises à jour système" /> <b>Mises à jour</b> du système</label><br />
	<label><input type="checkbox" name="maj[]" value="Service Pack Windows installé(s)" /> <b>Service Pack</b> Windows installé(s)</label><br />
	<label><input type="checkbox" name="maj[]" value="Activation Windows" /> <b>Activation</b> Windows</label><br />
	</fieldset>

	<br />

	<fieldset><legend><h3>Partie 3 - Observations & rapport d'intervention</h3></legend>
	<label><input type="checkbox" name="virus[]" value="PC infecté par des virus & spywares" /> <b>PC infecté</b> par des virus & spywares</label><br />
	<label><input type="checkbox" name="virus[]" value="Fiabilité PC douteuse" /> <b>Fiabilité PC douteuse</b></label> - Informations complémentaires : <input type="text" name="fiabilite" size="50" /><br />
	<label><input type="checkbox" name="virus[]" value="Faire des analyses régulières Antivirus et anti-spyware" /> <b>Faire des analyses régulières</b> (Antivirus & anti-spyware)</label><br />
	<label><input type="checkbox" name="virus[]" value="Donner une brochure explicative pour nettoyage virus - spyware" /> <b>Donner une brochure</b> explicative pour nettoyage virus / spyware</label><br />
	<br /><hr /><br />
	<b>Reste à installer (suite à formatage)</b> :<br />
	<label><input type="checkbox" name="reinstall[]" value="Imprimante" />Imprimante à re-brancher</label><br />
	<label><input type="checkbox" name="reinstall[]" value="WIFI" />WiFi à re-connecter</label><br />
	<br /><hr /><br />
	<fieldset><legend><h4>Mémoire</h4></legend>
	<input type="checkbox" name="ram[]" value="Ajout RAM nécessaire"> <b>Ajout de mémoire vive (RAM) nécessaire</b> pour plus de rapidité - 
		<b>Quantité de mémoire vive à ajouter</b> :
		<select name="ram[]">
			<option value="Pas d'ajout"></option>
			<option value="512 Mo">512 Mo</option>
			<option value="1 Go">1 Go</option>
			<option value="2 Go">2 Go</option>
			<option value="3 Go">3 Go</option>
			<option value="4 Go">4 Go</option>
		</select>
	| 
		<b>Type de RAM</b> :
		<select name="ram[]">
			<option value="nécessaire"></option>
			<option value="DDR">DDR</option>
			<option value="DDR2">DDR 2</option>
			<option value="DDR3">DDR 3</option>
			<option value="SO-DIMM">SO-DIMM</option>
		</select>
		<br />
	<input type="checkbox" name="ram[]" value="RAM déjà installée dans le PC - Voir accord client"> <b>RAM déjà installée dans le PC</b> - <u>Voir pour accord / acceptation client.</u><br />
	</fieldset>
	<br /><hr /><br />
	<!--Type d'intervention-->
		Type d'intervention :
		<select name="intervention">
		<?php
		// Requête d'affichage des TYPE D'INTERVENTIONS
			$type_interv = mysql_query ( "SELECT * FROM ttypeinterv ;" )  or  die ( mysql_error() ) ;
		// Boucle d'affichage
			while ( $interv = mysql_fetch_array($type_interv) )
			{ echo "<option value='" . $interv['interv'] . "'>" . $interv['interv'] . "</option>"; }
		?>
		</select><br />
		Matériel :
		<select name="materiel">
			<?php
			$req3 = mysql_query ( "SELECT * FROM ttypemateriel ;" )  or  die ( mysql_error() ) ; // Requête d'affichage des TYPE D'INTERVENTIONS
			while ( $ligne33 = mysql_fetch_array($req3) ) // Boucle d'affichage
			{ echo "<option value='" . $ligne33['materiel'] . "'>" . $ligne33['materiel'] . "</option>"; }
			?>
		</select><br />
		Observations : <textarea name="observation" type="text" cols="60" rows="8"></textarea><br />
		Suivi par :
		<select name="technicien">
		<?php
		// Requête d'affichage des TYPE D'INTERVENTIONS
			$req2 = mysql_query ( "SELECT * FROM ttechniciens ;" )  or  die (mysql_error() ) ;
		
		// Boucle d'affichage
			while ( $ligne22 = mysql_fetch_array($req2) )
			{ echo "<option value='" . $ligne22['nom'] . "'>" . $ligne22['nom'] . "</option>"; } ?>
		</select><br />
		Coût total : <input name="prix" type="text" size="4" required> €<br />
	</fieldset>
	<center><input type="submit" value="Ajouter & IMPRIMER" style="width:250px; height:50px;font-size:14px;"></center>
</fieldset>
</form>
