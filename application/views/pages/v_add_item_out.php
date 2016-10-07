<?php if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'inventory_admin') { 
?>
<!-- start: page -->
<div class="row">
    <section class="panel panel-dark">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
            </div>

            <h2 class="panel-title">Add Item Out</h2>
        </header>
        <div class="panel-body">
        <!-- start form -->
        <?php echo form_open_multipart('item_out/save_item_out','id="wizard" class="form-horizontal"'); ?> 
          
            <div class="panel-body">
                    <div class="table-responsive"> 
                    <table class="table table-bordered table-striped table-condensed mb-none">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th> 
                            <th>Item Name</th>
                            <th>ESN</th>
                            <th>SN</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Contents</th>
                            <th>Note</th>
                            <th><a href="#add_item_out" class="modal-with-form btn btn-sm btn-dark"><i class="fa fa-plus-circle"></i> Add Item</a></th>
                        </tr>
                        </thead> 
                        <tbody>
                        <?php $i=1; $no=1;?>
                        <?php foreach($this->cart->contents() as $items): ?>
                            <?php echo form_hidden('rowid[]', $items['rowid']); ?>
                                    <tr class="gradeX">
                                        <th><?php echo $no++; ?></th> 
                                        <th><?php echo $items['id'] ?></th>
                                        <th><?php echo $items['name']; ?></th>
                                        <th><?php echo $items['esn']; ?></th>
                                        <th><?php echo $items['sn']; ?></th> 
                                        <th><?php echo $items['total']; ?></th>
                                        <th><?php echo $items['status']; ?></th>
                                        <th><?php echo $items['contents']; ?></th>
                                        <th><?php echo $items['note']; ?></th> 
                                        <th><a href="<?php echo base_url(); ?>item_out/hapus/<?php echo $items['rowid']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete Item</a></th>
                                    </tr>
                            <?php $i++; $no++;?>
                        <?php endforeach; ?> 
                        </tbody>
                    </table>
                    </div>
             </div>
            
            <hr />
            
            <div class="form-group">
            <label class="col-md-2 control-label">Date</label>
                <div class="col-md-3">
                    <input type="text" name="date_out" id="date_out" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d") ;  ?>" readonly>
                </div>
            </div>
            
            <div class="form-group">
            <label class="col-md-2 control-label">Receive Number</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="id_item_out" id="id_item_out" value="<?php echo $id_item_out; ?>" readonly required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Receiver</label>
                <div class="col-md-3">
                    <select data-plugin-selectTwo class="form-control populate" id="id_agen" name="id_agen" data-placeholder="Chose Receiver" required>
                                <option value=""></option>
                        <?php
                        if(isset($data_agen)){
                            foreach($data_agen as $row){
                                ?>
                                <option value="<?php echo $row->id_agen;?>"><?php echo $row->agen_operational_name;?> - <?php echo $row->agen_name;?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                </div>
             </div>
              
            <div class="form-group">
                <label class="col-md-2 control-label">Delivery Service</label>
                <div class="col-md-3">
                    <select data-plugin-selectTwo class="form-control populate" id="id_delivery_service" name="id_delivery_service"  data-placeholder="Chose Delivery Service" required> 
                                <option value=""></option>
                        <?php
                        if(isset($data_delivery_service)){
                            foreach($data_delivery_service as $row){
                                ?>
                                <option value="<?php echo $row->id_delivery_service;?>"><?php echo $row->delivery_service_name;?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                </div>
             </div>
             
            <div class="form-group">
                <label class="col-md-2 control-label">Inputer</label>
                    <div class="col-md-4">
                        <input id="inputer" class="form-control" name="inputer" value="<?php echo $this->session->userdata('NAME') ?> <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i:s") ;  ?>" type="text" readonly>
                    </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-md-2 control-label">Note</label>
                    <div class="col-md-4">
                        <textarea name="note_io" id="textareaAutosize" class="form-control" data-plugin-textarea-autosize required></textarea>
                    </div>
            </div>
            
            <div class="panel-body">
                    <div class="table-responsive"> 
                    
                        <div class="panel-body">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                            <a href="<?php echo site_url('item_in')?>" class="btn btn-sm btn-default"><i class="icon-remove-sign"></i> Cancel</a>
                        </div> 
                    <?php echo form_close(); ?> 
                    <!-- end form -->	
                    </div>
            </div>
       </div> 
    </section>
</div>               
<!-- end: page -->


<!-- Modal Form Add Item --> 

<div id="add_item_out" class="modal-block modal-block-primary mfp-hide">
<?php echo form_open('item_out/add_item_to_chart','id="wizard" class="form-horizontal"'); ?> 
 
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Chose Item</h2>
        </header>
        <div class="panel-body"> 
                
            <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
				<div class="form-group mt-lg">
                    <label class="col-sm-4 control-label">Item</label>
                    <div class="col-sm-6">
                        <select data-plugin-selectTwo class="form-control populate" id="id_item" name="id_item"  data-placeholder="Chose Item">
                        	<option value=""></option>
                            <?php
                            if(isset($data_item_not_out))
                            {
                                foreach($data_item_not_out as $item)
                                {
                            ?>
                                    <option value="<?php echo $item->id_item;?>">Agen : <?php if($item->agen_name==""){ echo "No Agen | ";} else { echo $item->agen_name." | "; }?><?php echo $item->item_name;?> - <?php echo $item->sn;?> </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div> 
            	<div class="form-group mt-lg" id="detail_item"></div>
            </form>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
<?php echo form_close(); ?> 
</div>  
<!-- Modal Form Add Item-->


<script type="text/javascript">
    $(document).ready(function() {
        $("#id_item").change(function(){
            var id_item = $("#id_item").val();
            $.ajax({
                type: "POST",
                url : "<?php echo base_url('item_out/get_detail_item'); ?>",
                data: "id_item="+id_item,
                cache:false,
                success: function(data){
                    $('#detail_item').html(data);
                    document.frm.add.disabled=false;
                }
            });
        }); 
        $(".delbutton").click(function(){
            var element = $(this);
            var del_id = element.attr("id");
            var info = del_id;
            if(confirm("Anda yakin akan menghapus?"))
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>penjualan/hapus_penjualan",
                    data: "kode="+info,
                    cache: false,
                    success: function(){
                    }
                });
                $(this).parents(".gradeX").animate({ opacity: "hide" }, "slow");
            }
            return false;
        });
    })
</script>

<?php } ?>