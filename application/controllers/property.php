<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

        public function index()
        {
                $this->load->view('templates/header', $data);
                $this->load->view('homepage', $data);
                $this->load->view('templates/footer');
        }

        public function create($param) {
                echo $param;
        }

        public function remove($propertyId) {
                echo $propertyId;
        }

        public function import($propertyId) {
                echo $propertyId;
        }
	
	public function export($propertyId){
		echo $propertyId;
	}

}
