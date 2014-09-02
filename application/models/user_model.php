<?php
class User_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
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
            'password' => $this->input->post('passwd'),
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
        
} 

?>
