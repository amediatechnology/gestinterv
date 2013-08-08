<?php
if ( (empty($_POST)) or (isset($_GET)) && (($_GET['p'])=="ficheclient") or (mysql_num_rows($recherche) <= 0) )
{ // Si les POST sont vides (donc, si aucun nom ou n° de téléphone a été saisi, on affiche le formulaire vide ?>

<form action="preintervention/ajout-preinterv.php" method="POST">

<fieldset id="cadre" style="width:600px; text-align:justify;"><legend><h3>Coordonnés client</h3></legend>
	<div class="ligne"> <b>NOM</b> : <input required name="nom" type="text" required value="<?php if (isset($nom_client)) { echo $nom_client; } else if (isset($ligne)) { echo $ligne['nom']; } ?>" /> - PRÉNOM : <input name="prenom" type="text" value="<?php if (isset($prenom_client)) { echo $prenom_client; } else if (isset($ligne)) { echo $ligne['prenom']; }?>" /><br /> </div>	
	<div class="ligne"> <b>Tél fixe</b> : <input required type="text" name="telFixe" value="<?php if (isset($tel_client)) { echo $tel_client; } else if (isset($ligne)) { echo $ligne['telFixe']; } ?>" /> - Tél portable : <input type="text" name="telPort" value="<?php if (isset($tel_client)) { echo $tel_client; } else if (isset($ligne)) { echo $ligne['telPort']; } ?>" /><br />	</div>
	<div class="ligne"> Adresse : <input type="text" name="adresse" size="55" value="<?php if (isset($ligne)) { echo $ligne['adresse']; } ?>" /> </div>
</fieldset>
<br />

<fieldset id="cadre" style="width:600px; text-align:justify;"><legend><h3>Intervention à effectuer</h3></legend>
	<div class="ligne"> <b>Date de dépôt</b> du matériel <input name="dateDepot" type="text" value="<?php echo date('d/m/Y'); ?>" size="8" class="calendrier"> | <b>Date de restitution</b> prévue : <input name="dateRestitution" type="text" size="8" class="calendrier" required /><br /> </div>
	<div class="ligne"> <b>Matériel</b> : <select name="materiel">
	<?php
		$materiel = mysql_query( "SELECT * FROM ttypemateriel ;" ) or die ( mysql_error() ) ; // Requête d'affichage des TYPE D'INTERVENTIONS
		while ( $ligne = mysql_fetch_array($materiel) ) // Boucle d'affichage
		{ echo "<option value='" . $ligne['materiel'] . "'>" . $ligne['materiel'] . "</option>"; }
	?>
	</select> </div>

	<div class="ligne"> Matériel <b>incomplet</b> : <select name="accessoires">
		<option value=""></option>
		<option value="Pas de saccoche">Pas de saccoche</option>
		<option value="Pas de transfo">Pas de transfo</option>
		<option value="Pas de saccoche + transfo">Pas de saccoche + transfo</option>
		<option value="Pas de souris">Pas de souris</option>
	</select>
	</div>
	
	<div class="ligne"> <b>Mot de passe</b> de session : <input type="text" name="password"> </div>
	
	<div class="ligne"><b>Type d'intervention</b> :
	<select name="typeInterv">
	<?php
	// Requête d'affichage des TYPE D'INTERVENTIONS
		$type_interv = mysql_query ( "SELECT * FROM ttypeinterv ;" )  or  die ( mysql_error() ) ;
	// Boucle d'affichage
		while ( $interv = mysql_fetch_array($type_interv) )
		{ echo "<option value='" . $interv['interv'] . "'>" . $interv['interv'] . "</option>"; }
	?>
	</select></div>
	
	<div class="ligne"><b>Observations</b> :<br />
	<textarea name="observations" cols="60" rows="8"></textarea></div>
	
	<br />
	
	<fieldset id="cadre" style="text-align:justify;"><legend><h3>Fichiers à sauvegarder</h3></legend>
		<div class="ligne"> <input type="checkbox" name="dossierMesDocs" value="Dossier Mes documents + Bureau"> Dossier <b>Mes documents</b> + <b>Bureau</b></div>
		<div class="ligne"><b>Dossier(s) spécifique(s) à sauvegarder</b> : <input type="text" name="dossiersClt"></div>
	</fieldset>
<input type="hidden" name="verif" value="add-formulaire-nouveau-client" />
</fieldset>

<br />

<center><button id="bouton">Ajouter & IMPRIMER</button></center>

</form>

<?php } // Fin condition 

