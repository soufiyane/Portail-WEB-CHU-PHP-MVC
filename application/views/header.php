<?php
require_once('requete.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="../public/js/html5shiv/dist/html5shiv.js">
    <title> <?php echo $title;?></title>
    

  




    <script type="text/javascript">
    

    
    function visibilite(thingId)
    {
    var targetElement;
    targetElement = document.getElementById(thingId) ;
    if (targetElement.style.display == "none")
    {
    targetElement.style.display = "" ;
    }
    else
    {
    targetElement.style.display = "none" ;
    }
    }       
                            function visible(thingId)
            {
                var targetElement;
                targetElement = document.getElementById(thingId) ;
                if (targetElement.style.display == "none")
                {
                    targetElement.style.display = "" ;
                }
            }
    </script>

        <script type="text/javascript">
            function mouseOver(thingId)
            {
                document.getElementById(thingId).style.backgroundImage = "url()";
            }
            function mouseOut(thingId)
            {
                document.getElementById(thingId).style.background = "url(img/fleche05.png)";
                document.getElementById(thingId).style.backgroundRepeat="no-repeat";
                document.getElementById(thingId).style.backgroundPosition="left center";
            }
                   function valider_formulaire(){

                            //                        if(<?php                          
//                        $sql="SELECT libelle FROM $tableecoles ORDER BY libelle ASC";
//                        mysqli_query($db,$sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($db));
//                        $req = mysqli_query($db,$sql);
//                        $i=0;
//                        while ($donnees=mysqli_fetch_array($req))
//                        {
//                            if($i==0){
//                            echo "document.getElementById('".$donnees['libelle']."').checked==false";
//                            }else{
//                            echo "&&document.getElementById('".$donnees['libelle']."').checked==false";  
//                            }
//                            $i++;
//                        }
                            ?>//&&document.getElementById('cfps').checked==false){

//                        if(document.getElementById("choix_utilisateur").selectedIndex==0){
                       if(document.getElementById("choix_utilisateur").value==""||$('#inputString').val()==""){
                        alert("Veuillez choisir un élève");
                        return false;
                        }else if($('#autoSuggestionsList').html().indexOf('Aucun résultat') > 0){
                                alert("L'élève renseigné n'existe pas.");
                                return false;
                        }
                        //if(document.getElementById('plat1').checked==false&&document.getElementById('plat2').checked==false&&document.getElementById('plat3').checked==false){
                        if($('#choixplateforme option:selected').val()=="no"){ 
                        alert("Veuillez choisir une plateforme");
                        return false;  
                        }
                     //    var idpla=$('#choixplateforme option:selected').val();
                         //if(($('#choixprobleme'+idpla).val()=="none")){
                  //      if((document.getElementById('probleme_autre').val()=="")&&($('#choixprobleme'+idpla).val()=="none")){
                 //       alert("Veuillez indiquer le problème rencontré");
                //        return false;  
                   //     }
               /*    var elem = document.getElementById("probleme_non_rec");
                   if (elem.currentStyle) {
                   var displayStyle = elem.currentStyle.display;
                   } else if (window.getComputedStyle) {
                   var displayStyle = window.getComputedStyle(elem, null).getPropertyValue("display");
                   }
                   var texte= document.getElementById('probleme_autre').value;
                   alert(texte);*/
                       if(document.getElementById('probleme_non_rec').style.display!="none"){
                       /// alert('c pa la peine');
                          var texte= document.getElementById('probleme_autre').value;
                         // alert(texte);
                         // alert(texte.length);
                            if(texte.length<2){
                             //   alert(texte);
                                alert("Comme vous voulez saisir un nouveau problème veuillez saisir le problème rencontré ou recliquer sur Créer un problème et selectionnez un problème dans la liste");
                                return false;  
                            }
                        }else{
                       // var idpla=$('input[type=radio][name=plateforme]:checked').val();
                        var idpla=$('#choixplateforme option:selected').val();
                       // alert(idpla);
                      //  alert($('#choixprobleme'+idpla).val());
                        if($('#choixprobleme'+idpla).val()=="none"){  
                        alert("Veuillez indiquer le problème rencontré.");
                        return false; 
                        }
                        }

                       }
        </script>
<script language=javascript>
function close_all_modal() {
           $('.modal').modal('hide');
        }
        window.onload = close_all_modal;


</script>

    <script>
        function quitter()
        {
            var quitter = 'quit';
            return quitter;
        }
    </script>
    <script>
            function visibilite(thingId)
            {
                var targetElement;
                targetElement = document.getElementById(thingId) ;
                if (targetElement.style.display == "none")
                {
                    targetElement.style.display = "" ;
                } 
                else 
                {
                    targetElement.style.display = "none" ;
                }
            }
        </script>
    <script>
        function cacher(thingId)
        {
            document.getElementById(thingId).style.display = "none";
        }
    </script>
    <script language=javascript>
        function redirige(adresse)
        {
            location.href = adresse;
        }
    </script>
    <script type="text/javascript">
         function mapopup(page)
        {
            //alert(page);
            window.open(page,'_blank','height=450,width=1060,top=50,left=50,resizable=0,toolbar=0,scrollbars=1');
              
        }
    </script>

    <script type="text/javascript">

    function voir(){
        document.getElementById("detail").style.display = "none";
        document.getElementById("duree").style.display = "none";
        document.getElementById("mess").style.display = "none";
        document.getElementById("resolu").style.display = "none";
        document.getElementById("attente").style.display = "none";
        var yourSelect = document.getElementById( "mode" );
      if (yourSelect.options[ yourSelect.selectedIndex ].value!="no"){
        if (yourSelect.options[ yourSelect.selectedIndex ].value=="Par mail"){
        document.getElementById("detail").style.display = "";
        document.getElementById("duree").style.display = "";
        document.getElementById("mess").style.display = "";
        document.getElementById("resolu").style.display = "";
        }else {
            document.getElementById("detail").style.display = "";
            document.getElementById("duree").style.display = "";
            document.getElementById("resolu").style.display = "";
            document.getElementById("attente").style.display = "";
        }
    }
    }

</script>
     <script type="text/javascript">
    $(document).ready(function(){

        $('.form-control').on('change', function(){//************************************ A VOIR
            var selected = $(this).find("option:selected").val();
            if(selected=="Par Mmil"){
                document.getElementById('detail').style.visibility="visible";
                document.getElementById('duree').style.visibility="visible";
                document.getElementById('resolu').style.display="visible";
                document.getElementById('mess').style.visibility="visible";
            }else{
                document.getElementById('detail').style.visibility="visible";
                document.getElementById('duree').style.visibility="visible";
                document.getElementById('resolu').style.display="visible";
                document.getElementById('attente').style.visibility="visible";
            }
        });

    });
    </script>
<script type="text/javascript">
                           function choixpla(){
                            window.location="<?php echo $_SESSION['racine']?>incidents/gestion_incidents_recurrents?pla="+document.getElementById('choixpla').value;
                        }
                        function choixpla2(){
                            window.location="<?php echo $_SESSION['racine']?>incidents/gestion_incidents_non_recurrents?pla="+document.getElementById('choixpla2').value;
                        }
                        function voirdiv(elt)
            {   

                                div=elt.id;
                                if(div!="none"){
                document.getElementById('sol'+div).style.display = "";
                                document.getElementById("anciendiv").value='sol'+div;
                                }
            }
             function voirdiv1(div)// onMouseOver="voirdiv1('.$id.')"
            {   

                                //div=elt.id;
                                if(div!="none"){
                document.getElementById('soll'+div).style.display = "";
                                document.getElementById("anciendiv").value='soll'+div;
                                }
            }
                        function cacherdiv()
            {   
                var div;
                                div=document.getElementById("anciendiv").value;
                                if(div!=""){
                document.getElementById(div).style.display = "none";
                                }
            }
                        function deploy(num){
                            if(document.getElementById('listesol'+num).style.height=='0px'){
                            document.getElementById('listesols'+num).style.height='';
                            document.getElementById('listesols'+num).style.borderBottom='1px solid grey';
                            document.getElementById('listesol'+num).style.height='200px';
                            }else{
                            document.getElementById('listesol'+num).style.height='17px';
                            document.getElementById('listesols'+num).style.borderBottom='0px';
                            document.getElementById('listesol'+num).style.height='0px';    
                            }
                        }
                        function reploy(elt,num,num2){
                            document.getElementById('choixpb'+num2).value=elt;
                            document.getElementById('listesol'+num2).style.height='0px';
                            document.getElementById('listesols'+num2).style.borderBottom='0px';
                            document.getElementById('listesolu'+num2).value=num;
                        }
        </script>



   

    <!-- Bootstrap core CSS -->
    <!--<link rel="stylesheet" type="text/css" href="http:\\localhost\framework\public\css\bootstrap\dist\css\bootstrap.min.css">-->
   
  
    

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap/dist/css/bootstrap.min.css">

    
   <link href="../public/js/css/monCss.css" rel="stylesheet">
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->

    <link href="../public/js/menu/bootstrap/jquery.smartmenus.bootstrap.css" rel="stylesheet">

        
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">

 

      
      



       <!--[if lt IE 9]>
 <script src="../public/IE/html5shiv.js" type="text/javascript"></script>
 <script src="../public/IE/respond.js" type="text/javascript"></script>
<![endif]-->

    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->



      <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>


<script type="text/javascript">
$(document).ready( function () {



$('#ecole').change(function() {
   
    var slec=$( "#ecole option:selected" ).text();
     //alert("ann_"+slec);
   // $("#choix_probleme_"+nmpla).toggle("slow");
   $('select[id*="ann_"]').hide();
   $('select[id*="groupe_"]').hide();    
        document.getElementById("ann_"+slec).style.display = "";
   
});
//$('input[id*="choixpb"]')
$('select[id*="ann_"]').change(function() {
      var ecole=$( "#ecole option:selected" ).text();
  //    alert(ecole);      
     var ann=$(this).val();
  //   alert(ann);
 //    alert("groupe_"+ecole+ann);
     //alert("ann_"+slec);
   // $("#choix_probleme_"+nmpla).toggle("slow");
   $('select[id*="groupe_"]').hide();  
        document.getElementById("groupe_"+ecole+ann).style.display = "";
   
});
});
</script>

<script type="text/javascript">
 function clossgrandparent()
             {
    alert('grandparent');
     // parent.clossparent();

             }

       function clossparent()
             {
                 parent.$("#popupModal").hide();
             }

       function openmodal(a)
            {

$("#popupModal iframe").attr({'src':a,
                                'height': 650,
                               'width': 900});
$("#popupModal").css("display", "block");            
            }
</script>

<script type="text/javascript">
       function closs()
            {
                $("#popupModalsol").hide();
                //alert(window.top.location.href);
            }
</script>
 <script type="text/javascript">
             function refresh()
             {
                //alert('kjkjkjmjk');
                document.location.href=document.location;
            }
      </script>
<script type="text/javascript">

                $(document).ready(function(){
                   $(".logo").click(function(){
                            var id=$(this).attr('id');
                            var nmpla=id.substr(5);
                            $(".logo_under").hide();
                            $(".logo").show();
                            $("#"+id).hide();
                            $("#"+id+"_under").show();
                            $(".detailpla").each(function(){ 
                               if( $(this).is(':visible') ) {
                                    $(this).toggle("slow");
                                }
                            });
                            //$(".detailpla").hide();
                            //$(".detailpla").toggle("slow");
                            //$("#"+nmpla).show();
                            $("#"+nmpla).toggle("slow");
                        });
                });
      
$(document).ready( function () {
$(".send").click(function(){
 var select = $(this);
 var at=select.attr('href')
    alert(at);
    //window.open(at,'_blank','height=450,width=1060,top=50,left=50,resizable=0,toolbar=0,scrollbars=1');
$("#popupModal iframe").attr({'src':at,

                                'height': 550,
                               'width': 648});
$("#popupModal").css("display", "block");

});
});
</script>

   
   
     <!--<script type="text/javascript" language="javascript" src="http:\\localhost\framework\public\js\jquery-1.4.2.min.js"></script>-->
     <script src="../public/css/bootstrap/dist/js/bootstrap.min.js"></script>


     
    <script type="text/javascript">
 function lookup1(inputString1,id) {

//alert('lookup');
//alert(inputString);
//alert(id);
var i = id.substring(7,id.length);
//alert( document.getElementById('suggestions'+i).getAttribute("id"));
//alert(i);

                //document.getElementById('suggestions'+idd).style.display = "";
                  //              document.getElementById("anciendiv").value='sol'+div;
        if(inputString1.length == 0) { // si le champ texte est vide
           document.getElementById('#suggestions'+i).style.display = "none";
            //$('#suggestions').hide(); // on cache les suggestions
        } else { // sinon
                    <?php $url="../public/js/ajaxsolution1.php";?>
                   //alert('if');
                    inputString=inputString1+"0"+i;
                   //alert(inputString);
                  // $.post("../casques/ajaxetud.php", {queryString: ""+inputString+"",ecole: "<?php// echo  $choixecole; ?>"}, function(data)vb 
                        $.post(<?php echo '"'.$url.'"'?>, {queryString: ""+inputString+""}, function(data){ // on envoie la valeur du champ texte dans la variable post queryString au fichier ajax.php
                if(data.length >0) {
                 //alert(data);
                document.getElementById('suggestions'+i).style.display = "";
                 $('#autoSuggestionsList'+i).html(data);
                   //$('#suggestions').show(); // si il y a un retour, on affiche la liste
                    //$('#autoSuggestionsList').html(data); // et on remplit la liste des donn�es
                }else{ //alert('0');
                     document.getElementById('suggestions'+i).style.display = "";
                    // document.getElementById('autoSuggestionsList'+i).style.display = "";
                  $('#autoSuggestionsList'+i).html('<p style="margin-top:90px;"><font color=red>Aucun résultat pour "'+inputString1+'".</font></p>');
                                    //$('#suggestions').show(); // si il n'y a un retour, on affiche un message
                                   // $('#autoSuggestionsList').html('<p style="margin-top:90px;"><font color=red>Aucun résultat pour "'+inputString+'".</font></p>'); // et on remplit la liste des donn�es
                                }
            });
                                       
        }
    }
        function fill1(thisValue) {// remplir le champ texte si une suggestion est cliqu�e
         //alert(id);
     //var i = id.substring(0,id.length);
     //alert($('#choixpb'+id).getAttribute("id"));
     var tab=thisValue.split(' | ');        
   //  var tab=thisValue;
      var id = document.getElementById("idd").value;
      //alert(id);
         //$('#choixpb'+id).val(thisValue);
     //    document.getElementById('choixpb'+id).val(thisValue);
     $('#choixpb'+id).val(tab[0]);
     // ********* jamais de ma vie j'ai vu un trun bizare pareil en programmation, si tu met $('#choixpb'+id).val(thisValue) ca marche pas********************
     //********** met si tu met des | dans echo du fichier ajax et tu met  var tab=thisValue.split(' | '); puis  $('#choixpb'+id).val(tab[0]); 
     //*********/ ca marche alors expliquezzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz moi ***********************************************
       document.getElementById('suggestions'+id).style.display = "none";

    }

   /*  document.getElementById("anciendiv").value='soll'+div;
                                
                        function cacherdiv()
            {   
                var div;
                                div=document.getElementById("anciendiv").value;
                                if(div!=""){
                document.getElementById(div).style.display = "none";
                                }
            }*/



       


    $(document).ready( function () {
                var delay = (function(){
                var timer = 0;
                return function(callback, ms){
                    clearTimeout (timer);
                    timer = setTimeout(callback, ms);
                };
                })();
                var globalTimeout = null;  
                $('input[id*="choixpb"]').keyup(function() {
                  // alert('keyup');
                   //alert($(this).attr('id'));
                   var id=$(this).attr('id');
                if (globalTimeout != null) {
                    clearTimeout(globalTimeout);
                }
                globalTimeout = setTimeout(function() {
                  // alert(id);
                    //alert($(this).value);
                   // alert('whyyyyyyyyyyyyyyyy');
                    globalTimeout = null;  
                    lookup1(document.getElementById(id).value,id);//  lookup($("input#inputString").val());
                }, 500);  
                });  




            $('input[id*="choixpb"]').blur( function() { // si le champ texte perd le focus
             //alert('blur');
            fill1();
        });
              $('input[id*="choixpb"]').focus( function() { // si le champ texte prend le focus
                      // alert('focus');
                       if($(this.val!="")){
                            $(this).val("");
                        }
               
                $('input[id*="choixpb"]').click( function() { // si le champ est cliqu�
                $(this).css('color','black');
                    var id=$(this).attr('id');                    
                    var i = id.substring(7,id.length);
                     document.getElementById("idd").value=i;
                     //alert( document.getElementById("idd").value);
                 /*  if (document.getElementById('suggestions'+i).style.display == ""){
                   document.getElementById('suggestions'+i).style.display = "none"; 
                    }else{
                     $('#autoSuggestionsList'+i).html("<li>jhjhjh</li>");
                    document.getElementById('suggestions'+i).style.display ="";

                   }  */                
                    
        });
        });
              });
    
</script>

 <script type="text/javascript">
    function lookup(inputString) {
        if(inputString.length == 0) { // si le champ texte est vide
            $('#suggestions').hide(); // on cache les suggestions
        } else { // sinon
                    <?php $url="../public/js/ajaxeuser1.php";?>
                        $.post(<?php echo '"'.$url.'"'?>, {queryString: ""+inputString+""}, function(data){ // on envoie la valeur du champ texte dans la variable post queryString au fichier ajax.php
                if(data.length >0) {
                    $('#suggestions').show();
                    $('#pla').hide();
                    $('div[id*="choix_probleme_"]').hide(); // si il y a un retour, on affiche la liste
                    $('#autoSuggestionsList').html(data); // et on remplit la liste des donn�es
                }else{
                                    $('#suggestions').show(); // si il n'y a un retour, on affiche un message
                                    $('#autoSuggestionsList').html('<p style="margin-top:90px;"><font color=red>Aucun résultat pour "'+inputString+'".</font></p>'); // et on remplit la liste des donn�es
                                }
            });
                                       
        }
    }
        function fill(el,thisValue) {// remplir le champ texte si une suggestion est cliqu�e
            $('#pla').show();
       //var $me = $(el);// LES PARENTHèSES
                var tab=$t=thisValue.split(' | ');
                //alert('arrivé1');
                var chain=tab[1];
        $('#inputString').val(tab[1]+' | '+tab[2]);
                if($('#inputString').val()!=""){
                    // alert('arrivé');
                setTimeout("$('#suggestions').hide();", 200);

      //  alert(tab[0]);
       //  alert(tab[1]);
        $('#choix_utilisateur').val(tab[1]);
         $('#ec').val(tab[1]);//****************cfps
         //  alert(tab[1]);
   

                  
          
           var frametarget = $(el).attr('href');
           // alert(frametarget);
  var targetmodal = $(el).attr('target');
 // alert(targetmodal);
  if (targetmodal == undefined) {
    targetmodal = '#popupModal';
  } else { 
    targetmodal = '#'+targetmodal;
  }

 $("#popupModal2 iframe").attr({'src':frametarget,//je peut faire un controlleur la (dans le controlleur etudiant l'action afficher)-- rigole pas c pas possible
                                'height': 700,
                               'width': 900});
   
    $("#popupModal2").modal({show:true});
  return false;


                }
    }

    $(document).ready( function () {
                var delay = (function(){
                var timer = 0;
                return function(callback, ms){
                    clearTimeout (timer);
                    timer = setTimeout(callback, ms);
                };
                })();
//      $("input#inputString").keyup( function() { // si on presse une touche du clavier en �tant dans le champ texte qui a pour id inputString
//                        delay(function(){
//                        alert('Time elapsed!');
//                        //lookup($(this).val())
//                        }, 1000 );
//      });
                var globalTimeout = null;  
                $("input#inputString").keyup(function() {
                if (globalTimeout != null) {
                    clearTimeout(globalTimeout);
                }
                globalTimeout = setTimeout(function() {
                    globalTimeout = null;  
                    lookup($("input#inputString").val());
                }, 500);  
                });  

        $("input#inputString").blur( function() { // si le champ texte perd le focus
             //alert('blur');
            fill();
        });
                $("input#inputString").focus( function() { // si le champ texte prend le focus
                      // alert('focus');
                       if($(this.val!="")){
                            $(this).val("");
                        }
                $("#inputString").click( function() { // si le champ est cliqu�
                $(this).css('color','black');
        });
        });
    });
</script>


<script type="text/javascript">
function getSummary()
{
   $.ajax({

     type: "Post",
     url: 'requete_ajax1.php',
     data: id:"id=", // appears as $_GET['id'] @ your backend side
     success: function(data) {
           // data is ur summary
          $('#summary').html("data");
     }

   });

}
    
 /*function getReviews()
{
    
    $.ajax({
    type: 'post',
    url: 'requete_ajax.php',
    crossDomain: true,
   // contentType: "application/json; charset=utf-8",
    //dataType: "jsonp",
    cache: false,
    success: function(data) {
     document.getElementById('td1').innerHTML = data;
    }
    }); */
//}     
/*$(document).ready(function() { 
$(".colonne").click(function(){ 
    alert('ch3ar');

   $.ajax({
    type: 'post',
    url: 'requete_ajax.php',
    crossDomain: true,
   // contentType: "application/json; charset=utf-8",
    //dataType: "jsonp",
    cache: false,
    success: function(data) {
     document.getElementById('td1').innerHTML = data;
    }
    }); 


});
});*/







 </script>



 <script type="text/javascript">


/*function requete_ajax(parameter,query) {

alert('yah ya rab ya wedi yaw'); 

$.ajax({
    type: "post",
    url: 'requete_ajax.php',
    data:{
       parameter: parameter,
       query: query
       //cond: cond
    },
    dataType : 'json',
    async: true,
    cache: false,
    success: function(Result) {//le retour la est dans le parametre result et oui
        alert('yah ya rab ya wedi yaw');
     //alert(Result);
     
    };
}​);​


}*/
    
/* $(document).ready( function () {
$(".colonne").click(function(){
 var select = $(this);
 var par=select.attr('par');
 var req=select.attr('req');
    alert(par);alert(req);
requete_ajax(par,req);
});
});*/
$(document).ready( function () {
$(".lignesol").click(function(){
 var select = $(this);
 var at=select.attr('href')
 var titre=select.attr('titre')
    //alert(at);
    //window.open(at,'_blank','height=450,width=1060,top=50,left=50,resizable=0,toolbar=0,scrollbars=1');
   // alert(titre);
    $('#titremodal').text(titre);
$("#popupModalsol iframe").attr({'src':at,

                                'height': 650,
                               'width': 900});
$("#popupModalsol").css("display", "block");

});
});


$(document).ready( function () {
$(".ligne").click(function(){
 var select = $(this);
 var at=select.attr('href')
 var titre=select.attr('titre')
    //alert(at);
    //window.open(at,'_blank','height=450,width=1060,top=50,left=50,resizable=0,toolbar=0,scrollbars=1');
   // alert(titre);
    $('#titremodal').text(titre);
$("#popupModal iframe").attr({'src':at,

                                'height': 650,
                               'width': 900});
$("#popupModal").css("display", "block");

});
});
</script>

<script>
// Get the modal
$(document).ready( function () {
var modal = document.getElementById('popupModal');
var modal1 = document.getElementById('popupModalsol');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal || event.target == modal1) {
        $("#popupModal").css("display", "none");
        $("#popupModalsol").css("display", "none");
        $("#popupModal2").css("display", "none");
    }
}



});
</script>
<script type="text/javascript">
$(document).ready( function () {
$(".close-modal-edit").click(function () {
       $.each($(".modal"), function (i, obj) {
            $(obj).css("display", "none");
        });
   });
});

