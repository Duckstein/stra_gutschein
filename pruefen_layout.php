<?php

/* --------------------------------- *\

	gutscheindaten überprüfen
	
	v1.0	2016-11-02 | jd

\* --------------------------------- */




/* render site
-------------- */

$content.= '
<div class="alert alert-success">
	<b>Bitte überprüfen Sie hier noch einmal Ihre Angaben auf Richtigkeit:</b>
</div>

<h3><i class="fa fa-arrow-right"></i> Gutscheindaten</h3>
<table class="table table-striped">
	<tbody>
		<tr>
			<td>Gutscheinwert:</td>
			<td>&euro; ' .$wert. '</td>
		</tr>
		<tr>
			<td>Name des/der Beschenkten:</td>
			<td>' .$beschenkt. '</td>
		</tr>
		<tr>
			<td>Eindruck:</td>
			<td>' .$eindruck. '</td>
		</tr>
		<tr>
			<td>Ihr Name:</td>
			<td>' .$anrede. ' ' .$vorname. ' ' .$name. '</td>
		</tr>
		<tr>
			<td>Ihre Anschrift:</td>
			<td>' .$strasse. ' ' .$hsnr. '<br>' .$LKZ. ' ' .$plz. ' ' .$ort. '</td>
		</tr>
		<tr>
			<td>Ihre E-Mail Adresse:</td>
			<td>' .$email. '</td>
		</tr>
		<tr>
			<td>Ihre Telefonnummer:</td>
			<td>' .$telefon. '</td>
		</tr>';
		
		if($wunsch){
			$content.= '
		<tr>
			<td>Anmerkungen, Wünsche:</td>
			<td>' .$wunsch. '</td>
		</tr>';
		}
		
		$content.= '
		<tr>
			<td>&nbsp;</td>
			<td>
				<form method="post" action="http://' .$_SERVER['SERVER_NAME']. '/service/gutscheine.php" name="zurueck">

					<input type="hidden" name="wert" value="' .$wert. '">
					<input type="hidden" name="beschenkt" value="' .$beschenkt. '">
					<input type="hidden" name="eindruck" value="' .$eindruck. '">
					<input type="hidden" name="anrede" value="' .$anrede. '">
					<input type="hidden" name="vorname" value="' .$vorname. '">
					<input type="hidden" name="name" value="' .$name. '">
					<input type="hidden" name="strasse" value="' .$strasse. '">
					<input type="hidden" name="hsnr" value="' .$hsnr. '">
					<input type="hidden" name="plz" value="' .$plz. '">
					<input type="hidden" name="ort" value="' .$ort. '">
					<input type="hidden" name="LKZ" value="' .$LKZ. '">
					<input type="hidden" name="telefon" value="' .$telefon. '">
					<input type="hidden" name="email" value="' .$email. '">
					<input type="hidden" name="wunsch" value="' .$wunsch. '">
					<button type="submit" name="aendern" value="zurueck" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Daten ändern</button>
					
				</form>
			</td>
		</tr>	
	</tbody>
</table>

<form method="post" action="http://' .$_SERVER['SERVER_NAME']. '/service/gutscheine_verarbeitung.php" name="weiter">

	<h3><i class="fa fa-arrow-right"></i> Gutschein jetzt anfordern</h3>
	
	<hr />

	<input type="hidden" name="wert" value="' .$wert. '">
	<input type="hidden" name="beschenkt" value="' .$beschenkt. '">
	<input type="hidden" name="eindruck" value="' .$eindruck. '">
	<input type="hidden" name="anrede" value="' .$anrede. '">
	<input type="hidden" name="vorname" value="' .$vorname. '">
	<input type="hidden" name="name" value="' .$name. '">
	<input type="hidden" name="strasse" value="' .$strasse. '">
	<input type="hidden" name="hsnr" value="' .$hsnr. '">
	<input type="hidden" name="plz" value="' .$plz. '">
	<input type="hidden" name="ort" value="' .$ort. '">
	<input type="hidden" name="LKZ" value="' .$LKZ. '">
	<input type="hidden" name="telefon" value="' .$telefon. '">
	<input type="hidden" name="email" value="' .$email. '">
	<input type="hidden" name="wunsch" value="' .$wunsch. '">

	<div class="form-group">
		<button type="submit" name="bestellen" value="weiter" class="btn btn-success btn-lg">Gutschein anfordern <i class="fa fa-chevron-right"></i></button>
	</div>
	
</form>';




?>