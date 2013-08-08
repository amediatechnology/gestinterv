<?php
// --- AJOUT D'UNE NEWS ---
if ( !empty($_POST) ) // Si les variables "$_POST" sont vides,
{
	$news 		= addslashes($_POST["news"]); // Récupération de la news + Sécurité caractères spéciaux
	$dateNews 	= $_POST["dateNews"]; // Récupération de la date
	$auteur 	= addslashes($_POST["auteur"]); // Récupération auteur de la news + Sécurité caractères spéciaux

	$add 		= mysql_query ( "INSERT INTO tnews VALUES ('','$news','$dateNews','$auteur');" ) or die ( mysql_error() ) ; // Insertion des données dans la BDD - Si pb, affichage d'une erreur
}

echo "<fieldset><legend align='center'>Nous sommes aujourd'hui le <big><b>".date('d/m/y')."</b></big></legend>";
echo "<center><table border='1' rules='all'>";	// Affichage des news
$sql = mysql_query ( "SELECT * FROM tnews ORDER BY id DESC;" ) or die ( mysql_error() ) ;

while ($ligne = mysql_fetch_array($sql))
{
	echo "<tr>" ;
	echo "<td align='center'>" . $ligne['dateNews']	. "</td>" ;
	echo "<td align='center'>" . $ligne['auteur'] . "</td>" ;
	echo "<td align='center' width='75%'>" . $ligne['news']	. "</td>" ;
	echo "<td><form action='news/delnews.php?id=" . $ligne["id"] . "' method='POST'> <input type='hidden' name='id' value='" . $ligne["id"] . "'> <input type='submit' value='Suppression' onclick=\"javascript:return(confirm('Confirmer la suppression ?'))\";> </form></td>" ; // Bouton de suppression de la news (fait appel à la page delnews.php)
	echo "</tr>" ;
} 
	echo "</table></center>";
	echo "</fieldset>";
?>
<br />
<center>
<div class="spoiler">
<input onclick="showSpoiler(this);" value="Afficher / cacher le formulaire d'ajout d'une news" type="button" />
	<div class="inner" style="display: none;">
	<a>
	<br />
	<!-- Formulaire de création de news -->
	<fieldset><legend><h2>Ajout d'une actualité</h2></legend>
	<form action="#" method="POST"> <!-- Le formulaire commence à ce point - Redirection dans cette même page pour ajouter une news (voir plus haut)-->
		Date : <input name="dateNews" type="text" size="14" value="<?php echo date("d/m/Y") ." - ". date("H:i"); ?>" required /><br /> <!-- Champ de saisie OBLIGATOIRE - DATE -->
		News :<br /> <textarea name="news" cols="45" rows="10" required></textarea><br /> <!-- Champ de saisie OBLIGATOIRE - NEWS -->
		Auteur : <select name="auteur"> <!-- Liste déroulante - Affichage de tous les techniciens -->
				<?php
				$sql2 = mysql_query ( "SELECT * FROM ttechniciens;" ) or die ( mysql_error() ) ; // Affichage de tous les techniciens présents dans la BDD - Si pb, affichage d'une erreur
					
				while ( $ligne2 = mysql_fetch_array($sql2) ) // Boucle de recherche / affichage
				{ echo "<option value='".$ligne2['nom']."'>".$ligne2['nom']."</option>"; } // Création d'une ligne à chaque technicien trouvé "dans la boucle"
					?>
				</select> <!-- Fin de la liste déroulante -->
		<input type="submit" value="Ajouter" /> <!-- Bouton d'ajout de la news - Envoyer le formulaire rempli -->
	</form><!-- Fin du formulaire -->
	</fieldset>
</center> <!-- Le formulaire est centré dans la page - fermeture de la balise. -->
	</a>
	</div>
</div>