<?php

/* --------------------------------- *\
	
	gutscheine anfragen layout
	
	v1.0	2015-10-27 | jd
	
			2016-11-10 | jd
			integr char counter in 
			textarea #eindruck 

\* --------------------------------- */




/* render site
-------------- */

$content.= '
				<form method="post" action="http://' .$_SERVER['SERVER_NAME']. '/service/gutscheine_pruefen.php" target="_self" name="gutscheinbestellung" class="form-horizontal">
				
					<legend><span class="badge">1.</span> Gutschein Daten</legend>
					<div class="form-group form-group-lg">
						<label for="wert" class="col-sm-4 control-label">Gutscheinwert *</label>
						<div class="col-sm-4">
							<div class="input-group input-group-lg">
								<span class="input-group-addon">&euro;</span>
								<input type="text" name="wert" value="' .$wert. '" placeholder="z.B.: 100,00" class="form-control" id="wert" required="">
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="beschenkt" class="col-sm-4 control-label">Name des/der Beschenkten:</label>
						<div class="col-sm-6">
							<input type="text" name="beschenkt" value="' .$beschenkt. '" class="form-control" id="beschenkt">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-4 control-label" for="eindruck">Persönliche Nachricht, die auf dem Gutschein erscheinen soll (optional):</label>
						<div class="col-md-6">                     
							<textarea class="form-control" name="eindruck" rows="4" id="eindruck">' .$eindruck. '</textarea>
							<span id="helpBlock" class="help-block">(Noch <span id="count300"></span> Zeichen übrig)</span>
						</div>
					</div>
					
					<legend><span class="badge">2.</span> Ihre persönlichen Daten</legend>
					
					<div class="form-group">
						<label class="col-md-4 control-label" for="radios">Anrede *</label>
						<div class="col-md-4"> 
							<label class="radio-inline" for="frau">
								<input id="frau" type="radio" name="anrede" value="Frau"';
								if ($anrede=="Frau") $content.= " checked";
								$content.= '>
								Frau
							</label> 
							<label class="radio-inline" for="herr">
								<input id="herr" type="radio" name="anrede" value="Herr"';
								if ($anrede=="Herr") $content.= ' checked';
								$content.=' required="">
								Herr
							</label> 
						</div>
					</div>
					
					<div class="form-group">
						<label for="vorname" class="col-sm-4 control-label">Vorname *</label>
						<div class="col-sm-6">
							<input type="text" name="vorname" value="' .$vorname. '" class="form-control" id="vorname" placeholder="Vorname" required="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="name" class="col-sm-4 control-label">Name *</label>
						<div class="col-sm-6">
							<input type="text" name="name" value="' .$name. '" class="form-control" id="name" placeholder="Nachname" required="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="strasse" class="col-sm-4 control-label">Strasse, Nr. *</label>
						<div class="col-sm-4">
							<input type="text" name="strasse" value="' .$strasse. '" class="form-control" id="strasse" placeholder="Strasse" required="">
						</div>
						<div class="col-sm-2">
							<input type="text" name="hsnr" value="' .$hsnr. '" class="form-control" id="hsnr" placeholder="Nr" required="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="plzort" class="col-sm-4 control-label">PLZ, Ort *</label>
						<div class="col-sm-2">
							<input type="text" name="plz" value="' .$plz. '" class="form-control" id="plzort" placeholder="PLZ" required="">
						</div>
						<div class="col-sm-4">
							<input type="text" name="ort" value="' .$ort. '" class="form-control" id="ort" placeholder="Ort" required="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="LKZ" class="col-sm-4 control-label">Land *</label>
						<div class="col-sm-6">
							<select id="LKZ" name="LKZ" class="form-control">';
							
								$content.= "<option value=\"B\" ";
								if ($LKZ=="B") $content.= "selected";
								$content.= ">Belgien</option>";
								$content.= "<option value=\"BIH\" ";
								if ($LKZ=="BIH") $content.= "selected";
								$content.= ">Bosnien-Herzegowina</option>";
								$content.= "<option value=\"DK\" ";
								if ($LKZ=="DK") $content.= "selected";
								$content.= ">D&auml;nemark</option>";
								$content.= "<option value=\"D\" ";
								if ($LKZ=="D" || $LKZ=="") $content.= "selected";
								$content.= ">Deutschland</option>";
								$content.= "<option value=\"EST\" ";
								if ($LKZ=="EST") $content.= "selected";
								$content.= ">Estland</option>";
								$content.= "<option value=\"FIN\" ";
								if ($LKZ=="FIN") $content.= "selected";
								$content.= ">Finnland</option>";
								$content.= "<option value=\"F\" ";
								if ($LKZ=="F") $content.= "selected";
								$content.= ">Frankreich</option>";
								$content.= "<option value=\"GR\" ";
								if ($LKZ=="GR") $content.= "selected";
								$content.= ">Griechenland</option>";
								$content.= "<option value=\"GB\" ";
								if ($LKZ=="GB") $content.= "selected";
								$content.= ">Grossbritannien</option>";
								$content.= "<option value=\"IRL\" ";
								if ($LKZ=="IRL") $content.= "selected";
								$content.= ">Irland</option>";
								$content.= "<option value=\"IS\" ";
								if ($LKZ=="IS") $content.= "selected";
								$content.= ">Island</option>";
								$content.= "<option value=\"I\" ";
								if ($LKZ=="I") $content.= "selected";
								$content.= ">Italien</option>";
								$content.= "<option value=\"HR\" ";
								if ($LKZ=="HR") $content.= "selected";
								$content.= ">Kroatien</option>";
								$content.= "<option value=\"LV\" ";
								if ($LKZ=="LV") $content.= "selected";
								$content.= ">Lettland</option>";
								$content.= "<option value=\"LT\" ";
								if ($LKZ=="LT") $content.= "selected";
								$content.= ">Litauen</option>";
								$content.= "<option value=\"L\" ";
								if ($LKZ=="L") $content.= "selected";
								$content.= ">Luxemburg</option>";
								$content.= "<option value=\"MK\" ";
								if ($LKZ=="MK") $content.= "selected";
								$content.= ">Mazedonien</option>";
								$content.= "<option value=\"MC\" ";
								if ($LKZ=="MC") $content.= "selected";
								$content.= ">Monaco</option>";
								$content.= "<option value=\"NL\" ";
								if ($LKZ=="NL") $content.= "selected";
								$content.= ">Niederlande</option>";
								$content.= "<option value=\"N\" ";
								if ($LKZ=="N") $content.= "selected";
								$content.= ">Norwegen</option>";
								$content.= "<option value=\"A\" ";
								if ($LKZ=="A") $content.= "selected";
								$content.= ">&Ouml;sterreich</option>";
								$content.= "<option value=\"PL\" ";
								if ($LKZ=="PL") $content.= "selected";
								$content.= ">Polen</option>";
								$content.= "<option value=\"RO\" ";
								if ($LKZ=="RO") $content.= "selected";
								$content.= ">Rum&auml;nien</option>";
								$content.= "<option value=\"RUS\" ";
								if ($LKZ=="RUS") $content.= "selected";
								$content.= ">Russland</option>";
								$content.= "<option value=\"S\" ";
								if ($LKZ=="S") $content.= "selected";
								$content.= ">Schweden</option>";
								$content.= "<option value=\"CH\" ";
								if ($LKZ=="CH") $content.= "selected";
								$content.= ">Schweiz</option>";
								$content.= "<option value=\"SLO\" ";
								if ($LKZ=="SLO") $content.= "selected";
								$content.= ">Slowenien</option>";
								$content.= "<option value=\"E\" ";
								if ($LKZ=="E") $content.= "selected";
								$content.= ">Spanien</option>";
								$content.= "<option value=\"CZ\" ";
								if ($LKZ=="CZ") $content.= "selected";
								$content.= ">Tschechien</option>";
								$content.= "<option value=\"TR\" ";
								if ($LKZ=="TR") $content.= "selected";
								$content.= ">T&uuml;rkei</option>";
								$content.= "<option value=\"UA\" ";
								if ($LKZ=="UA") $content.= "selected";
								$content.= ">Ukraine</option>";
								$content.= "<option value=\"SONST\" ";
								if ($LKZ=="SONST") $content.="selected";
								$content.= ">Sonstige</option>";
							
							$content.= '	
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="telefon" class="col-sm-4 control-label">Telefon- oder Handynummer *</label>
						<div class="col-sm-6">
							<input type="text" name="telefon" value="' .$telefon. '" class="form-control" id="telefon" placeholder="z.B. 030 5558999" required="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="fax" class="col-sm-4 control-label">Faxnummer</label>
						<div class="col-sm-6">
							<input type="text" name="fax" value="' .$fax. '" class="form-control" id="fax" placeholder="Faxnummer">
						</div>
					</div>
					
					<div class="form-group">
						<label for="email" class="col-sm-4 control-label">E-Mail *</label>
						<div class="col-sm-6">
							<input type="email" name="email" value="' .$email. '" class="form-control" id="email" placeholder="email@adresse.de" required="">
						</div>
					</div>
					
					<hr />
					
					<div class="form-group">
						<label class="col-md-4 control-label" for="textarea">Ihre Nachricht an uns:</label>
						<div class="col-md-6">                     
							<textarea class="form-control" name="wunsch" rows="4" id="wunsch">' .$wunsch. '</textarea>
						</div>
					</div>
					
					<hr />
					
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-4">
							<button type="submit" name="anfragen" value="Jetzt anfragen" class="btn btn-success btn-block">Gutschein jetzt anfordern <i class="fa fa-chevron-right"></i></button>
						</div>
					</div>

				</form>
';




?>