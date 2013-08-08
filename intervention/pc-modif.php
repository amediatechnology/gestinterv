<!-- PC FIXES ET PC PORTABLES -->

<h2>Intervention actuelle :</h2>
<table border="1" rules="all">
<tr> <th> DATE </th> <th> INTERVENTION </th> <th>MATERIEL</th> <th>OBSERVATIONS</th> <th>COÛT</th> <th>TECHNICIEN</th>
<?php
	echo "<tr>" ;
	echo "<td align=center>" . $ligne['dateInterv'] . "</td>" ;
	echo "<td align=center>" . $ligne['intervention'] . "</td>" ;
	echo "<td align=center>" . $ligne['materiel'] . "</td>" ;
	echo "<td align=center>" . $ligne['observations'] . "</td>" ;
	echo "<td align=center>" . $ligne['prix'] . " €</td>" ;
	echo "<td align=center>" . $ligne['technicien'] . "</td>" ;	
	echo "</tr>" ;
	echo "<tr><td height='10px' colspan='6'>&nbsp;</td></tr>";
	echo "<tr><td align='center'><b>Logiciels installés :</b></td>";
	echo "<td align=center colspan='3'>" . $ligne['logiciels'] . "</td>" ;
	echo "<td align=center colspan='2'>" . $ligne['maj'] . "</td>" ;
	echo "</tr>";
	echo "<tr><td align='center' colspan='6'><b>" . $ligne['virus'] . "</b></td>";
	echo "</tr>";
	echo "<tr><td align='center'><b>Sauvegarde<br />des documents du client :</b></td>";
	echo "<td align=center>" . $ligne['sauvegarde'] . "</td>" ;
	echo "</tr>";
?>
</table>

<br />

<form action="intervention/update-modif-interv-pc.php" method="POST">
<!-- Variables "cachées" - lien entre les tables / informations -->
<input type="hidden" name="codeIntervention" value="<?php echo $id; ?>"> <!-- Code intervention -->
<input type="hidden" name="codeClient" value="<?php echo $ligne['codeClient']; ?>"> <!-- Code Client -->

<fieldset> <legend><h1>Nouvelle intervention</h1></legend>
	<div class="ligne"><b>Date de l'intervention</b> : <input name="dateInterv" type="text" size="8" class="calendrier" value="<?php echo date('d/m/Y'); ?>" size="5"> (date du jour)</div><br />
	
	<fieldset id="cadre" style="background-color:#dfdfdf"> <legend> <h4>Nouvelle intervention</h4> </legend>
		<div class="ligne">
			<center>État de l'intervention : <select name="statut">
			<?php echo "<option value='" . $ligne['statut'] . "'> [ Présélection ] - " . $ligne['statut'] . "</option>"; ?>
			<option name="À faire">À faire</option>
			<option name="En cours">En cours</option>
			<option name="Terminé - OK">Terminé - OK</option>
			<option name="En attente">En attente</option>
			</select></center>
		</div>
	</fieldset>
		
	<br />
	
	<fieldset id="cadre"><legend><h3>Partie 1 - Analyses antivirus / anti-spywares</h3></legend>

<?php
// Explosion de la chaîne de caractères ANTIVIRUS
$antivirus = $ligne['antivirus'];

if(stripos($antivirus, 'Cookies traçeurs uniquement') !== FALSE)
{ list($antivirusexterne, $antivirusinterne, $cookies_traceurs) = explode("+",$antivirus); }
else { list($antivirusexterne, $antivirusinterne) = explode("+",$antivirus); }

// Explosion de la chaîne de caractères MALWARES
$malwares = $ligne['malwares'];

if ( (stripos($malwares, 'Mode COMPLET') !== FALSE) OR (stripos($malwares, 'Mode RAPIDE') !== FALSE) )
{ list($malwaresexterne, $malwaresinterne, $mode) = explode("+",$malwares); }
else { list($malwaresexterne, $malwaresinterne) = explode("+",$malwares); }
	
$spybot = $ligne['spybot'];

if(stripos($spybot, 'Scan au redémarrage effectué') !== FALSE)
{ list($spybot_nb, $spybot_redemarrage) = explode("+",$spybot); }
else { list($spybot_nb) = explode("+",$spybot); }

