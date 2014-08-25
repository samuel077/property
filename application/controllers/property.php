<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

	public function __construct(){
                parent::__construct();
                session_start();
		$this->load->model('property_model');
        }
	
        public function index()
        {
		$data['title'] = "HSNG 財產管理平台";
		$data['propertyList'] = $this->property_model->get_property();
		$data['pageHeaderBig'] = "財產列表";
		$data['pageHeaderSmall'] = "全部列表";
		$data['session'] = $_SESSION;
		$data['is_admin'] = true;
		
		$this->load->view('templates/header', $data);
                $this->load->view('property/index', $data);
                $this->load->view('templates/footer');
        }
	
	/*
        public function propertylist()
        {
		$data['title'] = "財產管理平台 新建財產";
                $data['pageHeaderBig'] = "財產列表";
                $data['pageHeaderSmall'] = "全部列表";
                $data['property_type_list'] = $this->property_model->get_propertyType();
                $data['propertyList'] = $this->property_model->get_property();
                $data['location_list'] = $this->property_model->get_location();

                $this->load->helper('form');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('sequence','財產編號', 'required');
                $this->form_validation->set_rules('property_type','種類(個人PC, Monitor,..etc.', 'required');
                $this->form_validation->set_rules('brand','廠牌', 'required');
                $this->form_validation->set_rules('purchaseDate','購買日期', 'required');
                $this->form_validation->set_rules('expire_info','使用年限', 'required');
                $this->form_validation->set_rules('location','放置地點', 'required');
                $this->form_validation->set_rules('note','備註', 'required');
                $this->form_validation->set_rules('name','財產名稱', 'required');
                if ($this->form_validation->run() == FALSE){
                        // form的頁面。
                        $this->load->view('templates/header', $data);
                        $this->load->view('property/index', $data);
                        $this->load->view('templates/footer');
                }
                else{
                        // 驗証成功，寫到資料庫
                        // 導入成功頁面，可以跑alert();
                        $this->property_model->set_property();
                        $this->load->view('templates/header', $data);
                        $this->load->view('property/createSuccessfully', $data);
                        $this->load->view('templates/footer');
                }
	
        }*/

        public function create() {
		
		$data['session'] = $_SESSION;
		$data['title'] = "財產管理平台 新建財產";
		$data['pageHeaderBig'] = "新建財產";
		$data['pageHeaderSmall'] = "手動輸入";	
		$data['property_type_list'] = $this->property_model->get_propertyType();	
		$data['location_list'] = $this->property_model->get_location();	

		$this->load->helper('form');
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('sequence','財產編號', 'required');
		$this->form_validation->set_rules('property_type','種類(個人PC, Monitor,..etc.', 'required');
		$this->form_validation->set_rules('brand','廠牌', 'required');
		$this->form_validation->set_rules('purchaseDate','購買日期', 'required');
		$this->form_validation->set_rules('expire_info','使用年限', 'required');
		$this->form_validation->set_rules('location','放置地點', 'required');
		$this->form_validation->set_rules('note','備註', 'required');
		$this->form_validation->set_rules('name','財產名稱', 'required');
		if ($this->form_validation->run() == FALSE){
			// form的頁面。	
			$this->load->view('templates/header', $data);
                        $this->load->view('property/create', $data);
                        $this->load->view('templates/footer');
		}
		else{
			// 驗証成功，寫到資料庫
			// 導入成功頁面，可以跑alert();
			$this->property_model->set_property();
			$this->load->view('templates/header', $data);
			$this->load->view('property/createSuccessfully', $data);
			$this->load->view('templates/footer');
		}
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
