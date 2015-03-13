<?php

class Industry_Cat_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
            try {
                  $this->db->select("a.id, b.name industry, a.industry_name, a.create_date, a.update_date");
                  $this->db->from("tbl_industry_cat a");
                  $this->db->join("tbl_industry b", "a.id = b.id");
                  $this->db->where("a.active_status", "Y");
				  if ($orderBy <> "ALL") {
						$this->db->like("a.industry_name", $orderBy);
                  }
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

      public function get($id) {
            try {
                  $this->db->select("id, industry_name, subindustry_id");
                  $this->db->from("tbl_industry_cat");
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
                  $this->db->from("tbl_industry_cat");
				  if ($orderBy <> "ALL") {
						$this->db->like("industry_name", $orderBy);
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

      public function getAllSubIndustry($id = "''") {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_industry");
                  $this->db->where("active_status", "Y");
                  $this->db->where("id not in (" . $id . ")", NULL);
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

      public function getSelectedSubIndustry($id) {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_industry");
                  $this->db->where("active_status", "Y");
                  $this->db->where("id in (" . $id . ")", NULL);
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

      public function insert($name, $industry_id) {
            try {
                  $data = array(
                      "industry_name" => $name,
                      "subindustry_id" => $industry_id,
                      "create_user" => $this->session->userdata("username"),
                  );

                  $query = $this->db->insert("tbl_industry_cat", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function update($id, $name, $industry_id) {
            try {
                  $data = array(
                      "industry_name" => $name,
                      "subindustry_id" => $industry_id,
                      "update_user" => $this->session->userdata("username"),
                  );

                  $this->db->where("id", $id);
                  $query = $this->db->update("tbl_industry_cat", $data);

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
                  $query = $this->db->update("tbl_industry_cat", $data);

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