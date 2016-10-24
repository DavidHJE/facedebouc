<?php
// La page de gestion des amis.
// Amis, attente, invitation (les bannis on les aime pas, on les affiche pas)
// Formulaire d'acceptation/refus amitié
// formulaire de demande d'amitié


session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}


include("entete.php");
include("menu.php");
// Il faut faire des requêtes pour afficher ses amis, les attentes, les gens qu'on a invités qui ont pas répondu etc..
// Elles sont listées ci-dessous

// Connaitre les gens que l'on a invité et qui n'ont pas répondu : 
// SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON utilisateur.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?
// Paramètre 1 : le $_SESSION['id']


// Connaitre les gens qui nous ont invité et pour lequel on a pas répondu 
// SELECT utilisateur.* FROM utilisateur WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente'
// Paramètre 1 : le $_SESSION['id']



// Connaitre ses amis : SELECT * FROM utilisateur WHERE id IN (SELECT )
// SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur1=utilisateur.id AND etat='ami' AND idUTilisateur2=? UNION SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur2=utilisateur.id AND etat='ami' AND idUTilisateur1=?
// Les deux paramètres sont le $_SESSION['id']




/*echo "<input type='text' name='nomami'/>";
echo "<input type='button' name='button' />";
if(isset($_GET['id'])) { // Le formulaire a été soumis
    $sql = "INSERT INTO lien VALUES(NULL,?,?,"attente");";
    $query=$pdo->prepare($sql);
    $query->execute(array($_POST['login'],$_POST['passwd']));
    
    // Un seul résultat possible : login est unique
    $line = $query->fetch();*/
echo "<input type='text' name='nomami'/>";
echo "<input type='button' name='button' />";
switch($action)
{
    case "add": //On veut ajouter un ami
    if (!isset($_POST['pseudo']))
    {
    echo '<form action="amis.php?action=add" method="post">
    <p><label for="pseudo">Entrez le pseudo</label>
    <input type="text" name="pseudo" id="pseudo" />
    <input type="submit" value="Envoyer" />
    </p></form>';
    }
}

?>


<?php
include("pied.php");
?>