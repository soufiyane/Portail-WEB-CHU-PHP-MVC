<?php

class IncidentsController extends Controller {

	       function incidents_attente_CFM() {

                require_once('../public/js/includes/verification.php');//verif session
                switch($_SESSION['statut']){ //verif droit
                case 2: break;
                default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: ../index.php');  exit(); break;
  }
        
                $this->set('title','Incidents en cours - en attente du CFM');

                $total_query="SELECT incidents_to_users.id FROM incidents_to_users WHERE incidents_to_users.id_etat =1 AND incidents_to_users.id_users NOT IN(SELECT matricule from etudiants_archive)";
                 $this->set('total',$this->Incident->query($total_query));

                $nonlues_query=" SELECT incidents_to_users.id FROM incidents_to_users WHERE new = 1 AND id_etat = 1 AND incidents_to_users.id_users NOT IN(SELECT matricule from etudiants_archive)";
                 $this->set('nonlues',$this->Incident->query($nonlues_query));

                $anciens_query="SELECT incidents_to_users.id FROM incidents_to_users WHERE id_etat = 1 AND new <> 1 AND date <= DATE_SUB(CURDATE(),INTERVAL 10 DAY) AND incidents_to_users.id_users NOT IN(SELECT matricule from etudiants_archive)";
                 $this->set('anciens', $this->Incident->query($anciens_query));

                 
                  //$anciens_num=0;
                  while ($donnees=mysqli_fetch_array( $this->_template->get('anciens')))
                  {
                  $query_update="UPDATE incidents_to_users SET new = -1 WHERE id = ".$donnees[0]."";
                  $this->Incident->query($query_update);
                  //$anciens_num = $anciens_num + 1;
                  }


                $query="SELECT incidents_to_users.id as id, incidents_to_users.new, incidents_to_users.id_incidents, incidents_to_users.date as date,incidents_to_users.createur as crea, incidents.probleme as probleme, incidents.statut, etudiants
.nom AS nom, etudiants
.prenom AS prenom, etudiants
.mail AS mail, etudiants
.matricule AS identifiant, etudiants
.date_naissance AS date_naiss, etudiants
.tel AS tel
                                FROM incidents_to_users, incidents, etudiants

                                WHERE incidents_to_users.id_incidents = incidents.id
                                AND incidents_to_users.id_users = etudiants
.matricule
                                AND incidents_to_users.id_etat =1
                                UNION
                                SELECT incidents_to_users.id as id, incidents_to_users.new, incidents_to_users.id_incidents,incidents_to_users.date as date,incidents_to_users.createur as crea, incidents.probleme as probleme, incidents.statut, agents
.nom AS nom, agents
.prenom AS prenom, agents
.email AS mail, agents
.matricule AS identifiant, agents
.date_naissance AS date_naiss, agents
.tel AS tel
                                FROM incidents_to_users, incidents, agents

                                WHERE incidents_to_users.id_incidents = incidents.id
                                AND incidents_to_users.id_users = agents
.matricule
                                AND incidents_to_users.id_etat = 1
                                                                UNION
                                SELECT incidents_to_users.id as id, incidents_to_users.new, incidents_to_users.id_incidents,incidents_to_users.date as date,incidents_to_users.createur as crea, incidents.probleme as probleme, incidents.statut, salles.nom AS nom, '' as prenom,'' as email,salles.identifiant as identifiant, 'chu31' as date_naiss, '' as tel
                                FROM incidents_to_users, incidents, salles
                                WHERE incidents_to_users.id_incidents = incidents.id
                                AND incidents_to_users.id_users = salles.identifiant
                                AND incidents_to_users.id_etat = 1";
                $this->set('result',$this->Incident->query($query));                
                $this->set('req',$this->Incident->query($query));
              

                  
                $newArray1 = array();
                $newArray2 = array();
                while ($donnees=mysqli_fetch_array($this->_template->get('result'))){
                $sql="SELECT detail, date FROM depannages WHERE id_incidents_to_users=".$donnees['id']."";
                $this->set('res1',$this->Incident->query($sql));
                $newArray1[] = $this->_template->get('res1');
               
                $sql2="SELECT commentaire FROM incidents_to_users WHERE id=".$donnees['id']."";
                $this->set('res2',$this->Incident->query($sql2));
                $newArray2[] = $this->_template->get('res2');
               }
                $this->set('newArray1',$newArray1);
                $this->set('newArray2',$newArray2);


               
        }

