<?php
/**
* Transforme une chaîne de caractères en alphanumérique
*
* @param string $text
* @param string $from_enc
* @return unknown
*/

function to7bit($text) {
$text = mb_convert_encoding($text,'HTML-ENTITIES');
//On vire les accents
$text = preg_replace( array('/ß/','/&(..)lig;/', '/&([aouAOU])uml;/','/&(.)[^;]*;/'), 
array('ss',"$1","$1".'e',"$1"),  
$text);
//on vire tout ce qui n'est pas alphanumérique
//$out_text = eregi_replace("[^a-z0-9]",'',$text);
//on renvoie la chaîne transformée
return $text;
}
?>