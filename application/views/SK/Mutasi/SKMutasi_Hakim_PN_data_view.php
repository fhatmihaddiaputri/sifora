<main>
                    <div class="container-fluid">
                        <h1 class="mt-4">DAFTAR SK MUTASI HAKIM PENGADILAN NEGERI</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('page/dashboard');?>">Dashboard </a></li>
                            <li class="breadcrumb-item active">DAFTAR SK MUTASI HAKIM PENGADILAN NEGERI</li>
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
                                DAFTAR SK MUTASI HAKIM PENGADILAN NEGERI



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

                              <!-- end modal-->

                              <?php if($this->session->userdata('level_name')==='Dirjen'||$this->session->userdata('level_name')==='Direktur'){ foreach($skgroup as $skgr){
                                  

                                  ?>
                                    <button type="button" class="btn btn-primary btn-lg m-2" data-toggle="modal" data-target="#signAll<?php echo $skgr['skmutasinoid'];?>"> 
                                    <i class="fas fa-user-check" data-toogle="tooltip" title="tanda tangani"></i> Tanda Tangani Seluruh SK dalam Group
                                    </button><br/>

                                  <?php
                              }}?>
                              <table class="table table-hover">
                                <thead>
                                            <tr>  <th>No</th>
                                                <th>No Group SK</th>
                                                 
                                                <th>Tanggal Rapat</th>
                                                <th>No SK</th>
                                                <th>Tgl SK</th>
                                                <th>Ket. Biaya</th> 
                                                <th>Created Date</th>                      
                                                <th>Keterangan</th>                      
                                                <th>SK Otentik</th> 
                                                <th>Daftar Lampiran</th>
                                                 
                                               
                                                <?php if($this->session->userdata('level_name')==='Dirjen'){?>

                                                <th>Aksi</th>
                                                <?php }?> 
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>No</th>
                                                <th>No Group SK</th>
                                                 
                                                <th>Tanggal Rapat</th>
                                                <th>No SK</th>
                                                <th>Tgl SK</th>
                                                <th>Ket. Biaya</th> 
                                                <th>Created Date</th>                      
                                                <th>Keterangan</th>                        
                                                <th>SK Otentik</th>
                                                <th>Daftar Lampiran</th>
                                                  
                                                 <?php if($this->session->userdata('level_name')==='Dirjen'){?>

                                                <th>Aksi</th>
                                                <?php }?>  
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php  $no=1; foreach ($skgroup as $skgr): 
                                                ?>
                                                   
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $skgr['skmutasinoid']; ?></td>
                                                        <td><?php echo $skgr['tgl_tpm']; ?></td>
                                                        <td><?php echo $skgr['nomor_sk']; ?></td>
                                                        <td><?php echo $skgr['tgl_sk']; ?></td>
                                                        <td><?php echo $skgr['nama_dipa']; ?></td>
                                                        <td><?php echo $skgr['updated_date']; ?></td>
                                                        <td><?php echo $skgr['desc']; ?></td>
                                                       
                                                         <td><?php echo anchor('SKMutasi_Hakim_PN/fileSK/Otentik/'.$skgr['skmutasinoid'].'/0','<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Salinan"></i></div>') ?></td>
                                                          <td><?php echo anchor('SKMutasi_Hakim_PN/fileSK/Lampiran/'.$skgr['skmutasinoid'].'/0','<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Salinan"></i></div>') ?></td>
                                                          <?php if($this->session->userdata('level_name')==='Dirjen'){?>
                                                             <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signAutentikSK<?php echo $skgr['skmutasinoid'];?>"> 
                                                                      <i class="fas fa-user-check" data-toogle="tooltip" title="tanda tangani"></i>
                                                                    </button>
                                                                  </td>
                                                          
                                                            <!-- <td><?php echo anchor('SKMutasi_Hakim_PN/signSKAutentik/'.$skgr['skmutasinoid'].'/0','<div class="btn btn-info"><i class="fas fa-user-check" data-toogle="tooltip" title="verifikasi"></i></div>') ?></td>-->
                                                         
                                                           <?php }?>
                                                          <!--<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#revisiGroup<?php echo $skgr['skmutasinoid'];?>">
                                                                      <i class="fas fa-ban"></i>
                                                                    </button></td>-->
                                                    </tr>

                                            <?php endforeach; ?>
                                            
                                       
                                        </tbody>
                              </table>
