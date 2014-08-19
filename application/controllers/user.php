<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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

}
