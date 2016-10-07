<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">Detail Agen</h2>
    </header>
    
    
	<?php
      if(isset($data_header_agen)){
      foreach($data_header_agen as $row){
    ?>
    
    <section class="panel">
        <div class="panel-body">
            <div class="invoice">
                <header class="clearfix">
                    <div class="row">
                        <div class="col-sm-6 mt-md">
                            <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Agen <?php echo $row->agen_name; ?></h2>
                            <!--<h4 class="h4 m-none text-dark text-weight-bold">No ID : <?php echo $row->id_agen; ?></h4>-->
                        </div>
                        <div class="col-sm-6 text-right mt-md mb-md">
                            <address class="ib mr-xlg"> 
                               <div class="ib">
                                    <img src="<?php echo base_url()?>assets/images/logo.png" alt="Indepay Logo" width="232px" height="78px"/>
                                </div>
                            </address>
                        </div>
                    </div>
                </header>
                <div class="bill-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bill-to">
                                <p class="h5 mb-xs text-dark text-weight-semibold">Detail Agen : </p>
                                <address>
                                    <?php echo $row->agen_name; ?> (<?php echo $row->id_agen; ?>)<br />
                                    <?php echo $row->agen_address; ?><br />
                                    <?php if($row->agen_phone_number_2 == ""){ echo $row->agen_phone_number_1; echo "<br />"; } else {?><?php echo $row->agen_phone_number_1; echo", "; echo $row->agen_phone_number_2; echo "<br />"; ?><?php } ?>
                                    <?php echo $row->terminal_id; ?><br />
                                    <?php echo $row->agen_type; ?>              
                                </address>
                            </div>
                        </div> 
                    </div>
                </div>
            
                <div class="table-responsive">
        			<table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                        <thead>
                            <tr class="h4 text-dark">                                                
                                <th id="cell-id" class="text-weight-semibold">No</th> 
                                <th id="cell-id" class="text-weight-semibold">Category</th>
                                <th id="cell-id" class="text-weight-semibold">Item Name</th>
                                <th id="cell-id" class="text-weight-semibold">ESN</th>
                                <th id="cell-id" class="text-weight-semibold">SN</th>
                                <th id="cell-id" class="text-weight-semibold">Total</th>
                                <th id="cell-id" class="text-weight-semibold">Status</th>
                                <th id="cell-id" class="text-weight-semibold">Contents</th>
                                <th id="cell-id" class="text-weight-semibold">Note</th>
                                <?php if ($this->session->userdata('LEVEL') <> 'sales') { ?> 
                                <th id="cell-id" class="text-weight-semibold">Receipt</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
							<?php 
							$no=1; 
							foreach($data_item_for_agen_indepay as $row1){
							?>
							<tr>
								<th><?php echo $no; ?></th> 
								<th><?php echo $row1->category_name; ?></th>
								<th><?php echo $row1->item_name; ?></th>
								<th><?php echo $row1->esn; ?></th>
								<th><?php echo $row1->sn; ?></th>
								<th><?php echo $row1->total; ?></th>
								<th><?php echo $row1->status; ?></th>
								<th><?php echo $row1->contents; ?></th>
								<th><?php echo $row1->master_item_note; ?></th> 
                                <?php if ($this->session->userdata('LEVEL') <> 'sales') { ?> 
								<th><a class="btn btn-dark btn-sm" href="<?php echo site_url('item_list/detail_item_list/'.$row1->id_item_master_item)?>">
									<i class="fa fa-eye"></i> View</a></th> 
                                <?php } ?> 
							</tr>
							<?php $no++; 
							} 
							?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-right mr-lg">
                <a href="<?php echo site_url('agen_list/print_detail_agen/'.$row->id_agen)?>" target="_blank" class="btn btn-primary ml-sm"><i class="fa fa-print"></i> Print</a>
	            <a href="<?php echo site_url('agen_list')?>" class="btn ml-sm btn-dark">Back</a>
            </div>
        </div>
    </section>
    
	<?php }
    }
    ?>                 
   
        </div>
    </div> 
</section>


