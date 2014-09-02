<?php
$config = array(
            'user/signup' => array(
                array(
                    'field' => 'account',
                    'label' => 'User Account',
                    'rules' => 'trim|required|min_length[5]|max_length[20]|xss_clean'
                ),
                array(
                    'field' => 'passwd',
                    'label' => 'User Password',
                    'rules' => 'trim|required|matches[repasswd]|md5'
                ),
                array(
                    'field' => 'repasswd',
                    'label' => 'Retype User Password',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'name',
                    'label' => 'User Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'school_id',
                    'label' => 'User School ID',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'phone_number',
                    'label' => 'User Phone Number',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'email',
                    'label' => 'User E-Mail',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'enroll_year',
                    'label' => 'User Enroll Year',
                    'rules' => 'trim|required|numeric'
                )
            )
        ); 
?>
