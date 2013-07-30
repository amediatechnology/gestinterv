<table border="1" rules="all">
<tr> <th> NOM </th> </tr>
<?php
// Y a t'il un ajout de technicien ?
if ( !empty($_POST) && (($_POST["verif"])=="ajout-technicien") )
{
	$nom = addslashes($_POST["nom"]); // Récupération du nom

// Insertion des données dans la BDD
	$add = mysql_query ( "INSERT INTO ttechniciens VALUES ('','$nom');" ) or die ( mysql_error() ) ;
	echo "<center><h4>Type d'intervention ' ".$nom." ' ajouté avec succès !!</h4></center><br /><hr /><br />";
}	
				
// AFFICHAGE DES TYPES D'INTERVENTION
$req = mysql_query ( "SELECT * FROM ttechniciens ;" )  or  die( mysql_error() ) ;
					  
while ( $ligne = mysql_fetch_array($req) )
{					  
	echo "<tr>" ;
	echo "<td>" . $ligne['nom'] . "</td>" ;
	echo "<td align='center'><form action='admin/deltechnicien.php?id=".$ligne["id"]."' method='POST'> <input type='hidden' name='id' value='".$ligne["id"]."'> <input type='submit' class='button blue morph' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ;
	echo "</tr>" ;
}
?>
</table>
<br /><hr /><br />
<center><h2>Ajout d'un technicien</h2>
<form action="#" method="POST">
	<p>
	Nom du technicien <input type="nom" name="nom" required><br />
	<input type="hidden" name="verif" value="ajout-technicien">
	<input type="submit" value="Ajouter">
	</p>
</form>
</center>