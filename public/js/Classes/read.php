<?php
$path = './';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
function __autoload($classe)
{
$fichier = str_replace
(
'_', # Caractère à remplacer.
DIRECTORY_SEPARATOR, # Caractère de remplacement.
$classe # Cible du remplacement.
) . '.php' ;
require_once($fichier) ; # Chargement de la classe.
}
$objet = new PHPExcel_Reader_Excel5();
$excel = $objet->load('2011.xls');
$writer = new PHPExcel_Writer_Excel5($excel);
$writer->save('autreFichier.xls');
?>