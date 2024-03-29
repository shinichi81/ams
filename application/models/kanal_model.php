<?php

class Kanal_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
            try {
                  $this->db->select("id, name, misc_info, create_date, update_date");
                  $this->db->from("tbl_kanal_new");
                  $this->db->where("active_status", "Y");
				  if ($orderBy <> "ALL") {
						$this->db->like("name", $orderBy);
                  }
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
                  $this->db->select("id, name, misc_info");
                  $this->db->from("tbl_kanal_new");
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

      public function getTotal($orderBy = "ALL") {
            try {
                  $this->db->from("tbl_kanal_new");
				  if ($orderBy <> "ALL") {
						$this->db->like("name", $orderBy);
                  }
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

      public function getRubrik($kanal_id) {
            try {
                  $this->db->select("rubrik_id");
                  $this->db->from("tbl_kanal_new");
                  $this->db->where("id", $kanal_id);
				
//FUNGSI LAMA
                  // $this->db->select("id, name");
                  // $this->db->from("tbl_rubrik");
                  // $this->db->where("kanal_id", $kanal_id);
                  // $this->db->where("active_status", "Y");

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

      public function insert($name) {
            try {
                  $data = array(
                      "name" => $name,
                      "create_user" => $this->session->userdata("username"),
                  );

                  $query = $this->db->insert("tbl_kanal_new", $data);

                  if (!$query)
                        throw new Exception();

                  return $this->db->insert_id();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function insertRubrik($name, $kanal_id) {
            try {
                  $data = array(
                      "name" => $name,
                      "kanal_id" => $kanal_id,
                      "create_user" => $this->session->userdata("username"),
                  );

                  $query = $this->db->insert("tbl_rubrik", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function update($id, $name) {
            try {
                  $data = array(
                      "name" => $name,
                      "update_user" => $this->session->userdata("username"),
                  );

                  $this->db->where("id", $id);
                  $query = $this->db->update("tbl_kanal_new", $data);

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
                  $query = $this->db->update("tbl_kanal_new", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function deleteRubrik($kanal_id) {
            try {
                  $this->db->where("kanal_id", $kanal_id);
                  $query = $this->db->delete("tbl_rubrik");

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }
	  
      public function getRubrikName($rubrik_id) {
            try {
                  $this->db->select("name");
                  $this->db->from("tbl_rubrik");
                  $this->db->where("id in (".$rubrik_id.")");
				
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

}