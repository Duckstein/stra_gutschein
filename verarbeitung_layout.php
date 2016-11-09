<?php

/* --------------------------------- *\
	
	verarbeitung layout
	
	v1.0	2015-10-28 | jd

\* --------------------------------- */




/* checkups
----------- */

// lower email-adress-input
$email=strtolower($email);

// plz prüfen
if ($LKZ=="D"){

	if (!preg_match("/^\d{5}$/",$plz)){
		
		$fehler.= "Sie haben keine korrekte PLZ eingegeben.<p>";
		$plz="";
		$_SESSION["plz"]=$plz;
		
	}
	
}




/* final (oldschool) check
-------------------------- */

if ($vorname=="" OR $name=="" OR $strasse=="" OR $ort=="" OR $plz=="" OR $LKZ=="" OR $anrede=="" OR $hsnr==""){
	
	$fehler.="Es sind nicht alle Felder ausgef&uuml;llt!<br><br><u>Es fehlt:</u><br> ";
	
	if (!$anrede) $fehler.="Die Anrede!<br>";
	if (!$vorname) $fehler.="Der <b>Vorname</b>!<br> ";
	if (!$name) $fehler.="Der <b>Name</b>!<br> ";
	if (!$strasse) $fehler.="Die <b>Strasse</b>!<br> ";
	if (!$hsnr) $fehler.="Die <b>Hausnummer</b>!<br> ";
	if (!$plz) $fehler.="Die <b>PLZ</b>!<br> ";
	if (!$ort) $fehler.="Der <b>Ort</b>!<br> ";
	if (!$LKZ) $fehler.="Das <b>Land</b>!<br> ";
	
}else if (ereg("[a-z_A-Z]",$telefon)){
	
	$fehler= "Das ist keine richtige Telefonnummer!<br>";
	  
}else{
	
	if (!$fehler){
		
		/* --------------------------------- *\
		
			erzeuge datensatz
			
		\* --------------------------------- */
		
		
		
		
		// create date'n'time
		date_default_timezone_set("Europe/Berlin");
		$timestamp = time();
		$datum = date("d.m.Y",$timestamp);
		$uhrzeit = date("H:i",$timestamp);
		$jahr = date("Y",$timestamp);
		
		
		
		
		/* set gutschein nummer
		----------------------- */
		
		// fetch latest datensatz
		$sql = "SELECT * FROM STRA_gutscheine ORDER BY id DESC LIMIT 1";
				
		$resultat = mysql_query($sql,$db);
		
		$row = mysql_fetch_array($resultat);
				
		$id =		$row['id'];
		$jahr_pre =	$row['jahr'];
		$lfd =		$row['lfd'];
		
		// compare today year w db entry year
		if($jahr > $jahr_pre){
			
			// if it's a "new" year, set $lfd to 1
			$lfd = "1";
			
		}else{
			
			// else count up $lfd
			$lfd++;
			
		}
		
		// transform $lfd (i.e. 23) into a three digit number (023)
		$digitnummer = str_pad($lfd, 3, '0', STR_PAD_LEFT);
		
		// create voucher-nr
		$voucher = "online-014-$jahr-$digitnummer";
		
		// write to db
		$sql = "INSERT INTO STRA_gutscheine (id,jahr,lfd,nummer,anrede,name,vorname,strasse,hsnr,plz,ort,land,telefon,fax,email,wert,name_besch,nachricht,datum,zeit) VALUES ('','$jahr','$lfd','$voucher','$anrede','$name','$vorname','$strasse','$hsnr','$plz','$ort','$LKZ','$telefon','$fax','$email','$wert','$beschenkt','$wunsch','$datum','$zeit');";
		$resultat = mysql_query($sql,$db);
		
		
		
		
		/* --------------------------------- *\
		
			email routines
		
		\* --------------------------------- */

		/* internal mail
		---------------- */
		
		$content_intern="Folgende Angaben zur Gutscheinbestellung wurden am $datum eingegeben:\n\n";
		$content_intern.="Der Gutschein wurde angefordert von\n"; 
		$content_intern.="$anrede $vorname $name\n";
		$content_intern.="$strasse $hsnr\n";
		$content_intern.="$plz $ort\n";
		$content_intern.="Länderkürzel: $LKZ\n";
		$content_intern.="Telefon: $telefon\nFax: $fax\nE-Mail: $email\n\n";
		$content_intern.="Gutschein-Nummer: $nummer\n\n"; 
		
		$content_intern.="Name des Beschenkten: $beschenkt\n\n";
		
		$content_intern.="Gutscheinwert in Euro: $wert\n\n";
		
		if ($wunsch!=""){
			
			$content_intern.="$anrede $vorname $name hat folgende Nachricht hinzugefügt:\n $wunsch \n\n";
			
		}
		
		#$empfaenger="gutschein.strandhotel@morada.de";
		$empfaenger="internet@skan-tours.de";

		$daten=$content_intern;
		
		$betreff="Gutscheine Strandhotel";
		$von = "From:$email";
		$headers=$von."\n"
		. "Content-Type: text/plain; charset=utf-8\n"
		. "MIME-Version: 1.0\n"
		. "Content-Transfer-Encoding: quoted-printable\n";

		mail("$empfaenger","$betreff","$daten","$headers");
		
		
		
		
		/* external mail
		---------------- */
		
		if($anrede=='Frau'){$ansprache="geehrte Frau";}
		if($anrede=='Herr'){$ansprache="geehrter Herr";}
		
		$inhalt3= "Für Fragen zu unseren Angeboten stehen wir Ihnen gerne unter der\nkostenlosen Kundenservice-Telefonnummer 0 800/123 32 32\nvon Montag bis Freitag in der Zeit\nvon 08.00 - 22.00 Uhr\nund Samstag und Sonntag\nvon 09.00 - 22.00 Uhr zur Verfügung.\n\n";
		$inhalt5= "Danke für Ihr Interesse an unseren Produkten.\n\nIhr Team des MORADA STRANDHOTEL OSTSEEBAD KÜHLUNGSBORN.\n\n";
		
		$fusszeile= "--------------------\n\nMORADA STRANDHOTEL KÜHLUNGSBORN\n";
		$fusszeile.= "E-Mail: strandhotel@morada.de\n";
		$fusszeile.= "Homepage: http://www.strandhotel-kuehlungsborn.de\n";
		$fusszeile.= "freecall: 00 800/11 23 11 11\n";
		$fusszeile.= "Telefon: 0 53 74/91 91-2121\n";
		$fusszeile.= "Telefax: 0 53 74/91 91-2299\n\n";
		$fusszeile.= "MORADA HOTELS & RESORTS\n";
		$fusszeile.= "ein Unternehmensbereich der SKAN-TOURS Touristik International GmbH\n";
		$fusszeile.= "Geschäftsführer: Ilona Werner, Frank Werner\n";
		$fusszeile.= "Handelsregister: Hildesheim HRB 100134\n";
		
		$daten= $content_exter.$inhalt3.$inhalt5.$fusszeile;
		
		$subject = "Ihre MORADA STRANDHOTEL Gutscheinbestellung: $nummer";
		$subject = "=?utf-8?b?".base64_encode($subject)."?=";
		$von = "From:strandhotel@morada.de";
					
		// create a boundary for the email
		$boundary = uniqid('np');
					
		// headers
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= $von."\r\n";
		$headers .= "To: ".$email."\r\n";
		$headers .= "Content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";
	
		// content body
		$message = "This is a MIME encoded message.";
		$message .= "\r\n\r\n--" . $boundary . "\r\n";
		$message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";
	
		// plain text body
		$message .= "Sehr $ansprache $name,\n\nvielen Dank für Ihre Gutscheinbestellung.\n\nBitte überweisen Sie den Gutscheinbetrag:\n\n Euro $wert\n\n unter Angabe der Gutscheinnummer: $nummer\n auf folgendes Konto:\n\n MORADA STRANDHOTEL KÜHLUNGSBORN GmbH & Co. KG\n Sparkasse Gifhorn-Wolfsburg\n BLZ 269 513 11\n Konto-Nr.: 11 081 965\n\nIBAN DE53 2695 1311 0011 0819 65\nBIC NOLADE21GFW\n\nSobald der Betrag bei uns eingegangen ist, schicken wir den Gutschein an Ihre Adresse:\n$anrede\n$vorname $name\n$strasse $hsnr\n$plz $ort2\n\nName des Beschenkten: $beschenkt\n\nFolgende Nachricht wurde hinzugefügt:\n $wunsch \n\nBitte beachten Sie, dass der Gutschein ausschließlich im\nMORADA STRANDHOTEL OSTSEEBAD KÜHLUNGSBORN\nRudolf-Breitscheid-Straße 19\n18225 Ostseebad Kühlungsborn\neinzulösen ist.\n\n";
		$message .= "\r\n\r\n--" . $boundary . "\r\n";
		$message .= "Content-type: text/html;charset=utf-8\r\n\r\n";
	
		// html body
		include($include_pfad."templates/email_head.php");
		$message .= "
<h2>Sehr $ansprache $name,</h2>
<p>vielen Dank für Ihre Gutscheinbestellung.</p>
<p>Bitte überweisen Sie den Gutscheinbetrag: <b>&euro; $wert</b><br>
unter Angabe der Gutscheinnummer: <b>$nummer</b><br>
auf folgendes Konto:</p>
<p>MORADA STRANDHOTEL KÜHLUNGSBORN GmbH & Co. KG<br>
Sparkasse Gifhorn-Wolfsburg<br>
BLZ 269 513 11<br>
Konto-Nr.: 11 081 965<br>
&nbsp;<br>
IBAN DE53 2695 1311 0011 0819 65<br>
BIC NOLADE21GFW</p>
<hr />
<p>Sobald der Betrag bei uns eingegangen ist, schicken wir den Gutschein an Ihre Adresse:<br>
$anrede $vorname $name<br>
$strasse $hsnr<br>
$LKZ $plz $ort2<br>
&nbsp;<br>
Name des Beschenkten: $beschenkt<br>
&nbsp;<br>
Folgende Nachricht wurde hinzugefügt:<br>
$wunsch</p>
<hr />
<p><b>Bitte beachten Sie, dass der Gutschein ausschließlich im MORADA STRANDHOTEL OSTSEEBAD KÜHLUNGSBORN, Rudolf-Breitscheid-Straße 19, 18225 Ostseebad Kühlungsborn einzulösen ist.</p>

<hr />

				</td>
			</tr>
		</table>
		<table width=\"580\" class=\"deviceWidth\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"#ffffff\" style=\"border-collapse: collapse;\">
			<tr>
				<td bgcolor=\"#ffffff\" style=\"text-align: left; font-size: 14px; color: #363636; line-height: 1em; font-family: Arial, Helvetica, sans-serif; padding: 10px 8px;\" align=\"center\">
                    
                    	<p>Danke für Ihr Interesse an unseren Produkten.<br>
						<b>Ihr Team des MORADA STRANDHOTEL OSTSEEBAD KÜHLUNGSBORN.</b></p>
                    
				</td>
			</tr>
		</table>

		<table width=\"580\" class=\"deviceWidth\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"#eeeeed\" style=\"border-bottom-width:thick;border-bottom-color:#CCA55F;border-bottom-style:solid;\">
			<tr>
				<td style=\"font-size: 16px; color: #333333; font-weight: normal; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 22px; vertical-align: top; padding:10px 8px 10px 8px\" bgcolor=\"#eeeeed\">
		
					<table>
						<tr>
							<td valign=\"top\" style=\"padding:0 10px 10px 0\">
				
								<img  src=\"http://www.seniorenreisen.de/img/layout/mailing/icon_phone.gif\" alt=\"Kostenlose Kundenservice-Telefonnummer\" border=\"0\" align=\"left\" />
					
							</td>
							<td valign=\"middle\" style=\"padding:0 10px 10px 0;color: #272727; font-size: 16px; color: #272727; font-weight: bold; font-family:Arial, Helvetica, sans-serif;\">
				
								Kostenlose Kundenservice-Telefonnummer
					
							</td>
						</tr>
					</table>

					<p>Für Fragen zu unseren Angeboten stehen wir Ihnen gerne unter der kostenlosen Kundenservice-Telefonnummer</p>
					<p align=\"center\" style=\"font-size:33px;\"><strong>0 800/123 32 32</strong></p>
					<p>von Montag bis Freitag in der Zeit von 08.00 - 22.00 Uhr und Samstag und Sonntag von 09.00 - 22.00 Uhr zur Verfügung.</p>
		
				</td>
			</tr>             
		</table>

		";
		include($include_pfad."templates/email_foot.php");
		$message .= "\r\n\r\n--" . $boundary . "--";
	
		// invoke the PHP mail function
		if (mail($email, $subject, $message, $headers)){
			$mailversand="true";
		}else{
			$mailversand="false";
		}
		
		
		
		/* --------------------------------- *\
		 
		 	render site
			
		\* --------------------------------- */
		
		$content.= '
			<h1 class="page-header display moradared text-uppercase">Vielen Dank!</h1>
			<p class="lead">Wir haben Ihre Anfrage erhalten und werden Ihnen in Kürze ein auf Sie abgestimmtes Angebot zukommen lassen.</p>';
			
			if ($mailversand=="true"){
				
				$content.='
			<div class="alert alert-success" role="alert">
				<i class="fa fa-check"></i> Eine E-Mail mit Ihren angegebenen Daten wurde an <b>' .$email. '</b> versendet.
			</div>';
			
			}
			
			if ($mailversand=="false"){

				$content.='
			<div class="alert alert-danger" role="alert">
				<i class="fa fa-exclamation-triangle"></i> <b>Es ist ein Fehler aufgetreten!</b><br>
				Es konnte keine E-Mail an die angegebene Adresse <b>' .$email. '</b> versendet werden.
				<h5>Bitte überprüfen Sie Ihre Angaben.</h5>
				
				<form method="post" action="http://' .$_SERVER['SERVER_NAME']. '/service/gutscheine.php" target="_self">
				
					<input type="hidden" name="anrede" value="' .$anrede. '">
					<input type="hidden" name="vorname" value="' .$vorname. '">
					<input type="hidden" name="name" value="' .$name. '">
					<input type="hidden" name="strasse" value="' .$strasse. '">
					<input type="hidden" name="hsnr" value="' .$hsnr. '">
					<input type="hidden" name="plz" value="' .$plz. '">
					<input type="hidden" name="ort" value="' .$ort. '">
					<input type="hidden" name="LKZ" value="' .$LKZ. '">
					<input type="hidden" name="telefon" value="' .$telefon. '">
					<input type="hidden" name="MobilTel" value="' .$MobilTel. '">
					<input type="hidden" name="fax" value="' .$fax. '">
					<input type="hidden" name="email" value="' .$email. '">
					<input type="hidden" name="wunsch" value="' .$wunsch. '">
					
					<button type="submit" class="btn btn-default"><i class="fa fa-chevron-left"></i> Zurück zumm Formular</button>
				
				</form>
			</div>';
			
			}

	}else{
		
		$content.='
			<div class="alert alert-danger" role="alert">
				<i class="fa fa-exclamation-triangle"></i> <b>Es ist ein Fehler aufgetreten!</b>
			</div>';

	}
	
}

