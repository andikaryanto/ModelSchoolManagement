<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mgroupusers_model extends MY_Model {

    public function __construct(){
        parent::__construct();
    }

    public function get_alldata(){
        return $this->autojoin()->get_list();
    }

    public function is_permitted($groupid = null, $form = null, $role = null)
    {
        // $formid = $form;
        // if(isset($form)){
        //     $forms = $this->Mform_model->get_data_by_formname($form);
        //     $formid = $forms->Id;
        // }

        // $permitted = false;
        // if($this->paging->is_superadmin($_SESSION['userdata']['username'])
        //     ||  $this->has_role($groupid,$formid,$role)
        // )
        // {
        //     $permitted = true;
        // }
        return true;
    }
    
}

class M_groupuser_object extends Model_object {
	
	public function users()
	{
		$CI = get_instance();
		
		$CI->load->model('Musers_model', 'Musers');	// just another CI Power Model object
		$user = $CI->Musers->get(1);
		if ($user)
			return $user;
		return '';
	}
}