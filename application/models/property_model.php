<?php

class Property_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_property($offset, $limit, $searchterm)
        {
		//echo "message from property_mode, searchterm = ".$searchterm."<br/>";
		$sql = "SELECT pr.*, lo.name as location_name, pt.name as property_type_name, pu.user_id as borrower, pu.is_approved 
			FROM property pr LEFT JOIN property_usage pu ON pr.id = pu.property_id, 
			location lo, property_type pt
			WHERE
			pr.location_id = lo.id 
			AND pr.property_type = pt.id 
			AND pr.is_delete = 0
			"; /* LIMIT $offset, $limit";*/
		if($searchterm != ""){
			$sql .= " AND (
					pr.name LIKE '%$searchterm%'
					OR pr.brand LIKE '%$searchterm%'
					OR lo.name LIKE '%$searchterm%'
					OR pt.name LIKE '%$searchterm%'
				)";
			// date 的部份還暫時有問題，先不加，要把date的格式變成String 才有辦法使用LIKE
			//OR pr.purchase_date LIKE '%$searchterm%'
			// 有了 searchterm offset 就不重要了，這裡先歸0，limit 還是照舊不變
			$offset = 0;
		}
		
		$sql .= " LIMIT $offset, $limit";	
		//echo "sql = ".$sql;	
		$query = $this->db->query($sql);
		return $query->result_array();
 		/*               
		if ($propertyId == FALSE)
                {
			// get all property
                        $query = $this->db->get('property');
                        return $query->result_array();
                }

                $query = $this->db->get_where('property', array('id' => $propertyId));
                return $query->row_array();
		*/
        }

	public function get_property_by_location($location_id){
		$sql = "SELECT pr.*, lo.name as location_name, pt.name as property_type_name
                        from property pr, location lo, property_type pt
                        where 
			pr.location_id = lo.id 
			AND pr.property_type = pt.id 
			AND pr.is_delete = 0
			AND pr.location_id = $location_id";
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
	public function get_propertyType(){
		
		$query = $this->db->get('property_type');
		return $query->result_array();
		
	}

	public function get_location(){
		
		$query = $this->db->get('location');
		return $query->result_array();
		
	}

	public function borrowPropertyByUserId($userId, $propertyId){
		echo "got you here in model";
		echo "usre id = ".$userId." and propertyId = ".$propertyId;
		                // 使用 post 的資料來 set 資料庫
                $this->load->helper('url');

		$propertyUsage = array(
			'user_id' => $userId, 
			'property_id' => $propertyId, 
			'issue_date' => date("Y-m-d H:i:s"), 
			'is_approved' => -1, 
			'admin_sign_date' => null, 
			'execuse' => null, 
			'note' => null
		);

		$this->db->insert('property_usage', $propertyUsage);
	}

	public function getPropertyCountBySearchTerm($searchterm){
                if($searchterm == ""){
                        $sql = "SELECT count(*) as count from property WHERE 1";
			$query = $this->db->query($sql);
			$a = $query->result_array();

			return $a[0]['count'];
                }
                else{
			//echo "message from property_mode, searchterm = ".$searchterm."<br/>";
			$sql = "SELECT pr.*, lo.name as location_name, pt.name as property_type_name
				from property pr, location lo, property_type pt
				where pr.location_id = lo.id AND pr.property_type = pt.id AND pr.is_delete = 0"; /* LIMIT $offset, $limit";*/
				if($searchterm != ""){
					$sql .= " AND (
						pr.name LIKE '%$searchterm%'
						OR pr.brand LIKE '%$searchterm%'
						OR lo.name LIKE '%$searchterm%'
						OR pt.name LIKE '%$searchterm%'
						)";
					// date 的部份還暫時有問題，先不加，要把date的格式變成String 才有辦法使用LIKE
					//OR pr.purchase_date LIKE '%$searchterm%'
					// 有了 searchterm offset 就不重要了，這裡先歸0，limit 還是照舊不變
					$offset = 0;
				}
			$query = $this->db->query($sql);
			return $query->num_rows;
		}
        }

	// modified by Samuel @ 2014/09/09
	// 用來 query 使用者借用財產的紀錄	
	public function getPropertyBorrowUnsignedList(){
		// is approved = -1 表示剛申請，申請通過為1，不通過為0
		$sql = "SELECT pr.serial_id, pr.name, pr.brand, pt.name as property_type_name, ur.name as borrower, pu.issue_date, pu.id as appId
			FROM property pr, property_type pt, user ur, property_usage pu
			WHERE 
			pu.user_id = ur.id
			AND pu.property_id = pr.id
			AND pt.id = pr.property_type
			AND pu.is_approved = -1
			";
		 $query = $this->db->query($sql);
		 return $query->result_array();	
	}

	public function getPersonalProperty($userId){
		$sql = "SELECT pu.*, pr.id as property_id, pr.serial_id as property_serial_id, pr.location_id as location_id, pr.note as property_note, lo.name as lo.location_name
			FROM property_usage pu LEFT JOIN property pr ON pu.property_id = pr.id, location lo
			WHERE pu.user_id = $userId
			AND pr.location_id = lo.id
		";
		die($sql);
	}

	public function setPropertyUsageStatus($isApproved, $propertyUsageId){
		if($isApproved){
			$data = array('is_approved' => '1');
		}else{
			$data = array('is_approved' => '0');
		}
		
		$this->db->where('id', $propertyUsageId);
                $this->db->update('property_usage', $data);

	}
	
	public function set_property(){
		// 使用 post 的資料來 set 資料庫
		$this->load->helper('url');

	
		$property = array(
			'name' => $this->input->post('name'),
			'serial_id' => $this->input->post('sequence'),
			'purchase_date' => $this->input->post('purchaseDate'),
			'expire_info' => $this->input->post('expire_info'),
			'brand' => $this->input->post('brand'),
			'location_id' => $this->input->post('location'),
			'origin_value' => $this->input->post('currentValue'),
			'property_type' => $this->input->post('property_type'),
			'note' => $this->input->post('note')
		);
		$this->db->insert('property', $property);
	}

	public function update_property_by_id(){
		if($this->input->post('status') === 'remove')
		{
			$data = array(
				'is_delete' => '1',
				'delete_note' => date('Y-m-d H:i:s')
			);
		}
		else
		{
			$data = array(
				'name' => $this->input->post('name'), 
				'serial_id' => $this->input->post('serial_id'), 
				'purchase_date' => $this->input->post('purchase_date'), 
				'expire_info' => $this->input->post('expire_info'), 
				'brand' => $this->input->post('brand'), 
				'location_id' => $this->input->post('location'), 
				'origin_value' => $this->input->post('currentValue'), 
				'property_type' => $this->input->post('property_type'), 
				'note' => $this->input->post('note') 
			);
		}
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('property', $data);
		// 有 update 成功，affected_rows() = 1
		if( $this->db->affected_rows() > 0 )
			return TRUE;
		else
			return FALSE;
	}
}

?>
