<!DOCTYPE html>
<html lang="en">
<head>
  <?php include VIEWPATH.'includes/header.php'; ?>


  <style>
    fieldset.scheduler-border {
      border: 1px groove #ddd !important;
      padding: 0 1.4em 1.4em 1.4em !important;
      margin: 0 0 1.5em 0 !important;
      -webkit-box-shadow:  0px 0px 0px 0px #000;
      box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
      font-size: 1.2em !important;
      font-weight: bold !important;
      text-align: left !important;
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
                  <!-- <h5 style="font-weight: bold;">Transfert de titre - </b></h5> -->
                </div>
              </div>
            </div>
            <!-- row -->
            <div class="row column1">
              <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">

                  <?php include VIEWPATH.'includes/menu_faire_tache_view.php'; ?>



                  <div class="full price_table padding_infor_info">
                    <div class="row">

                      <div class="col-md-12">
                       <div class="card">
                        <div class="card-body">
                         <h2 style="font-size:14px;" class="card-title"><?=$title?></h2>


                         <?php 

                         if ($ACTION_ID==3) 
                           {?>

                            <div class="row">
                              <div class="col-12">
                                <form  action="<?=base_url('index.php/maj/Mise_a_jmrdp/traiter/'.$MAJ_ID.'/'.$STAGE_ID.'/'.$ACTION_ID)?>" method="POST">
                                  <div class="form-body">
                                    <div class="row">

                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <div class="mb-3">
                                            <input type="hidden" name="ACTION_ID" value="<?=$ACTION_ID?>">
                                            <input type="hidden" name="STAGE_ID" value="<?=$STAGE_ID?>">
                                            <input type="hidden" name="MAJ_ID" value="<?=$MAJ_ID?>">
                                            <input type="hidden" name="NEXT_STAGE" value="<?=$next_stage['NEXT_STAGE']?>">



                                            <label class="form-label">Date de visite <span style="color: red;">*</span></label>
                                            <input type="date"  name="DATE_VISITE" class="form-control" value="<?=set_value('DATE_VISITE')?>">

                                            <?php echo form_error('DATE_VISITE', '<div class="text-danger">', '</div>'); ?>
                                            
                                          </div>

                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <div class="mb-3">

                                            <label class="form-label">Technicien <span style="color: red;">*</span></label>
                                            <select class="form-control" name="TECHNICIEN_ID">
                                              <option value="">Sélectionner</option>
                                              <?php 
                                              foreach ($agent as $key) 
                                              {
                                                if ($key['ID']==set_value('TECHNICIEN_ID')) {
                                                  echo "<option value=".$key['ID']." selected=''>".$key['AGENT']."</option>";
                                                }else{
                                                  echo "<option value=".$key['ID'].">".$key['AGENT']."</option>";
                                                }
                                              }
                                              ?>
                                            </select>
                                            <?php echo form_error('TECHNICIEN_ID', '<div class="text-danger">', '</div>'); ?>
                                          </div>

                                        </div>
                                      </div>


                                      <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary"><?=lang('button_save')?></button>
                                      </div>


                                    </div>
                                  </div>
                                </form>
                              </div>

                            </div>

                            <!--   -->



                          <?php }elseif($ACTION_ID==4){?>

                            <div class="row">
                              <div class="col-12">
                                <form id="design_form" enctype="multipart/form-data"  action="<?=base_url('index.php/maj/Mise_a_jmrdp/traiter/'.$MAJ_ID.'/'.$STAGE_ID.'/'.$ACTION_ID)?>" method="POST">
                                  <div class="form-body">
                                    <div class="row">

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <div class="mb-3">
                                            <input type="hidden" name="ACTION_ID" value="<?=$ACTION_ID?>">
                                            <input type="hidden" name="STAGE_ID" value="<?=$STAGE_ID?>">
                                            <input type="hidden" name="MAJ_ID" value="<?=$MAJ_ID?>">
                                            <input type="hidden" name="NEXT_STAGE" value="<?=$next_stage['NEXT_STAGE']?>">



                                            <label class="form-label">Rapport d'expertise <span style="color: red;">*</span></label>
                                            <input type="file" name="PATH_RAPPORT_ANALYSE" id="PATH_RAPPORT_ANALYSE" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" class="form-control">

                                            <?php echo form_error('PATH_RAPPORT_ANALYSE', '<div class="text-danger">', '</div>'); ?>
                                            
                                          </div>

                                        </div>
                                      </div>

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <div class="mb-3">

                                            <label class="form-label">Avis technique <span style="color: red;">*</span></label>
                                            <textarea class="form-control" name="AVIS_TECHNIQUE"><?=$AVIS_TECHNIQUE?></textarea>
                                            <?php echo form_error('AVIS_TECHNIQUE', '<div class="text-danger">', '</div>'); ?>
                                          </div>

                                        </div>
                                      </div>


                                      <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary"><?=lang('button_save')?></button>
                                      </div>


                                    </div>
                                  </div>
                                </form>
                              </div>

                            </div>

                            <?php 
                          }
                          elseif ($ACTION_ID==6) {?>

                           <div class="row">
                            <div class="card-body">
                              <div class="col-12">
                                <form id="televerser_form" enctype="multipart/form-data" action="<?=base_url('index.php/transfert/Traitement_Transfert_Titre_Foncier/traiter/'.$TRANSFER_TITRE_PROPRIETE_ID.'/'.$STATUT_ID)?>" method="POST">
                                  <div class="form-body">

                                    <input type="hidden" name="ACTION_ID" value="<?=$ACTION_ID?>">
                                    <input type="hidden" name="STAGE_ID" value="<?=$STAGE_ID?>">
                                    <input type="hidden" name="MAJ_ID" value="<?=$MAJ_ID?>">
                                    <input type="hidden" name="NEXT_STAGE" value="<?=$next_stage['NEXT_STAGE']?>">

                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="form-label"><?=lang('estimate_amount')?><span style="color: red;">*</span></label>
                                          <input type='text' value="<?=set_value('MONTAT_RAPPORT_EXPERTISE')?>" autocomplete="off"  autofocus class="form-control" data-provide="typeahead" id="MONTAT_RAPPORT_EXPERTISE"  name="MONTAT_RAPPORT_EXPERTISE">
                                          <!-- <input type="hidden" id="MONTAT_R_EXPERTISE" name="MONTAT_R_EXPERTISE"> -->
                                          <?php echo form_error('MONTAT_RAPPORT_EXPERTISE', '<div class="text-danger">', '</div>'); ?>
                                        </div>


                                      </div>

                                      <div class="col-md-12">
                                        <fieldset class="border p-2">
                                          <legend  class="w-auto" style="font-size: 15px;"><?=lang('superficie')?></legend>
                                          <div class="row">
                                            <div class="col-md-4">
                                             <div class="form-group">
                                              <label class="form-label">Ha</label>
                                              <input type='number' min="0" autocomplete="off"  autofocus class="form-control" data-provide="typeahead" value="<?=set_value('SUPERFICIE_EXPERTISE_HA')?>" id="SUPERFICIE_EXPERTISE_HA" name="SUPERFICIE_EXPERTISE_HA">

                                              <span class="help-block"></span>
                                            </div>

                                          </div>

                                          <div class="col-md-4">
                                           <div class="form-group">
                                            <label class="form-label">Ares</label>
                                            <input type='number' autocomplete="off" min="0"  autofocus class="form-control" data-provide="typeahead" value="<?=set_value('SUPERFICIE_EXPERTISE_ARE')?>" id="SUPERFICIE_EXPERTISE_ARE" name="SUPERFICIE_EXPERTISE_ARE">

                                            <span class="help-block"></span>
                                          </div>

                                        </div>

                                        <div class="col-md-4">
                                         <div class="form-group">
                                          <label class="form-label">Ca</label>
                                          <input type='number' value="<?=set_value('SUPERFICIE_EXPERTISE_CA')?>"  autocomplete="off" min="0" autofocus class="form-control" data-provide="typeahead" id="SUPERFICIE_EXPERTISE_CA" name="SUPERFICIE_EXPERTISE_CA">

                                          <span class="help-block"></span>
                                        </div>

                                      </div>
                                    </div>
                                  </fieldset>
                                </div>



                                <div class="col-md-12">
                                 <div class="form-group">
                                  <label class="form-label"><?=lang('report_expert')?><span style="color: red;">*</span></label>
                                  <input type='file' autocomplete="off" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" autofocus class="form-control" data-provide="typeahead" value="<?=set_value('PATH_RAPPORT_EXPERTISE')?>" id="PATH_RAPPORT_EXPERTISE" name="PATH_RAPPORT_EXPERTISE">
                                  <!-- <span class="help-block"></span> -->
                                  <?php echo form_error('PATH_RAPPORT_EXPERTISE', '<div class="text-danger">', '</div>'); ?>
                                </div>

                              </div>

                              <div class="col-md-12">
                               <div class="form-group">
                                <label class="form-label"><?=lang('comment')?> <span style="color: red;"></span></label>

                                <textarea class="form-control" id="COMMENTAIRE_RAPPORT_EXPERTISE" name="COMMENTAIRE_RAPPORT_EXPERTISE"><?=set_value('PATH_RAPPORT_EXPERTISE')?></textarea>
                                <span class="help-block"></span>
                              </div>

                            </div>
                            <div class="col-md-12">
                              <button type="submit" class="btn btn-primary"><?=lang('button_save')?></button>
                            </div>






                          </div>
                        </div>
                      </form>
                    </div>

                  </div>

                </div>

                <?php 
              }elseif ($ACTION_ID==7) {?>


                <div class="row">
                  <div class="col-12">
                    <form   action="<?=base_url('index.php/maj/Mise_a_jmrdp/traiter/'.$MAJ_ID.'/'.$STAGE_ID.'/'.$ACTION_ID)?>" method="POST">
                      <div class="form-body">
                        <input type="hidden" name="ACTION_ID" value="<?=$ACTION_ID?>">
                        <input type="hidden" name="STAGE_ID" value="<?=$STAGE_ID?>">
                        <input type="hidden" name="MAJ_ID" value="<?=$MAJ_ID?>">
                        <input type="hidden" name="NEXT_STAGE" value="<?=$next_stage['NEXT_STAGE']?>">
                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="mb-3">
                                <label class="form-label">Objet<span style="color: red;"></span></label>
                                <textarea name="OBJET_ATTESTATION" readonly class="form-control"><?=$objet?></textarea>
                              </div>

                            </div>
                          </div>


                          <div class="col-md-4">
                            <div class="form-group">
                              <div class="mb-3">
                                <label class="form-label">Terre parcelle<span style="color: red;">*</span></label>
                                <select class="form-control" name="TERRE_PARCELLE_ID">
                                  <option value="">Sélectionner</option>
                                  <?php 
                                  foreach ($terre_parcelle as $key) 
                                  {
                                    if ($key['TERRE_PARCELLE_ID']==set_value('TERRE_PARCELLE_ID')) {
                                    // code...
                                      echo "<option value=".$key['TERRE_PARCELLE_ID']." selected=''>".$key['DESC_TERRE_PARCELLE']."</option>";
                                    }else{
                                      echo "<option value=".$key['TERRE_PARCELLE_ID'].">".$key['DESC_TERRE_PARCELLE']."</option>";
                                    }

                                  }
                                  ?>
                                </select>
                                <?php echo form_error('TERRE_PARCELLE_ID', '<div class="text-danger">', '</div>'); ?>
                              </div>

                            </div>
                          </div>


                          <div class="col-md-4">
                            <div class="form-group">
                              <div class="mb-3">
                                <label class="form-label">Subdivisions<span style="color: red;">*</span></label>
                                <select class="form-control" name="PARTIE_ID">
                                  <option value="">Sélectionner</option>
                                  <?php 
                                  foreach ($parties as $key) 
                                  {
                                    if ($key['PARTIE_ID']==set_value('PARTIE_ID')) {
                                    // code...
                                      echo "<option value=".$key['PARTIE_ID']." selected=''>".$key['DESC_PARTIE']."</option>";
                                    }else{
                                      echo "<option value=".$key['PARTIE_ID'].">".$key['DESC_PARTIE']."</option>";
                                    }

                                  }
                                  ?>
                                </select>
                                <?php echo form_error('PARTIE_ID', '<div class="text-danger">', '</div>'); ?>
                              </div>

                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <div class="mb-3">
                                <label class="form-label">Dimensions<span style="color: red;">*</span></label>
                                <select class="form-control" name="EQUIVALENCE_ID">
                                  <option value="">Sélectionner</option>
                                  <?php 
                                  foreach ($equivalences as $key) 
                                  {
                                    if ($key['EQUIVALENCE_ID']==set_value('EQUIVALENCE_ID')) {
                                    // code...
                                      echo "<option value=".$key['EQUIVALENCE_ID']." selected=''>".$key['DESC_EQUIVALENCE']."</option>";
                                    }else{
                                      echo "<option value=".$key['EQUIVALENCE_ID'].">".$key['DESC_EQUIVALENCE']."</option>";
                                    }

                                  }
                                  ?>
                                </select>
                                <?php echo form_error('EQUIVALENCE_ID', '<div class="text-danger">', '</div>'); ?>
                              </div>

                            </div>
                          </div>




                          <div class="col-md-12">
                            <button type="submit" class="btn btn-primary"><?=lang('button_save')?></button>
                          </div>


                        </div>
                      </div>
                    </form>
                  </div>

                </div>
                


              <?php }
              elseif ($ACTION_ID==8) {?>


               <div class="row">
                <div class="col-12">
                  <form id="televerser_contre_form" enctype="multipart/form-data" action="<?=base_url('index.php/transfert/Traitement_Transfert_Titre_Foncier/traiter/'.$TRANSFER_TITRE_PROPRIETE_ID.'/'.$STATUT_ID)?>" method="POST">
                    <div class="form-body">
                      <input type="hidden" name="ACTION_ID" value="<?=$ACTION_ID?>">
                      <input type="hidden" name="DEPLACE_A" value="<?=$DEPLACE_A?>">
                      <div class="row">


                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="mb-3">
                              <label class="form-label"><?=lang('estimate_amount')?><span style="color: red;">*</span></label>
                              <input type='text' autocomplete="off"  autofocus class="form-control" data-provide="typeahead" id="MONTANT_RAPPORT_CONTRE_EXPERTISE" name="MONTANT_RAPPORT_CONTRE_EXPERTISE">
                              <?php echo form_error('MONTAT_RAPPORT_EXPERTISE', '<div class="text-danger">', '</div>'); ?>
                            </div>

                          </div>
                        </div>


                        <div class="col-md-12">
                          <fieldset class="border p-2">
                            <legend  class="w-auto" style="font-size: 15px;"><?=lang('superficie')?></legend>
                            <div class="row">
                              <div class="col-md-4">
                               <div class="form-group">
                                <label class="form-label">Ha</label>
                                <input type='number' min="0" autocomplete="off"  autofocus class="form-control" data-provide="typeahead" id="SUPERFICIE_CONTRE_EXPERTISE_HA" name="SUPERFICIE_CONTRE_EXPERTISE_HA">

                                <span class="help-block"></span>
                              </div>

                            </div>

                            <div class="col-md-4">
                             <div class="form-group">
                              <label class="form-label">Ares</label>
                              <input type='number' autocomplete="off" min="0"  autofocus class="form-control" data-provide="typeahead" id="SUPERFICIE_CONTRE_EXPERTISE_ARE" name="SUPERFICIE_CONTRE_EXPERTISE_ARE">

                              <span class="help-block"></span>
                            </div>

                          </div>

                          <div class="col-md-4">
                           <div class="form-group">
                            <label class="form-label">Ca</label>
                            <input type='number' autocomplete="off" min="0" autofocus class="form-control" data-provide="typeahead" id="SUPERFICIE_CONTRE_EXPERTISE_CA" name="SUPERFICIE_CONTRE_EXPERTISE_CA">

                            <span class="help-block"></span>
                          </div>

                        </div>
                      </div>
                    </fieldset>
                  </div>



                  <div class="col-md-12">
                    <div class="form-group">
                     <label class="form-label"><?=lang('report_contre_expert')?> <span style="color: red;">*</span></label>
                     <input type='file' autocomplete="off" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" autofocus class="form-control" data-provide="typeahead" id="PATH_RAPPORT_CONTRE_EXPERTISE" name="PATH_RAPPORT_CONTRE_EXPERTISE">
                     <span class="help-block"></span>
                   </div>

                 </div>

                 <div class="col-md-12">
                  <div class="form-group">
                   <label class="form-label"><?=lang('comment')?> <span style="color: red;"></span></label>

                   <textarea class="form-control" id="COMMENTAIRE_RAPPORT_CONTRE_EXPERTISE" name="COMMENTAIRE_RAPPORT_CONTRE_EXPERTISE"></textarea>
                   <span class="help-block"></span>
                 </div>

               </div>

               <div class="col-md-12">
                <button type="submit" class="btn btn-primary"><?=lang('button_save')?></button>
              </div>


            </div>
          </div>
        </form>
      </div>

    </div>


    <?php 

  }elseif ($ACTION_ID==9) {?>




   <form   action="<?=base_url('index.php/maj/Mise_a_jmrdp/traiter/'.$MAJ_ID.'/'.$STAGE_ID.'/'.$ACTION_ID)?>" method="POST">
    <div class="form-body">
      <input type="hidden" name="ACTION_ID" value="<?=$ACTION_ID?>">
      <input type="hidden" name="STAGE_ID" value="<?=$STAGE_ID?>">
      <input type="hidden" name="MAJ_ID" value="<?=$MAJ_ID?>">
      <input type="hidden" name="NEXT_STAGE" value="<?=$next_stage['NEXT_STAGE']?>">



      <div class="col-md-12">
        <fieldset class="border p-2">
          <legend  class="w-auto" style="font-size: 15px;"><?=lang('superficie')?></legend>
          <div class="row">
            <div class="col-md-4">
             <div class="form-group">
              <label class="form-label">Ha <span style="color: red;">*</span></label>
              <input type='number' min="0" autocomplete="off"  autofocus class="form-control" data-provide="typeahead" id="SUPERFICIE_PV_HA" name="SUPERFICIE_PV_HA">

               <?php echo form_error('SUPERFICIE_PV_HA', '<div class="text-danger">', '</div>'); ?>
            </div>

          </div>

          <div class="col-md-4">
           <div class="form-group">
            <label class="form-label">Ares <span style="color: red;">*</span></label>
            <input type='number' autocomplete="off" min="0"  autofocus class="form-control" data-provide="typeahead" id="SUPERFICIE_PV_ARE" name="SUPERFICIE_PV_ARE">

             <?php echo form_error('SUPERFICIE_PV_ARE', '<div class="text-danger">', '</div>'); ?>
          </div>

        </div>

        <div class="col-md-4">
         <div class="form-group">
          <label class="form-label">Ca <span style="color: red;">*</span></label>
          <input type='number' autocomplete="off" min="0" autofocus class="form-control" data-provide="typeahead" id="SUPERFICIE_PV_CA" name="SUPERFICIE_PV_CA">

           <?php echo form_error('SUPERFICIE_PV_CA', '<div class="text-danger">', '</div>'); ?>
        </div>

      </div>
    </div>
  </fieldset>
</div>





<div class="col-md-12">
  <div class="form-group">
   <label class="form-label"><?=lang('comment')?> <span style="color: red;">*</span></label>

   <textarea class="form-control" id="COMMENTAIRE" name="COMMENTAIRE"></textarea>
   <?php echo form_error('COMMENTAIRE', '<div class="text-danger">', '</div>'); ?>
 </div>

</div>

<div class="col-md-12">
  <button type="submit" class="btn btn-primary"><?=lang('button_save')?></button>
</div>


</div>
</div>
</form>
</div>

</div>


<?php 
}elseif ($ACTION_ID==10) {?>

 <div class="row">
  <div class="col-12">
    <form   action="<?=base_url('index.php/maj/Mise_a_jmrdp/traiter/'.$MAJ_ID.'/'.$STAGE_ID.'/'.$ACTION_ID)?>" method="POST">
      <div class="form-body">
        <input type="hidden" name="ACTION_ID" value="<?=$ACTION_ID?>">
        <input type="hidden" name="STAGE_ID" value="<?=$STAGE_ID?>">
        <input type="hidden" name="MAJ_ID" value="<?=$MAJ_ID?>">
        <input type="hidden" name="TARIF_ID" value="<?=$article['TARIF_ID']?>">
        <input type="hidden" name="NEXT_STAGE" value="<?=$next_stage['NEXT_STAGE']?>">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <div class="mb-3">
                <label class="form-label">Article<span style="color: red;"></span></label>
                <textarea name="DESCRIPTION_TARIF" readonly class="form-control"><?=$article['DESCRIPTION_TARIF']?></textarea>
              </div>

            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <div class="mb-3">
                <label class="form-label">Montant<span style="color: red;"></span></label>
                <input type="number" readonly name="MONTANT_PAIE" class="form-control" value="<?=$article['MONTANT_TARIF']?>">

              </div>

            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <div class="mb-3">
                <label class="form-label">No<span style="color: red;"></span></label>
                <input type="text" readonly class="form-control" name="MENTION" value="PMORC00<?=$MAJ_ID?>">
              </div>

            </div>
          </div>






          <div class="col-md-12">
            <button type="submit" class="btn btn-primary"><?=lang('button_save')?></button>
          </div>


        </div>
      </div>
    </form>
  </div>

</div>


<?php 
}
elseif($ACTION_ID==12) 
  {?>

    <div class="row">
      <div class="col-12">
        <form id="paiement_form" action="<?=base_url('index.php/transfert/Traitement_Transfert_Titre_Foncier/traiter/'.$TRANSFER_TITRE_PROPRIETE_ID.'/'.$STATUT_ID)?>" method="POST">
          <div class="form-body">
            <input type="hidden" name="ACTION_ID" value="<?=$ACTION_ID?>">
            <input type="hidden" name="DEPLACE_A" value="<?=$DEPLACE_A?>">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="mb-3">
                    <label class="form-label"><?=lang('comment')?> <span style="color: red;">*</span></label>
                    <textarea class="form-control" name="COMMENTAIRE_NOUVEAU_TITRE" id="COMMENTAIRE_NOUVEAU_TITRE"><?=set_value('COMMENTAIRE_NOUVEAU_TITRE')?></textarea>
                    <?php echo form_error('COMMENTAIRE_NOUVEAU_TITRE', '<div class="text-danger">', '</div>'); ?>
                  </div>

                </div>
              </div>

              <div class="col-md-12">
                <button type="submit" class="btn btn-primary"><?=lang('button_save')?></button>
              </div>






            </div>
          </div>
        </form>
      </div>
    </div>

    <?php
  }elseif ($ACTION_ID==14) {?>

    <div class="row">
  <div class="col-12">
    <form   action="<?=base_url('index.php/maj/Mise_a_jmrdp/traiter/'.$MAJ_ID.'/'.$STAGE_ID.'/'.$ACTION_ID)?>" method="POST">
      <div class="form-body">
        <input type="hidden" name="ACTION_ID" value="<?=$ACTION_ID?>">
        <input type="hidden" name="STAGE_ID" value="<?=$STAGE_ID?>">
        <input type="hidden" name="MAJ_ID" value="<?=$MAJ_ID?>">
        <input type="hidden" name="NEXT_STAGE" value="<?=$next_stage['NEXT_STAGE']?>">
        <div class="row">

          
          <div class="col-md-6">
            <div class="form-group">
              <div class="mb-3">
                <label class="form-label">Date<span style="color: red;">*</span></label>
                <input type="datetime-local" class="form-control" name="DATE_TF">
              </div>

            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <div class="mb-3">
                <label class="form-label">Commentaire<span style="color: red;"></span></label>
                <textarea name="COMMENTAIRE" class="form-control"></textarea>
              </div>

            </div>
          </div>


          




          <div class="col-md-12">
            <button type="submit" class="btn btn-primary"><?=lang('button_save')?></button>
          </div>


        </div>
      </div>
    </form>
  </div>

</div>




    <?php 
  }
  ?>










</div>
</div>
</div>



</div>
</div>



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