/*$('#myModal').on('show.bs.modal', function () {
$('.modal-content').css('height',$( window ).height()*0.8);
});*/

</script>
     <script type="text/javascript">
     $(document).ready( function () {
$("#choixplateforme").change(function() {
  var id = $(this).children(":selected").attr("id");
  var nmpla=id.substr(4);
  $(".listepla").each(function(){ 
                               if( $(this).is(':visible') ) {
                                    $(this).toggle("slow");
                                }
                            });
                            //$(".detailpla").hide();
                            //$(".detailpla").toggle("slow");
                            //$("#"+nmpla).show();
                            $("#choix_probleme_"+nmpla).toggle("slow");
                             $("#bottom").show();
                             //visibilite('bottom');
                        });
});

</script>
<script type="text/javascript">
$(document).ready( function () {
$(".b").click(function () {
     alert($('input.ident').value);
   });
});

/*$('#myModal').on('show.bs.modal', function () {
$('.modal-content').css('height',$( window ).height()*0.8);
});*/

</script>

<!--//****************************************************** debut casques ******************************************************//-->
<script type="text/javascript">
    function lookup_ca(inputString) {
        if(inputString.length == 0) { // si le champ texte est vide
            $('#suggestions').hide(); // on cache les suggestions
        } else { // sinon
            $.post("../public/js/ajaxetud_casque.php", {queryString: ""+inputString+"",casq:1}, function(data){ // on envoie la valeur du champ texte dans la variable post queryString au fichier ajax.php
                if(data.length >0) {
                    $('#suggestions').show(); // si il y a un retour, on affiche la liste
                    $('#autoSuggestionsList').html(data); // et on remplit la liste des données
                }else{
                                    $('#suggestions').show(); // si il n'y a un retour, on affiche un message
                                    $('#autoSuggestionsList').html('<p style="margin-top:90px;"><font color=red>Aucun résultat pour "'+inputString+'".</font></p>'); // et on remplit la liste des donn�es
                                }
            });
        }
    }
    
