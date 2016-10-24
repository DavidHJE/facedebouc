<?php //Page du mur
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");


if(!isset($_SESSION['id'])) {
	header("Location:login.php");	// On n'est pas connecté, il faut retourner à la page de login
}


include("entete.php");
include ('menu.php');

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) { //Si on n a pas donné le numéro de l'id de la personne ou si l'id n'est pas numérique dont on veut afficher le mur.
	echo "Bizarre !!!!";// On affiche un message 
    die(1);	//On meurt
}

// On veut affchier notre mur ou celui d'un de nos amis et pas faire n'importe quoi 

$ok = false;
if($_GET['id']==$_SESSION['id']) {
	$ok = true; // C notre mur, pas de soucis
} else {
	// Verifions si on est amis avec cette personne
	$sql = "SELECT * FROM lien WHERE etat='ami' 
		AND ((idUtilisateur1=? AND idUtilisateur2=?) OR ((idUtilisateur1=? AND idUtilisateur2=?)))";

	// les deux ids à tester sont : $_GET['id'] et $_SESSION['id']		
	// A completer. Il faut récupérer une ligne, si il y en a pas ca veut dire que l'on est pas ami avec cette personne
	$query=$pdo->prepare($sql);
	$query->execute(array($_SESSION['id'],$_GET['id'],$_GET['id'],$_SESSION['id']));
	while ($line = $query->fetch()){
		if ($line == false) {
			$ok = false;
		} else {
			$ok = true;
		}
	}


}
if($ok==false) {
	echo "Vous n'êtes pas encore ami, vous ne pouvez voir son mur !!";
	die(1);
}




// Tout va bien, il maintenant possible d'afficher le mur en question.
// A completer
// Requête de sélection des éléments d'un mur
// SELECT * FROM ecrit WHERE idAmi=?
// le paramètre  est le $_GET['id']

$sql = "SELECT * FROM utilisateur WHERE id=?";
$query=$pdo->prepare($sql);
$query->execute(array($_GET['id']));
$line = $query->fetch();
?>

<h2>Mur de <?php echo $line["login"] ?></h2>
<form action="../traitement/ecrire.php?id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
	<fieldset>
		<legend>Ecrire un commentaire</legend>
		<input type="text" name="ecrire" placeholder="titre" required="required"> <br />
		<textarea name="textarea" rows="10" cols="50" placeholder="commentaire" required="required"></textarea> <br />
		<input type="hidden" name="MAX_FILE_SIZE" value="MAX_SIZE">
		<input type="file" name="fichier"> <br />
		<input type="submit" name="publier">
	</fieldset>
</form>


<?php
$sql = "SELECT * FROM ecrit WHERE idAmi=? ORDER BY dateEcrit DESC";
$query=$pdo->prepare($sql);
$query->execute(array($_GET['id']));
while($line = $query->fetch()){ 
	$id[]=$line['id'];
	$titre[]= $line['titre'];
	$com[] = $line['contenu'];
	$date[]= $line['dateEcrit'];
	$img[]= $line['image'];
	$posterpar[]=$line['idAuteur'];
}


if (!empty ($com)) {
	for ($i=0;$i <count($com);$i++) {
		echo "<h4>$titre[$i]</h4>";
		echo "$com[$i]";
		echo "<br />";
		echo "<img src='$img[$i]' width=600 height=idem alt='image'>";
		echo "<br />";
		echo "date: $date[$i]";
		echo "<br />";
		echo "poster par: ";
		$sql = "SELECT * FROM utilisateur WHERE id=?";
		$query=$pdo->prepare($sql);
		$query->execute(array($posterpar[$i]));
		$line = $query->fetch();
		echo $line["login"];
		echo "<br />";

		$sup=$id[$i];
		echo lien("../traitement/effacer.php?id=$sup","Suprimmer");
	}
}
else {
	echo"<br />Vous n'avez aucune publication.";
}

include("pied.php");
?>