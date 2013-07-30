<?php

include('../admin/id_bdd.php');

$id	= $_GET["id"]; // Récupération du code news

// La requête SQL se base sur l'ID sélectionné grâce au bouton à côté de la ligne concernée.
$sql = mysql_query ( "DELETE FROM tnews WHERE id='$id';" ) or die ( mysql_error() ) ; // Exécution de la requête - Si pb, affichage erreur.

Header("Location: ../index.php?=index"); // Redirection sur la page news.php pour faire une suppression "transparente" pour l'utilisateur.
?>