?>

	<table><td>	
		<table border="1" rules="rows">
			<tr> <td>&nbsp;</td> <td>Analyses<br /><b>externes</b></td> <td>Analyses<br /><b>internes</b></td> <td>Informations<br />complémentaires</td></tr>
			<tr> <td>Virus</td> <td><input name="antivirus-externe" type="text" size="6" value="<?php echo $antivirusexterne; ?>" /></td> <td><input name="antivirus-interne" type="text" id="saisie" size="6" value="<?php echo $antivirusinterne; ?>" /></td> <td><?php if ( (!empty($cookies_traceurs)) ) { echo '<input type="checkbox" name="cookies" value="Cookies traçeurs uniquement" checked /> Cookies traçeurs uniquement'; } else { echo '<input type="checkbox" name="cookies" value="Cookies traçeurs uniquement"/> Cookies traçeurs uniquement' ;}?></td> </tr>
			<tr> <td>Malwares</td> <td><input name="malwares-externe" type="text" size="6" value="<?php echo $malwaresexterne; ?>" /></td> <td><input name="malwares-interne" type="text" size="6" value="<?php echo $malwaresinterne; ?>" /></td> <td><?php if ( (!empty($mode)) && ($mode="Mode COMPLET") ) { echo '<input type="radio" name="malwaresbytes-mode" value="Mode COMPLET" checked /> Mode <b>complet</b> - <input type="radio" name="malwaresbytes-mode" value="Mode RAPIDE" /> Mode <b>rapide</b>'; } else if ( (!empty($mode)) && ($mode=="Mode RAPIDE") ) { echo '<input type="radio" name="malwaresbytes-mode" value="Mode COMPLET" /> Mode <b>complet</b> - <input type="radio" name="malwaresbytes-mode" value="Mode RAPIDE" checked /> Mode <b>rapide</b>'; } else { echo '<input type="radio" name="malwaresbytes-mode" value="Mode COMPLET" /> Mode <b>complet</b> - <input type="radio" name="malwaresbytes-mode" value="Mode RAPIDE" /> Mode <b>rapide</b>'; } ?></td> </tr>
			<tr> <td>Spybot</td> <td><input name="spybot" type="text" size="6" value="<?php echo $spybot_nb; ?>" /></td> <td><input type="text" size="6" readonly style="background-color:#dbdbdb;"></td> <td><?php if ( (!empty($spybot_redemarrage)) ) { echo '<input type="checkbox" name="scan-redemarrage" value="Scan au redémarrage effectué" checked/> Scan au redémarrage effectué.'; } else { echo '<input type="checkbox" name="scan-redemarrage" value="Scan au redémarrage effectué" /> Scan au redémarrage effectué.' ;}?></td> </tr>
			<tr> <td colspan="4" align="center" style="padding: 6px 6px 6px 6px;"><b>Informations complémentaires quant aux nettoyages</b></td> </tr>
			<tr> <td colspan="4">Autre : <input type="text" name="nettoyage-annexe" size="55" /></td> </tr>
		</table>
	</td>
	<td>
		<table border="1" rules="rows"><th colspan="2">Logiciels de nettoyage annexes</th>
		<tr> <td><input type="checkbox" name="adwcleaner" value="ADW Cleaner effectué"/></td> <td>ADW Cleaner</td> </tr>
		<tr> <td><input type="checkbox" name="ccleaner" value="CCLeaner effectué"/></td> <td>CCleaner</td> </tr>
		<tr> <td>Autre :</td> <td><input type="text" name="nettoyage-annexe" size="25" /></td> </tr>
		</table>
	</td></table>
	</fieldset>

	<br />

	<fieldset id="cadre"><legend><h3>Partie 2 - Sauvegarde des documents</h3></legend>

<?php
// Explosion de la chaîne de caractères ANTIVIRUS
$sauvegarde = $ligne['sauvegarde'];
	list($sauvegarde_bureau, $sauvegarde_annexe, $serveur) = explode(", ",$sauvegarde);

?>
		<table border="1" rules="all">
			<tr> <th>Dossier "Mes documents" + Bureau</th> <th>Dossiers annexes</th> </tr>
			<tr> <td align="center"><i><input type="text" name="sauvegarde[]" size="50" value="<?php echo $sauvegarde_bureau; ?>" /></i></td> <td align="center"><i><input type="text" name="sauvegarde[]" size="50" value="<?php echo $sauvegarde_annexe; ?>" /></i></td> </tr>
			<?php if ( ($ligne['sauvegarde'] != "Aucun document à sauvegarder - ACCORD CLIENT.") ) 
			{ // Si il y a des dossiers à sauvegarder, on affiche une liste pour savoir sur quel serveur les fichiers sont sauvegardés ?>
			<tr> <td colspan="2" align="center"> <div class="ligne">Serveur sur lequel les fichiers sont sauvgardés :<br />
			<select name="sauvegarde[]">
				<option name="Fichiers sauvegardés sur <?php echo $serveur; ?>"><?php echo $serveur; ?></option>
				<option name="">----------</option>
				<option name="Fichiers sauvegardés sur Atelier HAUT">Atelier HAUT</option>
				<option name="Fichiers sauvegardés sur Atelier BAS">Atelier BAS</option>
				<option name="Fichiers sauvegardés sur Atelier 1">Atelier 1</option>
				<option name="Fichiers sauvegardés sur Atelier 2">Atelier 2</option>			
				<option name="Fichiers sauvegardés sur Atelier WIN7">Atelier WIN7</option>			
				</td> </div></tr>
			<?php
			} ?>
		</table>
	</fieldset>
	
	<br />
	
	<fieldset id="cadre"><legend><h3>Partie 3 - Installation / Mise à jour logiciels</h3></legend>

