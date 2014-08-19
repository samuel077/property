<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

        public function index()
        {
                $this->load->view('templates/header', $data);
                $this->load->view('homepage', $data);
                $this->load->view('templates/footer');
        }

        public function create() {
		
		$data['title'] = "財產管理平台 新建財產";		

               	$this->load->view('templates/header', $data);
                $this->load->view('property/create', $data);
                $this->load->view('templates/footer');
        }

        public function remove($propertyId) {
		
		$data['propertyId'] = $propertyId;		
		$data['title'] = "財產管理平台 移除財產";		
		
		// remove : set property table is_delete as true;
		if($this->removeProperty($propertyId)){
			$this->load->view('templates/header', $data);
			$this->load->view('property/deleteSuccess', $data);
			$this->load->view('templates/footer');
		}
		else{
			$this->load->view('templates/header', $data);
			$this->load->view('property/deleteFail', $data);
			$this->load->view('templates/footer');
		}
        }

        public function import($propertyId) {
                echo $propertyId;
        }
	
	public function export($propertyId){
		echo $propertyId;
	}

	private function removeProperty($propertyId){
		return false;
	}

}
