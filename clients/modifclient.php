<?php
	// Récupération du code Client (grace à la redirection)
	$id = $_POST["id"];

	// Affichage du client à modifier à partir de son code client
	$req = mysql_query ( "SELECT * FROM tclients WHERE codeClient='$id';" )  or  die( mysql_error() ) ;
	$ligne = mysql_fetch_array($req) ;
?>

<table border="1" rules="all">
	<tr> <th> Fiche client - <b><?php echo $ligne['nom'] ; ?> -</b></th> </tr>
<?php  // Affichage de la fiche client
	echo "<tr>" ;
	echo "<td align=center><b>" . $ligne['nom'] . "</b> " . $ligne['prenom'] . "<br />";
	echo $ligne['telFixe'] . " - " . $ligne['telPort'] . "<br />" ;
	echo $ligne['adresse'] ;
	echo "</tr>" ;
?>
</table>
<br /><hr /><br />
<form id="form" action="clients/update0.php" method="POST">
	<fieldset> <legend>MODIFICATION - N° Client : <input name="id" type="hidden" value="<?php echo $id ; ?>"><?php echo $id ; ?></legend>
		
		Nom : <input name="nom" type="text" value="<?php echo $ligne['nom'] ; ?>"> | Prénom : <input name="prenom" type="text" value="<?php echo $ligne['prenom'] ; ?>"><br />
		Tél fixe : <input name="telFixe" type="text" value="<?php echo $ligne['telFixe'] ; ?>"> | Tél portable : <input name="telPort" type="text" value="<?php echo $ligne['telPort'] ; ?>"><br />
		Adresse : <input name="adresse" type="text" value="<?php echo $ligne['adresse'] ; ?>">
	</fieldset>
	<center><button type="submit">Modifier</button></center>
</form>