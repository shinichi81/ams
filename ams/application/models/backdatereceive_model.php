<?php

class Backdatereceive_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
            try {
                  $this->db->select("a.id, a.no_paket, a.request_date, a.order_by, b.name sales, a.approve, a.create_date, a.update_date");
                  $this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user", FALSE);
                  $this->db->from("tbl_request_backdate a");
                  $this->db->join("tbl_user b", "a.order_by = b.username");
                  $this->db->where("a.active_status", "Y");
                  if ($orderBy <> "ALL") {
//                        if ($orderBy == "Y") {
//                              $this->db->where("a.date_monitor is not null", NULL);
//                              $this->db->where("a.date_monitor <> '0000-00-00 00:00:00'", NULL);
//                        } else if ($orderBy == "N") {
//                              $this->db->where("(a.date_monitor is null", NULL);
//                              $this->db->or_where("a.date_monitor = '0000-00-00 00:00:00')", NULL);
//                        } else {
                        $this->db->like("a.no_paket", $orderBy);
//                        }
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
                  $this->db->select("a.id, a.no_paket, a.no_paket_user, a.agency_id, c.name agency, a.client_id, b.name client, a.budget, a.diskon, a.benefit, a.reason, a.misc_info, a.misc_info_event, a.misc_info_production_cost, a.is_restrict, a.no_reference, industrycat_id");
                  $this->db->select("IFNULL(d.name, '-') industry", FALSE);
                  //$this->db->select("(select name from tbl_user where username = a.order_by) marketing");
                  $this->db->select("(select name from tbl_user where username = a.order_by) sales");
                  $this->db->from("tbl_request_backdate a");
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
                  $this->db->select("id, ads_id, kanal_id, product_group_id, position_id, misc_info, cpm_quota, approve");
                  $this->db->select("date_format(start_date, '%Y-%m-%d') start_date, date_format(end_date, '%Y-%m-%d') end_date", FALSE);
                  $this->db->select("date_format(new_start_date, '%Y-%m-%d') new_start_date, date_format(new_end_date, '%Y-%m-%d') new_end_date", FALSE);
                  $this->db->from("tbl_request_backdate_detail");
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

      public function getBackdate($id, $no_paket) {
            try {
                  $this->db->select("id_order_paket_ads, no_paket, new_start_date, new_end_date");
                  $this->db->from("tbl_request_backdate_detail");
                  $this->db->where("id", $id);
                  $this->db->where("no_paket", $no_paket);
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
                  $this->db->from("tbl_request_backdate");
                  if ($orderBy <> "ALL") {
//                        if ($orderBy == "Y") {
//                              $this->db->where("date_monitor is not null", NULL);
//                              $this->db->where("date_monitor <> '0000-00-00 00:00:00'", NULL);
//                        } else if ($orderBy == "N") {
//                              $this->db->where("(date_monitor is null", NULL);
//                              $this->db->or_where("date_monitor = '0000-00-00 00:00:00')", NULL);
//                        } else {
                        $this->db->like("no_paket", $orderBy);
//                        }
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

      public function getTotalNotApprove($id_header, $no_paket) {
            try {
                  $this->db->from("tbl_request_backdate_detail");
                  $this->db->where("approve", "N");
                  $this->db->where("id_header", $id_header);
                  $this->db->where("no_paket", $no_paket);
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

      public function updateApproveStatus($id, $value, $type) {
            if ($type == "HEADER") {
                  $column = "id";
                  $table = "tbl_request_backdate";
            } else if ($type == "DETAIL") {
                  $column = "id";
                  $table = "tbl_request_backdate_detail";
            }

            try {
                  $data = array(
                      "approve" => $value,
                  );

                  $this->db->where($column, $id);
                  $query = $this->db->update($table, $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function updateBackdateStatus($id, $value, $type) {
            if ($type == "HEADER") {
                  $column = "no_paket";
                  $table = "tbl_order_paket";
            } else if ($type == "DETAIL") {
                  $column = "id";
                  $table = "tbl_order_paket_ads";
            }

            try {
                  $data = array(
                      "backdate" => $value,
                  );

                  $this->db->where($column, $id);
                  $query = $this->db->update($table, $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function updateDate($id_order_paket_ads, $start_date, $end_date) {
            try {
                  $data = array(
                      "start_date" => $start_date,
                      "end_date" => $end_date
                  );

                  $this->db->where("id", $id_order_paket_ads);
                  $query = $this->db->update("tbl_order_paket_ads", $data);

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

}