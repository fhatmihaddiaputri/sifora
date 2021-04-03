
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

                            
                            <!-- menu untuk dirjen dan direktur dan staf dirjen-->
                            <?php //elseif($this->session->userdata('level_name')==='Dirjen'||$this->session->userdata('level_name')==='Direktur'):
                             if(($this->session->userdata('end_stage_name')==='')||($this->session->userdata('start_stage_name')!=='')):
                                  
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
                            
                            
                            <?php endif;
                            if($this->session->userdata('end_stage_name')!==''):?>
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

                             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#monitoring" aria-expanded="false" aria-controls="collapseLayoutsEnd">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Monitoring 
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





<!----------------------------------------------->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#monitoring" aria-expanded="false" aria-controls="monitoring">
                                <div class="sb-nav-link-icon"><i class="fas fa-mail-bulk"></i></div>
                                Monitoring <br/>[<?php echo $this->session->userdata('start_stage_name');?>]
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="monitoring" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                  <!--  <a class="nav-link" href="<?php //echo site_url('Surat/suratMasuk');?>">Mutasi Hakim</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#monitoringMutasiHakim" aria-expanded="false" aria-controls="monitoringMutasiHakim">
                                        Mutasi Hakim
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="monitoringMutasiHakim" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?php  echo site_url('SKKP/monitoringSK');?>">SK KP</a>

                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                    <!--<a class="nav-link" href="<?php //echo site_url('Surat/suratKeluar');?>">Mutasi Panitera dan Jurusita</a>-->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#monitoringMutasiPanitera" aria-expanded="false" aria-controls="monitoringMutasiPanitera">
                                        Mutasi Panitera dan Jurusita
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="monitoringMutasiPanitera" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?php echo site_url('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KP</a>

                                            <a class="nav-link" href="<?php  echo site_url('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));?>">SK KPO</a>
                                            <a class="nav-link" href="register.html">SK Mutasi</a>
                                            <a class="nav-link" href="password.html">Surat-surat</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <!--End Monitoring All-->

                           
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