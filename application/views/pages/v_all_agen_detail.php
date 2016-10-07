<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a> 
        </div>
        <h2 class="panel-title">All Agen Detail</h2>
    </header>
    
    <div class="panel-body">
        <div class="table-responsive"> 
<!--        <table class="table table-bordered table-striped mb-none" id="datatable-details"  data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">-->

        <table class="table table-bordered table-striped table-condensed mb-none" id="datatable-tabletools" data-swf-path="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
            <thead>
                <tr>                                 
                    <th>No</th>
                    <th>Agent name</th>
                    <th>Status</th>
                    <th>Phone Number 1</th>
                    <th>Phone Number 2</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Terminal ID</th>
                    <th>No Unique Agent</th>
                    <th>Virtual Account Number</th>
                    <th>Virtual Account Name</th>
                    <th>Operational Name</th> 
                    <th>Operational Address</th>
                    <th>Nearest Branch</th>
                    <th>Agent Type</th>
                    <th>Date Of Interested</th>
                    <th>Date Of KYC Collected</th>
                    <th>Date Of Submit to BCA</th>
                    <th>Date Of Approve/Reject/Canceled</th>
                    <th>Date Of Install</th>
                    <th>Date Of Training</th>
                    <th>Date Of Active</th>
                    <th>Front Side Agent</th>
                    <th>Across Side Agent</th> 
                    <th>Right Side Agent</th>
                    <th>Left Side Agent</th>
                    <th>Agent Photograph</th>
                    <th>Agent KTP</th>
                    <th>Agent Registration Form</th>
                    <th>BCA Cover Book Agent</th>
                    <th>NPWP / Statement Letter</th>
                    <th>Business certificates / BAPU</th> 
                    <th>Installation Image</th>
                    <th>Training Image</th>
                    <th>PKS(Cooperation Statement) Agent Image</th>
                    <th>Certificate Image</th>
                    <th>Banner Image</th>
                    <th>Activation/opening Image</th>
                    <?php 
						if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin') { 
					?>
                    <th>Data Creator</th>
                    <th>Editor Log</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
             <?php
			 if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'inventory_admin') { 
				$no=1;
				if(isset($data_agen)){
					foreach($data_agen as $row){
						?>
                        <tr class="gradeX">
                            <th><?php echo $no++; ?></th>
                            <th><?php echo $row->agen_name; ?></th>
                            <th><?php echo $row->status; ?></th>
                            <th><?php echo $row->agen_phone_number_1; ?></th>
                            <th><?php echo $row->agen_phone_number_2; ?></th>
                            <th><?php echo $row->agen_address; ?></th>
                            <th><?php echo $row->agen_city; ?></th>
                            <th><?php echo $row->agen_province; ?></th>
                            <th><?php echo $row->longitude; ?></th>
                            <th><?php echo $row->latitude; ?></th>
                            <th><?php echo $row->terminal_id; ?></th>
                            <th><?php echo $row->no_unique_agen; ?></th>
                            <th><?php echo $row->virtual_account_number; ?></th>
                            <th><?php echo $row->virtual_account_name; ?></th>
                            <th><?php echo $row->agen_operational_name; ?></th>
                            <th><?php echo $row->agen_operational_address; ?></th>
                            <th><?php echo $row->agen_nearest_branch; ?></th>
                            <th><?php echo $row->agen_type; ?></th>
                            <th><?php echo $row->date_of_interested; ?></th>
                            <th><?php echo $row->date_of_kyc_collected; ?></th>
                            <th><?php echo $row->date_of_submit_to_bca; ?></th>
                            <th><?php echo $row->date_of_approve_or_reject_or_canceled; ?></th>
                            <th><?php echo $row->date_of_install; ?></th>
                            <th><?php echo $row->date_of_training; ?></th>
                            <th><?php echo $row->date_of_active; ?></th>
                            <th>
							   <?php if ($row->foto_tampak_depan_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_tampak_depan_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_tampak_seberang_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_tampak_seberang_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_tampak_kanan_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_tampak_kanan_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_tampak_kiri_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_tampak_kiri_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_ktp==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_ktp; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_form_pengajuan_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_form_pengajuan_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_cover_buku_tabungan==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_cover_buku_tabungan; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_surat_keterangan_usaha_atau_bapu==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_surat_keterangan_usaha_atau_bapu; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_instalasi_mesin_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_instalasi_mesin_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_training_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_training_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_pks_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_pks_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_sertifikat_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_sertifikat_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_spanduk_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_spanduk_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_aktifasi_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_aktifasi_agen; ?>">
                               <?php } ?>
                            </th>
                            <?php 
								if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin') { 
							?>
                            <th><?php echo $row->inputer; ?></th>
                            <th><?php echo $row->last_edit_by; ?></th>
                            <?php } ?>
						</tr>
					<?php }
				}
			 }
			
             if ($this->session->userdata('LEVEL') == 'sales') { 
				$no=1;
				if(isset($data_agen_no_indepay)){
					foreach($data_agen_no_indepay as $row){
						?>
                        <tr class="gradeX">
                            <th><?php echo $no++; ?></th>
                            <th><?php echo $row->agen_name; ?></th>
                            <th><?php echo $row->status; ?></th>
                            <th><?php echo $row->agen_phone_number_1; ?></th>
                            <th><?php echo $row->agen_phone_number_2; ?></th>
                            <th><?php echo $row->agen_address; ?></th>
                            <th><?php echo $row->agen_city; ?></th>
                            <th><?php echo $row->agen_province; ?></th>
                            <th><?php echo $row->longitude; ?></th>
                            <th><?php echo $row->latitude; ?></th>
                            <th><?php echo $row->terminal_id; ?></th>
                            <th><?php echo $row->no_unique_agen; ?></th>
                            <th><?php echo $row->virtual_account_number; ?></th>
                            <th><?php echo $row->virtual_account_name; ?></th>
                            <th><?php echo $row->agen_operational_name; ?></th>
                            <th><?php echo $row->agen_operational_address; ?></th>
                            <th><?php echo $row->agen_nearest_branch; ?></th>
                            <th><?php echo $row->agen_type; ?></th>
                            <th><?php echo $row->date_of_interested; ?></th>
                            <th><?php echo $row->date_of_kyc_collected; ?></th>
                            <th><?php echo $row->date_of_submit_to_bca; ?></th>
                            <th><?php echo $row->date_of_approve_or_reject_or_canceled; ?></th>
                            <th><?php echo $row->date_of_install; ?></th>
                            <th><?php echo $row->date_of_training; ?></th>
                            <th><?php echo $row->date_of_active; ?></th>
                            <th>
							   <?php if ($row->foto_tampak_depan_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_tampak_depan_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_tampak_seberang_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_tampak_seberang_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_tampak_kanan_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_tampak_kanan_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_tampak_kiri_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_tampak_kiri_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_ktp==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_ktp; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_form_pengajuan_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_form_pengajuan_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_cover_buku_tabungan==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_cover_buku_tabungan; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_npwp_atau_surat_keterangan_tidak_punya==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_npwp_atau_surat_keterangan_tidak_punya; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_surat_keterangan_usaha_atau_bapu==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_surat_keterangan_usaha_atau_bapu; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_instalasi_mesin_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_instalasi_mesin_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_training_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_training_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_pks_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_pks_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_sertifikat_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_sertifikat_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_spanduk_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_spanduk_agen; ?>">
                               <?php } ?>
                            </th>
                            <th>
							   <?php if ($row->foto_aktifasi_agen==""){ ?>
                               No Image
                               <?php }
                               else{
                               ?>
                               <img height="240" width="280" src="<?php echo base_url(); ?>assets/foto/<?php echo $row->foto_aktifasi_agen; ?>">
                               <?php } ?>
                            </th>
                            <?php 
								if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin') { 
							?>
                            <th><?php echo $row->inputer; ?></th>
                            <th><?php echo $row->last_edit_by; ?></th>
                            <?php } ?>
						</tr>
					<?php }
				}
			 }
			?>  
            </tbody>
        </table>
        </div>
    </div>
    
</section>
 