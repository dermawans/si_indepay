<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Item In</h2>
    </header>
    
    <div class="panel-body">
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Receipt Number</th>
                    <th>Received Date</th>
                    <th>Received By</th>
                    <th>Given By</th>
                    <th>
                    <?php if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'inventory_admin') { 
        			?>
                    <a href="<?php echo site_url('item_in/pages_add_item_in')?>" class="btn btn-dark btn-sm" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Data</a>
					<?php } ?>
            		</th>
                </tr>
            </thead>
            <tbody>
             <?php
				$no=1;
				if(isset($data_item_in)){
					foreach($data_item_in as $row){
						?>
						<tr class="gradeX">
							<th><?php echo $no++; ?></th>
							<th><?php echo $row->id_item_in_master_item_in; ?></th>
							<th><?php echo date("d M Y",strtotime($row->date_in)); ?></th>
							<th><?php echo $row->agen_name; ?></th>
							<th><?php echo $row->delivery_service_name; ?></th> 
							<th>
								<a class="btn btn-dark btn-sm" href="<?php echo site_url('item_in/detail_item_in/'.$row->id_item_in)?>">
									<i class="fa fa-eye"></i> View</a>
								<!--<a class="btn btn-dark btn-sm" href="<?php echo site_url('item_in/hapus/'.$row->id_item_in)?>"
								   onclick="return confirm('Anda Yakin ?');">
									<i class="fa fa-trash-o"></i> Hapus</a>-->
								<a class="btn btn-primary btn-sm" href="<?php echo site_url('item_in/print_item_in/'.$row->id_item_in)?>" target="_blank">
									<i class="fa fa-print"></i> Print</a>
							</th>
						</tr>
					<?php }
				}
				?> 
            </tbody>
        </table>
        </div>
    </div>
    
</section>





