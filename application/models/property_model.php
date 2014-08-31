<?php

class Property_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_property($offset, $limit, $searchterm)
        {
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

	
	public function get_propertyType(){
		
		$query = $this->db->get('property_type');
		return $query->result_array();
		
	}

	public function get_location(){
		
		$query = $this->db->get('location');
		return $query->result_array();
		
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
