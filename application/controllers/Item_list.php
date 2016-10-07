<?php
class Item_list extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
        $this->load->model('model_app');
		$this->load->library('cart');
        //$this->load->helper('currency_format_helper');
    }

    function index(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin'or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial') { 
        $data=array(
            'title'=>'Item List',
            'active_item_list'=>'active',
            'data_item'=>$this->model_app->getDataAllItem(),       
			 );
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows(); 
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_item_list');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}
    }
 	
	//view detail data item list
    function detail_item_list(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin'or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial') { 
        $data=array(
            'title'=>'Item List',
            'active_item_list'=>'active', 
            'data_item_list_header_item_in'=>$this->model_app->getDataItemListDetailHeaderItemIn(), 
            'data_item_list_item_for_item_in'=>$this->model_app->getDataItemListDetailItemForItemIn(),
            'data_item_list_header_item_out'=>$this->model_app->getDataItemListDetailHeaderItemOut(), 
            'data_item_list_item_for_item_out'=>$this->model_app->getDataItemListItemDetailForItemOut(),       
			 );
		
		$id_item['id_item'] = $this->uri->segment(3);
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows(); 
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_item_list');
        $this->load->view('element/v_footer');

		}
    }
	
}