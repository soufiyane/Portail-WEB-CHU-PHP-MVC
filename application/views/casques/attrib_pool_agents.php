<div class="fw-body">
	<div class="content">
	<div align="left">
		<h1 class="page_title">Attribution à un Pool :</h1>
		<b>Attention cette attribution ne permet pas de rattacher un casque à un utilisateur..</b></br>
        <b>Elle ne doit être utilisé qu'en cas de mutualisation!!! </b></br>


            
		    <br>
			<form action='attrib_pool_agents' method='POST'>
			Nom du POOL :<br>
			<input style="width:300px" class="form-control" type='text' size='40' value='' name='agent' id='inputString' /><br><br>
                        
            Quantité de casques attribués :<br>
            <input style="width:300px" class="form-control" type='text' size='10' value='' name='qty' id='qty' />
			<br /><br />
			Formation concernée :<br />
			<select style="width:300px" class="form-control" name='formation'>
            <?php
			while($row=mysqli_fetch_array($req))
			{
			echo "<option value = $row[0]>$row[1]</option>";
			}
			?>
			</select><br /><br />
            <br />Confiés à :<br /><textarea style="width:300px" class="form-control" name='commentaire'></textarea><br /><br />
			<input class='btn btn-default' type='submit' name='attribuer_agent' value='Attribuer à un groupe'>
			</form>


	<?php 
    echo $string;
	?>

   

     	

</div>
</div>
</div>