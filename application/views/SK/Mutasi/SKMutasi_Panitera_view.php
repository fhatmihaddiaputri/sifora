<main>
                    <div class="container-fluid">
                        <h1 class="mt-4">DAFTAR SK MUTASI KEPANITERAAN</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('page/dashboard');?>">Dashboard </a></li>
                            <li class="breadcrumb-item active">DAFTAR SK MUTASI KEPANITERAAN</li>
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
                                <i class="fas fa-mail-bulk"></i><!--<i class="fas fa-table mr-1"></i>-->
                                DAFTAR SK MUTASI KEPANITERAAN 



                            </div>
                            <div class="card-body">
                              <?php if(null !==$this->session->flashdata('msg') ):?>
                                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                   <?php echo $this->session->flashdata('msg');?>
                                  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                              <?php endif;?>
                                 <?php if(null !==$this->session->flashdata('error') ):?>
                                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                   <?php echo $this->session->flashdata('error');?>
                                  <button type="button" class="btn-danger" data-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                              <?php endif;?>

                             

                            

<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-user fa-sm mr-2"></i>SINKRON DATA SK BARU<?php //var_dump($jabatan); ?>
</button>-->

<!-- Modal -->
<?php 
$no= 1;
foreach ($skmut as $sk) :
  $no++;
 
?>

<div class="modal fade" id="revisi<?php echo $sk['id_sk'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewHistory">Detail History SK Kenaikan Pangkat</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
         <form method="POST" action="<?php echo base_url().'SKMutasi_Panitera/revisiSK' ?>">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
            <input type="hidden" name="stage" id="stage" value="<?php echo $sk['id_stage']?>">
            <div class="form-group"> 
                <label>ID Group</label>
                <input type="text" readonly="true" class="form-control" name="id_group" value="<?php echo $sk['id_group_sk']?>" id="id_group">
            </div>  
             <div class="form-group"> 
                <label>ID SK</label>
                <input type="text" readonly="true" class="form-control" name="id_sk" id="id_sk"  value="<?php echo $sk['id_sk']?>" >
            </div> 
             <div class="form-group"> 
                <label>Keterangan Revisi </label>
                <input type="textarea"  class="form-control"name="keterangan" id="keterangan" placeholder="Masukkan Keterangan Revisi">
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
<?php endforeach; ?>

<!-- end modal-->



<!-- Modal -->
<?php 
$no= 1;
foreach ($skmut as $sk) :
  $no++;
 
?>

<div class="modal fade" id="signSK<?php echo $sk['id_sk'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewHistory">Persetujuan Penandatanganan SK Mutasi</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
         <form method="POST" action="<?php echo base_url().'Tte/signSKMutasiPanitera' ?>">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
            <input type="hidden" name="stage" id="stage" value="<?php echo $sk['id_stage']?>">
            <div class="form-group"> 
                <label>ID Group</label>
                <input type="text" readonly="true" class="form-control" name="id_group" value="<?php echo $sk['id_group_sk']?>" id="id_group">
            </div>  
             <div class="form-group"> 
                <label>ID SK</label>
                <input type="text" readonly="true" class="form-control" name="id_sk" id="id_sk"  value="<?php echo $sk['id_sk']?>" >
            </div> 
             <div class="form-group"> 
                <label>NIP</label>
                <input type="text" readonly="true" class="form-control" name="nip" id="nip"  value="<?php echo $sk['nip']?>" >
            </div>
            <div class="form-group"> 
                <label>Nama</label>
                <input type="text" readonly="true" class="form-control" name="nama" id="nama"  value="<?php echo $sk['nama']?>" >
            </div>
             <div class="form-group"> 
                <label>Passphrase</label>
                <input type="text"  class="form-control"name="passphrase" id="passphrase" placeholder="Masukkan PassPhrase">
            </div> 

            <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tanda Tangani</button>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

<!-- end modal-->

<?php 
$no= 1;
foreach ($skmut as $sk) :
  $no++;
 
