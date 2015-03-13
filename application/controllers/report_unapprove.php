<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Report_Unapprove extends CI_Controller {
      /* Controller ini untuk menampilkan halaman order
       * Lokasi: ./application/controllers/Report_Unapprove.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Order_Model", "Report_Model"));
            $this->_access = get_access("REPORT_UNAPPROVE");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "report/unapprove/index";
            $data["menu"] = "report";

            $this->load->view("template", $data);
      }

      public function content() {
            $page = $this->input->post("page", 1);
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

            $allData = $this->Report_Model->getAllUnapprove($startLimit, $endLimit, $startDate, $endDate);

            // untuk mendapatkan total page
            $total = $this->Report_Model->getTotalUnapprove($startDate, $endDate);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
//            $data["yearmonth"] = $yearMonth;
            $data["start_date"] = $startDate;
            $data["end_date"] = $endDate;

            $this->load->view("report/unapprove/content", $data);
      }

      public function excel($startDate, $endDate) {
            $arrData = array();

            $allData = $this->Report_Model->getAllUnapprove(null, null, $startDate, $endDate);

            foreach ($allData as $key => $value) {
                  //$marketing = $this->Report_Model->getName($value->marketing_id);

                  $arrData[$key]["nopaket"] = $value->no_paket;
                  $arrData[$key]["nopaketuser"] = $value->no_paket_user;
                  $arrData[$key]["agency"] = $value->agency;
                  $arrData[$key]["client"] = $value->client;
                  $arrData[$key]["requestdate"] = $value->request_date;
                  //$arrData[$key]["marketing"] = (isset($marketing->name)) ? $marketing->name : "";
                  $arrData[$key]["marketing"] = $value->marketing;

                  $allDetail = $this->Order_Model->getDetail($value->no_paket);
                  foreach ($allDetail as $keyb => $detail) {
                        $ads = $this->Order_Model->getAds($detail->ads_id);
                        $kanal = $this->Order_Model->getKanal($detail->kanal_id);
                        $productGroup = $this->Order_Model->getProductGroup($detail->product_group_id);
                        $position = $this->Order_Model->getPosition($detail->position_id);
                        $periode = format_date($detail->start_date, TRUE) . " - " . format_date($detail->end_date, TRUE);

                        $arrData[$key]["detail"][$keyb]["iklan"] = $ads->name;
                        $arrData[$key]["detail"][$keyb]["kanal"] = $kanal->name;
                        $arrData[$key]["detail"][$keyb]["productgroup"] = $productGroup->name;
                        $arrData[$key]["detail"][$keyb]["position"] = $position->name;
                        $arrData[$key]["detail"][$keyb]["periode"] = $periode;
                  }
            }

            $data["all_data"] = $arrData;
//            $data["yearmonth"] = $yearMonth;
            $data["start_date"] = $startDate;
            $data["end_date"] = $endDate;

            $this->load->view("report/unapprove/excel", $data);
      }

}