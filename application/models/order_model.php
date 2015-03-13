<?php

class Order_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "") {
            try {
                  $this->db->select("a.no_paket, a.request_date, a.marketing_id, a.ae_id, c.name agency, b.name client, a.approve, a.done, a.create_date, a.update_date");
                  $this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  if ($orderBy <> "ALL") {
                        if ($orderBy == "Y")
                              $this->db->where("a.approve", "Y");
                        else if ($orderBy == "N")
                              $this->db->where("a.approve", "N");
                        else if ($orderBy == "T")
                              $this->db->where("a.done", "Y");
                        else if ($orderBy == "F")
                              $this->db->where("a.done", "N");
                        else
                              $this->db->like("a.no_paket", $orderBy);
                  }
                  //$this->db->where("a.no_paket not in (select no_paket from tbl_request_ads where active_status = 'Y')", NULL);
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

      public function get($no_paket) {
            try {
                  $this->db->select("a.no_paket, a.no_paket_user, a.request_date, a.ae_id, e.name sales, a.agency_id, c.name agency, a.client_id, b.name client, a.approve, a.done, a.budget, a.diskon, a.benefit, a.is_restrict, a.industrycat_id, a.industry_id, a.progress, a.misc_info, a.misc_info_event, a.misc_info_production_cost, a.no_reference, a.harga_sistem, a.harga_gross, a.disc_nominal, a.harga_disc, a.pajak, a.diskon, a.total_harga");
                  $this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user, IFNULL(d.name, '-') industry, IFNULL(a.harga_sistem, '0') harga_sistem", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
                  $this->db->join("tbl_user e", "a.ae_id = e.username");
                  $this->db->where("a.no_paket", $no_paket);
                  //$this->db->where("a.approve", "N");
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

      public function getDetail($no_paket) {
            try {
                  $this->db->select("a.ads_id, a.kanal_id, a.product_group_id, a.position_id, a.misc_info, a.cpm_quota");
                  $this->db->select("date_format(a.start_date, '%Y-%m-%d') start_date", FALSE);
                  $this->db->select("date_format(a.end_date, '%Y-%m-%d') end_date", FALSE);
                  $this->db->from("tbl_order_paket_ads a");
                  // $this->db->join("tbl_product_group b", "a.product_group_id = b.id");
                  $this->db->where("a.no_paket", $no_paket);
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

      public function getLastNoPaket() {
            try {
                  $this->db->select("no_paket");
                  $this->db->from("tbl_order_paket");
                  $this->db->where("create_date in (select max(create_date) from tbl_order_paket where DATE_FORMAT(create_date, '%m-%Y') = DATE_FORMAT(CURRENT_TIMESTAMP, '%m-%Y'))", NULL);
                  //$this->db->where("active_status", "Y");
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

      public function getProgress($no_paket) {
            try {
                  $this->db->select("progress");
                  $this->db->from("tbl_order_paket");
                  $this->db->where("no_paket", $no_paket);
                  //$this->db->where("approve", "N");
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
                  $this->db->from("tbl_order_paket");
                  if ($orderBy <> "ALL") {
                        if ($orderBy == "Y")
                              $this->db->where("approve", "Y");
                        else if ($orderBy == "N")
                              $this->db->where("approve", "N");
                        else if ($orderBy == "T")
                              $this->db->where("done", "Y");
                        else if ($orderBy == "F")
                              $this->db->where("done", "N");
                        else
                              $this->db->like("no_paket", $orderBy);
                  }
                  if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
                        $this->db->where("ae_id", $this->session->userdata("username"));
                  //$this->db->where("no_paket not in (select no_paket from tbl_request_ads where active_status = 'Y')", NULL);
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

      public function getPositionInUse($kanal_id, $product_group_id, $position_id, $start_date, $end_date, $idNotIn = "") {
            try {
                  $this->db->select("b.id, b.position_id");
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  $this->db->where_not_in("a.no_paket", $idNotIn);
                  $this->db->where("b.kanal_id", $kanal_id);
                  $this->db->where("b.product_group_id", $product_group_id);
                  $this->db->where("b.position_id", $position_id);
                  $this->db->where("(('" . $start_date . "' <= ", "date_format(b.start_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $end_date . "' >= ", "date_format(b.start_date, '%Y-%m-%d')", FALSE);
                  $this->db->or_where("date_format(b.start_date, '%Y-%m-%d') <= ", "'" . $start_date . "'", FALSE);
                  $this->db->where("date_format(b.end_date, '%Y-%m-%d') >= ", "'" . $start_date . "')", FALSE);
                  $this->db->or_where("('" . $start_date . "' <= ", "date_format(b.end_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $end_date . "' >= ", "date_format(b.end_date, '%Y-%m-%d')", FALSE);
                  $this->db->or_where("date_format(b.start_date, '%Y-%m-%d') <= ", "'" . $end_date . "'", FALSE);
                  $this->db->where("date_format(b.end_date, '%Y-%m-%d') >= ", "'" . $end_date . "'))", FALSE);
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

      public function getAllPaketRestrict($industry_id, $kanal_id, $product_group_id, $start_date, $end_date, $idNotIn = "") {
            try {
                  $this->db->select("b.id, b.position_id");
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  $this->db->where_not_in("a.no_paket", $idNotIn);
                  $this->db->where("a.is_restrict", "Y");
                  $this->db->where("a.industry_id", $industry_id);
                  $this->db->where("b.kanal_id", $kanal_id);
                  $this->db->where("b.product_group_id", $product_group_id);
                  $this->db->where("(('" . $start_date . "' <= ", "date_format(b.start_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $end_date . "' >= ", "date_format(b.start_date, '%Y-%m-%d')", FALSE);
                  $this->db->or_where("date_format(b.start_date, '%Y-%m-%d') <= ", "'" . $start_date . "'", FALSE);
                  $this->db->where("date_format(b.end_date, '%Y-%m-%d') >= ", "'" . $start_date . "')", FALSE);
                  $this->db->or_where("('" . $start_date . "' <= ", "date_format(b.end_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $end_date . "' >= ", "date_format(b.end_date, '%Y-%m-%d')", FALSE);
                  $this->db->or_where("date_format(b.start_date, '%Y-%m-%d') <= ", "'" . $end_date . "'", FALSE);
                  $this->db->where("date_format(b.end_date, '%Y-%m-%d') >= ", "'" . $end_date . "'))", FALSE);
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

      public function getAllRule($industry_id, $kanal_id, $product_group_id) {
            try {
                  $this->db->select("id, position_id");
                  $this->db->from("tbl_rule");
                  $this->db->where("industry_id", $industry_id);
                  $this->db->where("kanal_id", $kanal_id);
                  $this->db->where("product_group_id", $product_group_id);
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

      public function isOverride($kanal_id, $product_group_id, $position_id) {
            try {
                  $this->db->from("tbl_cpm");
                  $this->db->where("kanal_id", $kanal_id);
                  $this->db->where("product_group_id", $product_group_id);
                  $this->db->where("position_id", $position_id);
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
      
      public function getCpmPosition($kanal_id, $product_group_id) {
            try {
                  $this->db->select("position_id");
                  $this->db->from("tbl_cpm");
                  $this->db->where("kanal_id", $kanal_id);
                  $this->db->where("product_group_id", $product_group_id);
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

      public function getCpmQuota($kanal_id, $product_group_id, $position_id) {
            try {
                  $this->db->select("cpm_quota");
                  $this->db->from("tbl_cpm");
                  $this->db->where("kanal_id", $kanal_id);
                  $this->db->where("product_group_id", $product_group_id);
                  $this->db->where("position_id", $position_id);
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

      public function getUsedCpmQuota($kanal_id, $product_group_id, $position_id, $start_date, $end_date) {
            try {
                  $this->db->select("start_date, end_date, cpm_quota");
                  $this->db->from("tbl_order_paket_ads");
                  $this->db->where("kanal_id", $kanal_id);
                  $this->db->where("product_group_id", $product_group_id);
                  $this->db->where("position_id", $position_id);
                  $this->db->where("(('" . $start_date . "' <= ", "date_format(start_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $end_date . "' >= ", "date_format(start_date, '%Y-%m-%d')", FALSE);
                  $this->db->or_where("date_format(start_date, '%Y-%m-%d') <= ", "'" . $start_date . "'", FALSE);
                  $this->db->where("date_format(end_date, '%Y-%m-%d') >= ", "'" . $start_date . "')", FALSE);
                  $this->db->or_where("('" . $start_date . "' <= ", "date_format(end_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $end_date . "' >= ", "date_format(end_date, '%Y-%m-%d')", FALSE);
                  $this->db->or_where("date_format(start_date, '%Y-%m-%d') <= ", "'" . $end_date . "'", FALSE);
                  $this->db->where("date_format(end_date, '%Y-%m-%d') >= ", "'" . $end_date . "'))", FALSE);
                  $this->db->where("approve", "Y");
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

      public function getSearchSpace() {
            try {
                  $this->db->select("a.no_space, a.request_date, a.order_by, d.name sales, c.name agency, b.name client");
                  $this->db->from("tbl_order_space a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_user d", "a.order_by = d.username");
                  if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
                        $this->db->where("a.order_by", $this->session->userdata("username"));
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

      public function getSearchBrandcomm() {
            try {
                  $this->db->select("a.no_brandcomm, a.request_date, b.name");
                  $this->db->from("tbl_order_brandcomm a");
                  $this->db->join("tbl_user b", "a.order_by = b.username");
                  if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
                        $this->db->where("a.order_by", $this->session->userdata("username"));
                  $this->db->where("a.done", "Y");
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

      public function getSpace($no_space) {
            try {
                  $this->db->select("a.no_space, a.order_by, d.name, a.agency_id, c.name agency, a.client_id, b.name client, a.is_restrict, a.industrycat_id, a.industry_id");
                  $this->db->from("tbl_order_space a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_user d", "a.order_by = d.username");
                  if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
                        $this->db->where("a.order_by", $this->session->userdata("username"));
                  $this->db->where("a.is_order_paket", "N");
                  $this->db->where("a.active_status", "Y");
                  $this->db->like("a.no_space", $no_space);
                  $query = $this->db->get();
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

      public function getSpaceDetail($no_space) {
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

      public function getBrandcomm($no_brandcomm) {
            try {
                  $this->db->select("no_brandcomm");
                  $this->db->from("tbl_order_brandcomm");
                  if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
                        $this->db->where("order_by", $this->session->userdata("username"));
                  $this->db->where("done", "Y");
                  $this->db->where("is_order_paket", "N");
                  $this->db->where("active_status", "Y");
                  $this->db->like("no_brandcomm", $no_brandcomm);
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

      public function getProgressFromSpace($no_space) {
            try {
                  $this->db->select("progress, progress_date");
                  $this->db->from("tbl_order_space");
                  $this->db->where("no_space", $no_space);
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

      public function getProgressFromBrandcomm($no_brandcomm) {
            try {
                  $this->db->select("progress, progress_date");
                  $this->db->from("tbl_order_brandcomm");
                  $this->db->where("no_brandcomm", $no_brandcomm);
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

      public function insertOrderPaket($no_paket, $agency_id, $client_id, $budget, $diskon, $benefit, $is_restrict, $industry_id, $no_reference, $misc_info, $misc_info_event, $misc_info_production_cost, $industrycat_id, $harga_sistem, $harga_gross, $disc_nominal, $harga_disc, $pajak, $total_harga) {
            try {
                  $progress = 0;
                  $progress_date = null;
                  if (!empty($no_reference)) {
                        $noReferenceType = substr($no_reference, 0, 1);

                        if ($noReferenceType == "S")
                              $dataProgress = $this->getProgressFromSpace($no_reference);
                        else
                              $dataProgress = $this->getProgressFromBrandcomm($no_reference);

                        $progress = $dataProgress->progress;
                        $progress_date = $dataProgress->progress_date;
                  }

                  if ($is_restrict == "true") {
                        $data = array(
                            "no_paket" => $no_paket,
                            "ae_id" => $this->session->userdata("username"),
                            "agency_id" => $agency_id,
                            "client_id" => $client_id,
                            "budget" => $budget,
                            "diskon" => $diskon,
                            "benefit" => $benefit,
                            "misc_info" => $misc_info,
                            "misc_info_event" => $misc_info_event,
                            "misc_info_production_cost" => $misc_info_production_cost,
                            "is_restrict" => "Y",
                            "industrycat_id" => $industrycat_id,
                            "industry_id" => $industry_id,
                            "no_reference" => $no_reference,
                            "progress" => $progress,
                            "progress_date" => $progress_date,
                            "harga_sistem" => $harga_sistem,
                            "harga_gross" => $harga_gross,
                            "disc_nominal" => $disc_nominal,
                            "harga_disc" => $harga_disc,
                            "pajak" => $pajak,
                            "total_harga" => $total_harga,
                            "create_user" => $this->session->userdata("username"),
                        );
                  } else {
                        $data = array(
                            "no_paket" => $no_paket,
                            "ae_id" => $this->session->userdata("username"),
                            "agency_id" => $agency_id,
                            "client_id" => $client_id,
                            "budget" => $budget,
                            "diskon" => $diskon,
                            "benefit" => $benefit,
                            "misc_info" => $misc_info,
                            "misc_info_event" => $misc_info_event,
                            "misc_info_production_cost" => $misc_info_production_cost,
                            "no_reference" => $no_reference,
                            "progress" => $progress,
                            "progress_date" => $progress_date,
                            "harga_sistem" => $harga_sistem,
                            "harga_gross" => $harga_gross,
                            "disc_nominal" => $disc_nominal,
                            "harga_disc" => $harga_disc,
                            "pajak" => $pajak,
                            "total_harga" => $total_harga,
                            "create_user" => $this->session->userdata("username"),
                        );
                  }

                  $query = $this->db->insert("tbl_order_paket", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function insertOrderPaketAds($no_paket, $ads_id, $kanal_id, $product_group_id, $position_id, $start_date, $end_date, $misc_info, $cpm_quota) {
            try {
                  if (empty($start_date) or empty($end_date)) {
                        $data = array(
                            "no_paket" => $no_paket,
                            "ads_id" => $ads_id,
                            "kanal_id" => $kanal_id,
                            "product_group_id" => $product_group_id,
                            "position_id" => $position_id,
                            "misc_info" => $misc_info,
                            "cpm_quota" => $cpm_quota,
                        );
                  } else {
                        $data = array(
                            "no_paket" => $no_paket,
                            "ads_id" => $ads_id,
                            "kanal_id" => $kanal_id,
                            "product_group_id" => $product_group_id,
                            "position_id" => $position_id,
                            "start_date" => $start_date . " 12:00:00",
                            "end_date" => $end_date . " 12:00:00",
                            "misc_info" => $misc_info,
                            "cpm_quota" => $cpm_quota,
                        );
                  }

                  $query = $this->db->insert("tbl_order_paket_ads", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function updateOrderPaket($no_paket, $agency_id, $client_id, $budget, $diskon, $benefit, $is_restrict, $industry_id, $misc_info, $misc_info_event, $misc_info_production_cost, $industrycat_id, $harga_sistem, $harga_gross, $disc_nominal, $harga_disc, $pajak, $total_harga) {
            try {
                  if ($is_restrict == "true") {
                        $data = array(
                            //"ae_id"						=>	$this->session->userdata("username"),
                            "agency_id" => $agency_id,
                            "client_id" => $client_id,
                            "budget" => $budget,
                            "diskon" => $diskon,
                            "benefit" => $benefit,
                            "misc_info" => $misc_info,
                            "misc_info_event" => $misc_info_event,
                            "misc_info_production_cost" => $misc_info_production_cost,
                            "is_restrict" => "Y",
                            "is_update" => "Y",
                            //"approve"						=>	"N",
                            "done" => "N",
                            "industrycat_id" => $industrycat_id,
                            "industry_id" => $industry_id,
                            "harga_sistem" => $harga_sistem,
                            "harga_gross" => $harga_gross,
                            "disc_nominal" => $disc_nominal,
                            "harga_disc" => $harga_disc,
                            "pajak" => $pajak,
                            "total_harga" => $total_harga,
                            "update_user" => $this->session->userdata("username"),
                            "active_status" => "Y",
                        );
                  } else {
                        $data = array(
                            //"ae_id"						=>	$this->session->userdata("username"),
                            "agency_id" => $agency_id,
                            "client_id" => $client_id,
                            "budget" => $budget,
                            "diskon" => $diskon,
                            "benefit" => $benefit,
                            "misc_info" => $misc_info,
                            "harga_sistem" => $harga_sistem,
                            "misc_info_event" => $misc_info_event,
                            "misc_info_production_cost" => $misc_info_production_cost,
                            "is_restrict" => "N",
                            "is_update" => "Y",
                            //"approve"						=>	"N",
                            "done" => "N",
                            "industrycat_id" => "",
                            "industry_id" => "",
                            "harga_sistem" => $harga_sistem,
                            "harga_gross" => $harga_gross,
                            "disc_nominal" => $disc_nominal,
                            "harga_disc" => $harga_disc,
                            "pajak" => $pajak,
                            "total_harga" => $total_harga,
                            "update_user" => $this->session->userdata("username"),
                            "active_status" => "Y",
                        );
                  }

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

      public function updateStatusIsOrderPaket($no, $packet_type) {
            if ($packet_type == "N") {
                  $column = "no_space";
                  $table = "tbl_order_space";
            } else {
                  $column = "no_brandcomm";
                  $table = "tbl_order_brandcomm";
            }

            try {
                  $data = array(
                      "is_order_paket" => 'Y',
                  );

                  $this->db->where($column, $no);
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

      public function progress($no_paket, $percent) {
            try {
                  $data = array(
                      "progress" => $percent,
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

      public function delete($no_paket) {
            try {
                  $data = array(
                      "update_user" => $this->session->userdata("username"),
                      "active_status" => 'N',
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

      public function deleteOrderPaketAds($no_paket) {
            try {
                  $this->db->where("no_paket", $no_paket);
                  $query = $this->db->delete("tbl_order_paket_ads");

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }
	  
	  //TAMBAHAN DARI WILLY
	  
      public function getHarga($id) {
            try {
                  $this->db->select("harga");
                  $this->db->from("tbl_product_group_harga");
                  $this->db->where("id_position", $id);
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

      public function getAllProd() {
            try {
                  $this->db->select("id, nama");
                  $this->db->from("tbl_production");
                  $this->db->where("active", "Y");
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

      public function getHargaProd($id) {
            try {
                  $this->db->select("harga");
                  $this->db->from("tbl_production");
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
	  
      public function insertOrderProduction($no_paket, $production_id, $quantity, $harga, $harga_total, $keterangan) {
            try {
					$data = array(
						"no_paket" => $no_paket,
						"production_id" => $production_id,
						"quantity" => $quantity,
						"harga" => $harga,
						"harga_total" => $harga_total,
						"keterangan" => $keterangan,
					);

                  $query = $this->db->insert("tbl_order_production", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function deleteOrderProduction($no_paket) {
            try {
                  $this->db->where("no_paket", $no_paket);
                  $query = $this->db->delete("tbl_order_production");

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function insertOrderEvent($no_paket, $event, $start_date, $end_date, $biaya, $keterangan) {
            try {
					$data = array(
						"no_paket" => $no_paket,
						"event" => $event,
						"start_date" => $start_date . " 12:00:00",
						"end_date" => $end_date . " 12:00:00",
						"biaya" => $biaya,
						"keterangan" => $keterangan,
					);

                  $query = $this->db->insert("tbl_order_event", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function deleteOrderEvent($no_paket) {
            try {
                  $this->db->where("no_paket", $no_paket);
                  $query = $this->db->delete("tbl_order_event");

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }
	  
      public function getProduction($no_paket) {
            try {
                  $this->db->select("production_id, quantity, harga, harga_total, keterangan");
                  $this->db->from("tbl_order_production");
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
	  
      public function getEvent($no_paket) {
            try {
                  $this->db->select("event, biaya, keterangan");
                  $this->db->select("date_format(start_date, '%Y-%m-%d') start_date", FALSE);
                  $this->db->select("date_format(end_date, '%Y-%m-%d') end_date", FALSE);
                  $this->db->from("tbl_order_event");
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
	  
      public function getSingleProduction($id) {
            try {
                  $this->db->select("id, nama");
                  $this->db->from("tbl_production");
                  $this->db->where("active", "Y");
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
}