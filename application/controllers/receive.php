<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Receive extends CI_Controller {
      /* Controller ini untuk menampilkan halaman receive
       * Lokasi: ./application/controllers/Receive.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Receive_Model", "User_Model"));
            $this->_access = get_access("RECEIVE");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "receive/index";
            $data["menu"] = "tayang";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $id = $this->input->post("id");

            $allData = $this->Receive_Model->get($id);
            $allDetail = $this->Receive_Model->getDetail($allData->id);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Receive_Model->getAds($detail->ads_id);
                  $kanal = $this->Receive_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->Receive_Model->getProductgroup($detail->product_group_id);
                  $position = $this->Receive_Model->getPosition($detail->position_id);

                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["misc_info"] = $detail->misc_info;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["no_po"] = $detail->no_po;

                  $n += 1;
            }

            $arrDetail = $result;

            /* s: untuk menampilkan data brandcomm jika ada */
            $allDataBrandcomm = array();
            $allDetailBrandcomm = array();
            if (!empty($allData->no_reference)) {
                  $no_reference = $allData->no_reference;
                  $noReferenceType = substr($no_reference, 0, 1);

                  if ($noReferenceType == "B") {
                        $this->load->model("Brandcomm_Model");

                        $no_brandcomm = $no_reference;

                        $allDataBrandcomm = $this->Brandcomm_Model->get($no_brandcomm);
                        $allDetailBrandcomm = $this->Brandcomm_Model->getDetail($no_brandcomm);
                  }
            }
            /* e: untuk menampilkan data brandcomm jika ada */

            $data["all_data"] = $allData;
            $data["all_detail"] = $arrDetail;
            $data["all_data_brandcomm"] = $allDataBrandcomm;
            $data["all_detail_brandcomm"] = $allDetailBrandcomm;
            $data["read"] = $this->_access["read"];

            $this->load->view("receive/show", $data);
      }

      public function insert_page() {
            $this->load->view("receive/insert");
      }

      public function update_page() {
            $id = $this->input->post("id");

            $allData = $this->Receive_Model->get($id);
            $allDetail = $this->Receive_Model->getDetail($allData->id);
			$nameCatIndustry = $this->Receive_Model->getNameCatIndustry($allData->industrycat_id);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Receive_Model->getAds($detail->ads_id);
                  $kanal = $this->Receive_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->Receive_Model->getProductgroup($detail->product_group_id);
                  $position = $this->Receive_Model->getPosition($detail->position_id);

                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["misc_info"] = $detail->misc_info;

                  $n += 1;
            }

            $arrDetail = $result;

            /* s: untuk menampilkan data brandcomm jika ada */
            $allDataBrandcomm = array();
            $allDetailBrandcomm = array();
            if (!empty($allData->no_reference)) {
                  $no_reference = $allData->no_reference;
                  $noReferenceType = substr($no_reference, 0, 1);

                  if ($noReferenceType == "B") {
                        $this->load->model("Brandcomm_Model");

                        $no_brandcomm = $no_reference;

                        $allDataBrandcomm = $this->Brandcomm_Model->get($no_brandcomm);
                        $allDetailBrandcomm = $this->Brandcomm_Model->getDetail($no_brandcomm);
                  }
            }
            /* e: untuk menampilkan data brandcomm jika ada */

            $data["all_data"] = $allData;
            $data["all_detail"] = $arrDetail;
            $data["all_data_brandcomm"] = $allDataBrandcomm;
            $data["all_detail_brandcomm"] = $allDetailBrandcomm;
			$data["name_cat_industry"] = $nameCatIndustry->industry_name;
            $data["update"] = $this->_access["update"];

            $this->load->view("receive/update", $data);
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

            $allData = $this->Receive_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Receive_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("receive/content", $data);
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            date_default_timezone_set("Asia/Jakarta");

            $arrParam = $this->input->post("arrParam");
            $id = $arrParam[0];
            $banner_monitor = ($arrParam[1] == "true") ? "Y" : "N";
            $data_monitor = ($arrParam[2] == "true") ? "Y" : "N";
            $note = $arrParam[3];
            $date_monitor = date("Y-m-d");

            $update = $this->Receive_Model->update($id, $date_monitor, $banner_monitor, $data_monitor, $note);

            $data["status"] = $update;

            echo json_encode($data);
            die;
      }

}