﻿<table border="1" rules="all">
<tr> <th> TYPE </th> </tr>
<?php
if ( !empty($_POST) && (($_POST["verif"])=="ajout-type-intervention") )
{
	$nom = addslashes($_POST["nom"]); // Récupération du nom

// Insertion des données dans la BDD
	$add = mysql_query ( "INSERT INTO ttypeinterv VALUES ('','$nom');" ) or die ( mysql_error() ) ;
	echo "<center><h3>Type d'intervention ' ".$nom." ' ajouté avec succès !!</h3></center><br /><hr /><br />";
}	
				
// AFFICHAGE DES TYPES D'INTERVENTION
$req = mysql_query ( "SELECT * FROM ttypeinterv;" )  or  die( mysql_error() ) ;
					  
while ( $ligne = mysql_fetch_array($req) )
{					  
	echo "<tr>" ;
	echo "<td>" . $ligne['interv'] . "</td>" ;
	echo "<td align='center'><form action='admin/deltypeinterv.php?id=".$ligne["id"]."' method='POST'> <input type='hidden' name='id' value='".$ligne["id"]."'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ;
	echo "</tr>" ;
}
	?>
</table>
<br /><hr /><br />
<center>
<h2> Ajout d'un type d'intervention </h2>
<form action="#" method="POST">
	<p>
	Nouveau type d'intervention <input type="nom" name="nom" required><br />
	<input type="hidden" name="verif" value="ajout-type-intervention">
	<input type="submit" value="Ajouter">
	</p>
</form>
</center>