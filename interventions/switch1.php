<!-- TABLETTE - IMPRIMANTES - PERIPHERIQUES - AUTRES -->

<form action="interventions/add3.php" method="POST">
<!-- Variables "cachées" - lien entre les tables / informations -->
<input type="hidden" name="codePreInterv" value="<?php echo $id; ?>"> <!-- Code pré-intervention -->
<input type="hidden" name="codeClient" value="<?php echo $ligne['codeClient']; ?>"> <!-- Code Client -->

<fieldset><legend><h3>Observations & rapport d'intervention</h3></legend>
<b>Date de l'intervention</b> : <input name="dateInterv" type="text" size="8" class="calendrier" value="<?php echo date('d/m/Y'); ?>" size="5"> (date du jour)<br /

<!--Type d'intervention-->
Type d'intervention :
<select name="intervention">
	<option selected value="<?php echo $preInterv['typeInterv']; ?>">[ Présélection ] - <?php echo $preInterv['typeInterv']; ?></option>
	<?php
	// Requête d'affichage des TYPE D'INTERVENTIONS
	$type_interv = mysql_query ( "SELECT * FROM ttypeinterv ;" )  or  die ( mysql_error() ) ;

	// Boucle d'affichage
	while ( $interv = mysql_fetch_array($type_interv) )
	{ echo "<option value='" . $interv['interv'] . "'>" . $interv['interv'] . "</option>"; } ?>

</select><br />
Matériel :
<select name="materiel">
	<option selected value="<?php echo $preInterv['materiel']; ?>">[ Présélection ] - <?php echo $preInterv['materiel']; ?></option>
		<?php
		$req3 = mysql_query ( "SELECT * FROM ttypemateriel ;" )  or  die ( mysql_error() ) ; // Requête d'affichage des TYPE D'INTERVENTIONS
		while ( $ligne33 = mysql_fetch_array($req3) ) // Boucle d'affichage
		{ echo "<option value='" . $ligne33['materiel'] . "'>" . $ligne33['materiel'] . "</option>"; } ?>
	</select><br />

Observations : <textarea name="observation" type="text" cols="60" rows="8"><?php echo $preInterv['observations'] ; ?></textarea><br />

Suivi par :
	<select name="technicien">
	<?php
	// Requête d'affichage des TECHNICIENS
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
