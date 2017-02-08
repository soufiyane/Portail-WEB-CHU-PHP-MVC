<?php

function requete($query,$parameter,$cond)
{


 $sql=$query.$parameter.$cond;
 $con = new mysqli('svm-prefms.chu-toulouse.fr', 'support', '!su4RA15','cfmhoptlsedb');
               if ($con->connect_errno) {
               printf("Echec de la connexion : %s\n", $con->connect_error);
               exit();
               }
         $enco=mysqli_query($con,"SET NAMES UTF8");

         mysqli_query($con,$sql) or die ('Erreur SQL !'.$sql.'<br />'.mysqli_error($con));

        $req=mysqli_query($con,$sql);


$con->close();
return $req;
//mysql_data_seek( $req, 0 );
/*$db = mysqli_connect('localhost', 'root', '','cfmhoptlsedb') or die('Erreur de selection '.mysqli_error($db));
    $enco=mysqli_query($db,"SET NAMES UTF8");
$sql=$query.$parameter.$cond;
echo $sql;
mysqli_query($db,$sql) or die ('Erreur SQL !');                                                                
$result=mysqli_query($db,$sql);
return $result;*/
}

?>