                function incidents_attente_etudiant() {

                  require_once('../public/js/includes/verification.php');
                  switch($_SESSION['statut']){ 
                  case 2: break;
                  default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: ../index.php');  exit(); break;
  } 
        
        
                $this->set('title','Incidents en cours - en attente de l\'étudiant');
                
                $total_query="SELECT incidents_to_users.id  FROM incidents_to_users WHERE (incidents_to_users.id_etat =4 or incidents_to_users.id_etat =2) AND incidents_to_users.id_users NOT IN(SELECT matricule from etudiants_archive)";
                $this->set('total_etud',$this->Incident->query($total_query));

                $anciens_query="SELECT incidents_to_users.id FROM incidents_to_users WHERE (id_etat=4 or id_etat=2) AND new <> 1 AND date <= DATE_SUB(CURDATE(),INTERVAL 10 DAY) AND incidents_to_users.id_users NOT IN(SELECT matricule from etudiants_archive)";
                $this->set('anciens_etud',$this->Incident->query($anciens_query));

                 //$anciens_num=0;
                  while ($donnees=mysqli_fetch_array( $this->_template->get('anciens_etud')))
                  {
                  $query_update="UPDATE incidents_to_users SET new = -1 WHERE id = ".$donnees[0]."";
                  $this->Incident->query($query_update);
                  //$anciens_num = $anciens_num + 1;
                  }






       $query="SELECT incidents_to_users.id as id, incidents_to_users.new, incidents_to_users.id_incidents, incidents_to_users.date as date,incidents_to_users.createur as crea, incidents.probleme as probleme, incidents.statut, etudiants
.nom AS nom, etudiants
.prenom AS prenom, etudiants
.mail AS mail, etudiants
.matricule AS identifiant, etudiants
.date_naissance AS date_naiss, etudiants
.tel AS tel, etudiants
.version_office as v_off,etudiants
.id_ecole as ecole
                                FROM incidents_to_users, incidents, etudiants

                                WHERE incidents_to_users.id_incidents = incidents.id
                                AND incidents_to_users.id_users = etudiants
.matricule
                                AND (incidents_to_users.id_etat =4 or incidents_to_users.id_etat =2)
                                UNION
                                SELECT incidents_to_users.id as id, incidents_to_users.new, incidents_to_users.id_incidents,incidents_to_users.date as date,incidents_to_users.createur as crea, incidents.probleme as probleme, incidents.statut, agents
.nom AS nom, agents
.prenom AS prenom, agents
.email AS mail, agents
.matricule AS identifiant, agents
.date_naissance AS date_naiss, agents
.tel AS tel,agents
.version_office as v_off,agents
.matricule AS ecole
                                FROM incidents_to_users, incidents, agents

                                WHERE incidents_to_users.id_incidents = incidents.id
                                AND incidents_to_users.id_users = agents
.matricule
                                AND (incidents_to_users.id_etat =4 or incidents_to_users.id_etat =2)";


                $this->set('req_2',$this->Incident->query($query));
                

   /*   $custom_query="SELECT detail, date FROM $tabledepa WHERE id_$tableincidusers=".$donnees['id']."";
      $this->set('custom2_req1',$this->Incident->query($custom_query));

      $custom_query2="SELECT commentaire FROM $tableincidusers WHERE id=".$donnees['id']."";
      $this->set('custom2_req2',$this->Incident->query($custom_query2));*/



        }

        function incidents_resolus() {

          require_once('../public/js/includes/verification.php');
          switch($_SESSION['statut']){ 
                  case 2: break;
                  default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: ../index.php');  exit(); break;
  } 
        
       
        $this->set('title','Incidents résolus');

        $query="SELECT count(id) FROM incidents_to_users WHERE id_etat = 3";
        $this->set('resolus',$this->Incident->query($query));

   


        }

