<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

   <!-- <link href="<?php //echo base_url('assets/css/bootstrap.min.css')?>" type="text/css" rel="stylesheet">-->
    <link href="<?php echo base_url('assets/login.css')?>" type="text/css" rel="stylesheet">
	
	
  </head>
  <body>

<div class="container">
  <h4 class="text-center">FORM LOGIN</h4>
    <form>
    <div class="form-group">
      <label>Username</label>
      <input type="email" name="email" class="form-control" placeholder="Masukkan email" required="true">
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" placeholder="Masukkan password" required="true" >
    </div>

    <button class="btn btn-primary" type="submit">Sign in</button>

    <button class="btn btn-danger" type="submit">Sign in</button>
  </form>

</div>

      <!--
      <div class="container" >
       <div class="col-md-4 col-md-offset-4 col-md-4-center">
         <form class="form-signin" action="<?php echo site_url('login/auth');?>" method="post">
           <h2 class="form-signin-heading">Please sign in</h2>
           <?php echo $this->session->flashdata('msg');?>
           <label for="username" class="sr-only">Username</label>
           <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
           <label for="password" class="sr-only">Password</label>
           <input type="password" name="password" class="form-control" placeholder="Password" required>
           <div class="checkbox">
             <label>
               <input type="checkbox" value="remember-me"> Remember me
             </label>
           </div>
           <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> 
           <button class="btn btn-lg btn-danger btn-block" type="reset">Reset</button>
         </form>
       </div>
       </div> <!-- /container -->

    <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
  </body>
</html>
