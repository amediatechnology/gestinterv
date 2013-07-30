﻿<?php
include ("admin/id_bdd.php");

// Si l'url ".../index.php?page=" est vide, alors on redirige sur la bonne url.
if (empty($_GET["p"])) { header("Location: index.php?p=index"); }
?>

<!DOCTYPE>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Gestion des fiches d'intervention - MIS Informatique</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="scripts/calendar.js"></script>
	
	<script type="text/javascript"> <!-- Spoiler -->
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

<body>
<?php
// TITRES

// Site
if (($_GET['p'])=="index") { echo "<h1>Accueil - MIS Informatique - News</h1>"; }
else if (($_GET['p'])=="recherche") { echo "<h1>Recherche d'un client</h1>"; }

// Pré-interventions
else if (($_GET['p'])=="ajoutpreinterv") { echo "<h1>Ajout d'une pré-intervention</h1>"; }

// Interventions
else if (($_GET['p'])=="showinterv") { echo "<h1>Affichage des interventions</h1>"; }
else if (($_GET['p'])=="interv-preinterv") { echo "<h1>Transformation d'une <em>pré-intervention</em> en <u>intervention</u></h1>"; }
else if (($_GET['p'])=="modifinterv") { echo "<h1>Modification d'une intervention</h1>"; }

// Clients
else if (($_GET['p'])=="clients") { echo "<h1>Liste des clients</h1>"; }
else if (($_GET['p'])=="ficheclient") { echo "<h1>Fiche client</h1>"; }

// Administration
else if (($_GET['p'])=="administration") { echo "<h1>Administration générale du site</h1>"; }

?>

<ul>
	<li><a href="index.php?p=index">Accueil</a></li>
	<li><a href="index.php?p=ajoutpreinterv">Ajout d'une pré-intervention</a></li>
	<li><a href="index.php?p=showinterv">Affichage des interventions</a></li>
	<li><a href="index.php?p=clients">Liste des clients</a></li>
	<li><a href="index.php?p=administration">./ Administration \.</a></li>
</ul>
<hr />

<?php

// CONTENU

// Page d'accueil
if (($_GET['p'])=="index")
{ include "news/news.php"; }

else if (($_GET['p'])=="recherche") { include('recherche.php'); }

// Pré-interventions
else if (($_GET['p'])=="ajoutpreinterv") { include('preintervention/index.php'); }

// Interventions
else if (($_GET['p'])=="showinterv") { include('intervention/affichageinterv.php'); }
else if (($_GET['p'])=="interv-preinterv") { include('intervention/transfo-preinterv-interv.php'); }
else if (($_GET['p'])=="modifinterv") { include('intervention/modif-intervention.php'); }

// Clients
else if (($_GET['p'])=="clients") { include('clients/affichageclients.php'); }
else if (($_GET['p'])=="ficheclient") { include('clients/ficheclient.php'); }

// Administration
else if (($_GET['p'])=="administration") { include('admin/index.php'); }
?>

</body>

</html>