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
		echo '<script>alert("登入失敗，請重新登入。");</script>';
		redirect('/', 'refresh');
            }
            else
            {
		$_SESSION['username'] = $result->name;
		$_SESSION['hsng_role_id'] = $result->hsng_role_id;
		$_SESSION['user_id'] = $result->id;
	
		redirect('/property/index','refresh');	
		// admin = 1
		/*
                if($result->hsng_role_id == 1)
                {
		    $_SESSION['username'] = $result->name;
		    $_SESSION['hsng_role_id'] = $result->hsng_role_id;
		    $_SESSION['id'] = $result->id;
	
		    redirect('/property/index', 'refresh');	
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
            
            $data['title'] = "HSNG 財產管理平台";

            if(isset($_SESSION['hsng_role_id']) && $_SESSION['hsng_role_id'] == 1)//已經進入系統，admin直接建立帳號
            {
                $data['is_admin'] = true;
                $data['pageHeaderBig'] = "創建帳號";
                $data['pageHeaderSmall'] = "你的帳號，admin來創";

                if(!$this->input->post('send_btn'))
                //{
                //if ($this->form_validation->run('signup') == FALSE)
                {
                    $this->load->view('templates/header', $data);
                    $this->load->view('user/signup', $data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->user_model->add_user($data['is_admin']);
		            echo '<script>alert("Add Success!!");</script>';
		            redirect('user/signup', 'refresh');
                }
                //}
            }
            else//未進入系統，使用者自行註冊
            {
                $data['is_admin'] = false;
                $data['account'] = $this->input->post('signup_account');
                $data['passwd'] = $this->input->post('signup_passwd');
                $data['name'] = $this->input->post('signup_name');

                if(!$this->input->post('send_btn'))
                //{
                //if ($this->form_validation->run('signup') == FALSE)
                {
                    $this->load->view('user/signup_header', $data);
                    $this->load->view('user/signup', $data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->user_model->add_user($data['is_admin']);
		            echo '<script>alert("註冊申請完成，管理者將審核您的帳號申請");</script>';
		            redirect('/', 'refresh');
                }
                //}
            }
            //$data['identity_type'] = $this->user_model->get_identity_type();
            
            
        }

        public function user_list()
        {

        }

	// modify by Samuel @ 2014/09/26
	// this function is used for changing the personal information 
	public function setting(){
                $data['title'] = "HSNG 財產管理平台";
                $data['pageHeaderBig'] = "個人帳號資訊";
                $data['pageHeaderSmall'] = "v(￣︶￣)y";
                $data['session'] = $_SESSION;
		if($_SESSION['hsng_role_id'] == 1)
			$data['is_admin'] = true;
		else
			$data['is_admin'] = false;

		if(!empty($_POST)){
			if($this->user_model->updateUserBySettingPage($_SESSION['user_id']))
				echo '<script>alert("更新成功");</script>';
			else
				echo '<script>alert("更新失敗");</script>';
		}

		$data['user'] = $this->user_model->getUserByUserId($_SESSION['user_id']);
		
		$this->load->view('templates/header', $data);
                $this->load->view('user/setting');
                $this->load->view('templates/footer');		
	}

	public function change_password(){
		//echo "success";
		
		$data['user'] = $this->user_model->getUserByUserId($_SESSION['user_id']);
		if(md5($_POST['origin']) != $data['user']['password']){
			echo "fail_2";
		}else{
			// password 的正確性 前面有判斷過惹 
			if($this->user_model->setUserNewPassword($_SESSION['user_id'], $_POST['new_pw']))
				echo "success";
			else
				echo "fail_1";
		}

	}
}
?>
