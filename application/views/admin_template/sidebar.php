
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">SIFORA</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo site_url('login/logout');?>">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                           
                            <div class="sb-sidenav-menu-heading">Utama</div>
                            <a class="nav-link" href="<?php echo site_url('page/dashboard')//echo site_url('page/dashboard')?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <div class="sb-sidenav-menu-heading">Administrasi</div>

                            <!-- coba membuat priviledge admin-->
                            <?php if($this->session->userdata('level')==='1'):?>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitas" aria-expanded="false" aria-controls="collapseUtilitas">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Utilitas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseUtilitas" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo site_url('Pengguna');?>">Daftar Pengguna</a>
                                    <a class="nav-link" href="<?php echo site_url('Kategori');?>">Daftar Kategori Surat</a>
                                    <a class="nav-link" href="<?php echo site_url('Jabatan');?>">Daftar Jabatan</a>
                                    <a class="nav-link" href="<?php echo site_url('Priviledge');?>">Priviledge</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Daftar Surat All
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                  <!--  <a class="nav-link" href="<?php //echo site_url('Surat/suratMasuk');?>">Mutasi Hakim</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasiHakim" aria-expanded="false" aria-controls="menuMutasiHakim">
                                        Mutasi Hakim
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasiHakim" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                             <a class="nav-link" href="<?php  echo site_url('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KP</a>
                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a><a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                    <!--<a class="nav-link" href="<?php //echo site_url('Surat/suratKeluar');?>">Mutasi Panitera dan Jurusita</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasiPanitera" aria-expanded="false" aria-controls="menuMutasiPanitera">
                                        Mutasi Panitera dan Jurusita
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasiPanitera" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">

                                             <a class="nav-link" href="<?php  echo site_url('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KP</a>
                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <!-- menu untuk dirjen dan direktur dan staf dirjen-->
                            <?php //elseif($this->session->userdata('level_name')==='Dirjen'||$this->session->userdata('level_name')==='Direktur'):
                           //  elseif($this->session->userdata('group_name')==='All'):
                                  

                            ?>

                            <?php //menu untuk dirjen direktur dan staf dirjen
                             elseif($this->session->userdata('group_name')==='All'):
                                  //if($this->session->userdata('start_stage_name')!==''):

                            ?>
                             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Daftar Surat <br/>[<?php echo $this->session->userdata('start_stage_name');?>]
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                  <!--  <a class="nav-link" href="<?php //echo site_url('Surat/suratMasuk');?>">Mutasi Hakim</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasiHakim" aria-expanded="false" aria-controls="menuMutasiHakim">
                                        Mutasi Hakim
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasiHakim" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?php  echo site_url('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KP</a>
                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                    <!--<a class="nav-link" href="<?php //echo site_url('Surat/suratKeluar');?>">Mutasi Panitera dan Jurusita</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasiPanitera" aria-expanded="false" aria-controls="menuMutasiPanitera">
                                        Mutasi Panitera dan Jurusita
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasiPanitera" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?php echo site_url('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KP</a>

                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            
                            
                            <?php   if($this->session->userdata('end_stage_name')!==''):?>
                             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsEnd" aria-expanded="false" aria-controls="collapseLayoutsEnd">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Daftar Surat <br/>[<?php echo $this->session->userdata('end_stage_name');?>]
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsEnd" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                  <!--  <a class="nav-link" href="<?php //echo site_url('Surat/suratMasuk');?>">Mutasi Hakim</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasiHakimEnd" aria-expanded="false" aria-controls="menuMutasiHakimEnd">
                                        Mutasi Hakim
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasiHakimEnd" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?php echo site_url('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));?>">SK KP</a>

                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                    <!--<a class="nav-link" href="<?php //echo site_url('Surat/suratKeluar');?>">Mutasi Panitera dan Jurusita</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasiPaniteraEnd" aria-expanded="false" aria-controls="menuMutasiPaniteraEnd">
                                        Mutasi Panitera dan Jurusita
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasiPaniteraEnd" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?php echo site_url('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));?>">SK KP</a>
                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                             <?php  endif;?>
                             <!-- Monitoring All-->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#monitoringAll" aria-expanded="false" aria-controls="monitoringAll">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Monitoring 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="monitoringAll" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                  <!--  <a class="nav-link" href="<?php //echo site_url('Surat/suratMasuk');?>">Mutasi Hakim</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasiHakim" aria-expanded="false" aria-controls="menuMutasiHakim">
                                        Mutasi Hakim
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasiHakim" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?php echo site_url('SKKP_Hakim/monitoringSK');?>">SK KP</a>
                                             <a class="nav-link" href="<?php echo site_url('SKKPO_Hakim/monitoringSK');?>">SK KPO</a>
                                           
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                    <!--<a class="nav-link" href="<?php //echo site_url('Surat/suratKeluar');?>">Mutasi Panitera dan Jurusita</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasiPanitera" aria-expanded="false" aria-controls="menuMutasiPanitera">
                                        Mutasi Panitera dan Jurusita
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasiPanitera" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?php  echo site_url('SKKP/monitoringSK');//echo site_url('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KP</a>

                                            <a class="nav-link" href="<?php echo site_url('SKKPO/monitoringSK');// echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <!--End Monitoring All-->

                            <!-- menu untuk mutasi other user-->
                            <?php else:
                                if(($this->session->userdata('end_stage_name')!=='')&&($this->session->userdata('group_name')!=='All')){
                                ?>  
                             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Daftar Surat <br/>[<?php echo $this->session->userdata('start_stage_name');?>]
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                  <!--  <a class="nav-link" href="<?php //echo site_url('Surat/suratMasuk');?>">Mutasi Hakim</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasi" aria-expanded="false" aria-controls="menuMutasi">
                                        Mutasi <?php echo $this->session->userdata('group_name');?>
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasi" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?php echo site_url('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KP</a>

                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                  
                                </nav>
                            </div>


                              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsEnd" aria-expanded="false" aria-controls="collapseLayoutsEnd">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Daftar Surat <br/>[<?php echo $this->session->userdata('end_stage_name');?>]
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsEnd" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                  <!--  <a class="nav-link" href="<?php //echo site_url('Surat/suratMasuk');?>">Mutasi Hakim</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasiEnd" aria-expanded="false" aria-controls="menuMutasiEnd">
                                        Mutasi <?php echo $this->session->userdata('group_name');?>
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasiEnd" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                             <?php if($this->session->userdata('group_name')==='Panitera'){?>
                                            <a class="nav-link" href="<?php echo site_url('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));?>">SK KP</a>
                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('end_stage'));?>">SK KPO</a>
                                             <a class="nav-link" href="#">SK Mutasi</a>
                                            <a class="nav-link" href="#">Surat-surat</a>
                                        <?php }else{?>

                                            <!--Menu Mutasi Hakim-->
                                            <a class="nav-link" href="<?php echo site_url('SKKP_Hakim/viewDataSK/'.$this->session->userdata('end_stage'));?>">SK KP</a>

                                            <a class="nav-link" href="<?php  echo site_url('SKKPO_Hakim/viewDataSK/'.$this->session->userdata('end_stage'));?>">SK KPO</a>
                                             <a class="nav-link" href="#">SK Mutasi</a>
                                            <a class="nav-link" href="#">Surat-surat</a>

                                       <?php }?>
                                           
