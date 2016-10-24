<?php
	/* premier version avec attribut
	function lien($link,$texte,$attributes=array()){
		$resultat = "<a href='$link' ";
		foreach ($attributes as $key => $value) {
			$resultat .= "$key = '$value' ";
		}
		$resultat .= ">$texte</a>";
		return $resultat;
	}
	*/

	function GeneratesAttributes($attributes){
		$resultat = "";
		foreach ($attributes as $key => $value) {
			$resultat .= "$key = '$value' ";
		}
		return "$resultat";
	}

	function lien($link,$texte,$attributes=array()){
		$attribute = GeneratesAttributes($attributes);
		return "<a href='$link' $attribute>$texte</a>";
	}

	function item($contenu, $attributes = array()) {
		$attribute = GeneratesAttributes($attributes);
		return "<li $attribute> $contenu </li>";
	}

	function table($tab){
		$resultat = "";
		foreach ($tab as $elt) {
			$resultat .= "<tr>";
			foreach ($elt as $data) {
			 	$resultat .= "<td>$data</td>";
			 } 
			$resultat .= "</tr>";
		}
		return "$resultat";
	}

	function input($type,$name,$attributes=array()){
		$attribute = GeneratesAttributes($attributes);
		return "<input type=$type name=$name $attribute/>";
	}

	function select($name,$tab,$attributes=array()){
		$attribute = GeneratesAttributes($attributes);
		$resultat ="<select name='$name'>";
		foreach ($tab as $value => $texte) {
			$resultat .= "<option value='$value' $attribute>$texte</option>";
		}
		$resultat.="</select>";
		return $resultat;
	}
?>