<?php
include('../admin/id_bdd.php');

$id	= $_GET["id"]; // Récupération du code matériel

// La requête SQL se base sur l'ID sélectionné grâce au bouton à côté de la ligne concernée.
$suppression = mysql_query ( "DELETE FROM ttypemateriel WHERE id='$id';" ) or die ( mysql_error() ) ; // Exécution de la requête - Si pb, affichage erreur.

Header("Location: ../index.php?p=administration"); // Redirection sur la page typemateriel.php pour faire une suppression "transparente" pour l'utilisateur.
?>
