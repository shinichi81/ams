<?php

class Harga_Model extends CI_Model {
	public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
		try {
			$this->db->select("a.id, b.name AS kanal, c.name AS rubrik, d.name AS product, e.name AS position, a.harga, a.update_date");
			$this->db->from("tbl_product_group_harga a");
            $this->db->join("tbl_kanal b", "a.id_kanal = b.id");
            $this->db->join("tbl_rubrik c", "a.id_rubrik = c.id");
            $this->db->join("tbl_product_group d", "a.id_product = d.id");
            $this->db->join("tbl_position e", "a.id_position = e.id");
			$this->db->order_by('a.id_kanal', 'asc');
			if ($orderBy <> "ALL") {
				$this->db->like("kanal", $orderBy);
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
			$this->db->select("id, id_kanal, id_rubrik, id_product, id_position, harga, update_date");
			$this->db->from("tbl_product_group_harga");
			$this->db->where("id", $id);
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
			$this->db->from("tbl_product_group_harga");
			if ($orderBy <> "ALL") {
				// $this->db->like("nama", $orderBy);
			}
			// $this->db->where("active", "Y");
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
	
	public function insert($id_kanal, $id_rubrik, $id_produk, $id_position, $harga) {
		try {
			$data = array(
				"id_kanal"			=>	$id_kanal,
				"id_rubrik"		=>	$id_rubrik,
				"id_product"		=>	$id_produk,
				"id_position"	=>	$id_position,
				"harga"				=>	$harga,
			);
			
			$query = $this->db->insert("tbl_product_group_harga", $data);
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function update($id, $id_kanal, $id_rubrik, $id_produk, $id_position, $harga) {
		try {
			$data = array(
				"id_kanal"			=>	$id_kanal,
				"id_rubrik"		=>	$id_rubrik,
				"id_product"		=>	$id_produk,
				"id_position"	=>	$id_position,
				"harga"				=>	$harga,
				"update_user"	=>	$this->session->userdata("username"),
			);
			
			$this->db->where("id", $id);
			$query = $this->db->update("tbl_product_group_harga", $data);
			
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

    public function getAllRubrik($kanal_id, $id = "''") {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_rubrik");
			$this->db->where("active_status", "Y");
            $this->db->where("kanal_id", $kanal_id);
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
		  
    public function getAllProduk($kanal_id, $id = "''") {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_product_group");
			$this->db->where("active_status", "Y");
            $this->db->where("kanal_id", $kanal_id);
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

    public function getAllPosition($id = "''") {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_position");
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
}