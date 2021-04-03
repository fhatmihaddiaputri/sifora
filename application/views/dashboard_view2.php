<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
       <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css')?>" type="text/css" rel="stylesheet">
      <link href="<?php echo base_url('assets/admin.css')?>" type="text/css" rel="stylesheet">

    <title>Hello, world!</title>
  </head>
  <body>
 <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SELAMAT DATANG <?php echo $this->session->userdata('username');?> |<b> APLIKASI PERSURATAN KEPANITERAAN</b></a>
    
      <form class="d-flex ml-auto">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      <div class="icon"> 
        <h5><i class="fas fa-envelope mr-3" data-toggle="tooltip" title="Surat Masuk"></i>
            <i class="fas fa-bell mr-3" data-toggle="tooltip" title="notifikasi"></i>
           <a href="<?php echo site_url('login/logout');?>"> <i class="fas fa-sign-out-alt mr-3" data-toggle="tooltip" title="keluar"></i></a>
        </h5>
      </div>  
    </div>
  </div>
</nav>


<div class="row no-gutters mt-5"> 
    <div class="col-md-2 bg-dark mt-2 pr-3 pt-4">
  <ul class="nav flex-column">

               <!--ACCESS MENUS FOR ADMIN-->
   <?php if($this->session->userdata('level')==='1'):?>
       
    <li class="nav-item">
      <a class="nav-link active text-white" aria-current="page" href="#"><i class="fas fa-chart-line mr-2"></i> Dashboard</a><hr class="bg-secondary">
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#"><i class="far fa-envelope-open mr-2"></i> Daftar Surat Masuk</a><hr class="bg-secondary">
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#"><i class="fas fa-flag-checkered mr-2"></i> Daftar Laporan</a><hr class="bg-secondary">
    </li>

    <!-- menu untuk user level 2 -->
     <?php elseif($this->session->userdata('level')==='2'):?>
       <li class="nav-item">
      <a class="nav-link text-white" href="#"><i class="far fa-envelope-open mr-2"></i> Daftar Surat Masuk</a><hr class="bg-secondary">
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#"><i class="fas fa-flag-checkered mr-2"></i> Daftar Laporan</a><hr class="bg-secondary">
    </li>

     <!--menu untuk user level lain -->
      <?php else:?>
     <li class="nav-item">
      <a class="nav-link text-white" href="#"><i class="far fa-envelope-open"></i> Daftar Surat Masuk</a><hr class="bg-secondary">
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#"><i class="fas fa-flag-checkered"></i> Daftar Laporan</a><hr class="bg-secondary">
    </li>
     <?php endif;?>
      
  </ul>   


     </div>
    <div class="col-md-10 p-5 pt-4">
      <h3><i class="fas fa-chart-line m-2"></i> Dashboard</h3><hr>

      <div class="row text-white"> 
          <div class="card bg-info text-white m-5" style="width: 18rem;">
               <div class="card-body">
                <div class="card-body-icon"><i class="far fa-envelope-open mr-2"></i> </div>
                 <h5 class="card-title">JUMLAH SURAT MASUK</h5>
                 <div class="display-4"> 1.200</div>
                  <a href=""><p class="card-text">Lihat detail</p><i class="fas fa-angle-double-right ml-2"></i></a>
                  
                </div>
              </div>

 <div class="card bg-danger text-white m-5" style="width: 18rem;">
               <div class="card-body">
                <div class="card-body-icon"><i class="far fa-envelope-open mr-2"></i> </div>
                 <h5 class="card-title">JUMLAH LAPORAN</h5>
                 <div class="display-4"> 12</div>
                  <a href=""><p class="card-text">Lihat detail</p><i class="fas fa-angle-double-right ml-2"></i></a>
                  
                </div>
              </div>

            </div>  
        </div>

</div>  















    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/admin.js')?></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    
  </body>
</html>

