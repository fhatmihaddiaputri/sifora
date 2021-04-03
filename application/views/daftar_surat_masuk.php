<main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Surat Masuk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Surat Masuk</li>
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
                                DAFTAR SURAT MASUK
                            </div>
                            <div class="card-body">
                                <?php  echo anchor('Surat/suratMasukInput',' <button class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus fa-sm mr-2"></i>Tambah Data Surat Masuk</button>') ?>
                               
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Satker</th>
                                                <th>Kategori Surat</th>
                                                <th>Asal Surat</th>                                               <th>Hal</th>
                                                <th>No Surat Asal</th>
                                                <th>Tanggal Surat</th>
                                                <th>Status</th>
                                                <th>Tanggal Status</th>
                                                <th>Hasil Surat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Satker</th>
                                                <th>Kategori Surat</th>
                                                <th>Asal Surat</th>                                               <th>Hal</th>
                                                <th>No Surat Asal</th>
                                                <th>Tanggal Surat</th>
                                                <th>Status</th>
                                                <th>Tanggal Status</th>
                                                <th>Hasil Surat</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td><a href="#"><span>lihat detail</span></a></td>
                                                <td><button class="btn btn-primary mr-2" >singkronisasi</button></td>
                                            </tr>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td><a href="#"><span>lihat detail</span></a></td>
                                                <td><span><i class="fas fa-edit mr-2" data-toogle="tooltip" title="edit"></i><i class="fas fa-trash-alt" data-toogle="tooltip" title="delete"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td><a href="#"><span>lihat detail</span></a></td>
                                                <td><span><i class="fas fa-edit mr-2" data-toogle="tooltip" title="edit"></i><i class="fas fa-trash-alt" data-toogle="tooltip" title="delete"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td><a href="#"><span>lihat detail</span></a></td>
                                                <td><span><i class="fas fa-edit mr-2" data-toogle="tooltip" title="edit"></i><i class="fas fa-trash-alt" data-toogle="tooltip" title="delete"></i></span></td>
                                            </tr>
                                       
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