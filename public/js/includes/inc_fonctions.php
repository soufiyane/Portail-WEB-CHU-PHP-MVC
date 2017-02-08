<?php
function dd($date)
{
$r = '^([0-9]{1,4}).([0-9]{1,2}).([0-9]{1,4})$';
return ereg_replace($r, '\\3/\\2/\\1', $date);
}

// pour supprimer les espaces en trop
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = eregi_replace("[ ]+", " ", $chaine);
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
?>
