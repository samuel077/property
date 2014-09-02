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
            $this->load->library('form_validation');

            $data['title'] = 'Sign up';
            //$data['identity_type'] = $this->user_model->get_identity_type();

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('user/signup');
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
