<?php

class Approve_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "") {
            try {
                  $this->db->select("a.no_paket, a.request_date, a.marketing_id, a.ae_id, c.name agency, b.name client, a.approve, a.nopo, a.request, a.is_request, a.create_date, a.update_date");
                  $this->db->select("IFNULL(a.no_paket_user, '-') no_paket_user", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  if ($orderBy <> "ALL") {
                        if ($orderBy == "Y")
                              $this->db->where("a.approve", "Y");
                        else if ($orderBy == "N")
                              $this->db->where("a.approve", "N");
                        else
                              $this->db->like("a.no_paket", $orderBy);
                  }
                  $this->db->where("a.done", "Y");
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
                  $this->db->select("a.no_paket, a.no_paket_user, d.name sales, a.agency_id, c.name agency, a.client_id, b.name client, a.approve, a.budget, a.diskon, a.benefit, a.misc_info, a.misc_info_event, a.misc_info_production_cost, a.is_restrict, a.industrycat_id, a.industry_id, a.no_reference");
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
                  $this->db->select("id, ads_id, kanal_id, product_group_id, position_id, approve, misc_info, cpm_quota, no_po, request, no_po");
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
                              $this->db->where("approve", "Y");
                        else if ($orderBy == "N")
                              $this->db->where("approve", "N");
                        else
                              $this->db->like("no_paket", $orderBy);
                  }
                  $this->db->where("done", "Y");
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

      public function getTotalEmptyNoPo($no_paket) {
            try {
                  $this->db->from("tbl_order_paket_ads");
                  $this->db->where("approve", "Y");
                  $this->db->where("no_paket", $no_paket);
                  $this->db->where("(no_po", NULL, FALSE);
                  $this->db->or_where("no_po", "'')", FALSE);
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

      public function getNoRefence($no_paket) {
            try {
                  $this->db->select("no_reference");
                  $this->db->from("tbl_order_paket");
                  $this->db->where("no_paket", $no_paket);
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

      public function updateStatusOrderPaket($no_paket) {
            try {
                  $data = array(
                      "approve" => "Y",
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

      public function updateStatusOrderPaketAds($id) {
            try {
                  $data = array(
                      "approve" => "Y",
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
      }

      public function updateStatusToY($no_paket, $todo) {
            if ($todo == "NOPO")
                  $column = "nopo";
            elseif ($todo == "IS_NOPO")
                  $column = "is_nopo";

            try {
                  $data = array(
                      $column => "Y",
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

      public function updateNoPo($id, $no_po) {
            try {
                  $data = array(
                      "no_po" => $no_po,
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
      }

      public function updateStatusOrderBrandcomm($no_brandcomm) {
            try {
                  $data = array(
                      "approve" => "Y",
                      "update_user" => $this->session->userdata("username"),
                  );

                  $this->db->where("no_brandcomm", $no_brandcomm);
                  $query = $this->db->update("tbl_order_brandcomm", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function unapprovePaket($no_paket) {
            try {
                  $data = array(
                      //"is_update"		=>	"Y",
                      "approve" => "N",
                      "nopo" => "N",
                      "is_nopo" => "N",
                      "done" => "N",
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

      public function unapprovePaketAds($no_paket) {
            try {
                  $data = array(
                      "approve" => "N"
					  //remark 3 April 2013 @tio
                      //"no_po" => "",
                  );

                  $this->db->where("no_paket", $no_paket);
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