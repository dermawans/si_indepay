<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">List Item In</h2>
    </header>
    
    
	<?php
      if(isset($data_item_list_header_item_in)){
      foreach($data_item_list_header_item_in as $row){
    ?>
     
        <div class="panel-body">
            <div class="invoice">
               <header class="clearfix">
                    <div class="row">
                        <div class="col-sm-6 mt-md">
                            <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Item In</h2>
                            <h4 class="h4 m-none text-dark text-weight-bold">No ID : <?php echo $row->id_item_in; ?></h4>
                        </div>
                        <div class="col-sm-6 text-right mt-md mb-md">
                            <address class="ib mr-xlg">
                                <br />
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
                                        <p class="h5 mb-xs text-dark text-weight-semibold">To : </p>
                                        <address>
                                            <?php echo $row->agen_name; ?> (<?php echo $row->id_agen; ?>)<br />
                                            <?php echo $row->agen_address; ?><br />
                                            <?php if($row->agen_phone_number_2 == ""){ echo $row->agen_phone_number_1; echo "<br />"; } else {?><?php echo $row->agen_phone_number_1; echo", "; echo $row->agen_phone_number_2; echo "<br />"; ?><?php } ?>              
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bill-data text-right">
                                        <p class="mb-none">
                                            <span class="text-dark">Receive Date : </span>
                                            <span class="value"><?php echo date("d M Y",strtotime($row->date_in)); ?></span>
                                        </p>
                                        <p class="mb-none">
                                            <span class="text-dark">Delivery Service : </span>
                                            <span class="value"><?php echo$row->delivery_service_name; ?></span>
                                        </p>
                                        <p class="mb-none">
                                            <span class="text-dark">Note : </span>
                                            <span class="value"><?php echo$row->master_item_in_note; ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="table-responsive">
                            <table class="table invoice-items">
                                <thead>
                                    <tr class="h4 text-dark">                                                
                                        <th id="cell-id" class="text-weight-semibold">No</th>
                                        <th id="cell-id" class="text-weight-semibold">ID Item</th>
                                        <th id="cell-id" class="text-weight-semibold">Category</th>
                                        <th id="cell-id" class="text-weight-semibold">Item Name</th>
                                        <th id="cell-id" class="text-weight-semibold">ESN</th>
                                        <th id="cell-id" class="text-weight-semibold">SN</th>
                                        <th id="cell-id" class="text-weight-semibold">Total</th>
                                        <th id="cell-id" class="text-weight-semibold">Status</th>
                                        <th id="cell-id" class="text-weight-semibold">Contents</th>
                                        <th id="cell-id" class="text-weight-semibold">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; foreach($data_item_list_item_for_item_in as $row1){
                                    ?>
                                    <tr>
                                        <th><?php echo $no; ?></th>
                                        <th><?php echo $row1->id_item_master_item; ?></th>
                                        <th><?php echo $row1->category_name; ?></th>
                                        <th><?php echo $row1->item_name; ?></th>
                                        <th><?php echo $row1->esn; ?></th>
                                        <th><?php echo $row1->sn; ?></th>
                                        <th><?php echo $row1->total; ?></th>
                                        <th><?php echo $row1->status; ?></th>
                                        <th><?php echo $row1->contents; ?></th>
                                        <th><?php echo $row1->master_item_note; ?></th>  
                                    </tr>
                                    <?php $no++; } ?>
                                </tbody>
                            </table>
                      	</div>
                        
                        <div class="text-right mr-lg">
                            <a href="<?php echo site_url('item_in/print_item_in/'.$row->id_item_in)?>" target="_blank" class="btn btn-primary ml-sm"><i class="fa fa-print"></i> Print</a>
                            <a href="<?php echo site_url('item_list')?>" class="btn ml-sm btn-dark">Back</a>
                        </div>  
            </div>
		</div>

    
	<?php }
    }
    ?>                 
     
