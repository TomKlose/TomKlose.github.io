<!DOCTPYE HTML>
<html>
	<head> 
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

	<!-- Media Querry, Schreiben von Deutschen sachen -->
	
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Tom Klose">
	
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	
	<!-- CSS -->
	
	<link href="css.css?v=1.3" style="text/css" rel="stylesheet">
	<link href="css_php_task.css?v=1.3" style="text/css" rel="stylesheet">
	<link href="css_php_rechner.css?v=1.3" style="text/css" rel="stylesheet">
	
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->	

	<!-- Anzeige in dem Browser -->
	
	<link rel="icon" type="image/ico" href="favicon.ico">
	<title> Tom Klose / PHP Rechner </title>
		
	</head>
	
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	
	<!-- PHP Zeug -->
	
		<?php
		/* Variablen */
			$zwischenergebnis = '';
			$ergebnis = '0';
			$operat = 2;
			$zero = 0;
			
		/* Speicherung Wichtiger Dinge */	
			if (isset($_POST['zwischenergebnis']) && $_POST['zwischenergebnis'] != '') {
				$zwischenergebnis = $_POST['zwischenergebnis'];
			}
			
			if (isset($_POST['operat']) && $_POST['operat'] != ''){
				$operat = $_POST['operat'];
			}
			
			if (isset($_POST['zeroHid']) && $_POST['zeroHid'] != '') {
				$zero = $_POST['zeroHid'];
			}
			
			if (isset($_POST['zero'])){
				if($zero == 1){
					$zwischenergebnis .= $_POST['zero'];
				}
			}
			
		/* Alles Löschen */
			if (isset($_POST['clear'])){
				$zwischenergebnis = '';
				$ergebnis = '0';
				$operat = 2;
				$zero = 0;
			}
			
		/* Zahlen/Operatoren Eingeben */
			if (isset($_POST['zahl'])) {
				$zwischenergebnis .= $_POST['zahl'];
				$operat = 1;
				$zero = 1;
			}
			
			if (isset($_POST['operator'])) {
				if($operat == 1){
					$zwischenergebnis .= $_POST['operator'];
					$operat = 2;
					$zero = 0;
				}
			}
		
		
		define('PLUS_OPERATOR', '+');
		define('MINUS_OPERATOR', '-');
		define('MAL_OPERATOR', '*');
		define('GETEIELT_OPERATOR', ':');

		$letzteElement = '';
		$letztesElementIstNummer = false;
		$elemente = array();

		function isNummer($token) {
			return !isOperator($token);
		}

		function isOperator($token) {
			if ($token == PLUS_OPERATOR || $token == MINUS_OPERATOR || $token == MAL_OPERATOR || $token == GETEIELT_OPERATOR) {
				return true;
			}
			return false;
		}
		
		// Trivialer Parser
		for ($i = 0; $i < strlen($zwischenergebnis); $i++) {
			$token = $zwischenergebnis[$i];
	
			if (isNummer($token) == false) {
				$letzteElement = $token;
				$letztesElementIstNummer = false;
			}
			else {
				// $token muss also 0-9 sein
				if (!$letztesElementIstNummer) {
					$letzteElement = '';
				}
		
				$letzteElement .= $token;
				$letztesElementIstNummer = true;
			}

			// Token ist letztes Token innerhalb des gesamten Strings
			$isLetztesToken = ($i + 1) == strlen($zwischenergebnis);
	
			// Aktuelles Token ist + oder -
			$isOperator = isOperator($token);

			// Aktuelles Token ist eine Nummer und es folgt *kein* Operator
			$isNummerZuEnde = isNummer($token) == true && !$isLetztesToken && isOperator($zwischenergebnis[$i + 1]);
	
			if ($isOperator || $isLetztesToken || $isNummerZuEnde) {
				$elemente[] = $letzteElement;
			}
		}
		
		/* Ergebnis Berechnen */
			if (isset($_POST['do_berechne'])) {
			
				if ($zwischenergebnis != ''){
					// Interpreter
					$zwischenrechnung = $elemente[0];
					
					for ($i = 0; $i < sizeof($elemente); $i++) {
						$aktuellesElement = $elemente[$i];
						$naechstesElement = 0;
	
						if ($i + 1 != sizeof($elemente)) {
							$naechstesElement = $elemente[$i + 1];
						}
	
						if ($aktuellesElement == PLUS_OPERATOR) {
							$zwischenrechnung = $zwischenrechnung + $naechstesElement;
						}
						else if ($aktuellesElement == MINUS_OPERATOR) {
							$zwischenrechnung = $zwischenrechnung - $naechstesElement;
						}
	
						else if ($aktuellesElement == MAL_OPERATOR) {
							if($zwischenrechnung > 0 && $naechstesElement > 0){
								$zwischenrechnung = $zwischenrechnung * $naechstesElement;
							}
							else {
								$zwischenrechnung = 0;
							}
						}
	
						else if ($aktuellesElement == GETEIELT_OPERATOR) {
							if ($naechstesElement != 0 && $zwischenrechnung >= 0 && $naechstesElement >= 0) {
								$zwischenrechnung  = $zwischenrechnung / $naechstesElement;
							}
						}
		
						else {
		
						}
					}	
					$ergebnis = $zwischenrechnung;
				}
				else{
					$zwischenrechnung = 0;
					$ergebnis = $zwischenrechnung;
				}
			}
		?>
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	
	<!-- Navigations Leiste -->
	
		<header>
			<h3 class="logo"> Tom's Blog </h3>
			
			<input type="checkbox" id="nav-toggle" class="nav-toggle">
				
			<nav>	
				<div class="scroll">
					<ul>
						<li> <a href="index.html">Start</a> </li>
						<li> <a href="wissen.html">Vorwissen</a> </li>
						<li> <a href="schule.html">Schule</a> </li>
						<li> <a href="hobby.html">Hobby</a> </li>
						<li> <a href="rechner.html">Rechner</a> </li>
						<li> <a href="php_rechner.php">PHP Rechner</a> </li>
						<li> <a href="php_gaeste.php"> Gästeliste</a> </li>
					</ul>
				</div>
			</nav>
			
			<label for="nav-toggle" class="nav-toggle-label">
				<span>  </span>
			</label>
			
		</header> 
		
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	
	<!-- Rechner -->
	
		<form method="post">
		
			<div class="rechner">
			
				<input type="hidden" id="hiddenFeld" class="rechner_zählen" name="operat" value="<?= $operat ?>" readonly />
				<input type="hidden" id="hiddenFeld" class="rechner_zählen" name="zeroHid" value="<?= $zero ?>" readonly />
			
				<input type="text" id="hiddenFeld" class="rechner_zählen" name="zwischenergebnis" value="<?= $zwischenergebnis ?>" readonly />
			
				<div class="PHP_Ergebnis" id="Neu" name="ergebnis">	
					<?= $ergebnis ?>
				</div>
			
				<div class="rechner_reiheEins">
					<input type="submit" id="rechner_button7" class="rechner_buttonZahl button" name="zahl" value="7">
					<input type="submit" id="rechner_button8" class="rechner_buttonZahl button" name="zahl" value="8">
					<input type="submit" id="rechner_button9" class="rechner_buttonZahl button" name="zahl" value="9">
				
					<input type="submit" id="rechner_buttonClear" class="rechner_buttonFunk button" value="Clear" name="clear">
				</div>
			
				<div class="rechner_reiheZwei">
					<input type="submit" id="rechner_button4" class="rechner_buttonZahl button" name="zahl" value="4">
					<input type="submit" id="rechner_button5" class="rechner_buttonZahl button" name="zahl" value="5">
					<input type="submit" id="rechner_button6" class="rechner_buttonZahl button" name="zahl" value="6">
			
					<input type="submit" id="rechner_buttonPlus" class="rechner_buttonFunk button" value="+" name="operator">
				</div>
			
				<div class="rechner_reiheDrei">
					<input type="submit" id="rechner_button1" class="rechner_buttonZahl button" name="zahl" value="1">
					<input type="submit" id="rechner_button2" class="rechner_buttonZahl button" name="zahl" value="2">
					<input type="submit" id="rechner_button3" class="rechner_buttonZahl button" name="zahl" value="3">
				
					<input type="submit" id="rechner_buttonMinus" class="rechner_buttonFunk button" value="-" name="operator">
				</div>
			
			
				<div class="rechner_reiheVier">
					<input type="submit" id="rechner_button0" class="rechner_buttonZahl button" name="zero" value="0">
					
					<input type="submit" id="rechner_buttonMal" class="rechner_buttonFunk button" value="*" name="operator">
					<input type="submit" id="rechner_buttonGeteielt" class="rechner_buttonFunk button" value=":" name="operator">
				
				</diV>
				
				<div class="rechner_reiheFünf">
					<input type="submit" id="rechner_buttonGleich" class="rechner_buttonFunk button" value="=" name="do_berechne">
				</div>
				
			</div>
		
		</form>
		
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		
	<!-- Coppyright -->
	
		<footer>
			Programmiert von: Tom Klose <br class="copy">
			Diese Webseite darf nur mit der Erlaubnis von Tom Klose benutzt werden.
		</footer>
	
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</body>
</html>