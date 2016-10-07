<?php 

class Model_app extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    //  ================= AUTOMATIC CODE ==================
	
	// Bagian Login	=================	
	function login($username, $password) {
        //create query to connect user login database
        $this->db->select('*');
        $this->db->from('tbl_master_user');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);
		
        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }
    }
	// Bagian Login	=================
	
	// Untuk Dipakai Semua Bagian =================
	public function getAllData($table)
    {
        return $this->db->get($table)->result();
    }
	
	public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }
	
	function insertData($table,$data)
    {
        $this->db->insert($table,$data);
	} 
	
    function updateData($table,$data,$field_key)
    {
        $this->db->update($table,$data,$field_key);
    }
	// Untuk Dipakai Semua Bagian =================
	
	// Bagian Hitung Jumlah Data Di Menu Kiri	=================
	function getAllDataItemInNumber(){
		return $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note, 
		b.id_item_in, b.id_delivery_service, 
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name 
		 
			from tbl_master_item_in a left join tbl_detail_item_in b on a.id_item_in=b.id_item_in
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service 
			order by a.date_in desc
		");	
    }
	
	function getAllDataItemOutNumber(){
		return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_in_master_item_out, a.date_out, a.note, 
		b.id_item_out, b.id_delivery_service, 
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name 
		 
			from tbl_master_item_out a left join tbl_detail_item_out b on a.id_item_out=b.id_item_out
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service 
			order by a.id_item_out desc
		");	
    }
	
	function getAllDataItemNumber(){
		return $this->db->query("select * from tbl_master_item order by id_item desc");
    }
	
	function getAllDataAgenNumber(){
		return $this->db->query("select * from tbl_master_agen where agen_type='Laku' or agen_type='Duitt' order by id_agen desc");
    }
	// Bagian Hitung Jumlah Data Di Menu Kiri	=================
	
	
	// Bagian Item In =================
    public function getIDItemIn()
    {
        $q = $this->db->query("select MAX(RIGHT(id_item_in,5)) as kd_max from tbl_master_item_in");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%09s", $tmp);
            }
        }
        else
        {
            $kd = "000000001";
        }
        return "IDP-RII-".$kd;
    } 
	
    function getAllDataItemIn(){
        return $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note, 
		b.id_item_in, b.id_delivery_service,b.id_agen as id_agen_detail_item_in, 
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name, 
		d.id_agen,d.agen_name
			from tbl_master_item_in a left join tbl_detail_item_in b on a.id_item_in=b.id_item_in
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service 
			left join tbl_master_agen d on b.id_agen=d.id_agen
			order by a.id_item_in desc
		")->result();
    }
	
    function getDataHeaderItemIn(){
		$id_item_in = array();
		$id_item_in = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note as master_item_in_note, 
		b.id_item_in, b.id_delivery_service, b.id_agen, 
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name, 
		d.agen_name,d.agen_phone_number_1,d.agen_phone_number_2,d.agen_address,d.agen_type,d.no_unique_agen
		 
			from tbl_master_item_in a left join tbl_detail_item_in b on a.id_item_in=b.id_item_in
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service
			left join tbl_master_agen d on b.id_agen=d.id_agen
			where a.id_item_in='".$id_item_in."' order by a.no_id_item_in desc
		
		")->result();
    }
	 
    function getDataItemForItemIn(){
		$id_item_in = array();
		$id_item_in = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note as master_item_in_note, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_in as id_item_in_detail_item,
		f.id_category as id_category_master_category,f.category_name
		 
			from tbl_master_item_in a left join tbl_detail_item e on a.id_item_in=e.id_item_in 
			left join tbl_master_item d on e.id_item=d.id_item 
			left join tbl_master_category f on e.id_category=f.id_category where a.id_item_in='".$id_item_in."' order by a.no_id_item_in desc
		
		")->result();
    }
	// Bagian Item In =================
	
	// Bagian Item Out  =================
    public function getIDItemOut()
    {
        $q = $this->db->query("select MAX(RIGHT(id_item_out,5)) as kd_max from tbl_master_item_out");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%09s", $tmp);
            }
        }
        else
        {
            $kd = "000000001";
        }
        return "IDP-RIO-".$kd;
    }
	
	function getDataAgen(){  
        return $this->db->query("select * from tbl_master_agen
			where (agen_type='Laku' or agen_type='Duitt') and status='Approve' order by id_agen desc
		
		")->result();
    }
	  
	function getAllDataItemNotOut(){
		return $this->db->query("select
		a.id_item, a.item_name, a.esn, a.sn, a.total, a.status, a.contents, a.note, a.inputer,
		b.id_item as detail_item, b.id_category, b.id_item_in, b.id_item_out,
		c.id_item as id_item_detail_item_out, c.id_agen as id_agen_detail_item_out, c.date_of_received,
		d.id_agen, d.agen_name
		
		from tbl_master_item a 
		left join tbl_detail_item b on a.id_item=b.id_item 
		left join tbl_detail_item_out c on a.id_item=c.id_item 
		left join tbl_master_agen d on c.id_agen=d.id_agen
		order by c.id_agen desc")->result();
	}
	
	function getAllDataItemOut(){
        return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_out_master_item_out, a.date_out, a.note, 
		b.id_item_out, b.id_delivery_service, b.status, b.date_of_received, b.id_agen_sender as id_agen_sender_item_out,
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name,
		d.id_agen, d.agen_name,d.agen_phone_number_1,d.agen_phone_number_2,d.agen_address,d.agen_type,
		e.id_agen as id_agen_sender, e.agen_name as agen_name_sender,e.agen_phone_number_1 as agen_phone_number_1_sender,e.agen_phone_number_2 as agen_phone_number_2_sender,e.agen_address as agen_address_sender,e.agen_type as agen_type_sender
		 
			from tbl_master_item_out a left join tbl_detail_item_out b on a.id_item_out=b.id_item_out
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service 
			left join tbl_master_agen d on b.id_agen=d.id_agen 
			left join tbl_master_agen e on b.id_agen_sender=e.id_agen
			 order by a.id_item_out desc
		")->result();
    }//where b.id_agen_sender ='".$this->session->userdata('IDAGEN')."'
	
	function getDataHeaderDetailItemOut(){
		$id_item_out = array();
		$id_item_out = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_in_master_item_out, a.date_out, a.note as master_item_out_note, 
		b.id_item_out, b.id_delivery_service, b.id_agen, b.status, b.date_of_received, 
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name, 
		d.agen_name,d.agen_phone_number_1,d.agen_phone_number_2,d.agen_address,d.agen_type,d.no_unique_agen
		 
			from tbl_master_item_out a left join tbl_detail_item_out b on a.id_item_out=b.id_item_out
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service
			left join tbl_master_agen d on b.id_agen=d.id_agen
			where a.id_item_out='".$id_item_out."' order by a.no_id_item_out desc
		
		")->result();
    }
	  
    function getDataItemDetailForItemOut(){
		$id_item_out = array();
		$id_item_out = $this->uri->segment(3);
        return $this->db->query("	select distinct
		a.no_id_item_out, a.id_item_out as id_item_out_master_item_out, a.date_out, a.note as master_item_out_note,
		b.no_id_detail_item_out, b.id_item_out as id_item_out_detail_item_out, b.id_item as id_item_detail_item_out,
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_out as id_item_out_detail_item,
		f.id_category as id_category_master_category,f.category_name
		 
		from tbl_master_item_out a left join tbl_detail_item_out b on a.id_item_out=b.id_item_out 
		left join tbl_master_item d on b.id_item=d.id_item  
		left join tbl_detail_item e on d.id_item=e.id_item  
		left join tbl_master_category f on e.id_category=f.id_category 
		where a.id_item_out='".$id_item_out."' order by a.no_id_item_out desc
		
		")->result();
    }
	// Bagian Item Out =================
	 
	// Bagian Item List ================= 
	 function getDataAllItem(){
		$id_item = array();
		$id_item = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item,a.id_item,a.item_name,a.esn,a.sn,a.total,a.status,a.contents,a.note,
		b.no_id_detail_item,b.id_item as id_item_detail_item,b.id_category,b.id_item_in as id_item_in_detail_item,
		c.id_category as id_category_master_category,c.category_name
		 
			from tbl_master_item a left join tbl_detail_item b on a.id_item=b.id_item 
			left join tbl_master_category c on b.id_category=c.id_category order by a.no_id_item asc
		
		")->result();
    }
	
    function getDataItemListDetailHeaderItemIn(){
		$id_item = array();
		$id_item = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note as master_item_in_note, 
		b.id_item_in, b.id_delivery_service, b.id_agen, b.id_item,
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name, 
		d.agen_name,d.agen_phone_number_1,d.agen_phone_number_2,d.agen_address,d.agen_type
		 
			from tbl_master_item_in a left join tbl_detail_item_in b on a.id_item_in=b.id_item_in
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service
			left join tbl_master_agen d on b.id_agen=d.id_agen
			where b.id_item='".$id_item."' order by a.no_id_item_in desc
		
		")->result();
    }
	 
    function getDataItemListDetailItemForItemIn(){
		$id_item = array();
		$id_item = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note as master_item_in_note, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_in as id_item_in_detail_item,
		f.id_category as id_category_master_category,f.category_name
		 
			from tbl_master_item_in a left join tbl_detail_item e on a.id_item_in=e.id_item_in 
			left join tbl_master_item d on e.id_item=d.id_item 
			left join tbl_master_category f on e.id_category=f.id_category where d.id_item='".$id_item."' order by a.no_id_item_in desc
		
		")->result();
    }
    function getDataItemListDetailHeaderItemOut(){
		$id_item = array();
		$id_item = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_out_master_item_out, a.date_out, a.note as master_item_out_note,
		b.no_id_detail_item_out, b.id_item_out as id_item_out_detail_item_out, b.id_item as id_item_detail_item_out, b.id_agen as id_agen_detail_item_out, b.id_delivery_service as id_delivery_service_detail_item, b.status as status_detail_item_out, b.date_of_received, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_out as id_item_out_detail_item,
		f.id_category as id_category_master_category,f.category_name,
		g.id_delivery_service as id_delivery_service_master_delivery_service ,g.delivery_service_name, 
		h.id_agen, h.agen_name,h.agen_phone_number_1,h.agen_phone_number_2,h.agen_address, h.agen_type
		 
		from tbl_master_item_out a 
		left join tbl_detail_item_out b on a.id_item_out=b.id_item_out 
		left join tbl_master_item d on b.id_item=d.id_item  
		left join tbl_detail_item e on b.id_item=e.id_item  
		left join tbl_master_category f on e.id_category=f.id_category 
		left join tbl_master_delivery_service g on b.id_delivery_service=g.id_delivery_service
		left join tbl_master_agen h on b.id_agen=h.id_agen
		where b.id_item='".$id_item."' order by a.no_id_item_out desc
		
		")->result();
    }
	  
    function getDataItemListItemDetailForItemOut(){
		$id_item = array();
		$id_item = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_out_master_item_out, a.date_out, a.note as master_item_out_note, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_out as id_item_out_detail_item,
		f.id_category as id_category_master_category,f.category_name
		 
		from tbl_master_item_out a left join tbl_detail_item e on a.id_item_out=e.id_item_out 
		left join tbl_master_item d on e.id_item=d.id_item 
		left join tbl_master_category f on e.id_category=f.id_category where d.id_item='".$id_item."' order by a.no_id_item_out desc
		
		")->result();
    }
	// Bagian Item List =================
	
	// Bagian Agen List =================
	public function getIDAgen()
    {
        $q = $this->db->query("select MAX(RIGHT(id_agen,5)) as kd_max from tbl_master_agen");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%09s", $tmp);
            }
        }
        else
        {
            $kd = "000000001";
        }
        return "A".$kd;
    } 
	
	function getDataHeaderAgen(){
		$idagen = array();
		$idagen = $this->uri->segment(3);
		return $this->db->query("select * from tbl_master_agen where id_agen='".$idagen."'")->result();
    } 
	
	/*
	function getDataItemForAgen(){
		$idagen = array();
		$idagen = $this->uri->segment(3);
        return $this->db->query("select distinct 
				a.no_id_item_in,a.id_item_in as id_item_in_master_item_in,a.date_in,a.note as master_item_in_note,
				b.no_detail_item_in, b.id_delivery_service as id_delivery_service_detail_item_in,b.id_item_in as id_item_in_detail_item_in,b.id_item as id_item_detail_item_in,b.id_agen as id_agen_detail_item_in,
				c.id_agen,c.agen_name,c.agen_phone_number_1,c.agen_phone_number_2,c.agen_address,c.terminal_id,c.agen_type,c.note as note_master_agen, 
				d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
				e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_in as id_item_in_detail_item,e.id_agen as id_agen_detail_item,
				f.id_category as id_category_master_category,f.category_name,
				g.id_delivery_service as id_delivery_service_master_delivery_service,g.delivery_service_name,
				h.id_item as id_item_detail_item_out, h.status as status_item_out
				
				from tbl_master_item_in a 
				left join tbl_detail_item_in b on a.id_item_in=b.id_item_in
				left join tbl_master_agen c on b.id_agen=c.id_agen 
				left join tbl_master_item d on b.id_item=d.id_item 
				left join tbl_detail_item e on d.id_item=e.id_item 
				left join tbl_master_category f on e.id_category=f.id_category 
				left join tbl_master_delivery_service g on g.id_delivery_service=b.id_delivery_service
				left join tbl_detail_item_out h on E.id_item=h.id_item 
				where c.id_agen='".$idagen."'  ORDER BY a.id_item_in asc
		
		")->result();//AND h.status <> 'Received' tambahin itu abis where agen
    }
	*/
		
	function getDataItemForAgenIndepay(){
		$idagen = array();
		$idagen = $this->uri->segment(3);
        return $this->db->query("select distinct
					c.id_agen,c.agen_name,c.agen_phone_number_1,c.agen_phone_number_2,c.agen_address,c.terminal_id,c.agen_type,c.note as note_master_agen, 
					d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
					e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_out as id_item_out_detail_item,e.id_agen as id_agen_detail_item,
					f.id_category as id_category_master_category,f.category_name
					
					from tbl_master_agen c
					left join tbl_detail_item e on c.id_agen=e.id_agen 
					left join tbl_master_item d on e.id_item=d.id_item 
					left join tbl_master_category f on e.id_category=f.id_category  
					where c.id_agen='".$idagen."' ORDER BY e.id_item asc
		
		")->result();
    }

	
	function getDataHeaderDetailItemInAgen(){
		$id_item_in = array();
		$id_item_in = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note as master_item_in_note, 
		b.id_item_in, b.id_delivery_service, b.id_agen, 
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name, 
		d.agen_name,d.agen_phone_number_1,d.agen_phone_number_2,d.agen_address,d.agen_type
		 
			from tbl_master_item_in a left join tbl_detail_item_in b on a.id_item_in=b.id_item_in
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service
			left join tbl_master_agen d on b.id_agen=d.id_agen
			where a.id_item_in='".$id_item_in."' order by a.no_id_item_in desc
		
		")->result();
    }
	  
    function getDataItemForDetailItemInAgen(){
		$id_item_in = array();
		$id_item_in = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_in, a.id_item_in as id_item_in_master_item_in, a.date_in, a.note as master_item_in_note, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_in as id_item_in_detail_item,
		f.id_category as id_category_master_category,f.category_name
		 
			from tbl_master_item_in a left join tbl_detail_item e on a.id_item_in=e.id_item_in 
			left join tbl_master_item d on e.id_item=d.id_item 
			left join tbl_master_category f on e.id_category=f.id_category where a.id_item_in='".$id_item_in."' order by a.no_id_item_in desc
		
		")->result();
    }
	
	function getDataHeaderDetailItemOutAgen(){
		$id_item_out = array();
		$id_item_out = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_in_master_item_out, a.date_out, a.note as master_item_out_note, 
		b.id_item_out, b.id_delivery_service, b.id_agen, 
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name, 
		d.agen_name,d.agen_phone_number_1,d.agen_phone_number_2,d.agen_address,d.agen_type
		 
			from tbl_master_item_out a left join tbl_detail_item_out b on a.id_item_out=b.id_item_out
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service
			left join tbl_master_agen d on b.id_agen=d.id_agen
			where a.id_item_out='".$id_item_out."' order by a.no_id_item_out desc
		
		")->result();
    }
	  
    function getDataItemForDetailItemOutAgen(){
		$id_item_out = array();
		$id_item_out = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_out_master_item_out, a.date_out, a.note as master_item_out_note, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_out as id_item_out_detail_item,
		f.id_category as id_category_master_category,f.category_name
		 
			from tbl_master_item_out a left join tbl_detail_item e on a.id_item_out=e.id_item_out 
			left join tbl_master_item d on e.id_item=d.id_item 
			left join tbl_master_category f on e.id_category=f.id_category where a.id_item_out='".$id_item_out."' order by a.no_id_item_out desc
		
		")->result();
    }
	 
		function getDataAgenNoIndepay(){
		return $this->db->query("select * from tbl_master_agen where agen_type='Laku' or agen_type='Duitt' order by id_agen desc")->result();
		}
	
	// Bagian Agen List =================
	
	// Bagian Master Data =====================
		// User
		function getAllDataUserNoSudo(){
		return $this->db->query("select * from tbl_master_user where id_user='".$this->session->userdata('ID')."' order by id_user desc")->result();
		}
		 
		public function getIDUser()
		{
			$q = $this->db->query("select MAX(RIGHT(id_user,3)) as kd_max from tbl_master_user");
			$kd = "";
			if($q->num_rows()>0)
			{
				foreach($q->result() as $k)
				{
					$tmp = ((int)$k->kd_max)+1;
					$kd = sprintf("%03s", $tmp);
				}
			}
			else
			{
				$kd = "001";
			}
			return "U-".$kd;
		}
	
		// User
	// Bagian Master Data =====================
	
	
	
	// ===================== Untuk Client / Customer =====================\\
	// Bagian Item In 
   	
    function getAllDataItemInCustomer(){
        return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_in_master_item_out, a.date_out, a.note, 
		b.id_item_out, b.id_delivery_service,b.id_agen as id_agen_detail_item_out, b.id_agen_sender,  b.status,
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name, 
		d.id_agen,d.agen_name,
		e.id_agen as id_agen_sender,e.agen_name as agen_name_sender
			from tbl_master_item_out a 
			left join tbl_detail_item_out b on a.id_item_out=b.id_item_out
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service 
			left join tbl_master_agen d on b.id_agen=d.id_agen 
			left join tbl_master_agen e on b.id_agen_sender=e.id_agen 
			where b.id_agen='".$this->session->userdata('IDAGEN')."'
			order by a.id_item_out desc
		")->result();
    }
	
    function getDataHeaderItemInCustomer(){
		$id_item_out = array();
		$id_item_out = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_out_master_item_out, a.date_out, a.note as master_item_out_note, 
		b.id_item_out, b.id_delivery_service, b.id_agen, b.id_agen_sender, b.status as status_detail_item_out,
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name, 
		d.agen_name,d.agen_phone_number_1,d.agen_phone_number_2,d.agen_address,d.agen_type,
		e.agen_name as agen_name_sender, e.agen_phone_number_1 as agen_phone_number_1_sender, e.agen_phone_number_2 as agen_phone_number_2_sender, e.agen_address as agen_address_sender, e.agen_type as agen_type_sender
		 
			from tbl_master_item_out a left join tbl_detail_item_out b on a.id_item_out=b.id_item_out
			left join tbl_master_delivery_service c on b.id_delivery_service=c.id_delivery_service
			left join tbl_master_agen d on b.id_agen=d.id_agen
			left join tbl_master_agen e on b.id_agen_sender=e.id_agen
			where a.id_item_out='".$id_item_out."' order by a.no_id_item_out desc
		
		")->result();
    }
	 
    function getDataItemForItemInCustomer(){
		$id_item_out = array();
		$id_item_out = $this->uri->segment(3);
        return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_out_master_item_out, a.date_out, a.note as master_item_out_note, 
		d.no_id_item,d.id_item as id_item_master_item,d.item_name,d.esn,d.sn,d.total,d.status,d.contents,d.note as master_item_note,
		e.no_id_detail_item,e.id_item as id_item_detail_item,e.id_category,e.id_item_out as id_item_out_detail_item,
		f.id_category as id_category_master_category,f.category_name
		 
			from tbl_master_item_out a left join tbl_detail_item e on a.id_item_out=e.id_item_out 
			left join tbl_master_item d on e.id_item=d.id_item 
			left join tbl_master_category f on e.id_category=f.id_category where a.id_item_out='".$id_item_out."' order by a.no_id_item_out desc
		
		")->result();
    }
	
	// Bagian Hitung Jumlah Data Di Menu Kiri Client	=================
	function getAllDataItemInNumberCustomer(){
		return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_in_master_item_out, a.date_out, a.note, 
		b.id_item_out, b.id_delivery_service, b.id_agen, b.status,
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name 
		 
			from tbl_master_item_out a left join tbl_detail_item_out b on a.id_item_out=b.id_item_out
			left join tbl_master_delivery_service c on b.id_delivery_service = c.id_delivery_service 
			where b.id_agen = '".$this->session->userdata('IDAGEN')."'  and b.status = 'On Process'
		");	
    }
	
	function getAllDataItemOutNumberCustomer(){
		return $this->db->query("select distinct
		a.no_id_item_out, a.id_item_out as id_item_in_master_item_out, a.date_out, a.note, 
		b.id_item_out, b.id_delivery_service, b.id_agen, b.status, b.id_agen_sender,
		c.id_delivery_service as id_delivery_service_master_delivery_service ,c.delivery_service_name 
		 
			from tbl_master_item_out a left join tbl_detail_item_out b on a.id_item_out=b.id_item_out
			left join tbl_master_delivery_service c on b.id_delivery_service = c.id_delivery_service 
			where b.id_agen_sender = '".$this->session->userdata('IDAGEN')."' 
		");	
    }
	// Bagian Hitung Jumlah Data Di Menu Kiri Client	=================
	
	// Ambil warna status agen 
	 function getDataWarnaStatusAgen(){ 
        return $this->db->query("select distinct
		a.status,a.latitude,a.longitude,a.agen_operational_name,
		b.id_status_agen,b.warna_lingkaran, b.warna_huruf_dalam_lingkaran
			from tbl_master_agen a left join tbl_master_status_agen b on a.status=b.nama_status 
			order by b.id_status_agen asc			
		");
    }
	
	
	 
}
	
	 
