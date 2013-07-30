<table border="1" rules="all">
<tr> <th> MATERIEL </th> </tr>
<?php
if ( !empty($_POST) && (($_POST["verif"])=="ajout-materiel") )
{
	$materiel = addslashes($_POST["materiel"]); // Récupération du nom

// Insertion des données dans la BDD
	$add = mysql_query ( "INSERT INTO ttypemateriel VALUES ('','$materiel');" )  or  die( mysql_error() ) ;
	echo "<center><h3>Matériel ' ".$materiel." ' ajouté avec succès !!</h3></center><br /><hr /><br />";
}	
				
// AFFICHAGE DES TYPES D'INTERVENTION
$req = mysql_query ( "SELECT * FROM ttypemateriel;" )  or  die( mysql_error() ) ;
					  
while ( $ligne = mysql_fetch_array($req) )
{					  
	echo "<tr>" ;
	echo "<td>" . $ligne['materiel'] . "</td>" ;
	echo "<td align='center'><form action='admin/deltypemateriel.php?id=".$ligne["id"]."' method='POST'> <input type='hidden' name='id' value='".$ligne["id"]."'> <input type='submit' class='button blue morph' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ;
	echo "</tr>" ;
}
?>
</table>
<br /><hr /><br />
<center>
<h2>Ajout d'un matériel</h2>
<form action="#" method="POST">
	<p>
	Nouveau matériel <input type="text" name="materiel" required><br />
	<input type="hidden" name="verif" value="ajout-materiel">
	<input type="submit" value="Ajouter">
	</p>
</form>
</center>