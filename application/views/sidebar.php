<!-- Sidebar -->
<ul class="sidebar navbar-nav">
   <!-- <li class="nav-item <?php //echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php //echo site_url('upload/view_usulan') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Overview</span>
        </a>
    </li>-->
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'products' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Usulan</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('upload') ?>">Tambah Usulan</a>

            <a class="dropdown-item" href="<?php echo site_url('upload/view_usulan') ?>">Daftar Usulan</a> 

            <a class="dropdown-item" href="<?php echo site_url('upload/view_all') ?>">Daftar Usulan All</a> 
            <a class="dropdown-item" href="<?php echo site_url('upload/view_usul_by_statususul?satker=pn&status_usul=2') ?>">PN PENDING</a> 
                                           
          <a class="dropdown-item" href="<?php echo site_url('upload/view_usul_by_statususul?satker=pt&status_usul=2') ?>">PT PENDING</a> 
             <a class="dropdown-item" href="<?php echo site_url('upload/view_usul_by_statususul?satker=pn&status_usul=1') ?>">PN ACC</a>  
 
             <a class="dropdown-item" href="<?php echo site_url('upload/view_usul_by_statususul?satker=pt&status_usul=1') ?>">PT ACC</a>
             <a class="dropdown-item" href="<?php echo site_url('upload/view_usul_by_statususul?satker=pn&status_usul=3') ?>">PN EXPIRED</a>  
 
             <a class="dropdown-item" href="<?php echo site_url('upload/view_usul_by_statususul?satker=pt&status_usul=3') ?>">PT EXPIRED</a>
                    
     </li>
      
<!--
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Settings</span></a>
    </li>-->
</ul>
