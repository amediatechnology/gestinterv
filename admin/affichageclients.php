<fieldset><legend>﻿<h4>Recherche d'un client</h4></legend>
<center>
<form name="Recherche client par le NOM" action="index.php?p=seeknom" method="POST" class="form-seek">
	<input type="text" name="nom" id="search" placeholder="NOM du client"> <input type="submit" value="Recherche" id="submit">
</form>
<form name="Recherche client par un TELEPHONE" action="index.php?p=seektel" method="POST" class="form-seek">
	<input type="text" name="tel" id="search" placeholder="Téléphone FIXE" > <input type="submit" value="Recherche" id="submit">
</form>
</center>
</fieldset>

<br /><br />
<br />
<center><table border="1" rules="all">
<tr> <th colspan="3">Liste des clients</th> <th colspan="3">Administration</th> </tr>
<?php
// Affichage tableau des clients des 25 derniers - le 1er = le dernier ajouté
$tab = mysql_query ( "SELECT * FROM tclients ORDER BY nom LIMIT 0,25" )  or  die ( mysql_error() ) ;
	 
while ( $ligne = mysql_fetch_array($tab) )
{
	echo "<tr>" ;
	echo "<td align='center'><b>"	. $ligne['nom'] . "</b> " . $ligne['prenom'] . "</td>" ;
	echo "<td align='center'>"	. $ligne['telFixe'] . "<br>" . $ligne['telPort'] . "</td>" ;
	echo "<td align='center'>"	. $ligne['adresse'] . "</td>" ;
	echo "<td> <form action='index.php?p=ajoutpreinterv' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='hidden' name='lien' value='add-tabClient'> <input type='submit' value='Ajout pré-interventions'> </form></td>";
	echo "<td> <form action='index.php?p=addinterv' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Interventions'> </form></td>";
	echo "<td> <form action='index.php?p=modifclient' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Fiche client'> </form></td>";
	echo "<td align='center'><form action='clients/delclient.php?id=".$ligne["codeClient"]."' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ;
	echo "</tr>" ;
}
?>
</table></center>