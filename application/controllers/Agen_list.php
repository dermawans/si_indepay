<?php
class Agen_list extends CI_Controller{
    function __construct()
	{
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE )
		{
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
        $this->load->model('model_app');
		$this->load->library('cart');
        //$this->load->helper('currency_format_helper');
    	}
 
    function index()
	{
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') {  
        $data=array(
            'title'=>'Agen List',
            'active_agen'=>'active',
            'id_agen'=>$this->model_app->getIDAgen(),
            'data_agen'=>$this->model_app->getAllData('tbl_master_agen'),
            'data_agen_no_indepay'=>$this->model_app->getDataAgenNoIndepay(),
            'data_master_status_agen'=>$this->model_app->getAllData('tbl_master_status_agen'),
            'data_master_agen_type'=>$this->model_app->getAllData('tbl_master_agen_type'),
			 );
		/* hapus untuk aktifin map
		//maps
		$this->load->library('googlemaps');
		
		// $tipe['tipe'] = 1;	
		$q = $this->model_app->getDataWarnaStatusAgen();
			$d = array();
	 	$marker = array();
		foreach($q->result() as $idl)
		{
		$config['center'] = '-1.3400634,120.5917678';
		$config['zoom'] = '5';
		$this->googlemaps->initialize($config);
			 
		$marker['position'] = $idl->longitude.','.$idl->latitude;
		$marker['infowindow_content'] = $idl->agen_operational_name;
		$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='.$idl->agen_operational_name.'|'.$idl->warna_lingkaran.'|'.$idl->warna_huruf_dalam_lingkaran.'';
		$this->googlemaps->add_marker($marker);
		}
		 $data['map'] = $this->googlemaps->create_map();
		 
		//maps
		 hapus untuk aktifin map*/
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows();
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows();
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows();
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_agen_list');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}
    }
 	
	//All agent detail
	function all_agen_detail()
	{
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') { 
        $data=array(
            'title'=>'Agen List',
            'active_agen'=>'active',
            'id_agen'=>$this->model_app->getIDAgen(),
            'data_agen'=>$this->model_app->getAllData('tbl_master_agen'),
            'data_agen_no_indepay'=>$this->model_app->getDataAgenNoIndepay(),
			 );
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows();
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows();
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows();
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_all_agen_detail');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}
    }
	
