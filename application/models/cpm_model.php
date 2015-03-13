<?php

class Cpm_Model extends CI_Model {

      public function getAll($startLimit = FALSE, $endLimit = FALSE, $orderBy = "ALL") {
            try {
                  $this->db->select("a.id, b.name kanal_name, c.name product_group_name, d.name position_name, a.cpm_quota, a.create_date, a.update_date");
                  $this->db->from("tbl_cpm a");
                  $this->db->join("tbl_kanal b", "a.kanal_id = b.id");
                  $this->db->join("tbl_product_group c", "a.product_group_id = c.id");
                  $this->db->join("tbl_position d", "a.position_id = d.id");
                  $this->db->where("a.active_status", "Y");
				  if ($orderBy <> "ALL") {
						$this->db->like("c.name", $orderBy);
                  }
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
                 $this->db->select("a.id, b.name kanal_name, c.name product_group_name, d.name position_name, a.cpm_quota");
                  $this->db->from("tbl_cpm a");
                  $this->db->join("tbl_kanal b", "a.kanal_id = b.id");
                  $this->db->join("tbl_product_group c", "a.product_group_id = c.id");
                  $this->db->join("tbl_position d", "a.position_id = d.id");
                  $this->db->where("a.id", $id);
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

      public function getTotal() {
            try {
                  $this->db->from("tbl_cpm");
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

      public function update($id, $cpm_quota) {
            try {
                  $data = array(
                      "cpm_quota" => $cpm_quota,
                      "update_user" => $this->session->userdata("username"),
                  );

                  $this->db->where("id", $id);
                  $query = $this->db->update("tbl_cpm", $data);

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