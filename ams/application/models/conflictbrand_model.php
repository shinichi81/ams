<?php

class Conflictbrand_Model extends CI_Model {
	public function getAll($startLimit, $endLimit) {
		try {
			$this->db->select("b.id, a.name, b.kanal_id, c.name kanal, b.product_group_id, d.name product_group, a.create_date, a.update_date");
			$this->db->from("tbl_industry a");
			$this->db->join("tbl_rule b", "a.id = b.industry_id");
			$this->db->join("tbl_kanal c", "b.kanal_id = c.id");
			$this->db->join("tbl_product_group d", "b.product_group_id = d.id");
			$this->db->where("b.active_status", "Y");
			$this->db->limit($endLimit, $startLimit);
			$query = $this->db->get();
			
			if (!$query)
				throw new Exception();
				
			$result = $query->result();
			return $result;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function get($id) {
		try {
			$this->db->select("id, industry_id, kanal_id, product_group_id, position_id");
			$this->db->from("tbl_rule");
			$this->db->where("id", $id);
			$this->db->where("active_status", "Y");			
			$query = $this->db->get();
			
			if (!$query)
				throw new Exception();
				
			$result = $query->row();
			return $result;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function getTotal() {
		try {
			$this->db->from("tbl_rule");
			$this->db->where("active_status", "Y");
			$result = $this->db->count_all_results();
			
			// if (!$result)
				// throw new Exception();
			
			return $result;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function getAllIndustry() {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_industry");
			$this->db->where("active_status", "Y");
			$query = $this->db->get();
			
			if (!$query)
				throw new Exception();
				
			$result = $query->result();
			return $result;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function getIndustry($id) {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_industry");
			$this->db->where("id", $id);
			$this->db->where("active_status", "Y");
			$query = $this->db->get();
			
			if (!$query)
				throw new Exception();
				
			$result = $query->row();
			return $result;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function getAllKanal() {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_kanal");
			$this->db->where("active_status", "Y");
			$query = $this->db->get();
			
			if (!$query)
				throw new Exception();
				
			$result = $query->result();
			return $result;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function getKanal($id) {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_kanal");
			$this->db->where("id", $id);
			$this->db->where("active_status", "Y");
			$query = $this->db->get();
			
			if (!$query)
				throw new Exception();
				
			$result = $query->row();
			return $result;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function getAllProductgroup($kanal_id) {
		try {
			$this->db->select("id, name, position_id");
			$this->db->from("tbl_product_group");
			$this->db->where("kanal_id", $kanal_id);
			$this->db->where("active_status", "Y");
			$query = $this->db->get();
			
			if (!$query)
				throw new Exception();
				
			$result = $query->result();
			return $result;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function getProductgroup($id) {
		try {
			$this->db->select("id, name, position_id");
			$this->db->from("tbl_product_group");
			$this->db->where("id", $id);
			$this->db->where("active_status", "Y");
			$query = $this->db->get();
			
			if (!$query)
				throw new Exception();
				
			$result = $query->row();
			return $result;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function getAllPosition($id, $idNotIn = "''") {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_position");
			$this->db->where("id in (".$id.")", NULL);
			$this->db->where("id not in (".$idNotIn.")", NULL);
			$this->db->where("active_status", "Y");
			$query = $this->db->get();
			
			if (!$query)
				throw new Exception();
				
			$result = $query->result();
			return $result;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function insert($industry_id, $kanal_id, $product_group_id, $position_id) {
		try {
			$data = array(
				"industry_id"		=>	$industry_id,
				"kanal_id"			=>	$kanal_id,
				"product_group_id"	=>	$product_group_id,
				"position_id"		=>	$position_id,
				"create_user"		=>	$this->session->userdata("username"),
			);
			
			$query = $this->db->insert("tbl_rule", $data);
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function update($id, $industry_id, $kanal_id, $product_group_id, $position_id) {
		try {
			$data = array(
				"industry_id"		=>	$industry_id,
				"kanal_id"			=>	$kanal_id,
				"product_group_id"	=>	$product_group_id,
				"position_id"		=>	$position_id,
				"update_user"		=>	$this->session->userdata("username"),
			);
			
			$this->db->where("id", $id);
			$query = $this->db->update("tbl_rule", $data);
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function delete($id) {
		try {
			$data = array(
				"update_user"	=>	$this->session->userdata("username"),
				"active_status"	=>	'N',
			);
			
			$this->db->where("id", $id);
			$query = $this->db->update("tbl_rule", $data);
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
}