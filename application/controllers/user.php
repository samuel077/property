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
		echo "in login page;";
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
		    $_SESSION['username'] = $result->name;
		    $_SESSION['hsng_role_id'] = $result->hsng_role_id;

		    redirect('/property/index', 'refresh');	
                }
            }

        }

	// modify by Samuel @ 2014/09/05
	public function checkuser(){
		// 1. 先把註冊狀態為 1 或是 2 的使用者先出來
		// 2. 把 user list 丟到 前面產生table
		$data['userlist'] = $this->user_model->getUncheckUser();
		
		$data['title'] = "HSNG 財產管理平台";
                $data['pageHeaderBig'] = "使用者列表";
                $data['pageHeaderSmall'] = "你的帳號，我來審核";
                $data['session'] = $_SESSION;
                if($_SESSION['hsng_role_id'] == 1){
                        $data['is_admin'] = true;
                }else{
                        $data['is_admin'] = false;
                }
                $data['user_name'] = $_SESSION['username'];
	
		$this->load->view('templates/header', $data);
                $this->load->view('user/checkuser');
                $this->load->view('templates/footer');	
		
	}
	
	// modify by Samuel @ 2014/09/05
	public function logout(){
		// 清空 session，然後回到首頁
		session_unset();
		session_destroy();
		redirect('/', 'refresh');
	}

	// modify by Samuel @ 2014/09/05
	public function approve($userId){
		$data['userlist'] = $this->user_model->updateAccountStatus($userId, true );
		redirect('/user/checkuser', 'refresh');
	}
	        
	// modify by Samuel @ 2014/09/05
	public function disapprove($userId){
		$data['userlist'] = $this->user_model->updateAccountStatus($userId, false);
		redirect('/user/checkuser', 'refresh');
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
		    echo '<script>alert("註冊申請完成，管理者將審核您的帳號申請");</script>';
		    redirect('/', 'refresh');
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
