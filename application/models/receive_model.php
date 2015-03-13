<?php

class Receive_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
            try {
                  $this->db->select("a.id, a.no_request, a.no_paket, a.request_date, a.order_by, b.name sales, a.date_monitor, a.create_date, a.update_date, a.update_user");
                  $this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user", FALSE);
                  $this->db->select("CASE a.request_type
								   WHEN 'T' THEN 'Tayang Banner'
								   WHEN 'D' THEN 'Data'
							   END request_type", FALSE);
                  $this->db->from("tbl_request_ads a");
                  $this->db->join("tbl_user b", "a.order_by = b.username");
                  $this->db->where("a.active_status", "Y");
                  if ($orderBy <> "ALL") {
                        if ($orderBy == "Y") {
                              $this->db->where("a.date_monitor is not null", NULL);
                              $this->db->where("a.date_monitor <> '0000-00-00 00:00:00'", NULL);
                        } else if ($orderBy == "N") {
                              $this->db->where("(a.date_monitor is null", NULL);
                              $this->db->or_where("a.date_monitor = '0000-00-00 00:00:00')", NULL);
                        } else {
                              $this->db->like("a.no_paket", $orderBy);
                        }
                  }
                  $this->db->order_by("a.create_date", "desc");
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
                  $this->db->select("a.id, a.no_request, a.no_paket, a.no_paket_user, a.agency_id, c.name agency, a.client_id, b.name client, a.budget, a.diskon, a.benefit, a.brand, a.request_type, a.detail, a.date_monitor, a.banner_monitor, a.data_monitor, a.misc_info, a.misc_info_event, a.misc_info_production_cost, a.is_restrict, a.no_reference, a.industrycat_id");
                  $this->db->select("IFNULL(d.name, '-') industry", FALSE);
                  //$this->db->select("(select name from tbl_user where username = a.order_by) marketing");
                  $this->db->select("(select name from tbl_user where username = a.order_by) sales");
                  $this->db->select("IFNULL(a.note, '-') note", FALSE);
                  $this->db->from("tbl_request_ads a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
                  $this->db->where("a.active_status", "Y");
                  $this->db->where("a.id", $id);
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

      public function getDetail($id) {
            try {
                  $this->db->select("id, ads_id, kanal_id, product_group_id, position_id, misc_info, cpm_quota, no_po");
                  $this->db->select("date_format(start_date, '%Y-%m-%d') start_date", FALSE);
                  $this->db->select("date_format(end_date, '%Y-%m-%d') end_date", FALSE);
                  $this->db->from("tbl_request_ads_detail");
                  $this->db->where("id_header", $id);
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

      public function getAds($id) {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_ads");
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

      public function getKanal($id) {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_kanal");
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

      public function getProductgroup($id) {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_product_group");
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

      public function getPosition($id) {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_position");
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
                  $this->db->from("tbl_request_ads");
                  if ($orderBy <> "ALL") {
                        if ($orderBy == "Y") {
                              $this->db->where("date_monitor is not null", NULL);
                              $this->db->where("date_monitor <> '0000-00-00 00:00:00'", NULL);
                        } else if ($orderBy == "N") {
                              $this->db->where("(date_monitor is null", NULL);
                              $this->db->or_where("date_monitor = '0000-00-00 00:00:00')", NULL);
                        } else {
                              $this->db->like("no_paket", $orderBy);
                        }
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

      public function update($id, $date_monitor, $banner_monitor, $data_monitor, $note) {
            try {
                  $data = array(
                      "date_monitor" => $date_monitor,
                      "banner_monitor" => $banner_monitor,
                      "data_monitor" => $data_monitor,
                      "note" => $note,
                      "accept_by" => $this->session->userdata("username"),
                      "qc_by" => $this->session->userdata("username"),
                      "update_user" => $this->session->userdata("username"),
                  );

                  $this->db->where("id", $id);
                  $query = $this->db->update("tbl_request_ads", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }
	  
	  public function getNameCatIndustry($industrycat_id) {
            try {
                  $this->db->select("industry_name");
                  $this->db->from("tbl_industry_cat");
                  $this->db->where("active_status", "Y");
                  $this->db->where("id", $industrycat_id);
                  $query = $this->db->get();
				  //echo $this->db->last_query();exit;

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

      /* public function updateRequestStatus($id) {
        try {
        $data = array(
        "is_request_ads"	=>	'Y',
        );

        $this->db->where("id", $id);
        $query = $this->db->update("tbl_order_paket_ads", $data);

        if (!$query)
        throw new Exception();

        return true;
        } catch (Exception $e) {
        $errNo = $this->db->_error_number();
        //$errMsg = $this->db->_error_message();

        return error_message($errNo);
        }
        } */
}