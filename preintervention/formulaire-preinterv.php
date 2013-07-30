<?php
if ( (empty($_POST)) or (isset($_GET)) && (($_GET['p'])=="ficheclient") or (mysql_num_rows($recherche) <= 0)  )
{ // Si les POST sont vides (donc, si aucun nom ou n° de téléphone a été saisi, on affiche le formulaire vide ?>

<form action="preintervention/ajout-preinterv.php" method="POST">

<fieldset style="width:600px; text-align:justify;"><legend><h3>Coordonnés client</h3></legend>
	<b>NOM</b> : <input name="nom" type="text" required value="<?php if (isset($nom_client)) { echo $nom_client; } else if (isset($ligne)) { echo $ligne['nom']; } ?>" /> - PRÉNOM : <input name="prenom" type="text" required value="<?php if (isset($prenom_client)) { echo $prenom_client; } else if (isset($ligne)) { echo $ligne['prenom']; }?>" /><br />
	<b>Tél fixe</b> : <input type="text" name="telFixe" value="<?php if (isset($tel_client)) { echo $tel_client; } else if (isset($ligne)) { echo $ligne['telFixe']; } ?>" /> - Tél portable : <input type="text" name="telPort" value="<?php if (isset($tel_client)) { echo $tel_client; } else if (isset($ligne)) { echo $ligne['telPort']; } ?>" /><br />
	Adresse : <input type="text" name="adresse" size="55" value="<?php if (isset($ligne)) { echo $ligne['adresse']; } ?>" />
</fieldset>
<br />

<fieldset style="width:600px; text-align:justify;"><legend><h3>Intervention à effectuer</h3></legend>
	<b>Date de dépôt</b> du matériel <input name="dateDepot" type="text" value="<?php echo date('d/m/Y'); ?>" size="8" class="calendrier"> | <b>Date de restitution</b> prévue : <input name="dateRestitution" type="text" size="8" class="calendrier" required /><br />
	<b>Matériel</b> :
	<select name="materiel">
	<?php
		$materiel = mysql_query( "SELECT * FROM ttypemateriel ;" ) or die ( mysql_error() ) ; // Requête d'affichage des TYPE D'INTERVENTIONS
		while ( $ligne = mysql_fetch_array($materiel) ) // Boucle d'affichage
		{ echo "<option value='" . $ligne['materiel'] . "'>" . $ligne['materiel'] . "</option>"; }
	?>
	</select>
	<br />
	<b>Mot de passe</b> de session : <input type="text" name="password"><br />
	<b>Type d'intervention</b> :
	<select name="typeInterv">
	<?php
	// Requête d'affichage des TYPE D'INTERVENTIONS
		$type_interv = mysql_query ( "SELECT * FROM ttypeinterv ;" )  or  die ( mysql_error() ) ;
	// Boucle d'affichage
		while ( $interv = mysql_fetch_array($type_interv) )
		{ echo "<option value='" . $interv['interv'] . "'>" . $interv['interv'] . "</option>"; }
	?>
	</select><br />
	<b>Observations</b> :<br />
	<textarea name="observations" cols="60" rows="8"></textarea><br /><br />
	<fieldset style="text-align:justify;"><legend><h3>Fichiers à sauvegarder</h3></legend>
	<label><input type="checkbox" name="dossierMesDocs" value="Dossier Mes documents + Bureau"> Dossier <b>Mes documents</b> + <b>Bureau</b></label><br />
	<b>Dossier(s) spécifique(s) à sauvegarder</b> : <input type="text" name="dossiersClt">
	</fieldset>
<input type="hidden" name="verif" value="add-formulaire-nouveau-client" />
</fieldset>

<br />

<center><input type="submit" value="Ajouter & IMPRIMER" style="width:250px; height:50px;font-size:14px;"></center>

</form>

<?php } // Fin condition 

else { // Sinon, on affiche le formulaire en fonction du nom / n° de téléphone entré ?>

<form action="preintervention/ajout-preinterv.php" method="POST">

<fieldset style="width:600px; text-align:justify;"><legend><h3>Coordonnés client</h3></legend>
	<b>NOM</b> : <input name="nom" type="text" value="<?php echo $ligne['nom']; ?>" required readonly /><br />
	<b>Tél fixe</b> : <input type="text" name="telFixe" value="<?php echo $ligne['telFixe']; ?>" /> - Tél portable : <input type="text" name="telPort" value="<?php echo $ligne['telPort']; ?>" /><br />
	Adresse : <input type="text" name="adresse" size="55" value="<?php echo $ligne['adresse']; ?>" />
</fieldset>
<br />

<fieldset style="width:600px; text-align:justify;"><legend><h3>Intervention à effectuer</h3></legend>
	<b>Date de dépôt</b> du matériel <input name="dateDepot" type="text" value="<?php echo date('d/m/Y'); ?>" size="8" class="calendrier"> | <b>Date de restitution</b> prévue : <input name="dateRestitution" type="text" size="8" class="calendrier" required /><br />
	<b>Matériel</b> :
	<select name="materiel">
	<?php
		$materiel = mysql_query ( "SELECT * FROM ttypemateriel ;" )  or  die ( mysql_error() ) ; // Requête d'affichage des TYPE D'INTERVENTIONS
		while ( $ligne = mysql_fetch_array($materiel) ) // Boucle d'affichage
		{ echo "<option value='" . $ligne['materiel'] . "'>" . $ligne['materiel'] . "</option>"; }
	?>
	</select>
	<br />
	<b>Mot de passe</b> de session : <input type="text" name="password"><br />
	<b>Type d'intervention</b> :
	<select name="typeInterv">
	<?php
	// Requête d'affichage des TYPE D'INTERVENTIONS
		$type_interv = mysql_query ( "SELECT * FROM ttypeinterv ;" )  or  die ( mysql_error() ) ;
	// Boucle d'affichage
		while ( $interv = mysql_fetch_array($type_interv) )
		{ echo "<option value='" . $interv['interv'] . "'>" . $interv['interv'] . "</option>"; }
	?>
	</select><br />
	<b>Observations</b> :<br />
	<textarea name="observations" cols="60" rows="8"></textarea><br /><br />
	<fieldset style="text-align:justify;"><legend><h3>Fichiers à sauvegarder</h3></legend>
	<label><input type="checkbox" name="dossierMesDocs" value="Dossier Mes documents + Bureau"> Dossier <b>Mes documents</b> + <b>Bureau</b></label><br />
	<b>Dossier(s) spécifique(s) à sauvegarder</b> : <input type="text" name="dossiersClt">
	</fieldset>
<input type="hidden" name="verif" value="add-formulaire-client-connu" />
</fieldset>

<br />
<center><input type="submit" value="Ajouter & IMPRIMER" style="width:250px; height:50px;font-size:14px;"></center>

</form>
<?php } // Fin condition n°2 ?>