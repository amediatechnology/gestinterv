<center>
<fieldset style="width:600px; text-align:justify;"><center><h3>Recherche du client</h3></center>
	<form action="index.php?p=recherche" method="POST">
		Rercherche par le <b>NOM</b> : <input type="text" size="25" name="nom-client" placeholder="NOM du client" /> <input type="submit" value="Rechercher" /><br />
	</form>
	
	<form action="index.php?p=recherche" method="POST">
		Rercherche par le <b>TÉLÉPHONE FIXE</b> : <input type="text" size="25" name="tel-client" placeholder="Téléphone FIXE du client" /> <input type="submit" value="Rechercher" />
	</form>
</fieldset>
</center>

<form action="clients/ajout-fiche-client.php" method="POST">

<fieldset style="width:600px; text-align:justify;"><legend><h2>Ajout d'un nouveau client</h2></legend>
		Nom : <input name="nom" type="text" required /> | Prénom : <input name="prenom" type="text" /><br />
		Tél fixe : <input name="telFixe" type="text" /> | Tél portable : <input name="telPort" type="text" /><br />
		Adresse : <input name="adresse" type="text" size="70" />
		<br />
	<input type="submit" value="Envoyer les modifications" style="width:250px; height:50px;font-size:14px;" />
</fieldset>

</form>

<center>
<h1>Liste des clients</h1>

<table border="1" rules="all">
<tr> <th colspan="3">Liste des clients</th> <th colspan="3">Administration</th> </tr>
<?php
$tab = mysql_query ( "SELECT * FROM tclients ORDER BY nom" ) or die ( mysql_error() ) ;
	 
while ( $ligne = mysql_fetch_array($tab) )
{
	echo "<tr>" ;
	echo "<td align='center'><b>"	. $ligne['nom'] . "</b> " . $ligne['prenom'] . "</td>" ;
	echo "<td align='center'>"	. $ligne['telFixe'] . "<br>" . $ligne['telPort'] . "</td>" ;
	echo "<td align='center'>"	. $ligne['adresse'] . "</td>" ;
	echo "<td> <form action='index.php?p=ajoutpreinterv' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Ajout d&apos;une pré-intervention'> </form></td>";
	echo "<td> <form action='index.php?p=ficheclient' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Fiche client'> </form></td>";
	echo "<td> <form action='clients/delclient.php?id=".$ligne["codeClient"]."' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ;
	echo "</tr>" ;
}
?>
</table></center>
