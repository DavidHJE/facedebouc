<?php //Page pour la connexion
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(isset($_SESSION['id'])){ //Si session id existe
	header("Location:../affichage/mur.php?id=".$_SESSION['id']);	//on le redirige a son mur
}

include("entete.php");
?>

<form action="../traitement/connexion.php" method="post">
	<fieldset>
		<label>Nom</label>
		<input type="text" name="login" required="required" pattern="^[A-Za-z0-9_]{1,32}$"> <br />
		<label>MDP</label>
		<input type="password" name="password" required="required"> <br />
		<input type="submit" name="valider">
	</fieldset>
</form>
<a href="creer.php">Créer compte</a>

<?php
include("pied.php");
?>