<?php include ("../admin/id_bdd.php");

$id = $_POST["id"]; // Récupération de la dernière fiche de pré-intervention saisie

// Affichage de toutes les interventions
	$interv = "SELECT * FROM tpreinterv WHERE codePreInterv = '$id';" ;
	$resultat = mysql_query ( $interv ) or die ( mysql_error() ) ;

// Affiche du nom à côté de l'intervention concernée
	$client = "SELECT nom,telFixe,telPort,adresse FROM tclients,tpreinterv WHERE tpreinterv.codeClient=tclients.codeClient AND codePreInterv = '$id';" ;
	$resultat1 = mysql_query ( $client ) or die ( mysql_error() ) ;
?>

<!-- <body onload="window.print()"> -->
<img src="../images/logo_mis.png" alt="Logo MIS" width="150px" height="100px" align="left"> <center><h1>Demande d'intervention</h1></center>
<br />
<p align="right">
<?php
	// Tant qu'il y a des interventions & des clients à côté... :
	while ( ($ligne = mysql_fetch_array($resultat)) && ($ligne1 = mysql_fetch_array($resultat1)) )
	{
		echo "Client : <b><font size='6'>" . $ligne1['nom'] . "</font></b><br />" ;
		echo "Téléphone PORTABLE : <b>" . $ligne1['telPort'] . "</b> - Téléphone FIXE : <b>" . $ligne1['telFixe'] . "</b><br />" ;
		echo "Adresse : <b>" . $ligne1['adresse'] . "</b>" ;
?>
</p>
<br /><hr />
<h3><u>Fiche matériel</u></h3>
<hr />

<?php
		echo "Date de <b>dépôt du matériel</b> : " . $ligne['dateDepot'] . " ----> Date de <b>restitution prévue le</b> : <font size='7'><b>" . $ligne['dateRestitution'] . "</b></font> <br />";
		echo "<br />";	
		echo "<b>Matériel</b> concerné : <b><font size='5'>" . $ligne['materiel'] . "</font/></b><br />" ;				
		echo "<b>Intervention</b> à effectuer : <b><font size='5'>" . $ligne['typeInterv'] . "</font></b><br />" ;
		echo "<br />";
		echo "<b>Observations</b> annexes : <br /> <textarea readonly cols='60' rows='6'>" . $ligne['observations'] . "</textarea>  Mot de passe : <b>" . $ligne['password'] . "</b> <br /><br />" ;
		echo "Dossiers spécifiques à sauvergarder : <b>" . $ligne['dossierClt'] . "</b> <br />" ;
		echo "Sauvegarde complémentaire : <b>" . $ligne['dossierMesDocs'] . "</b> <br />";
  	}
?>
<br /><hr />
<center><b>Après avoir convenablement vérifié l'exactitude des informations ci-dessus, merci de signer le document pour approuver la demande d'intervention.</b></center>
<b>Signature client</b> - Accord pour intervention
	<table><td><table width="275px" height="100px" border="1"> <tr> <td></td> </tr> </table> </td> <td> <table rules="all"> <td> <p align="justify" style="background-color:#ebebeb; font-size:12px; padding:0 0 0 15px;">Nous déclinons toute responsabilité en cas de perte de données relative à des virus, à une mauvaise utilisation ou à un problème de disque dur défectueux. <u>Le matériel n'a pas une durée de vie illimitée</u>, <b>l'utilisateur reste le seul responsable de ses sauvegardes de fichiers</b> sur tous supports existants (disque dur externe, CD, DVD, clé USB etc...).<br />
	En cas de formatage, <u>nous procédons à la sauvegarde des seuls documents accessibles que <b>nous remettons ensuite sur le disque dur de l'ordinateur</b></u>. Cependant, <b>il nous est impossible de garantir une restitution complète des documents</b> <u>compte-tenu des contraintes techniques</u> qui peuvent nous être imposées.</br />
	Pour des raisons de confidentiliaté et pour éviter tout problème ultérieur, <b><u>les données utilisateurs ne seront pas conservées sur nos serveurs</b></u>.<br />
	Les logiciels spécifiques ne peuvent pas être réinstallés <u>pour des raisons de licence</u>.</p></td></table></td></table>
	
</body>

<footer align="center"><h4><a href="../index.php?p=showinterv">Retour sur le site</a></h4></footer>
