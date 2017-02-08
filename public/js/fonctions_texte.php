
<?php

function nettoyer($chaine) { 
 /*$chaine = trim($chaine);
 $chaine = htmlentities ($chaine);
 $chaine = strtr($chaine, 
"ÀÁÂÃÄÅàáâãäåÒÔÓÔÕÖØòôóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", 
"aaaaaaaaaaaaooooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn"); 
 $chaine = strtr($chaine,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz"); 
 $chaine = preg_replace('#([^.a-z0-9]+)#i', ' ', $chaine); 
        $chaine = preg_replace('#-{2,}#',' ',$chaine); 
        $chaine = preg_replace('#-$#','',$chaine); 
        $chaine = preg_replace('#^-#','',$chaine); 
        $chaine = strtoupper($chaine);*/
    $chaine = suppr_accents($chaine);
 return $chaine; 
}


function suppr_accents($str, $encoding='utf-8')
{
    // transformer les caractères accentués en entités HTML
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);
 
    // remplacer les entités HTML pour avoir juste le premier caractères non accentués
    // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "Ã " => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
 
    // Remplacer les ligatures tel que : Œ, Æ ...
    // Exemple "Å“" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;#', '', $str);
    $str = str_replace('-', ' ', $str);
    $str = str_replace('_', ' ', $str);
    $str = str_replace("'", ' ', $str);
	$str = str_replace("\n", ' ', $str);
	/*$str = str_replace('bat ', 'batiment ', $str);*/
	$str = str_replace('st ', 'saint ', $str);
	/*$str = str_replace('ap ', 'appartement ', $str);
	$str = str_replace('app ', 'appartement ', $str);
	$str = str_replace('appt ', 'appartement ', $str);*/
    $str = strtoupper($str);
 
    return $str;
}

//SCRIPT D'UPLOAD D'IMAGE

	function redimensionner_image($fichier, $nouvelle_taille1,  $nouvelle_taille2) {
	    //VARIABLE D'ERREUR
	    global $error;

	 //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE
	    $longueur = $nouvelle_taille1;

	    $largeur = $nouvelle_taille2;

	 

	    //TAILLE DE L'IMAGE ACTUELLE

	    $taille = getimagesize($fichier);

	     

	    //SI LE FICHIER EXISTE

	    if ($taille) {

	     

	        //SI JPG

	        if ($taille['mime']=='image/jpeg' ) {

	            //OUVERTURE DE L'IMAGE ORIGINALE

	            $img_big = imagecreatefromjpeg($fichier);

	            $img_new = imagecreate($longueur, $largeur);

	             

	            //CREATION DE LA MINIATURE

	            $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);

	 

	            //COPIE DE L'IMAGE REDIMENSIONNEE

	            imagecopyresized($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);

	            imagejpeg($img_petite,$fichier);

	
	        }


	        //SI PNG

	        else if ($taille['mime']=='image/png' ) {

	            //OUVERTURE DE L'IMAGE ORIGINALE

	            $img_big = imagecreatefrompng($fichier); // On ouvre l'image d'origine

	            $img_new = imagecreate($longueur, $largeur);


	            //CREATION DE LA MINIATURE

	            $img_petite = imagecreatetruecolor($longueur, $largeur) OR $img_petite = imagecreate($longueur, $largeur);


	            //COPIE DE L'IMAGE REDIMENSIONNEE

	            imagecopyresized($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);

	            imagepng($img_petite,$fichier);

	        }

	        // GIF

	        else if ($taille['mime']=='image/gif' ) {

	            //OUVERTURE DE L'IMAGE ORIGINALE

	            $img_big = imagecreatefromgif($fichier);

	            $img_new = imagecreate($longueur, $largeur);


	            //CREATION DE LA MINIATURE

	            $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);

	            //COPIE DE L'IMAGE REDIMENSIONNEE

	            imagecopyresized($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);

	            imagegif($img_petite,$fichier);

	        }
	    }
	}


?>




