
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"> <?php echo $judul; ?></h1>
                          <?php if(null !==$this->session->flashdata('msg') ):?>
                                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                   <?php echo $this->session->flashdata('msg');?>
                                  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                              <?php endif;?>
                              <?php if(null !==$this->session->flashdata('error') ):?>
                                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                   <?php echo $this->session->flashdata('error');?>
                                  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                              <?php endif;?>
                        <?php if($this->session->userdata('group_name')==='Hakim'){ ?>
                        <div class="card" >
                          <div class="card-header">
                            <?php echo $all_temp[0]['jenis']; ?>
                          </div>
                       
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                 <div class="row align-items-start">
                                <div class="col-2">
                                  Otentik
                                </div>
                                <div class="col">
                                


                                <?php   $this->load->helper('form');
                                 echo form_open_multipart('SKSetting/upload/hakim/Otentik/'.$all_temp[0]['id_jenis']);?>
                         

                                  <div class="input-group mb-3">
                                 
                                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
   
                                    <?php echo anchor('SKSetting/viewTemplate/hakim/Otentik/'.$all_temp[0]['id_jenis'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Template SK Otentik"></i></div>') ?>
                                  <input type="file" class="form-control ml-3" id="uploadSKMutasiHakim1Otentik" name ="uploadSKMutasiHakim1Otentik">
                                  <button class="btn btn-outline-secondary" type="submit" id="uploadSKMutasiHakim1Otentik">Upload</button>

                                 </div>
                                
                                </div>
                                 <?php echo form_close();?>
                            </div>
                            </li>
                            <li class="list-group-item">
                                 <div class="row align-items-start">
                                <div class="col-2">
                                  Petikan
                                </div>
                                <div class="col">
                                  <?php   $this->load->helper('form');
                                 echo form_open_multipart('SKSetting/upload/hakim/Petikan/'.$all_temp[0]['id_jenis']);?>
                         

                                  <div class="input-group mb-3">
                                 
                                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
   
                                    <?php echo anchor('SKSetting/viewTemplate/hakim/Petikan/'.$all_temp[0]['id_jenis'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Template SK Petikan"></i></div>') ?>
                                  <input type="file" class="form-control ml-3" id="uploadSKMutasiHakim1Petikan" name="uploadSKMutasiHakim1Petikan">
                                  <button class="btn btn-outline-secondary" type="submit" id="uploadSKMutasiHakim1Petikan">Upload</button>

                                 </div>
                                
                                </div>
                                 <?php echo form_close();?>
                            </div>

                            </li>
                            <li class="list-group-item">
                                 <div class="row align-items-start">
                                <div class="col-2">
                                  Salinan
                                </div>
                                <div class="col">
                                   <?php   $this->load->helper('form');
                                 echo form_open_multipart('SKSetting/upload/hakim/Salinan/'.$all_temp[0]['id_jenis']);?>
                         

                                  <div class="input-group mb-3">
                                 
                                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
   
                                    <?php echo anchor('SKSetting/viewTemplate/hakim/Salinan/'.$all_temp[0]['id_jenis'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Template SK Salinan"></i></div>') ?>
                                  <input type="file" class="form-control ml-3" id="uploadSKMutasiHakim1Salinan">
                                  <button class="btn btn-outline-secondary" type="submit" id="uploadSKMutasiHakim1Salinan">Upload</button>

                                 </div>
                                
                                </div>
                                 <?php echo form_close();?>
                            </div>
                            </li>
                          </ul>                     
                        </div>
                        <br/>
                        <div class="card" >
                          <div class="card-header">
                             <?php echo $all_temp[1]['jenis']; ?>
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                 <div class="row align-items-start">
                                <div class="col-2">
                                  Otentik
                                </div>
                                <div class="col">
                                


                                <?php   $this->load->helper('form');
                                 echo form_open_multipart('SKSetting/upload/hakim/Otentik/'.$all_temp[1]['id_jenis']);?>
                         

                                  <div class="input-group mb-3">
                                 
                                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
   
                                    <?php echo anchor('SKSetting/viewTemplate/hakim/Otentik/'.$all_temp[1]['id_jenis'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Template SK Otentik"></i></div>') ?>
                                  <input type="file" class="form-control ml-3" id="uploadSKMutasiHakim2Otentik">
                                  <button class="btn btn-outline-secondary" type="submit" id="uploadSKMutasiHakim2Otentik">Upload</button>

                                 </div>
                                
                                </div>
                                 <?php echo form_close();?>
                            </div>
                            </li>
                            <li class="list-group-item">
                                 <div class="row align-items-start">
                                <div class="col-2">
                                  Petikan
                                </div>
                                <div class="col">
                                  <?php   $this->load->helper('form');
                                 echo form_open_multipart('SKSetting/upload/hakim/Petikan/'.$all_temp[1]['id_jenis']);?>
                         

                                  <div class="input-group mb-3">
                                 
                                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
   
                                    <?php echo anchor('SKSetting/viewTemplate/hakim/Petikan/'.$all_temp[1]['id_jenis'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Template SK Petikan"></i></div>') ?>
                                  <input type="file" class="form-control ml-3" id="uploadSKMutasiHakim2Petikan">
                                  <button class="btn btn-outline-secondary" type="submit" id="uploadSKMutasiHakim2Petikan">Upload</button>

                                 </div>
                                
                                </div>
                                 <?php echo form_close();?>
                            </div>

                            </li>
                            <li class="list-group-item">
                                 <div class="row align-items-start">
                                <div class="col-2">
                                  Salinan
                                </div>
                                <div class="col">
                                   <?php   $this->load->helper('form');
                                 echo form_open_multipart('SKSetting/upload/hakim/Salinan/'.$all_temp[1]['id_jenis']);?>
                         

                                  <div class="input-group mb-3">
                                 
                                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
   
                                    <?php echo anchor('SKSetting/viewTemplate/hakim/Salinan/'.$all_temp[1]['id_jenis'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Template SK Salinan"></i></div>') ?>
                                  <input type="file" class="form-control ml-3" id="uploadSKMutasiHakim2Salinan">
                                  <button class="btn btn-outline-secondary" type="submit" id="uploadSKMutasiHakim2Salinan">Upload</button>

                                 </div>
                                
                                </div>
                                 <?php echo form_close();?>
                            </div>
                            </li>
                          </ul>          
                        </div>
                         <?php }
                         if($this->session->userdata('group_name')==='Panitera'){ ?>
                         ?>
                         <div class="card" >
                          <div class="card-header">
                            SK Mutasi Kepaniteraan
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                 <div class="row align-items-start">
                                <div class="col-2">
                                  Otentik
                                </div>
                                <div class="col">
                                    
                                  <div class="input-group mb-3">
                                    <?php echo anchor('SKSetting/viewTemplate/panitera/Otentik/'.$all_temp[0]['id_jenis'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Template SK Otentik"></i></div>') ?>
                                  <input type="file" class="form-control ml-3" id="uploadSKMutasiHakim1">
                                  <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                 </div>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item">
                                 <div class="row align-items-start">
                                <div class="col-2">
                                  Petikan
                                </div>
                                <div class="col">
                                    
                                  <div class="input-group mb-3">
                                    <?php echo anchor('SKSetting/viewTemplate/panitera/Petikan/'.$all_temp[0]['id_jenis'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Template SK Petikan"></i></div>') ?>
                                  <input type="file" class="form-control ml-3" id="uploadSKMutasiHakim1">
                                  <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                 </div>
                                </div>
                            </div>

                            </li>
                            <li class="list-group-item">
                                 <div class="row align-items-start">
                                <div class="col-2">
                                  Salinan
                                </div>
                                <div class="col">
                                    
                                  <div class="input-group mb-3">
                                    <?php echo anchor('SKSetting/viewTemplate/panitera/Salinan/'.$all_temp[0]['id_jenis'],'<div class="btn btn-warning"><i class="fas fa-file" data-toogle="tooltip" title="Template SK Salinan"></i></div>') ?>
                                  <input type="file" class="form-control ml-3" id="uploadSKMutasiPanitera1">
                                  <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                 </div>
                                </div>
                            </div>
                            </li>
                          </ul>
                        </div>
                        <?php }?>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Direktorat Pembinaan Tenaga Teknis Peradilan Umum 2021</div>
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
        