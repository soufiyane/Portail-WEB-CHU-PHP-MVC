
      
		<div class="row">
		<div class="col-lg-5 col-sm-3 col-xs-4"> <!-- class="col-lg-4 col-sm-3 col-xs-4 xs = extra small screens (mobile phones) sm = small screens (tablets) md = medium screens (some desktops) lg = large screens (remaining desktops) -->
		<table class="table">
			<thead>
			<tr>
				<th>Stock actuel (hors défaillantes)</th>
				<th>Défaillantes </th>
				<th>Perdues </th>
			</tr>
			</thead>
			<tbody>
			<tr> 
			    <td  class="active"><?php  echo mysqli_fetch_object($req)->NBR;?></td>
				<td  class="warning"><?php echo mysqli_fetch_object($reqdef)->NBR;?></td>
				<td  class="danger"><?php  echo mysqli_fetch_object($reqperd)->NBR;?></td>				
			</tr>
			</tbody>
		</table>
        </div>
        </div>

        <h2>Rechercher une carte:</h2>
        <div class="row">
		<div class="form-group col-sm-4" id="user">
        <input class="form-control" type='text' size='30' value='' name='num_carte' id='inputStringCarte'/><br />
        <span id='infos' style='display:none;'></span><br />
        </div>
        </div>


