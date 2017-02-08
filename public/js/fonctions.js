    
    $(document).ready(function() {
    $('table.datatable-class').DataTable( {
    "pagingType": "full_numbers",
    "iDisplayStart": 20,
    "iDisplayLength": 50,
    "language": {
    "lengthMenu": "Afficher _MENU_ lignes par page",
    "zeroRecords": "Aucun r&eacute;sultat trouv&eacute; - sorry",
    "info": "page _PAGE_ sur _PAGES_",
    "infoEmpty": "Aucun &eacute;l&eacute;ment &agrave; afficher",
    "infoFiltered": "(filtered from _MAX_ total records)",
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

     
    



