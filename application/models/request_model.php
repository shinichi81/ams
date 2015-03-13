<?php

class Request_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
            try {
                  $this->db->select("a.id, a.no_request, a.no_paket, a.request_date, a.order_by, b.name sales, a.date_monitor, a.create_date, a.update_date");
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
                  if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
                        $this->db->where("a.order_by", $this->session->userdata("username"));
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

      // public function get($no_paket) {
      // try {
      // $this->db->select("a.no_paket, a.no_paket_user, a.agency_id, c.name agency, a.client_id, b.name client, a.budget, a.diskon, a.benefit, a.is_restrict, a.industry_id, d.name industry, a.misc_info");
      // $this->db->from("tbl_order_paket a");
      // $this->db->join("tbl_client b", "a.client_id = b.id", "left");
      // $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
      // $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
      // $this->db->where("a.active_status", "Y");
      // $this->db->where("a.approve", "Y");
      // $this->db->where("a.no_paket not in (select no_paket from tbl_request_ads where active_status = 'Y')", NULL);
      // $this->db->like("a.no_paket", $no_paket);
      // if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
      // $this->db->where("a.ae_id", $this->session->userdata("username"));
      // $query = $this->db->get();
// 			
      // if (!$query)
      // throw new Exception();
// 				
      // $result = $query->result();
      // return $result;
      // } catch (Exception $e) {
      // $errNo = $this->db->_error_number();
      // //$errMsg = $this->db->_error_message();
// 			
      // return error_message($errNo);
      // }
      // }

      public function get($no_paket) {
            try {
                  $this->db->select("a.no_paket, a.no_paket_user, a.agency_id, c.name agency, a.client_id, b.name client, a.budget, a.diskon, a.benefit, a.is_restrict, a.industrycat_id, a.industry_id, d.name industry, a.misc_info, a.misc_info_event, a.misc_info_production_cost, a.no_reference");
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->join("tbl_industry d", "a.industry_id = d.id", "left");
                  $this->db->where("a.active_status", "Y");
                  $this->db->where("a.approve", "Y");
                  $this->db->where("a.request", "N");
                  $this->db->where("a.is_nopo", "Y");
                  $this->db->like("a.no_paket", $no_paket);
                  if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
                        $this->db->where("a.ae_id", $this->session->userdata("username"));
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

      public function getNoPaketAndIdOrder($id_header) {
            try {
                  $this->db->select("no_paket, id_order_paket_ads");
                  $this->db->from("tbl_request_ads_detail");
                  $this->db->where("id_header", $id_header);
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

      public function getUpdate($id) {
            try {
                  $this->db->select("a.id, a.no_request, a.no_paket, a.no_paket_user, a.agency_id, c.name agency, a.client_id, b.name client, a.budget, a.diskon, a.benefit, a.brand, a.request_type, a.detail, a.date_monitor, a.banner_monitor, a.data_monitor, a.is_restrict, a.industry_id, a.misc_info, a.misc_info_event, a.misc_info_production_cost, a.no_reference");
                  $this->db->select("(select name from tbl_user where username = a.order_by) marketing");
                  $this->db->select("(select name from tbl_user where username = a.order_by) sales");
                  $this->db->select("IFNULL(a.note, '-') note", FALSE);
                  $this->db->from("tbl_request_ads a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  //$this->db->join("tbl_request_ads d", "a.no_paket = d.no_paket");
                  $this->db->where("a.active_status", "Y");
                  //$this->db->where("a.approve", "Y");
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

      public function getShowDetail($id) {
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

	  // remark 3 April 2013 @tio
      public function getRequestDetail($no_paket,$kanal_id,$product_group_id,$position_id,$start_date) {
            try {
                  $this->db->select("id, ads_id, no_paket, kanal_id, product_group_id, position_id, misc_info, cpm_quota, no_po");
                  $this->db->select("date_format(start_date, '%Y-%m-%d') start_date", FALSE);
                  $this->db->select("date_format(end_date, '%Y-%m-%d') end_date", FALSE);
                  $this->db->from("tbl_request_ads_detail");
                  $this->db->where("no_paket", $no_paket);
                  $this->db->where("kanal_id", $kanal_id);
                  $this->db->where("product_group_id", $product_group_id);
                  $this->db->where("position_id", $position_id);
				  $this->db->where('date_format(start_date, "%Y-%m-%d") =', "'".$start_date."'", FALSE);
				  //$this->db->where('date_format(end_date, "%Y-%m-%d") =', $end_date, FALSE);
                  $query = $this->db->get();
				  //print_r($query);die();
				  // echo $this->db->last_query();exit;

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

      public function getDetail($no_paket) {
            try {
                  $this->db->select("id, ads_id, kanal_id, product_group_id, position_id, misc_info, request, cpm_quota, no_po, no_paket");
                  $this->db->select("date_format(start_date, '%Y-%m-%d') start_date", FALSE);
                  $this->db->select("date_format(end_date, '%Y-%m-%d') end_date", FALSE);
                  $this->db->from("tbl_order_paket_ads");
                  $this->db->where("no_paket", $no_paket);
                  $this->db->where("approve", "Y");
//                  $this->db->where("no_po <>", "");
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

      public function getAdsName($id) {
            try {
                  $this->db->select("name");
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

      public function getKanalName($id) {
            try {
                  $this->db->select("name");
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

      public function getProductgroupName($id) {
            try {
                  $this->db->select("name");
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

      public function getPositionName($id) {
            try {
                  $this->db->select("name");
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

      public function getTotalApproveNotRequest($no_paket) {
            try {
                  $this->db->from("tbl_order_paket_ads");
                  $this->db->where("approve", "Y");
                  $this->db->where("request", "N");
                  $this->db->where("no_paket", $no_paket);
//                  $this->db->or_where("no_po", NULL);
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

      public function getTotalRemaining($no_paket) {
            try {
                  $this->db->from("tbl_request_ads");
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

      public function getLastNoRequest() {
            try {
                  $this->db->select("no_request");
                  $this->db->from("tbl_request_ads");
                  $this->db->where("create_date in (select max(create_date) from tbl_request_ads where DATE_FORMAT(create_date, '%m-%Y') = DATE_FORMAT(CURRENT_TIMESTAMP, '%m-%Y'))", NULL);
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

      // public function getSearchPaket() {
      // try {
      // $this->db->select("a.no_paket, a.no_paket_user, a.request_date, a.marketing_id, a.ae_id, c.name agency, b.name client");
      // //$this->db->select("(select name from tbl_user where username = a.marketing_id) marketing");
      // //$this->db->select("(select name from tbl_user where username = a.ae_id) sales");
      // $this->db->from("tbl_order_paket a");
      // $this->db->join("tbl_client b", "a.client_id = b.id", "left");
      // $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
      // $this->db->where("a.no_paket not in (select no_paket from tbl_request_ads where active_status = 'Y')", NULL);
      // if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
      // $this->db->where("a.ae_id", $this->session->userdata("username"));
      // $this->db->where("a.approve", "Y");
      // $this->db->where("a.active_status", "Y");
      // $query = $this->db->get();
// 			
      // if (!$query)
      // throw new Exception();
// 				
      // $result = $query->result();
      // return $result;
      // } catch (Exception $e) {
      // $errNo = $this->db->_error_number();
      // //$errMsg = $this->db->_error_message();
// 			
      // return error_message($errNo);
      // }
      // }

      public function getSearchPaket() {
            try {
                  $this->db->select("a.no_paket, a.no_paket_user, a.request_date, a.marketing_id, a.ae_id, c.name agency, b.name client");
                  //$this->db->select("(select name from tbl_user where username = a.marketing_id) marketing");
                  //$this->db->select("(select name from tbl_user where username = a.ae_id) sales");
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_client b", "a.client_id = b.id", "left");
                  $this->db->join("tbl_agency c", "a.agency_id = c.id", "left");
                  $this->db->where("a.request", "N");
                  if ($this->session->userdata("access_data") == "0") // kalau akses data = "Hanya untuk saya"
                        $this->db->where("a.ae_id", $this->session->userdata("username"));
                  $this->db->where("a.approve", "Y");
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

      // public function insert($no_paket, $request_type, $detail) {
      // try {
      // $query = $this->db->query("insert into tbl_request_ads(no_paket, no_paket_user, agency_id, client_id, budget, diskon, benefit, is_restrict, industry_id, misc_info)
      // select no_paket, no_paket_user, agency_id, client_id, budget, diskon, benefit, is_restrict, industry_id, misc_info
      // from tbl_order_paket
      // where no_paket = '".$no_paket."'");
      // if (!$query)
      // throw new Exception();
// 			
      // $id = $this->db->insert_id();
// 			
      // $data = array(
      // /*"brand"			=>	$brand,*/
      // "request_type"	=>	$request_type,
      // "detail"		=>	$detail,		
      // "order_by"		=>	$this->session->userdata("username"),
      // "create_user"	=>	$this->session->userdata("username"),
      // );
// 			
      // $this->db->where("id", $id);
      // $query = $this->db->update("tbl_request_ads", $data);
      // if (!$query)
      // throw new Exception();
// 			
      // return true;
      // } catch (Exception $e) {
      // $errNo = $this->db->_error_number();
      // //$errMsg = $this->db->_error_message();
// 			
      // return error_message($errNo);
      // }
      // }

      public function insert($no_request, $no_paket, $request_type, $detail) {
            try {
                  $query = $this->db->query("insert into tbl_request_ads(no_request, no_paket, no_paket_user, agency_id, client_id, budget, diskon, benefit, is_restrict, industrycat_id, industry_id, no_reference, misc_info, misc_info_event, misc_info_production_cost, request_type, detail, ae_id, order_by, create_user)
											select '" . $no_request . "', no_paket, no_paket_user, agency_id, client_id, budget, diskon, benefit, is_restrict, industrycat_id, industry_id, no_reference, misc_info, misc_info_event, misc_info_production_cost, '" . $request_type . "', '" . $detail . "', ae_id, '" . $this->session->userdata('username') . "', '" . $this->session->userdata('username') . "'
											from tbl_order_paket
											where no_paket = '" . $no_paket . "'");
                  if (!$query)
                        throw new Exception();

                  return $this->db->insert_id();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function insertRequestAdsDetail($no_paket, $id, $id_header) {
            try {
                  $query = $this->db->query("insert into tbl_request_ads_detail(id_header, id_order_paket_ads, no_paket, ads_id, kanal_id, product_group_id, position_id, start_date, end_date, misc_info, cpm_quota, no_po)
											select '" . $id_header . "', '" . $id . "', no_paket, ads_id, kanal_id, product_group_id, position_id, start_date, end_date, misc_info, cpm_quota, no_po
											from tbl_order_paket_ads
											where no_paket = '" . $no_paket . "'
											  and id = " . $id);
                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      /* public function update($id, $brand, $request_type, $detail) {
        try {
        $data = array(
        "brand"			=>	$brand,
        "request_type"	=>	$request_type,
        "detail"		=>	$detail,
        "update_user"	=>	$this->session->userdata("username"),
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

        public function updateRequestStatus($id) {
        try {
        $data = array(
        "is_request_ads"	=>	"Y",
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

        public function updateRequestStatusToN($no_paket) {
        try {
        $data = array(
        "is_request_ads"	=>	"N",
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
        } */

      public function updateRequestStatus($id, $value, $type) {
            if ($type == "HEADER") {
                  $column = "no_paket";
                  $table = "tbl_order_paket";
            } else if ($type == "DETAIL") {
                  $column = "id";
                  $table = "tbl_order_paket_ads";
            }

            try {
                  $data = array(
                      "request" => $value,
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

      public function updateIsRequest($no_paket, $value) {
            try {
                  $data = array(
                      "is_request" => $value,
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

      public function deleteHeader($id) {
            try {
                  /* $data = array(
                    "update_user"	=>	$this->session->userdata("username"),
                    "active_status"	=>	'N',
                    );

                    $this->db->where("id", $id);
                    $query = $this->db->update("tbl_request_ads", $data); */

                  $this->db->where("id", $id);
                  $query = $this->db->delete("tbl_request_ads");

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function deleteDetail($id) {
            try {
                  $this->db->where("id_header", $id);
                  $query = $this->db->delete("tbl_request_ads_detail");

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