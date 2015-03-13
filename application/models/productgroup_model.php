<?php

class Productgroup_Model extends CI_Model {

      public function getAll($startLimit, $endLimit, $orderBy = "ALL") {
            try {
                  $this->db->select("a.id, b.name kanal, a.name, a.misc_info, a.create_date, a.update_date");
                  $this->db->from("tbl_product_group a");
                  $this->db->join("tbl_kanal b", "a.kanal_id = b.id");
                  $this->db->where("a.active_status", "Y");
				  if ($orderBy <> "ALL") {
						$this->db->like("a.name", $orderBy);
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
                  $this->db->select("id, name, misc_info, kanal_id, rubrik_id, position_id");
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
      
      public function getCpm($product_group_id) {
            try {
                  $this->db->select("a.kanal_id, a.product_group_id, a.position_id, a.cpm_quota, b.name position_name");
                  $this->db->from("tbl_cpm a");
                  $this->db->join("tbl_position b", "a.position_id = b.id");
                  $this->db->where("a.product_group_id", $product_group_id);
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

      public function getTotal($orderBy = "ALL") {
            try {
                  $this->db->from("tbl_product_group");
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

      public function getSelectedKanal($id) {
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

      public function getAllRubrik($kanal_id, $id = "''") {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_rubrik");
                  $this->db->where("active_status", "Y");
                  $this->db->where("kanal_id", $kanal_id);
                  $this->db->where("id not in (" . $id . ")", NULL);
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

      public function getSelectedRubrik($id) {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_rubrik");
                  $this->db->where("active_status", "Y");
                  $this->db->where("id in (" . $id . ")", NULL);
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

      public function getAllPosition($id = "''") {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_position");
                  $this->db->where("active_status", "Y");
                  $this->db->where("id not in (" . $id . ")", NULL);
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
	  
      public function getSelectedPosition($id) {
            try {
                  $this->db->select("id, name");
                  $this->db->from("tbl_position");
                  $this->db->where("active_status", "Y");
                  $this->db->where("id in (" . $id . ")", NULL);
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

      public function insert($name, $misc_info, $kanal_id, $rubrik_id, $position_id) {
            try {
                  $data = array(
                      "name" => $name,
                      "misc_info" => $misc_info,
                      "kanal_id" => $kanal_id,
                      "rubrik_id" => $rubrik_id,
                      "position_id" => $position_id,
                      "create_user" => $this->session->userdata("username"),
                  );

                  $query = $this->db->insert("tbl_product_group", $data);

                  if (!$query)
                        throw new Exception();

                  return $this->db->insert_id();
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }
      
      public function insertCpm($kanal_id, $product_group_id, $position_id, $cpm_quota = 0) {
            try {
                  $data = array(
                      "kanal_id" => $kanal_id,
                      "product_group_id" => $product_group_id,
                      "position_id" => $position_id,
                      "cpm_quota" => $cpm_quota,
                      "create_user" => $this->session->userdata("username"),
                  );

                  $query = $this->db->insert("tbl_cpm", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function update($id, $name, $misc_info, $kanal_id, $rubrik_id, $position_id) {
            try {
                  $data = array(
                      "name" => $name,
                      "misc_info" => $misc_info,
                      "kanal_id" => $kanal_id,
                      "rubrik_id" => $rubrik_id,
                      "position_id" => $position_id,
                      "update_user" => $this->session->userdata("username"),
                  );
				  
                  $this->db->where("id", $id);
                  $query = $this->db->update("tbl_product_group", $data);

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
                  $query = $this->db->update("tbl_product_group", $data);

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }
      
      public function deleteCpm($product_group_id) {
            try {
                  $this->db->where("product_group_id", $product_group_id);
                  $query = $this->db->delete("tbl_cpm");

                  if (!$query)
                        throw new Exception();

                  return true;
            } catch (Exception $e) {
                  $errNo = $this->db->_error_number();
                  //$errMsg = $this->db->_error_message();

                  return error_message($errNo);
            }
      }

      public function getAllHarga($id_kanal, $id_rubrik = "''", $id_position = "''") {
      // public function getAllHarga($id_kanal, $id_position = "''") {
            try {
                  $this->db->select("id_position, harga");
                  $this->db->from("tbl_product_group_harga");
                  $this->db->where("id_kanal", $id_kanal);
				  if ($id_kanal == "1") {
					  $this->db->where("id_rubrik", $id_rubrik);
				  }
                  $this->db->where("id_position not in (" . $id_position . ")", NULL);
                  // $this->db->where("id_position in (" . $id_position . ")", NULL);
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
	  
	  public function getPositionHarga($id_kanal, $id_product, $id_position) {
			try {
                  $this->db->select("a.id_position, b.name, a.harga");
                  $this->db->from("tbl_product_group_harga a");
                  $this->db->join("tbl_position b", "a.id_position = b.id");
                  $this->db->where("a.id_kanal", $id_kanal);
                  $this->db->where("a.id_product", $id_product);
                  $this->db->where("a.id_position in (" . $id_position . ")", NULL);
				  $this->db->order_by('a.id_position', 'asc');
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