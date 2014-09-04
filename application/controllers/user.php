<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class User extends CI_Controller {
    
    
        public function __construct()
        {
            parent::__construct();
	    session_start();
            $this->load->model('user_model');
        }
        
        public function index()
        {
            /* 
            $this->load->view('templates/header', $data);
            $this->load->view('user/signup', $data);
            $this->load->view('templates/footer');
             */
        }

        public function create($param) {
                echo $param;
        }

        public function terminate($userId) {
                echo $userId;
        }

        public function edit($userId) {
                echo $userrId;
        }
        

        public function login()
        {
            $account = $this->input->post('login_account'); 
            $password = md5($this->input->post('login_passwd'));

            $result = $this->user_model->login_check($account,$password);

            $data['title'] = "HSNG財產管理平台";

            if($result == FALSE)
            {

            }
            else
            {
		// admin = 1
                if($result->hsng_role_id == 1)
                {
		    echo "in here";
		    $_SESSION['username'] = $result->name;
		    $_SESSION['hsng_role_id'] = $result->hsng_role_id;

		    redirect('/property/index', 'refresh');	
		/*
                    $this->load->view('templates/header', $data);
                    $this->load->view('property/index');
                    $this->load->view('templates/footer');
*/
                }
                else if($result->hsng_role_id == 2)
                {

                }
                else if($result->hsng_role_id == 3)
                {

                }
            }

        }

        public function signup()
        {
            $this->load->library('form_validation');
            
            
            $data['account'] = $this->input->post('signup_account');
            $data['passwd'] = $this->input->post('signup_passwd');
            $data['name'] = $this->input->post('signup_name');
            
            $data['title'] = 'Sign up';
            //$data['identity_type'] = $this->user_model->get_identity_type();

            $config = array(
                            array(
                                'field' => 'account',
                                'label' => 'User Account',
                                'rules' => 'trim|required|min_length[5]|max_length[20]|xss_clean'
                            ),
                            array(
                                'field' => 'passwd',
                                'label' => 'User Password',
                                'rules' => 'trim|required'
                            ),
                            array(
                                'field' => 'name',
                                'label' => 'User Name',
                                'rules' => 'trim|required'
                            ),
                            array(
                                'field' => 'school_id',
                                'label' => 'User School ID',
                                'rules' => 'trim|required|numeric'
                            ),
                            array(
                                'field' => 'phone_number',
                                'label' => 'User Phone Number',
                                'rules' => 'trim|required|numeric'
                            ),
                            array(
                                'field' => 'email',
                                'label' => 'User E-Mail',
                                'rules' => 'trim|required|valid_email'
                            ),
                            array(
                                'field' => 'enroll_year',
                                'label' => 'User Enroll Year',
                                'rules' => 'trim|required|numeric'
                            )
                    ); 
 

            //$this->form_validation->set_rules($config);

            if(!$this->input->post('send_btn'))
            //{
                //if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('templates/header', $data);
                    $this->load->view('user/signup', $data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->user_model->add_user();
                    $this->load->view('templates/header', $data);
                    $this->load->view('user/signup_success');
                    $this->load->view('user/signup');
                    $this->load->view('templates/footer');
                }
            //}
        }

        public function signup_success()
        {
            $data['title'] = 'Sign up';
            $this->load->view('templates/header', $data);
            $this->load->view('user/signup_success');
            $this->load->view('templates/footer');
        }
}
?>
