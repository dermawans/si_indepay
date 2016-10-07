 <section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Item Out</h2>
    </header>
    
    <div class="panel-body">
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Received Number</th>
                    <th>Receiver</th>
                    <th>Send Date</th>
                    <th>Status</th>
                    <th>Received Date</th>
                    <th>Giver</th>
                    <th>
                    <?php if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'inventory_admin') { 
?>
                    <a href="<?php echo site_url('item_out/pages_add_item_out')?>" class="btn btn-dark btn-sm" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Data</a>
  					<?php } ?>
            		</th>
                </tr>
            </thead>
            <tbody>
             <?php
				$no=1;
				if(isset($data_item_out)){
					foreach($data_item_out as $row){
						?>
						<tr class="gradeX">
							<th><?php echo $no++; ?></th>
							<th><?php echo $row->id_item_out; ?></th>
							<th><?php echo $row->agen_name; ?></th>
							<th><?php echo date("d M Y",strtotime($row->date_out)); ?></th>
							<th><?php echo $row->status; ?></th>
							<th><?php if ($row->date_of_received =="0000-00-00"){ echo "-"; } else { echo date("d M Y",strtotime($row->date_of_received));} ?></th>
							<th><?php echo $row->agen_name_sender; ?></th> 
							<th>
								<a class="btn btn-dark btn-sm" href="<?php echo site_url('item_out/detail_item_out/'.$row->id_item_out)?>">
									<i class="fa fa-eye"></i> View</a>
								<!--<a class="btn btn-dark btn-sm" href="<?php echo site_url('item_out/hapus/'.$row->id_item_out)?>"
								   onclick="return confirm('Anda Yakin ?');">
									<i class="fa fa-trash-o"></i> Hapus</a>-->
								<a class="btn btn-primary btn-sm" href="<?php echo site_url('item_out/print_item_out/'.$row->id_item_out)?>" target="_blank">
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





