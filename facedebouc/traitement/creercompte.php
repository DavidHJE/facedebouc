<?php //Page de traitement pour créer un compte
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");


$regex = "/^([A-Za-z0-9_]{1,32})$/";

if(isset($_POST['valider']) && isset($_POST['login']) && isset($_POST['password1']) && isset($_POST['password2'])){ //Si toute les information sont présente

	if(preg_match($regex, $_POST['login'])){ //Si le login entré est autorisée
	
		if($_POST['password1']===$_POST['password2']){ //Si les deux mots sont identiques
			$sql = "SELECT * FROM utilisateur WHERE login=?";
			$q = $pdo -> prepare($sql);
			$q -> execute(array($_POST['login']));
			$line = $q -> fetch();
			if($line==false){		//si le login n'exite pas dans la base
				$sql = "INSERT INTO utilisateur VALUES(NULL,?,MD5(?))";
				$q = $pdo -> prepare($sql);
				$q -> execute(array($_POST['login'], $_POST['password1']));
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['id'] = $pdo ->lastInsertId();
				header("Location:../affichage/ami.php");	//juste après la création de son compte on l'envoie vers le mur ami
			}
	
			else{ //le login existe déja
				header("Location:".$_SERVER['HTTP_REFERER']); // On retourne d'où on vient
			}
		}

		else{ //les mots de passe ne corespond pas
			header("Location:".$_SERVER['HTTP_REFERER']); // On retourne d'où on vient
		}
	}

	else { //le login entrée n'est pas autorisée
		header("Location:".$_SERVER['HTTP_REFERER']); // On retourne d'où on vient
	}
}

else { //Il manque certaine information
	header("Location:".$_SERVER['HTTP_REFERER']); // On retourne d'où on vient
}
?>