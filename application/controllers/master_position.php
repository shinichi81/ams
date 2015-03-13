<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Master_Position extends CI_Controller {
      /* Controller ini untuk menampilkan halaman master position
       * Lokasi: ./application/controllers/Master_Position.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model("Position_Model");
            $this->_access = get_access("POSISI");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "master/position/index";
            $data["menu"] = "master";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $id = $this->input->post("id");

            $allData = $this->Position_Model->get($id);

            $data["all_data"] = $allData;
            $data["read"] = $this->_access["read"];

            $this->load->view("master/position/show", $data);
      }

      public function insert_page() {
            $data["create"] = $this->_access["create"];

            $this->load->view("master/position/insert", $data);
      }

      public function update_page() {
            $id = $this->input->post("id");

            $allData = $this->Position_Model->get($id);

            $data["all_data"] = $allData;
            $data["update"] = $this->_access["update"];

            $this->load->view("master/position/update", $data);
      }

      public function content() {
            $page = $this->input->post("page", 1);
            $orderBy = $this->input->post("orderby", "ALL");

            if ($page < 1)
                  $page = 1;
            else
                  $page -= 1;

            $startLimit = $page * $this->config->item("show_per_page");
            $endLimit = $this->config->item("show_per_page");

            $allData = $this->Position_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Position_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("master/position/content", $data);
      }

      public function insert() {
            if ($this->_access["create"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $name = $arrParam[0];
            $misc_info = $arrParam[1];
//            $allow_override = $arrParam[2];
//            $cpm_quota = ($allow_override == "Y") ? str_replace(".", "", $arrParam[3]) : 0;

            if (empty($name)) {
                  $data["status"] = false;
                  $data["error"] = true;
            } else {
                  $insert = $this->Position_Model->insert($name, $misc_info/*, $allow_override, $cpm_quota*/);

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
//            $allow_override = $arrParam[3];
//            $cpm_quota = ($allow_override == "Y") ? str_replace(".", "", $arrParam[4]) : 0;

            if (empty($name)) {
                  $data["status"] = false;
                  $data["error"] = true;
            } else {
                  $update = $this->Position_Model->update($id, $name, $misc_info/*, $allow_override, $cpm_quota*/);

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

            $delete = $this->Position_Model->delete($id);

            $data["status"] = $delete;

            echo json_encode($data);
            die;
      }

}