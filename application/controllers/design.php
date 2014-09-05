<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Design extends CI_Controller {

	public function __construct(){
		parent::__construct();
		session_start();
	}

	public function index()
	{
		if(isset($_SESSION['username']))
			redirect('/property/', 'refresh');
		else{
            $data['title'] = "HSNG 財產管理平台";
            //$_SESSION['username'] = "s750716@gmail.com";
            //$_SESSION['userRole'] = "admin";
			//$data['session'] = $_SESSION;

			$this->load->view('home_design/design_header.php', $data);
			$this->load->view('home_design/d_homepage.php', $data);
			$this->load->view('home_design/d_footer.php');
		}
	}

	public function test($param) {
  		echo "Hello world";
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>
