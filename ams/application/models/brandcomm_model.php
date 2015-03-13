<?php

class Brandcomm_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $done = false) {
            try {
                  $this->db->select("a.no_brandcomm, a.request_date, b.name, a.is_order_paket, a.done, a.approve, a.enable_feedback, ifnull(c.approve, 'N') approve_paket", FALSE);
                  $this->db->from("tbl_order_brandcomm a");
                  $this->db->join("tbl_user b", "a.order_by = b.username");
                  $this->db->join("tbl_order_paket c", "a.no_brandcomm = c.no_reference", "left");
                  if ($done !== false)
                        $this->db->where("a.done", $done);
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

      public function get($no_brandcomm) {
            try {
                  $this->db->select("a.no_brandcomm, b.name, a.progress, a.is_order_paket, a.done, a.approve, a.enable_feedback, a.feedback");
                  $this->db->select("date_format(a.start_date, '%Y-%m-%d') start_date", FALSE);
                  $this->db->select("date_format(a.end_date, '%Y-%m-%d') end_date", FALSE);
                  $this->db->from("tbl_order_brandcomm a");
                  $this->db->join("tbl_user b", "a.order_by = b.username");
                  $this->db->where("a.no_brandcomm", $no_brandcomm);
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

      public function getDetail($no_brandcomm) {
            try {
                  $this->db->select("b.item, a.detail");
                  $this->db->from("tbl_order_brandcomm_detail a");
                  $this->db->join("tbl_item_brandcomm b", "a.item_brandcomm_id = b.id");
                  $this->db->where("a.no_brandcomm", $no_brandcomm);
                  $this->db->order_by("b.order_number", "asc");
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

      public function getAllItem() {
            try {
                  $this->db->select("*");
                  $this->db->from("tbl_item_brandcomm");
                  $this->db->where("active_status", "Y");
                  $this->db->order_by("order_number", "asc");
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
                  $this->db->select("no_brandcomm");
                  $this->db->from("tbl_order_brandcomm");
                  $this->db->where("create_date in (select max(create_date) from tbl_order_brandcomm where DATE_FORMAT(create_date, '%m-%Y') = DATE_FORMAT(CURRENT_TIMESTAMP, '%m-%Y'))", NULL);
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

      public function getProgress($no_brandcomm) {
            try {
                  $this->db->select("progress");
                  $this->db->from("tbl_order_brandcomm");
                  $this->db->where("no_brandcomm", $no_brandcomm);
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

      public function getTotal($done = false) {
            try {
                  $this->db->from("tbl_order_brandcomm");
                  if ($done !== false)
                        $this->db->where("done", $done);
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

      public function getTotalNotFeedback($no_brandcomm = "") {
            try {
                  if ($this->session->userdata("access_data") == "0") { // kalau akses data = "Hanya untuk saya"
                        $this->db->from("tbl_order_brandcomm");
                        $this->db->where("order_by", $this->session->userdata("username"));
                        $this->db->where("(enable_feedback", "N");
                        $this->db->or_where("feedback", NULL, FALSE);
                        $this->db->or_where("feedback", "'')", FALSE);
                        $this->db->where("no_brandcomm <>", $no_brandcomm);
                        $this->db->where("active_status", "Y");
                        $result = $this->db->count_all_results();
                  } else // kalau yang akses level administrator
                        $result = 0;

                  // if (!$result)
                  // throw new Exception();

                  return $result;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }
      
      public function getTotalPassApprove($no_brandcomm) {
            try {
                        $this->db->from("tbl_order_brandcomm");
                        $this->db->where("enable_feedback", "Y");
                        $this->db->where("feedback <>", "");
                        $this->db->where("no_brandcomm", $no_brandcomm);
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
      
      public function getTotalPassDone($no_brandcomm) {
            try {
                        $this->db->from("tbl_order_brandcomm");
                        $this->db->where("done", "Y");
                        $this->db->where("no_brandcomm", $no_brandcomm);
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

      /* public function getAllItem() {
        try {
        $this->db->select("id, item");
        $this->db->from("tbl_item_brandcomm");
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

      // public function getbrandcomm($no_brandcomm) {
      // try {
      // $this->db->select("a.no_brandcomm, a.order_by");
      // $this->db->from("tbl_order_brandcomm a");
      // $this->db->where("a.is_order_paket", "N");
      // $this->db->where("a.active_status", "Y");
      // $this->db->like("a.no_brandcomm", $no_space);
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

      public function insertOrderbrandcomm($no_brandcomm, $start_date, $end_date) {
            try {
                  $data = array(
                      "no_brandcomm" => $no_brandcomm,
                      "order_by" => $this->session->userdata("username"),
                      "start_date" => $start_date,
                      "end_date" => $end_date,
                      "create_user" => $this->session->userdata("username"),
                  );

                  $query = $this->db->insert("tbl_order_brandcomm", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function insertOrderBrancommDetail($no_brandcomm, $item_brandcomm_id, $detail) {
            try {
                  $data = array(
                      "no_brandcomm" => $no_brandcomm,
                      "item_brandcomm_id" => $item_brandcomm_id,
                      "detail" => $detail,
                  );

                  $query = $this->db->insert("tbl_order_brandcomm_detail", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function updateOrderbrandcomm($no_brandcomm, $start_date, $end_date, $feedback) {
            try {
                  $data = array(
                      "start_date" => $start_date,
                      "end_date" => $end_date,
                      "done" => "N",
                      "feedback" => $feedback,
                      "create_user" => $this->session->userdata("username"),
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

      public function updateStatusIsOrderPaket($no_brandcomm) {
            try {
                  $data = array(
                      "is_order_paket" => 'Y',
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

      public function updateStatus($column, $value, $no_brandcomm) {
            if ($column == "DONE")
                  $column = "done";
            else if ($column == "APPROVE")
                  $column = "approve";
            else if ($column == "ENABLE_FEEDBACK")
                  $column = "enable_feedback";

            try {
                  $data = array(
                      $column => $value,
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

      public function progress($no_brandcomm, $percent) {
            try {
                  $data = array(
                      "progress" => $percent,
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

      public function delete($no_brandcomm) {
            try {
                  $data = array(
                      "update_user" => $this->session->userdata("username"),
                      "active_status" => 'N',
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

      public function deleteOrderPaketBrancomm($no_brancomm) {
            try {
                  $this->db->where("no_brandcomm", $no_brancomm);
                  $query = $this->db->delete("tbl_order_brandcomm_detail");

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function unapproveBrandcomm($no_brandcomm) {
            try {
                  $data = array(
                      "done" => "N",
                      "approve" => "N",
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

}