<?php

class Expiredspace_Model extends CI_Model {
	public function getAll($startLimit, $endLimit, $noSpace = "") {
		try {
			$this->db->select("a.no_space, a.request_date, a.order_by, a.is_order_paket, c.name agency, b.name client, a.create_date, a.update_date");
			$this->db->from("tbl_order_space a");
			$this->db->join("tbl_client b", "a.client_id = b.id", "left");
			$this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
			if ($noSpace <> "")
				$this->db->like("a.no_space", $noSpace);
			$this->db->where("a.active_status", "X");
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("a.order_by", $this->session->userdata("username"));
			$this->db->order_by("a.request_date", "desc");
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
	
	public function get($no_space) {
		try {
			$this->db->select("a.no_space, a.is_order_paket, a.order_by, e.name sales, a.agency_id, c.name agency, a.client_id, b.name client, a.is_restrict, a.industry_id, a.progress, a.misc_info");
			$this->db->select("IFNULL(d.name, '-') industry", FALSE);
			$this->db->from("tbl_order_space a");
			$this->db->join("tbl_client b", "a.client_id = b.id", "left");
			$this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
			$this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
			$this->db->join("tbl_user e", "a.order_by = e.username");
			$this->db->where("a.no_space", $no_space);
			$this->db->where("a.active_status", "X");
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
	
	public function getDetail($no_space) {
		try {
			$this->db->select("ads_id, kanal_id, product_group_id, position_id, misc_info");
			$this->db->select("date_format(start_date, '%Y-%m-%d') start_date", FALSE);
			$this->db->select("date_format(end_date, '%Y-%m-%d') end_date", FALSE);
			$this->db->from("tbl_order_space_ads");
			$this->db->where("no_space", $no_space);
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
	
	public function getTotal($noSpace = "") {
		try {
			$this->db->from("tbl_order_space");
			if ($noSpace <> "")
				$this->db->like("no_space", $noSpace);
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("order_by", $this->session->userdata("username"));
			$this->db->where("active_status", "X");
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
}