<?php

class Production_Model extends CI_Model {
	public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
		try {
			$this->db->select("id, nama, harga, update_date");
			$this->db->from("tbl_production");
			$this->db->where("active", "Y");
			if ($orderBy <> "ALL") {
				$this->db->like("nama", $orderBy);
			}
			$this->db->limit($endLimit, $startLimit);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			
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
			$this->db->select("id, nama, harga");
			$this->db->from("tbl_production");
			$this->db->where("id", $id);
			$this->db->where("active", "Y");
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
			$this->db->from("tbl_production");
			if ($orderBy <> "ALL") {
				$this->db->like("nama", $orderBy);
			}
			$this->db->where("active", "Y");
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
	
	public function insert($nama, $harga) {
		try {
			$data = array(
				"nama"			=>	$nama,
				"harga"			=>	$harga,
				"create_user"	=>	$this->session->userdata("username"),
			);
			
			$query = $this->db->insert("tbl_production", $data);
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function update($id, $nama, $harga) {
		try {
			$data = array(
				"nama"			=>	$nama,
				"harga"			=>	$harga,
				"update_user"	=>	$this->session->userdata("username"),
			);
			
			$this->db->where("id", $id);
			$query = $this->db->update("tbl_production", $data);
			
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
				"active"	=>	'N',
			);
			
			$this->db->where("id", $id);
			$query = $this->db->update("tbl_production", $data);
			
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