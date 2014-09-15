<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Identity extends CI_Model 
{

    public function __construct()
        {
                $this->load->database();
        }
    public function judge_identity($user_id)
    {

	//echo "common libraries testing";
	//echo $user_id;
	$sql    = 'SELECT hsng_role_id,account_status_id,user_status_id  FROM user WHERE id='.$user_id.';';
	$query  = $this->db->query($sql);
	$res    = $query->row();

	$hsng_role_id       = $res->hsng_role_id;
	$account_status_id  = $res->account_status_id;
	$user_status_id     = $res->user_status_id;	
	//print_r($res[0]);

	if($hsng_role_id==1 || $hsng_role_id==2) //admin or teacher
	{
		return "state1: admin or teacher";
	}
	else //student
	{
		if($account_status_id == 3)//id核准
		{
			//echo $user_status_id;
			switch($user_status_id)
			{
			    case 1: //就讀中
				return "state2: in school ";
				break;
			    case 2:  //已畢業
				return "state3: finish school";
				break;
			    case 3 ://已休學
				return "state4: Drop out";
				break;
			    default:
				return "leave the pms";
				break;
			}
		}
		else //id 不是核准狀態，直接離開系統
		{
			return  "state5: id is unavailable, leave pms system";
		}
	}	
    }
}
?>
