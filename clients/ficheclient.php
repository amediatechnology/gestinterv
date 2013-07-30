<head>
	<script type="text/javascript">
	function showSpoiler(obj)
	{
	var inner = obj.parentNode.getElementsByTagName("div")[0];
	if (inner.style.display == "none")
	inner.style.display = "";
	else
	inner.style.display = "none";
	}
	</script>
</head>

<?php
	// Récupération du code Client (grace à la redirection)
	$id = $_POST["id"];

	// Affichage du client à modifier à partir de son code client
	$req = mysql_query ( "SELECT * FROM tclients WHERE codeClient='$id';" ) or die ( mysql_error() ) ;
	$ligne = mysql_fetch_array($req) ;
	
	// Affichage des interventions effectuées du client
	$req1 = mysql_query ( "SELECT * FROM tinterventions WHERE codeClient='$id';" ) or die ( mysql_error() ) ;
?>

<center><table border="1" rules="all">
<?php  // Affichage de la fiche client
	echo "<tr> <td align='center' colspan='2'><b>" . $ligne['nom'] . "</b> " . $ligne['prenom'] . "</tr>";
	echo "<tr> <td align='center'>".$ligne['telFixe'] . " - " . $ligne['telPort'] . "</td> </tr> ";
	echo "<tr> <td align='center'>".$ligne['adresse']."</td> </tr>" ;
?>
</table>
<br />
<div class="spoiler">
<input onclick="showSpoiler(this);" value="Afficher / cacher le formulaire de modification de la fiche client" type="button" />
	<div class="inner" style="display: none;"><a>
	<br />
		<form action="clients/update-fiche-client.php" method="POST">
			<fieldset style="width:700px; text-align:justify;"><legend><h2>Modification de la fiche client "<u><?php echo $ligne["nom"] ; ?></u>" - Fiche n°: <input name="id" type="hidden" value="<?php echo $id ; ?>"><?php echo $id ; ?></h2></legend>
				Nom : <input name="nom" type="text" value="<?php echo $ligne['nom'] ; ?>" required /> | Prénom : <input name="prenom" type="text" value="<?php echo $ligne['prenom'] ; ?>"><br />
				Tél fixe : <input name="telFixe" type="text" value="<?php echo $ligne['telFixe'] ; ?>"> | Tél portable : <input name="telPort" type="text" value="<?php echo $ligne['telPort'] ; ?>"><br />
				Adresse : <input name="adresse" type="text" size="70" value="<?php echo $ligne['adresse'] ; ?>">
				<br />
			<input type="submit" value="Envoyer les modifications" style="width:250px; height:50px;font-size:14px;" />
			</fieldset>
		</form></a>
	</div>
</div>
</center>

<hr />

<?php if (mysql_num_rows($req1) >= 1)
{ // Si des fiches d'interventions sont trouvées pour le client (suivant le code client), on affiche toutes les interventions déjà effectuées ?>

<table border="1" rules="all"><legend><h3>Récapitulatif des interventions <u>déjà effectuées</u></h3></legend>
<tr> <th> DATE </th> <th> INTERVENTION </th> <th>MATERIEL</th> <th>OBSERVATIONS</th> <th>PRIX</th> <th>TECHNICIEN</th> <th colspan="3">ADMINISTRATION</th> </tr>
<?php
	// Tant qu'il y a des interventions & des clients à côté... :
	while (  ($ligne1 = mysql_fetch_array($req1) ) )
	{
		$materiel = $ligne1['materiel']	;
		
	// Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
		echo "<tr>" ;
		echo "<td align=center><b>" . $ligne1['dateInterv'] 	. "</b></td>" ;
		echo "<td align=center>" . $ligne1['intervention'] 		. "</td>" ;
		echo "<td align=center>" . $ligne1['materiel'] 			. "</td>" ;
		echo "<td align=center>" . $ligne1['observations']		. "</td>" ;
		echo "<td align=center>" . $ligne1['prix'] 				. " €</td>" ;
		echo "<td align=center>" . $ligne1['technicien'] 		. "</td>" ;
		echo "<td> <form action='index.php?p=modifinterv' method='post'> <input type='hidden' name='id' value='" . $ligne1["codeIntervention"] . "'> <input type='submit' value='Modification'> </form></td>";

		switch ($materiel) { // Selon le matériel qui a été sélectionné, la page ne sera pas la même.
			case 'PC FIXE':
			echo "<td> <form action='intervention/imprimer-intervention-pc.php' method='POST'> <input type='hidden' name='id' value='" . $ligne1['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;

			case 'PC PORTABLE':
			echo "<td> <form action='intervention/imprimer-intervention-pc.php' method='POST'> <input type='hidden' name='id' value='" . $ligne1['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;

			case 'IMPRIMANTE':
			echo "<td> <form action='intervention/imprimer-intervention-peripheriques.php' method='POST'> <input type='hidden' name='id' value='" . $ligne1['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;
			
			case 'TABLETTE TACTILE':
			echo "<td> <form action='intervention/imprimer-intervention-peripheriques.php' method='POST'> <input type='hidden' name='id' value='" . $ligne1['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;

			case 'PERIPHERIQUE':
			echo "<td> <form action='intervention/imprimer-intervention-peripheriques.php' method='POST'> <input type='hidden' name='id' value='" . $ligne1['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;

			case 'AUTRES':
			echo "<td> <form action='intervention/imprimer-intervention-peripheriques.php' method='POST'> <input type='hidden' name='id' value='" . $ligne1['codeIntervention'] . "'> <input type='submit' value='Affichage / Impression'> </form></td>";
			break;
		 }
		echo "</tr>" ;
  	} 
?>
</table>
<?php 
}
else { include "preintervention/formulaire-preinterv.php"; } // Sinon, il n'y a pas d'intervention -> Formulaire d'ajout d'une pré-intervention ?>