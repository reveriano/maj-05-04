<div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="logo_section">
                           <a href="index.html"><img class="img-responsive" src="<?php echo base_url() ?>template/images/DTF_light_logo.png" alt="#" /></a>
                        </div>
                        <div class="right_topbar">
                           <div class="icon_info">
                              <ul>
                                 <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                              </ul>



<!-- 
                              <ul class="user_profile_dd">
                                 <li>
                                    <a class=""><?=$this->session->userdata('PMS_NOM').' '.$this->session->userdata('PMS_PRENOM')?></a>
                                
                                 </li>
                              </ul> -->

                              

                              <ul class="user_profile_dd">
                                 <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown"><span class="username"><?=$this->session->userdata('PMS_NOM').' '.$this->session->userdata('PMS_PRENOM')?></span></a>
                                    <div class="dropdown-menu">
                                       <a class="dropdown-item" href="#">Mon Profil</a>
                                       <a class="dropdown-item" href="#">Paramètres</a>
                                       <a style="color: red" class="dropdown-item" href="<?= base_url() ?>Login/do_logout"><span>Déconnexion </span> <i class="fa fa-sign-out"></i></a>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </nav>


               </div>