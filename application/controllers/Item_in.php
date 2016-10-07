<?php
class Item_in extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
        $this->load->model('model_app'); 
        //$this->load->helper('currency_format_helper');
    }

    function index(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin' or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial') { 
        $data=array(
            'title'=>'Item In',
            'active_item_in'=>'active',
            'data_item_in'=>$this->model_app->getAllDataItemIn(),       
			 );
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows();  
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_item_in');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}
	}
	
	
	
	// TAMBAH ITEM MASUK
    function pages_add_item_in(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'inventory_admin') {  
		//$id_agen['id_agen'] = $this->session->userdata('IDAGEN'); untuk id agen itu saja
		$id_agen['id_agen']=$this->session->userdata('IDAGEN');
        $data=array(
            'title'=>'Add Item In',
            'active_item_in'=>'active',
            'id_item_in'=>$this->model_app->getIDItemIn(),
            'data_category'=>$this->model_app->getAllData('tbl_master_category'),
            'data_agen'=>$this->model_app->getSelectedData('tbl_master_agen',$id_agen)->result(), //untuk id agen itu saja
            //'data_agen'=>$this->model_app->getAllData('tbl_master_agen'),
            'data_delivery_service'=>$this->model_app->getAllData('tbl_master_delivery_service'),
        );
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows(); 
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_add_item_in');
        $this->load->view('element/v_footer');
		}
    }
	
	// TAMBAH ITEM MASUK
	
	
	// SAVE TAMBAH ITEM MASUK
    function save_item_in(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'inventory_admin') {
			$itemin['id_item_in'] = $this->input->post('id_item_in');
			$itemin['date_in'] = $this->input->post('date_in');
			$itemin['note'] = $this->input->post('note_ii');
			$itemin['inputer'] = $this->input->post('inputer');
			
			foreach ($_POST['additemin'] as $key => $count )
			{
			$item['id_item'] = $this->input->post('id_item_in').$this->input->post('id_item_'.$count);
			$item['item_name'] = $this->input->post('item_name_'.$count);
			$item['esn'] = $this->input->post('esn_'.$count);
			$item['sn'] = $this->input->post('sn_'.$count);
			$item['total'] = $this->input->post('total_'.$count);
			$item['status'] = $this->input->post('status_'.$count);
			$item['contents'] = $this->input->post('contents_'.$count);
			$item['note'] = $this->input->post('note_'.$count);
			$item['inputer'] = $this->input->post('inputer');
			
			$detailitem['id_item'] = $this->input->post('id_item_in').$this->input->post('id_item_'.$count);
			$detailitem['id_category'] = $this->input->post('id_category_'.$count);
			$detailitem['id_item_in'] = $this->input->post('id_item_in');
			$detailitem['id_agen'] = $this->input->post('id_agen');
			$detailitem['inputer'] = $this->input->post('inputer');
			
			$detailitemin['id_delivery_service'] = $this->input->post('id_delivery_service');
			$detailitemin['id_item_in'] = $this->input->post('id_item_in');
			$detailitemin['id_item'] = $this->input->post('id_item_in').$this->input->post('id_item_'.$count);
			$detailitemin['id_agen'] = $this->input->post('id_agen');
			$detailitemin['inputer'] = $this->input->post('inputer');
			
			$this->db->insert('tbl_master_item', $item);
			$this->db->insert('tbl_detail_item', $detailitem);
			$this->db->insert('tbl_detail_item_in', $detailitemin);
			}
			
			$this->db->insert('tbl_master_item_in', $itemin);
			
			header('location:'.base_url().'item_in');
		}
    }
	
	// SAVE TAMBAH ITEM MASUK
	
	
	//LIHAT DATA ITEM IN
    function detail_item_in(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin'or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial') { 
        $data=array(
            'title'=>'Detail Item In',
            'active_item_in'=>'active', 
            'data_header_item_in'=>$this->model_app->getDataHeaderItemIn(), 
            'data_item_for_item_in'=>$this->model_app->getDataItemForItemIn(),       
			 );
		
		$id_item_in['id_item_in'] = $this->uri->segment(3);
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows(); 
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_item_in');
        $this->load->view('element/v_footer');

		}
    }
	
	//LIHAT DATA ITEM IN
	
	//PRINT RECEIPT ITEM IN
    function print_item_in(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin'or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial') { 
        $data=array(
            'title'=>'Print Item In',
            'active_item_in'=>'active',
            'data_header_item_in'=>$this->model_app->getDataHeaderItemIn(), 
            'data_item_for_item_in'=>$this->model_app->getDataItemForItemIn(),        
			 );
		
		$id_item_in['id_item_in'] = $this->uri->segment(3);
		 
		
        $this->load->view('pages/v_print_item_in',$data);
		}
    }
 	//PRINT RECEIPT ITEM IN
}