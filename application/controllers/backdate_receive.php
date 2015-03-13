<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Backdate_Receive extends CI_Controller {
      /* Controller ini untuk menampilkan halaman backdate_receive
       * Lokasi: ./application/controllers/Backdate_Receive.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Backdatereceive_Model", "Order_Model", "Transaction_Model"));
            $this->_access = get_access("BACKDATE_RECEIVE");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "backdate_receive/index";
            $data["menu"] = "backdate";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $id = $this->input->post("id");

            $allData = $this->Backdatereceive_Model->get($id);
            $allDetail = $this->Backdatereceive_Model->getDetail($allData->id);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Backdatereceive_Model->getAds($detail->ads_id);
                  $kanal = $this->Backdatereceive_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->Backdatereceive_Model->getProductgroup($detail->product_group_id);
                  $position = $this->Backdatereceive_Model->getPosition($detail->position_id);

                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["misc_info"] = $detail->misc_info;
                  $result[$n]["new_start_date"] = $detail->new_start_date;
                  $result[$n]["new_end_date"] = $detail->new_end_date;
                  $result[$n]["approve"] = $detail->approve;

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

            $this->load->view("backdate_receive/show", $data);
      }

      public function insert_page() {
            $this->load->view("backdate_receive/insert");
      }

      public function update_page() {
            $id = $this->input->post("id");

            $allData = $this->Backdatereceive_Model->get($id);
            $allDetail = $this->Backdatereceive_Model->getDetail($allData->id);
			$nameCatIndustry = $this->Backdatereceive_Model->getNameCatIndustry($allData->industrycat_id);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Backdatereceive_Model->getAds($detail->ads_id);
                  $kanal = $this->Backdatereceive_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->Backdatereceive_Model->getProductgroup($detail->product_group_id);
                  $position = $this->Backdatereceive_Model->getPosition($detail->position_id);

                  $result[$n]["id"] = $detail->id;
                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["new_start_date"] = $detail->new_start_date;
                  $result[$n]["new_end_date"] = $detail->new_end_date;
                  $result[$n]["misc_info"] = $detail->misc_info;
                  $result[$n]["approve"] = $detail->approve;

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

            $this->load->view("backdate_receive/update", $data);
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

            $allData = $this->Backdatereceive_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Backdatereceive_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("backdate_receive/content", $data);
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $id_header = $arrParam[0];
            $no_paket = $arrParam[1];
            $arrPaketAds = $arrParam[2];
            $update = FALSE;
            $totalNotApprove = 0;
            $approve = "N";

            if (!empty($arrPaketAds)) {
                  $paket = $this->Order_Model->get($no_paket);
                  $approve = $paket->approve;
            }

            if (empty($arrPaketAds) or ($approve == "Y")) {
                  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($arrPaketAds))
                        array_push($data["error"], "txtPaketAds");
                  if ($approve == "Y")
                        array_push($data["error"], "txtApprove");
            } else {
                  $this->Transaction_Model->transaction_start();

                  // mendapatkan total yang belum di approve
                  $totalNotApprove = $this->Backdatereceive_Model->getTotalNotApprove($id_header, $no_paket);

                  foreach ($arrPaketAds as $paket) {
                        $idDetail = $paket["value"];

                        if ($backdate = $this->Backdatereceive_Model->getBackdate($idDetail, $no_paket)) {
                              $id_order_paket_ads = $backdate->id_order_paket_ads;
                              $new_start_date = $backdate->new_start_date;
                              $new_end_date = $backdate->new_end_date;

                              // APPROVE POSISI
                              $update = $this->Backdatereceive_Model->updateApproveStatus($idDetail, "Y", "DETAIL");

                              // UPDATE KOLOM BACKDATE = 'N' DI TBL_ORDER_PAKET_ADS
                              $update = $this->Backdatereceive_Model->updateBackdateStatus($id_order_paket_ads, "N", "DETAIL");

                              // UPDATE KOLOM BACKDATE = 'N' DI TBL_ORDER_PAKET
                              $update = $this->Backdatereceive_Model->updateBackdateStatus($no_paket, "N", "HEADER");

                              // UPDATE START_DATE DAN END_DATE DI TBL_ORDER_PAKET_ADS SESUAI DENGAN REQUEST BACKDATE YANG DI APPROVE
                              $update = $this->Backdatereceive_Model->updateDate($id_order_paket_ads, $new_start_date, $new_end_date);
                        }
                  }

                  // jika semua paket sudah di approve, update value column 'approve' jadi 'Y'
                  if ($totalNotApprove == count($arrPaketAds))
                        $update = $this->Backdatereceive_Model->updateApproveStatus($id_header, "Y", "HEADER");

                  $this->Transaction_Model->transaction_complete();

                  $data["status"] = $update;
            }

            echo json_encode($data);
            die;
      }

}