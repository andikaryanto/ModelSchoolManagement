<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paging {

    public function get_config()
    {
        $data["perpage"] = 5;
        $data["perpagemodal"] = 5;
        $data["pagelen"] = 5;
        return $data;
    }

    public function get_form_name_id()
    {
        $data["m_school"] = "m_schools";
        $data["m_kelas"] = "m_clases";
        $data["m_groupuser"] = "m_groupusers";
        $data["m_user"] = "m_users";
        $data["m_schoolyear"] = "m_schoolyears";
        $data["m_mapel"] = "m_subjects";
        $data["m_worker"] = "m_workers";
        $data["m_student"] = "m_students";
        return $data;
    }

    public function get_enum_name()
    {
        $data["months"] = 1;
        $data["gender"] = 2;
        $data["religion"] = 3;
        $data["WorkStatus"] = 4;
        return $data;
    }

    public function load_header()
    {

        $CI =& get_instance();
        // $CI->load->model(array("Mform_model"));
        // $mastermenu = $CI->Mform_model->get_data_by_classname("Master");

        $data['mastermenu'] = null;

        $CI->load->view('template/header', $data); 
    }

    public function load_footer()
    {
        $CI =& get_instance();
        $CI->load->view('template/footer');
    }

    private function set_resources_header_page()
    {
        
        $resource['flag'] = base_url('assets/bootstrapdashboard/img/flags/16/US.png');
        if($_SESSION['language']['language'] === 'indonesia'){
            $resource['flag'] = base_url('assets/bootstrapdashboard/img/flags/16/ID.png');;
        }

        return $resource;
    }

    public function is_session_set()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->model(array('Login'));
        //$sitestatus = $CI->Gsitestatus_model->get_alldata();
        //if(isset($sitestatus) && $sitestatus->Status == 2){
            //echo json_encode($sitestatus);
            if(isset($_SESSION['userdata']))
            {
                //redirect('home');
            }
            else
            {
                redirect('login');
            }
        // }
        // else{
        //     //echo json_encode($sitestatus);
        //     //echo json_encode("aaa");
        //     //$data['resource'] = $CI->paging->set_resources_forbidden_page();
        //     if(isset($_SESSION['userdata']) && $_SESSION['userdata']['username'] !== "superadmin")
        //         redirect('maintenance');
        // }
        
    }

    public function set_data_page_add($model = null, $enums = null)
    {
        $data['model'] = $model;
        $data['enums'] = $enums;
        return $data;
    }

    public function set_data_page_edit($model = null, $enums = null)
    {
        $data['model'] = $model;
        $data['enums'] = $enums;
        return $data;
    }

    public function is_superadmin($user)
    {
        $permited = false;
        if($user == "superadmin")
        {
            $permited = true;
        }
        return $permited;
    }

    public function set_data_page_index($modeldetail, $totalrow = null, $currentpage = 0, $search = null, $modelheader = null, $pagesize = null)
    {
        $config = $this->get_config();
        $pagesz = $_SESSION['usersetting']->RowPerpage; //5 or whatever
        if(!empty($pagesize))
        {
            $pagesz = $pagesize;
        }
        $totalpage = 0;
        $firstpage = 1;
        $lastpage = 3;
        if($totalrow)
        {
            $totalpage = ceil($totalrow / $pagesz);
            if($totalpage > $config["pagelen"])
            {
                $lastpage = $currentpage + 2;
                if($lastpage > $totalpage)
                {
                    $lastpage = $totalpage;
                    if($lastpage - $config['pagelen'] < 0)
                    {
                        $firstpage = 1;
                    }
                    else
                    {
                        $firstpage = $totalpage - $config['pagelen'] + 1;;
                    }
                }
                else{
                    if($lastpage < $config['pagelen'])
                    {
                        $firstpage = 1;
                        $lastpage = $config['pagelen'];
                    }
                    else{
                        if($currentpage >= $totalpage - 2)
                        {
                            $firstpage = $totalpage - $config['pagelen'] + 1;
                            $lastpage = $totalpage;
                        }
                        else
                        {
                            $firstpage = $lastpage - $config['pagelen'] + 1;
                        }
                    }
                }
            }
            else{
                $lastpage = $totalpage;
            }
        } else {
            
            $firstpage = 0;
            $lastpage = 0;
        }

        $startNumber = 1;
        if($currentpage > 1){
            $startNumber = (($currentpage - 1)*$pagesz) + 1;
        }

        $data['modelheader'] = $modelheader;
        $data['modeldetail'] = $modeldetail;
        $data['totalrow'] = $totalrow;
        $data['totalpage'] = $totalpage;
        $data['currentpage'] = (int)$currentpage;
        $data['startnumber'] = $startNumber;
        $data['firstpage'] = $firstpage;
        $data['lastpage'] = $lastpage;
        $data['search'] = $search;
        $data['firstrow'] = $startNumber;
        $data['lastrow'] = count($modeldetail) < $pagesz ? $totalrow : $startNumber + $pagesz - 1;
        return $data;
    }

    public function get_success_message(){

        $msg = array();

        $msg = array_merge($msg, array(0=>'ui_datasaved'));
        return $msg;
    }

    public function get_delete_message(){
        $msg = array();

        $msg = array_merge($msg, array(0=>'ui_datadeleted'));
        return $msg;
    }

    public function set_data_page_modal($modeldetail, $totalrow = null, $currentpage = 0, $search = null, $modelheader = null, $tabelname = null, $pagesize = null)
    {
        $config = $this->get_config();
        $totalpage = 0;
        $firstpage = 1;
        $lastpage = 3;
        $pagesz = $config['perpagemodal'];
        if(!empty($pagesize))
        {
            $pagesz = $pagesize;
        }

        if($totalrow)
        {
            $totalpage = ceil($totalrow / $config['perpagemodal']);
            if($totalpage > $config["pagelen"])
            {
                //$firstpage = $page - 2;
                $lastpage = $currentpage + 2;
                if($lastpage > $totalpage)
                {
                    $lastpage = $totalpage;
                    if($lastpage - $config['pagelen'] < 0)
                    {
                        $firstpage = 1;
                    }
                    else
                    {
                        $firstpage = $totalpage - $config['pagelen'] + 1;;
                    }
                }
                else{
                    //$lastpage = $config['pagelen'];
                    if($lastpage < $config['pagelen'])
                    {
                        $firstpage = 1;
                        $lastpage = $config['pagelen'];
                    }
                    else{
                        if($currentpage >= $totalpage - 2)
                        {
                            $firstpage = $totalpage - $config['pagelen'] + 1;
                            $lastpage = $totalpage;
                        }
                        else
                        {
                            $firstpage = $lastpage - $config['pagelen'] + 1;
                        }
                    }
                }
            }
            else{
                $lastpage = $totalpage;
            }
        } else {
            
            $firstpage = 0;
            $lastpage = 0;
        }

        $startNumber = 1;
        if($currentpage > 1){
            $startNumber = (($currentpage - 1)*$pagesz) + 1;
        }

        $data[$tabelname]['modelheadermodal'] = $modelheader;
        $data[$tabelname]['modeldetailmodal'] = $modeldetail;
        $data[$tabelname]['totalrowmodal'] = $totalrow;
        $data[$tabelname]['totalpagemodal'] = $totalpage;
        $data[$tabelname]['currentpagemodal'] = (int)$currentpage;
        $data[$tabelname]['firstpagemodal'] = $firstpage;
        $data[$tabelname]['lastpagemodal'] = $lastpage;
        $data[$tabelname]['searchmodal'] = $search;
        $data[$tabelname]['firstrowmodal'] = $startNumber;
        $data[$tabelname]['lastrowmodal'] = $totalrow < $pagesz ? $totalrow : $startNumber + $pagesz - 1;
        return $data;
    }

}