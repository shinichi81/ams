<?php

class Timeline_Model extends CI_Model {
	public function getDataPaket($kanal_id, $product_group_id, $position_id) {
		try {
			$this->db->select("a.ae_id, e.name sales, a.agency_id, d.name agency, a.client_id, c.name client, a.budget, a.diskon, a.benefit, b.start_date, b.end_date, b.approve, b.cpm_quota");
			$this->db->from("tbl_order_paket a");
			$this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
			$this->db->join("tbl_client c", "a.client_id = c.id", "left");
			$this->db->join("tbl_agency d", "a.agency_id = d.id", "left");
			$this->db->join("tbl_user e", "a.ae_id = e.username");
			$this->db->where("b.kanal_id", $kanal_id);
			$this->db->where("b.product_group_id", $product_group_id);
			$this->db->where("b.position_id", $position_id);
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
	
	public function getDataSpace($kanal_id, $product_group_id, $position_id) {
		try {
			$this->db->select("a.order_by, e.name sales, a.agency_id, d.name agency, a.client_id, c.name client, b.start_date, b.end_date");
			$this->db->from("tbl_order_space a");
			$this->db->join("tbl_order_space_ads b", "a.no_space = b.no_space");
			$this->db->join("tbl_client c", "a.client_id = c.id");
			$this->db->join("tbl_agency d", "a.agency_id = d.id");
			$this->db->join("tbl_user e", "a.order_by = e.username");
			$this->db->where("b.kanal_id", $kanal_id);
			$this->db->where("b.product_group_id", $product_group_id);
			$this->db->where("b.position_id", $position_id);
			$this->db->where("a.is_order_paket", "N");
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
	
	public function getAllPosition($id) {
		try {
			$query = $this->db->query("
					SELECT
					  id,name
					FROM (tbl_position)
					WHERE id IN(" . $id . ")
						AND active_status = 'Y'
						ORDER BY FIELD (id, " . $id . ")
				  ");
			//$this->db->select("id, name");
			//$this->db->from("tbl_position");
			//$this->db->where("id in (".$id.")", NULL);
			//$this->db->where("active_status", "Y");
			//$query = $this->db->get();
			
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