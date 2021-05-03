<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
<!--<script src="http://code.jquery.com/jquery-plugins.js"></script>-->
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"> </script> 
        <script src="<?php echo base_url()?>assets/sb/dist/js/scripts.js"></script>
        
         <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('click','#select', function(){
                //$('#select').click(function() {

                    var nip = $(this).data('nippeg');
                    var nama = $(this).data('namapeg');
                    var jabatan = $(this).data('jabatanpeg');
                    var pt = $(this).data('ptpeg');
                    var pn = $(this).data('pnpeg');
                    var gol = $(this).data('golpeg');
                    $('#nip_t').val(nip);
                    $('#nama_t').val(nama);
                    $('#jabatan_t').val(jabatan);
                    $('#pt_t').val(pt);
                    $('#pn_t').val(pn);
                    $('#gol_t').val(pn);
                    $('#nipModal').hide();
                });
                $(document).on('click','#selectEdit', function(){
                //$('#select').click(function() {

                    var nip = $(this).data('nippeg');
                    var nama = $(this).data('namapeg');
                    var jabatan = $(this).data('jabatanpeg');
                    var pt = $(this).data('ptpeg');
                    var pn = $(this).data('pnpeg');
                    var gol = $(this).data('golpeg');
                    $('#nip').val(nip);
                    $('#nama').val(nama);
                    $('#jabatan').val(jabatan);
                    $('#pt').val(pt);
                    $('#pn').val(pn);
                    $('#gol').val(gol);
                    $('#nipModalEdit').hide();
                });
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>assets/sb/src/assets/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url()?>assets/sb/src/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>assets/sb/src/assets/demo/datatables-demo.js"></script>
        


<!--

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>assets/dist/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>dist/assets/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url()?>dist/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>dist/assets/demo/datatables-demo.js"></script>
-->




<!--

        <script>
        	
        	$(document).ready(function(){
        		$(.viewHistory).on('click', function (){
        			$('#viewHistory').modal('show');

        				$tr=$(this).closest('tr');
        				var data=$tr.children("td").map(function(){
        					return $(this).text();
        					console.log($data);

        				}).get();
        				$('#user_name').val($data[1]);
        		});

        	});
        </script>-->
    </body>
</html>
