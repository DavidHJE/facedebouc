<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}

// La requete de recherche de gens par rapport à leur login
// SELECT * FROM utilisateur WHERE login like "%?%'

// Le paramètre est le $_GET['nom']


?>