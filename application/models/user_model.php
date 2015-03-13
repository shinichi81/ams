<?php

class User_Model extends CI_Model {
	public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
		try {
			$this->db->select("username, name, email, create_date, update_date");
			$this->db->from("tbl_user");
			$this->db->where("active_status", "Y");
			if ($orderBy <> "ALL") {
				$this->db->like("name", $orderBy);
			}
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
	
	public function get($username) {
		try {
			$this->db->select("username, name, email, department_id, level_id");
			$this->db->from("tbl_user");
			$this->db->where("username", $username);
			$this->db->where("active_status", "Y");
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			
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
	
	public function getDetail($username) {
		try {
			$this->db->select("a.username, a.name, a.email, b.name department, c.name level");
			$this->db->from("tbl_user a");
			$this->db->join("tbl_department b", "a.department_id = b.id");
			$this->db->join("tbl_level c", "a.level_id = c.id");
			$this->db->where("username", $username);
			$this->db->where("a.active_status", "Y");
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
	
	public function getTotal($orderBy = "ALL") {
		try {
			$this->db->from("tbl_user");
			if ($orderBy <> "ALL") {
				$this->db->like("name", $orderBy);
			}
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
	
	public function getAllDepartment() {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_department");
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
	
	public function getAllLevel() {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_level");
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
	
	public function insert($username, $password, $name, $email, $department_id, $level_id) {
		try {
			$data = array(
				"username"		=>	$username,
				"password"		=>	md5($password),
				"name"			=>	$name,
				"email"			=>	$email,
				"department_id"	=>	$department_id,
				"level_id"		=>	$level_id,
				"create_user"	=>	$this->session->userdata("username"),
			);
			
			$query = $this->db->insert("tbl_user", $data);
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function update($username, $password, $name, $email, $department_id, $level_id) {
		try {
			if ($password == "false") {
				$data = array(
					"name"			=>	$name,
					"email"			=>	$email,
					"department_id"	=>	$department_id,
					"level_id"		=>	$level_id,
					"update_user"	=>	$this->session->userdata("username"),
				);
			} else {
				$data = array(
					"password"		=>	md5($password),
					"name"			=>	$name,
					"email"			=>	$email,
					"department_id"	=>	$department_id,
					"level_id"		=>	$level_id,
					"update_user"	=>	$this->session->userdata("username"),
				);
			}
			
			$this->db->where("username", $username);
			$query = $this->db->update("tbl_user", $data);
			
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
			
			$this->db->where("username", $id);
			$query = $this->db->update("tbl_user", $data);
			
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