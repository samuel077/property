<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class User extends CI_Controller {
    
    
        public function __construct()
        {
            parent::__construct();
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

        public function signup()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Sign up';

            $config_rule = 
                array(
                    'signup' => array(
                        array(
                            'field' => 'account',
                            'label' => 'User Account',
                            'rules' => 'trim|required|min_length[5]|max_length[20]|xss_clean'
                        ),
                        array(
                            'field' => 'passwd',
                            'label' => 'User Password',
                            'rules' => 'trim|required|matches[repasswd]|md5'
                        ),
                        array(
                            'field' => 'repasswd',
                            'label' => 'Retype User Password',
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
                            'field' => 'email',
                            'label' => 'User E-Mail',
                            'rules' => 'trim|required|valid_email'
                        ),
                        array(
                            'field' => 'enroll_year',
                            'label' => 'User Enroll Year',
                            'rules' => 'trim|required|numeric'
                        )
                    )
                ); 

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('user/signup');
                $this->load->view('templates/footer');
            }
            else
            {
                $this->user_model->add_user();
                $this->signup_success();
            }
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
