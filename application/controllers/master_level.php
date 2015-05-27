<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Master_Level extends CI_Controller {
      /* Controller ini untuk menampilkan halaman master agency
       * Lokasi: ./application/controllers/Master_Agency.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Level_Model", "Transaction_Model"));
            $this->_access = get_access("LEVEL");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      private function _getMenu($menu) {
            $result = "";
            $arrMenu = array("CALENDAR", "CLIENT", "AGENCY", "LEVEL", "DEPARTMENT", "USER", "IKLAN", "KANAL", "POSISI", "PRODUKGRUP", "CATEGORYINDUSTRY", "INDUSTRY", "CONFLICTBRAND", "MASTERBRANDCOMM", "CPM", "PAKET", "SPACE", "ORDER_RECEIVE", "APPROVE", "BRANDCOMM", "TIMELINE", "REQUEST", "RECEIVE", "REPORT_OCCUPANCY", "REPORT_ORDER", "REPORT_CLOSING", "REPORT_EXPIRED", "REPORT_UNAPPROVE", "OFFER_POSITION", "BACKDATE_REQUEST", "BACKDATE_RECEIVE", "PO", "INVOICE", "PRODUCTION", "HARGA", "APPROVE_MANAGER", "UNIT");

            if (in_array(strtoupper($menu), $arrMenu))
                  $result = strtoupper($menu);

            return $result;
      }

      private function _getColumn($code) {
            $result = "";

            switch (strtoupper($code)) {
                  case "C":
                        $result = "create";
                        break;
                  case "R":
                        $result = "read";
                        break;
                  case "U":
                        $result = "update";
                        break;
                  case "D":
                        $result = "delete";
                        break;
                  case "P":
                        $result = "progress";
                        break;
            }

            return $result;
      }

      public function index() {
            $data["page"] = "master/level/index";
            $data["menu"] = "master";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $id = $this->input->post("id");

            $allData = $this->Level_Model->get($id);

            $allAccess = $this->Level_Model->getAccess($id);

            $arrAccess = array();
            foreach ($allAccess as $access) {
                  if ($access->create == "Y")
                        $arrAccess[$access->menu . "|C"] = "Y";
                  if ($access->read == "Y")
                        $arrAccess[$access->menu . "|R"] = "Y";
                  if ($access->update == "Y")
                        $arrAccess[$access->menu . "|U"] = "Y";
                  if ($access->delete == "Y")
                        $arrAccess[$access->menu . "|D"] = "Y";
                  if ($access->progress == "Y")
                        $arrAccess[$access->menu . "|P"] = "Y";
            }

            $data["all_data"] = $allData;
            $data["all_access"] = $arrAccess;
            $data["read"] = $this->_access["read"];

            $this->load->view("master/level/show", $data);
      }

      public function insert_page() {
            $data["create"] = $this->_access["create"];

            $this->load->view("master/level/insert", $data);
      }

      public function update_page() {
            $id = $this->input->post("id");

            $allData = $this->Level_Model->get($id);
            $allAccess = $this->Level_Model->getAccess($id);

            $arrAccess = array();
            foreach ($allAccess as $access) {
                  if ($access->create == "Y")
                        $arrAccess[$access->menu . "|C"] = "Y";
                  if ($access->read == "Y")
                        $arrAccess[$access->menu . "|R"] = "Y";
                  if ($access->update == "Y")
                        $arrAccess[$access->menu . "|U"] = "Y";
                  if ($access->delete == "Y")
                        $arrAccess[$access->menu . "|D"] = "Y";
                  if ($access->progress == "Y")
                        $arrAccess[$access->menu . "|P"] = "Y";
            }

            $data["all_data"] = $allData;
            $data["all_access"] = $arrAccess;
            $data["update"] = $this->_access["update"];

            $this->load->view("master/level/update", $data);
      }

      public function content() {
            $page = $this->input->post("page", 1);

            if ($page < 1)
                  $page = 1;
            else
                  $page -= 1;

            $startLimit = $page * $this->config->item("show_per_page");
            $endLimit = $this->config->item("show_per_page");

            $allData = $this->Level_Model->getAll($startLimit, $endLimit);

            // untuk mendapatkan total page
            $total = $this->Level_Model->getTotal();
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("master/level/content", $data);
      }

      public function insert() {
            if ($this->_access["create"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $name = $arrParam[0];
            $misc_info = $arrParam[1];
            $access_data = $arrParam[2];
            $allAccess = $arrParam[3];

            if (empty($name) or empty($allAccess)) {
                  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($name))
                        array_push($data["error"], "txtName");
                  if (empty($allAccess))
                        array_push($data["error"], "txtAccess");
            } else {
                  $this->Transaction_Model->transaction_start();
                  $insert = $this->Level_Model->insert($name, $misc_info, $access_data);

                  $level_id = $insert;
                  foreach ($allAccess as $access) {
                        $arrAccess = explode("|", $access);
                        $menu = $this->_getMenu($arrAccess[0]);
                        $column = $this->_getColumn($arrAccess[1]);

                        if (!empty($menu) and !empty($column))
                              $insert = $this->Level_Model->insertUpdateAccess($level_id, $menu, $column, "Y");
                  }
                  $this->Transaction_Model->transaction_complete();

                  $data["status"] = $insert;
            }

            echo json_encode($data);
            die;
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $id = $arrParam[0];
            $name = $arrParam[1];
            $misc_info = $arrParam[2];
            $access_data = $arrParam[3];
            $allAccess = $arrParam[4];

            if (empty($name) or empty($allAccess)) {
                  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($name))
                        array_push($data["error"], "txtName");
                  if (empty($allAccess))
                        array_push($data["error"], "txtAccess");
            } else {
                  $this->Transaction_Model->transaction_start();
                  $update = $this->Level_Model->update($id, $name, $misc_info, $access_data);

                  // delete aksesnya terlebih dahulu
                  $update = $this->Level_Model->deleteAccess($id);

                  // isi kembali tabel aksesnya
                  $level_id = $id;
                  foreach ($allAccess as $access) {
                        $arrAccess = explode("|", $access);
                        $menu = $this->_getMenu($arrAccess[0]);
                        $column = $this->_getColumn($arrAccess[1]);

                        if (!empty($menu) and !empty($column))
                              $update = $this->Level_Model->insertUpdateAccess($level_id, $menu, $column, "Y");
                  }
                  $this->Transaction_Model->transaction_complete();

                  $data["status"] = $update;
            }

            echo json_encode($data);
            die;
      }

      public function delete() {
            if ($this->_access["delete"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $id = $arrParam[0];

            $delete = $this->Level_Model->delete($id);

            $data["status"] = true;

            echo json_encode($data);
            die;
      }

}