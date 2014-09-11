<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

	public $data;
	public $perpage = 8;
	public function __construct(){
                parent::__construct();
                session_start();
		// modified by Samuel @ 2014/09/09
		// 一般來說，property 的使用都需 session 才行，若沒有 session 存在，則導回首頁。
		if(!isset($_SESSION['user_id'])){
			redirect('/', 'refresh');
		}

		$this->load->model('property_model');
		$this->load->model('user_model');
        }
	
        public function index()
        {	
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

                $data['session'] = $_SESSION;
                if($_SESSION['hsng_role_id'] == 1){
                        $data['is_admin'] = true;
                }else{
                        $data['is_admin'] = false;
                }
                $data['user_name'] = $_SESSION['username'];
	

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
			redirect("/property/index", 'refresh');
		}
        }

	// add @ 2014/09/04
	// 用來顯示財產 (利用位置分)
	public function location(){
		// list all the property by location
		$data['title'] = "HSNG 財產管理平台";
		// TBD 這個地方還沒有完成
		$locationList = $this->property_model->get_location();
		foreach($locationList as $value => $location)
		{
			$data['ptList'][$location['id']]['propertyList'] = $this->property_model->get_property_by_location($location['id']);
			$data['ptList'][$location['id']]['name'] = $location['name'];
			$data['ptList'][$location['id']]['id'] = $location['id'];
		} 
		
                $data['pageHeaderBig'] = "財產列表";
                $data['pageHeaderSmall'] = "以放置地區區分";
                $data['session'] = $_SESSION;
		if($_SESSION['hsng_role_id'] == 1){
                        $data['is_admin'] = true;
                }else{
                        $data['is_admin'] = false;
                }
                $data['user_name'] = $_SESSION['username'];
                $data['property_type_list'] = $this->property_model->get_propertyType();
                $data['location_list'] = $this->property_model->get_location();

                $this->load->view('property/location_scroll', $data);
		

	}

	 // add @ 2014/09/04
        // 用來顯示財產 (處理匯入的財產頁面)
        public function import(){
                // list all the property by location
                $data['title'] = "HSNG 財產管理平台";
                // TBD 這個地方還沒有完成
                //$data['propertyList'] = $this->property_model->get_property_by_location();
                $data['propertyList'] = $this->property_model->get_property(0, $this->perpage, "");
                $data['pageHeaderBig'] = "財產匯入頁面";
                $data['pageHeaderSmall'] = "檔案要跟煌瑋拿(需修改)";
                $data['session'] = $_SESSION;
                $data['is_admin'] = true;
                $data['user_name'] = "管理者";
                $data['property_type_list'] = $this->property_model->get_propertyType();
                $data['location_list'] = $this->property_model->get_location();

                $this->load->view('templates/header', $data);
                $this->load->view('property/import', $data);
                $this->load->view('templates/footer');

        }

	
	// actually this is not a real remove. we simply set is delete as true;
        public function remove() {
	
		// we need to check is admin trigger this action or not.
		$data['updateSuccess'] = $this->property_model->update_property_by_id();
		redirect('/property', 'refresh');	
        }
	
	public function borrow(){
		echo '<script>alert("已申請借用，待管理者審核");</script>';
		$this->property_model->borrowPropertyByUserId($_SESSION['user_id'],$_POST['property_id']);
		redirect('/','refresh');
	}
	
	// add @ 2014/09/04
	// 用來顯示可報廢的財產
	public function dumplist(){
		// list all the property by location
                $data['title'] = "HSNG 財產管理平台";
                // TBD 這個地方還沒有完成
                //$data['propertyList'] = $this->property_model->get_property_by_location();
                $data['propertyList'] = $this->property_model->get_property(0, $this->perpage, "");
                $data['pageHeaderBig'] = "財產列表";
                $data['pageHeaderSmall'] = "可報廢列表";
                $data['session'] = $_SESSION;
                $data['is_admin'] = true;
                $data['user_name'] = "管理者";
                $data['property_type_list'] = $this->property_model->get_propertyType();
                $data['location_list'] = $this->property_model->get_location();

                $this->load->view('templates/header', $data);
                $this->load->view('property/dumplist', $data);
                $this->load->view('templates/footer');

	}

	public function countedlist(){
		
                $data['title'] = "HSNG 財產管理平台";
                // TBD 這個地方還沒有完成
                //$data['propertyList'] = $this->property_model->get_property_by_location();
                $data['propertyList'] = $this->property_model->get_property(0, $this->perpage, "");
                $data['pageHeaderBig'] = "財產列表";
                $data['pageHeaderSmall'] = "年度清點結果";
                $data['session'] = $_SESSION;
                $data['is_admin'] = true;
                $data['user_name'] = "管理者";
                $data['property_type_list'] = $this->property_model->get_propertyType();
                $data['location_list'] = $this->property_model->get_location();

                $this->load->view('templates/header', $data);
                $this->load->view('property/countedlist', $data);
                $this->load->view('templates/footer');

	}

	// modify by Samuel @ 2014/09/09
	// 用來顯示財產管理網頁借用財產的審核頁面
	public function application(){

		$data['title'] = "HSNG 財產管理平台";
                // TBD 這個地方還沒有完成
                //$data['propertyList'] = $this->property_model->get_property_by_location();
                $data['propertyList'] = $this->property_model->get_property(0, $this->perpage, "");
                $data['pageHeaderBig'] = "財產借用審核頁面";
                $data['pageHeaderSmall'] = "(╯-_-)╯ ~╩╩";
                $data['session'] = $_SESSION;
		$data['is_admin'] = true;
		$data['propertyBorrowList'] = $this->property_model->getPropertyBorrowUnsignedList();
		$data['propertyReturnList'] = $this->property_model->getPropertyReturnUnsignedList();

                $this->load->view('templates/header', $data);
                $this->load->view('property/application', $data);
                $this->load->view('templates/footer');
	}

	// modify by Samuel @ 2014/09/09
	// 同意借用財產
	public function approve_app($propertyUsageId){
		$this->property_model->setPropertyUsageStatus("approvedApply", $propertyUsageId);
		redirect('/property', 'refresh');
	}
	
	// modify by Samuel @ 2014/09/09
	// 不同意借用財產
	public function disapprove_app($propertyUsageId){
		$this->property_model->setPropertyUsageStatus("disapprovedApply", $propertyUsageId);
		redirect('/property', 'refresh');
	}

	// modify by Samuel @ 2014/09/10
	// 個人歸還財產
	public function return_pro($propertyUsageId){
		// 可能要先做 check 看看這個人 是否有借這筆財產，而且 is_approved = 1(表示已經有審核通過)
		$this->property_model->setPropertyUsageStatus("returnApply", $propertyUsageId);
		redirect('/property/personal_pro', 'refresh');
	}

	// modify by Samuel @ 2014/09/10
	// 個人歸還財產
	public function return_pro_check($propertyUsageId){
		// 可能要先做 check 看看這個人 是否有借這筆財產，而且 is_approved = 1(表示已經有審核通過)
		$this->property_model->setPropertyUsageStatus("returnConfirm", $propertyUsageId);
		redirect('/property/application', 'refresh');
	}
	

	// modify by Samuel @ 2014/09/10
	// 個人財產借用頁面
	public function personal_pro(){
		
		$data['title'] = "HSNG 財產管理平台";
                // TBD 這個地方還沒有完成
                $data['personalPropertyList'] = $this->property_model->getPersonalPropertyByUserId($_SESSION['user_id']);
		for($i = 0 ; $i < count($data['personalPropertyList']); $i++){
			switch($data['personalPropertyList'][$i]['borrow_status_id']){
				case 1:
					$data['personalPropertyList'][$i]['borrow_status'] = "審核中...";
					$data['personalPropertyList'][$i]['returnButtonString'] = "審核中...";
					$data['personalPropertyList'][$i]['returnButtonStyle'] = "btn btn-default";
					$data['personalPropertyList'][$i]['extraInfo'] = "";
					$data['personalPropertyList'][$i]['linkURL'] = "";
				break;
				case 2:
					$data['personalPropertyList'][$i]['borrow_status'] = "已核準";
					$data['personalPropertyList'][$i]['returnButtonString'] = '<span class="glyphicon glyphicon-share-alt"></span> 歸還財產';
					$data['personalPropertyList'][$i]['returnButtonStyle'] = "btn btn-primary";
					$data['personalPropertyList'][$i]['extraInfo'] = "";
					$data['personalPropertyList'][$i]['linkURL'] = "onclick=\"javascript:location.href='".base_url('/property/return_pro/')."/".$data['personalPropertyList'][$i]['id']."'\"";
				break;
				case 3:
					$data['personalPropertyList'][$i]['borrow_status'] = "未核準借用";
					$data['personalPropertyList'][$i]['returnButtonString'] = "未核準借用";
					$data['personalPropertyList'][$i]['returnButtonStyle'] = "btn btn-danger";
					$data['personalPropertyList'][$i]['extraInfo'] = "";
					$data['personalPropertyList'][$i]['linkURL'] = "";
				break;
				case 4:
					$data['personalPropertyList'][$i]['borrow_status'] = "確認歸還中...";
					$data['personalPropertyList'][$i]['returnButtonString'] = "確請歸還中...";
					$data['personalPropertyList'][$i]['returnButtonStyle'] = "btn btn-default";
					$data['personalPropertyList'][$i]['extraInfo'] = "";
					$data['personalPropertyList'][$i]['linkURL'] = "";
				break;
				case 5:
					$data['personalPropertyList'][$i]['borrow_status'] = "已歸還財產";
					$data['personalPropertyList'][$i]['returnButtonString'] = "已歸還財產";
					$data['personalPropertyList'][$i]['returnButtonStyle'] = "btn btn-success";
					$data['personalPropertyList'][$i]['extraInfo'] = "";
					$data['personalPropertyList'][$i]['linkURL'] = "";
				break;
				default:
					$data['personalPropertyList'][$i]['borrow_status'] = "狀態未知";
				break;
			}
		}
                $data['pageHeaderBig'] = $_SESSION['username']." 借用列表";
                $data['pageHeaderSmall'] = "有借有還 再借不難 ╰（‵□′）╯"; 

                $data['session'] = $_SESSION;

                $this->load->view('templates/header', $data);
                $this->load->view('property/personal_property', $data);
                $this->load->view('templates/footer');

         	/*
		$data['title'] = "HSNG 財產管理平台";
                // TBD 這個地方還沒有完成
                //$data['propertyList'] = $this->property_model->get_property_by_location();
		$data['personalPropertyList'] = $this->property_model->getPersonalPropertyByUserId($_SESSION['user_id']);
                $data['pageHeaderBig'] = "個人財產借用列表";
                $data['pageHeaderSmall'] = "123";
                $data['session'] = $_SESSION;
	
                $this->load->view('templates/header', $data);
                $this->load->view('property/personal_property', $data);
                $this->load->view('templates/footer');
		*/
	}
	
	public function export($propertyId){
		echo $propertyId;
	}

	private function removeProperty($propertyId){
		return false;
	}

        public function topage($offset,$searchterm){
                $this->load->library('pagination');
                $config = $this->setPageInfo($offset, $searchterm);
	
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

                $data['title'] = "HSNG 財產管理平台";
                $data['propertyList'] = $this->property_model->get_property($offset, $this->perpage, $searchterm);
		for($i = 0 ; $i < count($data['propertyList']); $i++){
			// borrower 有人 而且 is_approved 是1
			if($data['propertyList'][$i]['borrower'] == null){
				//沒有人借
				$applyButtonString = "申請借用";
				$applyButtonStyle = "btn btn-primary";
				$applyButtonExtraInfo = 'data-target="#borrow'.$data['propertyList'][$i]['serial_id'].'" data-toggle="modal"';
			}
			else if($data['propertyList'][$i]['borrower'] == $_SESSION['user_id']){
				// 是自己借的
				// is_approved = -1 表示審核中
				if($data['propertyList'][$i]['borrow_status_id'] == 1){
					$applyButtonString = "申請審核中";
					$applyButtonStyle = "btn btn-warning";
					$applyButtonExtraInfo = "disabled";
				}
				else if($data['propertyList'][$i]['borrow_status_id'] == 2){
					$applyButtonString = $this->user_model->getUserNameByUserId($data['propertyList'][$i]['borrower']);
					$applyButtonStyle = "btn btn-default";
					$applyButtonExtraInfo = "disabled";
				}
				else if($data['propertyList'][$i]['borrow_status_id'] == 3 || $data['propertyList'][$i]['borrow_status_id'] == 5){
					// 用借失敗 或是已經歸還 這筆資料就不屬於任何人 可以再讓大家借用
					$applyButtonString = "申請借用";
                                        $applyButtonStyle = "btn btn-primary";
                                        $applyButtonExtraInfo = 'data-target="#borrow'.$data['propertyList'][$i]['serial_id'].'" data-toggle="modal"';
				}
				else if($data['propertyList'][$i]['borrow_status_id'] == 4){
					$applyButtonString = "歸還確認中";
                                        $applyButtonStyle = "btn btn-warning";
                                        $applyButtonExtraInfo = "disabled";
				}
			}
			else{
				// 是別人借的
                                if($data['propertyList'][$i]['borrow_status_id'] == 1){
                                        $applyButtonString = "它人已申請";
                                        $applyButtonStyle = "btn btn-warning";
					$applyButtonExtraInfo = "disabled";
                                }
                                else if($data['propertyList'][$i]['borrow_status_id'] == 2){
                                        $applyButtonString = $this->user_model->getUserNameByUserId($data['propertyList'][$i]['borrower']);
                                        $applyButtonStyle = "btn btn-default";
					$applyButtonExtraInfo = "disabled";
                                }
				else if($data['propertyList'][$i]['borrow_status_id'] == 3 || $data['propertyList'][$i]['borrow_status_id'] == 5){
                                        $applyButtonString = "申請借用";
                                        $applyButtonStyle = "btn btn-primary";
                                        $applyButtonExtraInfo = 'data-target="#borrow'.$data['propertyList'][$i]['serial_id'].'" data-toggle="modal"';
                                }
                                else if($data['propertyList'][$i]['borrow_status_id'] == 4){
                                        $applyButtonString = "歸還確認中";
                                        $applyButtonStyle = "btn btn-warning";
                                        $applyButtonExtraInfo = "disabled";
                                }
			}
			$data['propertyList'][$i]['applyButtonString'] = $applyButtonString;
			$data['propertyList'][$i]['applyButtonStyle'] = $applyButtonStyle;
			$data['propertyList'][$i]['applyButtonExtraInfo'] = $applyButtonExtraInfo;
		}

                $data['pageHeaderBig'] = "財產列表";
                $data['pageHeaderSmall'] = "全部列表";
                $data['session'] = $_SESSION;
		if($_SESSION['hsng_role_id'] == 1){
			$data['is_admin'] = true;
		}else{
			$data['is_admin'] = false;
		}
                $data['user_name'] = $_SESSION['username'];
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
