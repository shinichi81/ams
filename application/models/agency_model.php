<?php

class Agency_Model extends CI_Model {
	public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
		try {
			$this->db->select("id, name, address, contact, create_date, update_date");
			$this->db->from("tbl_agency");
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

	public function get($id) {
		try {
			$this->db->select("id, name, address, contact, unit_id");
			$this->db->from("tbl_agency");
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

	public function getTotal($orderBy = "ALL") {
		try {
			$this->db->from("tbl_agency");
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

	public function insert($name, $address, $contact, $unit) {
		try {
			$data = array(
				"name"			=>	$name,
				"address"		=>	$address,
				"contact"		=>	$contact,
				"unit_id"		=>	$unit,
				"create_user"	=>	$this->session->userdata("username"),
			);

			$query = $this->db->insert("tbl_agency", $data);

			if (!$query)
				throw new Exception();

			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();

			return error_message($errNo);
		}
	}

	public function update($id, $name, $address, $contact, $unit) {
		try {
			$data = array(
				"name"			=>	$name,
				"address"		=>	$address,
				"contact"		=>	$contact,
				"unit_id"		=>	$unit,
				"update_user"	=>	$this->session->userdata("username"),
			);

			$this->db->where("id", $id);
			$query = $this->db->update("tbl_agency", $data);

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
			$query = $this->db->update("tbl_agency", $data);

			if (!$query)
				throw new Exception();

			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();

			return error_message($errNo);
		}
	}

  public function getAllUnit($id = "''") {
    try {
          $this->db->select("id, name");
          $this->db->from("tbl_unit");
          $this->db->where("active_status", "Y");
          $this->db->where("id not in (" . $id . ")", NULL);
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

  public function getSelectedUnit($id) {
    try {
          $this->db->select("id, name");
          $this->db->from("tbl_unit");
          $this->db->where("active_status", "Y");
          $this->db->where("id in (" . $id . ")", NULL);
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
