

<main>
  <div class="container-fluid">
    <h1 class="mt-4">DAFTAR SURAT</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="<?php echo site_url('page/dashboard');?>">Dashboard </a></li>
      <li class="breadcrumb-item active">Daftar Surat</li>
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
                                DAFTAR SURAT
                              </div>
                              <div class="card-body">

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

                        <!-- start button menu surat-->
                        <ul class="nav nav-tabs mb-2">
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">IZIN BELAJAR</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">PENCANTUMAN GELAR</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">PERSETUJUAN/PENOLAKAN JSP</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">SURAT IZIN KELUAR NEGERI</a>
                          </li>  <li class="nav-item">
                            <a class="nav-link" href="#">PENSIUN</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">HUKUMAN DISIPLIN</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">SURAT LAIN-LAIN</a>
                          </li>
                        </ul>
                        <!--end menu surat -->






                        <!-- modal edit -->

                        <!-- Modal -->
                        <?php 
                        $no= 1;
                        foreach ($surat as $srt) :
                          $no++;
  # code...
                          ?>
                          <div class="modal fade" id="edit<?php echo $srt['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="viewHistory">FORM EDIT DATA SURAT</h5>
                                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
                                </div>
                                <div class="modal-body">
                                 <form method="POST" action="<?php echo base_url().'Surat_Panitera/editSurat/IB/'.$srt['id_stage'].'/'.$this->session->userdata('id_group')?>">
                                   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
                                   <input type="hidden" name="id_stage" id="id_stage" value="<?php echo $srt['id_stage']?>">
                                   <input type="hidden" name="id" id="id" value="<?php echo $srt['id']?>">
                                   <div class="form-group"> 
                                    <label>NIP</label>
                                    <input type="text"  value="<?php echo $srt['nip']?>" class="form-control" name="nip" id="nip" required="true" placeholder="Masukkan nip">
                                    <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#nipModalEdit">
                                      <i class="fas fa-search"></i>Cari
                                    </button>
                                  </div>  
                                  <div class="form-group"> 
                                    <label>Nama</label>
                                    <input type="text" readonly="true" class="form-control" name="nama" id="nama"  value="<?php echo $srt['nama']?>" >
                                  </div> 
                                  <div class="form-group"> 
                                    <label>Golongan</label>
                                    <input type="text" readonly="true" class="form-control" name="gol" id="gol"  value="<?php echo $srt['gol']?>" >
                                  </div>
                                  <div class="form-group"> 
                                    <label>Jabatan </label>
                                    <input type="text" readonly="true" class="form-control"name="jabatan" id="jabatan" value="<?php echo $srt['jabatan']?>" placeholder="Masukkan Keterangan Revisi">
                                  </div> 

                                  <div class="form-group"> 
                                    <label>PT</label>
                                    <input type="text" readonly="true" class="form-control"name="pt" id="pt" value=<?php echo $srt['pt']?> placeholder="Masukkan Keterangan Revisi">
                                  </div> 

                                  <div class="form-group"> 
                                    <label>PN</label>
                                    <input type="text" readonly="true" class="form-control"name="pn" id="pn" value="<?php echo $srt['pn']?>" placeholder="Masukkan Keterangan Revisi">
                                  </div> 
                                  <div class="form-group"> 
                                    <label>Pendidikan</label>
                                    <input type="text"  class="form-control"name="pendidikan" id="pendidikan" value="<?php echo $srt['pendidikan']?>" >
                                  </div> 
                                  <div class="form-group"> 
                                    <label>Universitas</label>
                                    <input type="text"  class="form-control"name="universitas" id="universitas" value="<?php echo $srt['universitas']?>" >
                                  </div>     
                                  <div class="form-group"> 
                                    <label>Nomor Surat</label>
                                    <input type="text"  class="form-control"name="nomorSurat" id="nomorSurat" value="<?php echo $srt['no_surat']?>" >
                                  </div>
                                  <div class="form-group"> 
                                    <label>Tanggal Surat</label>
                                    <input type="date"  class="form-control"name="tglSurat" id="tglSurat" value="<?php echo $srt['tgl_surat']?>" >
                                  </div> 

                                  <div class="form-group"> 
                                    <label>Nomor Surat Usul</label>
                                    <input type="text"  class="form-control"name="nomorSuratUsul" id="nomorSuratUsul" value="<?php echo $srt['no_surat_usul']?>" >
                                  </div>
                                  <div class="form-group"> 
                                    <label>Tanggal Surat Usul</label>
                                    <input type="date"  class="form-control"name="tglSuratUsul" id="tglSuratUsul" value="<?php echo $srt['tgl_surat_usul']?>" >
                                  </div>

                                  <div class="form-group">
                                    <label>Panggilan Tujuan Surat</label>
                                    <select class="form-control" name="sebutan_tujuan_surat">
                                      <option value="<?php echo $srt['sebutan_tujuan_surat']?>" selected><?php echo $srt['sebutan_tujuan_surat'];?></option>
                                      <option value="Bapak">Bapak</option>

                                      <option value="Saudara">Saudara</option>
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
                      <?php endforeach; ?>
                      <!-- end modal-->


                      <!-- end -->     


                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-user fa-sm mr-2"></i>Tambah Surat <?php //var_dump($jabatan); ?>
                      </button>

                      <!-- Modal -->

                      <!--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                        <div class="modal fade" id="exampleModal" >

                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">FORM TAMBAH SURAT IZIN BELAJAR</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
                              </div>
                              <div class="modal-body">
                               <form method="POST" action="<?php echo base_url().'Surat_Panitera/tambah_aksi/IB' ?>">
                                 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
                                 <div class="form-group"> 
                                  <label>NIP</label>
                                  <input type="text" class="form-control" name="nip_t" id="nip_t" required="true" placeholder="Masukkan nip">
                                  <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#nipModal">
                                    <i class="fas fa-search"></i>Cari
                                  </button>
                                </div> 
                                <div class="form-group"> 
                                  <label>Nama</label>
                                  <input type="text" class="form-control" name="nama_t" id="nama_t" required="true" placeholder="Masukkan nama">
                                </div> 
                                <div class="form-group"> 
                                  <label>Golongan</label>
                                  <input type="text" class="form-control" name="gol_t" id="gol_t" required="true" placeholder="Masukkan nama">
                                </div>   
                                <div class="form-group"> 
                                  <label>Jabatan</label>
                                  <input type="text"  class="form-control" name="jabatan_t" required="true" id="jabatan_t" placeholder="Masukkan jabatan">
                                </div> 
                                <div class="form-group"> 
                                  <label>PT</label>
                                  <input type="text"  class="form-control"name="pt_t" required="true" id="pt_t" placeholder="Masukkan pt">
                                </div> 
                                <div class="form-group"> 
                                  <label>PN</label>
                                  <input type="text"  class="form-control"name="pn_t" required="true" id="pn_t" placeholder="Masukkan pn">
                                </div> 
                                <div class="form-group"> 
                                  <label>Pendidikan</label>
                                  <input type="text"  class="form-control"name="pendidikan_t" required="true" id="pendidikan_t" placeholder="contoh : Magister Hukum">
                                </div> 
                                <div class="form-group"> 
                                  <label>Universitas</label>
                                  <input type="text"  class="form-control"name="universitas_t" required="true" id="universitas_t" placeholder="contoh : Universitas Jayabaya">
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

                      <?php 
                      $no= 1;
                      foreach ($surat as $srt) :
                        $no++;
  # code...
                        ?>
                        <!-- modal untuk tampil nip-->
                        <div class="modal fade" id="nipModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">

                               <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>NIP</th>
                                      <th>NAMA</th>
                                      <th>GOL</th>
                                      <th>JABATAN</th>
                                      <th>PT</th>
                                      <th>PN</th>
                                      <th>Action</th>

                                    </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                     <th>No</th>
                                     <th>NIP</th>
                                     <th>NAMA</th>
                                     <th>GOL</th>
                                     <th>JABATAN</th>
                                     <th>PT</th>
                                     <th>PN</th>
                                     <th>Action</th>

                                   </tr>
                                 </tfoot>
                                 <tbody>
                                  <?php  $no=1; foreach ($pegawai as $pgw):?>


                                  <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $pgw['nip']; ?></td>
                                    <td><?php echo $pgw['nama']; ?></td>
                                    <td><?php echo $pgw['gol']; ?></td>
                                    <td><?php echo $pgw['jabatan']; ?></td>
                                    <td><?php echo $pgw['pt']; ?></td>
                                    <td><?php echo $pgw['pn']; ?></td>
                                    <td><button type="button" id="select" class="btn btn-primary" data-nippeg="<?php echo $pgw['nip']?>" data-namapeg="<?php echo $pgw['nama'];?>" data-jabatanpeg="<?php echo $pgw['jabatan']?>" data-ptpeg="<?php echo $pgw['pt']?>" data-golpeg="<?php echo $pgw['gol']?>" data-pnpeg="<?php echo $pgw['pn']?>" ><i class="fa fa-check"></i>Pilih</button></td>

                                  </tr>
                                                    <!--

                                                        array(1) { [0]=> array(18) { ["id"]=> string(1) "1" ["nip"]=> string(18) "198911162015032003" ["nama"]=> string(19) "FHATMI HADDIA PUTRI" ["jabatan"]=> string(2) "PP" ["pt"]=> string(7) "JAKARTA" ["pn"]=> string(13) "JAKARTA PUSAT" ["no_surat"]=> string(7) "123/DJU" ["tgl_surat"]=> string(10) "2021-04-04" ["pendidikan"]=> string(13) "SARJANA HUKUM" ["universitas"]=> string(20) "UNIVERSITAS JAYABAYA" ["id_stage"]=> string(1) "5" ["created_user_id"]=> string(1) "2" ["created_date"]=> string(10) "2021-04-04" ["updated_date"]=> string(10) "2021-04-04" ["updated_user_id"]=> string(1) "2" ["file_loc"]=> string(1) "-" ["id_status"]=> string(1) "7" ["keterangan"]=> string(1) "-" } }

                                                      -->
                                                    <?php endforeach; ?>

                                                  </tbody>
                                                </table>
                                              </div>

                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    <?php endforeach; ?>
                                    <!-- end modal-->


                                    <!-- -->
                                    <?php 
                                    $no= 1;
                                    foreach ($surat as $srt) :
                                      $no++;
  # code...
                                      ?>
                                      <!-- modal untuk tampil nip-->
                                      <div class="modal fade" id="nipModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                             <div class="table-responsive">
                                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                  <tr>
                                                    <th>No</th>
                                                    <th>NIP</th>
                                                    <th>NAMA</th>
                                                    <th>GOL</th>
                                                    <th>JABATAN</th>
                                                    <th>PT</th>
                                                    <th>PN</th>
                                                    <th>Action</th>

                                                  </tr>
                                                </thead>
                                                <tfoot>
                                                  <tr>
                                                   <th>No</th>
                                                   <th>NIP</th>
                                                   <th>NAMA</th>
                                                   <th>GOL</th>
                                                   <th>JABATAN</th>
                                                   <th>PT</th>
                                                   <th>PN</th>
                                                   <th>Action</th>

                                                 </tr>
                                               </tfoot>
                                               <tbody>
                                                <?php  $no=1; foreach ($pegawai as $pgw): 
                                                
                                                ?>


                                                <tr>
                                                  <td><?php echo $no++; ?></td>
                                                  <td><?php echo $pgw['nip']; ?></td>
                                                  <td><?php echo $pgw['nama']; ?></td>
                                                  <td><?php echo $pgw['gol']; ?></td>
                                                  <td><?php echo $pgw['jabatan']; ?></td>
                                                  <td><?php echo $pgw['pt']; ?></td>
                                                  <td><?php echo $pgw['pn']; ?></td>
                                                  <td><button type="button" id="selectEdit" class="btn btn-primary" data-nippeg="<?php echo $pgw['nip']?>" data-namapeg="<?php echo $pgw['nama'];?>" data-jabatanpeg="<?php echo $pgw['jabatan']?>" data-ptpeg="<?php echo $pgw['pt']?>" data-golpeg="<?php echo $pgw['gol']?>" data-pnpeg="<?php echo $pgw['pn']?>" ><i class="fa fa-check"></i>Pilih</button></td>

                                                </tr>
                                                    <!--

                                                        array(1) { [0]=> array(18) { ["id"]=> string(1) "1" ["nip"]=> string(18) "198911162015032003" ["nama"]=> string(19) "FHATMI HADDIA PUTRI" ["jabatan"]=> string(2) "PP" ["pt"]=> string(7) "JAKARTA" ["pn"]=> string(13) "JAKARTA PUSAT" ["no_surat"]=> string(7) "123/DJU" ["tgl_surat"]=> string(10) "2021-04-04" ["pendidikan"]=> string(13) "SARJANA HUKUM" ["universitas"]=> string(20) "UNIVERSITAS JAYABAYA" ["id_stage"]=> string(1) "5" ["created_user_id"]=> string(1) "2" ["created_date"]=> string(10) "2021-04-04" ["updated_date"]=> string(10) "2021-04-04" ["updated_user_id"]=> string(1) "2" ["file_loc"]=> string(1) "-" ["id_status"]=> string(1) "7" ["keterangan"]=> string(1) "-" } }

                                                      -->
                                                    <?php endforeach; ?>

                                                  </tbody>
                                                </table>
                                              </div>

                                            </div>

                                          </div>
                                        </div>
                                      </div>
                                    <?php endforeach; ?>
                                    <!-- end modal-->


                                    <!-- -->



                                    <div class="table-responsive">
                                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                          <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>NAMA</th>
                                            <th>JABATAN</th>
                                            <th>PT</th>
                                            <th>PN</th>
                                            <th>PENDIDIKAN</th>
                                            <th>UNIVERSIAS</th>
                                            <th>NO SURAT</th>
                                            <th>TANGGAL SURAT</th>
                                            <th>CREATED USER</th>
                                            <th>CREATE DATE</th>
                                            <th>UPDATED USER</th>
                                            <th>UPDATED DATE</th>
                                            <th>STATUS</th>
                                            <th>KETERANGAN</th>     
                                            <th>Action</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            <?php  if($this->session->userdata('level_name')==='Staf'):?>
                                             <th>Action</th>
                                             <?php else:?>
                                              <th>Action</th>
                                              <th>Action</th>


                                            <?php  endif;?>
                                          </tr>
                                        </thead>
                                        <tfoot>
                                          <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>NAMA</th>
                                            <th>JABATAN</th>
                                            <th>PT</th>
                                            <th>PN</th>
                                            <th>PENDIDIKAN</th>
                                            <th>UNIVERSIAS</th>
                                            <th>NO SURAT</th>
                                            <th>TANGGAL SURAT</th>
                                            <th>CREATED USER</th>
                                            <th>CREATE DATE</th>
                                            <th>UPDATED USER</th>
                                            <th>UPDATED DATE</th>
                                            <th>STATUS</th>
                                            <th>KETERANGAN</th>     <th>Action</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            <th>Action</th>
                                            <?php  if($this->session->userdata('level_name')==='Staf'):?>
                                             <th>Action</th>
                                             <?php else:?>
                                              <th>Action</th><th>Action</th>


                                            <?php  endif;?>
                                          </tr>
                                        </tfoot>
                                        <tbody>
                                          <?php  $no=1; foreach ($surat as $srt): ?>

                                          <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $srt['nip']; ?></td>
                                            <td><?php echo $srt['nama']; ?></td>
                                            <td><?php echo $srt['jabatan']; ?></td>
                                            <td><?php echo $srt['pt']; ?></td>
                                            <td><?php echo $srt['pn']; ?></td>
                                            <td><?php echo $srt['pendidikan']; ?></td>
                                            <td><?php echo $srt['universitas']; ?></td>
                                            <td><?php echo $srt['no_surat']; ?></td>
                                            <td><?php echo $srt['tgl_surat']; ?></td>
                                            <td><?php echo $srt['create_name']; ?></td>
                                            <td><?php echo $srt['created_date']; ?></td>

                                            <td><?php echo $srt['update_name']; ?></td>
                                            <td><?php echo $srt['updated_date']; ?></td>
                                            <td><p class="<?php echo 'bg-'.$srt['alert_color'];?> text-light text-center"><?php    echo $srt['status']; //echo $sk['id_status']; ?></p></td>
                                            <td><?php echo $srt['keterangan']; ?></td>
                                            <td>
                                              <!--<?php //echo anchor('Surat_Panitera/edit/IB/'.$srt['id'],'<div class="btn btn-primary"><i class="fas fa-edit" data-toogle="tooltip" title="edit"></i></div>') ?>-->
                                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?php echo $srt['id'];?>"><i class="fas fa-edit" data-toogle="tooltip" title="edit"></i></button>
                                            </td>
                                            <td onclick="javascript:return confirm('Anda yakin menghapus data ini?')"><?php echo anchor('Surat_Panitera/hapus/IB/'.$srt['id'],'<div class="btn btn-danger"><i class="fas fa-trash" data-toogle="tooltip" title="delete"></i></div>')?></td>
                                            <td>
                                              <?php echo anchor('Surat_Panitera/viewHistory/IB/'.$srt['id'],'<div class="btn btn-primary"><i class="fas fa-info-circle" data-toogle="tooltip" title="detail"></i></div>') ?></td>
                                              <td><?php echo anchor('Surat_Panitera/fileSurat/IB/'.$srt['id'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="pdf"></i></div>') ?></td>

                                              <?php  if($this->session->userdata('level_name')==='Staf'):?>
                                                <td onclick="javascript:return confirm('Anda yakin memproses Surat Keputusan ini?')"><?php  echo anchor('Surat_Panitera/verifySurat/IB/'.$srt['id'].'/'.$srt['id_stage'],'<div class="btn btn-info">Proses</div>') ?>
                                                  
                                                </td> 

                                              <?php  elseif($stage[0]['end_stage']===$srt['id_stage']):?>
                                                <td onclick="javascript:return confirm('Anda yakin menandatangani Surat Keputusan ini?')"><?php  echo anchor('Surat_Panitera/signSurat/IB/'.$srt['id'].'/'.$srt['id_stage'],'<div class="btn btn-info"><i class="fas fa-user-check" data-toogle="tooltip" title="verifikasi"></i></div>') ?></td>
                                                <td> 
                                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#revisi<?php echo $srt['id'];?>">
                                                  <i class="fas fa-ban"></i>
                                                </button>
                                                </td>

                                            <?php  else:?>
                                              <td onclick="javascript:return confirm('Anda yakin menyetujui Surat Keputusan ini?')"><?php  echo anchor('Surat_Panitera/verifySurat/IB/'.$srt['id'].'/'.$srt['id_stage'],'<div class="btn btn-info"><i class="fas fa-user-check" data-toogle="tooltip" title="verifikasi"></i></div>') ?>
                                                
                                              </td>

                                              <td> 
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#revisi<?php echo $srt['id'];?>">
                                                <i class="fas fa-ban"></i>
                                                </button>
                                              </td>

                                          <?php endif;?>
                                        </tr>
                                                    <!--

                                                        array(1) { [0]=> array(18) { ["id"]=> string(1) "1" ["nip"]=> string(18) "198911162015032003" ["nama"]=> string(19) "FHATMI HADDIA PUTRI" ["jabatan"]=> string(2) "PP" ["pt"]=> string(7) "JAKARTA" ["pn"]=> string(13) "JAKARTA PUSAT" ["no_surat"]=> string(7) "123/DJU" ["tgl_surat"]=> string(10) "2021-04-04" ["pendidikan"]=> string(13) "SARJANA HUKUM" ["universitas"]=> string(20) "UNIVERSITAS JAYABAYA" ["id_stage"]=> string(1) "5" ["created_user_id"]=> string(1) "2" ["created_date"]=> string(10) "2021-04-04" ["updated_date"]=> string(10) "2021-04-04" ["updated_user_id"]=> string(1) "2" ["file_loc"]=> string(1) "-" ["id_status"]=> string(1) "7" ["keterangan"]=> string(1) "-" } }

                                                      -->
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