<?php
// Explosion de la chaîne de caractères
$logiciels = $ligne['logiciels'];
$logiciels_tab = explode(", ",$logiciels);
echo "<center><fieldset><legend><i>Avant modifications de cette fiche d'intervention :</i></legend>";
foreach ($logiciels_tab as $logiciels_list)
{ echo $logiciels_list . " - "; } 
?>
</fieldset></center><br />
	
	<div class="ligne"> <b>Suppresion</b> de l'ancien antivirus ->
	<select name="suppression-ancien-antivirus">
		<option name="Non nécessaire">Non nécessaire</option>
		<option name="Antivir">Antivir</option>
		<option name="Avast">Avast</option>
		<option name="AVG">AVG</option>
		<option name="Bitdefender">Bitdefender</option>
		<option name="Comodo">Comodo</option>
		<option name="G-Data">G-Data</option>
		<option name="Kaspersky">Kaspersky</option>
		<option name="McAfee">McAfee</option>
		<option name="Norton">Norton</option>
		<option name="Panda">Panda</option>
	</select></div>
	<ul>
	<?php
	// Requête d'affichage des LOGICIELS
		$logiciels = mysql_query ( "SELECT * FROM tlogiciels ;" ) or die ( mysql_error() ) ;
	// Boucle d'affichage
		while ( $logiciel_affichage = mysql_fetch_array($logiciels) )
		{ echo " <div class='ligne'><li>". $logiciel_affichage['nom'] ."</b> ----> <label> <input type='checkbox' name='logiciels[]' value='Installation ".$logiciel_affichage['nom']."' /> Installation</label> - <label><input type='checkbox' name='logiciels[]' value='MàJ ".$logiciel_affichage['nom']."' /> MàJ</label> </li></div>" ; }
	?>
	</ul>
	<?php
// Explosion de la chaîne de caractères
$maj = $ligne['maj'];
list($maj_windows, $sp, $activation) = explode(", ", $maj);

	if ( (!empty($maj_windows)) && ($maj_windows=="Mises à jour système") ) { echo '<div class="ligne"><label><input type="checkbox" name="maj[]" value="Mises à jour système" checked /> Installation des <b>mises à jour</b> du système</label>'; } else { echo '<div class="ligne"><label><input type="checkbox" name="maj[]" value="Mises à jour système" /> Installation des <b>mises à jour</b> du système</label>'; }
	if ( (!empty($sp)) && ($sp=="Service Pack Windows installé(s)") ) { echo ' --- <label><input type="checkbox" name="maj[]" value="Service Pack Windows installé(s)" checked /> <b>Service Pack</b> Windows installé(s)</label></div>'; } else { echo ' --- <label><input type="checkbox" name="maj[]" value="Service Pack Windows installé(s)" /> <b>Service Pack</b> Windows installé(s)</label></div>'; }
	if ( (!empty($activation)) && ($activation=="Activation Windows") ) { echo '<div class="ligne"><label><input type="checkbox" name="maj[]" value="Activation Windows" checked /> <b>Activation</b> Windows</label></div>'; } else { echo '<div class="ligne"><label><input type="checkbox" name="maj[]" value="Activation Windows" /> <b>Activation</b> Windows</label></div>'; }	
?>
	</ul>
	</fieldset>
	
	<br />
	
	<fieldset id="cadre"><legend><h3>Partie 4 - Observations & informations complémentaires</h3></legend>

<?php
// Explosion de la chaîne de caractères
$virus = $ligne['virus'];
$virus_tab = explode(", ",$virus);
echo "<center><fieldset><legend><i>Avant modifications de cette fiche d'intervention :</i></legend>";
foreach ($virus_tab as $virus_list)
{ echo $virus_list . " - "; } 
?>
</fieldset></center><br />
	<div class="ligne"><label><input type="checkbox" name="virus[]" value="PC infecté par des virus & spywares" /> -> <b>PC infecté</b> par des virus & spywares</label> --- <label><input type="checkbox" name="virus[]" value="PC TRES infecté par de nombreux virus & spywares" /> -> <u><b>PC TRES infecté</b> par de nombreux virus & spywares</u></label></div>
	<div class="ligne"><label><input type="checkbox" name="virus[]" value="Présence de Toolbars" /> -> Présence de <b>Toolbars</b>. </label></div>
	<div class="ligne"><label><input type="checkbox" name="virus[]" value="Fiabilité PC douteuse" /> -> <b>Fiabilité PC douteuse</b></label> - Informations complémentaires : <input type="text" name="fiabilite" size="50" /></div>
	<div class="ligne"><label><input type="checkbox" name="virus[]" value="Optimisation du démarage" /> -> <b>Optimisation</b> du démarage.</label> --- <label><input type="checkbox" name="virus[]" value="Réinitialisation des navigateurs web" /> -> <b>Réinitialisation</b> des navigateurs web.</label></div>
	<div class="ligne"><label><input type="checkbox" name="virus[]" value="Fichiers croisés au démarrage - Fiabilité HDD à voir" /> -> <b>Fichiers croisés</b> au démarrage - Fiabilité HDD à voir.</label></div>
	
	<br /><br />
	
	<fieldset><legend><h4>Mémoire</h4></legend>
