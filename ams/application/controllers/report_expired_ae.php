<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Report_Expired_Ae extends CI_Controller {
      /* Controller ini untuk menampilkan halaman order
       * Lokasi: ./application/controllers/Report_Expired_Ae.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Report_Model", "Expiredpaket_Model", "Expiredspace_Model", "Order_Model", "Orderspace_Model"));
            $this->_access = get_access("REPORT_EXPIRED");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $allAe = $this->Report_Model->getAllAE();

            $data["all_ae"] = $allAe;
            $data["page"] = "report/expired/index";
            $data["menu"] = "report";

            $this->load->view("template", $data);
      }

      public function content() {
            $type = $this->input->post("type");
            $page = $this->input->post("page", 1);
            $ae = $this->input->post("orderby");
//            $month = $this->input->post("month");
//            $year = $this->input->post("year");
            $startDate = $this->input->post("start_date");
            $endDate = $this->input->post("end_date");

//            $yearMonth = $year . "-" . $month;

            if ($page < 1)
                  $page = 1;
            else
                  $page -= 1;

            $startLimit = $page * $this->config->item("show_per_page");
            $endLimit = $this->config->item("show_per_page");

            if ($type == "paket") {
                  $file = "report/expired/content_paket";

                  $allData = $this->Report_Model->getAllPaketExpired($startLimit, $endLimit, $ae, $startDate, $endDate);
                  foreach ($allData as $key => $result) {
                        $totalPaket = $this->Report_Model->getTotalPaketExpiredRevisi($result->ae_id, $result->no_paket, $startDate, $endDate);
                        $allData[$key]->{"total_paket"} = $totalPaket;
                  }
                  $total = $this->Report_Model->getTotalPaketExpired($ae, $startDate, $endDate);
            } else if ($type == "space") {
                  $file = "report/expired/content_space";

                  $allData = $this->Report_Model->getAllSpaceExpired($startLimit, $endLimit, $ae, $startDate, $endDate);
                  $total = $this->Report_Model->getTotalSpaceExpired($ae, $startDate, $endDate);
            }

            // untuk mendapatkan total page
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["type"] = $type;
            $data["ae"] = $ae;
//            $data["yearmonth"] = $yearMonth;
            $data["start_date"] = $startDate;
            $data["end_date"] = $endDate;

            $this->load->view($file, $data);
      }

      public function excel($type, $ae, $startDate, $endDate) {
            $arrData = array();
            $aeName = "-";

            if ($ae <> "-") {
                  $sales = $this->Report_Model->getName($ae);
                  $aeName = $sales->name;
            }

            if ($type == "paket") {
                  $file = "report/expired/excel_paket";

                  $allData = $this->Report_Model->getAllPaketExpired(null, null, $ae, $startDate, $endDate);

                  foreach ($allData as $key => $value) {
                        //$marketing = $this->Report_Model->getName($value->marketing_id);
                        $totalPaket = $this->Report_Model->getTotalPaketExpiredRevisi($value->ae_id, $value->no_paket, $startDate, $endDate);

                        $arrData[$key]["nopaket"] = $value->no_paket;
                        $arrData[$key]["nopaketuser"] = $value->no_paket_user;
                        $arrData[$key]["agency"] = $value->agency;
                        $arrData[$key]["client"] = $value->client;
                        $arrData[$key]["requestdate"] = $value->request_date;
                        //$arrData[$key]["marketing"] = (isset($marketing->name)) ? $marketing->name : "";
                        $arrData[$key]["marketing"] = $value->marketing;
                        $arrData[$key]["total_paket"] = $totalPaket;

                        $allDetail = $this->Expiredpaket_Model->getDetail($value->no_paket);
                        foreach ($allDetail as $keyb => $detail) {
                              $ads = $this->Order_Model->getAds($detail->ads_id);
                              $kanal = $this->Order_Model->getKanal($detail->kanal_id);
                              $productGroup = $this->Order_Model->getProductGroup($detail->product_group_id);
                              $position = $this->Order_Model->getPosition($detail->position_id);
                              $periode = format_date($detail->start_date, TRUE) . " - " . format_date($detail->end_date, TRUE);

                              $arrData[$key]["detail"][$keyb]["iklan"] = $ads->name;
                              $arrData[$key]["detail"][$keyb]["kanal"] = $kanal->name;
                              $arrData[$key]["detail"][$keyb]["productgroup"] = $productGroup->name;
                              $arrData[$key]["detail"][$keyb]["position"] = (isset($position->name)) ? $position->name : "-";
                              $arrData[$key]["detail"][$keyb]["periode"] = $periode;
                        }
                  }
            } else if ($type == "space") {
                  $file = "report/expired/excel_space";

                  $allData = $this->Report_Model->getAllSpaceExpired(null, null, $ae, $startDate, $endDate);

                  foreach ($allData as $key => $value) {
                        $aeName = $value->sales;

                        $arrData[$key]["nospace"] = $value->no_space;
                        $arrData[$key]["agency"] = $value->agency;
                        $arrData[$key]["client"] = $value->client;
                        $arrData[$key]["sales"] = $value->sales;
                        $arrData[$key]["requestdate"] = $value->request_date;

                        $allDetail = $this->Expiredspace_Model->getDetail($value->no_space);
                        foreach ($allDetail as $keyb => $detail) {
                              $ads = $this->Orderspace_Model->getAds($detail->ads_id);
                              $kanal = $this->Orderspace_Model->getKanal($detail->kanal_id);
                              $productGroup = $this->Orderspace_Model->getProductGroup($detail->product_group_id);
                              $position = $this->Orderspace_Model->getPosition($detail->position_id);
                              $periode = format_date($detail->start_date, TRUE) . " - " . format_date($detail->end_date, TRUE);

                              $arrData[$key]["detail"][$keyb]["iklan"] = $ads->name;
                              $arrData[$key]["detail"][$keyb]["kanal"] = $kanal->name;
                              $arrData[$key]["detail"][$keyb]["productgroup"] = $productGroup->name;
                              $arrData[$key]["detail"][$keyb]["position"] = (isset($position->name)) ? $position->name : "-";
                              $arrData[$key]["detail"][$keyb]["periode"] = $periode;
                        }
                  }
            }

            $data["all_data"] = $arrData;
            $data["ae"] = $aeName;
//            $data["yearmonth"] = $yearMonth;
            $data["start_date"] = $startDate;
            $data["end_date"] = $endDate;

            $this->load->view($file, $data);
      }

}