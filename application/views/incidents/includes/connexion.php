<?php

    /*
    -----------------------------------
    ------ SCRIPT DE Connection -------
      -----------------------------------
    */
    $database_db = "cfmhoptlsedb"; // nom de base de donn�es
    //
    // Param�tres de connexion local
    $hostname_db = "localhost"; // nom ou ip de serveur
    $username_db = "root"; // nom d'utilisateur 
    $password_db = ""; // mot de passe  
    
    // Paramètres de connexion distant
//    require_once("/home/cfmhoptl/www/crawlprotect/include/cppf.php");
//    $hostname_db = "mysql51-63.perso"; // nom ou ip de serveur
//    $username_db = "cfmhoptlsedb"; // nom d'utilisateur 
//    $password_db = ""; // mot de passe 
    
    
    $db = mysqli_connect($hostname_db, $username_db, $password_db,$database_db) or die('Erreur de selection '.mysqli_error($db));
    $enco=mysqli_query($db,"SET NAMES UTF8");
    //mysql_select_db($database_db,$db) or die('Erreur de selection '.mysqli_error($db));
?>