<?php //Page pour créer le compte
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(isset($_SESSION['id'])){ //Si session id existe (pour evister de faire un retour en arriere juste après la création de compte)
	header("Location:../affichage/mur.php?id=".$_SESSION['id']);	//on le redirige a son mur
}

include("entete.php");
?>

<form action='../traitement/creercompte.php' method='post'>
	<fieldset>
		<label for='login'>Nom d'utilisateur</label>
		<input type="text" name="login" required="required" pattern="^[A-Za-z0-9_]{1,32}$"/> <br />
		<label for='password1'>Mot de passe</label>
		<input type="password" name="password1" required="required"/> <br />
		<label for='password2'>repétez le mot de passe</label>
		<input type="password" name="password2" required="required"/> <br />
		<input type="submit" name="valider">
	</fieldset>
</form>
<a href="login.php">Déjà membre ?</a>


<?php
include("pied.php");
?>