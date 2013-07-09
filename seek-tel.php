<?php						
// Recherche de personne.
// Si une personne a été entrée dans la zone de saisie, alors les "_POST" ne sont pas NULL / 0.			
if ( count($_POST) != 0 )
{
	$tel = htmlspecialchars($_POST["tel"]);
	$recup = mysql_query("SELECT * FROM tclients WHERE telFixe LIKE '%$tel' OR telPort LIKE '%$tel' ;") or  die( mysql_error() ) ;
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
	echo "<td> <form action='index.php?p=addinterv' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Interventions'> </form></td>";
	echo "<td> <form action='index.php?p=modifclient' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Fiche client'> </form></td>";
	echo "<td align='center'><form action='clients/delclient.php?id=".$ligne["codeClient"]."' method='post'> <input type='hidden' name='id' value='".$ligne["codeClient"]."'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ;
	echo "</tr>" ;
}
echo "</table>";
		}  
}
?>
