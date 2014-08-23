<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		session_start();
	}

	public function index()
	{
		$data['title'] = "HSNG 財產管理平台";
		$_SESSION['username'] = "s750716@gmail.com";
		$_SESSION['userRole'] = "admin";
		$data['session'] = $_SESSION;
		$data['is_admin'] = true;

                $this->load->view('templates/header', $data);
                $this->load->view('homepage', $data);
                $this->load->view('templates/footer');
	}

	public function test($param) {
  		echo "Hello world";
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
