<?php

class Orderspace_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "") {
            try {
                  $this->db->select("a.no_space, a.request_date, a.order_by, a.is_order_paket, c.name agency, b.name client, a.create_date, a.update_date");
                  $this->db->from("tbl_order_space a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  if ($orderBy <> "ALL") {
                        if ($orderBy == "Y")
                              $this->db->where("a.is_order_paket", "Y");
                        else if ($orderBy == "N")
                              $this->db->where("a.is_order_paket", "N");
                        else
                              $this->db->like("a.no_space", $orderBy);
                  }
                  $this->db->where("a.active_status", "Y");
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
                  $this->db->select("a.no_space, a.is_order_paket, a.order_by, e.name sales, a.agency_id, c.name agency, a.client_id, b.name client, a.is_restrict, a.industrycat_id, a.industry_id, a.progress, a.misc_info");
                  $this->db->select("IFNULL(d.name, '-') industry", FALSE);
                  $this->db->from("tbl_order_space a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
                  $this->db->join("tbl_user e", "a.order_by = e.username");
                  $this->db->where("a.no_space", $no_space);
                  $this->db->where("a.active_status <>", "N");
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
                  $this->db->select("ads_id, kanal_id, product_group_id, position_id, misc_info, cpm_quota");
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

      public function getLastNoSpace() {
            try {
                  $this->db->select("no_space");
                  $this->db->from("tbl_order_space");
                  $this->db->where("create_date in (select max(create_date) from tbl_order_space where DATE_FORMAT(create_date, '%m-%Y') = DATE_FORMAT(CURRENT_TIMESTAMP, '%m-%Y'))", NULL);
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

      public function getProgress($no_space) {
            try {
                  $this->db->select("progress");
                  $this->db->from("tbl_order_space");
                  $this->db->where("no_space", $no_space);
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

      public function getTotal($orderBy) {
            try {
                  $this->db->from("tbl_order_space");
                  if ($orderBy <> "ALL") {
                        if ($orderBy == "Y")
                              $this->db->where("is_order_paket", "Y");
                        else if ($orderBy == "N")
                              $this->db->where("is_order_paket", "N");
                        else
                              $this->db->like("no_space", $orderBy);
                  }
                  if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
                        $this->db->where("order_by", $this->session->userdata("username"));
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
	  
	  public function getNameIndustry($industrycat_id) {
            try {
                  $this->db->select("name");
                  $this->db->from("tbl_industry");
                  $this->db->where("active_status", "Y");
                  $this->db->where("id", $industrycat_id);
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

      public function getAllIndustry() {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_industry");
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

      public function getAllIndustryCat() {
            try {
                  $this->db->select("id, industry_name, subindustry_id");
                  $this->db->from("tbl_industry_cat");
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

      public function getAllIndustryCatId($industrycat_id) {
            try {
                  $this->db->select("id, industry_name, subindustry_id");
                  $this->db->from("tbl_industry_cat");
                  $this->db->where("id", $industrycat_id);
                  $this->db->where("active_status", "Y");
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

      public function getAllAds() {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_ads");
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

      public function getAllProductGroup($kanal_id) {
            try {
                  $this->db->select("id, name, rubrik_id, position_id");
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

      public function getProductGroup($id) {
            try {
                  $this->db->select("id, name, kanal_id, position_id");
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
                  $this->db->select("id, name, allow_override");
                  $this->db->from("tbl_position");
                  $this->db->where("id in (" . $id . ")", NULL);
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

      public function getPosition($id) {
            try {
                  $this->db->select("id, name, allow_override");
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

      public function getAgency() {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_agency");
                  $this->db->where("active_status", "Y");
                  $this->db->order_by("name", "asc");
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

      public function getClient() {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_client");
                  $this->db->where("active_status", "Y");
                  $this->db->order_by("name", "asc");
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

      public function insertOrderSpace($no_space, $agency_id, $client_id, $is_restrict, $industry_id, $misc_info, $industrycat_id) {
            try {
                  if ($is_restrict == "true") {
                        $data = array(
                            "no_space" => $no_space,
                            "order_by" => $this->session->userdata("username"),
                            "agency_id" => $agency_id,
                            "client_id" => $client_id,
                            "misc_info" => $misc_info,
                            "is_restrict" => "Y",
                            "industrycat_id" => $industrycat_id,
                            "industry_id" => $industry_id,
                            "create_user" => $this->session->userdata("username"),
                        );
                  } else {
                        $data = array(
                            "no_space" => $no_space,
                            "order_by" => $this->session->userdata("username"),
                            "agency_id" => $agency_id,
                            "client_id" => $client_id,
                            "misc_info" => $misc_info,
                            "create_user" => $this->session->userdata("username"),
                        );
                  }

                  $query = $this->db->insert("tbl_order_space", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function insertOrderSpaceAds($no_space, $ads_id, $kanal_id, $product_group_id, $position_id, $start_date, $end_date, $misc_info, $cpm_quota) {
            try {
                  $data = array(
                      "no_space" => $no_space,
                      "ads_id" => $ads_id,
                      "kanal_id" => $kanal_id,
                      "product_group_id" => $product_group_id,
                      "position_id" => $position_id,
                      "start_date" => $start_date . " 12:00:00",
                      "end_date" => $end_date . " 12:00:00",
                      "misc_info" => $misc_info,
                      "cpm_quota" => $cpm_quota,
                  );

                  $query = $this->db->insert("tbl_order_space_ads", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function updateOrderSpace($no_space, $agency_id, $client_id, $is_restrict, $industry_id, $misc_info, $industrycat_id) {
            try {
                  if ($is_restrict == "true") {
                        $data = array(
                            "agency_id" => $agency_id,
                            "client_id" => $client_id,
                            "misc_info" => $misc_info,
                            "is_restrict" => "Y",
                            "industrycat_id" => $industrycat_id,
                            "industry_id" => $industry_id,
                            "update_user" => $this->session->userdata("username"),
                            "active_status" => "Y",
                        );
                  } else {
                        $data = array(
                            "agency_id" => $agency_id,
                            "client_id" => $client_id,
                            "misc_info" => $misc_info,
                            "is_restrict" => "N",
                            "industrycat_id" => "",
                            "industry_id" => "",
                            "update_user" => $this->session->userdata("username"),
                            "active_status" => "Y",
                        );
                  }

                  $this->db->where("no_space", $no_space);
                  $query = $this->db->update("tbl_order_space", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function progress($no_space, $percent) {
            try {
                  $data = array(
                      "progress" => $percent,
                  );

                  $this->db->where("no_space", $no_space);
                  $query = $this->db->update("tbl_order_space", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function delete($no_space) {
            try {
                  $data = array(
                      "update_user" => $this->session->userdata("username"),
                      "active_status" => 'N',
                  );

                  $this->db->where("no_space", $no_space);
                  $query = $this->db->update("tbl_order_space", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function deleteOrderSpaceAds($no_space) {
            try {
                  $this->db->where("no_space", $no_space);
                  $query = $this->db->delete("tbl_order_space_ads");

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