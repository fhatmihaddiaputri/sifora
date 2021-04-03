<main>
                    <div class="container-fluid">
                        <h1 class="mt-4">DAFTAR PENGGUNA</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('page/dashboard');?>">Dashboard </a></li>
                            <li class="breadcrumb-item active">DAFTAR KELOMPOK SK KENAIKAN PANGKAT</li>
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
                                HISTORY SK KENAIKAN PANGKAT <?php echo $skkp[0]['nama'];?>
                            </div>
                            <div class="card-body">
                                <?php  

                                  if($menu==='0'){
                                  echo anchor('SKKP/viewDataSK/'.$stage,' <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Daftar SK Kenaikan Pangkat</button>');
                                  }else{
                                       echo anchor('SKKP/monitoringSK',' <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Daftar SK Kenaikan Pangkat</button>');

                                  }
                              
                                 ?>




                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr> 
                                                <th>No</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>No</th>
                                                <th>User</th>
                                                   <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Tanggal</th>
                                               
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php  $no=1; foreach ($history as $hst): 
                                                ?>
                                                   
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $hst['stage_name']; ?></td>
                                                        <td><?php echo $hst['status']; ?></td>
                                                        <td><?php echo $hst['keterangan']; ?></td>
                                                        <td><?php echo $hst['tgl']; ?></td>
                                                        
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