        function nouvel_incident_utilisateur() {
        
        require_once('../public/js/includes/verification.php');
           
        switch($_SESSION['statut']){ 
        case 2: break;
        default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: ../index.php');  exit(); break;
  } 
        

         
        $this->set('title','Ajouter un incident utilisateur');

        $query="SELECT * FROM plateforme WHERE id!=4";
        $this->set('reqpla',$this->Incident->query($query));
        $this->set('reqpla2',$this->Incident->query($query)); 
        $newArray = array();
        while ($donneespla=mysqli_fetch_array($this->_template->get('reqpla2')))
        {
        $id=$donneespla['id'];
        $libelle=$donneespla['libelle'];
        $sql="SELECT i.id, probleme, statut FROM incidents as i WHERE i.id_plateforme=$id AND statut <> 0 ORDER BY statut ASC";
        $this->set('res',$this->Incident->query($sql));
       // print_r($this->_template->get('res'));
        $newArray[] = $this->_template->get('res');
        }
        $this->set('newArray',$newArray);
        //print_r($newArray);
	

}



        function nouvel_incident_salle() {
 
        require_once('../public/js/includes/verification.php');
        switch ($_SESSION['statut']) {
        case 2: break;
        default: if (!empty($_SESSION['url'])) $_SESSION['url'] = '';header('Location: ../index.php'); exit(); break;
        }



        $sqlpla = "SELECT * FROM plateforme WHERE id=7 ORDER BY libelle ASC";
        $this->set('reqplat',$this->Incident->query($sqlpla));

        $this->set('reqplat1',$this->Incident->query($sqlpla));
        while ($donnees = mysqli_fetch_array($this->_template->get('reqplat1'))) {
        $id = $donnees['id'];
        }

        $sql = "SELECT * FROM salles ORDER BY nom ASC";
        $this->set('reqsalle',$this->Incident->query($sql));

        $sql = "SELECT i.*,count(itu.id_incidents) as nb FROM incidents i LEFT JOIN incidents_to_users itu ON itu.id_incidents=i.id WHERE statut=1 and id_plateforme='$id' GROUP BY i.id ORDER BY nb DESC";
        $this->set('reqincidents',$this->Incident->query($sql));

       
}


function gestion_incidents_recurrents() {
        require_once('../public/js/includes/verification.php');
        switch ($_SESSION['statut']) {
        case 2: break;
        default: if (!empty($_SESSION['url'])) $_SESSION['url'] = '';header('Location: ../index.php'); exit(); break;
        }
        
        if(isset($_GET['pla'])){
        if($_GET['pla']!=""){
        $idchoix=securite_bdd($_GET['pla']);//open class room
         $this->set('idchoix',$idchoix);
        }else{
        $idchoix=1;  
        $this->set('idchoix',$idchoix);
        }
        }else{
        $idchoix=1;  
        $this->set('idchoix',$idchoix);
        }
        $sql="SELECT * FROM plateforme ORDER BY libelle ASC";
        $this->set('reqrec',$this->Incident->query($sql));

        $sql="SELECT * FROM plateforme WHERE id='$idchoix'";
        $this->set('reqlib',$this->Incident->query($sql));

        $sql="SELECT * FROM incidents WHERE statut <> 0 AND id_plateforme = '$idchoix' ORDER BY statut ASC";
        $this->set('reqinc',$this->Incident->query($sql));



}

function gestion_incidents_non_recurrents() {

 require_once('../public/js/includes/verification.php');
        switch ($_SESSION['statut']) {
        case 2: break;
        default: if (!empty($_SESSION['url'])) $_SESSION['url'] = '';header('Location: ../index.php'); exit(); break;
        }
  
     if(isset($_GET['pla'])){
        if($_GET['pla']!=""){
        $idchoix1=securite_bdd($_GET['pla']);//open class room
         $this->set('idchoix',$idchoix1);
        }else{
        $idchoix1=1;  
        $this->set('idchoix',$idchoix1);
        }
        }else{
        $idchoix1=1;  
        $this->set('idchoix',$idchoix1);
        }

        $sql="SELECT * FROM plateforme ORDER BY libelle ASC";
        $this->set('reqrec1',$this->Incident->query($sql));

$sql="SELECT * FROM incidents WHERE statut = 0 AND id_plateforme ='$idchoix1'";
$this->set('req18',$this->Incident->query($sql));
$this->set('req19',$this->_template->get('req18'));
//mysql_data_seek( $this->Incident->query($sql),0 );


$sql="SELECT * FROM plateforme WHERE id='$idchoix1'";
$this->set('reqlib1',$this->Incident->query($sql));

}