?>
<div class="modal fade" id="signAll<?php echo $sk['id_sk'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewHistory">Persetujuan Penandatanganan SK Mutasi</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
         <form method="POST" action="<?php echo base_url().'Tte/signSKMutasiPaniteraLain' ?>">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
            <input type="hidden" name="id_group" id="id_group" value="<?php echo $skgr['skmutasinoid']?>">
            <div class="form-group"> 
                <label>Nomor SK</label>
                <input type="text" readonly="true" class="form-control" name="nomor_sk" value="<?php echo $skgr['nomor_sk']?>" id="nomor_sk">
            </div>  
             <div class="form-group"> 
                <label>Tanggal SK</label>
                <input type="text" readonly="true" class="form-control" name="tgl_sk" id="tgl_sk"  value="<?php echo $skgr['tgl_sk']?>" >
            </div> 
             <div class="form-group"> 
                <label>Tanggal Rapat</label>
                <input type="text" readonly="true" class="form-control" name="tgl_tpm" id="tgl_tpm"  value="<?php echo $skgr['tgl_tpm']?>" >
            </div>
            <div class="form-group"> 
                <label>Ket. Biaya</label>
                <textarea class="form-control" readonly="true" id="exampleFormControlTextarea1" name="nama_dipa" rows="3"><?php echo $skgr['nama_dipa']?></textarea>
              <!--  <input type="text" readonly="true" class="form-control" name="nama_dipa" id="nama_dipa"  value="<?php echo $skgr['nama_dipa']?>" >-->
            </div>
             <div class="form-group"> 
                <label>Passphrase</label>
                <input type="textarea"  class="form-control"name="passphrase" id="passphrase" placeholder="Masukkan PassPhrase">
            </div> 

            <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tanda Tangani</button>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>



<!-- end modal-->