if ($fehler){
	
	$content.= '
		<h3>Fehler bei der Eingabe:</h3>
		<div class="warnung">
			<p><b>' .$fehler. '</b></p>
			
			<form method="post" action="http://' .$_SERVER['SERVER_NAME']. '/service/gutscheine.php" target="_self">
			
				<button type="submit" name="backi" value="&lt;&lt;&lt; zurück">&laquo; zurück zum Formular</button>
				<input type="hidden" name="wunsch" value="' .$wunsch. '">
				<input type="hidden" name="anrede" value="' .$anrede. '">
				<input type="hidden" name="vorname" value="' .$vorname. '">
				<input type="hidden" name="name" value="' .$name. '">
				<input type="hidden" name="strasse" value="' .$strasse. '">
				<input type="hidden" name="hsnr" value="' .$hsnr. '">
				<input type="hidden" name="plz" value="' .$plz. '">
				<input type="hidden" name="ort" value="' .$ort. '">
				<input type="hidden" name="LKZ" value="' .$LKZ. '">
				<input type="hidden" name="telefon" value="' .$telefon. '">
				<input type="hidden" name="MobilTel" value="' .$MobilTel. '">
				<input type="hidden" name="fax" value="' .$fax. '">
				<input type="hidden" name="email" value="' .$email. '">
			
			</form>
			
		</div>';

}

?>