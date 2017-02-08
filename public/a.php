<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <!--<script src="http://localhost/framework/public/js/html5shiv/dist/html5shiv.js">-->
    <title> khjkjhkjhk</title>
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/framework/public/css/bootstrap/dist/css/bootstrap.min.css">
 <script type="text/javascript">
    $(document).ready(function() {     
         $('a#bt1').click( function() {
            alert('dvsd');
         $("#textmes").val("ghgjg");
         });
         $('#bt2').click( function() {
         $("#textmes").val("ze");
         });
         $('#bt3').click( function() {
         $("#textmes").val("zsd");
         });

    });
    </script>

</head>
<body>

<ul class="list-inline">
										    <li><label for="sel1" id="labelmes">Mail Types: </label></li>
										    <li><a href="javascript:void(0)" id="bt1" data-toggle="tooltip" data-placement="top" title="Demande de recontact direct aprés solution"> 1 </a></li>
										    <li><a href="javascript:void(0)" id="bt2" data-toggle="tooltip" data-placement="top" title="Demande de recontact direct"> 2 </a></li>
										    <li><a href="javascript:void(0)" id="bt3" data-toggle="tooltip" data-placement="top" title="Demande de baisse de niveau de sécurité d'IE"> 3 </a></li>
										   </ul>
<textarea id="textmes" class = "form-control" rows = "3" name="message" id="message" ></textarea>

</body>
</html>										   