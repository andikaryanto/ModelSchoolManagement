<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('natureuser', TRUE);
        $this->load->model(array('Musers','Mgroupusers'));
        $this->load->library(array('paging', 'session','helpers'));
        $this->load->helper('form');
        $this->paging->is_session_set();
    }

    public function index()
    {
        //echo json_encode($_SESSION);
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupusers->is_permitted($_SESSION['userdata']['groupid'],$form['m_user'],'Read'))
        {
            $page = 1;
            $search = "";
            if(!empty($_GET["page"]))
            {
                $page = $_GET["page"];
            }
            if(!empty($_GET["search"]))
            {
                $search = $_GET["search"];
            }

            $pagesize = $this->paging->get_config();
            $resultdata = $this->Musers->has_mgroupuser()->get_list();
            echo json_encode($resultdata[0]->group_name());
            // $datapages = $this->Musers->get_datapages($page, $_SESSION['usersetting']->RowPerpage, $search);
            
            // $rows = !empty($search) ? count($datapages) : count($resultdata);

            // $data =  $this->paging->set_data_page_index($datapages, $rows, $page, $search);
            
            // $this->loadview('m_user/index', $data);
        }
       else
        {   
            
            $this->load->view('forbidden/forbidden');
        }
    }

    public function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupusers->is_permitted($_SESSION['userdata']['groupid'],$form['m_user'],'Write'))
        {
            
            $model = $this->Musers->create_object(null, null,null, null, null, null, null, null, null);
            $data =  $this->paging->set_data_page_add($model);
            $this->loadview('m_user/add', $data);   
        }
        else
        {
            
            $this->load->view('forbidden/forbidden');
        }
    }

    public function addsave()
    {
        //$date = new DateTime();
        $warning    = array();
        $err_exist  = false;
       
        $groupid    = $this->input->post('groupid');
        $groupname  = $this->input->post('groupname');
        $username   = $this->input->post('named');
        $password   = $this->input->post('password');

        $model  = $this->Musers->create_object(null,$groupid, $groupname, $username, $password, null, null, null, null);
        $modeltabel = $this->Musers->create_object_tabel(null, $groupid, $username, $password, null, null, null , null);

        $validate = $this->Musers->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            $this->loadview('m_user/add', $data);   
        }
        else{
            $date = date("Y-m-d H:i:s");
            $modeltabel['ion'] = $date;
            $modeltabel['iby'] = $_SESSION['userdata']['username'];
    
            $this->Musers->save_data($modeltabel);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('muser');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupusers->is_permitted($_SESSION['userdata']['groupid'],$form['m_user'],'Write'))
        {
            
            $edit = $this->Musers->get_data_by_id($id);
            $model = $this->Musers->create_object($edit->Id, $edit->GroupId, $edit->GroupName, $edit->Username, $edit->Password, null, null, null, null);
            $data =  $this->paging->set_data_page_edit($model);
            //echo json_encode($edit);
            $this->loadview('m_user/edit', $data);   
        }
        else{
            
            $this->load->view('forbidden/forbidden');
        }
    }

    public function editsave()
    {
       

        $userid     = $this->input->post('userid');
        $groupid    = $this->input->post('groupid');
        $groupname  = $this->input->post('groupname');
        $username   = $this->input->post('named');
        $password   = $this->input->post('password');

        $edit       = $this->Musers->get_data_by_id($userid);
        $model      = $this->Musers->create_object($edit->Id, $groupid, $groupname, $username,  $password, $edit->IOn, $edit->IBy, null , null);
        $oldmodel   = $this->Musers->create_object($edit->Id, $edit->GroupId, null, $edit->Username,  $edit->Password, $edit->IOn, $edit->IBy, $edit->UOn , $edit->UBy);
        $modeltabel = $this->Musers->create_object_tabel($edit->Id, $groupid, $username, $password, $edit->IOn, $edit->IBy, null , null);

        $validate   = $this->Musers->validate($model, $oldmodel);
 
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($model);
            $this->loadview('m_user/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $modeltabel['uon'] = $date;
            $modeltabel['uby'] = $_SESSION['userdata']['username'];

            $this->Musers->edit_data($modeltabel);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('muser');
        }
    }

    public function delete($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupusers->is_permitted($_SESSION['userdata']['groupid'],$form['m_user'],'Delete'))
        {
            $delete = $this->Musers->delete_data($id);
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                $this->session->set_flashdata('warning_msg', $deletemsg);
            } else {
                $deletemsg = $this->paging->get_delete_message();
                $this->session->set_flashdata('delete_msg', $deletemsg);
            }
            redirect('muser');
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }   
    }

    public function setting(){
        $enums['languageenums'] =  $this->Gsetting_model->get_language();
        $enums['colorenums'] =  $this->Gsetting_model->get_color();
        //$model = $this->Musers->get_data_by_id($_SESSION['userdata']['id']);
        $data = $this->paging->set_data_page_add(null, $enums);
        $this->loadview('m_user/settings',$data);
    }

    public function activate($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupusers->is_permitted($_SESSION['userdata']['groupid'],$form['m_user'],'Write'))
        {
            $this->Musers->activate_data($id);
            redirect('muser');
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }   
    }

    public function changePassword(){
        $model = array(
            'oldpassword' => "",
            'newpassword' => "",
            'confirmpassword' => ""
        );
        $data['model'] = $model;
        $this->loadview('m_user/changePassword', $data);    
    }

    public function saveNewPassword(){
        
        $oldpassword = $this->input->post('oldpassword');
        $newpassword = $this->input->post('newpassword');
        $confirmpassword = $this->input->post('confirmpassword');
        $model = array(
            'oldpassword' => $oldpassword,
            'newpassword' => $newpassword,
            'confirmpassword' =>  $confirmpassword
        );
        
        
        $validate = $this->Musers->validate_changepassword($_SESSION['userdata']['username'], $oldpassword, $newpassword, $confirmpassword);
        if($validate){
            $this->session->set_flashdata('warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($model);
            $this->loadview('m_user/changePassword', $data);    
        }
        else{
            $this->Musers->saveNewPassword($_SESSION['userdata']['username'], $oldpassword, $newpassword);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('changePassword');
        }
    }

    public function savesetting(){
        $language = $this->input->post('languageid');
        $radiocolor = $this->input->post('radiocolor');
        $rowperpage = $this->input->post('rowperpage');
        $usersetting = $this->Musers->create_usersetting_object($_SESSION['usersetting']->Id, $_SESSION['userdata']['id'],$language, explode("~",$radiocolor)[1],  $rowperpage);
        $this->Musers->edit_usersetting($usersetting);
        $newdata = $this->Musers->get_usersetting_by_userid($_SESSION['userdata']['id']);
        replaceSession('usersetting', $newdata);
        redirect('settings');
    }

    private function loadview($viewName, $data)
	{
		$this->paging->load_header();
		$this->load->view($viewName, $data);
		$this->paging->load_footer();
    }
    
}