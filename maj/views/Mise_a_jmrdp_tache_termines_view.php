<!DOCTYPE html>
<html lang="en">
<head>
   <?php include VIEWPATH.'includes/header.php'; ?>

   <style type="text/css">
      .my-card
      {
       position:absolute;
       left:40%;
       top:-20px;
       border-radius:50%;
    }
 </style>
 

</head>
<body class="dashboard dashboard_1">
 <div class="full_container">
    <div class="inner_container">

       <!-- Sidebar  -->
       <?php include VIEWPATH.'includes/navybar.php'; ?> 
       <!-- end sidebar -->


       <!-- right content -->
       <div id="content">
          <!-- topbar -->
          <?php include VIEWPATH.'includes/topbar.php'; ?> 
          <!-- end topbar -->




          <!-- dashboard inner -->
          <div class="midde_cont">
             <div class="container-fluid">
                <div class="row column_title">
                   <div class="col-md-12">
                      <div class="page_title">
                         <!-- <h2><?=$title?></h2> -->
                      </div>
                   </div>
                </div>
                <!-- row -->

                <?php

                $menu1="nav-link";
                $menu2="nav-link";
                $menu3="nav-link active";
                $menu4="nav-link";
                $menu5="nav-link";
                $menu6="nav-link";



                ?>

                <!-- <div class="col-md-12"> -->
                   <?php include VIEWPATH.'includes/menu_dashboard_view.php'; ?>
                   <!-- </div> -->

                   <div class="row column1">
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">

                           <div class="full price_table padding_infor_info">

                            <?php include VIEWPATH.'includes/menu_mise_a_jour.php';?>


                            <div class="row">
                              <div class="col-lg-12">
                                <?=$this->session->flashdata('message')?> 
                                <br><br>
                                <div class="table-responsive-sm">
                                   <h4></h4>
                                   <table id='mytable' class="table table-sm table-bordered table-hover table-striped" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true">
                                      <thead  class="font-weight-bold text-nowrap">
                                        <tr>

                                         <!-- <th  class="th-sm  text-black">ID</th> -->
                                         <th  class="th-sm  text-black">Service</th>
                                         <th  class="th-sm  text-black">Statut</th>
                                         <th  class="th-sm  text-blaclk">Soumisse le</th>
                                         <th  class="th-sm  text-blaclk">Soumisse par</th>
                                         <th class="th-sm  text-black"><?=lang('notaire_action') ?></th>
                                      </tr>
                                   </thead>

                                   <tbody> </tbody>

                                </table> 


                                <hr>
                             </div>
                          </div>
                       </div>


                    </div>
                 </div>
              </div>
              <!-- end row -->
           </div>
           <!-- footer -->
           <?php include VIEWPATH.'includes/legende.php' ?> 
        </div>
        <!-- end dashboard inner -->
     </div>
  </div></div></div>

  <?php include VIEWPATH.'includes/scripts_js.php'; ?>


</body>
</html>


<script>
   $(document).ready(function(){

      get_liste();

   }); 

</script>

<script type="text/javascript">

 function get_liste() { 

    var row_count ="1000000"; 
    $("#mytable").DataTable({      
      "destroy" : true,
      "processing":true,
      "serverSide":true,
      "order":[[0, 'desc' ]],
      "ajax":{
       url:'<?=base_url()?>index.php/maj/Mise_a_jmrdp/All_completed_tasks/',
       type:"POST",
    },
    lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
    pageLength: 10,
    "columnDefs":[{
       "targets":[],
       "orderable":false
    }],

    dom: 'Bfrtlip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ],

    dom: 'Bfrtlip',
    buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'  ],
    language: {
       "sProcessing":     "<?=lang('datatable_traitement') ?>",
       "sSearch":         " <?=lang('datatable_rechercher') ?>",
       "sLengthMenu":     "<?=lang('datatable_afficher') ?> _MENU_ <?=lang('datatable_elements') ?>",
       "sInfo":           "<?=lang('datatable_affichage_elements') ?> _START_ <?=lang('datatable_a') ?> _END_ <?=lang('datatable_sur') ?> _TOTAL_ <?=lang('datatable_elements') ?>",
       "sInfoEmpty":      "<?=lang('datatable_affichage_elements') ?> 0 <?=lang('datatable_a') ?> 0 <?=lang('datatable_sur') ?> 0 <?=lang('datatable_elements') ?>",
       "sInfoFiltered":   "(<?=lang('datatable_filtre') ?> _MAX_ <?=lang('datatable_elements_total') ?>)",
       "sInfoPostFix":    "",
       "sLoadingRecords": "<?=lang('datatable_loading') ?>",
       "sZeroRecords":    "<?=lang('datatable_elements_afficher') ?>",
       "sEmptyTable":     "<?=lang('datatable_donne_disponible') ?>",
       "oPaginate": {
        "sFirst":      "<?=lang('datatable_premier') ?>",
        "sPrevious":   "<?=lang('datatable_precedent') ?>",
        "sNext":       "<?=lang('datatable_suivant') ?>",
        "sLast":       "<?=lang('datatable_dernier') ?>"
     },
     "oAria": {
        "sSortAscending":  ": <?=lang('datatable_ordre_croissant') ?>",
        "sSortDescending": ": <?=lang('datatable_ordre_decroissant') ?>"
     }
  }
});
 }
</script>