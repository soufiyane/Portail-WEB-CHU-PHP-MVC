<?php
//FONCTION DE CREATION DE MATRICULE EXT
function unique_id($db,$tableext,$type)  
        {
            //SI ALEATOIRE
//        $prefixe = "99";    
//        $Id = rand(100000,999999); // Genere un nombre aléatoire 
//        $uID = $prefixe.$Id;
            // SINON
            $like="";
        if($type=="i"){
          $like= "WHERE matricule like '99%'";
        }else if($type=="s"){
          $like= "WHERE matricule like '98%'";
        }
        $sql_matricule = "SELECT max(matricule)As matricule FROM $tableext $like" ;
        mysqli_query($db,$sql_matricule) or die('Erreur SQL : Recherche du prochain matricule!'); 
        $resultat_matricule = mysqli_query($db, $sql_matricule);         
        $ligne = mysqli_fetch_assoc($resultat_matricule);       
        $uID = $ligne['matricule']+1;
        return $uID;
        }     
        
        //FONCTION DE VERIFICATION DE DOUBLONS DE MATRICULES
        function verifieUID($MatriculeGenere,$db,$table) 
        {
        $sql_matricule = "SELECT matricule FROM $table WHERE matricule = '".$MatriculeGenere."'" ;
        mysqli_query($db,$sql_matricule) or die('Erreur SQL : Vérification doublon matricule!'); 
        $resultat_matricule = mysqli_query($db,$sql_matricule);         
        if(mysqli_num_rows($resultat_matricule)>0)       
        {
        return true;
        }
        else {
        return false;
        }
        }
        
        //FONCTION DE VERIFICATION DE DOUBLONS de compte
        function verifie($mail,$date_naissance,$db,$table) 
        {
        // Execution de la requete
        $sql = "SELECT * FROM $table WHERE email = '".$mail."' AND date_naissance = '".$date_naissance."' " ;
        mysqli_query($db,$sql) or die('Erreur SQL : Recherche doublon compte!'); 
        $resultat = mysqli_query($db,$sql); 
        if(mysqli_num_rows($resultat)>0){
        return true;
        }
        else {
        return false;
        }
        }
        
        
function dd($date)
{
$r = '<^([0-9]{2})/([0-9]{2})/([0-9]{4})$>';
return preg_replace($r, '\\3/\\2/\\1', $date);
}

// pour supprimer les espaces en trop
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = mb_ereg_replace("[ ]+", " ", $chaine);
return $chaine;
}

//pour remplacre les ',' par des '.'
function str2num($str){
  if(strpos($str, '.') < strpos($str,',')){
            $str = str_replace('.','',$str);
            $str = strtr($str,',','.');           
        }
        else{
            $str = str_replace(',','',$str);           
        }
        return (float)$str;
} 


//Pour convertir un d�cimal en H
function format($decimalTime){  
       $hour = (int)$decimalTime;  
       $minute = (int)round(($decimalTime - $hour) * 60, 0);  
       return $hour . 'h' . str_pad($minute, 2, '0', STR_PAD_LEFT);  
    } 
    

    // pour nettoyer avant insert mysql
function mysqlclean($value_to_clean) {
return addslashes($value_to_clean);
}

/* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = true) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,basename($file));
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}
?>
