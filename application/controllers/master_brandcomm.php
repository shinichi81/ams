<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Master_Brandcomm extends CI_Controller {
      /* Controller ini untuk menampilkan halaman master brandcomm
       * Lokasi: ./application/controllers/Master_Brandcomm.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model("Itembrandcomm_Model");
            $this->_access = get_access("MASTERBRANDCOMM");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "master/brandcomm/index";
            $data["menu"] = "master";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $id = $this->input->post("id");

            $allData = $this->Itembrandcomm_Model->get($id);

            $data["all_data"] = $allData;
            $data["read"] = $this->_access["read"];

            $this->load->view("master/brandcomm/show", $data);
      }

      public function insert_page() {
            $arrUsedOrderNumber = array();

            $allItemBrandcomm = $this->Itembrandcomm_Model->getAll();

            foreach ($allItemBrandcomm as $itemBrandcomm)
                  $arrUsedOrderNumber[] = $itemBrandcomm->order_number;

            $data["arr_used_order_number"] = $arrUsedOrderNumber;
            $data["create"] = $this->_access["create"];

            $this->load->view("master/brandcomm/insert", $data);
      }

      public function update_page() {
            $id = $this->input->post("id");
            $arrUsedOrderNumber = array();

            $allData = $this->Itembrandcomm_Model->get($id);
            $allItemBrandcomm = $this->Itembrandcomm_Model->getAll();

            foreach ($allItemBrandcomm as $itemBrandcomm)
                  $arrUsedOrderNumber[] = $itemBrandcomm->order_number;

            $data["all_data"] = $allData;
            $data["arr_used_order_number"] = $arrUsedOrderNumber;
            $data["update"] = $this->_access["update"];

            $this->load->view("master/brandcomm/update", $data);
      }

      public function content() {
            $page = $this->input->post("page", 1);

            if ($page < 1)
                  $page = 1;
            else
                  $page -= 1;

            $startLimit = $page * $this->config->item("show_per_page");
            $endLimit = $this->config->item("show_per_page");

            $allData = $this->Itembrandcomm_Model->getAll($startLimit, $endLimit);

            // untuk mendapatkan total page
            $total = $this->Itembrandcomm_Model->getTotal();
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("master/brandcomm/content", $data);
      }

      public function insert() {
            if ($this->_access["create"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $item = $arrParam[0];
            $orderNumber = ($arrParam[1] <> "null") ? $arrParam[1] : "";
            
            if (empty($item) or empty($orderNumber)) {
                  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($item))
                        array_push($data["error"], "txtItem");
                  if (empty($orderNumber))
                        array_push($data["error"], "selectNumberOrder");
            } else {
                  $insert = $this->Itembrandcomm_Model->insert($item, $orderNumber);

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
            $item = $arrParam[1];
            $orderNumber = ($arrParam[2] <> "null") ? $arrParam[2] : "";
            
            if (empty($item) or empty($orderNumber)) {
                  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($item))
                        array_push($data["error"], "txtItem");
                  if (empty($orderNumber))
                        array_push($data["error"], "selectNumberOrder");
            } else {
                  $update = $this->Itembrandcomm_Model->update($id, $item, $orderNumber);

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

            $delete = $this->Itembrandcomm_Model->delete($id);

            $data["status"] = $delete;

            echo json_encode($data);
            die;
      }

}