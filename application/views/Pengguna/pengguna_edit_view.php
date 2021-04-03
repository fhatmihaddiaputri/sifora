<main>
                    <div class="container-fluid">
                        <h1 class="mt-4">DAFTAR PENGGUNA</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('page/dashboard');?>">Dashboard </a></li>
                            <li class="breadcrumb-item active">Daftar Pengguna</li>
                        </ol>
                        <div class="card mb-4">
                           <!-- <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>-->
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-user"></i><!--<i class="fas fa-table mr-1"></i>-->
                                DAFTAR PENGGUNA
                            </div>
                            <div class="card-body">
                                <?php  //echo anchor('Pengguna/tambah',' <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user fa-sm mr-2"></i>Tambah Pengguna</button>') ?>


<?php  foreach ($pengguna as $usr) :?>
    

 <form method="POST" action="<?php echo base_url().'pengguna/edit_aksi' ?>">
            <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $usr['user_id'];?>">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
              <div class="form-group"> 
                <label>NIP</label>
                <input type="text" class="form-control" name="nip" id="nip" required="true" placeholder="Masukkan nip" value="<?php echo $usr['NIP'];?>">
            </div> 
            <div class="form-group"> 
                <label>Nama</label>
                <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Masukkan nama" value="<?php echo $usr['user_name'];?>" required="true">
            </div>  
             <div class="form-group"> 
                <label>Password</label>
                <input type="Password"  class="form-control" name="user_password" required="true" id="user_password" placeholder="Masukkan password" value="<?php echo $usr['user_password'];?>">
            </div> 
             <div class="form-group"> 
                <label>Email</label>
                <input type="email"  class="form-control"name="user_email" required="true" id="user_email" placeholder="Masukkan email" value="<?php echo $usr['user_email'];?>">
            </div> 

             <div class="form-group">
                <label>Jabatan</label>
                  <select class="form-control" name="user_id_jab">
                  <?php foreach($jabatan as $jab){ ?>
                    <?php  if($usr['user_id_jab']===$jab['id_jabatan']){ ?>
                            <option value="<?php echo $jab['id_jabatan']; ?>" selected><?php echo $jab['jabatan']; ?> - <?php echo $jab['group_name'];   ?>   </option>
                    <?php  } ?>
                  <option value="<?php echo $jab['id_jabatan']; ?>"><?php echo $jab['jabatan']; ?> - <?php echo $jab['group_name'];   ?>   </option>
                  <?php } ?>
                  </select> 
              </div>
           
        <button type="submit" class="btn btn-primary">Simpan</button>
        <?php echo anchor('Pengguna','<div class="btn btn-danger">Batal</div>') ?>
        </form>


 <?php endforeach; ?>
                               
                            </div>
                        </div>
                    </div>
                </main>



                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Subdit Mutasi Panitera dan Jurusita 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>