</section>

	<hr />
    
	<hr />
    
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">List Item Out</h2>
    </header>
    
    
	<?php
      if(isset($data_item_list_header_item_out)){
      foreach($data_item_list_header_item_out as $row){
    ?>
     
        <div class="panel-body">
            <div class="invoice">
               <header class="clearfix">
                    <div class="row">
                        <div class="col-sm-6 mt-md">
                            <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Item Out</h2>
                            <h4 class="h4 m-none text-dark text-weight-bold">No ID : <?php echo $row->id_item_out_master_item_out; ?></h4>
                        </div>
                        <div class="col-sm-6 text-right mt-md mb-md">
                            <address class="ib mr-xlg">
                                <br />
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
                                        <p class="h5 mb-xs text-dark text-weight-semibold">To : </p>
                                        <address>
                                            <?php echo $row->agen_name; ?> (<?php echo $row->id_agen; ?>)<br />
                                            <?php echo $row->agen_address; ?><br />
                                            <?php if($row->agen_phone_number_2 == ""){ echo $row->agen_phone_number_1; echo "<br />"; } else {?><?php echo $row->agen_phone_number_1; echo", "; echo $row->agen_phone_number_2; echo "<br />"; ?><?php } ?>              
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bill-data text-right">
                                        <p class="mb-none">
                                            <span class="text-dark">Sent Date : </span>
                                            <span class="value"><?php echo date("d M Y",strtotime($row->date_out)); ?></span>
                                        </p>
                                        <p class="mb-none">
                                            <span class="text-dark">Delivery Service : </span>
                                            <span class="value"><?php echo$row->delivery_service_name; ?></span>
                                        </p>
                                        <p class="mb-none">
                                            <span class="text-dark">Note : </span>
                                            <span class="value"><?php echo$row->master_item_out_note; ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="table-responsive">
                            <table class="table invoice-items">
                                <thead>
                                    <tr class="h4 text-dark">                                                
                                        <th id="cell-id" class="text-weight-semibold">No</th>
                                        <th id="cell-id" class="text-weight-semibold">ID Item</th>
                                        <th id="cell-id" class="text-weight-semibold">Category</th>
                                        <th id="cell-id" class="text-weight-semibold">Item Name</th>
                                        <th id="cell-id" class="text-weight-semibold">ESN</th>
                                        <th id="cell-id" class="text-weight-semibold">SN</th>
                                        <th id="cell-id" class="text-weight-semibold">Total</th>
                                        <th id="cell-id" class="text-weight-semibold">Status</th>
                                        <th id="cell-id" class="text-weight-semibold">Contents</th>
                                        <th id="cell-id" class="text-weight-semibold">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; foreach($data_item_list_item_for_item_out as $row1){
                                    ?>
                                    <tr>
                                        <th><?php echo $no; ?></th>
                                        <th><?php echo $row1->id_item_master_item; ?></th>
                                        <th><?php echo $row1->category_name; ?></th>
                                        <th><?php echo $row1->item_name; ?></th>
                                        <th><?php echo $row1->esn; ?></th>
                                        <th><?php echo $row1->sn; ?></th>
                                        <th><?php echo $row1->total; ?></th>
                                        <th><?php echo $row1->status; ?></th>
                                        <th><?php echo $row1->contents; ?></th>
                                        <th><?php echo $row1->master_item_note; ?></th>  
                                    </tr>
                                    <?php $no++; } ?>
                                </tbody>
                            </table>
                      	</div>
                        
                        <div class="text-right mr-lg">
                            <a href="<?php echo site_url('item_out/print_item_out/'.$row->id_item_out_master_item_out)?>" target="_blank" class="btn btn-primary ml-sm"><i class="fa fa-print"></i> Print</a>
                            <a href="<?php echo site_url('item_list')?>" class="btn ml-sm btn-dark">Back</a>
                        </div>  
                    
            <div class="invoice-summary">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table h5 text-dark">
                            <tbody>
                                <tr>
                                    <td colspan="2">Agen Receiver</td>
                                    <td class="text-left"><?php echo $row->agen_name; ?></td>
                                </tr>
                                <tr class="b-top-none">
                                    <td colspan="2">Date Of Received</td>
                                    <td class="text-left"><?php echo $row->date_of_received; ?></td>
                                </tr>
                                <tr class="h4">
                                    <td colspan="2">Status</td>
                                    <td class="text-left"><?php echo $row->status_detail_item_out; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            </div>
		</div>
	<hr />
	<?php }
    }
    ?>                 
     
</section>
 

 

