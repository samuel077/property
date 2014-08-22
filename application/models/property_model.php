<?php

class Property_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_property($propertyId = FALSE)
        {
                if ($propertyId === FALSE)
                {
			// get all property
                        $query = $this->db->get('property');
                        return $query->result_array();
                }

                $query = $this->db->get_where('property', array('id' => $propertyId));
                return $query->row_array();
        }

	
	public function get_propertyType(){
		
		$query = $this->db->get('property_type');
		return $query->result_array();
		
	}

	public function get_location(){
		
		$query = $this->db->get('location');
		return $query->result_array();
		
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
			'present_value' => $this->input->post('currentValue'),
			'note' => $this->input->post('note')
		);
		$this->db->insert('property', $property);
	}


        // insert part.
	/*
        public function set_news()
        {
                $this->load->helper('url');

                $slug = url_title($this->input->post('title'), 'dash', TRUE);

                $data = array(
                        'title' => $this->input->post('title'),
                        'slug' => $slug,
                        'text' => $this->input->post('text')
                );

                return $this->db->insert('news', $data);
        }*/
	
	}

?>
