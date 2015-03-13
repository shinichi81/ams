<?php

class Level_Model extends CI_Model {
	public function getAll($startLimit, $endLimit) {
		try {
			$this->db->select("id, name, misc_info, access_data, create_date, update_date");
			$this->db->from("tbl_level");
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
			$this->db->select("id, name, misc_info, access_data");
			$this->db->from("tbl_level");
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
	
	public function getAccess($id) {
		try {
			$this->db->select("level_id, menu, create, read, update, delete, progress");
			$this->db->from("tbl_level_access");
			$this->db->where("level_id", $id);
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
	
	public function getTotal() {
		try {
			$this->db->from("tbl_level");
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
	
	public function insert($name, $misc_info, $access_data) {
		try {
			$data = array(
				"name"			=>	$name,
				"misc_info"		=>	$misc_info,
				"access_data"	=>	$access_data,
				"create_user"	=>	$this->session->userdata("username"),
			);
			
			$query = $this->db->insert("tbl_level", $data);
			
			if (!$query)
				throw new Exception();
			
			return $this->db->insert_id();
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function insertUpdateAccess($level_id, $menu, $column, $value) {
		try {
			$this->db->from("tbl_level_access");
			$this->db->where("level_id", $level_id);
			$this->db->where("menu", $menu);
			$this->db->where("active_status", "Y");
			$totRow = $this->db->count_all_results();
			
			if ($totRow == 0) {
				$data = array(
					"level_id"		=>	$level_id,
					"menu"			=>	$menu,
					$column			=>	$value,
				);
				
				$query = $this->db->insert("tbl_level_access", $data);
			} else {
				$data = array(
					$column			=>	$value,
				);
				
				$this->db->where("level_id", $level_id);
				$this->db->where("menu", $menu);
				$query = $this->db->update("tbl_level_access", $data);
			}
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function update($id, $name, $misc_info, $access_data) {
		try {
			$data = array(
				"name"			=>	$name,
				"misc_info"		=>	$misc_info,
				"access_data"	=>	$access_data,
				"update_user"	=>	$this->session->userdata("username"),
			);
			
			$this->db->where("id", $id);
			$query = $this->db->update("tbl_level", $data);
			
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
			$query = $this->db->update("tbl_level", $data);
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function deleteAccess($level_id) {
		try {
			$this->db->where("level_id", $level_id);
			$query = $this->db->delete("tbl_level_access");
			
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