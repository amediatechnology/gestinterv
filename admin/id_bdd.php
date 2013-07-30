<?php
// Identifiants BDD
$adresseSQL = 'localhost';
$pseudoSQL = 'root';
$mdpSQL = '';
$bddSQL = 'misinterventions';

// Connexion
$DataBase = mysql_connect ( $adresseSQL , $pseudoSQL , $mdpSQL ) ;
  
// Ouverture BDD
mysql_select_db ( $bddSQL ) ;
?>