<?php  if($this->session->userdata('level_name')==='Staf'){  //echo $stage[0]['start_stage'];
   echo anchor('SKMutasi_Panitera_2','<div class="btn btn-lg btn-primary mb-2">Tambah SK Baru</div>'); 
}?>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr><th>No</th>
                                                <th>NIP</th>
                                                <th>Nama</th>      
                                                <th>Jab. Lama</th>
                                                <th>Satker Lama</th>
                                                <th>Jab. Baru</th> 
                                                <th>Satker Baru</th>
                                                <th>Status</th> 
                                                <th>Keterangan</th> 
                                                <th>Created Date</th> 
                                                <th>Updated user</th>   
                                                <th>History</th>
                                                 <th>Salinan</th>
                                                 <th>Petikan</th>
                                                <?php  if($this->session->userdata('level_name')==='Staf'){?> 
                                                <th>Action</th> <th>Action</th>
                                                <?php }else{?> 
                                                <th>Action</th>  
                                                <th>Action</th>   <?php }?> 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                               <th>No</th>
                                                <th>NIP</th>
                                                <th>Nama</th>      
                                                <th>Jab. Lama</th>
                                                <th>Satker Lama</th>
                                                <th>Jab. Baru</th> 
                                                <th>Satker Baru</th>
                                                <th>Status</th> 
                                                <th>Keterangan</th> 
                                                <th>Created Date</th> 
                                                <th>Updated user</th>   
                                                <th>History</th>
                                                 <th>Salinan</th>
                                                 <th>Petikan</th>
                                                <?php  if($this->session->userdata('level_name')==='Staf'){?> 
                                                <th>Action</th> <th>Action</th>
                                                <?php }else{?> 
                                                <th>Action</th>  
                                                <th>Action</th>   <?php }?> 
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php  $no=1; foreach ($skmut as $sk): 

                                                ?>
                                                   
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $sk['nip']; ?></td>
                                                        <td><?php echo $sk['nama']; ?></td>
                                                        <td><?php echo $sk['jabatan_lama']; ?></td>
                                                        <td><?php echo $sk['satker_lama']; ?></td>
                                                        <td><?php echo $sk['jabatan_baru']; ?></td>
                                                        <td><?php echo $sk['satker_baru']; ?></td>
                                                        <td><p class="<?php echo 'bg-'.$sk['alert_color'];?> text-light text-center"><?php    echo $sk['status']; //echo $sk['id_status']; ?></p></td>
                                                        <td><?php echo $sk['keterangan']; ?></td>

                                                        <td><?php echo $sk['updated_date'];//echo $sk['updated_user_id']; ?></td>
                                                        <td><?php echo $sk['user_name']; ?></td>
                                                        
                                                        <td>
                                                         

                                                          <?php echo anchor('SKMutasi_Panitera/viewHistory/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'].'/0','<div class="btn btn-primary"><i class="fas fa-info-circle" data-toogle="tooltip" title="detail"></i></div>') ?></td>
                                                         <td><?php echo anchor('SKMutasi_Panitera/fileSK/Salinan/'.$sk['id_group_sk'].'/'.$sk['id_sk'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Salinan"></i></div>') ?></td>
                                                         <td><?php echo anchor('SKMutasi_Panitera/fileSK/Petikan/'.$sk['id_group_sk'].'/'.$sk['id_sk'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Petikan"></i></div>') ?></td>
                                                        

                                                        

                                                         <?php  if($this->session->userdata('level_name')==='Staf'){

                                                          if($sk['id_stage']===$this->session->userdata('start_stage')){
?>  


                                                                  <td><?php  echo anchor('SKMutasi_Panitera/sinkronUlangSK/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'],'<div class="btn btn-primary"><i class="fas fa-sync-alt" data-toogle="tooltip" title="sinkronisasi ulang"></i></div>') ?></td>

                                                                
                                                                  <td onclick="javascript:return confirm('Anda yakin memproses Surat Keputusan ini?')"><?php  echo anchor('SKMutasi_Panitera/verifySK/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'].'/13','<div class="btn btn-info">Proses</div>') ?></td> 
                                                             

                                                             
                                                              
                                                               <?php }else{?>
                                                                  <td></td><td></td>
                                                                <?php


                                                               

                                                             }?>
                                                               


                                                              <?php  }elseif($stage[0]['end_stage']===$sk['id_stage']){
                                                                  echo "masuk kesini ya";
                                                               if($sk['id_stage']===$this->session->userdata('end_stage')){
                                                                echo "masuk kesini";
                                                                  ?>
                                                                  <!--<td onclick="javascript:return confirm('Anda yakin menandatangani Surat Keputusan ini?')"><?php  echo anchor('SKMutasi_Hakim_PN/signSK/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'],'<div class="btn btn-info"><i class="fas fa-user-check" data-toogle="tooltip" title="tanda tangani"></i></div>') ?><?php echo "kesini";?></td>-->

                                                                  <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signSK<?php echo $sk['id_sk'];?>"> 
                                                                      <i class="fas fa-user-check" data-toogle="tooltip" title="tanda tangani"></i>
                                                                    </button>
                                                                  </td>
                                                                  <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#revisi<?php echo $sk['id_sk'];?>"> 
                                                                      <i class="fas fa-ban"></i>
                                                                    </button>
                                                                  </td>

                                                          <?php }else {?>
                                                            <td></td>
                                                            <td></td>
                                                      <?php    } 
                                                        }else{
                                                             if($sk['id_stage']===$this->session->userdata('end_stage')){

                                                                 if($sk['id_stage']===$stage[0]['end_stage']){?>
                                                                  
                                                                      
                                                                   <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#signSK<?php echo $sk['id_sk'];?>"> 
                                                                      <i class="fas fa-user-check" data-toogle="tooltip" title="tanda tangani"></i>
                                                                    </button>
                                                                  </td>
                                                                  <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#revisi<?php echo $sk['id_sk'];?>"> 
                                                                      <i class="fas fa-ban"></i>
                                                                    </button>
                                                                  </td>
 
                                                                    <?php
                                                                 }elseif($this->session->userdata('level_name')==='Direktur'){

                                                                    echo "masuk direktur";?>

                                                                    <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signSK<?php echo $sk['id_sk'];?>"> 
                                                                      <i class="fas fa-user-check" data-toogle="tooltip" title="tanda tangani"></i>
                                                                    </button>
                                                                  </td>
                                                                  <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#revisi<?php echo $sk['id_sk'];?>"> 
                                                                      <i class="fas fa-ban"></i>
                                                                    </button>
                                                                  </td>
                                                                  <?php
                                                                 }else{ 
                                                                  // untuk user kasi dan kasubdit
                                                                    echo "masuk :".$this->session->userdata('level_name');
                                                                    ?> 
                                                                      <td onclick="javascript:return confirm('Anda yakin menyetujui Surat Keputusan ini?')"><?php  echo anchor('SKMutasi_Panitera/verifySK/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'].'/13','<div class="btn btn-info"><i class="fas fa-user-check" data-toogle="tooltip" title="verifikasi"></i></div>') ?><?php echo "kesini ".$sk['id_stage'];?></td>
                                                                   
                                                                   <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#revisi<?php echo $sk['id_sk'];?>">
                                                                      <i class="fas fa-ban"></i>
                                                                    </button>
                                                                  </td>

                                                                    <?php}
                                                              //echo "masuk kesini 2";
                                                                  ?>
                                                                 <!-- <td onclick="javascript:return confirm('Anda yakin menyetujui Surat Keputusan ini?')"><?php  echo anchor('SKMutasi_Panitera/verifySK/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'].'/13','<div class="btn btn-info"><i class="fas fa-user-check" data-toogle="tooltip" title="verifikasi"></i></div>') ?><?php echo "kesini ".$sk['id_stage'];?></td>
                                                                   
                                                                  <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#revisi<?php echo $sk['id_group_sk'];?>">
                                                                      <i class="fas fa-ban"></i>
                                                                    </button>
                                                                  </td>-->

                                                          <?php }}else{?>
                                                            <td></td>
                                                            <td></td>
                                                          <?php }
                                                        }?>











                                                        
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
                            <div class="text-muted">Copyright &copy; Direktorat Jenderal Badan Peradilan Umum 2021</div>
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
