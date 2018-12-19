<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('Login');
        $this->load->model('Musers');
        $this->load->library('session');

    }

    public function index()
    {
        if(isset($_SESSION['userdata'])){
            redirect('home');
        }
        else{
            $this->load->view('login/login');
        }
    }
    public function dologin()
    {
        $username = $this->input->post('loginUsername');
        $password = $this->input->post('loginPassword');
        
        $query = $this->Musers->get_sigle_data_user($username, $password);
        // echo json_encode($query);
        if ($query)
        {
            if($query->IsLoggedIn == 0){
                $userdata = $this->Musers->create_object($query->Id, $query->GroupId, $query->GroupName, $query->Username, null, null, null, null, null);
                $this->session->set_userdata('userdata',$userdata);

                $usersetting = $this->Musers->get_usersetting_by_userid($query->Id);
                $this->session->set_userdata('usersetting',$usersetting);
    
                // $language = array(
                //     'language' => $usersetting->Language
                // );
                // $this->session->set_userdata('language',$language);
                //$this->Musers->set_loggedin($username);
                redirect('home');
            } else {
                // echo "<script>alert('user is already logged in');</script>";
                $this->index();
            }
        }
        else{
            $this->index();
        }
    }

    public function dologout()
    {
        $username = $_SESSION['userdata']['username'];
        unset(
            $_SESSION['userdata']
        );
        $this->Musers->set_logout($username);
        redirect('login');
    }

    private function loadview($viewName)
	{
		$this->load->view('template/header');
		$this->load->view($viewName);
		$this->load->view('template/footer');
    }
    
}