<!doctype html>
<html lang="fr">
<head>
    ﻿<meta charset="utf-8"/>
  ﻿  <title>Accueil</title>
</head>
<body>
	
	<?php 	
		function lucasd_mysqli_sqltestexemple(){
			$username = "Mitch";
			$bdd = mysqli_connect("localhost", "root", "", "capliez_bd");
			$sql = "SELECT * FROM utilisateur WHERE pseudoU='" . $username . "'";
			if (!$result = $bdd->query($sql)) {
				// On affiche l'erreur, à ne garder qu'en phase de développement
				echo "Query: " . $sql . "\n";
				echo "Errno: " . $bdd->errno . "\n";
				echo "Error: " . $bdd->error . "\n";
				exit;
			}

			$user = $result->fetch_assoc();
			echo 'Bonjour ' . $user['pseudoU'] . ' ton mail est ' . $user['mailU'] . ' et ton mdp crypté est ' . $user['mdpU'];
			
			
			$result = mysqli_query($bdd,"SELECT * FROM resto;");
		    mysqli_fetch_all($result,MYSQLI_ASSOC);
		
			mysqli_close($bdd);
			return $result;
		}
		
		function lucasd_pdo_sqltestexemple(){
				$dsn = "mysql:host=localhost;dbname=capliez_bd";
				$user = "root";
				$passwd = "";

				$pdo = new PDO($dsn, $user, $passwd);

				$username="Mitch";
				
				$stm = $pdo->query("SELECT * FROM utilisateur WHERE pseudoU='" . $username . "'");
				$stm->execute();
				$user = $stm->fetch();
				echo 'Bonjour ' . $user['pseudoU'] . ' ton mail est ' . $user['mailU'] . ' et ton mdp crypté est ' . $user['mdpU'];
				
				$stm = $pdo->query("SELECT * FROM resto;");
				
				$stm->execute();
				if($restaurants = $stm->fetchAll(PDO::FETCH_ASSOC)){
					return $restaurants;
				}
				return false;
				
		}
		
		$restos = lucasd_pdo_sqltestexemple();
	?>
    ﻿<h1>Mon site</h1>
<?php if (true){ ?>
      <a href="inscription.php">Inscription</a>
      ﻿<a href="connexion.php">Connexion</a>
      <a href="motdepasse.php">Mot de passe oublié</a>
<?php } else { ?>
      ﻿<a href="profil.php">Mon profil</a>     
      <a href="deconnexion.php">Déconnexion</a>
<?php } ?>
	<ul>
<?php 
	foreach($restos as $resto){
?>
	<li> <?php echo $resto['nomR'] . " de " . $resto['villeR'] ?> </li>
	<?php } ?>
	
</body>
</html>