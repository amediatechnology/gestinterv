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
	<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="calendar.js"></script>
</head>

<body>

<div id="templatemo_wrapper">
	<div id="templatmeo_header"></div> <!-- end of header -->
    <div id="twitter"> Gestion des fiches d'intervention - MIS Avranches</div>
    <div id="templatemo_menu">
        <ul>
        	<li><a href="index.php?p=index"><span class="home"></span>Accueil</a></li>
        	<li><a href="index.php?p=ajoutpreinterv"><span class="portfolio"></span>Ajout pré-intervention</a></li>
        	<li><a href="index.php?p=showinterv"><span class="news"></span>Interventions</a></li>
	 	<li><a href="index.php?p=stats"><span class="news"></span>Statistiques</a></li>
        	<li class="last"><a href="index.php?p=admin"><span class="news"></span>Administration</a></li>
        </ul>    	
    </div> <!-- end of templatemo_menu -->
    
    <div id="templatemo_main">
     
    <div id="home"></div>
		<div class="content_box">
			<h2><!-- TITRE -->
			<?php
				// TITRES
				if (($_GET['p'])=="index") { echo "Accueil - MIS Informatique - News"; }	
				else if (($_GET['p'])=="stats") { echo "Statistiques générales"; }
				else if (($_GET['p'])=="seeknom") { echo "Recherche d'une personne par le NOM"; }
				else if (($_GET['p'])=="seektel") { echo "Recherche d'une personne par le TELEPHONE"; }
						
				//PAGES CLIENTS
				else if (($_GET['p'])=="showclients") { echo "Liste des clients"; }
				else if (($_GET['p'])=="addclient")	{ echo "Ajout d'un client"; }
				else if (($_GET['p'])=="modifclient") { echo "Modification de la fiche client"; }
							
				//PAGES INTERVENTIONS
				else if (($_GET['p'])=="showinterv") { echo "Liste des interventions"; }			
				else if (($_GET['p'])=="addinterv") { echo "Ajout d'une intervention"; }
				else if (($_GET['p'])=="addinterv2") { echo "Conversion d'une pré-intervention -> Création de la fiche d'intervention"; }			
				else if (($_GET['p'])=="ajoutpreinterv") { echo "Ajout d'un client + intervention à effectuer"; }		
				else if (($_GET['p'])=="modifinterv") { echo "Modification d'une intervention"; }
				
				//PAGES ADMIN
				else if(($_GET['p'])=="admin") { echo "Administration générale"; }
				
			?>
			</h2>
			   <div class="cleaner"></div>
				<div class="col_w340">
				<p>
				<!-- CONTENUS -->		
					<?php						
					if (($_GET['p'])=="index")
					{ 
						echo "<fieldset><legend align='center'><h4>Nous sommes aujourd'hui le <b>".date('d/m/y')."</b></h2></legend>";
						echo "<center><table border='1' rules='all'>";	// Affichage des news
						$sql = mysql_query ( "SELECT * FROM tnews ORDER BY id DESC;" )  or  die ( mysql_error() ) ;

						while ($ligne = mysql_fetch_array($sql))
						{
							echo "<tr>" ;
							echo "<td align='center'>" . $ligne['dateNews']		. "</td>" ;
							echo "<td align='center'>" . $ligne['auteur']	. "</td>" ;
							echo "<td align='center' width='75%'>" . $ligne['news']		. "</td>" ;
							echo "</tr>" ;
						} 
						echo "</table></center>";
						echo "</fieldset>";
					}
					else if (($_GET['p'])=="stats")	{ include('stats.php'); }
					else if (($_GET['p'])=="seeknom") { include('seek-nom.php'); }
					else if (($_GET['p'])=="seektel") { include('seek-tel.php'); }
					
					// CLIENTS
					else if (($_GET['p'])=="showclients") { include('clients/affichageclients.php'); }
					else if (($_GET['p'])=="addclient")	{ include('clients/ajoutclients.php'); }
					else if (($_GET['p'])=="modifclient") { include('clients/modifclient.php'); }
					
					// INTERVENTIONS
					else if (($_GET['p'])=="showinterv") { include('interventions/affichageinterv.php'); }
					else if (($_GET['p'])=="addinterv")	{ include('interventions/addinterv.php'); }
					else if (($_GET['p'])=="addinterv2") { include('interventions/addpreinterv_interv.php'); }
					else if (($_GET['p'])=="ajoutpreinterv") { include('interventions/ajoutpreintervention.php'); }
					else if (($_GET['p'])=="modifinterv") { include('interventions/modifinterv.php'); }
					
					// ADMIN
					else if (($_GET['p'])=="typeinterv") { include('admin/typeinterv.php'); }
					else if (($_GET['p'])=="techniciens") { include('admin/techniciens.php'); }
					else if (($_GET['p'])=="materiel") { include('admin/typemateriel.php'); }
					else if (($_GET['p'])=="admin") { include('admin/index.php'); }
					
					?>
				</p>
				
				</div>
			<div class="cleaner h30"></div>
			<div class="cleaner"></div>
		</div> <!-- end of a content box -->       
	</div> <!-- end of main -->
	
    <div id="templatemo_footer">Copyright © 2010-2013 - Julien HOMMET | <a href="http://misinformatique.com">MIS Informatique</a> | Designed by <a href="http://www.templatemo.com" target="_parent">Free CSS Templates</a></div>
	
</div> <!-- end of wrapper -->
</body>
</html>
