<!-- TABLETTE - IMPRIMANTES - PERIPHERIQUES - AUTRES -->
<!-- PC FIXES ET PC PORTABLES -->

<h2>Intervention actuelle :</h2>
<table border="1" rules="all">
<tr> <th> DATE </th> <th> INTERVENTION </th> <th>MATERIEL</th> <th>OBSERVATIONS</th> <th>COÛT</th> <th>TECHNICIEN</th>
<?php
	echo "<tr>" ;
	echo "<td align=center>" . $ligne['dateInterv'] 	. "</td>" ;
	echo "<td align=center>" . $ligne['intervention'] 	. "</td>" ;
	echo "<td align=center>" . $ligne['materiel'] 		. "</td>" ;
	echo "<td align=center>" . $ligne['observations']	. "</td>" ;
	echo "<td align=center>" . $ligne['prix'] 			. " €</td>" ;
	echo "<td align=center>" . $ligne['technicien'] 	. "</td>" ;	
	echo "</tr>" ;
?>
</table>

<br /><hr /><br />

<form action="intervention/update-modif-interv-peripheriques.php" method="POST">
<!-- Variables "cachées" - lien entre les tables / informations -->
<input type="hidden" name="codeIntervention" value="<?php echo $id; ?>"> <!-- Code intervention -->
<input type="hidden" name="codeClient" value="<?php echo $ligne['codeClient']; ?>"> <!-- Code Client -->

<fieldset> <legend><h1>Nouvelle intervention</h1></legend>
	<b>Date de l'intervention</b> : <input name="dateInterv" type="text" size="8" class="calendrier" value="<?php echo date('d/m/Y'); ?>" size="5"> (date du jour)<br />
	
	<br />
	
	<fieldset><legend><h3>Observations & rapport d'intervention</h3></legend>
	<!--Type d'intervention-->
		Type d'intervention :
		<select name="intervention">
		<option selected value="<?php echo $ligne['intervention']; ?>">[ Présélection ] - <?php echo $ligne['intervention']; ?></option>
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
			<option selected value="<?php echo $ligne['materiel']; ?>">[ Présélection ] - <?php echo $ligne['materiel']; ?></option>
			<?php
			$req3 = mysql_query ( "SELECT * FROM ttypemateriel ;" )  or  die ( mysql_error() ) ; // Requête d'affichage des TYPE D'INTERVENTIONS
			while ( $ligne33 = mysql_fetch_array($req3) ) // Boucle d'affichage
			{ echo "<option value='" . $ligne33['materiel'] . "'>" . $ligne33['materiel'] . "</option>"; }
			?>
		</select><br />
		Observations : <textarea name="observation" type="text" cols="60" rows="8"><?php echo $ligne['observations'] ; ?></textarea><br />
		Suivi par :
		<select name="technicien">
			<option selected value="<?php echo $ligne['technicien']; ?>">[ Présélection ] - <?php echo $ligne['technicien']; ?></option>
		<?php
		// Requête d'affichage des TYPE D'INTERVENTIONS
			$req2 = mysql_query ( "SELECT * FROM ttechniciens ;" )  or  die (mysql_error() ) ;
		
		// Boucle d'affichage
			while ( $ligne22 = mysql_fetch_array($req2) )
			{ echo "<option value='" . $ligne22['nom'] . "'>" . $ligne22['nom'] . "</option>"; } ?>
		</select><br />
		Coût total : <input name="prix" type="text" size="4" value="<?php echo $ligne['prix'] ; ?>" required /> €<br />
	</fieldset>
	<br />
	
	<center><input type="submit" value="Ajouter & IMPRIMER" style="width:250px; height:50px;font-size:14px;"></center>
	
</fieldset>
</form>