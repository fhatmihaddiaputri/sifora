<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        script>
        <script src="<?php echo base_url()?>assets/sb/dist/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>assets/sb/src/assets/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url()?>assets/sb/src/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>assets/sb/src/assets/demo/datatables-demo.js"></script>



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
        </script>
    </body>
</html>