//  function fill(thisValue) { // remplir le champ texte si une suggestion est cliquée
//      $('#inputString').val(thisValue);
//      setTimeout("$('#suggestions').hide();", 200);
//  }
        function fill_ca(thisValue) { // remplir le champ texte si une suggestion est cliquée
                var tab=thisValue.split(' | ');
        $('#inputStringc').val(tab[1]+' | '+tab[2]);
                if($('#inputStringc').val()!=""){
        $('#choix_utilisateur').val(tab[0]);
                }
        setTimeout("$('#suggestions').hide();", 200);
    }
    
    $(document).ready( function () {
//      $("input#inputString").keyup( function() { // si on presse une touche du clavier en étant dans le champ texte qui a pour id inputString
//          lookup($(this).val()) 
//      });
                var globalTimeout = null;    
                $("input#inputStringc").keyup(function() {
                if (globalTimeout != null) {
                    clearTimeout(globalTimeout);
                }
                globalTimeout = setTimeout(function() {
                    globalTimeout = null;  
                    lookup_ca($("input#inputStringc").val());
                }, 500);  
                });

        $("input#inputStringc").blur( function() { // si le champ texte perd le focus
            fill_ca() 
        });
    });
</script>

<script type="text/javascript">
    function lookup_ag(inputString) {
        if(inputString.length == 0) { // si le champ texte est vide
            $('#suggestions').hide(); // on cache les suggestions
        } else { // sinon
            $.post("../public/js/ajaxagent_casque.php", {queryString: ""+inputString+"",casq:1}, function(data){ // on envoie la valeur du champ texte dans la variable post queryString au fichier ajax.php
                if(data.length >0) {
                    $('#suggestions').show(); // si il y a un retour, on affiche la liste
                    $('#autoSuggestionsList').html(data); // et on remplit la liste des données
                }else{
                                    $('#suggestions').show(); // si il n'y a un retour, on affiche un message
                                    $('#autoSuggestionsList').html('<p style="margin-top:90px;"><font color=red>Aucun résultat pour "'+inputString+'".</font></p>'); // et on remplit la liste des donn�es
                                }
            });
        }
    }
    
    function fill_ag(thisValue) { // remplir le champ texte si une suggestion est cliquée
                var tab=thisValue.split(' | ');
        $('#inputStringag').val(tab[1]+' | '+tab[2]);
                if($('#inputStringag').val()!=""){
        $('#choix_utilisateurag').val(tab[0]);
                }
        setTimeout("$('#suggestions').hide();", 200);
    }
    $(document).ready( function () {
                var delay = (function(){
                var timer = 0;
                return function(callback, ms){
                    clearTimeout (timer);
                    timer = setTimeout(callback, ms);
                };
                })();
//      $("input#inputString").keyup( function() { // si on presse une touche du clavier en étant dans le champ texte qui a pour id inputString
//                        delay(function(){
//                        alert('Time elapsed!');
//                        //lookup($(this).val())
//                        }, 1000 );
//      });
                var globalTimeout = null;  
                $("input#inputStringag").keyup(function() {
                if (globalTimeout != null) {
                    clearTimeout(globalTimeout);
                }
                globalTimeout = setTimeout(function() {
                    globalTimeout = null;  
                    lookup_ag($("input#inputStringag").val());
                }, 500);  
                });  

        $("input#inputStringag").blur( function() { // si le champ texte perd le focus
            fill_ag() 
        });
    });
