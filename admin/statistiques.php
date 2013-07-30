<?php
// Nombre de clients
	$Resultat1 = mysql_query ( "SELECT COUNT(*) AS CLIENTS FROM tclients ;" ) or die ( mysql_error() ) ;
//Nombre d'interventions
	$Resultat2 = mysql_query ( "SELECT COUNT(*) AS NBINTERVENTIONS FROM tinterventions ;" ) or die ( mysql_error() ) ;
//Nombre de MO Atelier
	$Resultat3 = mysql_query ( "SELECT COUNT(materiel) AS MOATELIER FROM tinterventions WHERE materiel='MO ATELIER' ;" ) or die ( mysql_error() ) ;
//Nombre PC FIXE
	$Resultat4 = mysql_query ( "SELECT COUNT(materiel) AS PCFIXE FROM tinterventions WHERE materiel='PC FIXE' ;" ) or die ( mysql_error() ) ;
//Nombre PC Portable
	$Resultat5 = mysql_query ( "SELECT COUNT(materiel) AS PCPORTABLE FROM tinterventions WHERE materiel='PC PORTABLE' ;" ) or die ( mysql_error() ) ;
//Nombre FORMATAGE
	$Resultat6 = mysql_query ( "SELECT COUNT(intervention) AS FORMATAGE FROM tinterventions WHERE intervention='FORMATAGE' ;" ) or die ( mysql_error() ) ;
//Nombre NETTOYAGE
	$Resultat7 = mysql_query ( "SELECT COUNT(intervention) AS NETTOYAGE FROM tinterventions WHERE intervention='NETTOYAGE' ;" ) or die ( mysql_error() ) ;
//Nombre INTERVENTIONS GILLES
	$Resultat8 = mysql_query ( "SELECT COUNT(technicien) AS GILLES FROM tinterventions WHERE technicien='GILLES' ;" ) or die ( mysql_error() ) ;
//Nombre INTERVENTIONS NICOLAS
	$Resultat9 = mysql_query ( "SELECT COUNT(technicien) AS NICOLAS FROM tinterventions WHERE technicien='NICOLAS' ;" ) or die ( mysql_error() ) ;
//Nombre INTERVENTIONS JULIEN
	$Resultat10 = mysql_query ( "SELECT COUNT(technicien) AS JULIEN FROM tinterventions WHERE technicien='JULIEN' ;" ) or die ( mysql_error() ) ;
//Nombre INTERVENTIONS GILLES ET NICOLAS
	$Resultat12 = mysql_query ( "SELECT COUNT(technicien) AS GILLESNICOLAS FROM tinterventions WHERE technicien='GILLES ET NICOLAS' ;" ) or die ( mysql_error() ) ;

// TOTAL BRUT des prestations
	$Resultat13 = mysql_query ( "SELECT SUM(prix) AS TOTALBRUT FROM tinterventions ;" ) or die ( mysql_error() ) ;
// TOTAL BRUT NETTOYAGE
	$Resultat14 = mysql_query ( "SELECT SUM(prix) AS TOTALBRUTNETTOYAGE FROM tinterventions WHERE intervention='NETTOYAGE';" ) or die ( mysql_error() ) ;
// TOTAL BRUT FORMATAGE
	$Resultat15 = mysql_query ( "SELECT SUM(prix) AS TOTALBRUTFORMATAGE FROM tinterventions WHERE intervention='FORMATAGE';" ) or die ( mysql_error() ) ;
// TOTAL BRUT MO ATELIER
	$Resultat16 = mysql_query ( "SELECT SUM(prix) AS TOTALBRUTMOATELIER FROM tinterventions WHERE intervention='MO ATELIER';" ) or die ( mysql_error() ) ;
// TOTAL BRUT AUTRES
	$Resultat17 = mysql_query ( "SELECT SUM(prix) AS TOTALBRUTAUTRES FROM tinterventions WHERE intervention='AUTRES';" ) or die ( mysql_error() ) ;

$r1 = mysql_fetch_array($Resultat1);
$r2 = mysql_fetch_array($Resultat2);
$r3 = mysql_fetch_array($Resultat3);
$r4 = mysql_fetch_array($Resultat4);
$r5 = mysql_fetch_array($Resultat5);
$r6 = mysql_fetch_array($Resultat6);
$r7 = mysql_fetch_array($Resultat7);
$r8 = mysql_fetch_array($Resultat8);
$r9 = mysql_fetch_array($Resultat9);
$r10 = mysql_fetch_array($Resultat10);
$r12 = mysql_fetch_array($Resultat12);
$r13 = mysql_fetch_array($Resultat13);
$r14 = mysql_fetch_array($Resultat14);
$r15 = mysql_fetch_array($Resultat15);
$r16 = mysql_fetch_array($Resultat16);
$r17 = mysql_fetch_array($Resultat17);

// Affiche du nom à côté de l'intervention concernée
	$client = mysql_query ( "SELECT tclients.codeClient, tclients.nom FROM tclients, tinterventions WHERE tclients.codeClient=tinterventions.codeClient ;" ) or die ( mysql_error() ) ;
	$req = mysql_fetch_array($client) ;
	$clientid = $req['codeClient'];

?>
<b>NB interventions total</b> = <?php echo $r2['NBINTERVENTIONS']; ?> | NB INTERV. <b>GILLES</b> = <?php echo $r8['GILLES']; ?> | NB INTERV. <b>GILLES ET NICOLAS</b> = <?php echo $r12['GILLESNICOLAS']; ?> | NB INTERV. <b>NICOLAS</b> = <?php echo $r9['NICOLAS']; ?>  | NB INTERV. <b>JULIEN</b> = <?php echo $r10['JULIEN']; ?><br />
NETTOYAGE = <?php echo $r6['FORMATAGE']; ?> <br />
FORMATAGE = <?php echo $r7['NETTOYAGE']; ?> <br />
MO ATELIER = <?php echo $r3['MOATELIER']; ?> <br />
<br />
NB PC <b>FIXE</b> = <b><?php echo $r4['PCFIXE']; ?></b><br />
NB PC <b>PORTABLE</b> = <b><?php echo $r5['PCPORTABLE']; ?></b><br />
<br />
NB <b>CLIENTS</b> = <b><?php echo $r1['CLIENTS']; ?></b><br />
<br />
TOTAL BRUT <b>NETTOYAGE</b> = <b><?php echo $r14['TOTALBRUTNETTOYAGE']; ?> €</b></br />
TOTAL BRUT <b>FORMATAGE</b> = <b><?php echo $r15['TOTALBRUTFORMATAGE']; ?> €</b></br />
TOTAL BRUT <b>MO ATELIER</b> = <b><?php echo $r16['TOTALBRUTMOATELIER']; ?> €</b></br />
TOTAL BRUT <b>AUTRES</b> = <b><?php echo $r17['TOTALBRUTAUTRES']; ?> €</b></br />
<b>TOTAL BRUT</b> DES PRESTATIONS = <b><?php echo $r13['TOTALBRUT']; ?> €</b></br />
