<?php
class Master_data extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
        $this->load->model('model_app');
		$data=array();
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows();
    }

    function index(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin'or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') {
        $data=array(
            'title'=>'Master Data',
            'active_master_data'=>'active', 
            'data_master_level_user'=>$this->model_app->getAllData('tbl_master_level_user'),
            'data_master_delivery_service'=>$this->model_app->getAllData('tbl_master_delivery_service'),
            'data_master_agen_type'=>$this->model_app->getAllData('tbl_master_agen_type'),
            'data_master_status_agen'=>$this->model_app->getAllData('tbl_master_status_agen'),
            'data_master_category'=>$this->model_app->getAllData('tbl_master_category'),
            'data_master_user'=>$this->model_app->getAllData('tbl_master_user'),
            'data_master_agen'=>$this->model_app->getAllData('tbl_master_agen'),
            'data_master_user_no_sudo'=>$this->model_app->getAllDataUserNoSudo(),
            'id_user'=>$this->model_app->getIDUser(),
        );
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows(); 
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_master_data');
        $this->load->view('element/v_footer');
		}
    }
	
	
	// detail item
    function get_detail_agen(){
        $id_agen['id_agen']=$this->input->post('id_agen');
        $data=array(
            'data_master_agen'=>$this->model_app->getSelectedData('tbl_master_agen',$id_agen)->result(),
        );
        $this->load->view('pages/ajax_detail_add_user',$data);
    }	 
	
	//    INSERT DATA DELIVERY SERVICE
    function add_delivery_service(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin') {
		
			$deliveryservice['delivery_service_name'] = $this->input->post('delivery_service_name');
			$deliveryservice['inputer'] = $this->input->post('inputer');
	
			$this->db->insert('tbl_master_delivery_service', $deliveryservice);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA DELIVERY SERVICE
    function save_delivery_service(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin') {
			
			$id_delivery_service['id_delivery_service']= $this->input->post('id_delivery_service');
			$deliveryservice['delivery_service_name'] = $this->input->post('delivery_service_name');
			$deliveryservice['last_edit_by'] = $this->input->post('last_edit_by');
	
			$this->db->update('tbl_master_delivery_service', $deliveryservice, $id_delivery_service);
			
			header('location:'.base_url().'master_data');
		}
	}
	 
	//    INSERT DATA AGEN TYPE
    function add_agen_type(){
		if ($this->session->userdata('LEVEL') == 'super_admin') { 
		
			$agentype['agen_type_name'] = $this->input->post('agen_type_name');
			$agentype['inputer'] = $this->input->post('inputer');
	
			$this->db->insert('tbl_master_agen_type', $agentype);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA AGEN TYPE
    function save_agen_type(){
		if ($this->session->userdata('LEVEL') == 'super_admin') { 
			
			$id_agen_type['id_agen_type']= $this->input->post('id_agen_type');
			$agentype['agen_type_name'] = $this->input->post('agen_type_name');
			$agentype['last_edit_by'] = $this->input->post('last_edit_by');
	
			$this->db->update('tbl_master_agen_type', $agentype, $id_agen_type);
			
			header('location:'.base_url().'master_data');
		}
	}
	 
	//    INSERT DATA CATEGORY
    function add_category(){
		if ($this->session->userdata('LEVEL') == 'super_admin') { 
		
			$category['category_name'] = $this->input->post('category_name');
			$category['inputer'] = $this->input->post('inputer');
	
			$this->db->insert('tbl_master_category', $category);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA CATEGORY
    function save_category(){
		if ($this->session->userdata('LEVEL') == 'super_admin') { 
			
			$id_category['id_category']= $this->input->post('id_category');
			$category['agen_type_name'] = $this->input->post('agen_type_name');
			$category['last_edit_by'] = $this->input->post('last_edit_by');
	
			$this->db->update('tbl_master_category', $category, $id_category);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	
	//    INSERT DATA STATUS AGEN
    function add_status_agen(){
		if ($this->session->userdata('LEVEL') == 'super_admin') { 
		
			$status['nama_status'] = $this->input->post('nama_status') ;
			$status['warna_lingkaran'] = $this->input->post('warna_lingkaran') ;
			$status['warna_huruf_dalam_lingkaran'] = $this->input->post('warna_huruf_dalam_lingkaran') ;
	
			$this->db->insert('tbl_master_status_agen', $status);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA STATUS AGEN
    function save_status_agen(){
		if ($this->session->userdata('LEVEL') == 'super_admin') { 
			
			$id_status_agen['id_status_agen']= $this->input->post('id_status_agen');
			$status['nama_status'] = $this->input->post('nama_status'); 
			$status['warna_lingkaran'] = $this->input->post('warna_lingkaran') ;
			$status['warna_huruf_dalam_lingkaran'] = $this->input->post('warna_huruf_dalam_lingkaran') ;
	
			$this->db->update('tbl_master_status_agen', $status, $id_status_agen);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    INSERT DATA USER
    function add_user(){
		if ($this->session->userdata('LEVEL') == 'super_admin') { 
		
			$user['id_user'] = $this->input->post('id_user');
			$user['level'] = $this->input->post('level');
			$user['username'] = $this->input->post('username');
			$user['password'] = md5($this->input->post('password'));
			$user['id_agen'] = $this->input->post('id_agen');
			$user['name'] = $this->input->post('name');
			$user['date_create'] = $this->input->post('date_create');
			$user['created'] = $this->input->post('created');
	
			$this->db->insert('tbl_master_user', $user);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA USER
    function save_user(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin'or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') {
			
			$id_user['id_user']= $this->input->post('id_user'); 
			$user['username'] = $this->input->post('username'); 
			$user['last_edit'] = $this->input->post('last_edit');
	
			$this->db->update('tbl_master_user', $user, $id_user);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	//    UPDATE DATA PASSWORD USER
    function change_password(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin'or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial' or $this->session->userdata('LEVEL') == 'agent' or $this->session->userdata('LEVEL') == 'sales') {
			
			$id_user['id_user']= $this->input->post('id_user');
			$password['password'] = md5($this->input->post('password'));
			$password['last_edit'] = $this->input->post('last_edit');
	
			$this->db->update('tbl_master_user', $password, $id_user);
			
			header('location:'.base_url().'master_data');
		}
	}
	
	
	//    UPDATE DATA LEVEL
    function change_level(){
		if ($this->session->userdata('LEVEL') == 'super_admin') { 
			
			$id_user['id_user']= $this->input->post('id_user');
			$level['level'] = $this->input->post('level');
			$level['last_edit'] = $this->input->post('last_edit');
	
			$this->db->update('tbl_master_user', $level, $id_user);
			
			header('location:'.base_url().'master_data');
		}
	}
}
