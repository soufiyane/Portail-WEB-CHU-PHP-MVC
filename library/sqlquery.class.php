<?php

class SQLQuery {
    protected $_dbHandle;
    protected $_result;

    /** Connects to database **/

    function connect($address, $account, $pwd, $name) {
        //$this->_dbHandle = @mysqli_connect($address, $account, $pwd, $name);
         //$this->_dbHandle = @mysqli_connect($adress, $account, $pwd,$name) or die('Erreur de selection '.mysqli_error( $this->_dbHandle));
           $this->_dbHandle = new mysqli($address, $account, $pwd,$name);
               if ($this->_dbHandle->connect_errno) {
               printf("Echec de la connexion : %s\n", $this->_dbHandle->connect_error);
               exit();
               }
         $enco=mysqli_query($this->_dbHandle,"SET NAMES UTF8");

        
    }

    /** Disconnects from database **/

    function last_id() {
        return mysqli_insert_id($this->_dbHandle);
    }

    function disconnect() {
        if ($this->_dbHandle->close() != 0) {
            return 1;
        }  else {
            return 0;
        }
    }
    
    function selectAll() {
        $query = 'select * from `'.$this->_table.'`';
        return $this->query($query);
    }
    
    function select($id) {
       // $id= mysqli_real_escape_string(  $this->_dbHandle, $id);//real_escape_string — Protège une commande SQL de la présence de caractères spéciaux
        // $query = 'select * from `'.$this->_table.'` where `id` = \''.$id.'\''; //correct
        $query = 'select * from `'.$this->_table.'` where `id` = \''.$this->_dbHandle->real_escape_string($id).'\''; 
        return $this->query($query);    
    }

function getdonnees($query) {


   return $this->_dbHandle->query($query);
    


  /*  $database_db = "cfmhoptlsedb"; // nom de base de donn�es
    //
    // Param�tres de connexion local
    $hostname_db = "localhost"; // nom ou ip de serveur
    $username_db = "root"; // nom d'utilisateur 
    $password_db = ""; // mot de passe  
    
    // Paramètres de connexion distant
//    require_once("/home/cfmhoptl/www/crawlprotect/include/cppf.php");
//    $hostname_db = "mysql51-63.perso"; // nom ou ip de serveur
//    $username_db = "cfmhoptlsedb"; // nom d'utilisateur 
//    $password_db = "LEELOO2411"; // mot de passe 
    
    
    $db = mysqli_connect($hostname_db, $username_db, $password_db,$database_db) or die('Erreur de selection '.mysqli_error($db));
    $enco=mysqli_query($db,"SET NAMES UTF8");

  
                
 
                                //echo $sql;
                                mysqli_query($db,$query) or die ('Erreur SQL !'.$query.'<br />'.mysqli_error($db));
                                //echo $sql;
                                mysqli_query($db,$query) or die ('Erreur SQL !');
                                //echo $sql;
                $req=mysqli_query($db,$query);
                                
return $req;*/

}
    
    /** Custom SQL Query **/

    /*
    SELECT table1.field1 , table1.field2, table2.field3, table2.field4 FROM table1,table2 WHERE ….

    Now what our script does is first find out all the output fields and their corresponding tables and place them in arrays – $field and $table at the same index value. For our above example, $table and $field will look like

    $field = array(field1,field2,field3,field4);
    $table = array(table1,table1,table2,table2);

    The script then fetches all the rows, and converts the table to a Model name (i.e. removes the plural and capitalizes the first letter) and places it in our multi-dimensional array and returns the result. The result is of the form $var[‘modelName’][‘fieldName’]. This style of output makes it easy for us to include db elements in our views.
    */

    function query($query) {//ca set a rien $this->_table

         $req=mysqli_query($this->_dbHandle,$query) or die ('Erreur SQL !'.$query.'<br />'.mysqli_error($this->_dbHandle));

       // $req=mysqli_query($this->_dbHandle,$query);



     /*   $this->_result = $this->_dbHandle->query($query);

        if (preg_match("/select/i",$query)) {
        $result = array();
        $table = array();
        $field = array();
        $tempResults = array();
        $numOfFields = mysqli_num_fields($this->_result);
        for ($i = 0; $i < $numOfFields; ++$i) {
            //array_push($table,mysql_field_table($this->_result, $i));
            array_push($table,mysqli_fetch_field_direct($this->_result, $i)->table);
            //array_push($field,mysql_field_name($this->_result, $i));
            array_push($field,mysqli_fetch_field_direct($this->_result, $i)->name);
        }

        
            while ($row = mysqli_fetch_row($this->_result)) {
                for ($i = 0;$i < $numOfFields; ++$i) {
                    //ucfirst — Met le premier caractère en majuscule
                    //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
                    $table[$i] = trim(ucfirst($table[$i]),"s");
                    $tempResults[$table[$i]][$field[$i]] = $row[$i];
                }
                if ($singleResult == 1) {
                    mysqli_free_result($this->_result);
                    return $tempResults;
                }
                array_push($result,$tempResults);
            }
            mysqli_free_result($this->_result);
           //return($result);

                 
        }*/
        
return $req;
    }

    /** Get number of rows **/
    function getNumRows($query) {
        return mysqli_num_rows($this->query($query));
    }

    /** Free resources allocated by a query **/

    function freeResult() {
        mysqli_free_result($this->_result);
    }

    /** Get error string **/

    function getError() {
        return mysqli_error($this->_dbHandle);
    }
}
