<?php
if(isset($detail_item)){
    foreach($detail_item as $row){
        ?>
		
	<div class="form-group mt-lg">
        <label class="col-sm-4 control-label">Item Name</label>
                    <div class="col-sm-6">
                        <input name="item_name"  class="form-control"  type="text" value="<?php echo $row->item_name; ?>" readonly="readonly">
                    </div> 
   	</div>
         
	<div class="form-group mt-lg">
         <label class="col-sm-4 control-label">ESN</label>
                    <div class="col-sm-6">
                        <input name="esn"  class="form-control"  type="text" value="<?php echo $row->esn; ?>" readonly="readonly">
                    </div> 
   	</div>
    
    <div class="form-group mt-lg">
         <label class="col-sm-4 control-label">SN</label>
                    <div class="col-sm-6">
                        <input name="sn"  class="form-control"  type="text" value="<?php echo $row->sn; ?>" readonly="readonly">
                    </div> 
   	</div>     
      
    <div class="form-group mt-lg">
         <label class="col-sm-4 control-label">Total</label>
                    <div class="col-sm-6">
                        <input name="total"  class="form-control"  type="text" value="<?php echo $row->total; ?>" readonly="readonly">
                    </div> 
   	</div> 
        
    <div class="form-group mt-lg">
         <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-6">
                        <input name="status"  class="form-control"  type="text" value="<?php echo $row->status; ?>" readonly="readonly">
                    </div> 
   	</div> 
      
    <div class="form-group mt-lg">
         <label class="col-sm-4 control-label">Contens</label>
                    <div class="col-sm-6">
                        <input name="contents"  class="form-control"  type="text" value="<?php echo $row->contents; ?>" readonly="readonly">
                    </div> 
   	</div> 
     
    <div class="form-group mt-lg">
         <label class="col-sm-4 control-label">Note</label>
                    <div class="col-sm-6">
                        <textarea name="note" class="form-control" readonly="readonly" id="textareaAutosize" data-plugin-textarea-autosize><?php echo $row->note; ?></textarea>
                    </div> 
   	</div> 
                                          
    <?php
    }
}
?>
