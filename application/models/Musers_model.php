<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Musers_model extends MY_Model {

    public function __construct(){
        parent::__construct();
	}
	
	public function has_mgroupuser()
	{
		$this->db->where('GroupId >', 0);
		
		return $this;	// remember to return $this for method chaining support
	}
    
    public function get_alldata(){
        return $this->autojoin()->get_list();
	}
	

}

class Muser_object extends Model_object {
	
	public function group_name()
	{
		$CI = get_instance();
		
		$CI->load->model('Mgroupusers');	// just another CI Power Model object
		$groupuser = $CI->Mgroupusers->get($this->GroupId);
		if ($groupuser)
			return $groupuser;
		return '';
	}
}