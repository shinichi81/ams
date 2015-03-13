<?php

class Calendar_Model extends CI_Model {

      public function getAll($kanal_id, $product_group_id, $position_id, $month) {
            try {
                  $query = $this->db->query("select a.nomor, a.no_paket_user, a.request_date, a.sales_id, d.name sales, a.agency_id, b.name agency, a.client_id, c.name client, a.done, a.approve, a.progress, a.misc_info, a.cpm_quota, a.start_date, a.end_date
									   from (
										  select a.no_paket nomor, a.no_paket_user, a.request_date, a.ae_id sales_id, a.agency_id, a.client_id, a.done, b.approve, a.progress, a.misc_info, b.cpm_quota, b.start_date, b.end_date
										  from tbl_order_paket a join tbl_order_paket_ads b
										  						   on a.no_paket = b.no_paket
										  where b.kanal_id = '" . $kanal_id . "' 
										    and b.product_group_id = '" . $product_group_id . "' 
										    and b.position_id = '" . $position_id . "' 
										    and (DATE_FORMAT(b.start_date, '%Y-%m') <= '" . $month . "' AND DATE_FORMAT(b.end_date, '%Y-%m') >= '" . $month . "') 
										    and a.active_status = 'Y'
										  union all
										  select a.no_space nomor, '-' no_paket_user, a.request_date, a.order_by sales_id, a.agency_id, a.client_id, 'N' done, 'N' approve, a.progress, a.misc_info, b.cpm_quota, b.start_date, b.end_date
										  from tbl_order_space a join tbl_order_space_ads b
										  						   on a.no_space = b.no_space
										  where b.kanal_id = '" . $kanal_id . "' 
										    and b.product_group_id = '" . $product_group_id . "' 
										    and b.position_id = '" . $position_id . "' 
										    and (DATE_FORMAT(b.start_date, '%Y-%m') <= '" . $month . "' AND DATE_FORMAT(b.end_date, '%Y-%m') >= '" . $month . "')
											and a.is_order_paket = 'N'
										    and a.active_status = 'Y'
									   ) a left join tbl_agency b on a.agency_id = b.id
									   	   left join tbl_client c on a.client_id = c.id
									   	   join tbl_user d on a.sales_id = d.username
									   order by start_date desc");

					//echo $this->db->last_query();exit();				   
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

      /* public function getAllPaket($kanal_id, $product_group_id, $position_id, $month) {
        try {
        $this->db->select("a.no_paket, a.no_paket_user, a.request_date, a.ae_id, e.name sales, a.agency_id, c.name agency, a.client_id, d.name client, a.done, b.approve, a.progress, a.misc_info, b.start_date, b.end_date");
        $this->db->from("tbl_order_paket a");
        $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
        $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
        $this->db->join("tbl_client d", "a.client_id = d.id", "left");
        $this->db->join("tbl_user e", "a.ae_id = e.username");
        $this->db->where("b.kanal_id", $kanal_id);
        $this->db->where("b.product_group_id", $product_group_id);
        $this->db->where("b.position_id", $position_id);
        $this->db->where("(DATE_FORMAT(b.start_date, '%Y-%m') = '".$month."'", NULL);
        $this->db->or_where("DATE_FORMAT(b.end_date, '%Y-%m') = '".$month."')", NULL);
        $this->db->where("a.active_status", "Y");
        $this->db->order_by("b.start_date", "desc");
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

        public function getAllSpace($kanal_id, $product_group_id, $position_id, $month) {
        try {
        $this->db->select("a.no_space, a.request_date, a.order_by, e.name sales, a.agency_id, c.name agency, a.client_id, d.name client, a.progress, a.misc_info, b.start_date, b.end_date");
        $this->db->from("tbl_order_space a");
        $this->db->join("tbl_order_space_ads b", "a.no_space = b.no_space");
        $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
        $this->db->join("tbl_client d", "a.client_id = d.id", "left");
        $this->db->join("tbl_user e", "a.order_by = e.username");
        $this->db->where("b.kanal_id", $kanal_id);
        $this->db->where("b.product_group_id", $product_group_id);
        $this->db->where("b.position_id", $position_id);
        $this->db->where("(DATE_FORMAT(b.start_date, '%Y-%m') = '".$month."'", NULL);
        $this->db->or_where("DATE_FORMAT(b.end_date, '%Y-%m') = '".$month."')", NULL);
        $this->db->where("a.is_order_paket", "N");
        $this->db->where("a.active_status", "Y");
        $this->db->order_by("b.start_date", "desc");
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
        } */

      public function getClosing($kanal_id, $product_group_id, $position_id, $month) {
            try {
                  $this->db->select("DATE_FORMAT(b.start_date, '%Y-%m') start_month", FALSE);
                  $this->db->select("DATE_FORMAT(b.end_date, '%Y-%m') end_month", FALSE);
                  $this->db->select("date_format(b.start_date, '%d') start_date", FALSE);
                  $this->db->select("date_format(b.end_date, '%d') end_date", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  $this->db->where("b.kanal_id", $kanal_id);
                  $this->db->where("b.product_group_id", $product_group_id);
                  $this->db->where("b.position_id", $position_id);
                  $this->db->where("(DATE_FORMAT(b.start_date, '%Y-%m') <= '" . $month . "'", NULL);
                  $this->db->where("DATE_FORMAT(b.end_date, '%Y-%m') >= '" . $month . "')", NULL);
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

      public function getBookingPaket($kanal_id, $product_group_id, $position_id, $month) {
            try {
                  $this->db->select("DATE_FORMAT(b.start_date, '%Y-%m') start_month", FALSE);
                  $this->db->select("DATE_FORMAT(b.end_date, '%Y-%m') end_month", FALSE);
                  $this->db->select("date_format(b.start_date, '%d') start_date", FALSE);
                  $this->db->select("date_format(b.end_date, '%d') end_date", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  $this->db->where("b.kanal_id", $kanal_id);
                  $this->db->where("b.product_group_id", $product_group_id);
                  $this->db->where("b.position_id", $position_id);
                  $this->db->where("(DATE_FORMAT(b.start_date, '%Y-%m') <= '" . $month . "'", NULL);
                  $this->db->where("DATE_FORMAT(b.end_date, '%Y-%m') >= '" . $month . "')", NULL);
                  $this->db->where("b.approve", "N");
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

      public function getBookingSpace($kanal_id, $product_group_id, $position_id, $month) {
            try {
                  $this->db->select("DATE_FORMAT(b.start_date, '%Y-%m') start_month", FALSE);
                  $this->db->select("DATE_FORMAT(b.end_date, '%Y-%m') end_month", FALSE);
                  $this->db->select("date_format(b.start_date, '%d') start_date", FALSE);
                  $this->db->select("date_format(b.end_date, '%d') end_date", FALSE);
                  $this->db->from("tbl_order_space a");
                  $this->db->join("tbl_order_space_ads b", "a.no_space = b.no_space");
                  $this->db->where("b.kanal_id", $kanal_id);
                  $this->db->where("b.product_group_id", $product_group_id);
                  $this->db->where("b.position_id", $position_id);
                  $this->db->where("(DATE_FORMAT(b.start_date, '%Y-%m') <= '" . $month . "'", NULL);
                  $this->db->where("DATE_FORMAT(b.end_date, '%Y-%m') >= '" . $month . "')", NULL);
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
                  //$this->db->where("id in (" . $id . ")", NULL);
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

}