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



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-user fa-sm mr-2"></i>Tambah Pengguna <?php //var_dump($jabatan); ?>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">FORM TAMBAH PENGGUNA</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
         <form method="POST" action="<?php echo base_url().'pengguna/tambah_aksi' ?>">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
               <div class="form-group"> 
                <label>NIP</label>
                <input type="text" class="form-control" name="nip" id="nip" required="true" placeholder="Masukkan nip">
            </div> 
            <div class="form-group"> 
                <label>Nama</label>
                <input type="text" class="form-control" name="user_name" id="user_name" required="true" placeholder="Masukkan nama">
            </div>  
             <div class="form-group"> 
                <label>Password</label>
                <input type="Password"  class="form-control" name="user_password" required="true" id="user_password" placeholder="Masukkan password">
            </div> 
             <div class="form-group"> 
                <label>Email</label>
                <input type="email"  class="form-control"name="user_email" required="true" id="user_email" placeholder="Masukkan email">
            </div> 

             <div class="form-group">
                <label>Jabatan</label>
                  <select class="form-control" name="user_id_jab">
                  <?php foreach($jabatan as $jab){ ?>
                  <option value="<?php echo $jab['id_jabatan']; ?>"><?php echo $jab['jabatan']; ?> - <?php echo $jab['group_name'];   ?>   </option>
                  <?php } ?>
                  </select> 
              </div>
            <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>



                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                 <th>No</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Password</th>
                                                <th>Email</th>
                                                <th>Jabatan</th> 
                                                <th>Group</th>                                                     <th>Action</th>                                                   <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>

                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Password</th>
                                                <th>Email</th>
                                                <th>Jabatan</th>
                                                <th>Group</th>                                                  <th>Action</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php  $no=1; foreach ($pengguna as $usr): 
                                                ?>
                                                   
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $usr['NIP']; ?></td>
                                                        <td><?php echo $usr['user_name']; ?></td>
                                                        <td><?php echo $usr['user_password']; ?></td>
                                                        <td><?php echo $usr['user_email']; ?></td>
                                                        <td><?php echo $usr['jabatan']; ?></td>
                                                        <td><?php echo $usr['group_name']; ?></td>
                                                        <td><?php echo anchor('Pengguna/edit/'.$usr['user_id'],'<div class="btn btn-primary"><i class="fas fa-edit" data-toogle="tooltip" title="edit"></i></div>') ?></td>
                                                        <td onclick="javascript:return confirm('Anda yakin menghapus data ini?')"><?php echo anchor('Pengguna/hapus/'.$usr['user_id'],'<div class="btn btn-danger"><i class="fas fa-trash" data-toogle="tooltip" title="delete"></i></div>') ?></td>
                                                    </tr>

                                            <?php endforeach; ?>
                                            
                                       
                                        </tbody>
                                    </table>
                                </div>

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