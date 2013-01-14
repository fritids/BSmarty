<?php


function mysqltoxml () {
	
	/*-----------------------------------------------------------------*/
	/*LES VARIABLES A PERMETTANT DE SE CONNECTER A LA BASE
	/*-----------------------------------------------------------------*/
	
	// SERVEUR SQL
	$sql_serveur="localhost";
	
	// LOGIN SQL
	$sql_user="info_mtblanc";
	
	// MOT DE PASSE SQL
	$sql_passwd="rzvTxGC6";
	
	// NOM DE LA BASE DE DONNEES
	$sql_bdd="montblancpatho";
	
	// SI L'UTILISATEUR ENTRE UN LOGIN OU MOT DE PASSE ERRONNE, DIRECTION VERS LA PAGE :
	$url_erreur="erreur.htm";
	
	// CONNECTION A LA BASE
	$db_link = mysql_connect($sql_serveur,$sql_user,$sql_passwd);
	$sql_bdd = mysql_select_db($sql_bdd,$db_link);
	
	/*-----------------------------------------------------------------*/
	/*LES VARIABLES A PERMETTANT DE CREER LE FICHIER XML
	/*-----------------------------------------------------------------*/
	
	$chemin = "/var/www/vhosts/mbpath.com/httpdocs/XML_Infologic/";
	$numerolabo = "010";
	// Fin des parametre a modifier
	
	
	$day = date('ymd', time() - 3600 * 24);
	$xmlfile = "DRWTOD_".$numerolabo."_".$day.".xml";
	$xml = $chemin.$xmlfile;
	
	
	// On selectionne les infos labo pour la premiere partie du XML
	$sql_drw_labo = "SELECT * FROM `drw_labo` WHERE `drw_labo`.numerolabo = '$numerolabo' LIMIT 1";
	$drw_labo = mysql_query($sql_drw_labo, $db_link) or die(mysql_error());
	$row_drw_labo = mysql_fetch_assoc($drw_labo);

	// Selection de tous les dossiers a mettre en XML
	//$sql_drw = 'SELECT * FROM `drw` WHERE `dattransaction` !=\'\' ORDER BY `drw`.`identfacture` ASC';
	$dday = $day = date('Ymd', time() - 3600 * 24);
	$sql_drw = "SELECT * FROM `drw-bak` WHERE `dattransaction` = $dday ORDER BY `drw-bak`.`identfacture` ASC";
	$drw = mysql_query($sql_drw, $db_link) or die(mysql_error());
	$row_drw = mysql_fetch_assoc($drw);
	$num_rows = mysql_num_rows($drw);
	
	// Si il y a des enregistrements on cree le fichier
	if ($num_rows != 0) {
		/* creation du fichier du jour */
		if (!is_file($xml)) {
			$file =1;
		} else $file = 0;
		if ($file) {
			$fp = fopen ($xml,"a");
			fwrite($fp, "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>\n<diaregweb_todiamic>\n</diaregweb_todiamic>");
			fclose($fp);
		}
	
	
		/* Chargement du fichier XML */
		$dom = new DomDocument();
		//$dom->load($xmlfile);
		$dom->load($xml);
	
		if ($file) {
	
			/* creation diaregweb_toweb->diaregwebversion */
			$nouveauDiaregwebversion = $dom->createElement("diaregwebversion");
			$idLabo = $dom->createTextNode(utf8_encode($row_drw_labo['id_drw_labo']));
	
			$nouveauDiaregwebversion->appendChild($idLabo);
			$diaregweb_toweb = $dom->getElementsByTagName("diaregweb_todiamic")->item(0);
			$diaregweb_toweb->appendChild($nouveauDiaregwebversion);
			/* FIN creation du noeud en XML */
		
			/* creation diaregweb_toweb->identlabodiaregweb */
			$nouveauIdentlabodiaregweb = $dom->createElement("identlabodiaregweb");
			$diaregweb_toweb->appendChild($nouveauIdentlabodiaregweb);
			/* FIN creation du noeud en XML */
		
			/* creation diaregweb_toweb->identfichier */
			$nouveauIdentfichier = $dom->createElement("identfichier");
			$diaregweb_toweb->appendChild($nouveauIdentfichier);
			/* FIN creation du noeud en XML */
	
			/* creation diaregweb_toweb->dossierfacts */
			//$nouveauDossierfacts = $dom->createElement("dossierfacts");
			$nouveauDossierfacts = $dom->createElement("dossierreglements");
			$diaregweb_toweb->appendChild($nouveauDossierfacts);
			/* FIN creation du noeud en XML */
	
	
			/* creation diaregweb_toweb->identlabodiaregweb->numerolabo */
			$nouveauNumerolabo = $dom->createElement("numerolabo");
			$numerolabo = $dom->createTextNode(utf8_encode($row_drw_labo['numerolabo']));
			$nouveauNumerolabo->appendChild($numerolabo);
			$identlabodiaregweb = $dom->getElementsByTagName("identlabodiaregweb")->item(0);
			$identlabodiaregweb->appendChild($nouveauNumerolabo);
			/* FIN creation du noeud en XML */
	
			/* creation diaregweb_toweb->identlabodiaregweb->nomlabo */
			$nouveauNomlabo = $dom->createElement("nomlabo");
			$nomlabo = $dom->createTextNode(utf8_encode($row_drw_labo['nomlabo']));
			$nouveauNomlabo->appendChild($nomlabo);
			$identlabodiaregweb->appendChild($nouveauNomlabo);
			/* FIN creation du noeud en XML */
	
			/* creation diaregweb_toweb->identfichier->numerofichier */
			$nouveauNumerofichier = $dom->createElement("numerofichier");
			$numerofichier = $dom->createTextNode(utf8_encode($row_drw_labo['numerofichier']));
			$nouveauNumerofichier->appendChild($numerofichier);
			$identfichier = $dom->getElementsByTagName("identfichier")->item(0);
			$identfichier->appendChild($nouveauNumerofichier);
		
			$nouveauDatefichier = $dom->createElement("datefichier");
			$datefichier = $dom->createTextNode(utf8_encode($row_drw_labo['datefichier']));
			$nouveauDatefichier->appendChild($datefichier);
			$identfichier->appendChild($nouveauDatefichier);
		
			$nouveauHeurefichier = $dom->createElement("heurefichier");
			$heurefichier = $dom->createTextNode(utf8_encode($row_drw_labo['heurefichier']));
			$nouveauHeurefichier->appendChild($heurefichier);
			$identfichier->appendChild($nouveauHeurefichier);
			/* FIN creation du noeud en XML */
	
		}
	
		if ($num_rows != 0) {
		
			do {
		
				$clepatient = utf8_encode($row_drw['clepatient']);
				$nom = utf8_encode($row_drw['nom']);
				$prenom = utf8_encode($row_drw['prenom']);
				$datnaissance = utf8_encode($row_drw['datnaissance']);
				$patronyme = utf8_encode($row_drw['patronyme']);
				$adresse1 = utf8_encode($row_drw['adresse1']);
				$adresse2 = utf8_encode($row_drw['adresse2']);
				$adresse3 = utf8_encode($row_drw['adresse3']);
				$codpostal = utf8_encode($row_drw['codpostal']);
				$ville = utf8_encode($row_drw['ville']);
				$nusecu = utf8_encode($row_drw['nusecu']);
				$clenusecu = utf8_encode($row_drw['clenusecu']);
				$telephone = utf8_encode($row_drw['telephone']);
				$telportable = utf8_encode($row_drw['telportable']);
				$email = utf8_encode($row_drw['email']);
				$typidtfacture = utf8_encode($row_drw['typidtfacture']);
				$identfacture = utf8_encode($row_drw['identfacture']);
				$mttransaction = utf8_encode($row_drw['mttransaction']);
				$dattransaction = utf8_encode($row_drw['dattransaction']);
				$heuretransaction = utf8_encode($row_drw['heuretransaction']);
				$reftransaction = utf8_encode($row_drw['reftransaction']);
				$certiftransaction = utf8_encode($row_drw['certiftransaction']);
			
				
				$library = $dom->documentElement;
				
				$dossierfacts = $dom->getElementsByTagName("dossierreglements")->item(0);
				$dossierfact = $dom->createElement('dossierreglement');
			
				$book = $dom->createElement('patient');
				$prop = $dom->createElement('clepatient',$clepatient);
				$book->appendChild($prop);
				$prop = $dom->createElement('nom',$nom);
				$book->appendChild($prop);
				$prop = $dom->createElement('prenom',$prenom);
				$book->appendChild($prop);
				$prop = $dom->createElement('datnaissance',$datnaissance);
				$book->appendChild($prop);
				$prop = $dom->createElement('patronyme',$patronyme);
				$book->appendChild($prop);
				$prop = $dom->createElement('adresse1',$adresse1);
				$book->appendChild($prop);
				$prop = $dom->createElement('adresse2',$adresse2);
				$book->appendChild($prop);
				$prop = $dom->createElement('adresse3',$adresse3);
				$book->appendChild($prop);
				$prop = $dom->createElement('codpostal',$codpostal);
				$book->appendChild($prop);
				$prop = $dom->createElement('ville',$ville);
				$book->appendChild($prop);
				$prop = $dom->createElement('nusecu',$nusecu);
				$book->appendChild($prop);
				$prop = $dom->createElement('clenusecu',$clenusecu);
				$book->appendChild($prop);
				$prop = $dom->createElement('telephone',$telephone);
				$book->appendChild($prop);
				$prop = $dom->createElement('telportable',$telportable);
				$book->appendChild($prop);
				$prop = $dom->createElement('email',$email);
				$book->appendChild($prop);
				
				$dossierfact->appendChild($book);
				
				$book = $dom->createElement('reglement');
				$prop = $dom->createElement('typidtfacture',$typidtfacture);
				$book->appendChild($prop);
				$prop = $dom->createElement('identfacture',$identfacture);
				$book->appendChild($prop);
				$prop = $dom->createElement('mttransaction',$mttransaction);
				$book->appendChild($prop);
				$prop = $dom->createElement('dattransaction',$dattransaction);
				$book->appendChild($prop);
				$prop = $dom->createElement('heuretransaction',$heuretransaction);
				$book->appendChild($prop);
				$prop = $dom->createElement('reftransaction',$reftransaction);
				$book->appendChild($prop);
				$prop = $dom->createElement('certiftransaction',$certiftransaction);
				$book->appendChild($prop);
				
				$dossierfact->appendChild($book);
				$dossierfacts->appendChild($dossierfact);
				//$library->appendChild($dossierfact);
				
				$dom->save($xml);
				
			} while ($row_drw = mysql_fetch_assoc($drw));
			
		} else $dom->save($xml);
	}
}

mysqltoxml ();

?>