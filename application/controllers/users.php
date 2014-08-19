<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class User extends CI_Controller {

        public function index()
        {
                $this->load->view('templates/header', $data);
                $this->load->view('homepage', $data);
                $this->load->view('templates/footer');
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
                            'rules' => 'trim|required|min_length[5]|max_length[20]|is_unique[users.account]'
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
                            'rules' => 'trim|required|vaild_email|is_unique[users.email]'
                        ),
                        array(
                            'field' => 'enroll_year',
                            'label' => 'User Enroll Year',
                            'rules' => 'trim|required|numeric'
                        )
                    )
                ); 

            if ($this->form_validation->run('signup') == FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('users/signup_success');
                $this->load->view('templates/footer');
            }
            else
            {
                $this->news_model->set_news();
                $this->load->view('templates/header', $data);
                $this->load->view('news/success');
                $this->load->view('templates/footer');
            }
        }
    }
}
?>
