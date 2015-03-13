<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Request extends CI_Controller {
      /* Controller ini untuk menampilkan halaman request
       * Lokasi: ./application/controllers/Request.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Request_Model", "Order_Model", "Transaction_Model"));
            $this->_access = get_access("REQUEST");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "request/index";
            $data["menu"] = "tayang";

            $this->load->view("template", $data);
      }

      private function _generate() {
            $data = $this->Request_Model->getLastNoRequest();

            if (!empty($data)) {
                  $noRequest = $data->no_request;

                  $start = strpos($noRequest, "/") + 1;
                  $end = strrpos($noRequest, "/") + 1;

                  $number = substr($noRequest, $start, $end);
                  $number += 1;

                  if (strlen($number) == 1)
                        $number = "00" . $number;
                  else if (strlen($number) == 2)
                        $number = "0" . $number;

                  $newNoRequest = "R/" . $number . "/" . date("dmY");
            } else {
                  $newNoRequest = "R/001/" . date("dmY");
            }

            return $newNoRequest;
      }
      
      public function show_page() {
            $id = $this->input->post("id");

            $allData = $this->Request_Model->getUpdate($id);
            $allDetail = $this->Request_Model->getShowDetail($allData->id);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Request_Model->getAdsName($detail->ads_id);
                  $kanal = $this->Request_Model->getKanalName($detail->kanal_id);
                  $productgroup = $this->Request_Model->getProductgroupName($detail->product_group_id);
                  $position = $this->Request_Model->getPositionName($detail->position_id);

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

            $this->load->view("request/show", $data);
      }

      public function insert_page() {
            $data["create"] = $this->_access["create"];

            $this->load->view("request/insert", $data);
      }

      public function insert_request_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Order_Model->get($no_paket);
            $allDetail = $this->Request_Model->getDetail($no_paket);
			$nameCatIndustry = $this->Request_Model->getNameCatIndustry($allData->industrycat_id);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Request_Model->getAdsName($detail->ads_id);
                  $kanal = $this->Request_Model->getKanalName($detail->kanal_id);
                  $productgroup = $this->Request_Model->getProductgroupName($detail->product_group_id);
                  $position = $this->Request_Model->getPositionName($detail->position_id);

                  $result[$n]["id"] = $detail->id;
                  $result[$n]["ads_id"] = $detail->ads_id;
                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal_id"] = $detail->kanal_id;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group_id"] = $detail->product_group_id;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position_id"] = $detail->position_id;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["misc_info"] = $detail->misc_info;
                  $result[$n]["request"] = $detail->request;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["no_po"] = $detail->no_po;
                  $result[$n]["no_paket"] = $detail->no_paket;	// remark 4 Juli 2013 @tio

                  $n += 1;
            }

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
            $data["all_detail"] = $result;
            $data["all_data_brandcomm"] = $allDataBrandcomm;
            $data["all_detail_brandcomm"] = $allDetailBrandcomm;
			$data["name_cat_industry"] = $nameCatIndustry->industry_name;
            $data["create"] = $this->_access["create"];

            $this->load->view("request/insert_order", $data);
      }

      /* public function update_page() {
        $id = $this->input->post("id");

        $allData = $this->Request_Model->getUpdate($id);
        $allDetail = $this->Request_Model->getDetail($allData->no_paket);

        $n = 0;
        $result = array();
        foreach ($allDetail as $detail) {
        $ads = $this->Request_Model->getAdsName($detail->ads_id);
        $kanal = $this->Request_Model->getKanalName($detail->kanal_id);
        $productgroup = $this->Request_Model->getProductgroupName($detail->product_group_id);
        $position = $this->Request_Model->getPositionName($detail->position_id);

        $result[$n]["id"] = $detail->id;
        $result[$n]["ads"] = $ads->name;
        $result[$n]["kanal"] = $kanal->name;
        $result[$n]["product_group"] = $productgroup->name;
        $result[$n]["position"] = $position->name;
        $result[$n]["start_date"] = $detail->start_date;
        $result[$n]["end_date"] = $detail->end_date;

        $n += 1;
        }

        $arrDetail = $result;

        $data["all_data"] = $allData;
        $data["all_detail"] = $arrDetail;
        $data["update"] = $this->_access["update"];

        $this->load->view("request/update", $data);
        } */

      public function search_page() {
            $allData = $this->Request_Model->getSearchPaket();

            $data["all_data"] = $allData;
            $data["create"] = $this->_access["create"];

            $this->load->view("request/search", $data);
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

            $allData = $this->Request_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Request_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            //$data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("request/content", $data);
      }

      public function insert() {
            if ($this->_access["create"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $no_paket = $arrParam[0];
            //$brand = $arrParam[1];
            $request_type = $arrParam[1];
            $detail = $arrParam[2];
            $chkRequest = $arrParam[3];
            $allRequest = $arrParam[4];
            // $allId = $arrParam[5];
            $validPaket = true;
//            $arrRequest = array();
            $totalApproveNotRequest = 0;

            // mengecek apakah no paket yang dimasukkan valid
            $paket = $this->Request_Model->get($no_paket);
            $totPaket = count($paket);
            if ($totPaket < 1)
                  $validPaket = false;

            if (empty($no_paket) or $request_type == "undefined" or empty($chkRequest) or !$validPaket) {
                  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($no_paket))
                        array_push($data["error"], "txtNoPaket");
                  /* if (empty($brand))
                    array_push($data["error"], "txtBrand"); */
                  if ($request_type == "undefined")
                        array_push($data["error"], "txtRequestType");
                  if (empty($chkRequest))
                        array_push($data["error"], "txtTotalRequest");
                  if (!$validPaket)
                        array_push($data["error"], "txtValidPaket");
            } else {
                  $no_request = $this->_generate();
                  
                  $this->Transaction_Model->transaction_start();

                  // mendapatkan total paket approve yang belum di request
                  $totalApproveNotRequest = $this->Request_Model->getTotalApproveNotRequest($no_paket);

                  $insert = $this->Request_Model->insert($no_request, $no_paket, $request_type, $detail);

                  // id tabel tbl_request_ads yang terakhir di insert
                  $id_header = $insert;

                  foreach ($chkRequest as $request) {
                        $id = $request["value"];

                        $insert = $this->Request_Model->insertRequestAdsDetail($no_paket, $id, $id_header);
                        $insert = $this->Request_Model->updateRequestStatus($id, "Y", "DETAIL");
                  }

                  // update kolom is_request jika ada yang request tayang
                  $insert = $this->Request_Model->updateIsRequest($no_paket, "Y");

                  // jika semua paket sudah direquest, update value column 'request' jadi 'Y'
//                  if (count($chkRequest) == count($allRequest))
                  if ($totalApproveNotRequest == count($chkRequest))
                        $insert = $this->Request_Model->updateRequestStatus($no_paket, "Y", "HEADER");

                  $this->Transaction_Model->transaction_complete();

                  // set kolom is_request_ads = 'Y' yang dicentang
                  /* foreach ($chkRequest as $request)
                    $update = $this->Request_Model->updateRequestStatus($request["value"]); */

                  $data["status"] = $insert;
            }

            echo json_encode($data);
            die;
      }

      /* public function update() {
        if ($this->_access["update"] <> "Y")
        redirect("dashboard", "refresh");

        $arrParam = $this->input->post("arrParam");
        $id = $arrParam[0];
        $no_paket = $arrParam[1];
        $brand = $arrParam[2];
        $request_type = $arrParam[3];
        $detail = $arrParam[4];
        $allRequest = $arrParam[5];

        if (empty($no_paket) or empty($brand) or empty($request_type) or empty($allRequest)) {
        $data["status"] = false;
        $data["error"] = array();
        if (empty($no_paket))
        array_push($data["error"], "txtNoPaket");
        if (empty($brand))
        array_push($data["error"], "txtBrand");
        if (empty($request_type))
        array_push($data["error"], "txtRequestType");
        if (empty($allRequest))
        array_push($data["error"], "txtTotalRequest");
        } else {
        $update = $this->Request_Model->update($id, $brand, $request_type, $detail);

        // set semua kolom is_request_ads = 'N'
        $update = $this->Request_Model->updateRequestStatusToN($no_paket);

        // set kolom is_request_ads = 'Y' yang dicentang
        foreach ($allRequest as $request)
        $update = $this->Request_Model->updateRequestStatus($request["value"]);

        $data["status"] = true;
        }

        echo json_encode($data);
        die;
        } */

      public function delete() {
            if ($this->_access["delete"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $id = $arrParam[0];

            $this->Transaction_Model->transaction_start();

            $allNoPaketAndIdOrder = $this->Request_Model->getNoPaketAndIdOrder($id);

            foreach ($allNoPaketAndIdOrder as $noPaketAndIdOrder) {
                  $idOrderPaketAds = $noPaketAndIdOrder->id_order_paket_ads;

                  $delete = $this->Request_Model->updateRequestStatus($idOrderPaketAds, "N", "DETAIL");
            }

            $no_paket = $allNoPaketAndIdOrder[0]->no_paket;
            $delete = $this->Request_Model->updateRequestStatus($no_paket, "N", "HEADER");

            $delete = $this->Request_Model->deleteDetail($id);
            $delete = $this->Request_Model->deleteHeader($id);

            // JIKA DI TABEL TBL_REQUEST_ADS TIDAK ADA LAGI NO PAKET YANG SAMA, UPDATE KOLOM IS_REQUEST = 'N' DI TBL_ORDER
            $totalRemaining = $this->Request_Model->getTotalRemaining($no_paket);
            if ($totalRemaining == 0)
                  $update = $this->Request_Model->updateIsRequest($no_paket, "N");

            $this->Transaction_Model->transaction_complete();

            $data["status"] = $delete;

            echo json_encode($data);
            die;
      }

//      public function do_search() {
//            $arrParam = $this->input->post("arrParam");
//            $agency_id = $arrParam[0];
//            $client_id = $arrParam[1];
//
//            $allData = $this->Request_Model->getSearchPaket($agency_id, $client_id);
//
//            $data["all_data"] = $allData;
//
//            $this->load->view("request/search_result", $data);
//      }

      public function get_data() {
            $no_paket = $this->input->get("term");

            $allData = $this->Request_Model->get($no_paket);

            $arrData = array();
            $temp = array();
            foreach ($allData as $data) {
				  $detailIndustryCat = $this->Request_Model->getNameCatIndustry($data->industrycat_id);
			
                  $temp["label"] = $data->no_paket;
                  $temp["value"] = $data->no_paket;
                  $temp["no_paket_user"] = $data->no_paket_user;
                  $temp["agency"] = $data->agency;
                  $temp["client"] = $data->client;
                  $temp["budget"] = $data->budget;
                  $temp["diskon"] = $data->diskon;
                  $temp["benefit"] = $data->benefit;
                  $temp["is_restrict"] = $data->is_restrict;
                  $temp["industrycat_id"] = $data->industrycat_id;
				  $temp["industrycat"] = $detailIndustryCat->industry_name;
                  $temp["industry_id"] = $data->industry_id;
                  $temp["industry"] = $data->industry;
                  $temp["misc_info"] = $data->misc_info;

                  array_push($arrData, $temp);
            }

            echo json_encode($arrData);
            die;
      }

      public function get_data_detail() {
            $no_paket = $this->input->post("id");

            $allData = $this->Order_Model->get($no_paket);
            $allDetail = $this->Request_Model->getDetail($no_paket);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Request_Model->getAdsName($detail->ads_id);
                  $kanal = $this->Request_Model->getKanalName($detail->kanal_id);
                  $productgroup = $this->Request_Model->getProductgroupName($detail->product_group_id);
                  $position = $this->Request_Model->getPositionName($detail->position_id);

                  $result[$n]["id"] = $detail->id;
                  $result[$n]["ads_id"] = $detail->ads_id;
                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal_id"] = $detail->kanal_id;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group_id"] = $detail->product_group_id;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position_id"] = $detail->position_id;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["misc_info"] = $detail->misc_info;
                  $result[$n]["request"] = $detail->request;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["no_po"] = $detail->no_po;
                  $result[$n]["no_paket"] = $detail->no_paket;	// remark 4 April 2013 @tio

                  $n += 1;
            }

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

            $data["result"] = $result;
            $data["all_data_brandcomm"] = $allDataBrandcomm;
            $data["all_detail_brandcomm"] = $allDetailBrandcomm;

            $this->load->view("request/detail", $data);
      }

}