</script>

<script type="text/javascript">
    function lookup_pool(inputString) {
        if(inputString.length == 0) { // si le champ texte est vide
            $('#suggestions').hide(); // on cache les suggestions
        } else { // sinon
            $.post("../public/js/ajaxpool.php", {queryString: ""+inputString+""}, function(data){ // on envoie la valeur du champ texte dans la variable post queryString au fichier ajax.php
                if(data.length >0) {
                    $('#suggestions').show(); // si il y a un retour, on affiche la liste
                    $('#autoSuggestionsList').html(data); // et on remplit la liste des donn�es
                }
            });
        }
    }
    
    function fill_pool(thisValue) {
     var tab=thisValue.split(' | ');
        $('#inputStringpl').val(tab[0]+' | '+tab[1]);
                if($('#inputStringpl').val()!=""){
        $('#choix_utilisateurpl').val(tab[1]);
                } // remplir le champ texte si une suggestion est cliqu�e
      //   $('#inputStringpl').val(thisValue);
        setTimeout("$('#suggestions').hide();", 200);
    }
    
    $(document).ready( function () {

        $("#inputStringpl").keyup( function() { 
       // alert('khjklhlhklh');// si on presse une touche du clavier en �tant dans le champ texte qui a pour id inputString
            lookup_pool($(this).val()) 
        });

        $("#inputStringpl").blur( function() {
      //  alert('khjklhlhklh'); // si le champ texte perd le focus
            fill_pool() 
        });
    });
</script>

<!--//****************************************************** fin casques ******************************************************//-->



<!--//****************************************************** ETUDIANT ******************************************************//-->
<script type="text/javascript" charset="UTF-8">
            $(document).ready(function() {
                var myTable=$('#liste_etu').dataTable( {
                    "bProcessing": true,
                                        "bServerSide": true,
                                        //"bFilter": false,
                                        "bLengthChange": false,
                                        "sAjaxSource": "../public/js/requete_liste_et.php",
                                        "sPaginationType": "full_numbers",
                                        "aaSorting": [[ 1, "asc" ]],
                                        "iDisplayLength": 20,
                                        "fnDrawCallback": function() {
                                                $('#liste_etu tbody tr td').each(function(){
                                                        $(this).css('border','1px solid black');
                                                        $(this).css('text-align','center');
                                                        }),
                                                
                                                $('#liste_etu tbody tr td .arch').each(function(){
                                                        $(this).parents("tr").css("background-color","#FF410C");
                                                        }),
                                                $("#liste_etu tbody tr").hover(
                                                        function () {
                                                                $(this).css("background-color","#d9edf7");
                                                                $(this).css('cursor','pointer');
                                                        },
                                                        function () {
                                                                $(this).css("background-color","white");
                                                                $(this).css('cursor','auto');
                                                        }
                                                );
                                                $("#liste_etu tbody tr .arch").parents("tr").hover(
                                                        function () {
                                                                $(this).css("background-color","#d9edf7");
                                                                $(this).css('cursor','pointer');
                                                        },
                                                        function () {
                                                                $(this).css("background-color","#FF410C");
                                                                $(this).css('cursor','auto');
                                                        }
                                                );
                                                $("#liste_etu tbody tr").click(function () {
                                                 //   mapopup("historique_et.php?id="+$(this).find('td:first .identifiant').val());
                                                     $("#popupModal iframe").attr({'src':"../public/js/historique_et.php?id="+$(this).find('td:first .identifiant').val()+"",

                                                                                          'height': 750,
                                                                                          'width': 900});
                                                   $("#popupModal").css("display", "block");
                                                } );
                                                $("#liste_etu tbody tr .arch").parents("tr").click(function () {
                                                   // mapopup("historique_et.php?idar="+$(this).find('td:first .identifiant').val());
                                                     $("#popupModal iframe").attr({'src':"../public/js/historique_et.php?idar="+$(this).find('td:first .identifiant').val()+"",

                                                                                          'height': 750,
                                                                                          'width': 900});
                                                   $("#popupModal").css("display", "block");
                                                } );
                                            },
                                        "fnInitComplete":function() {
                                               $(".dataTables_filter").css("background-color","white");
                                               $(".dataTables_filter").css("color","black");
                                               $(".dataTables_filter").wrap("<div id='rechercher2'></div>");
                                                if(window.navigator.userAgent.indexOf("MSIE ")>0){
                                                // if($.browser.msie){
                                               $(".dataTable").css("margin-top","-50px");
                                               }else{
                                               $(".dataTable").css("margin-top","-20px");    
                                               }
                                               $(".dataTables_paginate").css("margin-top","30px");
                                                $(".dataTables_filter :text").wrap("<table align='right'><tr><td></td></tr></table>");
                                                $('<td><INPUT class="rech" border=0 src="images/rech2.png" height=25px width=25px type=image Value=submit align="middle" title="Rechercher"></td>').insertAfter(".dataTables_filter table tr td:last");
                                                $('<tr><td colspan="2" width="100px"><i><font size=1px>La recherche peut être faite par identifiant, groupe, nom ou prénom.</font></i></td></tr>').insertAfter(".dataTables_filter table tr:last");
                                                $('.rech').click(function(){
                                                myTable.fnFilter($('.dataTables_filter :text').val());    
                                                });
                                                $('.dataTables_filter :text')
                                                    .unbind('keypress keyup')
                                                    .bind('keypress', function(e){
                                                    if (e.keyCode != 13) return;
                                                    myTable.fnFilter($(this).val());
                                                    });
                                                },
                                                "oLanguage": { 
                                                "sProcessing":   "Traitement en cours...",
                                                "sLengthMenu":   "Nombre de lignes par page: _MENU_",
                                                //"sLengthMenu":   "",
                                                "sZeroRecords":  "Aucun élément à afficher",
                                                //"sInfo": "Affichage de l'élement _START_ é _END_ sur _TOTAL_ éléments",
                                                "sInfo": "",
                                                //"sInfo": "",
                                                //"sInfoEmpty": "Affichage de l'élement 0 é 0 sur 0 éléments",
                                                "sInfoEmpty": "",
                                                //"sInfoFiltered": "(filtré de _MAX_ éléments au total)",
                                                "sInfoFiltered": "",
                                                "sInfoPostFix":  "",
                                                "sSearch":       "Rechercher: ",
                                                "sUrl":          "",
                                                "oPaginate": {
                                                        "sFirst":    "<<",
                                                        "sPrevious": "< Précédent",
                                                        "sNext":     "Suivant >",
                                                        "sLast":     ">>"
                                                    }
                                                        }
                } );
            } );
        </script>

<!--//****************************************************** FIN ETUDIANTS ******************************************************//-->