else { // Sinon, on affiche le formulaire en fonction du nom / n° de téléphone entré ?>

<form action="preintervention/ajout-preinterv.php" method="POST">

<fieldset id="cadre" style="width:600px; text-align:justify;"><legend><h3>Coordonnés client</h3></legend>
	<div class="ligne"> <b>NOM</b> : <input name="nom" type="text" value="<?php echo $ligne['nom']; ?>" required readonly /></div>
	<div class="ligne"> <b>Tél fixe</b> : <input type="text" name="telFixe" value="<?php echo $ligne['telFixe']; ?>" /> - Tél portable : <input type="text" name="telPort" value="<?php echo $ligne['telPort']; ?>" /></div>
	<div class="ligne"> Adresse : <input type="text" name="adresse" size="55" value="<?php echo $ligne['adresse']; ?>" /></div>
</fieldset>
<br />

<fieldset id="cadre" style="width:600px; text-align:justify;"><legend><h3>Intervention à effectuer</h3></legend>
	<div class="ligne"> <b>Date de dépôt</b> du matériel <input name="dateDepot" type="text" value="<?php echo date('d/m/Y'); ?>" size="8" class="calendrier"> | <b>Date de restitution</b> prévue : <input name="dateRestitution" type="text" size="8" class="calendrier" required /></div>
	<div class="ligne"> <b>Matériel</b> :
	<select name="materiel">
	<?php
		$materiel = mysql_query ( "SELECT * FROM ttypemateriel ;" )  or  die ( mysql_error() ) ; // Requête d'affichage des TYPE D'INTERVENTIONS
		while ( $ligne = mysql_fetch_array($materiel) ) // Boucle d'affichage
		{ echo "<option value='" . $ligne['materiel'] . "'>" . $ligne['materiel'] . "</option>"; }
	?>
	</select></div>
	
	<div class="ligne"> <b>Mot de passe</b> de session : <input type="text" name="password"></div>
	<div class="ligne"> <b>Type d'intervention</b> :
	<select name="typeInterv">
	<?php
	// Requête d'affichage des TYPE D'INTERVENTIONS
		$type_interv = mysql_query ( "SELECT * FROM ttypeinterv ;" )  or  die ( mysql_error() ) ;
	// Boucle d'affichage
		while ( $interv = mysql_fetch_array($type_interv) )
		{ echo "<option value='" . $interv['interv'] . "'>" . $interv['interv'] . "</option>"; }
	?>
	</select></div>
	<div class="ligne"> <b>Observations</b> :<br />
	<textarea name="observations" cols="60" rows="8"></textarea></div>
	
	<br />
	
	<fieldset id="cadre" style="text-align:justify;"><legend><h3>Fichiers à sauvegarder</h3></legend>
		<div class="ligne"> <input type="checkbox" name="dossierMesDocs" value="Dossier Mes documents + Bureau"> Dossier <b>Mes documents</b> + <b>Bureau</b></div>
		<div class="ligne"> <b>Dossier(s) spécifique(s) à sauvegarder</b> : <input type="text" name="dossiersClt"></div>
	</fieldset>
<input type="hidden" name="verif" value="add-formulaire-client-connu" />
</fieldset>

<br />
<center><button id="bouton">Ajouter & IMPRIMER</button></center>

</form>
<?php } // Fin condition n°2 ?>