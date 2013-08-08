<?php include ("../admin/id_bdd.php");

$id = $_POST["id"]; // Récupération de la dernière fiche de pré-intervention saisie
	
// Affichage de toutes les interventions
	$interv = "SELECT * FROM tinterventions WHERE codeIntervention = '$id';" ;
	$Resultat = mysql_query ( $interv )  or  die ( mysql_error() ) ;

while ( ($ligne = mysql_fetch_array($Resultat)) )
	{ 
?>

<!-- <body onload="window.print()"> -->
<body>

	<center><h1>Rapport d'intervention</h1>
	<font size="5"><b><?php echo $ligne['intervention']; ?></b></font><br />
	</center>
	<hr />
	
	<fieldset><legend><h2>Résultat des analyses</h2></legend>
	<b>Virus</b> (externe + interne) = <font size="6"><?php echo $ligne['antivirus']; ?></font> <br />
	<b>Malwares</b> (externe + interne) = <font size="6"><?php echo $ligne['malwares']; ?></font> <br />
	<b>Spywares</b> = <font size="6"><?php echo $ligne['spybot']; ?></font>
	</fieldset>
	
	<br />
	
	<fieldset><legend><h2>Installation / Mise à jour logiciels</h2></legend>
	<b>Logiciels</b> : <font size="5"><?php echo $ligne['logiciels']; ?></font><br /><br />
	<b>Système</b> : <font size="5"><?php echo $ligne['maj']; ?></font><br /><br />
	</fieldset>
	
	<br />
	
	<fieldset><legend><h2>Observations & informations annexes :</h2></legend>
	<font size="5"><?php echo $ligne['virus']; ?></font><br />
	<font size="5"><?php echo $ligne['ram']; ?></font><br />
	<textarea readonly cols='50' rows='6'><?php echo $ligne['observations']; ?></textarea><br />
	<b>Coût</b> : <font size="5"><?php echo $ligne['prix']; ?> €</font><br />
	</fieldset>
<?php
	} // Fin boucle
?>
</body>

<footer align="center"><h4><a href="../index.php?p=showinterv">Retour sur le site</a></h4></footer>
