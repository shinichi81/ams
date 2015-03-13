<?php

class Dashboard_Model extends CI_Model {
	public function getTotalBookingPaket($month) {
		try {
			$this->db->select("count(*) total");
			$this->db->from("tbl_order_paket");
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("ae_id", $this->session->userdata("username"));
			$this->db->where("DATE_FORMAT(request_date, '%c-%Y') = '".$month."'", NULL);
			$this->db->where("(active_status", "'Y'", FALSE);
			$this->db->or_where("active_status", "'X')", FALSE);
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
	
	public function getTotalBookingSpace($month, $onlyNotOrderPaket = FALSE) {
		try {
			$this->db->select("count(*) total");
			$this->db->from("tbl_order_space");
			if ($onlyNotOrderPaket) // query hanya order space yang belum jadi order paket
				$this->db->where("is_order_paket", "N");
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("create_user", $this->session->userdata("username"));
			$this->db->where("DATE_FORMAT(request_date, '%c-%Y') = '".$month."'", NULL);
			$this->db->where("(active_status", "'Y'", FALSE);
			$this->db->or_where("active_status", "'X')", FALSE);
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
	
	public function getTotalPaketClosing($month) {
		try {
			$this->db->select("count(*) total");
			$this->db->from("tbl_order_paket");
			$this->db->where("approve", "Y");
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("ae_id", $this->session->userdata("username"));
			$this->db->where("DATE_FORMAT(request_date, '%c-%Y') = '".$month."'", NULL);
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
	
	public function getTotalSpaceToPaket($month) {
		try {
			$this->db->select("count(*) total");
			$this->db->from("tbl_order_space");
			$this->db->where("is_order_paket", "Y");
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("create_user", $this->session->userdata("username"));
			$this->db->where("DATE_FORMAT(request_date, '%c-%Y') = '".$month."'", NULL);
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
	
	public function getTotalPaketExpired($month) {
		try {
			$this->db->select("count(*) total");
			$this->db->from("tbl_order_paket");
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("ae_id", $this->session->userdata("username"));
			$this->db->where("DATE_FORMAT(request_date, '%c-%Y') = '".$month."'", NULL);
			$this->db->where("active_status", "X");
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
	
	public function getTotalSpaceExpired($month) {
		try {
			$this->db->select("count(*) total");
			$this->db->from("tbl_order_space");
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("order_by", $this->session->userdata("username"));
			$this->db->where("DATE_FORMAT(request_date, '%c-%Y') = '".$month."'", NULL);
			$this->db->where("active_status", "X");
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
	
	public function getPaketWillExpired($startLimit, $endLimit) {
		try {
			$this->db->select("a.no_paket, a.no_paket_user, a.request_date, b.name client, c.name agency, a.progress");
			$this->db->select("TIMESTAMPDIFF(DAY, DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%e'), DATE_ADD(progress_date, INTERVAL ".$this->config->item("time_expired")." DAY)) selisih_progress", FALSE);
			$this->db->select("TIMESTAMPDIFF(DAY, DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%e'), DATE_FORMAT(max(d.start_date), '%Y-%m-%e')) selisih_tanggal", FALSE);
			$this->db->from("tbl_order_paket a");
			$this->db->join("tbl_client b", "a.client_id = b.id", "left");
			$this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
			$this->db->join("tbl_order_paket_ads d", "a.no_paket = d.no_paket");
			$this->db->where("a.approve", "N");
			$this->db->where("a.done", "Y");
			$this->db->where("a.active_status", "Y");
			$this->db->where("(d.start_date IS NOT NULL", NULL);
			$this->db->or_where("d.end_date IS NOT NULL)", NULL);
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("a.ae_id", $this->session->userdata("username"));
			$this->db->order_by("selisih_tanggal", "asc");
			$this->db->order_by("selisih_progress", "asc");
			$this->db->group_by("a.no_paket");
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
	
	public function getSpaceWillExpired($startLimit, $endLimit) {
		try {
			$this->db->select("a.no_space, a.request_date, b.name client, c.name agency, a.progress");
			$this->db->select("TIMESTAMPDIFF(DAY, DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%e'), DATE_ADD(progress_date, INTERVAL ".$this->config->item("time_expired")." DAY)) selisih_progress", FALSE);
			$this->db->select("TIMESTAMPDIFF(DAY, DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%e'), DATE_FORMAT(max(d.start_date), '%Y-%m-%e')) selisih_tanggal", FALSE);
			$this->db->from("tbl_order_space a");
			$this->db->join("tbl_client b", "a.client_id = b.id", "left");
			$this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
			$this->db->join("tbl_order_space_ads d", "a.no_space = d.no_space");
			$this->db->where("a.active_status", "Y");
			$this->db->where("a.is_order_paket", "N");
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("a.order_by", $this->session->userdata("username"));
			$this->db->order_by("selisih_tanggal", "asc");
			$this->db->order_by("selisih_progress", "asc");
			$this->db->group_by("a.no_space");
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
	
	public function getAllLatestPaket($startLimit, $endLimit) {
		try {
			$this->db->select("a.no_paket, a.request_date, a.marketing_id, a.ae_id, c.name agency, b.name client, a.approve, a.create_date, a.update_date");
			$this->db->from("tbl_order_paket a");
			$this->db->join("tbl_client b", "a.client_id = b.id", "left");
			$this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
			$this->db->where("a.active_status", "Y");
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
	
	public function getAllRequest($startLimit, $endLimit) {
		try {
			$this->db->select("id, no_paket, request_date");
			$this->db->select("CASE request_type
								   WHEN 'T' THEN 'Tayang Banner'
								   WHEN 'D' THEN 'Data'
							   END request_type", FALSE);
			$this->db->from("tbl_request_ads");
			$this->db->where("active_status", "Y");
			if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
				$this->db->where("order_by", $this->session->userdata("username"));
			$this->db->order_by("create_date", "desc");
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
	
	/* s: query-query untuk occupancy */
	public function getAllProductGroup() {
		try {
			$this->db->select("id, name, kanal_id, position_id");
			$this->db->from("tbl_product_group");
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
	
	public function getPosition($id) {
		try {
			$this->db->select("id, name");
			$this->db->from("tbl_position");
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
	
	public function getClosing($kanal_id, $product_group_id, $position_id, $month) {
		try {
			$this->db->select("DATE_FORMAT(b.start_date, '%c-%Y') start_month", FALSE);
			$this->db->select("DATE_FORMAT(b.end_date, '%c-%Y') end_month", FALSE);
			$this->db->select("date_format(b.start_date, '%d') start_date", FALSE);
			$this->db->select("date_format(b.end_date, '%d') end_date", FALSE);
			$this->db->from("tbl_order_paket a");
			$this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
			$this->db->where("b.kanal_id", $kanal_id);
			$this->db->where("b.product_group_id", $product_group_id);
			$this->db->where("b.position_id", $position_id);
			$this->db->where("(DATE_FORMAT(b.start_date, '%c-%Y') = '".$month."'", NULL);
			$this->db->or_where("DATE_FORMAT(b.end_date, '%c-%Y') = '".$month."')", NULL);
			$this->db->where("b.approve", "Y");
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
	/* e: query-query untuk occupancy */
}