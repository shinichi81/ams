<?php

class Position_Model extends CI_Model {

      public function getAll($startLimit, $endLimit) {
            try {
                  $this->db->select("id, name, price, misc_info, allow_override, create_date, update_date");
                  $this->db->from("tbl_position");
                  $this->db->where("active_status", "Y");
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
                  $this->db->select("id, name, price, misc_info, allow_override, cpm_quota");
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

      public function getTotal() {
            try {
                  $this->db->from("tbl_position");
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

      public function insert($name, $misc_info, $price='0'/* , $allow_override, $cpm_quota */) {
            try {
                  $data = array(
                      "name" => $name,
                      "misc_info" => $misc_info,
					  "price" => $price,
//                      "allow_override" => $allow_override,
//                      "cpm_quota" => $cpm_quota,
                      "create_user" => $this->session->userdata("username"),
                  );

                  $query = $this->db->insert("tbl_position", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function update($id, $name, $misc_info, $price/* , $allow_override, $cpm_quota */) {
            try {
                  $data = array(
                      "name" => $name,
                      "misc_info" => $misc_info,
					  "price"=>$price,
//                      "allow_override" => $allow_override,
//                      "cpm_quota" => $cpm_quota,
                      "update_user" => $this->session->userdata("username"),
                  );

                  $this->db->where("id", $id);
                  $query = $this->db->update("tbl_position", $data);

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
                  $query = $this->db->update("tbl_position", $data);

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