<!--//****************************************************** AGENTS ******************************************************//-->



                <script type="text/javascript" charset="ISO-8859-1">
            $(document).ready(function() {
                var myTable=$('#liste_ag').dataTable( {
                    "bProcessing": true,
                                        "bServerSide": true,
                                        "processing": false,
                                        //"bFilter": false,
                                        "bLengthChange": false,
                    "sAjaxSource": "../public/js/requete_liste_ag.php",
                                        "sPaginationType": "full_numbers",
                                        "aaSorting": [[ 1, "asc" ]],
                                        "iDisplayLength": 20,
                                        "fnDrawCallback": function() {
                                                $('#liste_ag tbody tr td').each(function(){
                                                        $(this).css('border','1px solid black');
                                                        $(this).css('text-align','center');
                                                        }),
                                                $("#liste_ag tbody tr").hover(
                                                        function () {
                                                                $(this).css("background-color","#d9edf7");
                                                                $(this).css('cursor','pointer');
                                                        },
                                                        function () {
                                                                $(this).css("background-color","white");
                                                                $(this).css('cursor','auto');
                                                        }
                                                );
                                                $("#liste_ag tbody tr").click(function () {
                                                       $("#popupModal iframe").attr({'src':"../public/js/historique_cfps.php?id="+$(this).find('td:first .idag').val()+"",

                                                                                          'height': 750,
                                                                                          'width': 900});
                                                   $("#popupModal").css("display", "block");
                                                  //  mapopup("historique_cfps.php?id=cfps.01"+$(this).find('td:first .idag').val());
                                                } );
                                            },
                                        "fnInitComplete":function() {
                                               $(".dataTables_filter").css("background-color","white");
                                               $(".dataTables_filter").css("color","black");
                                               $(".dataTables_filter").wrap("<div id='rechercher2'></div>");
                                               if(window.navigator.userAgent.indexOf("MSIE ")>0){
                                                // if($.browser.msie){
                                               $(".dataTable").css("margin-top","-50px");
                                               }else{
                                               $(".dataTable").css("margin-top","-20px");    
                                               }
                                               $(".dataTables_paginate").css("margin-top","30px");
                                                $(".dataTables_filter :text").wrap("<table align='right'><tr><td></td></tr></table>");
                                                $('<td><INPUT class="rech" border=0 src="images/rech2.png" height=25px width=25px type=image Value=submit align="middle" title="Rechercher"></td>').insertAfter(".dataTables_filter table tr td:last");
                                                $('<tr><td colspan="2" width="100px"><i><font size=1px>La recherche peut étre faite par identifiant, groupe, nom ou prénom.</font></i></td></tr>').insertAfter(".dataTables_filter table tr:last");
                                                $('.rech').click(function(){
                                                myTable.fnFilter($('.dataTables_filter :text').val());    
                                                });
                                                $('.dataTables_filter :text')
                                                    .unbind('keypress keyup')
                                                    .bind('keypress', function(e){
                                                    if (e.keyCode != 13) return;
                                                    myTable.fnFilter($(this).val());// il a utilisé myTable pske var myTable=$('#liste_ag').dataTable( {
                                                    });
                                                },
                                                "oLanguage": { 
                                                "sProcessing":   "Traitement en cours...",
                                                "sLengthMenu":   "Nombre de lignes par page: _MENU_",
                                                //"sLengthMenu":   "",
                                                "sZeroRecords":  "Aucun élément é afficher",
                                                //"sInfo": "Affichage de l'élement _START_ é _END_ sur _TOTAL_ éléments",
                                                "sInfo": "",
                                                //"sInfo": "",
                                                //"sInfoEmpty": "Affichage de l'élement 0 é 0 sur 0 éléments",
                                                "sInfoEmpty": "",
                                                //"sInfoFiltered": "(filtré de _MAX_ éléments au total)",
                                                "sInfoFiltered": "",
                                                "sInfoPostFix":  "",
                                                "sSearch":       "Rechercher: ",
                                                "sUrl":          "",
                                                "oPaginate": {
                                                        "sFirst":    "<<",
                                                        "sPrevious": "< Précédent",
                                                        "sNext":     "Suivant >",
                                                        "sLast":     ">>"
                                                    }
                                                        }
                } );
            } );
        </script>

<script type="text/javascript">
      function verifcomplete(texte)
                        {
                            if(texte.value.length < 1)
                                {
                                    alert("Commentaire obligatoire !");
                                    return false;
                                }
                            else
                                {
                                    return true;
                                }
                        }

</script>
<script type="text/javascript">

        function verif_formulaire()
{
 
 if(document.form_envoyer.date_naissance.value!="") {
        var reg_datenaiss = /^[0-9]{8}$/
        if (!(reg_datenaiss.exec(document.form_envoyer.date_naissance.value)!=null))
        {
        alert("La date de naissance saisie n'est pas au format valide (JJMMAAAA) !");
        return(false);
        }
    }
  
//vérification de saisie d'email au bon format
  if(document.form_envoyer.mail.value=="") {
   alert("Veuillez entrer votre adresse mail !");
   return false;
  } else {
      if ((document.form_envoyer.mail.value.indexOf("@")==-1)||(document.form_envoyer.mail.value.indexOf(".")==-1)) {
        alert("L'adresse mail saisie n'est pas au format valide !");
         return false
      }
    }
    
   if(document.form_envoyer.version_office.selectedIndex==false) {
   alert("Veuillez sélectionnez votre version d'Office!");
   return false;
  }
}   

   


    function lookup2(inputString) {
        if(inputString.length == 0) { // si le champ texte est vide
            $('#suggestions').hide(); // on cache les suggestions
        } else { // sinon
            $.post("../public/js/ajaxagent.php", {queryString: ""+inputString+""}, function(data){ // on envoie la valeur du champ texte dans la variable post queryString au fichier ajax.php
                if(data.length >0) {
                    $('#suggestions').show(); // si il y a un retour, on affiche la liste
                    $('#autoSuggestionsList').html(data); // et on remplit la liste des données
                }
            });
        }
    }
    
    function  fill2(thisValue) { // remplir le champ texte si une suggestion est cliquée
        //alert(thisValue);
                var tab=thisValue.split(' | ');
        $('#inputString2').val(tab[1]+' | '+tab[2]);
                 if($('#inputString2').val()!=""){
                  //  alert('fill2');
                 $('#choix_utilisateur2').val(tab[0]); 
                 $("#popupModal iframe").attr({'src':"../public/js/historique_cfps.php?id="+tab[0]+"",

                                                                                          'height': 750,
                                                                                          'width': 900});
                                                   $("#popupModal").css("display", "block");
               //  window.open('historique_cfps.php?id=cfps.01'+tab[0],'mapopup','height=800,width=1100,top=50,left=50,resizable=yes, scrollbars=yes');
                 }
        setTimeout("$('#suggestions').hide();", 200);
               // visible('pla');
    }
    
    $(document).ready( function () {
        $("input#inputString2").keyup( function() { // si on presse une touche du clavier en étant dans le champ texte qui a pour id inputString
            lookup2($(this).val()) 
        });

        $("input#inputString2").blur( function() { // si le champ texte perd le focus
            fill2() 
        });

        $("input#inputString2").focus( function() { // si le champ texte prend le focus
                      // alert('focus');
                       if($(this.val!="")){
                            $(this).val("");
                        }
               
                $("input#inputString2").click( function() { // si le champ est cliqu�
                $(this).css('color','black');
            });
        });


    });
</script>


<!--//****************************************************** FIN AGENTS ******************************************************//-->




