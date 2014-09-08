<?php
class User_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function add_user()
    {
        $default_hsng_role = 3; 
        $default_user_state = 1;
        $default_account_status = 1;
        $enroll_year = intval($this->input->post('enroll_year'));
        $identity_type = intval($this->input->post('identity_type'));

        switch($identity_type)
        {
            case 1:
                    $expected_graduate_year = $enroll_year + 2;//大學專題生
            break;
            case 2:
                    $expected_graduate_year = $enroll_year + 2;//研究生
            break;
            case 3:
                    $expected_graduate_year = $enroll_year + 5;//博班生
            break;
        }

        $data = array(
            'name' => $this->input->post('name'),
            'school_id' => $this->input->post('school_id'),
            'account' => $this->input->post('account'),
            'password' => md5($this->input->post('passwd')),
            'phone_number' => $this->input->post('phone_number'),
            'email' => $this->input->post('email'),
            'hsng_role_id' => $default_hsng_role,
            'user_status_id' => $default_user_state,
            'account_status_id' => $default_account_status,
            'enroll_year' => $this->input->post('enroll_year'),
            'expected_graduate_year' => $expected_graduate_year,
            'identity_type' => $this->input->post('identity_type')
        );

        $this->db->insert('user',$data);
    } 

    // modify by Samuel @ 2014/09/05 找出待審核的使用者 
    function getUncheckUser(){
	$sql = "Select id, name, school_id, account, enroll_year from user where account_status_id = 1 OR account_status_id = 2";
	
	$query = $this->db->query($sql);
	return $query->result_array();
    }

    function updateAccountStatus($userId, $approved){
	if($approved)
		$status = 3;
	
	else
		$status = 4;
	$data = array('account_status_id' => $status);
	
	$this->db->where('id', $userId);
	$this->db->update('user', $data);
	// 有 update 成功，affected_rows() = 1
	if( $this->db->affected_rows() > 0 )
		return TRUE;
	else
		return FALSE;
    } 
 
    function login_check($account,$passwd)    
    {
 
        $this->db->select('id,name,hsng_role_id,account_status_id');
        $this->db->from('user');
        $this->db->where('account',$account);
        $this->db->where('password',$passwd);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }
} 

?>
