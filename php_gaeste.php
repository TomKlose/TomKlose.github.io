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
	<link href="css_php_gast.css?v=1.3" style="text/css" rel="stylesheet">
	
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->	

	<!-- Anzeige in dem Browser -->
	
	<link rel="icon" type="image/ico" href="favicon.ico">
	<title> Tom Klose / Gästeliste </title>
		
	</head>
	
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
		<a href="php_gast_eintragen.php" class="hin">Hier eintragen!</a> <br> <br>
		
		Alle Einträge:
		
		<div class="Einträge">
			<?php
				
				include_once("json.php");
				$json = file_get_contents(JSON_FILE);
				
				$json = json_decode($json, true);
				
				foreach($json as $eintrag=>$value){					

				?>
				
				
					<div class="eintrag">
						<div class="anzeigen">
							
							<div class="name">
								Von: <?= $value[0]?>
							</div>
							
							<div class="datum">
								Erstellt am: <?= $value[1]?> Uhr
							</div>
							
							<div class="kommentar">
								Kommentar: <br> <?= $value[2]?>
							</div>

						</div>
					</div>
					<br>
				<?php
				}
			?>
		</div>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		
	<!-- Coppyright -->
	
		<footer>
			Programmiert von: Tom Klose <br class="copy">
			Diese Webseite darf nur mit der Erlaubnis von Tom Klose benutzt werden.
		</footer>
	
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	</body>
</html>