<script type="text/javascript" charset="ISO-8859-1">
            $(document).ready(function() {
                $('#resoluspb').dataTable( {
                    "bProcessing": true,
                                        "bServerSide": true,
                                        "bFilter": false,
                    "sAjaxSource": "../public/js/requete_resolus.php",
                                        "fnServerParams": function ( aoData ) {
                                                aoData.push({"name":"etud","value":"<?php echo $_SESSION['identifiant']?>"});//$('input.ident').val()
                                        },
                                        "sPaginationType": "full_numbers",
                                        "aaSorting": [[ 0, "desc" ]],
                                        "aoColumns": [
                                        null,
                                        null,
                                        null,
                                        {"bSortable": false }
                                        ],
                                        "fnDrawCallback": function() {
                                                $('#resoluspb tbody tr td').each(function(){
                                                        $(this).css('border','1px solid black');
                                                        $(this).css('text-align','center');
                                                        }),
                                                $("#resoluspb tbody tr").hover(
                                                        function () {
                                                                $(this).css("background-color","#d9edf7");
                                                                $(this).css('cursor','pointer');
                                                        },
                                                        function () {
                                                                $(this).css("background-color","white");
                                                                $(this).css('cursor','auto');
                                                        }
                                                );
                                                $("#resoluspb tbody tr").click(function () {
                                                    $("#popupModal iframe").attr({'src':"../public/js/solution.php?id="+$(this).find('.idpb').val()+"&solution=1",

                                                                                          'height': 750,
                                                                                          'width': 900});
                                                   $("#popupModal").css("display", "block");
                                                  
                                                } );
                                            },
                                                "oLanguage": { 
                                                "sProcessing":   "Traitement en cours...",
                                                //"sLengthMenu":   "Nombre de lignes par page: _MENU_",
                                                "sLengthMenu":   "",
                                                "sZeroRecords":  "Aucun élément à afficher",
                                                //"sInfo": "Affichage de l'�lement _START_ � _END_ sur _TOTAL_ �l�ments",
                                                "sInfo": "",
                                                //"sInfo": "",
                                                //"sInfoEmpty": "Affichage de l'�lement 0 � 0 sur 0 �l�ments",
                                                "sInfoEmpty": "",
                                                "sInfoFiltered": "(filtré de _MAX_ éléments au total)",
                                                "sInfoPostFix":  "",
                                                "sSearch":       "Rechercher:",
                                                "sUrl":          "",
                                                "oPaginate": {
                                                        "sFirst":    "<<",
                                                        "sPrevious": "< Précédent",
                                                        "sNext":     "Suivant >",
                                                        "sLast":     ">>"
                                                    }
                                                        }
                } );
            } );
        </script>


   <!-- <script type="text/javascript">
     $(document).ready(function() {

                                                $("#resolus.dataTables_filter").wrap("<div id='rechercher'></div>");
                                                $('<div style="float:left;padding-top:7px;background-color: #F7951E;"><b>Rechercher dans:</b><select id="choix" name="choix" style="margin-left:10px;margin-right:10px;"><option name="choix" value="id">Num Incident</option><option name="choix" value="date">Date</option><option name="choix" value="nom">Nom - Prénom</option><option name="choix" value="identifiant">Identifiant</option><option name="choix" value="pb">Problème</option></select></div>').insertBefore("#resolus.dataTables_filter");
                                                $('<div class="clear"></div>').insertAfter("#rechercher");  
                                                $('<input type="button" class="rech" value="OK" />').insertAfter("#resolus.dataTables_filter :text");
                                                $('.rech').click(function(){
                                                myTable.fnFilter($('#resolus.dataTables_filter :text').val());    
                                                });
    });
    </script>  -->
    <script type="text/javascript">                                              

            $(document).ready(function() {
                var myTable=$('#resolus').dataTable( {
                    "bProcessing": true,
                    "bServerSide": true,
                                        //"bFilter": false,
                    "sAjaxSource": "../public/js/requete_admin_resolus.php",
                                      //  "fnServerParams": function ( aoData ) {
                                       //         aoData.push({"name":"critere","value":$( "#choix option:selected" ).text()});
                                       // },
                                        "sPaginationType": "full_numbers",
                                        "aaSorting": [[ 0, "desc" ]],
                                        "aoColumns": [
                                        null,
                                        null,
                                        null,
                                        null,
                                        {"bSortable": false },
                                        null,
                                        {"bSortable": false }
                                        ],
                                        "fnDrawCallback": function() {
                                                $('#resolus tbody tr td').each(function(){
                                                        $(this).css('border','1px solid black');
                                                        $(this).css('text-align','center');
                                                        }),
                                                $("#resolus tbody tr").hover(
                                                        function () {
                                                                $(this).css("background-color","#d9edf7");
                                                                $(this).css('cursor','pointer');
                                                        },
                                                        function () {
                                                                $(this).css("background-color","white");
                                                                $(this).css('cursor','auto');
                                                        }
                                                );
                                                $("#resolus tbody tr").click(function () {
                                                      $("#popupModal iframe").attr({'src':"../public/js/admin_detail.php?id="+$(this).find('td:first').text()+"&solution=1",

                                                                                          'height': 750,
                                                                                          'width': 900});
                                                   $("#popupModal").css("display", "block");

                                                   // mapopup("admin_detail.php?id="+$(this).find('td:first').text()+"&solution=1");
                                                } );
                                            },


                                        "fnInitComplete":function() {
    
                                                $('.rech').click(function(){
                                                myTable.fnFilter($('.dataTables_filter :text').val());    
                                                });
                                                $('.dataTables_filter :text')
                                                    .unbind('keypress keyup')
                                                    .bind('keypress', function(e){
                                                    if (e.keyCode != 13) return;
                                                    myTable.fnFilter($(this).val());
                                                    });
                                                },
                                                "oLanguage": { 
                                                "sProcessing":   "Traitement en cours...",
                                                "sLengthMenu":   "Nombre de lignes par page: _MENU_",
                                                //"sLengthMenu":   "",
                                                "sZeroRecords":  "Aucun élément à afficher",
                                                //"sInfo": "Affichage de l'�lement _START_ � _END_ sur _TOTAL_ �l�ments",
                                                "sInfo": "",
                                                //"sInfo": "",
                                                //"sInfoEmpty": "Affichage de l'�lement 0 � 0 sur 0 �l�ments",
                                                "sInfoEmpty": "",
                                                //"sInfoFiltered": "(filtr� de _MAX_ �l�ments au total)",
                                                "sInfoFiltered": "",
                                                "sInfoPostFix":  "",
                                                "sSearch":       "Rechercher:",
                                                "sUrl":          "",
                                                "oPaginate": {
                                                        "sFirst":    "<<",
                                                        "sPrevious": "< Précédent",
                                                        "sNext":     "Suivant >",
                                                        "sLast":     ">>"
                                                    }
                                                        }
                } );
            } );


 </script>
    

<!--<script type="text/javascript">
function requete_ajax(parameter,query) {

alert('yah ya rab ya wedi yaw'); 
 /* $.post('http://localhost/framework/public/js/requete_ajax.php?parameter="+parameter+"&query="+query+"&cond="+cond', {queryString: ""+inputString+""}, function(data){ // on envoie la valeur du champ texte dans la variable post queryString au fichier ajax.php
                if(data.length >0) {
                 
                    $('#autoSuggestionsList').html(data); // et on remplit la liste des donn�es
                }else{
                                   
                                }
            });*/*



  /*  if (query == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
         = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                
                
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","http://localhost/framework/public/js/requete_ajax.php?parameter="+parameter+"&query="+query+"&cond="+cond,true);
        xmlhttp.send();
    }*/


$.ajax({
    type: "Post",
    url: "http://localhost/framework/public/js/requete_ajax.php",
    data:{
       parameter: parameter,
       query: query,
       //cond: cond
    },
    async: true,
    cache: false,
    success: function(Result) {//le retour la est dans le parametre result et oui
        alert('yah ya rab ya wedi yaw');
     alecrt(Result);
     
    };
}​);​
}

$(document).ready( function () {
$(".colonne").click(function(){
 var select = $(this);
 var par=select.attr('par');
 var req=select.attr('req');
    alert(par);alert(req);

});
});
</script>-->



    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.js"></script>-->

   

    <!-- ================================================== -->


 <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
 

 <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="../public/js/menu/jquery.smartmenus.js"></script>

    <!-- SmartMenus jQuery Bootstrap Addon -->
    <script type="text/javascript" src="../public/js/menu/bootstrap/jquery.smartmenus.bootstrap.js"></script>



<!-- ils étaient ensemble avant -->
   <link rel="stylesheet" type="text/css"  src="../public/js/css/datatables.css"></script>
   <script type="text/javascript" src="../public/js/js/jquery.dataTables.js"></script>


    <link rel="stylesheet" type="text/css"  src="https://cdn.datatables.net/plug-ins/1.10.12/features/searchHighlight/dataTables.searchHighlight.css"></script>

   <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.12/features/searchHighlight/dataTables.searchHighlight.min.js"></script>
    <script type="text/javascript" language="javascript" src="../public/js/js/jquery.highlight-4.js"></script> 



  <!-- <script type="text/javascript">
$(document).ready( function () {
    var table = $('#incidents').DataTable();
 
    table.on( 'draw', function () {
        var body = $( table.table().body() );
 
        body.unhighlight();
        body.highlight( table.search() );  
    } );
} );

</script> -->

 <script type="text/javascript">
   /* $(document).ready(function() {

$("#fileInput").hover(function() {
    //alert('hover');
    $(this).css('cursor','auto');
}, function() {
    $(this).css('cursor','pointer');
});

        $("input:file").mouseover(function(){
            //alert('hover');
    $("input:file").css('cursor', 'pointer');
});
        // $('#fileInput').css('cursor', 'pointer');

         } );*/

</script>
   <script type="text/javascript">
    $(document).ready(function() {
    $('#incidents').DataTable( {
         "order": [[ 0, "desc" ]],
        "fnDrawCallback": function() {
                                                $('<div class="clear"></div>').insertAfter(".dataTables_filter");
                                                $('#incidents').removeHighlight();
                                                $("#incidents").highlight($("#incidents_filter :text").val());
                                            },
       // "searchHighlight": true;
     //destroy: true,
    "pagingType": "full_numbers",
    //"iDisplayStart": 20,
    //"iDisplayLength": 50,
    "language": {
    "lengthMenu": "Afficher _MENU_ lignes par page",
    "zeroRecords": "Aucun r&eacute;sultat trouv&eacute; - sorry",
    "info": "page _PAGE_ sur _PAGES_",
    "infoEmpty": "Aucun &eacute;l&eacute;ment &agrave; afficher",
    "infoFiltered": "(filtered from _MAX_ total records)",
	"aaSorting": [[ 0, "desc" ]],
        "sSearch":       "Rechercher:",
        "oPaginate": {
            "sFirst":    "<<",
            "sPrevious": "< Pr&eacute;c&eacute;dent",
            "sNext":     "Suivant >",
            "sLast":     ">>"
        }
    }
    } );

    }) ;
