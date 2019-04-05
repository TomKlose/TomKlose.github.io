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
	
	<!-- PHP Zeug -->
	
	<?php
		
		include_once("json.php");
		
		date_default_timezone_set('CET');
		
		$fehler = 'Bitte gib hier Deine Daten ein';
		
		if(isset($_POST['submit'])){
			$gast = htmlentities(htmlspecialchars(stripslashes(trim($_POST['name']))));
			$sagt = htmlentities(htmlspecialchars(stripslashes(trim($_POST['text']))));
			$datum = date('d.m.Y H:i');
			
			if (file_exists(JSON_FILE) && file_get_contents(JSON_FILE) != '') {
				$json = file_get_contents(JSON_FILE);
				
				$json = json_decode ($json, true);
				
				$array = array ($gast, $datum, $sagt);
				
				$json[] = $array;
				
				$json = json_encode ($json);
				
				
				 
				if($_POST['name'] != '' && $_POST['text'] != ''){ 
					$fpath = fopen (JSON_FILE, 'w');
					fwrite($fpath, $json);
					fclose($fpath);
					$fehler = 'Alles Abgeschickt!';
				}
				else {
					$fehler = 'Du musst Namen UND Kommentar schreiben!';
				}
			}
			
			else {
				$array = array([$gast, $datum, $sagt]);
				 
				if($_POST['name'] != '' && $_POST['text'] != ''){ 
					$json = json_encode ($array);
					$fpath = fopen (JSON_FILE, 'w');
					fwrite($fpath, $json);
					fclose($fpath);
					$fehler = 'Alles Abgeschickt!';
				}
				else {
					$fehler = 'Du musst Namen UND Kommentar schreiben!';
				}
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
	
		
		<form method="post">
			Hier Kanst du dich Eintragen <br> <br>
			
			<div class="eintragen">
				
				<?= $fehler; ?> <br> <br>
				
				Name <br>
				<input type="text" name="name" class="lil"> <br> <br>
				
				Dein Kommentar <br>
				<textarea name="text" class="text" rows="10" cols="30"> </textarea> <br> <br>
			
				<input type="submit" name="submit" class="submit" value="Abschicken"> <br> <br>
			
			
			</div>
			
			<br> <br>
			
			Alle Einträge:
			
			<div class="Einträge">
				<?php
					
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