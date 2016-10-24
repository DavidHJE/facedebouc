<?php //Page pour le traitement écrire
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
  header("Location:../affichage/login.php"); // On n'est pas connecté, il faut retourner à la page de login
}

// La requete de suppression d'un écrit (il faut le donner en get : DELETE FROM ecrit where id=?
// Le paramètre est le $_GET['id']

$sql = "SELECT * FROM ecrit where id=?";
$verif = $pdo->prepare($sql);
$verif->execute(array($_GET['id']));
$line = $verif->fetch();
if ($line['idAuteur'] == $_SESSION['id'] || $line['idAmi'] == $_SESSION['id']){
	$sql="DELETE FROM ecrit where id=?";
	$suppression=$pdo->prepare($sql);
	$suppression->execute(array($_GET['id']));
	header("Location:".$_SERVER['HTTP_REFERER']);	// On retourne d'où on vient
}
else{
	header("Location:".$_SERVER['HTTP_REFERER']);	// On retourne d'où on vient
}
?>