</script>

         
          <script type="text/javascript">
            $(document).ready(function () {
                $("#pbsalle").change(function () {
                    if ($(this).val() == 'autre') {
                        $("#autrepb").show();
                        $("#reco").hide();
                    } else if ($(this).val() == '422') {
                        $("#autrepb").hide();
                        $("#reco").show();
                    } else {
                        $("#autrepb").hide();
                        $("#reco").hide();
                    }

                });
                $("#mode").change(function () {
                    if ($(this).val() != 'none') {
                        $("#details").show();
                    }else{
                        $("#details").hide();
                    }
                });
                $('#form').submit(function(){
                    if($("#salle").val()=="-1"||$("#salle").val()==""){
                    alert('Veuillez sélectionner une salle !');
                    return false;
                    }
                    if($("#pbsalle").val()=="-1"){
                    alert('Veuillez sélectionner un problème !');
                    return false;
                    }
                    if($("#pbsalle").val()=="autre" && $("#autrepb").val()==""){
                    alert('Veuillez décrire votre problème !');
                    return false;
                    }
                    <?php
                    if ($_SESSION['statut'] == 2) {
                    ?>
                    if($("#mode").val()!="none" && ($("#detail").val()=="" || $("#detail").val()=="Détail intervention...")){
                    alert('Veuillez détailler l\'intervention !');
                    return false;
                    }
                    if($("#mode").val()!="none" && $("#duree").val()=="none"){
                    alert('Veuillez mentionner la durée de l\'intervention!');
                    return false;
                    }
                    <?php
                    }
                    ?>
                    return true;
                });
            });
        </script>

<script type="text/javascript">

  function changeinput(b,a)
    {
     //   alert('kjkj');
alert(a);alert(b);
       $(".input1").each(function() {
    $(this).val(a);
});
       $(".input2").each(function() {
    $(this).val(b);
});
   
}
    </script>

<script language="javascript" type="text/javascript">
function getPath() {
var Form = document.forms['form_upload'];
var inputName = Form.elements['file'].value;
var imgPath = inputName;
Form.elements['file_src'].value = imgPath;
}
</script>
<!-- ********************************************  CArtes **********************************************************-->


        <script type="text/javascript" >

$(document).ready(function(){
$("#fileInput").on("change", function(){
    $( ".label" ).remove();
   var file = this.files[0],
       fileName = file.name,
       fileSize = file.size;

        if(window.navigator.userAgent.indexOf("MSIE ")>0){
                                             //  $( "<span class='label' id='infoss'></span>" ).insertAfter( ".inner" );
                                              // $("#infoss").html(fileName);
                                                // if($.browser.msie){
                                             //  $(".dataTable").css("margin-top","-50px");
                                               }else{
                                              // $(".dataTable").css("margin-top","-20px");    
                                               $( "<span class='label label-info' id='upload-file-info'></span>" ).insertAfter( ".inner" );
                                               $("#upload-file-info").html(fileName);
                                               }
      // alert(fileName);
   //alert("Uploading: "+fileName+" @ "+fileSize+"bytes");
   //CustomFileHandlingFunction(file);
});
});

            function lookup3(inputString) {
                if (inputString.length == 0) { // si le champ texte est vide

                    $('#infos').hide();
                } else { // sinon
                    $.post("../public/js/ajaxcarte.php", {queryString: "" + inputString + "", cart: 1}, function (data) { // on envoie la valeur du champ texte dans la variable post queryString au fichier ajax.php
                        $('#infos').html(data);
                        $('#infos').show();
                    });
                }
            }
            $(document).ready(function () {
                var globalTimeout = null;
                $("input#inputStringCarte").keyup(function () {
                    if (globalTimeout != null) {
                        clearTimeout(globalTimeout);
                    }
                    globalTimeout = setTimeout(function () {
                        globalTimeout = null;
                        lookup3($("input#inputStringCarte").val());
                    }, 500);
                });
                $("input#inputStringCarte").bind('paste', (function () {
                    if (globalTimeout != null) {
                        clearTimeout(globalTimeout);
                    }
                    globalTimeout = setTimeout(function () {
                        globalTimeout = null;
                        lookup3($("input#inputStringCarte").val());
                    }, 500);
                }));
            });
        </script>


