<?php
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 23/7/16
 * Time: 10:52 AM
 */


class Frontend extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('users_model');
        $this->load->library('session');
    }

    public function index()
    {
        $output = $this->session->flashdata('output');
        $succesMsg=$this->users_model->getSuccessMsg($output);

        $dataheader['succesMsg']=$succesMsg;
        $dataheader['title'] = "Login";
        $dataheader['loginPostUrl'] = "index.php/checkLogin";

        $this->load->view('layout/frontend_header', $dataheader);
        $this->load->view('frontend/frontend_index');
        $this->load->view('layout/frontend_footer');
    }

    public function checkLogin()
    {
        $username=$this->input->post('userName');
        $userpassword=$this->input->post('password');

        $userCredentialArray=array('username'=>$username,'userpassword'=>$userpassword);
        $userCredential = $this->users_model->checkUserCredential($userCredentialArray);
        if(count($userCredential)>0){

            $this->session->set_userdata($userCredential);
            $this->users_model->updateLastlogin($userCredential['userid']);
            redirect($userCredential['redirecturl']);
        }
        else
        {
            $output = array('status' => "2", 'message' => "Invalid Login!!");
            $this->session->set_flashdata('output', $output);
            redirect("http://localhost/pos/");
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect("/");
    }

    public function dashboard()
    {
        $dataheader['title'] = "Login";
        $this->load->view('layout/backend_header',$dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/frontend_dashboard');
        $this->load->view('layout/backend_footer');
    }
}

?>