<?php
if(isset($data_master_agen)){
    foreach($data_master_agen as $row){
        ?>
		
	<div class="form-group mt-lg">
        <label class="col-sm-4 control-label">Agen Name</label>
                    <div class="col-sm-6">
                        <input name="name"  class="form-control"  type="text" value="<?php echo $row->agen_name; ?>" readonly="readonly">
                    </div> 
   	</div>
                                      
    <?php
    }
}
?>
