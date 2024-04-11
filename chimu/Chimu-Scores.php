<!DOCTYPE html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,700;1,700&family=Sacramento&display=swap" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Chimu - Scores</title>
</head>

<body>
<main>
    <header id="Titre">
        <h1>
            Team Chimu
        </h1>
        <nav><ul><li><a href="index.html">Accueil</a></li><li><a href="Chimu-Roles.html">Rôles</a></li><li><a href="Chimu-Scores.php">Scores</a></li></ul></nav>
    </header>
    <!--Rajouter les stats AfterLife-->
    <h1>Liste des scores :</h1>
    <!--Et là faudrait trouver le moyen de lier ta partie JS au html comme ça ça s'update automatiquement (si possible, je crois que c'est faisable avec un php mais j'ai un doute)-->
   <div id="players">
    <?php 
    
    $path="/home/gamoonr/cs_scores_players/";
    
    $files = scandir($path);

	foreach ($files as $file) {
	    $content=readMyFile($path.$file);
		$lines= explode("\n", $content);
		//$nom=$lines[0];
		if(count($lines)>1){
			//print_r($lines);
			$nom=$lines[0];
			$kill=$lines[1];
			$death=$lines[2];
			$assist=$lines[3];
			echo('<div class="player"><div class="content">');
			echo('<div class="nom">'.$nom."</div>");
			echo('<div class="kill"><div class="info">kill</div>'.$kill."</div>");
			echo('<div class="death"><div class="info">death</div>'.$death."</div>");
			echo('<div class="assist"><div class="info">assist</div>'.$assist."</div>");
			echo('</div></div>');
		}
	}







    function readMyFile($filename){
         $file = fopen( $filename, "r" );
      
         if( $file != false ) { 
	         $filesize = filesize( $filename );
	         $filetext = fread( $file, $filesize );
         }else{
         	$filetext="vide";
         }
         fclose( $file );
         return( $filetext);
    }

     ?>
    </div>
    <p id="tableu"></p>
    <div class="image_bas_de_page"></div>
</main>
</body>
</html>