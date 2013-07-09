<hr /> <br />
	<?php
	// Nombre de clients
		$Resultat1 = mysql_query ( "SELECT count(*) AS CLIENTS FROM tclients ;" ) or die ( mysql_error() ) ;
	//Nombre d'interventions
		$Resultat2 = mysql_query ( "SELECT count(*) AS NBINTERVENTIONS FROM tinterventions ;" ) or die ( mysql_error() ) ;
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
	//Nombre INTERVENTIONS SOLENE
		$Resultat11 = mysql_query ( "SELECT COUNT(technicien) AS SOLENE FROM tinterventions WHERE technicien='SOLENE' ;" ) or die ( mysql_error() ) ;
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
	$r11 = mysql_fetch_array($Resultat11);
	$r12 = mysql_fetch_array($Resultat12);
	$r13 = mysql_fetch_array($Resultat13);
	$r14 = mysql_fetch_array($Resultat14);
	$r15 = mysql_fetch_array($Resultat15);
	$r16 = mysql_fetch_array($Resultat16);
	$r17 = mysql_fetch_array($Resultat17);

// Affiche du nom à côté de l'intervention concernée
	$client = "SELECT tclients.codeClient, tclients.nom FROM tclients, tinterventions WHERE tclients.codeClient=tinterventions.codeClient ;" ;
	$Resultat100 = mysql_query ( $client )  or  die ( mysql_error() ) ;
	$ligne0 = mysql_fetch_array($Resultat100) ;
	$clientid = $ligne0['codeClient'];

	// DATE
// "SELECT * FROM tinterventions WHERE dateInterv BETWEEN '01/04/2013' AND '10/04/2013'"

	// Afficher les clients réccurent
//SELECT * FROM (SELECT codeIntervention,codeClient,intervention,dateInterv FROM tinterventions WHERE codeClient='$clientid') client

?>
<table align='center' BORDER='1' rules='all'>
	<TR><TD align='center'>	<H3>TYPE STAT</H3> </TD><TD align='center'> <H3>VALEUR</H3> </TD></TR>
	<tr><td>NB <b>CLIENTS</b> </td> <td align='center'><b><?php echo $r1['CLIENTS']; ?></b></td></tr>
	<tr><td><b>INTERVENTIONS</b> </td> <td align='center'><b><?php echo $r2['NBINTERVENTIONS']; ?></b></td></tr>
	<tr><td height='20'> </td> <td></td> </tr>
	<tr><td><b>NETTOYAGE</b> </td> <td align='center'><b><?php echo $r6['FORMATAGE']; ?></b></td></tr>
	<tr><td><b>FORMATAGE</b> </td> <td align='center'><b><?php echo $r7['NETTOYAGE']; ?></b></td></tr>
	<tr><td><b>MO ATELIER</b> </td> <td align='center'><b><?php echo $r3['MOATELIER']; ?></b></td></tr>
	<tr><td height='20'> </td> <td></td> </tr>
	<tr><td>NB PC <b>FIXE</b> </td> <td align='center'><b><?php echo $r4['PCFIXE']; ?></b></td></tr>
	<tr><td>NB PC <b>PORTABLE</b></td> <td align='center'><b><?php echo $r5['PCPORTABLE']; ?></b></td></tr>
	<tr><td height='20'> </td> <td></td> </tr>
	<tr><td>NB INTERV. <b>GILLES</b></td> <td align='center'><b><?php echo $r8['GILLES']; ?></b></td></tr>
	<tr><td>NB INTERV. <b>NICOLAS</b></td> <td align='center'><b><?php echo $r9['NICOLAS']; ?></b></td></tr>
	<tr><td>NB INTERV. <b>JULIEN</b></td> <td align='center'><b><?php echo $r10['JULIEN']; ?></b></td></tr>
	<tr><td>NB INTERV. <b>SOLENE</b></td> <td align='center'><b><?php echo $r11['SOLENE']; ?></b></td></tr>
	<tr><td>NB INTERV. <b>GILLES ET NICOLAS</b></td> <td align='center'><b><?php echo $r12['GILLESNICOLAS']; ?></b></td></tr>
	<tr><td height='20'> </td> <td></td> </tr>
	<tr><td><b>TOTAL BRUT</b><br />DES PRESTATIONS</td> <td align='center'><b><?php echo $r13['TOTALBRUT']; ?> €</b></td></tr>
	<tr><td>TOTAL BRUT<br /><b>NETTOYAGE</b></td> <td align='center'><b><?php echo $r14['TOTALBRUTNETTOYAGE']; ?> €</b></td></tr>
	<tr><td>TOTAL BRUT<br /><b>FORMATAGE</b></td> <td align='center'><b><?php echo $r15['TOTALBRUTFORMATAGE']; ?> €</b></td></tr>
	<tr><td>TOTAL BRUT<br /><b>MO ATELIER</b></td> <td align='center'><b><?php echo $r16['TOTALBRUTMOATELIER']; ?> €</b></td></tr>
	<tr><td>TOTAL BRUT<br /><b>AUTRES</b></td> <td align='center'><b><?php echo $r17['TOTALBRUTAUTRES']; ?> €</b></td></tr>
</table>
