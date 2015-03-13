<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Calendar extends CI_Controller {
      /* Controller ini untuk menampilkan halaman calendar
       * Lokasi: ./application/controllers/Calendar.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model("Calendar_Model");
            $this->_access = get_access("CALENDAR");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            if ($this->input->post("btnSubmit")) {
                  $selected_kanal = $this->input->post("selectKanal");
                  $selected_product_group = $this->input->post("selectProductGroup");
                  $selected_month = $this->input->post("selectMonth");
                  $selected_year = $this->input->post("selectYear");

                  $allKanal = $this->Calendar_Model->getAllKanal();
                  $allProductgroup = $this->Calendar_Model->getAllProductgroup($selected_kanal);

                  // untuk mencari posisi dari produk grup yang dipilih
                  $productgroup = $this->Calendar_Model->getProductgroup($selected_product_group);
                  $allPosition = $this->Calendar_Model->getAllPosition($productgroup->position_id);
            } else {
                  $allKanal = $this->Calendar_Model->getAllKanal();
                  $allProductgroup = $this->Calendar_Model->getAllProductgroup($allKanal[0]->id);
                  $allPosition = $this->Calendar_Model->getAllPosition($allProductgroup[0]->position_id);

                  $selected_kanal = $allKanal[0]->id;
                  $selected_product_group = $allProductgroup[0]->id;
                  $selected_month = date("n");
                  $selected_year = date("Y");
            }

            if (strlen($selected_month) == 1)
                  $selected_month = "0" . $selected_month;

            $data["page"] = "calendar/index";
            $data["menu"] = "calendar";
            $data["all_kanal"] = $allKanal;
            $data["selected_kanal"] = $selected_kanal;
            $data["all_product_group"] = $allProductgroup;
            $data["selected_product_group"] = $selected_product_group;
            $data["all_position"] = $allPosition;
            $data["selected_month"] = $selected_month;
            $data["selected_year"] = $selected_year;

            $this->load->view("template", $data);
      }

      public function detail($kanal_id, $product_group_id, $position_id, $month, $year) {
            $monthYear = $year . "-" . $month;

            $allData = $this->Calendar_Model->getAll($kanal_id, $product_group_id, $position_id, $monthYear);
            $selected_kanal = $this->Calendar_Model->getKanal($kanal_id);
            $selected_product_group = $this->Calendar_Model->getProductgroup($product_group_id);
            $selected_position = $this->Calendar_Model->getPosition($position_id);

            $data["all_data"] = $allData;
            $data["selected_kanal"] = $selected_kanal->name;
            $data["selected_product_group"] = $selected_product_group->name;
            $data["selected_position"] = $selected_position->name;

            $this->load->view("calendar/detail", $data);
      }

      public function show_calendar($kanal_id, $product_group_id, $position_id, $month, $year) {
            $arrClosing = array();
            $arrBooking = array();
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $monthYear = $year . "-" . $month;

            // mendapatkan tanggal-tanggal closing
            $allClosing = $this->Calendar_Model->getClosing($kanal_id, $product_group_id, $position_id, $monthYear);
            foreach ($allClosing as $closing) {
                  $start = (int) $closing->start_date;
                  $end = (int) $closing->end_date;

                  if (($monthYear <> $closing->start_month) and ($monthYear <> $closing->end_month)) {
                        $start = 1;
                        $end = $days_in_month;
                  } else {
                        //if ($end < $start or $end > $days_in_month) {
                        if ($closing->start_month <> $closing->end_month) {
                              if ($monthYear == $closing->start_month)
                                    $end = $days_in_month;
                              else if ($monthYear == $closing->end_month)
                                    $start = 1;
                        }
                  }

                  for ($n = $start; $n <= $end; $n++)
                        array_push($arrClosing, $n);
            }

            // mendapatkan tanggal-tanggal booking untuk paket
            $allBookingPaket = $this->Calendar_Model->getBookingPaket($kanal_id, $product_group_id, $position_id, $monthYear);
            foreach ($allBookingPaket as $booking) {
                  $start = (int) $booking->start_date;
                  $end = (int) $booking->end_date;

                  if (($monthYear <> $booking->start_month) and ($monthYear <> $booking->end_month)) {
                        $start = 1;
                        $end = $days_in_month;
                  } else {
                        //if ($end < $start or $end > $days_in_month) {
                        if ($booking->start_month <> $booking->end_month) {
                              if ($monthYear == $booking->start_month)
                                    $end = $days_in_month;
                              else if ($monthYear == $booking->end_month)
                                    $start = 1;
                        }
                  }

                  for ($n = $start; $n <= $end; $n++)
                        array_push($arrBooking, $n);
            }

            // mendapatkan tanggal-tanggal booking untuk space
            $allBookingSpace = $this->Calendar_Model->getBookingSpace($kanal_id, $product_group_id, $position_id, $monthYear);
            foreach ($allBookingSpace as $booking) {
                  $start = (int) $booking->start_date;
                  $end = (int) $booking->end_date;

                  if (($monthYear <> $booking->start_month) and ($monthYear <> $booking->end_month)) {
                        $start = 1;
                        $end = $days_in_month;
                  } else {
                        //if ($end < $start or $end > $days_in_month) {
                        if ($booking->start_month <> $booking->end_month) {
                              if ($monthYear == $booking->start_month)
                                    $end = $days_in_month;
                              else if ($monthYear == $booking->end_month)
                                    $start = 1;
                        }
                  }

                  for ($n = $start; $n <= $end; $n++)
                        array_push($arrBooking, $n);
            }

            // buat array tanggal untuk kalender
            $arrDate = array();
            $row = 0;
            for ($n = 1; $n <= $days_in_month; $n++) {
                  $col = date("w", mktime(0, 0, 0, $month, $n, $year));

                  if ($col == 0 and $n > 1)
                        $row += 1;

                  $arrDate[$row][$col] = $n;
            }

            $data["arr_closing"] = array_unique($arrClosing);
            $data["arr_booking"] = array_unique($arrBooking);
            $data["arr_date"] = $arrDate;
            $data["month"] = (strlen($month) == 1) ? "0" . $month : $month;
            $data["year"] = $year;

            $this->load->view("calendar/show", $data);
      }

      public function get_product_group($kanal_id) {
            $allProductGroup = $this->Calendar_Model->getAllProductgroup($kanal_id);

            $data = "";
            foreach ($allProductGroup as $productGroup)
                  $data .= "<option value='" . $productGroup->id . "'>" . $productGroup->name . "</option>";

            echo $data;
            die;
      }

}