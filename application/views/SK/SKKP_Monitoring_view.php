<main>
                    <div class="container-fluid">
                        <h1 class="mt-4">MONITORING SK KENAIKAN PANGKAT</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('page/dashboard');?>">Dashboard </a></li>
                            <li class="breadcrumb-item active">MONITORING SK KENAIKAN PANGKAT</li>
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
                                MONITORING SK KENAIKAN PANGKAT <?php// echo $skkp[1]['skpangkatnoid'];
//var_dump($skkp);
                                ?>
                            </div>
                            <div class="card-body">
                              <?php if(null !==$this->session->flashdata('msg') ):?>
                                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                   <?php echo $this->session->flashdata('msg');?>
                                  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                              <?php endif;?>
                                <?php  //echo anchor('Pengguna/tambah',' <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user fa-sm mr-2"></i>Tambah Pengguna</button>') ?>



<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-user fa-sm mr-2"></i>SINKRON DATA SK BARU<?php //var_dump($jabatan); ?>
</button>-->

<!-- Modal -->
<?php 
$no= 1;
foreach ($skkp as $sk) :
  $no++;
  # code...
?>
<div class="modal fade" id="revisi<?php echo $sk['skpangkatnoid'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewHistory">Detail History SK Kenaikan Pangkat</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
         <form method="POST" action="<?php echo base_url().'SKKP/revisiSK' ?>">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
            <input type="hidden" name="stage" id="stage" value="<?php echo $sk['id_stage']?>">
            <div class="form-group"> 
                <label>ID Group</label>
                <input type="text" readonly="true" class="form-control" name="id_group" value="<?php echo $sk['skpangkatnoid']?>" id="id_group">
            </div>  
             <div class="form-group"> 
                <label>ID SK</label>
                <input type="text" readonly="true" class="form-control" name="id_sk" id="id_sk"  value="<?php echo $sk['skpangkatindx']?>" >
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
<?php // if($this->session->userdata('level_name')==='Staf'){  //echo $stage[0]['start_stage'];
   //echo anchor('SKKP','<div class="btn btn-primary mb-2">Sinkronisasi Group SK Baru</div>'); 
//}?>
<?php 
    echo anchor('SKKP/ExportToExcel','<div class="btn btn-primary mb-2"><i class="far fa-file-excel" data-toggle="tooltip" title="download excel"></i></div>');
?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr><th>No</th>
                                                <th>No Group SK</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>PT</th>
                                                <th>PN</th> 
                                                <th>No. Pertek</th>                                                     
                                                <th>tgl Pertek</th>  
                                                <th>Gol Baru</th> 
                                                <th>TMT Gol Baru</th>                                               
                                                 <th>Gol Lama</th>
                                                <th>TMT Gol Lama</th> 
                                                <th>No SK</th>                                                     
                                                <th>tgl SK</th> 
                                                <th>Nama Pembuat</th> 
                                                <th>Tgl Pembuat</th> 
                                                <th>Status</th> 
                                                <th>Posisi</th> 
                                                <th>Keterangan</th>  
                                                <th>Action</th>
                                                 <th>Action</th>
                                              
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>No Group SK</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>PT</th>
                                                <th>PN</th> 
                                                <th>No. Pertek</th>                                                     
                                                <th>tgl Pertek</th>  
                                                <th>Gol Baru</th> 
                                                <th>TMT Gol Baru</th>                                               
                                                 <th>Gol Lama</th>
                                                <th>TMT Gol Lama</th> 
                                                <th>No SK</th>                                                     
                                                <th>tgl SK</th> 
                                                <th>Nama Pembuat</th> 
                                                <th>Tgl Pembuat</th> 
                                                <th>Status</th> 
                                                <th>Posisi</th> 
                                                <th>Keterangan</th>  
                                               <th>Action</th>
                                                 <th>Action</th>
                                               
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php  $no=1; foreach ($skkp as $sk): 




