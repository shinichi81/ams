<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Master_Cpm extends CI_Controller {
      /* Controller ini untuk menampilkan halaman master brandcomm
       * Lokasi: ./application/controllers/Master_Cpm.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model("Cpm_Model");
            $this->_access = get_access("CPM");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "master/cpm/index";
            $data["menu"] = "master";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $id = $this->input->post("id");

            $allData = $this->Cpm_Model->get($id);

            $data["all_data"] = $allData;
            $data["read"] = $this->_access["read"];

            $this->load->view("master/cpm/show", $data);
      }

      public function insert_page() {
            $this->load->view("master/cpm/insert");
      }

      public function update_page() {
            $id = $this->input->post("id");

            $allData = $this->Cpm_Model->get($id);

            $data["all_data"] = $allData;
            $data["update"] = $this->_access["update"];

            $this->load->view("master/cpm/update", $data);
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

            $allData = $this->Cpm_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Cpm_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("master/cpm/content", $data);
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $id = $arrParam[0];
            $cpm_quota = str_replace(".", "", $arrParam[1]);

            if (empty($cpm_quota)) {
                  $data["status"] = false;
                  $data["error"] = true;
            } else {
                  $update = $this->Cpm_Model->update($id, $cpm_quota);

                  $data["status"] = $update;
            }

            echo json_encode($data);
            die;
      }

}