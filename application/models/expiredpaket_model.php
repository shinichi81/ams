<?php

class Expiredpaket_Model extends CI_Model {
	public function getAll($startLimit, $endLimit, $noPaket = "") {
		try {
			$this->db->select("a.no_paket, a.request_date, a.marketing_id, a.ae_id, c.name agency, b.name client, a.approve, a.done, a.create_date, a.update_date");
			$this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user", FALSE);
			$this->db->from("tbl_order_paket a");
			$this->db->join("tbl_client b", "a.client_id = b.id", "left");
			$this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
			if ($noPaket <> "")
				$this->db->like("a.no_paket", $noPaket);
			//$this->db->where("a.no_paket not in (select no_paket from tbl_request_ads where active_status = 'Y')", NULL);
			$this->db->where("a.active_status", "X");
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("a.ae_id", $this->session->userdata("username"));
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
	
	public function get($no_paket) {
		try {
			$this->db->select("a.no_paket, a.no_paket_user, a.request_date, a.ae_id, e.name sales, a.agency_id, c.name agency, a.client_id, b.name client, a.approve, a.done, a.budget, a.diskon, a.benefit, a.is_restrict, a.industry_id, a.progress, a.misc_info");
			$this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user, IFNULL(d.name, '-') industry", FALSE);
			$this->db->from("tbl_order_paket a");
			$this->db->join("tbl_client b", "a.client_id = b.id", "left");
			$this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
			$this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
			$this->db->join("tbl_user e", "a.ae_id = e.username");
			$this->db->where("a.no_paket", $no_paket);
			//$this->db->where("a.approve", "N");
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
	
	public function getDetail($no_paket) {
		try {
			$this->db->select("ads_id, kanal_id, product_group_id, position_id, misc_info");
			$this->db->select("date_format(start_date, '%Y-%m-%d') start_date", FALSE);
			$this->db->select("date_format(end_date, '%Y-%m-%d') end_date", FALSE);
			$this->db->from("tbl_order_paket_ads");
			$this->db->where("no_paket", $no_paket);
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
	
	public function getTotal($noPaket = "") {
		try {
			$this->db->from("tbl_order_paket");
			if ($noPaket <> "")
				$this->db->like("no_paket", $noPaket);
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("ae_id", $this->session->userdata("username"));
			//$this->db->where("no_paket not in (select no_paket from tbl_request_ads where active_status = 'Y')", NULL);
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