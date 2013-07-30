<fieldset><legend>﻿<h3>Recherche d'un client</h3></legend>
<center>

<form action="#" method="POST">
Rercherche par le <b>NOM</b> : <input type="text" name="nom-client" placeholder="NOM du client" /> <input type="submit" value="Recherche" />
</form>

<form action="#" method="POST">
Rercherche par le <b>TÉLÉPHONE FIXE</b> : <input type="text" name="tel-client" placeholder="Téléphone FIXE" /> <input type="submit" value="Recherche" />
</form>

</center>
</fieldset>

<br /><hr /><br />

<?php			
// Recherche de personne.
// Si une personne a été entrée dans la zone de saisie, alors les "_POST" ne sont pas NULL / 0.			
if ( (count($_POST) != 0) && (isset($_POST["nom-client"])) )
{
	$nom = htmlspecialchars($_POST["nom-client"]);
	$recup = mysql_query("SELECT * FROM tclients WHERE nom LIKE '%$nom%';") or die ( mysql_error() ) ;
	
	if (mysql_num_rows($recup)) 
		{
?>
		<table border = "1" rules = "all">
		<tr> <th>NOM</th> <th>TEL. FIXE</th> <th>TEL. PORTABLE</th> <th>ADRESSE</th> </tr>
<?php	// Enumération des lignes du résultat de la requête
		while ( $ligne = mysql_fetch_array($recup) )
		{
			echo "<tr>" ;
			echo "<td align='center'><b>" 	. $ligne['nom']		. "</b></td>" ;
			echo "<td align='center'>"		. $ligne['telFixe'] . "</td>" ;
			echo "<td align='center'>" 		. $ligne['telPort']	. "</td>" ;
			echo "<td align='center'>"		. $ligne['adresse']	. "</td>" ;
			echo "<td> <form action='index.php?p=ajoutpreinterv' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."' /> <input type='submit' value='Ajout pré-interventions' /> </form></td>";
			echo "<td> <form action='index.php?p=ficheclient' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Fiche client'> </form></td>";
			// echo "<td align='center'><form action='clients/delclient.php?id=".$ligne["codeClient"]."' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ;
			echo "</tr>" ;
		}
			echo "</table>";
		}  
}
		
else if ( (count($_POST) != 0) && (isset($_POST["tel-client"])) )
{
	$tel_client = htmlspecialchars($_POST["tel-client"]);
	$recup = mysql_query("SELECT * FROM tclients WHERE telFixe LIKE '%$tel_client%' OR telPort LIKE '%$tel_client%' ;") or die ( mysql_error() ) ;
	if (mysql_num_rows($recup)) 
		{
?>
		<table border = "1" rules = "all">
		<tr> <th>NOM</th> <th>TEL. FIXE</th> <th>TEL. PORTABLE</th> <th>ADRESSE</th> </tr>
<?php	// Enumération des lignes du résultat de la requête
		while (  $ligne = mysql_fetch_array($recup) )
		{
			echo "<tr>" ;
			echo "<td align='center'><b>" 	. $ligne['nom']		. "</b></td>" ;
			echo "<td align='center'>"		. $ligne['telFixe'] . "</td>" ;
			echo "<td align='center'>" 		. $ligne['telPort']	. "</td>" ;
			echo "<td align='center'>"		. $ligne['adresse']	. "</td>" ;
			echo "<td> <form action='index.php?p=ajoutpreinterv' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Ajout pré-interventions'> </form></td>";
			echo "<td> <form action='index.php?p=ficheclient' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Fiche client'> </form></td>";
			// echo "<td align='center'><form action='clients/delclient.php?id=".$ligne["codeClient"]."' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ;
			echo "</tr>" ;
		}
			echo "</table>";
		}  
}
?>
