<?php
// Identifiants BDD
$adresseSQL = 'localhost';
$pseudoSQL = 'julien';
$mdpSQL = '';
$bddSQL = 'misinterventions';

// Connexion
$DataBase = mysql_connect ( $adresseSQL , $pseudoSQL , $mdpSQL ) ;
  
// Ouverture BDD
mysql_select_db ( $bddSQL ) ;
?>
