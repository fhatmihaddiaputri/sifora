<main>
                    <div class="container-fluid">
                        <h1 class="mt-4">DAFTAR SK MUTASI <?php echo strtoupper($this->session->userdata('group_name')); ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('page/dashboard');?>">Dashboard </a></li>
                            <li class="breadcrumb-item active">DAFTAR KELOMPOK SK MUTASI <?php echo strtoupper($this->session->userdata('group_name')); ?></li>
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
                                DAFTAR KELOMPOK SK MUTASI <?php echo strtoupper($this->session->userdata('group_name')); ?>
                            </div>
                            <div class="card-body">
                                <?php  //echo anchor('Pengguna/tambah',' <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user fa-sm mr-2"></i>Tambah Pengguna</button>') ?>



<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-user fa-sm mr-2"></i>Tambah Group SK KENAIKAN PANGKAT<?php //var_dump($jabatan); ?>
</button>-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">FORM TAMBAH GROUP SK KENAIKAN PANGKAT</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
         <form method="POST" action="<?php echo base_url().'SKKP/tambah_aksi' ?>">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
            <div class="form-group"> 
                <label>Nama Group</label>
                <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Masukkan nama Group">
            </div>  
             <div class="form-group"> 
                <label>TMT Kenaikan Pangkat</label>
                <input type="Password"  class="form-control" name="user_password" id="user_password" placeholder="Masukkan password">
            </div> 
             <div class="form-group"> 
                <label>Email</label>
                <input type="text"  class="form-control"name="user_email" id="user_email" placeholder="Masukkan email">
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

<!-- end modal-->
<?php  if($this->session->userdata('level_name')==='Staf'){  //echo $stage[0]['start_stage'];
   echo anchor('SKMutasi_Hakim','<div class="btn btn-primary mb-2">Sinkronisasi Group SK Baru</div>'); 
}?>


                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>  <th>No</th>
                                                <th>No Group SK</th>
                                                 
                                                <th>Tanggal Rapat</th>
                                                <th>TPM/Rapim</th>
                                                <th>No SK</th>
                                                <th>Tgl SK</th>
                                                <th>Ket. Biaya</th> 
                                                <th>Created Date</th>                      
                                                <th>Keterangan</th>                                                         <th>Action</th>  <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>No</th>
                                                <th>No Group SK</th>
                                                 
                                                <th>Tanggal Rapat</th>
                                                <th>TPM/Rapim</th>
                                                <th>No SK</th>
                                                <th>Tgl SK</th>
                                                <th>Ket. Biaya</th> 
                                                <th>Created Date</th>                      
                                                <th>Keterangan</th>                               <th>Action</th>  <th>Action</th> 
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php  $no=1; foreach ($skmut as $sk): 
                                                ?>
                                                   
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $sk['skmutasinoid']; ?></td>
                                                        <td><?php echo $sk['tgl_tpm']; ?></td>
                                                        <td><?php echo $sk['jenis_rapat']; ?></td>
                                                        <td><?php echo $sk['nomor_sk']; ?></td>
                                                        <td><?php echo $sk['tgl_sk']; ?></td>
                                                        <td><?php echo $sk['nama_dipa']; ?></td>
                                                        <td><?php echo $sk['updated_date']; ?></td>
                                                        <td><?php echo $sk['desc']; ?></td>
                                                        <td><?php echo anchor('SKMutasi_Hakim/listDataGroup/'.$sk['skmutasinoid'],'<div class="btn btn-primary"><i class="fas fa-info-circle" data-toogle="tooltip" title="detail"></i></div>') ?></td>
                                                        <td onclick="javascript:return confirm('Anda yakin menghapus data ini?')"><?php  echo anchor('SKMutasi_Hakim/drop/'.$sk['skmutasinoid'],'<div class="btn btn-danger"><i class="fas fa-trash" data-toogle="tooltip" title="delete"></i></div>') ?></td>
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