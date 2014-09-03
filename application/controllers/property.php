<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

	public $data;
	public $perpage = 8;
	public function __construct(){
                parent::__construct();
                session_start();
		$this->load->model('property_model');
        }
	
        public function index()
        {	
		
		//echo "<pre>";
                //print_r($_POST);
                //echo "</pre>";
		//die("1234");		
                // 沒有被設定過
//		echo "<pre>";
//		print_r($_SESSION);
//		echo "</pre>";
                if(isset($_POST['offset']) && $_POST['offset'] != ""){
                        $this->topage($_POST['offset'],"");
                }
                else{
				if(isset($_POST['searchterm'])){
					// 使用者有輸入搜尋字串
                        		$this->topage(0, $_POST['searchterm']);
				}else{
					$this->topage(0,"");
				}
		}
        }

	public function update(){
		// update 完之後 跳/property 資料夾	
		$data['updateSuccess'] = $this->property_model->update_property_by_id();
		redirect('/property', 'refresh');
	}	
	
        public function create() {
		
		$data['session'] = $_SESSION;
		$data['title'] = "財產管理平台 新建財產";
		$data['pageHeaderBig'] = "新建財產";
		$data['pageHeaderSmall'] = "手動輸入";	
		$data['property_type_list'] = $this->property_model->get_propertyType();	
		$data['location_list'] = $this->property_model->get_location();
		$data['is_admin'] = true;	

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
	
	// actually this is not a real remove. we simply set is delete as true;
        public function remove() {
	
		// we need to check is admin trigger this action or not.
		$data['updateSuccess'] = $this->property_model->update_property_by_id();
		redirect('/property', 'refresh');	
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

        public function topage($offset,$searchterm){
		//echo "offset = ".$offset;
                //echo "<pre>";
                //print_r($offset);
                //echo "</pre>";
                /* pagination part */
                $this->load->library('pagination');
                $config = $this->setPageInfo($offset, $searchterm);
		/*
                echo "<pre>";
                print_r($config);
                echo "</pre>";
		*/
		$this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();
		$data['totalRows'] = $config['total_rows'];
	
		// 計算第幾筆資料到第幾筆資料
		if($offset == 0){
			$data['rowFrom'] = 1;
		}
		else{
			$data['rowFrom'] = $offset + 1;
		}

		if($data['totalRows'] >= $data['rowFrom'] + $config['per_page']){
			//echo "total rows > rowFrom + perpage";
			$data['rowTo'] = $data['rowFrom'] + $config['per_page'] - 1;
		}
		else{
			//echo "total rows <= rowfrom + perpage";
			$data['rowTo'] = $data['totalRows'];
		}
		/*
		echo "<pre>";	
		print_r($data);
		echo "</pre>";	
		*/
		//echo $data['pagination'];

                $data['title'] = "HSNG 財產管理平台";
                $data['propertyList'] = $this->property_model->get_property($offset, $this->perpage, $searchterm);
                $data['pageHeaderBig'] = "財產列表";
                $data['pageHeaderSmall'] = "全部列表";
                $data['session'] = $_SESSION;
                $data['is_admin'] = true;
                $data['user_name'] = "管理者";
                $data['property_type_list'] = $this->property_model->get_propertyType();
                $data['location_list'] = $this->property_model->get_location();

                $this->load->view('templates/header', $data);
                $this->load->view('property/index', $data);
                $this->load->view('templates/footer');
        }

	private function setPageInfo($offset, $searchTerm){

                $this->load->library('pagination');
                $config['base_url'] = '/property/page/';
                $config['total_rows'] = $this->property_model->getPropertyCountBySearchTerm($searchTerm);
		//echo "total rows".$config['total_rows'];

                $config['per_page'] = $this->perpage;
                $config['cur_page'] = $offset;
		
		$config['full_tag_open'] = "<ul class='pagination pagination-sm pull-right' style='margin-right:20px;'>";
                $config['full_tag_close'] = "</ul>";
                // first link
                $config['first_link'] = '&laquo;';
                $config['first_tag_open'] = '<li class="prev page">';
                $config['first_tag_close'] = '</li>';
                // last link
                $config['last_link'] = '&raquo;';
                $config['last_tag_open'] = '<li class="next page">';
                $config['last_tag_close'] = '</li>';
                // next link
                $config['next_link'] = '>';
                $config['next_tag_open'] = '<li class="next page">';
                $config['next_tag_close'] = '</li>';
                // prev link
                $config['prev_link'] = '<';
                $config['prev_tag_open'] = '<li class="prev page">';
                $config['prev_tag_close'] = '</li>';
                // current link
                $config['cur_tag_open'] = '<li class="active"><a>';
                $config['cur_tag_close'] = '</a></li>';
                $config['display_pages'] = TRUE;

                $config['num_tag_open'] = '<li class="page">';
                $config['num_tag_close'] = '</li>';
                return $config;
        }
}
