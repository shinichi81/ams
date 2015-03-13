<?php

class Itembrandcomm_Model extends CI_Model {

      public function getAll($startLimit = FALSE, $endLimit = FALSE) {
            try {
                  $this->db->select("id, item, order_number, create_date, update_date");
                  $this->db->from("tbl_item_brandcomm");
                  $this->db->where("active_status", "Y");
                  if ($startLimit !== FALSE and $endLimit !== FALSE)
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
                  $this->db->select("id, item, order_number");
                  $this->db->from("tbl_item_brandcomm");
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

      public function getTotal() {
            try {
                  $this->db->from("tbl_item_brandcomm");
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

      public function insert($item, $orderNumber) {
            try {
                  $data = array(
                      "item" => $item,
                      "order_number" => $orderNumber,
                      "create_user" => $this->session->userdata("username"),
                  );

                  $query = $this->db->insert("tbl_item_brandcomm", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function update($id, $item, $orderNumber) {
            try {
                  $data = array(
                      "item" => $item,
                      "order_number" => $orderNumber,
                      "update_user" => $this->session->userdata("username"),
                  );

                  $this->db->where("id", $id);
                  $query = $this->db->update("tbl_item_brandcomm", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function delete($id) {
            try {
                  $data = array(
                      "update_user" => $this->session->userdata("username"),
                      "active_status" => 'N',
                  );

                  $this->db->where("id", $id);
                  $query = $this->db->update("tbl_item_brandcomm", $data);

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