<?php
// Explosion de la chaîne de caractères
$ram = $ligne['ram'];
$ram_tab = explode(", ",$ram);
echo "<center><fieldset><legend><i>Avant modifications de cette fiche d'intervention :</i></legend>";
foreach ($ram_tab as $ram_list)
{ echo $ram_list . " - "; } 
?>
</fieldset></center><br />
	
	<div class="ligne"><label><input type="checkbox" name="ram[]" value="Ajout RAM nécessaire"> <b>Ajout de mémoire vive (RAM) nécessaire</b> pour plus de rapidité</label> - 
		<b>Quantité de mémoire vive à ajouter</b> :
		<select name="ram[]">
			<option value="Pas d'ajout de RAM nécessaire"></option>
			<option value="512 Mo">512 Mo</option>
			<option value="1 Go">1 Go</option>
			<option value="2 Go">2 Go</option>
			<option value="3 Go">3 Go</option>
			<option value="4 Go">4 Go</option>
		</select>
	| 
	<b>Type de RAM</b> :
		<select name="ram[]">
			<option value=""></option>
			<option value="DDR">DDR</option>
			<option value="DDR2">DDR 2</option>
			<option value="DDR3">DDR 3</option>
			<option value="SO-DIMM">SO-DIMM</option>
		</select>
	</div>
		
	<div class="ligne"><label><input type="checkbox" name="ram[]" value="RAM déjà installée dans le PC - Voir accord client"> <b>RAM déjà installée dans le PC</b> - <u>Voir pour accord / acceptation client.</u></label></div>
	</fieldset>
	
	<br />

	<div class="ligne">	Type d'intervention :
		<select name="intervention">
		<option selected value="<?php echo $ligne['intervention']; ?>">[ Présélection ] - <?php echo $ligne['intervention']; ?></option>
		<?php
		// Requête d'affichage des TYPE D'INTERVENTIONS
			$type_interv = mysql_query ( "SELECT * FROM ttypeinterv ;" )  or  die ( mysql_error() ) ;
		// Boucle d'affichage
			while ( $interv = mysql_fetch_array($type_interv) )
			{ echo "<option value='" . $interv['interv'] . "'>" . $interv['interv'] . "</option>"; }
		?>
		</select></div>
		
	<div class="ligne">	Matériel :
		<select name="materiel">
			<option selected value="<?php echo $ligne['materiel']; ?>">[ Présélection ] - <?php echo $ligne['materiel']; ?></option>
			<?php
			$req3 = mysql_query ( "SELECT * FROM ttypemateriel ;" )  or  die ( mysql_error() ) ; // Requête d'affichage des TYPE D'INTERVENTIONS
			while ( $ligne33 = mysql_fetch_array($req3) ) // Boucle d'affichage
			{ echo "<option value='" . $ligne33['materiel'] . "'>" . $ligne33['materiel'] . "</option>"; }
			?>
		</select></div>
		
	<div class="ligne">	Observations : <textarea name="observation" type="text" cols="60" rows="8"><?php echo $ligne['observations'] ; ?></textarea> </div>

	<div class="ligne"> Suivi par :
		<select name="technicien">
			<option selected value="<?php echo $ligne['technicien']; ?>">[ Présélection ] - <?php echo $ligne['technicien']; ?></option>
		<?php
		// Requête d'affichage des TYPE D'INTERVENTIONS
			$req2 = mysql_query ( "SELECT * FROM ttechniciens ;" )  or  die (mysql_error() ) ;
		
		// Boucle d'affichage
			while ( $ligne22 = mysql_fetch_array($req2) )
			{ echo "<option value='" . $ligne22['nom'] . "'>" . $ligne22['nom'] . "</option>"; } ?>
		</select></div>
	
	<div class="ligne"> Coût total : <input name="prix" type="text" size="4" value="<?php echo $ligne['prix'] ; ?>" required /> €</div>
	</fieldset>
	<br />
	
	<center><button id="bouton">Terminer et enregistrer les modifications</button></center>
	
</fieldset>
</form>