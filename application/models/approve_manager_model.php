<?php

class Approve_Manager_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
            try {
				  $this->db->distinct();
                  $this->db->select("a.no_paket, f.no_po, f.no_so, a.request_date, b.name AS brand, c.name AS company");
                  $this->db->select("IFNULL(f.no_po, e.no_po) AS no_po", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_agency b", "a.agency_id = b.id");
                  $this->db->join("tbl_client c", "a.client_id = c.id");
                  $this->db->join("tbl_order_paket_ads e", "e.no_paket = a.no_paket");
                  $this->db->join("tbl_invoice f", "f.no_paket = a.no_paket", "left");
                  $this->db->where("a.approve", "Y");
                  $this->db->where("f.approve_manager", "N");
                  $this->db->where("f.alasan is NULL");
				  $this->db->where("f.no_po IS NOT NULL");
				  $this->db->where("f.no_so IS NOT NULL");
				  if ($orderBy <> "ALL") {
						$this->db->like("a.no_paket", $orderBy);
                  }
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
                  // $this->db->select("a.no_paket, a.harga_sistem, a.harga_gross, a.disc_nominal, a.harga_disc, a.pajak, a.diskon, a.total_harga, a.no_so, a.request_date, b.name AS brand, c.name AS company, d.name AS sales");
                  $this->db->select("a.no_paket, f.no_so, f.no_invoice, a.request_date, b.name AS brand, c.name AS company, d.name AS sales, g.paket_gross, a.diskon, g.diskon_nominal, g.additional_diskon, g.additional_diskon_nominal, g.paket_total, g.produksi_total, g.event_total, g.pajak, g.total");
                  $this->db->select("IFNULL(f.no_po, e.no_po) AS no_po", FALSE);
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_agency b", "a.agency_id = b.id");
                  $this->db->join("tbl_client c", "a.client_id = c.id");
                  $this->db->join("tbl_user d", "a.ae_id = d.username");
                  $this->db->join("tbl_order_paket_ads e", "e.no_paket = a.no_paket");
                  $this->db->join("tbl_invoice f", "f.no_paket = a.no_paket", "left");
                  $this->db->join("tbl_order_harga g", "g.no_paket = a.no_paket", "left");
                  $this->db->where("a.no_paket", $no_paket);
                  // $this->db->where("a.approve", "Y");
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
                  $this->db->select("id, ads_id, kanal_id, product_group_id, position_id, misc_info, cpm_quota, request");
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
                  $this->db->from("tbl_kanal_new");
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
                  $this->db->from("tbl_product_group_new");
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
                  $this->db->from("tbl_position_new");
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

      public function getHarga($kanal, $product, $position) {
            try {
                  $this->db->select("harga");
                  $this->db->from("tbl_product_group_harga");
                  $this->db->where("id_kanal", $kanal);
                  $this->db->where("id_product", $product);
                  $this->db->where("id_position", $position);
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
                  $this->db->from("tbl_order_paket a");
                  $this->db->join("tbl_invoice f", "f.no_paket = a.no_paket", "left");
				  if ($orderBy <> "ALL") {
						$this->db->like("a.no_paket", $orderBy);
                  }
                  $this->db->where("a.approve", "Y");
                  $this->db->where("a.active_status", "Y");
                  $this->db->where("f.approve_manager", "N");
                  $this->db->where("f.alasan is NULL");
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

      public function update($no_paket, $approve_manager, $alasan) {
            try {
                  $data = array(
                      "approve_manager" => $approve_manager,
                      "alasan" => $alasan,
                      // "update_user" => $this->session->userdata("username"),
                  );
				  
                  $this->db->where("no_paket", $no_paket);
                  $query = $this->db->update("tbl_invoice", $data);

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