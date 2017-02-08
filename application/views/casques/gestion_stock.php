<div class="fw-body">
    <div class="content">
        <h1 class="page_title">gestion du stock des casques :</h1>



<table align="center" width="100%">
<tr height ="50px">
 </tr>
	<tr valign ="top">
                
            <td align="LEFT" width="50%" class="menu" >
		<h2>Etat actuel :</h2><br /><br />
	
	<div class="row">
		<div class="col-lg-10 col-sm-6 col-xs-6"> <!-- class="col-lg-4 col-sm-3 col-xs-4 xs = extra small screens (mobile phones) sm = small screens (tablets) md = medium screens (some desktops) lg = large screens (remaining desktops) -->
		<table class="table">
			<thead>
			<tr>
				<th>Stock total actuel</th>
				<th>Stock de casques simples</th>
				<th>Stock de casques-micro</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td  class="warning"><?php echo $row;?></td>
				<td  class="danger"><?php  echo $rowS;?></td>
				<td  class="active"><?php  echo $rowM;?></td>
			</tr>
			</tbody>
		</table>
        </div>
        </div>
        </br>

        <div class="row">
		<div class="col-lg-10 col-sm-6 col-xs-6"> <!-- class="col-lg-4 col-sm-3 col-xs-4 xs = extra small screens (mobile phones) sm = small screens (tablets) md = medium screens (some desktops) lg = large screens (remaining desktops) -->
		<table class="table">
			<thead>
			<tr>
				<th>Total défaillants</th>
				<th>Casques simples défaillants</th>
				<th>Casques-micro défaillants</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td  class="warning"><?php echo $def;?></td>
				<td  class="danger"><?php  echo $defS;?></td>
				<td  class="active"><?php  echo $defM;?></td>
			</tr>
			</tbody>
		</table>
        </div>
        </div>



</td>
                
<td align="LEFT" width="50%" class="menu">
		<h2>Entrée de stock :</h2><br /><br />
		<form role="form" method="post" action="#" onsubmit="return verifcomplete(commentaire)">
			Casques simples à ajouter :<br />
			 <div class="row">
             <div class="form-group col-sm-6" id="user">
			<input class="form-control" type="text" name="entreestocksimple"><br />
			Casques-micro à ajouter :<br />
			<input class="form-control" type="text" name="entreestockmicro"><br />
			Date :<br />
			<input class="form-control dt" type="text"  onclick="displayDatePicker(this);" autocomplete='off' name="date" id="date" alt="date" class="{mask:'31/12/9999'}"/>			
			<!--<img src="../public/img/images/icone_calendrier.gif" onclick="displayDatePicker(date);" />-->
			<br />
			Commentaire :<br />
			<textarea class="form-control" name="commentaire"></textarea><br />
			</div>
			</div>
			<input class="btn btn-default" type="submit" name="valider" value="Mettre à jour">
		</form><br /><br />
		
</td></tr></TABLE>

<?php echo $string?>


</div>
</div>        