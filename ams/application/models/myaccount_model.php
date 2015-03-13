<?php

class Myaccount_Model extends CI_Model {
	public function get($username) {
		try {
			$this->db->select("name, email");
			$this->db->from("tbl_user");
			$this->db->where("username", $username);
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
	
	public function getPassword($username) {
		try {
			$this->db->select("password");
			$this->db->from("tbl_user");
			$this->db->where("username", $username);
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
	
	public function update($username, $password, $name, $email) {
		try {
			if ($password == "false") {
				$data = array(
					"name"			=>	$name,
					"email"			=>	$email,
					"update_user"	=>	$this->session->userdata("username"),
				);
			} else {
				$data = array(
					"password"		=>	md5($password),
					"name"			=>	$name,
					"email"			=>	$email,
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
}