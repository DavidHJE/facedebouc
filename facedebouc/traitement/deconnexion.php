<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

session_destroy(); 		//Détruit le section
header("Location:../affichage/login.php"); //retourne vers login

?>