<?php  if($this->session->userdata('level_name')==='Staf'){ ?> 
  <?php 

  echo form_open_multipart('SKMutasi_Hakim_PN/uploadDaftar/5');?>
  <!--<form method="POST" action="<?php //echo base_url().'SKMutasi_Panitera/uploadDaftar' ?>">-->
     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
    <input type="hidden" id="id_group" name="id_group" value="<?php echo $skgr['skmutasinoid'];?>">

                          <div class="mb-3 row">
    <label for="lampiran" id="lampiran" class="col-sm-2 col-form-label">Daftar Lampiran</label>
    <div class="col-sm-8">
      <input class="form-control" type="file" id="formFile" name="formFile">
    </div>
     <div class="col-sm-2">
      <button type="submit" class="btn btn-primary mb-3">Upload</button>
    </div>    
    </div>
    </form>                             
                                            
                                              <?php }?>

<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-user fa-sm mr-2"></i>SINKRON DATA SK BARU<?php //var_dump($jabatan); ?>
</button>-->




<?php 
$no= 1;
foreach ($skgroup as $skgr) :
  $no++;
 
?>
<div class="modal fade" id="signAll<?php echo $skgr['skmutasinoid'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewHistory">Persetujuan Penandatanganan SK Mutasi</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
         <form method="POST" action="<?php echo base_url().'Tte/signSKMutasiAllHakim' ?>">
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
         <form method="POST" action="<?php echo base_url().'SKMutasi_HakiM_PN/revisiSK' ?>">
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
         <form method="POST" action="<?php echo base_url().'Tte/signSKMutasiHakimPN' ?>">
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



<!-- Modal -->
<?php 
$no= 1;
foreach ($skgroup as $sk) :
  $no++;
 
?>

<div class="modal fade" id="signAutentikSK<?php echo $sk['skmutasinoid'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewHistory">Persetujuan Penandatanganan SK Autentik Mutasi</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
         <form method="POST" action="<?php echo base_url().'Tte/signSKMutasiAutentikHakimPN' ?>">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
           <div class="form-group"> 
                <label>ID Group</label>
                <input type="text" readonly="true" class="form-control" name="id_group" value="<?php echo $sk['skmutasinoid']?>" id="id_group">
            </div>  
             <div class="form-group"> 
                <label>Nomor SK</label>
                <input type="text" readonly="true" class="form-control" name="nomor_sk" id="nomor_sk"  value="<?php echo $sk['nomor_sk']?>" >
            </div> 
             <div class="form-group"> 
                <label>Tanggal SK</label>
                <input type="text" readonly="true" class="form-control" name="tgl_sk" id="tgl_sk"  value="<?php echo $sk['tgl_sk']?>" >
            </div>
            <div class="form-group"> 
                <label>Tgl TPM</label>
                <input type="text" readonly="true" class="form-control" name="tgl_tpm" id="tgl_tpm"  value="<?php echo $sk['tgl_tpm']?>" >
            </div>
             <div class="form-group"> 
                <label>Ket. Biaya</label>
                <textarea class="form-control" readonly="true" id="exampleFormControlTextarea1" name="nama_dipa" rows="3">Segala Biaya yang bertalian dengan pemindahan ini dibiayai oleh Negara kecuali nomor urut <?php echo $sk['nama_dipa']?></textarea>
              <!--  <input type="text" readonly="true" class="form-control" name="nama_dipa" id="nama_dipa"  value="<?php echo $skgr['nama_dipa']?>" >-->
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


