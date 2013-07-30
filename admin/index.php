<!-- Administration GENERALE -->
<table>
<tr>
	<td>
	<fieldset style='width:240px;'><legend>Gestion des techniciens</legend>
	<?php include "techniciens.php"; ?>
	</fieldset>
	</td>

	<td>
	<fieldset style='width:240px;'><legend>Gestion des types de matériel</legend>
	<?php include "typemateriel.php"; ?>
	</fieldset>
	</td>

	<td>
	<fieldset style='width:240px;'><legend>Gestion des types d'intervention</legend>
	<?php include "typeinterv.php"; ?>
	</fieldset>
	</td>

	<td>
	<fieldset style='width:240px;'><legend>Gestion des logiciels</legend>
	<?php include "logiciels.php"; ?>
	</fieldset>
	</td>

	<td>
	<fieldset style='width:240px;'><legend>Statistiques</legend>
	<?php include "techniciens.php"; ?>
	</fieldset>
	</td>
</tr>
</table>

<br />

<fieldset><legend><h2>Statistiques</h2></legend>
<?php include "statistiques.php"; ?>
</fieldset>