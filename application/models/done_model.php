<?php

class Done_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "") {
            try {
                  $this->db->select("a.no_paket, a.request_date, a.marketing_id, a.ae_id, c.name agency, b.name client, a.done, a.create_date, a.update_date");
                  $this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  if ($orderBy <> "ALL") {
                        if ($orderBy == "Y")
                              $this->db->where("a.done", "Y");
                        else if ($orderBy == "N")
                              $this->db->where("a.done", "N");
                        else
                              $this->db->like("a.no_paket", $orderBy);
                  }
                  $this->db->where("a.active_status", "Y");
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
                  $this->db->select("a.no_paket, a.no_paket_user, d.name sales, a.agency_id, c.name agency, a.client_id, b.name client, a.done, a.budget, a.diskon, a.benefit, a.misc_info, a.misc_info_event, a.misc_info_production_cost, a.is_restrict, a.industrycat_id, a.no_reference");
                  $this->db->select("IFNULL(e.name, '-') industry", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_user d", "a.ae_id = d.username");
                  $this->db->join("tbl_industry e", "a.industry_id = e.id", "left");
                  $this->db->where("a.no_paket", $no_paket);
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

      public function getDetail($no_paket) {
            try {
                  $this->db->select("id, ads_id, kanal_id, product_group_id, position_id, approve, misc_info, cpm_quota");
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

      public function getTotal($orderBy) {
            try {
                  $this->db->from("tbl_order_paket");
                  if ($orderBy <> "ALL") {
                        if ($orderBy == "Y")
                              $this->db->where("done", "Y");
                        else if ($orderBy == "N")
                              $this->db->where("done", "N");
                        else
                              $this->db->like("no_paket", $orderBy);
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

      public function getAds($id) {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_ads");
                  $this->db->where("active_status", "Y");
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
                  $this->db->where("active_status", "Y");
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

      public function getProductGroup($id) {
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

      public function getPosition($id) {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_position");
                  $this->db->where("active_status", "Y");
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

      public function update($no_paket, $no_paket_user) {
            try {
                  $data = array(
                      "marketing_id" => $this->session->userdata("username"),
                      "done" => "Y",
                      "no_paket_user" => $no_paket_user,
                      "is_update" => "N",
                      "update_user" => $this->session->userdata("username"),
                  );

                  $this->db->where("no_paket", $no_paket);
                  $query = $this->db->update("tbl_order_paket", $data);

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