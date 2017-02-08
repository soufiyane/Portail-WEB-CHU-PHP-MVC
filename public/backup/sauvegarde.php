<?php
//ENTER THE RELEVANT INFO BELOW
$base = dirname(dirname(__FILE__));
include_once($base . '/js/includes/connexion.php');
$datejour=date('d-m-Y');
$mysqlExportPath ='Backup_'.$database_db.'_'.$datejour.'.sql';

//
////DONT EDIT BELOW THIS LINE
////Export the database and output the status to the page
////$command='e:\xampp\mysql\bin\mysqldump -u '.$mysqlUserName.' '.$database_db.' > '.$mysqlExportPath;
//$command='mysqldump --opt -h'.$hostname_db .' -u' .$username_db.' -p' .$password_db  .' '.$database_db .' > ' .$mysqlExportPath;
////echo $command;
//exec($command,$output=array(),$worked);
//switch($worked){
//    case 0:
//        echo 'Database <b>' .$database_db .'</b> successfully exported to <b>~/' .$mysqlExportPath .'</b>';
//        break;
//    case 1:
//        echo 'There was a warning during the export of <b>' .$database_db .'</b> to <b>~/' .$mysqlExportPath .'</b>';
//        break;
//    case 2:
//        echo 'There was an error during export. Please check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$database_db .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
//        break;
//}
//	$JmoinsX = date('d-m-Y', strtotime('-14 days'));
//	//echo $JmoinsX;
//	$oldfichier='E:\xampp\htdocs\fondamentaux\admin\backup\Backup_'.$database_db.'_'.$JmoinsX.'.sql';
//	//echo $oldfichier;
//	if (file_exists($oldfichier)){
//	unlink($oldfichier);
//}
//?>
<?php
//echo "Votre base est en cours de sauvegarde.......";
system("mysqldump --host=".$hostname_db." --user=".$username_db." --password=".$password_db." ".$database_db." > ".$mysqlExportPath."");
//echo "C'est fini. Vous pouvez récupérer la base par FTP";
$JmoinsX = date('d-m-Y', strtotime('-7 days'));
//echo $JmoinsX;
$oldfichier='Backup_'.$database_db.'_'.$JmoinsX.'.sql';
//echo $oldfichier;
if (file_exists($oldfichier)){
unlink($oldfichier);
}
?>