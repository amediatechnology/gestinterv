<?php include("id_bdd.php"); // Fichier contenant tous les identifiants pour se connecter à la BDD

// --- AJOUT D'UNE NEWS ---
if ( empty($_POST) ) // Si les variables "$_POST" sont vides,
	{ echo "<p>Pas d'actualité ajoutée</p><br /><hr /><br />"; } // Alors on affiche un message d'information.

else // Sinon (on suppose que les "$_POST" sont remplis)
	{
		$news 		= $_POST["news"]; $news = addslashes($news); // Récupération de la news + Sécurité caractères spéciaux
		$dateNews 	= $_POST["dateNews"]; // Récupération de la date
		$auteur 	= $_POST["auteur"]; $auteur = addslashes($auteur); // Récupération auteur de la news + Sécurité caractères spéciaux

		$add 		= mysql_query ( " INSERT INTO tnews VALUES ('','$news','$dateNews','$auteur'); " ) or die ( mysql_error() ) ; // Insertion des données dans la BDD - Si pb, affichage d'une erreur
		echo "<center><h4>Actualité ajoutée avec succès !!</h4></center><hr />"; // Message de confirmation
	}
?>

<table border="1" rules="all"> <!-- Tableau d'affichage des news -->
<tr> <th> Date </th> <th> News </th> <th> Auteur </th> </tr> <!-- En-tête des colonnes du tableau -->

<?php 
	$sql = mysql_query ( "SELECT * FROM tnews ;" ) or die ( mysql_error() ) ; // Sélection de toutes les news pour les afficher - Si pb, affichage d'une erreur
					  
	while ( $ligne = mysql_fetch_array($sql) ) // Boucle d'affichage des lignes du tableau : Tant qu'il y a des news...
	{ // On affiche les lignes du tableau
		echo "<tr>" ;
		echo "<td align='center'>" . $ligne['dateNews']		. "</td>" ; // Date de la news
		echo "<td align='center'>" . $ligne['news']		. "</td>" ; // Message - News
		echo "<td align='center'>" . $ligne['auteur']	. "</td>" ; // Auteur de la news
		echo "<td align='center'><form action='delnews.php?id=" . $ligne["id"] . "' method='POST'> <input type='hidden' name='id' value='" . $ligne["id"] . "'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ; // Bouton de suppression de la news (fait appel à la page delnews.php)
		echo "</tr>" ; // Fin du tableau
	} // Fin boucle While (Affichage tableau)
?>

</table> <!-- Fin du tableau des news -->

<hr /> <!-- Barre horizontale pour une meilleur organisation -->

<!-- Formulaire de création de news -->
<center><h2>Ajout d'une actualité</h2>
<form action="#" method="POST"> <!-- Le formulaire commence à ce point - Redirection dans cette même page pour ajouter une news (voir plus haut)-->
	Date : <input name="dateNews" type="text" size="7" required /><br /> <!-- Champ de saisie OBLIGATOIRE - DATE -->
	News : <textarea name="news" cols="25" rows="15" required></textarea><br /> <!-- Champ de saisie OBLIGATOIRE - NEWS -->
	Auteur : <select name="auteur"> <!-- Liste déroulante - Affichage de tous les techniciens -->
				<?php
				$sql2 = mysql_query ( " SELECT * FROM ttechniciens ; " ) or die ( mysql_error() ) ; // Affichage de tous les techniciens présents dans la BDD - Si pb, affichage d'une erreur
				
				while ( $ligne2 = mysql_fetch_array($sql2) ) // Boucle de recherche / affichage
				{ echo "<option value='" . $ligne2['nom'] . "'>" . $ligne2['nom'] . "</option>"; } // Création d'une ligne à chaque technicien trouvé "dans la boucle"
				?>
			</select> <!-- Fin de la liste déroulante -->
	<input type="submit" value="Ajouter" /> <!-- Bouton d'ajout de la news - Envoyer le formulaire rempli -->
</form> <!-- Fin du formulaire -->
</center> <!-- Le formulaire est centré dans la page - fermeture de la balise. -->