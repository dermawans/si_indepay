<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('model_app');
    }

    function index(){
        $data=array(
            'title'=>'Login Page'
        );
        $this->load->view('pages/v_login',$data);
    }

    function cek_login() {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        //query the database
        $result = $this->model_app->login($username, $password);
        if($result) {
            $sess_array = array();
            foreach($result as $row) {
                //create the session
                $sess_array = array(
                    'ID' => $row->id_user,
                    'USERNAME' => $row->username,
                    'PASS'=>$row->password,
                    'IDAGEN' => $row->id_agen,
                    'NAME'=>$row->name,
                    'LEVEL' => $row->level,
                    'login_status'=>true,
                );
				
				$username1['username']= $this->input->post('username');
				$last_login['last_login'] = $this->input->post('last_login');
		
				$this->db->update('tbl_master_user', $last_login, $username1);
				
                //set session with value from database
                $this->session->set_userdata($sess_array);
                redirect('dashboard','refresh');
            }
            return TRUE;
        } else {
            //if form validate false
            redirect('dashboard','refresh');
            return FALSE;
        }
    }

    function logout() {
        $this->session->unset_userdata('ID');
        $this->session->unset_userdata('USERNAME');
        $this->session->unset_userdata('PASS');
        $this->session->unset_userdata('IDAGEN');
        $this->session->unset_userdata('NAME');
        $this->session->unset_userdata('LEVEL');
        $this->session->unset_userdata('login_status');
        $this->session->set_flashdata('notif','THANK YOU');
        redirect('login');
    }
}
