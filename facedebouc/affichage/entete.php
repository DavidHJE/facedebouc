<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Facedebouc</title>
  <link rel="stylesheet" type="text/css" href="../css/reset.css">
  <link rel="stylesheet" type="text/css" href="../css/responsive.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
	<h1>Facedebouc</h1>
	<?php
		if(isset($_SESSION['id'])){
			include('menu.php');
		}
	?>
</header>
<div id="contener">