<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        //$this->load->model('Login_model');
        $this->load->library('session');
        $this->load->library('paging');
        //$this->lang->load('form_ui', $_SESSION['language']['language']);
        
        //$this->paging->is_session_set();

    }

    public function index()
    {

        //echo json_encode($this->session->userdata('language'));
        if(!isset($_SESSION['userdata'])){
            redirect('login');
        }
        else{
            load_view('home/home');
        }
    }
}