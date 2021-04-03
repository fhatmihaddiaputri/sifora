<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
 <link href="<?php echo base_url('assets/login.css')?>" type="text/css" rel="stylesheet">
 <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css')?>" type="text/css" rel="stylesheet">

    <title>SISTEM INFORMASI PERSURATAN BINGANIS</title>
  </head>
  <body>
   
<div class="container" >
  <h2 class="text-center">SISTEM INFORMASI PERSURATAN BINGANIS</h2>
  <hr>

   <?php //echo $this->session->flashdata('msg');

   if(null !==$this->session->flashdata('msg') ):?>
      <div class="alert alert-success" role="alert">
  <?php echo $this->session->flashdata('msg');?>
      </div>
  <?php endif;?>

    <?php //echo $this->session->flashdata('msg');

   if(null !==$this->session->flashdata('error') ):?>
      <div class="alert alert-danger" role="alert">
  <?php echo $this->session->flashdata('error');?>
      </div>
  <?php endif;?>
   <form class="form-signin" action="<?php echo site_url('login/auth');?>" method="post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
    <div class="form-group">
      <label>Username</label>
      <div class="input-group">
          <div class="input-group-preprend"> 
              <div class="input-group-text"> <i class="fas fa-user"></i></div>  </div>
              <input type="email" name="email" class="form-control" placeholder="Masukkan email" required="true">
         
      </div>
    </div>
    <div class="form-group">
      <label>Password</label>
      <div class="input-group">
          <div class="input-group-preprend"> 
              <div class="input-group-text"> <i class="fas fa-unlock"></i></div>  </div> 
              <input type="password" name="password" class="form-control" placeholder="Masukkan password" required="true" >
         
      </div>
     
    </div>
    <div class="checkbox">
             <label>
               <input type="checkbox" value="remember-me"> Remember me
             </label>
           </div>
    <button class="btn btn-primary" type="submit">Sign in</button>
    <button class="btn btn-danger" type="reset">reset</button>
    <span><a href="<?php echo site_url('login/reset_view'); ?>">Lupa kata sandi?</a></span>
  </form>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>
