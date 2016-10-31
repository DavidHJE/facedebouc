<?php //Page pour le traitement écrire
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
  header("Location:../affichage/login.php"); // On n'est pas connecté, il faut retourner à la page de login
}



////////////////IMAGE//////////////////////

		//CONSTANTE//
define('TARGET', '../images/');
define('MAX_SIZE', 2097152); //2mo
define('WIDTH_MAX', 1200);  //1200 px
define('HEIGHT_MAX', 1200); //1200 px

		//Tableaux de donnees//
$tabExt = array('jpg','gif','png','jpeg');// Extensions autorisees
$infosImg = array();

		// Variables //
$extension = '';
$message = '';
$nomImage = '';
$emplacement ='';
		//Creation du repertoire cible si inexistant//
if( !is_dir(TARGET) ) {
    exit('Erreur : On a pas le repertoire!');
}

		//Script pour le téléchargement//
if(isset($_POST['publier'])){ // On verifie si le formulaire a était soumis

  if(isset($_FILES['fichier']['name']) ){  //vérifie si un fichier a était soumis
    $extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION); // Récupere l'extension du fichier

    if(in_array(strtolower($extension),$tabExt)){ // On recherche dans le tableau d'extention si l'extention recupérer juste avant est correct (strtolower = transforme le chaine de caractère en minuscule)
      $infosImg = getimagesize($_FILES['fichier']['tmp_name']); // On verifie le type de l'image /'tmp_name' L'adresse vers le fichier uploadé dans le répertoire temporaire.

      if($infosImg[2] >= 1 && $infosImg[2] <= 14){ // On verifie les dimensions et taille de l'image
        if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE))
        {
          // Parcours du tableau d'erreurs
          if(isset($_FILES['fichier']['error']) 
            && UPLOAD_ERR_OK === $_FILES['fichier']['error'])
          {
            // On renomme le fichier
            $nomImage = md5(uniqid()) .'.'. $extension;
 
            // Si c'est OK, on teste l'upload
            if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage))
            {
              $message = 'Upload réussi !';
              $emplacement = TARGET.$nomImage;
            }
            else
            {
              // Sinon on affiche une erreur systeme
              $message = 'Problème lors de l\'upload !';
            }
          }
          else
          {
            $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
          }
        }
        else
        {
          // Sinon erreur sur les dimensions et taille de l'image
          $message = 'Erreur dans les dimensions de l\'image !';
        }
      }
      else
      {
        // Sinon erreur sur le type de l'image
        $message = 'Le fichier à uploader n\'est pas une image !';
      }
    }
    else
    {
      // Sinon on affiche une erreur pour l'extension
      $message = 'L\'extension du fichier est incorrecte !';
    }
  }
  else
  {
    // Sinon on affiche une erreur pour le champ vide
    $message = 'Aucune image a était rajouter';
  }
}

//variable pour sql//
$idAuteur = $_SESSION['id'];
$idAmi = $_GET['id'];

// Ecrire un message
if (isset($_POST['publier']) && isset($_POST['ecrire']) && isset($_POST['textarea'])) { //Si les informations sont completes
  $sql ="INSERT INTO ecrit(id, titre, contenu, dateEcrit, image, idAuteur, idAmi) VALUES (NULL,?,?,NOW(),?,$idAuteur,$idAmi)";
  $loulou=$pdo->prepare($sql);
  $loulou->execute(array($_POST['ecrire'], $_POST['textarea'], $emplacement));
  header("Location:".$_SERVER['HTTP_REFERER']); // On retourne d'où on vient
}
else{
  header("Location:../affichage/mur.php?id=".$_SESSION['id']);
}

?>