/*
$data = array('id' => '',
                'skpangkatnoid'=>$hasil['skpangkatnoid'],
                'skpangkatindx'=>$hasil['skpangkatindx'],
                'nip'=>$hasil['nipnmrc'],
                'nama'=>$hasil['nama'],
                'tempat_lahir'=>$hasil['tptlhr'],
                'tgl_lahir'=>$hasil['tgllhr'],
                'sknmrpertek'=>$hasil['sknmrkeputusn'],
                'sktglpertek'=>$hasil['sktglkeputusn'],
                'sknomor'=>$hasil['sknmrskkenaikn'] ,
                'sktgl'=>$hasil['sktgltdkenaikn'],
                'gol_baru'=>$hasil['skpangkatbaru'],
                'tmt_gol_baru'=>$hasil['sktglskkenaikn'],
                'mk_tahun'=>$hasil['skpangkatlthn'],
                'mk_bulan'=>$hasil['skpangkatlbln'],
                'tmt_gol_lama'=>$hasil['skpangkatltmt'],
                'gol_lama'=>$hasil['skpangkatlama'],
                'pt'=>$hasil['ptnama'],
                'pn'=>$hasil['pnnama'],
                'jabatan'=>$hasil['jabatan'],
                'pendidikan'=>$pdk,
                'gaji'=>$hasil['skpangkatgaji'],
                'tunjangan'=>$hasil['skpangkattunj'],
                'qrcode'=>$hasil['skpangkatcatat'],
                'id_stage'=>$stage[0]['start_stage'],
                'id_status'=>'7',
                'updated_date'=>$update_date,
                'updated_user_id'=>$this->session->userdata('userid'),
                'keterangan'=>'syncronized',
                'file_loc'=>''
              );


               <th>No Group SK</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>PT</th>
                                                <th>PN</th> 
                                                <th>No. Pertek</th>                                                     
                                                <th>tgl Pertek</th>  
                                                <th>Gol Baru</th> 
                                                <th>TMT Gol Baru</th>                                               
                                                 <th>Gol Lama</th>
                                                <th>TMT Gol Lama</th> 
                                                <th>No SK</th>                                                     
                                                <th>tgl SK</th> 
                                                <th>Nama Pembuat</th> 
                                                <th>Tgl Pembuat</th> 
                                                <th>Status</th> 
                                                <th>Keterangan</th> 


*/

                                                ?>
                                                   
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $sk['skpangkatnoid']; ?></td>
                                                        <td><?php echo $sk['nip']; ?></td>
                                                        <td><?php echo $sk['nama']; ?></td>
                                                        <td><?php echo $sk['jabatan']; ?></td>
                                                        <td>PT <?php echo $sk['pt']; ?></td>
                                                        <td>PN <?php echo $sk['pn']; ?></td>
                                                        <td><?php echo $sk['sknmrpertek']; ?></td>

                                                        <td><?php echo $sk['sktglpertek']; ?></td>
                                                        <td><?php echo $sk['gol_baru']; ?></td>
                                                        <td><?php echo $sk['tmt_gol_baru']; ?></td>
                                                        <td><?php echo $sk['gol_lama']; ?></td>
                                                        <td><?php echo $sk['tmt_gol_lama']; ?></td>
                                                        <td><?php echo $sk['sknomor']; ?></td>
                                                        <td><?php echo $sk['sktgl']; ?></td>
                                                        <td><?php echo $sk['user_name'];//echo $sk['updated_user_id']; ?></td>
                                                        <td><?php echo $sk['updated_date']; ?></td>
                                                        <td><p class="<?php echo 'bg-'.$sk['alert_color'];?> text-light text-center"><?php    echo $sk['status']; //echo $sk['id_status']; ?></p></td>
                                                        <td><?php echo $sk['stage_name']; ?></td>
                                                        
                                                        <td><?php echo $sk['keterangan']; ?></td>
                                                        <td>
                                                         

                                                          <?php echo anchor('SKKP/viewHistory/'.$sk['skpangkatnoid'].'/'.$sk['skpangkatindx'].'/'.$sk['id_stage'].'/1','<div class="btn btn-primary"><i class="fas fa-info-circle" data-toogle="tooltip" title="detail"></i></div>') ?></td>
                                                         <td><?php echo anchor('SKKP/fileSK/'.$sk['skpangkatnoid'].'/'.$sk['skpangkatindx'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="pdf"></i></div>') ?></td>
                                                        

                                                         
                                                        
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
