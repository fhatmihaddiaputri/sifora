<main>
                    <div class="container-fluid">
                        <h1 class="mt-4">DAFTAR KELOMPOK SK MUTASI HAKIM</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('page/dashboard');?>">Dashboard </a></li>
                            <li class="breadcrumb-item active">DAFTAR KELOMPOK SK MUTASI</li>
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
                                DAFTAR KELOMPOK SK MUTASI HAKIM
                            </div>
                            <div class="card-body">
                                <?php  //echo anchor('Pengguna/tambah',' <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user fa-sm mr-2"></i>Tambah Pengguna</button>') ?>

                                 <?php if(null !==$this->session->flashdata('error') ):?>
                                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                   <?php echo $this->session->flashdata('error');?>
                                  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                              <?php endif;?>
                                 <?php if(null !==$this->session->flashdata('msg') ):?>
                                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                   <?php echo $this->session->flashdata('msg');?>
                                  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                              <?php endif;?>


<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-user fa-sm mr-2"></i>Tambah Group SK KENAIKAN PANGKAT<?php //var_dump($jabatan); ?>
</button>-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">FORM TAMBAH GROUP SK MUTASI</h5>
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



                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr> <th>No</th>
                                                 <th>No Group SK</th>
                                                 <th>Tgl TPM</th>
                                                <th>Tgl SK</th>
                                                 <th>Nomor SK</th>
                                                 <th>Keterangan</th>
                                                 <th>RAPIM/TPM</th>
                                                <th>Direktur</th>
                                                <th>Dirjen</th>
                                                
                                                <th>Jumlah SK</th> 
                                                <th>Biaya/Tidak</th>  
                                               <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                 <th>No Group SK</th>
                                                 <th>Tgl TPM</th>
                                                <th>Tgl SK</th>
                                                 <th>Nomor SK</th>
                                                 <th>Keterangan</th>
                                                 <th>RAPIM/TPM</th>
                                                <th>Direktur</th>
                                                <th>Dirjen</th>
                                                
                                                <th>Jumlah SK</th> 
                                                <th>Biaya/Tidak</th>  
                                               <th>Action</th> 
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php  $no=1; foreach ($skmut as $sk): 
                                                ?>
                                                   
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $sk['mutasinoid']; ?></td>
                                                        <td><?php echo $sk['tanggalotk']; ?></td>
                                                        <td><?php echo $sk['mutasidate']; ?></td>
                                                        <td><?php echo $sk['mutasinomor']; ?></td>
                                                        <td><?php echo $sk['mutasidescr']; ?></td>
                                                        <td><?php echo $sk['rapatpim']; ?></td>
                                                        <td><?php echo $sk['mutasidirtng']; ?></td>
                                                        <td><?php echo $sk['mutasidirjen']; ?></td>
                                                        

                                                        <!--[36]=> array(2) { ["mutasinoid"]=> string(2) "35" ["count"]=> string(3) "152" } }-->

                                                         <?php
                                                            // menampilkan jumlah data pada group sk
 
                                                           /*  $i=1;
                                                             foreach ($count as $c) {
                                                                $i++;
                                                               if($c['no_idx']===$sk['sknoid']){
                                                                    ?>
                                                                        <td><?php echo $c['count']; ?></td>
                                                                    <?php

                                                                }
                                                             }*/
                                                             ?>
                                                        <td><?php echo $sk['jumlahhakim']; ?></td>
                                                        <td><?php echo $sk['namadipa01']; ?></td>
                                                        <td><?php echo anchor('SKMutasi_Hakim_PN/sync/'.$sk['mutasinoid'].'/'.$sk['jumlahhakim'],'<div class="btn btn-primary"><i class="fas fa-sync-alt"></i>Sinkronkan</div>') ?></td>
                                                        <!--<td onclick="javascript:return confirm('Anda yakin menghapus data ini?')"><?php// echo anchor('SKKP/drop/'.$sk['skpangkatnoid'],'<div class="btn btn-danger"><i class="fas fa-trash" data-toogle="tooltip" title="delete"></i></div>') ?></td>-->
                                                    </tr>

                                            <?php endforeach; ?>
                                            
                                       <!--
array(35) { [0]=> array(27) { ["mutasinoid"]=> string(1) "9" ["tanggaltpm"]=> string(10) "2019-07-03" ["mutasidate"]=> string(10) "2019-07-23" ["mutasinomor"]=> string(26) "2502/DJU/SK/KP.04.5/7/2019" ["mutasidescr"]=> NULL ["mutasifiles"]=> string(6) "Grup 9" ["mutasidirjen"]=> string(14) "HERRI SWANTORO" ["mutasidirtng"]=> string(8) "HASWANDI" ["mutasidirjennip"]=> NULL ["mutasidirtngnip"]=> NULL ["mutasikplsubdir"]=> string(13) "J. KAMALUDDIN" ["mutasikplsubdirnip"]=> string(1) "-" ["namadipa01"]=> string(79) "Segala biaya yang bertalian dengan pemindahan ini tidak ditanggung oleh Negara" ["namadipa02"]=> NULL ["jumlahkata"]=> string(1) "6" ["jumlahdlmsk"]=> string(3) "287" ["jumlahcheck"]=> string(3) "287" ["statusupdate"]=> string(1) "Y" ["statusnoid"]=> string(1) "4" ["statusdate"]=> string(26) "2019-07-29 19:33:04.472865" ["createnoid"]=> string(2) "14" ["createdate"]=> string(23) "2019-07-04 14:42:07.578" ["updatenoid"]=> string(2) "14" ["updatedate"]=> string(23) "2019-07-04 14:42:09.135" ["lockflag"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL } 

                                       -->
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