<?php

class Industry_Model extends CI_Model {
	public function getAll($startLimit, $endLimit) {
		try {
			$this->db->select("id, name, create_date, update_date");
			$this->db->from("tbl_industry");
			$this->db->where("active_status", "Y");
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
	
	public function getTotal() {
		try {
			$this->db->from("tbl_industry");
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
	
	public function insert($name) {
		try {
			$data = array(
				"name"			=>	$name,
				"create_user"	=>	$this->session->userdata("username"),
			);
			
			$query = $this->db->insert("tbl_industry", $data);
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function update($id, $name) {
		try {
			$data = array(
				"name"			=>	$name,
				"update_user"	=>	$this->session->userdata("username"),
			);
			
			$this->db->where("id", $id);
			$query = $this->db->update("tbl_industry", $data);
			
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
			$query = $this->db->update("tbl_industry", $data);
			
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