<?php

class Login_Model extends CI_Model {
	public function auth($username, $password) {
		try {
			$this->db->select("username, name, level_id");
			$this->db->from("tbl_user");
			$this->db->where("username", $username);
			$this->db->where("password", $password);
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
	
	public function getAccess($level_id) {
		try {
			$this->db->select("a.access_data, b.menu, b.create, b.read, b.update, b.delete, b.progress");
			$this->db->from("tbl_level a");
			$this->db->join("tbl_level_access b", "a.id = b.level_id");
			$this->db->where("a.id", $level_id);
			$this->db->where("a.active_status", "Y");
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
}