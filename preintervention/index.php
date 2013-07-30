<center>
<fieldset style="width:600px; text-align:justify;"><center><h3>Recherche du client</h3></center>
	<form action="#" method="POST">
		Rercherche par le <b>NOM</b> : <input type="text" size="25" name="nom-client" placeholder="NOM du client" /> <input type="submit" value="Rechercher" /><br />
	</form>
	
	<form action="#" method="POST">
		Rercherche par le <b>TÉLÉPHONE FIXE</b> : <input type="text" size="25" name="tel-client" placeholder="Téléphone FIXE du client" /> <input type="submit" value="Rechercher" />
	</form>
</fieldset>
</center>

<br />

<?php  

if ( (empty($_POST)) )
{ include "formulaire-preinterv.php"; }

if ( (isset($_POST["id"])) && (count($_POST) != 0) )
{ 
	$id = $_POST["id"]; 
	
	$recherche = mysql_query("SELECT * FROM tclients WHERE codeClient = '$id';") or die ( mysql_error() ) ;
	if (mysql_num_rows($recherche) >= 1 ) 
	{
?>
		<table border="3" rules="all">
		<tr> <th>NOM</th> <th>TEL. FIXE</th> <th>TEL. PORTABLE</th> <th>ADRESSE</th> <th colspan="3">OPÉRATIONS</th> </tr>
		<?php // Enumération des lignes du résultat de la requête
		while ( $ligne = mysql_fetch_array($recherche) )
		{
			echo "<tr>" ;
			echo "<td align='center'><b>" 	. $ligne['nom']		. "</b></td>" ;
			echo "<td align='center'>"		. $ligne['telFixe'] . "</td>" ;
			echo "<td align='center'>" 		. $ligne['telPort']	. "</td>" ;
			echo "<td align='center'>"		. $ligne['adresse']	. "</td>" ;
			echo "<td> <form action='index.php?p=modifclient' method='POST'> <input type='hidden' name='id' value='".$ligne["codeClient"]."' /> <input type='submit' value='Fiche client' /> </form></td>";
			echo "<td> <form action='index.php?p=addinterv' method='POST'> <input type='hidden' name='id' value='".$ligne["codeClient"]."' /> <input type='submit' value='Interventions' /> </form></td>";
			echo "</tr>" ;
			echo "</table>";
			
			include "formulaire-preinterv.php";
		}  
	}
	
	else
	{
		echo "Client inconnu - Merci de remplir la fiche client. <br />";
		include "formulaire-preinterv.php";
	}
}

else if ( (isset($_POST["nom-client"])) && (count($_POST) != 0) )
{ 
	$nom_client = addslashes($_POST["nom-client"]); 
	
	$recherche = mysql_query("SELECT * FROM tclients WHERE nom LIKE '%$nom_client';") or  die ( mysql_error() ) ;
	if (mysql_num_rows($recherche) >= 1 ) 
	{
?>
		<table border="3" rules="all">
		<tr> <th>NOM</th> <th>TEL. FIXE</th> <th>TEL. PORTABLE</th> <th>ADRESSE</th> <th colspan="3">OPÉRATIONS</th> </tr>
		<?php // Enumération des lignes du résultat de la requête
		while ( $ligne = mysql_fetch_array($recherche) )
		{
			echo "<tr>" ;
			echo "<td align='center'><b>" 	. $ligne['nom']		. "</b></td>" ;
			echo "<td align='center'>"		. $ligne['telFixe'] . "</td>" ;
			echo "<td align='center'>" 		. $ligne['telPort']	. "</td>" ;
			echo "<td align='center'>"		. $ligne['adresse']	. "</td>" ;
			echo "<td> <form action='index.php?p=modifclient' method='POST'> <input type='hidden' name='id' value='".$ligne["codeClient"]."' /> <input type='submit' value='Fiche client' /> </form></td>";
			echo "<td> <form action='index.php?p=addinterv' method='POST'> <input type='hidden' name='id' value='".$ligne["codeClient"]."' /> <input type='submit' value='Interventions' /> </form></td>";
			echo "</tr>" ;
			echo "</table>";
			
			include "formulaire-preinterv.php";
		}  
	}
	
	else
	{
		echo "Client '".$nom_client."' inconnu - Merci de remplir la fiche client. <br />";
		include "formulaire-preinterv.php";
	}
}

else if ( (isset($_POST["tel-client"])) && (count($_POST) != 0) )
{ 
	$tel_client = addslashes($_POST["tel-client"]); 
	
	$recherche = mysql_query("SELECT * FROM tclients WHERE telfixe LIKE '%$tel_client';") or  die ( mysql_error() ) ;
	if (mysql_num_rows($recherche) >= 1 ) 
	{
?>
		<table border="3" rules="all">
		<tr> <th>NOM</th> <th>TEL. FIXE</th> <th>TEL. PORTABLE</th> <th>ADRESSE</th> <th colspan="3">OPÉRATIONS</th> </tr>
<?php // Enumération des lignes du résultat de la requête
		while ( $ligne = mysql_fetch_array($recherche) )
		{
			echo "<tr>" ;
			echo "<td align='center'><b>" 	. $ligne['nom']		. "</b></td>" ;
			echo "<td align='center'>"		. $ligne['telFixe'] . "</td>" ;
			echo "<td align='center'>" 		. $ligne['telPort']	. "</td>" ;
			echo "<td align='center'>"		. $ligne['adresse']	. "</td>" ;
			echo "<td> <form action='index.php?p=addinterv' method='POST'> <input type='hidden' name='id' value='".$ligne["codeClient"]."' /> <input type='submit' value='Interventions' /> </form></td>";
			echo "<td> <form action='index.php?p=modifclient' method='POST'> <input type='hidden' name='id' value='".$ligne["codeClient"]."' /> <input type='submit' value='Fiche client' /> </form></td>";
			echo "</tr>" ;
			echo "</table>";			
			
			include "formulaire-preinterv.php";
		}
	}
	
	else
	{
		echo "Le client avec le numéro de téléphone <u>fixe</u> <em>'".$tel_client."'</em> est inconnu - Essayer le numéro de téléphone <u>portable</u>. Sinon, créer la fiche client.<br />";
		include "formulaire-preinterv.php";
	}
}

?>