 function statistiques() {
	 

    require_once('../public/js/includes/verification.php');

    switch ($_SESSION['statut']) {
    case 2: break;
    default: if (!empty($_SESSION['url'])) $_SESSION['url'] = '';header('Location: ../index.php'); exit(); break;
}
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') == false) 
    {
    include ('../public/js/includes/date.php');
    }

  $sql = "SELECT id,libelle FROM ecoles ORDER BY libelle ASC";
  $this->set('reqecole',$this->Incident->query($sql));
  $sql = "SELECT pole FROM agents
 WHERE pole IS NOT NULL AND pole != '' GROUP BY pole ORDER BY pole ASC";
  $this->set('reqpole',$this->Incident->query($sql));



 }



 function rediger_incident() {
  require_once('../public/js/includes/verification.php');
  
 switch($_SESSION['statut']){ 
    //case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
    case 1: break;
    case 0: break;
                default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
  }


if(isset($_GET['mail'])){ 
if($_GET['mail']){                                          
$mail=$_GET['mail']; 
//$tel=chunk_split($_GET['tel'], 2, "-");
if($_SESSION['statut']==1){
$sql="UPDATE agents
 SET email = '".$mail."' WHERE matricule = '".$_SESSION['identifiant']."'";
 $this->Incident->query($sql);
}else{
$sql="UPDATE etudiants
 SET mail = '".$mail."' WHERE matricule = '".$_SESSION['identifiant']."'";
 $this->Incident->query($sql);
}
 //rediger_incident();//header('Location: liste_plateforme.php');
}

}

$sql="SELECT email as mail FROM agents
 WHERE matricule = '".$_SESSION['identifiant']."'";
$this->set('reqag',$this->Incident->query($sql));
$sql="SELECT mail as mail FROM etudiants
 WHERE matricule = '".$_SESSION['identifiant']."'";
$this->set('reqet',$this->Incident->query($sql));
$sql="SELECT incidents_to_users.id
                                        FROM incidents_to_users, incidents 
                                        WHERE incidents_to_users.id_incidents = incidents.id 
                                        AND id_users = '".$_SESSION['identifiant']."' 
                                        AND id_etat = 4";
$this->set('reqres',$this->Incident->query($sql));
$cond="";
 if($_SESSION['statut']!=1){ $cond=" WHERE id!=4 AND id!=6 AND id!=7";
}
$sql="SELECT * FROM plateforme $cond";
$this->set('reqpl',$this->Incident->query($sql));
$sql="SELECT * FROM plateforme WHERE id!=5 ORDER BY libelle ASC";
$this->set('reqpla',$this->Incident->query($sql));



}


 function problemes_resolus() {
  require_once('../public/js/includes/verification.php');

switch($_SESSION['statut']){ 
    //case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
    case 1: break;
    case 0: break;
                default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: ../index.php');  exit(); break;
  }


 }


 function mes_problemes() {

 require_once('../public/js/includes/verification.php');
switch($_SESSION['statut']){ 
    //case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
    case 1: break;
    case 0: break;
                default: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: ../index.php');  exit(); break;
  }



$this->set('identifiant',$_SESSION['identifiant']);




}


 function mes_infos() {
require_once('../public/js/includes/verification.php');

switch ($_SESSION['statut']) {
    //case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
    case 1: break;
    case 0: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
}




 $sql= "SELECT * FROM  et_adr_to_users WHERE matricule='".$_SESSION['identifiant']."'";
$this->set('res_reqadr_user',$this->Incident->query($sql));


$sql="SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'et_adr_to_users' AND COLUMN_NAME = 'type_voie'";
$this->set('result',$this->Incident->query($sql));

$sql="SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'et_adr_to_users' AND COLUMN_NAME = 'type_complement'";
$this->set('result2',$this->Incident->query($sql));



}

 function mes_outils() {

require_once('../public/js/includes/verification.php');

switch ($_SESSION['statut']) {
    //case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
    case 1: break;
    case 0: break;
    default: if (!empty($_SESSION['url']))
            $_SESSION['url'] = '';header('Location: ../index.php');
        exit();
        break;
}





}



}
