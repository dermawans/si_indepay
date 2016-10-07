<?php
class Item_out extends CI_Controller{
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
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin'or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial') { 
        $data=array(
            'title'=>'Item Out',
            'active_item_out'=>'active',
            'data_item_out'=>$this->model_app->getAllDataItemOut(),       
			 );
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows(); 
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows(); 
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_item_out');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}
    }
	
	//pages add item out
    function pages_add_item_out(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'inventory_admin') { 
        $data=array(
            'title'=>'Add Item Out',
            'active_item_out'=>'active',
            'id_item_out'=>$this->model_app->getIDItemOut(),
            'data_item_not_out'=>$this->model_app->getAllDataItemNotOut(),
            'data_category'=>$this->model_app->getAllData('tbl_master_category'),
            'data_item'=>$this->model_app->getAllData('tbl_master_item'),
            'data_agen'=>$this->model_app->getDataAgen(), 
            'data_delivery_service'=>$this->model_app->getAllData('tbl_master_delivery_service'),
        );
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows();  
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_add_item_out');
        $this->load->view('element/v_footer');
		}
    } 
	
	
   // INSERT DATA TO CART
    function add_item_to_chart(){
        $data = array(
			'id'    => $this->input->post('id_item'), 
            'qty'   => 1,
            'price' => 1,
            'name'  => $this->input->post('item_name'),
            'esn'  => $this->input->post('esn'),
            'sn'  => $this->input->post('sn'),
            'total'  => $this->input->post('total'),
            'status'  => $this->input->post('status'),
            'contents'  => $this->input->post('contents'),
            'note'  => $this->input->post('note'),
        );
        $this->cart->insert($data);
        redirect('item_out/pages_add_item_out');
    }
	
   // HAPUS DATA DARI CART
	public function hapus()
	{
		$data = array(
				'rowid' => $this->uri->segment(3)
				,'qty'   => 0);
				$this->cart->update($data);
		redirect('item_out/pages_add_item_out');
	}
	
	
	// AMBIL LIST DETAIL TAMBAH ITEM OUT
    function get_detail_item(){
        $id_item['id_item']=$this->input->post('id_item');
        $data=array(
            'detail_item'=>$this->model_app->getSelectedData('tbl_master_item',$id_item)->result(),
        );
        $this->load->view('pages/ajax_detail_item',$data);
    }	 
	
	// save item out
    function save_item_out(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'inventory_admin') { 
        $data = array(
            'id_item_out'=>$this->input->post('id_item_out'),
            'date_out'=>$this->input->post('date_out'),
            'note'=>$this->input->post('note_io'),
            'inputer'=>$this->input->post('inputer'), 
        );
        $this->model_app->insertData("tbl_master_item_out",$data);

        foreach($this->cart->contents() as $items){
            $id_item = $items['id']; 
            $data_detail = array(
                'id_item_out' => $this->input->post('id_item_out'),
                'id_delivery_service' => $this->input->post('id_delivery_service'), 
                'id_item'=> $id_item,
                'id_agen' => $this->input->post('id_agen'), 
                'id_agen_sender' => $this->session->userdata('IDAGEN'),
                'status' => "On Process",
                'date_of_received' => "0000-00-00",
                'inputer' => $this->input->post('inputer'),
            );
            $this->model_app->insertData("tbl_detail_item_out",$data_detail);
 			
		    $data_detail_update = array( 
                'id_item_out' => $this->input->post('id_item_out'), 
                'inputer' => $this->input->post('inputer'),
				'id_agen' => $this->input->post('id_agen'), 
            ); 
			 $key['id_item'] = $id_item;
            $this->model_app->updateData("tbl_detail_item",$data_detail_update,$key);
        }
        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
        redirect('item_out');
		}
    }
	
	
	// LIHAT DATA ITEM OUT
    function detail_item_out(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin'or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial') { 
        $data=array(
            'title'=>'Detail Item Out',
            'active_item_out'=>'active', 
            'data_header_item_out'=>$this->model_app->getDataHeaderDetailItemOut(), 
            'data_item_for_item_out'=>$this->model_app->getDataItemDetailForItemOut(),          
			 );
		
		$id_item_in['id_item_in'] = $this->uri->segment(3);
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows(); 
		
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_item_out');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
		}
    } 
	
	
	//print data
    function print_item_out(){
		if ($this->session->userdata('LEVEL') == 'super_admin' or $this->session->userdata('LEVEL') == 'operation_admin'or $this->session->userdata('LEVEL') == 'inventory_admin' or $this->session->userdata('LEVEL') == 'managerial') { 
        $data=array(
            'title'=>'Print Item Out',
            'active_item_out'=>'active',
            'data_header_item_out'=>$this->model_app->getDataHeaderDetailItemOut(), 
            'data_item_for_item_out'=>$this->model_app->getDataItemDetailForItemOut()      
		);
		
		$id_item_in['id_item_in'] = $this->uri->segment(3);
		
		$data['jumlah_item_in'] = $this->model_app->getAllDataItemInNumber()->num_rows(); 
		$data['jumlah_item_out'] = $this->model_app->getAllDataItemOutNumber()->num_rows(); 
		$data['jumlah_item'] = $this->model_app->getAllDataItemNumber()->num_rows();
		$data['jumlah_agen'] = $this->model_app->getAllDataAgenNumber()->num_rows();  
		
        $this->load->view('pages/v_print_item_out',$data);
		}
    }
	
}