<?php  if($this->session->userdata('level_name')==='Staf'){  //echo $stage[0]['start_stage'];
   echo anchor('SKMutasi_Hakim_PN','<div class="btn btn-primary mb-2">Sinkronisasi Group SK Baru</div>'); 
}?>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr><th>No</th>
                                                <th>Urut</th>
                                                <th>NIP</th>
                                                <th>Nama</th>                                                
                                                <th>Pangkat</th>  
                                                <th>Gol.Ruang</th> 
                                                <th>Jab. Lama</th>
                                                <th>PT Lama</th>
                                                <th>PN Lama</th> 
                                                <th>Kelas/Tipe</th>

                                                <th>KPPN</th>     
                                                <th>Jab. Baru</th>                                               
                                                 <th>PT Baru</th>
                                                <th>PN Baru</th> 
                                                <th>Kelas/Tipe</th>                   
                                                <th>KPPN</th>                                     
                                                <th>Tunjangan</th>
                                                <th>Status</th> 
                                                <th>Keterangan</th> 
                                                <th>Created Date</th> 
                                                <th>Updated user</th>   
                                                <th>History</th>
                                                 <th>Salinan</th>
                                                 <th>Petikan</th>
                                                <?php  if($this->session->userdata('level_name')==='Staf'){?> 
                                                <th>Action</th><th>Action</th>  <th>Salinan</th><th>Petikan</th>
                                                <?php }else{?> 
                                                <th>Action</th>  
                                                <th>Action</th>   <?php }?> 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                               <th>No</th>
                                                <th>Urut</th>
                                                <th>NIP</th>
                                                <th>Nama</th>                                                
                                                <th>Pangkat</th>  
                                                <th>Gol.Ruang</th> 
                                                <th>Jab. Lama</th>
                                                <th>PT Lama</th>
                                                <th>PN Lama</th> 
                                                <th>Kelas/Tipe</th>
                                                 
                                                <th>KPPN</th>     
                                                <th>Jab. Baru</th>                                               
                                                 <th>PT Baru</th>
                                                <th>PN Baru</th> 
                                                <th>Kelas/Tipe</th>                   
                                                <th>KPPN</th>                                    
                                                <th>Tunjangan</th> 
                                                <th>Status</th> 
                                                <th>Keterangan</th> 
                                                <th>Created Date</th> 
                                                <th>Updated user</th>  
                                                  <th>History</th>
                                                 <th>Salinan</th>
                                                 <th>Petikan</th>
                                                <?php  if($this->session->userdata('level_name')==='Staf'){?> 
                                                <th>Action</th><th>Action</th> <th>Salinan</th><th>Petikan</th>
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
                                                        <td><?php echo $sk['no_urut']; ?></td>
                                                        <td><?php echo $sk['nip']; ?></td>
                                                        <td><?php echo $sk['nama']; ?></td>
                                                        <td><?php echo $sk['pangkat'].'/'.$sk['gol_relasi']; ?></td>
                                                        <td><?php echo $sk['gol']; ?></td>
                                                        <td><?php echo $sk['jabatan_lama']; ?></td>
                                                        <td><?php echo $sk['pt_lama']; ?></td>
                                                        <td><?php echo $sk['pn_lama']; ?></td>
                                                        <td><?php echo $sk['kelas_lama']; ?></td>
                                                        <td><?php echo $sk['kppn_lama']; ?></td>
                                                        <td><?php echo $sk['jabatan_baru']; ?></td>
                                                        <td><?php echo $sk['pt_baru']; ?></td>
                                                        <td><?php echo $sk['pn_baru']; ?></td>
                                                        <td><?php echo $sk['kelas_baru']; ?></td>
                                                        <td><?php echo $sk['kppn_baru']; ?></td>
                                                        <td><?php echo $sk['tunjangan']; ?></td>
                                                        <td><p class="<?php echo 'bg-'.$sk['alert_color'];?> text-light text-center"><?php    echo $sk['status']; //echo $sk['id_status']; ?></p></td>
                                                        <td><?php echo $sk['keterangan']; ?></td>

                                                        <td><?php echo $sk['updated_date'];//echo $sk['updated_user_id']; ?></td>
                                                        <td><?php echo $sk['user_name']; ?></td>
                                                        
                                                        <td>
                                                         

                                                          <?php echo anchor('SKMutasi_Hakim_PN/viewHistory/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'].'/0','<div class="btn btn-primary"><i class="fas fa-info-circle" data-toogle="tooltip" title="detail"></i></div>') ?></td>
                                                         <td><?php echo anchor('SKMutasi_Hakim_PN/fileSK/Salinan/'.$sk['id_group_sk'].'/'.$sk['id_sk'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Salinan"></i></div>') ?></td>
                                                         <td><?php echo anchor('SKMutasi_Hakim_PN/fileSK/Petikan/'.$sk['id_group_sk'].'/'.$sk['id_sk'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Petikan"></i></div>') ?></td>
                                                        


                                                         <?php  if($this->session->userdata('level_name')==='Staf'){

                                                          if($sk['id_stage']===$this->session->userdata('start_stage')){
?>  


                                                                  <td><?php  echo anchor('SKMutasi_Hakim_PN/sinkronUlangSK/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'],'<div class="btn btn-primary"><i class="fas fa-sync-alt" data-toogle="tooltip" title="sinkronisasi ulang"></i></div>') ?></td>

                                                                
                                                                  <td onclick="javascript:return confirm('Anda yakin memproses Surat Keputusan ini?')"><?php  echo anchor('SKMutasi_Hakim_PN/verifySK/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'].'/13','<div class="btn btn-info">Proses</div>') ?></td> 
                                                                  <td>
                                                                    
                                                                     <?php 

                                                                        echo form_open_multipart('SKMutasi_Hakim_PN/uploadSK/Salinan');?>
                                                                        
                                                                           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
                                                                          <input type="hidden" id="id_group" name="id_group" value="<?php echo $sk['id_group_sk'];?>">
                                                                          <input type="hidden" id="id_sk" name="id_sk" value="<?php echo $sk['id_sk'];?>">
                                                                           <input type="hidden" id="nip" name="nip" value="<?php echo $sk['nip'];?>">

                                                                                                <div class="mb-3 row">
                                                                         
                                                                          <div class="col-sm-8">
                                                                            <input class="form-control" type="file" id="formFile" name="formFile">
                                                                          </div>
                                                                           <div class="col-sm-2">
                                                                            <button type="submit" class="btn btn-primary mb-3">Upload</button>
                                                                          </div>    
                                                                          </div>
                                                                          </form>       
                                                                  </td>

                                                                  <td>
                                                                    <?php 

                                                                        echo form_open_multipart('SKMutasi_Hakim_PN/uploadSK/Petikan');?>
                                                                        
                                                                           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
                                                                          <input type="hidden" id="id_group" name="id_group" value="<?php echo $sk['id_group_sk'];?>">
                                                                          <input type="hidden" id="id_sk" name="id_sk" value="<?php echo $sk['id_sk'];?>">
                                                                           <input type="hidden" id="nip" name="nip" value="<?php echo $sk['nip'];?>">

                                                                                                <div class="mb-3 row">
                                                                         
                                                                          <div class="col-sm-8">
                                                                            <input class="form-control" type="file" id="formFile" name="formFile">
                                                                          </div>
                                                                           <div class="col-sm-2">
                                                                            <button type="submit" class="btn btn-primary mb-3">Upload</button>
                                                                          </div>    
                                                                          </div>
                                                                          </form>    
                                                                        
                                                                  </td>

                                                              
                                                               <?php }else{?>
                                                                  <td></td><td></td><td></td><td></td>
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
                                                                      <td onclick="javascript:return confirm('Anda yakin menyetujui Surat Keputusan ini?')"><?php  echo anchor('SKMutasi_Hakim_PN/verifySK/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'].'/13','<div class="btn btn-info"><i class="fas fa-user-check" data-toogle="tooltip" title="verifikasi"></i></div>') ?><?php echo "kesini ".$sk['id_stage'];?></td>
                                                                   
                                                                   <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#revisi<?php echo $sk['id_sk'];?>">
                                                                      <i class="fas fa-ban"></i>
                                                                    </button>
                                                                  </td>

                                                                    <?php}
                                                              //echo "masuk kesini 2";
                                                                  ?>
                                                                 <!-- <td onclick="javascript:return confirm('Anda yakin menyetujui Surat Keputusan ini?')"><?php  echo anchor('SKMutasi_Hakim_PN/verifySK/'.$sk['id_group_sk'].'/'.$sk['id_sk'].'/'.$sk['id_stage'].'/13','<div class="btn btn-info"><i class="fas fa-user-check" data-toogle="tooltip" title="verifikasi"></i></div>') ?><?php echo "kesini ".$sk['id_stage'];?></td>
                                                                   
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