	//INSERT DATA AGEN
    function add_agen(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'sales') { 
		
			$agen['id_agen'] = $this->input->post('id_agen');
			$agen['agen_name'] = $this->input->post('agen_name');
			$agen['status'] = $this->input->post('status');
			$agen['agen_phone_number_1'] = $this->input->post('agen_phone_number_1');
			$agen['agen_phone_number_2'] = $this->input->post('agen_phone_number_2');
			$agen['agen_address'] = $this->input->post('agen_address');
			$agen['agen_city'] = $this->input->post('agen_city');
			$agen['agen_province'] = $this->input->post('agen_province');
			$agen['longitude'] = $this->input->post('longitude');
			$agen['latitude'] = $this->input->post('latitude');
			$agen['terminal_id'] = $this->input->post('terminal_id');
			$agen['no_unique_agen'] = $this->input->post('no_unique_agen');
			$agen['virtual_account_number'] = $this->input->post('virtual_account_number');
			$agen['virtual_account_name'] = $this->input->post('virtual_account_name'); 
			$agen['agen_operational_name'] = $this->input->post('agen_operational_name');
			$agen['agen_operational_address'] = $this->input->post('agen_operational_address');
			$agen['agen_nearest_branch'] = $this->input->post('agen_nearest_branch');
			$agen['agen_type'] = $this->input->post('agen_type');
			$agen['note'] = $this->input->post('note');
			$agen['date_of_interested'] = $this->input->post('date_of_interested');
			$agen['inputer'] = $this->input->post('inputer');
	
			$this->db->insert('tbl_master_agen', $agen);
			
			
			//fungsi upload foto tampak depan
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Tampak Depan Agen-".$name."-".$sales;  
			$config['upload_path'] = 'assets/foto/'; 
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';  
	 		$config['file_name'] = $nmfile; 
	 
			$this->upload->initialize($config);
			
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filetampakdepanagen']['name'])
			{
				if ($this->upload->do_upload('filetampakdepanagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_tampak_depan_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 
			
			
			//fungsi upload foto tampak seberang
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Tampak Seberang Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';  
	 		$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filetampakseberangagen']['name'])
			{
				if ($this->upload->do_upload('filetampakseberangagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_tampak_seberang_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 
			
			//fungsi upload foto tampak kanan
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Tampak Kanan Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filetampakkananagen']['name'])
			{
				if ($this->upload->do_upload('filetampakkananagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_tampak_kanan_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 
			 		
			//fungsi upload foto tampak kiri
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Tampak Kiri Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filetampakkiriagen']['name'])
			{
				if ($this->upload->do_upload('filetampakkiriagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_tampak_kiri_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 
			
			header('location:'.base_url().'agen_list');
		}
	}
	
	//UPDATE DATA AGEN
    function save_agen(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin') { 
		
			$id_agen['id_agen'] = $this->input->post('id_agen');
			$agen['agen_name'] = $this->input->post('agen_name');
			$agen['status'] = $this->input->post('status');
			$agen['agen_phone_number_1'] = $this->input->post('agen_phone_number_1');
			$agen['agen_phone_number_2'] = $this->input->post('agen_phone_number_2');
			$agen['agen_address'] = $this->input->post('agen_address');
			$agen['agen_city'] = $this->input->post('agen_city');
			$agen['agen_province'] = $this->input->post('agen_province');
			$agen['longitude'] = $this->input->post('longitude');
			$agen['latitude'] = $this->input->post('latitude');
			$agen['terminal_id'] = $this->input->post('terminal_id');
			$agen['no_unique_agen'] = $this->input->post('no_unique_agen');
			$agen['virtual_account_number'] = $this->input->post('virtual_account_number');
			$agen['virtual_account_name'] = $this->input->post('virtual_account_name'); 
			$agen['agen_operational_name'] = $this->input->post('agen_operational_name');
			$agen['agen_operational_address'] = $this->input->post('agen_operational_address');
			$agen['agen_nearest_branch'] = $this->input->post('agen_nearest_branch');
			$agen['agen_type'] = $this->input->post('agen_type');
			$agen['note'] = $this->input->post('note');
			if ($this->input->post('status')=='Submit to BCA')
				{
			$agen['date_of_submit_to_bca'] = $this->input->post('date_of_submit_to_bca');
				}
			if ($this->input->post('status')=='Approve' or $this->input->post('status')=='Rejected' or $this->input->post('status')=='Canceled')
				{
			$agen['date_of_approve_or_reject_or_canceled'] = $this->input->post('date_of_approve_or_reject_or_canceled');
				}
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
			
			//fungsi upload foto foto agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filefotoagen']['name'])
			{
				if ($this->upload->do_upload('filefotoagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 
			 	
			//fungsi upload foto ktp agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto KTP Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filektpagen']['name'])
			{
				if ($this->upload->do_upload('filektpagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_ktp' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 
			
			//fungsi upload foto form pengajuan agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Form Pengajuan Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['fileformregistrasiagen']['name'])
			{
				if ($this->upload->do_upload('fileformregistrasiagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_form_pengajuan_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 
			 
			//fungsi upload foto cover buku tabungan agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Cover Buku Tabungan Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filecoverbukutabunganagen']['name'])
			{
				if ($this->upload->do_upload('filecoverbukutabunganagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_cover_buku_tabungan' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 	
			 	
			 
			//fungsi upload foto npwp atau surat keterangan
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto NPWP atau Surat Keterangan Tidak Punya Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filenpwpagen']['name'])
			{
				if ($this->upload->do_upload('filenpwpagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_npwp_atau_surat_keterangan_tidak_punya' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 	
			
			//fungsi upload foto surat keterangan usaha atau bapu
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Surat Keterangan Usaha atau BAPU Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filesuratketeranganusahaagen']['name'])
			{
				if ($this->upload->do_upload('filesuratketeranganusahaagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_surat_keterangan_usaha_atau_bapu' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 	
			
			//fungsi upload foto instalasi mesin agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Instalasi Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['fileinstalasiagen']['name'])
			{
				if ($this->upload->do_upload('fileinstalasiagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_instalasi_mesin_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 	
			
			//fungsi upload foto training agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Training Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filetrainingagen']['name'])
			{
				if ($this->upload->do_upload('filetrainingagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_training_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 	
			
			
			//fungsi upload foto spanduk agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Spanduk Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filespandukagen']['name'])
			{
				if ($this->upload->do_upload('filespandukagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_spanduk_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 
			
			
			
			//fungsi upload foto sertifikat agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Spanduk Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filesertifikatagen']['name'])
			{
				if ($this->upload->do_upload('filesertifikatagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_sertifikat_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 
			
			//fungsi upload foto pks agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto PKS Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filetpksagen']['name'])
			{
				if ($this->upload->do_upload('filetpksagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_pks_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 	
			
			
			//fungsi upload foto aktifasi agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Aktifasi Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filepembukaanagen']['name'])
			{
				if ($this->upload->do_upload('filepembukaanagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_aktifasi_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
				}
       		} 	
			
			
			header('location:'.base_url().'agen_list');
		}
	}
	
	//UPDATE DATA AGEN TYPE
    function change_agen_type(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'sales') { 
		
			$id_agen['id_agen'] = $this->input->post('id_agen');
			$agen['agen_type'] = $this->input->post('agen_type');
			$agen['last_edit_by'] = $this->input->post('last_edit_by');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
			
			header('location:'.base_url().'agen_list');
		}
	}
	
	//view data detail agen
    function detail_agen(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') { 
		
        $data=array(
            'title'=>'Detail Agen',
            'active_agen'=>'active',
            'data_header_agen'=>$this->model_app->getDataHeaderAgen(),    
//            'data_item_for_agen'=>$this->model_app->getDataItemForAgen(),  
            'data_item_for_agen_indepay'=>$this->model_app->getDataItemForAgenIndepay(),  
			 );
		
		$id_agen['id_agen'] = $this->uri->segment(3);
		  
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows(); 
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_agen');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		} 
    }
	
	//print data detail agen
    function print_detail_agen(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') { 
		
        $data=array(
            'title'=>'Print Detail Agen',
            'active_agen'=>'active',
            'data_header_agen'=>$this->model_app->getDataHeaderAgen(),    
            'data_item_for_agen'=>$this->model_app->getDataItemForAgen(),  
            'data_item_for_agen_no_indepay'=>$this->model_app->getDataItemForAgenNoIndepay(),  
			 );
		
		$id_agen['id_agen'] = $this->uri->segment(3);
		  
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows();  
		 
        $this->load->view('pages/v_print_detail_agen',$data); 

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}
    }
	
	
	//view data
    function detail_item_in_agen(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') { 
		
        $data=array(
            'title'=>'Detail Item In Agen',
            'active_agen'=>'active',
            'data_header_detail_item_in_agen'=>$this->model_app->getDataHeaderDetailItemInAgen(), 
            'data_item_for_detail_item_in_agen'=>$this->model_app->getDataItemForDetailItemInAgen(),  
			 );
		
		$id_item_in['id_item_in'] = $this->uri->segment(3);
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows(); 
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_item_in_agen');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		} 
    }
	
	
	//print data detail item agen
    function print_detail_item_in_agen(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') { 
		 
        $data=array(
            'title'=>'Print Detail Item In Agen',
            'active_agen'=>'active',
            'data_header_detail_item_in_agen'=>$this->model_app->getDataHeaderDetailItemInAgen(), 
            'data_item_for_detail_item_in_agen'=>$this->model_app->getDataItemForDetailItemInAgen(),        
			 );
		
		$id_item_in['id_item_in'] = $this->uri->segment(3);
		  
		
        $this->load->view('pages/v_print_detail_item_in_agen',$data);

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}
    }
	
	
	//view data
    function detail_item_out_agen(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') { 
		
        $data=array(
            'title'=>'Detail Item In Agen',
            'active_agen'=>'active',
            'data_header_detail_item_out_agen'=>$this->model_app->getDataHeaderDetailItemOutAgen(), 
            'data_item_for_detail_item_out_agen'=>$this->model_app->getDataItemForDetailItemOutAgen(),  
			 );
		
		$id_item_in['id_item_in'] = $this->uri->segment(3);
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows(); 
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_item_out_agen');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		} 
    }
	
	
	//print data detail item agen
    function print_detail_item_out_agen(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') { 
		 
        $data=array(
            'title'=>'Print Detail Item In Agen',
            'active_agen'=>'active',
            'data_header_detail_item_out_agen'=>$this->model_app->getDataHeaderDetailItemOutAgen(), 
            'data_item_for_detail_item_out_agen'=>$this->model_app->getDataItemForDetailItemOutAgen(),        
			 );
		
		$id_item_in['id_item_in'] = $this->uri->segment(3);
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows();  
		
        $this->load->view('pages/v_print_detail_item_out_agen',$data);

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}
    }	
	
	
	
	//UPDATE DATA AGEN TO PROSES KYC COLLECTING BY SALES
    function proses_agen_to_kyc_collecting_by_sales(){
		if ($this->session->userdata('LEVEL') == 'sales') { 
		
			$id_agen['id_agen'] = $this->input->post('id_agen');
			$agen['status'] = $this->input->post('status');
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
			
			header('location:'.base_url().'agen_list');
		}
	}
	
	
	//UPDATE DATA KYC AGEN BY SALES
    function add_kyc_by_sales(){
		if ($this->session->userdata('LEVEL') == 'sales') { 
		
			
			//fungsi upload foto foto agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filefotoagen']['name'])
			{
				if ($this->upload->do_upload('filefotoagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			 
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 
			 	
			//fungsi upload foto ktp agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto KTP Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filektpagen']['name'])
			{
				if ($this->upload->do_upload('filektpagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_ktp' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 
			
			//fungsi upload foto form pengajuan agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Form Pengajuan Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['fileformregistrasiagen']['name'])
			{
				if ($this->upload->do_upload('fileformregistrasiagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_form_pengajuan_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 
			 
			//fungsi upload foto cover buku tabungan agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Cover Buku Tabungan Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filecoverbukutabunganagen']['name'])
			{
				if ($this->upload->do_upload('filecoverbukutabunganagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_cover_buku_tabungan' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 	
			 	
			 
			//fungsi upload foto npwp atau surat keterangan
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto NPWP atau Surat Keterangan Tidak Punya Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filenpwpagen']['name'])
			{
				if ($this->upload->do_upload('filenpwpagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_npwp_atau_surat_keterangan_tidak_punya' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 	
			
			//fungsi upload foto surat keterangan usaha atau bapu
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Surat Keterangan Usaha atau BAPU Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filesuratketeranganusahaagen']['name'])
			{
				if ($this->upload->do_upload('filesuratketeranganusahaagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_surat_keterangan_usaha_atau_bapu' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 	
			
			
			header('location:'.base_url().'agen_list');
		}
	}
	  
	
	//UPDATE DATA AGEN TO PROSES KYC COLLECTED BY SALES
    function proses_to_kyc_collected_by_sales(){
		if ($this->session->userdata('LEVEL') == 'sales') { 
		
			$id_agen['id_agen'] = $this->input->post('id_agen');
			$agen['status'] = $this->input->post('status');
			$agen['date_of_kyc_collected'] = $this->input->post('date_of_kyc_collected');
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
			
			header('location:'.base_url().'agen_list');
		}
	}
	
	//UPDATE DATA AGEN TO PROSES INSTALL BY SALES
    function proses_to_installation_by_sales(){
		if ($this->session->userdata('LEVEL') == 'sales') { 
		
			$id_agen['id_agen'] = $this->input->post('id_agen');
			$agen['status'] = $this->input->post('status');
			$agen['date_of_install'] = $this->input->post('date_of_install');
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
			
			header('location:'.base_url().'agen_list');
		}
	}
	
	
	
	//UPDATE DATA FOTO INSTALLATION BY SALES
    function add_installation_photo_by_sales(){
		if ($this->session->userdata('LEVEL') == 'sales') { 
		
			//fungsi upload foto instalasi mesin agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Instalasi Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['fileinstalasiagen']['name'])
			{
				if ($this->upload->do_upload('fileinstalasiagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_instalasi_mesin_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 	
			 
			//fungsi upload foto spanduk agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Spanduk Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filespandukagen']['name'])
			{
				if ($this->upload->do_upload('filespandukagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_spanduk_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 
			
			
			
			//fungsi upload foto sertifikat agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Spanduk Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filesertifikatagen']['name'])
			{
				if ($this->upload->do_upload('filesertifikatagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_sertifikat_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 
			
			//fungsi upload foto pks agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto PKS Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filetpksagen']['name'])
			{
				if ($this->upload->do_upload('filetpksagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_pks_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 	
			 
			header('location:'.base_url().'agen_list');
		}
	}
	  
	
	
	//UPDATE DATA AGEN TO PROSES TRAINING BY SALES
    function proses_to_training_by_sales(){
		if ($this->session->userdata('LEVEL') == 'sales') { 
		
			$id_agen['id_agen'] = $this->input->post('id_agen');
			$agen['status'] = $this->input->post('status');
			$agen['date_of_training'] = $this->input->post('date_of_training');
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
			
			header('location:'.base_url().'agen_list');
		}
	}  
	  
	
	//UPDATE DATA FOTO TRAINING BY SALES
    function add_training_photo_by_sales(){
		if ($this->session->userdata('LEVEL') == 'sales') { 
		
			//fungsi upload foto training agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Training Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filetrainingagen']['name'])
			{
				if ($this->upload->do_upload('filetrainingagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_training_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen); 
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
				}
       		} 	
			
			header('location:'.base_url().'agen_list');
		}
	}
	
	
	
	//UPDATE DATA AGEN TO PROSES ACTIVATING BY SALES
    function proses_to_acivating_by_sales(){
		if ($this->session->userdata('LEVEL') == 'sales') { 
		
			$id_agen['id_agen'] = $this->input->post('id_agen');
			$agen['status'] = $this->input->post('status');
			$agen['date_of_active'] = $this->input->post('date_of_active');
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen);
			
			header('location:'.base_url().'agen_list');
		}
	}  
	  
	
	//UPDATE DATA FOTO ACTIVATING BY SALES
    function add_activating_photo_by_sales(){
		if ($this->session->userdata('LEVEL') == 'sales') { 
		
			
			//fungsi upload foto aktifasi agen
			$this->load->library('upload');
			$name=$this->input->post('agen_name');
			$agen_city=$this->input->post('agen_city');
			$agen_province=$this->input->post('agen_province');
			$sales=$this->session->userdata('NAME');
			$nmfile = $agen_city."-".$agen_province."-Foto Aktifasi Agen-".$name."-".$sales; 
			$config['upload_path'] = 'assets/foto/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
	 
			$this->upload->initialize($config);
			$id_agen['id_agen']=$this->input->post('id_agen');
					
			if($_FILES['filepembukaanagen']['name'])
			{
				if ($this->upload->do_upload('filepembukaanagen'))
				{
					
					$gbr = $this->upload->data();
					$datafoto = array(
					  'foto_aktifasi_agen' =>$gbr['file_name']
					   
					);
	 		
			$this->db->update('tbl_master_agen', $datafoto,$id_agen);
			
			$agen['last_edit_by'] = $this->input->post('last_edit_by_1')."<br><br>".$this->input->post('last_edit_by_2');
	
			$this->db->update('tbl_master_agen', $agen, $id_agen); 
				}
       		} 	
				
			
			header('location:'.base_url().'agen_list');
		}
	}
	
	
	  
	  
	  
	  
	  
	  
	  
}