<!--/*****-->
        <script type="text/javascript">
    function lookup_et(inputString) {
        if(inputString.length == 0) { // si le champ texte est vide
            $('#suggestions').hide(); // on cache les suggestions
        } else { // sinon
            $.post("../public/js/ajaxetud.php", {queryString: ""+inputString+"",cart:1}, function(data){ // on envoie la valeur du champ texte dans la variable post queryString au fichier ajax.php
                if(data.length >0) {
                    $('#suggestions').show(); // si il y a un retour, on affiche la liste
                    $('#autoSuggestionsList').html(data); // et on remplit la liste des donn�es
                }else{
                                    $('#suggestions').show(); // si il n'y a un retour, on affiche un message
                                    $('#autoSuggestionsList').html('<p style="margin-top:90px;"><font color=red>Aucun résultat pour "'+inputString+'".</font></p>'); // et on remplit la liste des donn�es
                                }
            });
        }
    }
        
    

        function fill_et(thisValue) { // remplir le champ texte si une suggestion est cliquee
                var tab=thisValue.split(' | ');
        $('#inputStringg').val(tab[1]+' | '+tab[2]);
                if($('#inputStringg').val()!=""){
        $('#choix_utilisateur').val(tab[0]);
                }
        setTimeout("$('#suggestions').hide();", 200);
		$("#inputStringCarte").focus();
    }
    
    $(document).ready( function () {

             

                var globalTimeout = null;  
                $("input#inputStringg").keyup(function() {
                if (globalTimeout != null) {
                    clearTimeout(globalTimeout);
                }
                globalTimeout = setTimeout(function() {
                    globalTimeout = null;  
                    lookup_et($("input#inputStringg").val());
                }, 500);  
                });


        $("input#inputStringg").blur( function() { // si le champ texte perd le focus
            fill_et() 
        });
            
        $("input[name='mode']:radio" ).click( function() { // si le champ texte perd le focus
            if($('input[name=mode]:checked', '#myForm').val()=='manu'){
                            $('#carte').show();
                        }else{
                            $('#carte').hide();
                        }
        });        
             
    });
        function copyclipboard(intext) {
        window.clipboardData.setData('Text', intext);
        } 
</script>

        <!-- *************************************************************FIN CARTES*************************************************************-->
   
             
 





   <!-- ************************ DEBUT STATIQTIQUES ************************************-->
  <script type="text/javascript">
            //FONCTION DE DEBUT DE CHARGEMENT AJAX
            function startload(nb){
                if(nb){
                    if(nb==1){
                        $("#liste_annees").hide();
                        $("#liste_uf").hide();
                        $("#stats").hide();
                        $("#loader1").show();
                    }
                    if(nb==2){
                        $("#stats").hide();
                        $("#loader2").show();
                    }
                }else{
                    $("body").css("cursor", "progress");    
                }
            }

            //FONCTION DE DEBUT DE CHARGEMENT AJAX
            function endload(nb){
                if(nb){
                    if(nb==1){
                        $("#loader1").hide();
                        $("#liste_annees").show();
                        $("#liste_uf").show();
                    }
                    if(nb==2){
                        $("#loader2").hide();
                        $("#stats").show();
                    }
                }else{
                    $("body").css("cursor", "auto");    
                }
            }

            //AFFICHE LES STATS EN FONCTION DES FILTRES SELECTIONNES
            function ajaxstat (ecole,annee,nb,cfps) {
                var ec=""; 
                var an=""; 
                var nbload="";
                var dateBits1="";
                var dateBits2="";
                var dt1="";
                var dt2="";
                var tcfps=0;
                if($("#dtdebut").val()!=""){
                    dateBits1 = $("#dtdebut").val().split('/');
                    dt1=dateBits1[2] + '-' + dateBits1[1]+ '-' + dateBits1[0];
                }
                if($("#dtfin").val()!=""){
                    dateBits2 = $("#dtfin").val().split('/');
                    dt2=dateBits2[2] + '-' + dateBits2[1]+ '-' + dateBits2[0];
                }
                if(ecole){
                    ec=ecole;
                }
                if(annee){
                    an=annee;
                }
                if(nb){
                    nbload=nb
                }
                if(cfps){
                    tcfps=cfps;
                }
                startload(nbload);
                $.ajax({
                    url : '../public/js/req_stats.php', // La ressource cibl�e
                    type : 'POST', // Le type de la requ�te HTTP
                    data: "id_ecole="+ec+"&annee="+an+"&dtdebut="+dt1+"&dtfin="+dt2+"&cfps="+tcfps+"",      
                    dataType : 'html', // Le type de donn�es � recevoir, ici, du HTML.
                    success : function(code_html, statut){
                        $("#stats").html(code_html); // On passe code_html � jQuery() qui va nous cr�er l'arbre DOM !
                        endload(nbload);
                    },

                    error : function(resultat, statut, erreur){
                        alert(erreur);
                    },

                    complete : function(resultat, statut){
                        //$(document).unbind('change','#listesites');

                    }
                });
            }
            //**************************** FIN DE LA FONCTION AJAXSTAT ****************************************

            $(document).ready(function(){
                //ajaxstat (1,"A1",2);
                $(document).on('change', '#ecoles', function(){
                    if(($(this).val()!="-1")&&($(this).val()!="0")){
                        startload(1);
                        $("#liste_uf").hide();//******************************************* ADD ***************************************************
                        $.ajax({
                            url : '../public/js/liste_annees.php', // La ressource cibl�e
                            type : 'POST', // Le type de la requ�te HTTP
                            data: { ecoles: ""+$(this).val()+""},
                            dataType : 'html', // Le type de donn�es � recevoir, ici, du HTML.
                            success : function(code_html, statut){
                                $("#liste_annees").html(code_html);
                                endload(1);
                                $("#liste_uf").hide();
                            },
                            error : function(resultat, statut, erreur){
                                alert(erreur);
                            },

                            complete : function(resultat, statut){

                            }
                        });
                    }else if ($(this).val()=="0"){
                        ajaxstat ('','',2);
                        $("#liste_annees").hide();
                    }
                });
                $(document).on('change', '#poles', function(){
                    if(($(this).val()!="-1")&&($(this).val()!="0")){
                        startload(1);
                         $("#liste_annees").hide();//******************************************* ADD ***************************************************
                        $.ajax({
                            url : '../public/js/liste_uf.php', // La ressource cibl�e
                            type : 'POST', // Le type de la requ�te HTTP
                            data: { pole: ""+$(this).val()+""},
                            dataType : 'html', // Le type de donn�es � recevoir, ici, du HTML.
                            success : function(code_html, statut){
                                $("#liste_uf").html(code_html);
                                endload(1);
                                 $("#liste_annees").hide();
                            },
                            error : function(resultat, statut, erreur){
                                alert(erreur);
                            },

                            complete : function(resultat, statut){

                            }
                        });
                    }else if ($(this).val()=="0"){
                        ajaxstat ('','',2,1);
                        $("#liste_uf").hide();
                    }
                 });
                $(document).on('change', '#annees', function(){
                    if($(this).val()!="-1"){
                        ajaxstat ($("#ecoles").val(),$(this).val(),2);
                    }
                });
                $(document).on('change', '#ufs', function(){
                    if($(this).val()!="-1"){
                        ajaxstat ($("#poles").val(),$(this).val(),2,1);
                    }
                });
                $(document).on('click', '#btrefresh', function(){
                    if($('input[type=radio][name=institution]:checked').attr('value')=="ecoles"){
                        ajaxstat ($("#ecoles").val(),$("#annnees").val(),2);
                    }else if($('input[type=radio][name=institution]:checked').attr('value')=="cfps"){
                        ajaxstat ($("#poles").val(),$("#uf").val(),2,1);    
                    }else{
                        ajaxstat ("","",2,"all");
                    }
                });
                $('#institution1, #institution2, #institution3').click(function(){
                    if ($(this).val()=='ecoles'){
                        $("#stats").hide();
                        $("#listeecoles").show();
                        $("#liste_annees").show();
                        $("#listepoles").hide();
                        $("#liste_uf").hide();
                    }else if ($(this).val()=='cfps'){
                        $("#stats").hide();
                        $("#listepoles").show();
                        $("#liste_uf").show();
                        $("#listeecoles").hide();
                        $("#liste_annees").hide();
                    }else{
                        ajaxstat ("","",2,"all");
                        $("#stats").show();
                        $("#listepoles").hide();
                        $("#liste_uf").hide();
                        $("#listeecoles").hide();
                        $("#liste_annees").hide();
                    }
                })
                $(".logoinst").hover(
                function () {
                    $(this).css('cursor','pointer');
                },
                function () {
                    $(this).css('cursor','auto');
                }
            );
                $("#logoecoles").click(function(){
                    $('input[type=radio][name=institution]').val(['ecoles']);
                    $("#stats").hide();
                    $("#listeecoles").show();
                    $("#liste_annees").show();
                    $("#listepoles").hide();
                    $("#liste_uf").hide();
                });
                $("#logocfps").click(function(){
                    $('input[type=radio][name=institution]').val(['cfps']);
                    $("#stats").hide();
                    $("#listepoles").show();
                    $("#liste_uf").show();
                    $("#listeecoles").hide();
                    $("#liste_annees").hide();
                });
                $("#logoecolescfps").click(function(){
                    $('input[type=radio][name=institution]').val(['all']);
                    ajaxstat ("","",2,"all");
                    $("#stats").show();
                    $("#listeecoles").hide();
                    $("#liste_annees").hide();
                    $("#listepoles").hide();
                    $("#liste_uf").hide();
                });
            })
        </script>
        <script>
            $(function() {
                $( ".dt" ).datepicker({
                    changeMonth: true,
                    changeYear: true
                });
            });
        </script>



<!-- ************************ DEBUT STATIQTIQUES ************************************-->


 <!--  ************************************** MES_INFOS *************************************************** -->
        <script type="text/javascript">
            var formChanged = false;
            $(document).ready(function() {
                $("#ok").attr("disabled","disabled");
                $('#my_form input[type=text]').each(function () {
                    $(this).data('initial_value', $(this).val());
                });
                $('#my_form select').each(function () {
                    $(this).data('initial_value', $(this).val());
                });

                $('#my_form input[type=text]').bind('change paste', function() {
                    if ($(this).val() != $(this).data('initial_value')) {
                        $("#ok").removeAttr("disabled");
                    }else{
                        $("#ok").attr("disabled","disabled");
                    }
                });
                $('#my_form select').bind('change', function() {
                    if ($(this).val() != $(this).data('initial_value')) {
                        $("#ok").removeAttr("disabled");
                    }else{
                        $("#ok").attr("disabled","disabled");
                    }
                });
            });
        </script> 
        <script type="text/javascript" src="../public/js/meiomask.js" charset="utf-8" >
        </script>
        <script type="text/javascript" >
            (function($)
            {
                // call setMask function on the document.ready event
                $(function()
                {
                    $('input:text').setMask();
                }
            );
            })(jQuery);
        </script>
        <script type="text/javascript">
            function verifierMail (champ)
            {
                var str = champ.value;
                var regexp = new RegExp("^[a-zA-Z0-9_\\-\\.]{3,}@[a-zA-Z0-9\\-_]{2,}\\.[a-zA-Z]{2,4}$", "g");
                if (!regexp.test(str))
                {
                    alert("L'adresse e-mail n'est pas valide !");
                    champ.focus();
                    return false;
                }
                if (document.form_envoyer.type_voie.value == "-1")
                {
                alert("Veuillez renseigner le type de voie de l'adresse !");
                return false;
                }

                if ((document.form_envoyer.type_complement.value != "-1") && (document.form_envoyer.lib_comp.value == ""))
                {
                alert("Veuillez renseigner le libellé de la résidence ou du lotissement !");
                return false;
                }
                if ((document.form_envoyer.type_complement.value == "-1") && (document.form_envoyer.lib_comp.value != ""))
                {
                alert("Veuillez indiquer le type de complément d'adresse !");
                return false;
                }

                if ((document.form_envoyer.type_voie.value != "-1") && (document.form_envoyer.lib_voie.value == ""))
                {
                alert("Veuillez renseigner le libellé de la voie !");
                return false;
                }
                return true;
            }
            function modifadr(){
                $(".adr").removeAttr("disabled");
                $("#lienmodifadr").hide();
                $("#modifadr").val("1");
            }
        </script>

        <!-- ****************************************************************************************************************************-->
 <script type="text/javascript">
  $(document).ready(function() {
    $('#side li').mouseover(function(){
      $(this).addClass('hover');
    });
  $('#list li').mouseout(function(){
      $(this).removeClass('hover');
    });
    /*$(function() {
    $("#side").children("li").each(function() {
        $(this).mouseover(function() {
          alert('i am here');
        });
        $(this).mouseout(function () {
           
        });
    });
});​*/
 // jQuery('ul li').hover(function () { 
   // alert('i am here');  
    //   $(".rech").style.display="block";   
//}
});
</script>
<script> 
function focus_carte(){
$("#inputStringCarte").focus();
}
</script>
<script>
function c1()
 {
 if (document.getElementById('perdu1').checked) 
  {
      document.getElementById('perdu_options1').style.display = "" ;
  } else {
      document.getElementById('perdu_options1').style.display = "none" ;
  }


}
function c2()
{
   if (document.getElementById('perdu2').checked) 
  {
      document.getElementById('perdu_options2').style.display = "" ;
  } else {
      document.getElementById('perdu_options2').style.display = "none" ;
  }
}    

</script>
</head>
<body   onload="close_all_modal(); focus_carte()" style="padding-top:20px;">
<!--[if IE 8]><center><![endif]-->
<div class="container">

    <!--<img  class='img-responsive' src='../public/img/ecole.png';   width='100%'/>-->

<?php if($_SESSION['statut']==2) {
    echo "<img  class='img-responsive' src='../public/img/ecole.png';   width='100%'/>";
    include ('nav_techniciens.php'); 
    }else{
        if($_SESSION['statut']==3)
        {
        echo "<img  class='img-responsive' src='../public/img/ecole.png';   width='100%'/>";
        include ('nav_secretaires.php');
        }else if($_SESSION['statut']==1 || $_SESSION['statut']==0){
        echo "<img  class='img-responsive' src='../public/img/ecole_et.png';   width='100%'/>";
        include ('nav_etudiants.php');
        include (ROOT . DS . 'public' .DS . 'js'. DS . 'infos_users.php'); 
        }else if($_SESSION['statut']==4) {}
        }       
?> 






