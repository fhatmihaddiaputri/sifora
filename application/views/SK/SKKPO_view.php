<main>
                    <div class="container-fluid">
                        <h1 class="mt-4">DAFTAR KELOMPOK SK KENAIKAN PANGKAT OTOMATIS</h1>


                        <?php //echo $this->session->flashdata('msg');

   if(null !==$this->session->flashdata('msg') ):?>
      <div class="alert alert-success" role="alert">
  <?php echo $this->session->flashdata('msg');?>
  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
      </div>
  <?php endif;
 if(null !==$this->session->flashdata('error') ):?>
      <div class="alert alert-danger" role="alert">
  <?php echo $this->session->flashdata('error');?>
  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
      </div>
  <?php endif;?>


                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('page/dashboard');?>">Dashboard </a></li>
                            <li class="breadcrumb-item active">DAFTAR KELOMPOK SK KENAIKAN PANGKAT OTOMATIS</li>
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
                                DAFTAR KELOMPOK SK KENAIKAN PANGKAT OTOMATIS
                            </div>
                            <div class="card-body">
                                <?php  //echo anchor('Pengguna/tambah',' <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user fa-sm mr-2"></i>Tambah Pengguna</button>') ?>



<!-- Button trigger modal -->
<!--
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-user fa-sm mr-2"></i>Tambah Group SK KENAIKAN PANGKAT OTOMATIS<?php //var_dump($jabatan); ?>
</button>
-->
<!-- Modal -->
<!--
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
</div>-->


 
<?php //array(18) { [2]=> array(2) { ["no_idx"]=> string(1) "3" ["count"]=> string(1) "0" } [3]=> array(2) { ["no_idx"]=> string(1) "1" ["count"]=> string(1) "0" } [4]=> array(2) { ["no_idx"]=> string(1) "2" ["count"]=> string(1) "0" } [5]=> array(2) { ["no_idx"]=> string(1) "4" ["count"]=> string(1) "0" } [6]=> array(2) { ["no_idx"]=> string(1) "5" ["count"]=> string(1) "0" } [7]=> array(2) { ["no_idx"]=> string(1) "6" ["count"]=> string(1) "0" } [8]=> array(2) { ["no_idx"]=> string(1) "8" ["count"]=> string(1) "1" } [9]=> array(2) { ["no_idx"]=> string(1) "7" ["count"]=> string(3) "257" } [10]=> array(2) { ["no_idx"]=> string(1) "9" ["count"]=> string(1) "0" } [11]=> array(2) { ["no_idx"]=> string(2) "10" ["count"]=> string(1) "0" } [12]=> array(2) { ["no_idx"]=> string(2) "11" ["count"]=> string(3) "205" } [13]=> array(2) { ["no_idx"]=> string(2) "12" ["count"]=> string(1) "0" } [14]=> array(2) { ["no_idx"]=> string(2) "13" ["count"]=> string(1) "0" } [15]=> array(2) { ["no_idx"]=> string(2) "14" ["count"]=> string(1) "0" } [16]=> array(2) { ["no_idx"]=> string(2) "15" ["count"]=> string(1) "0" } [17]=> array(2) { ["no_idx"]=> string(2) "16" ["count"]=> string(1) "0" } [18]=> array(2) { ["no_idx"]=> string(2) "17" ["count"]=> string(3) "656" } [19]=> array(2) { ["no_idx"]=> string(2) "18" ["count"]=> string(3) "657" } }
?>
 
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr> <th>No</th>
                                                 <th>No Group SK</th>
                                                   <th>Nama Group SK</th>
                                                <th>Tanggal</th>
                                                <th>Created Date</th> 
                                                <th>Jumlah Data</th>                                                    <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>No</th>
                                                <th>No Group SK</th>
                                                   <th>Nama Group SK</th>
                                                <th>Tanggal</th>
                                                <th>Created Date</th>  <th>Jumlah Data</th>                                                    <th>Action</th> 
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php  $no=1; foreach ($skkp as $sk): 
                                                ?>
                                                   
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $sk['sknoid']; ?></td>
                                                        <td><?php echo $sk['skdescr']; ?></td>
                                                        <td><?php echo $sk['skdate']; ?></td>
                                                        <td><?php echo $sk['createdate']; ?></td>

                                                        <?php
                                                            // menampilkan jumlah data pada group sk
 
                                                             $i=1;
                                                             foreach ($count as $c) {
                                                                $i++;
                                                               if($c['no_idx']===$sk['sknoid']){
                                                                    ?>
                                                                        <td><?php echo $c['count']; ?></td>
                                                                    <?php

                                                                }
                                                             }?>
                                                        
                                                        <td><?php echo anchor('SKKPO/sync/'.$sk['sknoid'],'<div class="btn btn-primary"><i class="fas fa-sync-alt"></i>Sinkronkan</div>') ?></td>
                                                        <!--<td onclick="javascript:return confirm('Anda yakin menghapus data ini?')"><?php// echo anchor('SKKP/drop/'.$sk['skpangkatnoid'],'<div class="btn btn-danger"><i class="fas fa-trash" data-toogle="tooltip" title="delete"></i></div>') ?></td>-->
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