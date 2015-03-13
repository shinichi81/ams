<?php

class Report_Model extends CI_Model {
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

      public function getProductGroupByKanal($kanal_id) {
            try {
                  $this->db->select("position_id");
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

      public function getAllAgency() {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_agency");
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

      public function getAllClient() {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_client");
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

      public function getClosing($kanal_id = null, $product_group_id = null, $position_id = null, $month) {
            try {
                  $this->db->select("DATE_FORMAT(b.start_date, '%c-%Y') start_month", FALSE);
                  $this->db->select("DATE_FORMAT(b.end_date, '%c-%Y') end_month", FALSE);
                  $this->db->select("date_format(b.start_date, '%d') start_date", FALSE);
                  $this->db->select("date_format(b.end_date, '%d') end_date", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  if ($kanal_id <> null)
                        $this->db->where("b.kanal_id", $kanal_id);
                  if ($product_group_id <> null)
                        $this->db->where("b.product_group_id", $product_group_id);
                  if ($position_id <> null)
                        $this->db->where("b.position_id", $position_id);
                  $this->db->where("(DATE_FORMAT(b.start_date, '%c-%Y') = '" . $month . "'", NULL);
                  $this->db->or_where("DATE_FORMAT(b.end_date, '%c-%Y') = '" . $month . "')", NULL);
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

      public function getClosingIndustry($industry_id, $month) {
            try {
                  $this->db->select("DATE_FORMAT(b.start_date, '%c-%Y') start_month", FALSE);
                  $this->db->select("DATE_FORMAT(b.end_date, '%c-%Y') end_month", FALSE);
                  $this->db->select("date_format(b.start_date, '%d') start_date", FALSE);
                  $this->db->select("date_format(b.end_date, '%d') end_date", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  $this->db->where("(DATE_FORMAT(b.start_date, '%c-%Y') = '" . $month . "'", NULL);
                  $this->db->or_where("DATE_FORMAT(b.end_date, '%c-%Y') = '" . $month . "')", NULL);
                  $this->db->where("a.industry_id", $industry_id);
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

      public function getClosingAgency($agency_id, $month) {
            try {
                  $this->db->select("DATE_FORMAT(b.start_date, '%c-%Y') start_month", FALSE);
                  $this->db->select("DATE_FORMAT(b.end_date, '%c-%Y') end_month", FALSE);
                  $this->db->select("date_format(b.start_date, '%d') start_date", FALSE);
                  $this->db->select("date_format(b.end_date, '%d') end_date", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  $this->db->where("(DATE_FORMAT(b.start_date, '%c-%Y') = '" . $month . "'", NULL);
                  $this->db->or_where("DATE_FORMAT(b.end_date, '%c-%Y') = '" . $month . "')", NULL);
                  $this->db->where("a.agency_id", $agency_id);
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

      public function getClosingClient($client_id, $month) {
            try {
                  $this->db->select("DATE_FORMAT(b.start_date, '%c-%Y') start_month", FALSE);
                  $this->db->select("DATE_FORMAT(b.end_date, '%c-%Y') end_month", FALSE);
                  $this->db->select("date_format(b.start_date, '%d') start_date", FALSE);
                  $this->db->select("date_format(b.end_date, '%d') end_date", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  $this->db->where("(DATE_FORMAT(b.start_date, '%c-%Y') = '" . $month . "'", NULL);
                  $this->db->or_where("DATE_FORMAT(b.end_date, '%c-%Y') = '" . $month . "')", NULL);
                  $this->db->where("a.client_id", $client_id);
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

      /* s: query-query untuk booking per AE */

      public function getAllAE() {
            try {
                  $this->db->select("username, name");
                  $this->db->from("tbl_user");
                  $this->db->where("level_id", 3);
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

      public function getName($username) {
            try {
                  $this->db->select("username, name");
                  $this->db->from("tbl_user");
                  $this->db->where("active_status", "Y");
                  $this->db->where("username", $username);
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

      public function getAllPaketOrder($startLimit, $endLimit, $ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.no_paket, a.no_paket_user, a.request_date, a.marketing_id, e.name marketing, a.ae_id, a.agency_id, c.name agency, a.client_id, b.name client, a.approve, a.done, a.budget, a.diskon, a.benefit, a.is_restrict, a.industry_id, a.progress, a.misc_info");
                  $this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user, IFNULL(d.name, '-') industry", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
                  $this->db->join("tbl_user e", "a.marketing_id = e.username", "left");
                  $this->db->join("tbl_order_paket_ads f", "a.no_paket = f.no_paket");
                  //$this->db->where("a.approve", "N");
                  if ($ae <> "-")
                        $this->db->where("a.ae_id", $ae);
                  // $this->db->where("(date_format(f.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(f.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(a.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("a.active_status <>", "N");
                  $this->db->order_by("a.request_date", "desc");
                  if (!is_null($startLimit) and !is_null($endLimit))
                        $this->db->limit($endLimit, $startLimit);
                  $query = $this->db->get();
				  //echo $this->db->last_query();exit;

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

      public function getTotalPaketOrder($ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.no_paket");
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  //$this->db->where("a.approve", "N");
                  if ($ae <> "-")
                        $this->db->where("a.ae_id", $ae);
                  // $this->db->where("(date_format(b.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(b.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(a.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  //$this->db->where("no_paket not in (select no_paket from tbl_request_ads where active_status = 'Y')", NULL);
                  $this->db->where("a.active_status <>", "N");
                  $query = $this->db->get();

                  if (!$query)
                        throw new Exception();

                  return $query->num_rows();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function getAllSpaceOrder($startLimit, $endLimit, $ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.request_date, a.no_space, a.is_order_paket, a.order_by, a.agency_id, c.name agency, a.client_id, b.name client, a.is_restrict, a.industry_id, a.progress, a.misc_info");
                  $this->db->select("IFNULL(d.name, '-') industry", FALSE);
                  $this->db->from("tbl_order_space a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
                  $this->db->join("tbl_order_space_ads f", "a.no_space = f.no_space");
                  //$this->db->where("a.is_order_paket", "N");
                  $this->db->where("a.active_status", "Y");
                  if ($ae <> "-")
                        $this->db->where("a.order_by", $ae);
                  // $this->db->where("(date_format(f.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(f.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(a.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("a.active_status <>", "N");
                  $this->db->order_by("a.request_date", "desc");
                  if (!is_null($startLimit) and !is_null($endLimit))
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

      public function getTotalSpaceOrder($ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.no_space");
                  $this->db->from("tbl_order_space a");
                  $this->db->join("tbl_order_space_ads b", "a.no_space = b.no_space");
                  //$this->db->where("a.is_order_paket", "N");
                  if ($ae <> "-")
                        $this->db->where("a.order_by", $ae);
                  // $this->db->where("(date_format(b.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(b.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(a.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("a.active_status <>", "N");
                  $query = $this->db->get();

                  if (!$query)
                        throw new Exception();

                  return $query->num_rows();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function getAllClosing($startLimit, $endLimit, $ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.no_paket, a.no_paket_user, a.request_date, a.ae_id, a.marketing_id, e.name marketing, a.agency_id, c.name agency, a.client_id, b.name client, a.approve, a.done, a.budget, a.diskon, a.benefit, a.is_restrict, a.industry_id, a.progress, a.misc_info");
                  $this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user, IFNULL(d.name, '-') industry", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
                  $this->db->join("tbl_user e", "a.marketing_id = e.username", "left");
                  $this->db->join("tbl_order_paket_ads f", "a.no_paket = f.no_paket");
                  $this->db->where("a.approve", "Y");
                  if ($ae <> "-")
                        $this->db->where("a.ae_id", $ae);
                  // $this->db->where("(date_format(f.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(f.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(a.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("a.active_status", "Y");
                  $this->db->order_by("a.request_date", "desc");
                  if (!is_null($startLimit) and !is_null($endLimit))
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

      public function getTotalClosing($ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.no_paket");
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  $this->db->where("a.approve", "Y");
                  if ($ae <> "-")
                        $this->db->where("a.ae_id", $ae);
                  // $this->db->where("(date_format(b.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(b.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(a.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  //$this->db->where("no_paket not in (select no_paket from tbl_request_ads where active_status = 'Y')", NULL);
                  $this->db->where("a.active_status", "Y");
                  $query = $this->db->get();

                  if (!$query)
                        throw new Exception();

                  return $query->num_rows();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function getAllPaketExpired($startLimit, $endLimit, $ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.no_paket, a.no_paket_user, a.request_date, a.ae_id, a.marketing_id, e.name marketing, a.agency_id, c.name agency, a.client_id, b.name client, a.approve, a.done, a.budget, a.diskon, a.benefit, a.is_restrict, a.industry_id, a.progress, a.misc_info");
                  $this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user, IFNULL(d.name, '-') industry", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
                  $this->db->join("tbl_user e", "a.marketing_id = e.username", "left");
                  $this->db->join("tbl_order_paket_ads f", "a.no_paket = f.no_paket");
                  if ($ae <> "-")
                        $this->db->where("a.ae_id", $ae);
                  // $this->db->where("(date_format(f.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(f.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(a.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("a.active_status", "X");
                  $this->db->order_by("a.request_date", "desc");
                  if (!is_null($startLimit) and !is_null($endLimit))
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

      public function getTotalPaketExpired($ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.no_paket");
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_order_paket_ads b", "a.no_paket = b.no_paket");
                  if ($ae <> "-")
                        $this->db->where("a.ae_id", $ae);
                  // $this->db->where("(date_format(b.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(b.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(a.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  //$this->db->where("no_paket not in (select no_paket from tbl_request_ads where active_status = 'Y')", NULL);
                  $this->db->where("a.active_status", "X");
                  $query = $this->db->get();

                  if (!$query)
                        throw new Exception();

                  return $query->num_rows();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function getAllSpaceExpired($startLimit, $endLimit, $ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.request_date, a.no_space, a.is_order_paket, a.order_by, a.agency_id, c.name agency, a.client_id, b.name client, a.is_restrict, a.industry_id, a.progress, a.misc_info");
                  $this->db->select("IFNULL(d.name, '-') industry", FALSE);
                  $this->db->from("tbl_order_space a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
                  $this->db->join("tbl_order_space_ads f", "a.no_space = f.no_space");
                  $this->db->where("a.active_status", "X");
                  if ($ae <> "-")
                        $this->db->where("a.order_by", $ae);
                  // $this->db->where("(date_format(f.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(f.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(a.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->order_by("a.request_date", "desc");
                  if (!is_null($startLimit) and !is_null($endLimit))
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

      public function getTotalSpaceExpired($ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.no_space");
                  $this->db->from("tbl_order_space a");
                  $this->db->join("tbl_order_space_ads b", "a.no_space = b.no_space");
                  if ($ae <> "-")
                        $this->db->where("a.order_by", $ae);
                  // $this->db->where("(date_format(b.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(b.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(a.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("a.active_status", "X");
                  $query = $this->db->get();

                  if (!$query)
                        throw new Exception();

                  return $query->num_rows();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      /* e: query-query untuk booking per AE */

      /* s: query-query untuk mendapatkan total booking dan revisi per AE */

      public function getTotalPaketBookingRevisi($ae, $noPaket, $startDate, $endDate) {
            try {
                  $this->db->select("a.no_paket");
                  $this->db->from("tbl_order_paket_log a");
                  $this->db->join("tbl_order_paket b", "a.no_paket = b.no_paket");
                  $this->db->where("b.ae_id", $ae);
                  $this->db->where("a.no_paket", $noPaket);
//                  $this->db->where("date_format(b.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(b.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(b.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("b.active_status <>", "N");
                  $query = $this->db->get();
				  //echo $this->db->last_query();exit;

                  if (!$query)
                        throw new Exception();

                  return $query->num_rows();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function getTotalPaketExpiredRevisi($ae, $noPaket, $startDate, $endDate) {
            try {
                  $this->db->select("a.no_paket");
                  $this->db->from("tbl_order_paket_log a");
                  $this->db->join("tbl_order_paket b", "a.no_paket = b.no_paket");
                  $this->db->where("b.ae_id", $ae);
                  $this->db->where("a.no_paket", $noPaket);
//                  $this->db->where("date_format(b.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("b.active_status", "X");
                  $query = $this->db->get();

                  if (!$query)
                        throw new Exception();

                  return $query->num_rows();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function getTotalPaketClosingRevisi($ae, $noPaket, $startDate, $endDate) {
            try {
                  $this->db->select("a.no_paket");
                  $this->db->from("tbl_order_paket_log a");
                  $this->db->join("tbl_order_paket b", "a.no_paket = b.no_paket");
                  $this->db->where("b.ae_id", $ae);
                  $this->db->where("b.approve", "Y");
                  $this->db->where("a.no_paket", $noPaket);
//                  $this->db->where("date_format(b.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("b.active_status", "Y");
                  $query = $this->db->get();

                  if (!$query)
                        throw new Exception();

                  return $query->num_rows();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      /* e: query-query untuk mendapatkan total booking dan revisi per AE */

      /* s: query-query untuk mendapatkan paket yang unapprove */

      public function getAllUnapprove($startLimit, $endLimit, $startDate, $endDate) {
            try {
                  // $this->db->select("*");
                  // $this->db->from("tbl_unapprove_log");
                  // $this->db->where("DATE_FORMAT(create_date, '%Y-%m') = '".$month."'", NULL);
                  // if (!is_null($startLimit) and !is_null($endLimit))
                  // $this->db->limit($endLimit, $startLimit);
                  // $query = $this->db->get();		

                  $this->db->distinct();
                  $this->db->select("a.no_paket, a.no_paket_user, a.request_date, g.create_date unapprove_date, a.ae_id, a.marketing_id, e.name marketing, a.agency_id, c.name agency, a.client_id, b.name client, a.approve, a.done, a.budget, a.diskon, a.benefit, a.is_restrict, a.industry_id, a.progress, a.misc_info");
                  $this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user, IFNULL(d.name, '-') industry", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
                  $this->db->join("tbl_user e", "a.marketing_id = e.username", "left");
                  $this->db->join("tbl_order_paket_ads f", "a.no_paket = f.no_paket");
                  $this->db->join("tbl_unapprove_log g", "a.no_paket = g.no_paket");
                  // $this->db->where("a.ae_id", $ae);
                  // $this->db->where("(date_format(f.start_date, '%Y-%m') =", "'".$month."'", FALSE);
                  // $this->db->or_where("date_format(f.end_date, '%Y-%m') =", "'".$month."')", FALSE);
//                  $this->db->where("date_format(g.create_date, '%Y-%m') =", "'" . $month . "'", FALSE);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(g.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(g.create_date, '%Y-%m-%d'))", FALSE);
                  // $this->db->where("a.active_status", "X");
                  $this->db->order_by("g.create_date", "desc");
                  if (!is_null($startLimit) and !is_null($endLimit))
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

      public function getTotalUnapprove($startDate, $endDate) {
            try {
                  $this->db->select("no_paket");
                  $this->db->from("tbl_unapprove_log");
//                  $this->db->where("DATE_FORMAT(create_date, '%Y-%m') = '" . $month . "'", NULL);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(create_date, '%Y-%m-%d'))", FALSE);
                  $query = $this->db->get();

                  if (!$query)
                        throw new Exception();

                  return $query->num_rows();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      /* e: query-query untuk mendapatkan paket yang unapprove */
	  
      public function getAllBrandcommOrder($startLimit, $endLimit, $ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.no_brandcomm, a.request_date, a.order_by, a.approve, a.done, a.update_user, c.name marketing");
                  $this->db->from("tbl_order_brandcomm a");
                  $this->db->join("tbl_order_brandcomm_detail b", "a.no_brandcomm = b.no_brandcomm");
                  $this->db->join("tbl_user c", "a.update_user = c.username", "left");
                  //$this->db->where("a.approve", "N");
                  if ($ae <> "-")
                        $this->db->where("a.order_by", $ae);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("a.active_status <>", "N");
                  $this->db->where("a.done <>", "N");
                  $this->db->order_by("a.request_date", "desc");
                  if (!is_null($startLimit) and !is_null($endLimit))
                        $this->db->limit($endLimit, $startLimit);
                  $query = $this->db->get();
				  //echo $this->db->last_query();exit;

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
	  
	  public function getTotalBrandcommOrder($ae, $startDate, $endDate) {
            try {
                  $this->db->distinct();
                  $this->db->select("a.no_brandcomm");
                  $this->db->from("tbl_order_brandcomm a");
                  $this->db->join("tbl_order_brandcomm_detail b", "a.no_brandcomm = b.no_brandcomm");
                  //$this->db->where("a.is_order_paket", "N");
                  if ($ae <> "-")
                        $this->db->where("a.order_by", $ae);
                  $this->db->where("('" . $startDate . "' <= ", "date_format(a.create_date, '%Y-%m-%d')", FALSE);
                  $this->db->where("'" . $endDate . "' >= ", "date_format(a.create_date, '%Y-%m-%d'))", FALSE);
                  $this->db->where("a.active_status <>", "N");
                  $this->db->where("a.done <>", "N");
                  $query = $this->db->get();

                  if (!$query)
                        throw new Exception();

                  return $query->num_rows();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }
}