<!--

                                            <a class="nav-link" href="<?php echo site_url('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));?>">SK KP</a>

                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('end_stage'));?>">SK KPO</a>
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>-->
                                        </nav>
                                    </div>
                                  
                                </nav>
                            </div>
                            <!-- tambahkan menu sesuai level dan group user-->          
                             <?php }else{?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Daftar Surat <br/>[<?php echo $this->session->userdata('start_stage_name');?>]
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                  <!--  <a class="nav-link" href="<?php //echo site_url('Surat/suratMasuk');?>">Mutasi Hakim</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasi" aria-expanded="false" aria-controls="menuMutasi">
                                        Mutasi <?php echo $this->session->userdata('group_name');?>
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasi" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <!--Menu Mutasi PAnitera-->
                                        <?php if($this->session->userdata('group_name')==='Panitera'){?>
                                            <a class="nav-link" href="<?php echo site_url('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KP</a>
                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                             <a class="nav-link" href="#">SK Mutasi</a>
                                            <a class="nav-link" href="#">Surat-surat</a>
                                        <?php }else{?>

                                            <!--Menu Mutasi Hakim-->
                                            <a class="nav-link" href="<?php echo site_url('SKKP_Hakim/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KP</a>

                                            <a class="nav-link" href="<?php  echo site_url('SKKPO_Hakim/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                             <a class="nav-link" href="#">SK Mutasi</a>
                                            <a class="nav-link" href="#">Surat-surat</a>

                                       <?php }?>
                                           
                                        </nav>
                                    </div>
                                  
                                </nav>
                            </div>
                            <?php }
                            ?>

                                    <!-- Monitoring All-->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#monitoring" aria-expanded="false" aria-controls="monitoring">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Monitoring <br/>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="monitoring" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                  <!--  <a class="nav-link" href="<?php //echo site_url('Surat/suratMasuk');?>">Mutasi Hakim</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuMutasiHakimMonitoring" aria-expanded="false" aria-controls="menuMutasiHakimMonitoring">
                                        Mutasi <?php echo $this->session->userdata('group_name');?>
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="menuMutasiHakimMonitoring" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                           <?php if($this->session->userdata('group_name')==='Panitera'){?>
                                            <a class="nav-link" href="<?php echo site_url('SKKP/monitoringSK');?>">SK KP</a>
                                            <a class="nav-link" href="<?php echo site_url('SKKPO/monitoringSK');?>">SK KPO</a>
                                             <a class="nav-link" href="#">SK Mutasi</a>
                                            <a class="nav-link" href="#">Surat-surat</a>
                                        <?php }else{?>

                                            <!--Menu Mutasi Hakim-->
                                            <a class="nav-link" href="<?php echo site_url('SKKP_Hakim/monitoringSK');?>">SK KP</a>
                                             <a class="nav-link" href="<?php echo site_url('SKKPO_Hakim/monitoringSK');?>">SK KPO</a>
                                             <a class="nav-link" href="#">SK Mutasi</a>
                                            <a class="nav-link" href="#">Surat-surat</a>

                                       <?php }?>
                                        </nav>
                                    </div>
                                    <!--<a class="nav-link" href="<?php //echo site_url('Surat/suratKeluar');?>">Mutasi Panitera dan Jurusita</a>-->
                                    
                                </nav>
                            </div>
                            <!--End Monitoring All-->

                            <?php
                         endif;?>
                            
                           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Setting
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                           <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>


                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $this->session->userdata('username');?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">