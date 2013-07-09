<?php include("id_bdd.php"); // Fichier contenant tous les identifiants pour se connecter à la BDD

// --- AJOUT D'UNE NEWS ---
if ( empty($_POST) ) // Si les variables "$_POST" sont vides,
	{ echo "<p>Pas de logiciel récemment ajouté.</p><br /><hr /><br />"; } // Alors on affiche un message d'information.

else // Sinon (on suppose que les "$_POST" sont remplis)
	{
		$logiciel 	= $_POST["logiciel"]; $logiciel = addslashes($logiciel); // Récupération nom logiciel + Sécurité caractères spéciaux

		$add 		= mysql_query ( " INSERT INTO tlogiciels VALUES ('','$logiciel'); " ) or die ( mysql_error() ) ; // Insertion des données dans la BDD - Si pb, affichage d'une erreur
		echo "<center><h4>Logiciel ' " . $logiciel . " ' ajouté avec succès !!</h4></center><br /><hr /><br />"; // Message de confirmation
	}
?>

<table border="1" rules="all"> <!-- Tableau d'affichage des news -->
<tr> <th> Logiciel </th> </tr> <!-- En-tête des colonnes du tableau -->

<?php 
	$sql = mysql_query ( " SELECT * FROM tlogiciels ; " ) or die ( mysql_error() ) ; // Sélection de toutes les news pour les afficher - Si pb, affichage d'une erreur
					  
	while ( $ligne = mysql_fetch_array($sql) ) // Boucle d'affichage des lignes du tableau : Tant qu'il y a des news...
	{ // On affiche les lignes du tableau
		echo "<tr>" ;
		echo "<td align='center'>" . $ligne['nom'] . "</td>" ; // Date de la news
		echo "<td align='center'><form action='dellogiciel.php?id=" . $ligne["id"] . "' method='POST'> <input type='hidden' name='id' value='".$ligne["id"]."'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ; // Bouton de suppression du logiciel (fait appel à la page dellogiciel.php)
		echo "</tr>" ; // Fin du tableau
	} // Fin boucle While (Affichage tableau)
?>

</table> <!-- Fin du tableau des news -->

<hr /> <!-- Barre horizontale pour une meilleur organisation -->

<!-- Formulaire de création de news -->
<center><h2>Ajout d'un logiciel</h2>
<form action="#" method="POST"> <!-- Le formulaire commence à ce point - Redirection dans cette même page pour ajouter une news (voir plus haut)-->
	Nom du logiciel : <input name="logiciel" type="text" size="7" required /><br /> <!-- Champ de saisie OBLIGATOIRE - DATE -->
	<input type="submit" value="Ajouter" /> <!-- Bouton d'ajout de la news - Envoyer le formulaire rempli -->
</form> <!-- Fin du formulaire -->
</center> <!-- Le formulaire est centré dans la page - fermeture de la balise. -->