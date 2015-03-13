<?php

class Offerposition_Model extends CI_Model {
	public function getAll($startLimit, $endLimit) {
		try {
			$this->db->select("a.id, b.name ads, c.name kanal, d.name product_group, e.name position, a.create_date, a.update_date");
			$this->db->from("tbl_offer_position a");
			$this->db->join("tbl_ads b", "a.ads_id = b.id");
			$this->db->join("tbl_kanal c", "a.kanal_id = c.id");
			$this->db->join("tbl_product_group d", "a.product_group_id = d.id");
			$this->db->join("tbl_position e", "a.position_id = e.id");
			$this->db->where("a.active_status", "Y");
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
			$this->db->select("a.id, b.name ads, a.kanal_id, c.name kanal, a.product_group_id, d.name product_group, a.position_id, e.name position, a.dimension, a.size, a.rate_period, a.gross_rate, a.pictures_name, a.imp, a.sov , a.create_date, a.update_date");
			$this->db->from("tbl_offer_position a");
			$this->db->join("tbl_ads b", "a.ads_id = b.id");
			$this->db->join("tbl_kanal c", "a.kanal_id = c.id");
			$this->db->join("tbl_product_group d", "a.product_group_id = d.id");
			$this->db->join("tbl_position e", "a.position_id = e.id");
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
	
	public function getTotal() {
		try {
			$this->db->from("tbl_offer_position a");
			$this->db->join("tbl_ads b", "a.ads_id = b.id");
			$this->db->join("tbl_kanal c", "a.kanal_id = c.id");
			$this->db->join("tbl_product_group d", "a.product_group_id = d.id");
			$this->db->join("tbl_position e", "a.position_id = e.id");
			$this->db->where("a.active_status", "Y");
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
	
	public function insert($ads_id, $kanal_id, $product_group_id, $position_id, $dimension, $size, $rate_period, $gross_rate, $pictures_name, $imp, $sov) {
		try {
			$data = array(
				"ads_id"			=>	$ads_id,
				"kanal_id"			=>	$kanal_id,
				"product_group_id"	=>	$product_group_id,
				"position_id"		=>	$position_id,
				"dimension"			=>	$dimension,
				"size"				=>	$size,
				"rate_period"		=>	$rate_period,
				"gross_rate"		=>	$gross_rate,
				"pictures_name"		=>	$pictures_name,
				"imp"				=>	$imp,
				"sov"				=>	$sov,
				"create_user"		=>	$this->session->userdata("username"),
			);
			
			$query = $this->db->insert("tbl_offer_position", $data);
			
			if (!$query)
				throw new Exception();
			
			return true;
		} catch (Exception $e) {
			$errNo = $this->db->_error_number();
			//$errMsg = $this->db->_error_message();
			
			return error_message($errNo);
		}
	}
	
	public function update($id, $ads_id, $kanal_id, $product_group_id, $position_id, $dimension, $size, $rate_period, $gross_rate, $pictures_name, $imp, $sov) {
		try {
			$data = array(
				"ads_id"			=>	$ads_id,
				"kanal_id"			=>	$kanal_id,
				"product_group_id"	=>	$product_group_id,
				"position_id"		=>	$position_id,
				"dimension"			=>	$dimension,
				"size"				=>	$size,
				"rate_period"		=>	$rate_period,
				"gross_rate"		=>	$gross_rate,
				"pictures_name"		=>	$pictures_name,
				"imp"				=>	$imp,
				"sov"				=>	$sov,
				"update_user"		=>	$this->session->userdata("username"),
			);
			
			$this->db->where("id", $id);
			$query = $this->db->update("tbl_offer_position", $data);
			
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
			$query = $this->db->update("tbl_offer_position", $data);
			
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