<?php

class Unit_Model extends CI_Model {
	public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
		try {
			$this->db->select("a.id, a.name, a.perusahaan_id, a.address, a.contact, a.create_date, a.update_date, b.name as perusahaan");
			$this->db->from("tbl_unit a");
			$this->db->join("tbl_agency b", "b.id = a.perusahaan_id");
			$this->db->where("a.active_status", "Y");
			if ($orderBy <> "ALL") {
				$this->db->like("a.name", $orderBy);
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
	
	public function get($id) {
		try {
			$this->db->select("a.id, a.name, a.perusahaan_id, a.address, a.contact, b.name as perusahaan");
			$this->db->from("tbl_unit a");
			$this->db->join("tbl_agency b", "b.id = a.perusahaan_id");
			$this->db->where("a.id", $id);
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
			$this->db->from("tbl_unit");
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
	
      public function getAgency() {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_agency");
                  $this->db->where("active_status", "Y");
                  $this->db->order_by("name", "asc");
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

	public function insert($name, $perusahaan_id, $address, $contact) {
		try {
			$data = array(
				"name"			=>	$name,
				"perusahaan_id"			=>	$perusahaan_id,
				"address"		=>	$address,
				"contact"		=>	$contact,
				"create_user"	=>	$this->session->userdata("username"),
			);
			
			$query = $this->db->insert("tbl_unit", $data);
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function update($id, $name, $perusahaan_id, $address, $contact) {
		try {
			$data = array(
				"name"			=>	$name,
				"perusahaan_id"			=>	$perusahaan_id,
				"address"		=>	$address,
				"contact"		=>	$contact,
				"update_user"	=>	$this->session->userdata("username"),
			);
			
			$this->db->where("id", $id);
			$query = $this->db->update("tbl_unit", $data);
			
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
			$query = $this->db->update("tbl_unit", $data);
			
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