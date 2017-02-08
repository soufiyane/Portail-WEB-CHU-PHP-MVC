<?php

class AgentsController extends Controller {

    function liste_agents() {

    	require_once('../public/js/includes/verification.php'); 
        include ('../public/js/includes/fonctions.php');

	
       switch($_SESSION['statut']){ 
		case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
		//case 2: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
	}

     
 $this->set('title','Listes des Agents');

    }

   function modification_agent() {

        require_once('../public/js/includes/verification.php'); 
        include ('../public/js/includes/fonctions.php');

    
       switch($_SESSION['statut']){ 
        case 0: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
        case 1: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
        //case 2: if(!empty($_SESSION['url']))$_SESSION['url']='';header('Location: index.php');  exit(); break;
    }

 $this->set('title','modification d\'un  agent');




        if(isset($_POST['envoyer']))
        {
    //DECALARTION VARIABLES
    
        // On commence par récupérer les champs     
        
    if(isset($_POST['identifiant']))    $identifiant=$_POST['identifiant'];

    if(isset($_POST['tel']))      $tel=$_POST['tel'];
        
    if(isset($_POST['nom']))      $nom=$_POST['nom'];

    if(isset($_POST['mail']))      $mail=htmlentities($_POST['mail']);

    if(isset($_POST['version_office']))      $version_office=$_POST['version_office'];
        
        
        $sql = "SELECT * FROM agents WHERE matricule = '".$_POST['identifiant']."'" ;
        $this->set('resultat', $this->Agent->query($sql));
        $ligne_user = mysqli_fetch_assoc($this->_template->get('resultat'));
        $old_v_off=$ligne_user['version_office'];  
    
    $tel = wordwrap($tel, 2, '-', true);
        if(isset($_POST['cloud'])) {$cloud = 1;} else {$cloud = 0;}
        
    // on écrit la requéte sql 
    $sql = "UPDATE agents SET nom='$nom', tel = '$tel', email = '$mail', version_office = '$version_office', cloud = '$cloud' WHERE matricule = '$identifiant'" ;
    $this->Agent->query($sql);
        if($old_v_off!=""&&$old_v_off!=$version_office){
        $my_t=getdate(date("U"));
        if($my_t[mday]<10){
        $my_t[mday]="0".$my_t[mday];
        }
            if($my_t[mon]<10){
        $my_t[mon]="0".$my_t[mon];
        }
        $datecom = $my_t[mday].'/'.$my_t[mon].'/'.$my_t[year];
        $date = $my_t[year].'-'.$my_t[mon].'-'.$my_t[mday].' '.$my_t[hours].':'.$my_t[minutes].':'.$my_t[seconds];
        $sql=("SELECT matricule FROM agents WHERE matricule = '".$identifiant."'");
        $this->set('req', $this->Agent->query($sql));
        while($donnees=mysqli_fetch_array($req))
        {
        $matricule=$donnees['matricule']; 
        }
        if(isset($_POST['cloud'])){
            $pb="'Changement de Version d\'Office Cloud'";
            $txtcloud=" Cloud";
        }else{
            $pb="'Changement de Version d\'Office'";
            $txtcloud="";
        }
        $sql=("SELECT id FROM incidents WHERE probleme = $pb");
         $this->set('req1', $this->Agent->query($sql));
        while($donnees=mysqli_fetch_array($req1))
        {
        $idpb=$donnees['id']; 
        }
        $sql="SELECT id, nom, prenom FROM technicien WHERE identifiant='".$_SESSION['identifiant']."'";
        $this->set('req2', $this->Agent->query($sql));
        $donnees=mysqli_fetch_array($req2);
        $idtech=$donnees[0];
        $technicien_nom=$donnees[1];
        $technicien_prenom=$donnees[2];
        $sql="INSERT INTO incidents_to_users values ('', ".$idpb.", '".$matricule."', '1', '".$date."', '', 1,'','".$technicien_prenom." ".$technicien_nom."')";
        $this->Agent->query($sql);
        $this->set('idincid',$this->Agent->last_id());
        //$idincid=mysqli_insert_id($db);
        //On insére un dépannage pour cet incident.
        $sql = "INSERT INTO depannage VALUE('', ".$idtech.", ".$idincid.", '".$date."', 'Passage de ".$old_v_off." en ".$version_office.$txtcloud."','','', 'A distance')";
        $this->Agent->query($sql);
        //On marque l'incident comme résolut.
        $sql="UPDATE incidents_to_users SET id_etat=3,commentaire='Résolu le ".$datecom." par ".$technicien_prenom." ".$technicien_nom."' WHERE id=".$idincid."";
        //mysqli_query($db,$sql) or die ('Erreur SQL!'.$sql.'<br />'.mysqli_error($db));
        $this->Agent->query($sql);
        }
    // on affiche le résultat pour le visiteur 
     $this->set('res', "envoyé");
    //echo "<font size='3' align='center'>Les informations concernant l'agent : $identifiant ont été correctement modifiées.</font><br><br>";
    }



        if(isset($_POST['modifier'])||isset($_GET['id']))
        {

        if(isset($_POST['modifier'])){

        if(isset($_POST['identifiant']))   
        {
             $this->set('identifiant',$_POST['identifiant']);
             $identifiant=$_POST['identifiant'];
        
        }else
        {
        $identifiant = $_POST['agent'];
    $first = explode (' ', $identifiant);//récupération de l'id de l'agent
   // $identifiant = $first[0];
    $this->set('identifiant',$first[0]);
    $identifiant=$first[0];
        }
        
        }else{
        $identifiant= $_GET['id'];
        $this->set('identifiant',$_GET['id']);
        }
        
        $sql = "SELECT * FROM agents WHERE matricule = '".$identifiant."'" ;
   
        $this->set('resultat11', $this->Agent->query($sql));
        $this->set('resultat1', $this->Agent->query($sql));        
        $ligne_user1 = mysqli_fetch_assoc($this->_template->get('resultat11'));
        $this->set('casque',$ligne_user1['type_casq']);


        $this->set('res', "modification");
        }
  
        if((!isset($_POST['modifier'])) && (!isset($_POST['envoyer'])) && (!isset($_GET['id']))){

        $this->set('res', "recherche");
        }























       
       
      















































    }

   




















}
?>



}