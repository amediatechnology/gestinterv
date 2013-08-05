<?php
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
<?php // TITRES

switch ($_GET['p']) {
	case 'index':
		echo "<h1>Accueil - MIS Informatique - News</h1>";
	break;
	case 'recherche':
		echo "<h1>Recherche d'un client</h1>";
	break;
	case 'ajoutpreinterv':
		echo "<h1>Recherche d'un client</h1>";
	break;
	case 'showinterv':
		echo "<h1>Affichage des interventions</h1>";
	break;
	case 'interv-preinterv':
		echo "<h1>Transformation d'une <em>pré-intervention</em> en <u>intervention</u></h1>";
	break;
	case 'modifinterv':
		echo "<h1>Modification d'une intervention</h1>";
	break;
	case 'clients':
		echo "<h1>Liste des clients</h1>";
	break;
	case 'ficheclient':
		echo "<h1>Fiche client</h1>";
	break;
	case 'facturation':
		echo "<h1>Création d'une facture client</h1>";
	break;
	case 'administration':
		echo "<h1>Administration générale du site</h1>";
	break;
	}
?>

<ul id="menu">
	<li><a href="index.php?p=index">Accueil</a></li>
	<li><a href="index.php?p=ajoutpreinterv">Ajout d'une pré-intervention</a></li>
	<li><a href="index.php?p=showinterv">Affichage des interventions</a></li>
	<li><a href="index.php?p=clients">Liste des clients</a></li>
	<li><a href="index.php?p=facturation">Facturation</a></li>
	<li><a href="index.php?p=administration">./ Administration \.</a></li>
</ul>
<hr />

<?php // CONTENU

switch ($_GET['p']) {
	case 'index':
		include_once('news/news.php');
	break;
	case 'recherche':
		include_once('recherche.php');
	break;
	case 'ajoutpreinterv':
		include_once('preintervention/index.php');
	break;
	case 'showinterv':
		include_once('intervention/affichageinterv.php');
	break;
	case 'interv-preinterv':
		include_once('intervention/transfo-preinterv-interv.php');
	break;
	case 'modifinterv':
		include_once('intervention/modif-intervention.php');
	break;
	case 'clients':
		include_once('clients/affichageclients.php');
	break;
	case 'ficheclient':
		include_once('clients/ficheclient.php');
	break;
	case 'facturation':
		include_once('facturation/index.php');
	break;
	case 'administration':
		include_once('admin/index.php');
	break;
	}
?>

</body>

</html>