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
                  <h2><?=$stage_title['STAGES']?></h2>
                </div>
              </div>
            </div>

            <?php

            $menu1="nav-link active";
            $menu2="nav-link";
            $menu3="nav-link";
            $menu4="nav-link";
            $menu5="nav-link";
            $menu6="nav-link";
            $menu7="nav-link";
            ?>

            <div class="row column1">
              <!-- <div class="row"> -->
              <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                  Service details
                </div>
                <div class="card-body">

                  <div class="row col-md-12">
                    <?php include 'sous_menu/sous_menu_traitement_mjar.php'; ?>
                  </div><br>

                  <!-- <div class="row">
                    <div class="col-sm-3">
                    <div class="card" style="width: 18rem;">
                      <img src="..." class="card-img-top" alt="...">
                      <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-8">
                    <div class="card">
                      <div class="card-header">
                        Featured
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                      </div>
                    </div>
                  </div>
                  </div> -->


                  <div class="row">
                    <div class="col-sm-3">
                      <div class="card">
                        <div class="card-body">
                          <!-- <h5 class="card-title">Special title treatment</h5> -->
                          <div class="col-sm-12">
                            <img class="img-thumbnail" src="<?=base_url('upload/avatar/avatar_male.png')?>">
                          </div>
                          
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <div class="card" style="width:100%;">
                        <div class="card-header">
                          User details
                          <!-- <button class="btn btn-secondary btn-sm" style="float:right;">Transferer</button> -->
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <!-- <th scope="col">#</th> -->
                                  <th scope="col">Nom</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Téléphone</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <!-- <th scope="row">1</th> -->
                                  <th scope="row"><?=$info['fullname']?></th>
                                  <th scope="row"><?=$info['email']?></th>
                                  <th scope="row"><?=$info['mobile']?></th>
                                </tr>

                              </tbody>
                            </table>
                          </li>
                         
                        </ul>
                      </div>
                    </div>

                  </div>
                   <br>


                   <div class="row">
                    <div class="col-sm-12">
                    <div class="list-group">
                      <a href="#" class="list-group-item list-group-item-action list-group-item-success">Paiement detail <?=$num_paiement?></a>
                      <a class="list-group-item list-group-item-action list-group-item-default">
                        <table class="">
                              <thead>
                                <tr>
                                  <!-- <th scope="col">#</th> -->
                                  <th scope="col">Date</th>
                                  <th scope="col">Montant</th>
                                  <th scope="col">Numéro</th>
                                  <th scope="col">Statut</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <!-- <th scope="row">1</th> -->
                                  <th scope="row"><?=date('d-m-Y',strtotime($payement['DATE_INSERTION']))?></th>
                                  <th scope="row"><?=$MONTANT_PAIE?></th>
                                  <th scope="row"><?=$payement['MENTION'];?></th>
                                  <th scope="row"><?=$status?></th>
                                </tr>

                              </tbody>
                            </table>
                        
                      </a>
                    </div>


                    <!-- <div class="col-sm-12">
                      <div class="card">
                        <h6 class="card-header">Paiement detail</h6>
                        <div class="card-body">
                         <div class="row">
                          <a href="#" class="list-group-item list-group-item-action list-group-item-success">This is a primary list group item</a>
                          <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">This is a secondary list group item</a>
                          <a href="#" class="list-group-item list-group-item-action list-group-item-success">This is a success list group item</a>
                          <a href="#" class="list-group-item list-group-item-action list-group-item-danger">This is a danger list group item</a>
                          
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
                </div>

                  <br>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card">
                      <h6 class="card-header">Téléchargements</h6>
                      <div class="card-body">
                        

                        <ul class="list-group">
                          <li class="list-group-item">Dapibus ac facilisis in</li>

                          
                          <li class="list-group-item list-group-item-primary">This is a primary list group item</li>
                          <li class="list-group-item list-group-item-secondary">This is a secondary list group item</li>
                          <li class="list-group-item list-group-item-success">This is a success list group item</li>
                          <li class="list-group-item list-group-item-danger">This is a danger list group item</li>
                          <li class="list-group-item list-group-item-warning">This is a warning list group item</li>
                          <li class="list-group-item list-group-item-info">This is a info list group item</li>
                          <li class="list-group-item list-group-item-light">This is a light list group item</li>
                          <li class="list-group-item list-group-item-dark">This is a dark list group item</li>
                        </ul>
                        
                      </div>
                    </div>
                    </div>
                  </div>

                  <br>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card">
                      <h6 class="card-header">Formulaire</h6>
                      <div class="card-body">
                        <!-- <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a> -->

                        <?php include'sous_menu/sous_menu_mise_a_jour_detail.php';?>


                      </div>
                    </div>
                    </div>
                  </div>



                  <!-- <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
 -->





                </div>
              </div>
              </div>
            <!-- </div> -->

            


            
            </div>

          <?php include VIEWPATH.'includes/legende.php' ?> 
          <!-- end dashboard inner -->
        </div>
      </div>
    </body>
</html>

<?php include VIEWPATH.'includes/scripts_js.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>








