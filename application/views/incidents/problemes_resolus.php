<?php
// On active les sessions :
//session_start();

?>
<?php error_reporting(0); ?>
<div class="modal modal-wide" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="width: 920px;"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-modal-edit" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Détails incident :</h3>
      </div>
      <div class="modal-body">
         <iframe id="iframe" src="" style="zoom:0.9" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-modal-edit">Close</button>
        <!--<button type="button" class="btn btn-primary">Sign now!</button>-->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    
	
	
					
			<?php// include('../public/js/infos_users.php'); ?>
                   
         <div align="center"><h1> Incidents résolus </h1></div>

               
			<article class = "droite">
                <div id="dynamic">
				<table class="table table-striped table-bordered text-center datatable-class" cellspacing="0" width="100%" id="resoluspb">
                                    <thead>
					<tr >
                                            <th width="15%">Num incident</th>
                                            <th width="15%">Date Création</th>
                                            <th >Description problème</th>
                                            <th >Dernier dépannage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                    <td colspan="5" class="dataTables_empty">Chargement des données...</td>
                                            </tr>
                                    </tbody>
                </table>
                </div>		
			</article>

