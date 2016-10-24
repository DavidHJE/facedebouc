<?php //Page de traitement pour la connexion
session_start();
include('../divers/connexion.php');
include('../divers/balises.php');

$regex = "/^([A-Za-z0-9_]{1,32})$/";

if(isset($_POST['valider']) && isset($_POST['login']) && isset($_POST['password'])){ //Si toute les information sont présentes

	if(preg_match($regex, $_POST['login'])){ //si le login est autorisé
		$sql = 'SELECT * FROM utilisateur WHERE login=? AND passwd=MD5(?)';
		$q = $pdo -> prepare($sql);
		$q -> execute(array($_POST['login'], $_POST['password']));
		$line = $q -> fetch();
		if ($line != false){			//Si la ligne est vrai donc est corecte
			$_SESSION['login'] = $_POST['login'];  //La session login
			$_SESSION['id'] = $line['id'];			//La session id
			header("Location:../affichage/mur.php?id=".$_SESSION['id']);	//on le redirige a son mur
		}

		else{ //si la ligne est faux 
			header("Location:".$_SERVER['HTTP_REFERER']); // On retourne d'où on vient
		} 
	}

	else{ //ce login n'est pas autorisé
		header("Location:".$_SERVER['HTTP_REFERER']); // On retourne d'où on vient
	}
}

else{ //information manquante
	header("Location:".$_SERVER['HTTP_REFERER']); // On retourne d'où on vient
}


?>