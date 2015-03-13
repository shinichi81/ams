<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Report_Occupancy extends CI_Controller {
      /* Controller ini untuk menampilkan halaman master ads
       * Lokasi: ./application/controllers/report_occupancy.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model("Report_Model");
            $this->_access = get_access("REPORT_OCCUPANCY");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "report/occupancy/index";
            $data["menu"] = "report";

            $this->load->view("template", $data);
      }

      public function content() {
            $orderBy = $this->input->post("orderby");
            $month = $this->input->post("month");
            $year = $this->input->post("year");

            $monthYear = $month . "-" . $year;

            if ($orderBy == "per_posisi") { // untuk occupancy per posisi
                  $page = "report/occupancy/per_posisi";
                  $allOccupancy = $this->_getOccupancyPosition($monthYear);
            } else if ($orderBy == "per_kanal") { // untuk occupancy per kanal
                  $page = "report/occupancy/per_kanal";
                  $allOccupancy = $this->_getOccupancyKanal($monthYear);
            } else if ($orderBy == "per_produk_grup") { // untuk occupancy per produk grup
                  $page = "report/occupancy/per_product_group";
                  $allOccupancy = $this->_getOccupancyProductGroup($monthYear);
            } else if ($orderBy == "per_industri") { // untuk occupancy per produk grup
                  $page = "report/occupancy/per_industri";
                  $allOccupancy = $this->_getOccupancyIndustry($monthYear);
            } else if ($orderBy == "per_agency") { // untuk occupancy per produk grup
                  $page = "report/occupancy/per_agency";
                  $allOccupancy = $this->_getOccupancyAgency($monthYear);
            } else if ($orderBy == "per_client") { // untuk occupancy per produk grup
                  $page = "report/occupancy/per_client";
                  $allOccupancy = $this->_getOccupancyClient($monthYear);
            }

            $data["all_occupancy"] = $allOccupancy;
            $data["monthyear"] = $monthYear;

            $this->load->view($page, $data);
      }

      public function excel($type, $monthYear) {
            if ($type == "per_posisi") { // untuk occupancy per posisi
                  $page = "report/occupancy/excel_per_posisi";
                  $allOccupancy = $this->_getOccupancyPosition($monthYear);
            } else if ($type == "per_kanal") { // untuk occupancy per kanal
                  $page = "report/occupancy/excel_per_kanal";
                  $allOccupancy = $this->_getOccupancyKanal($monthYear);
            } else if ($type == "per_produk_grup") { // untuk occupancy per produk grup
                  $page = "report/occupancy/excel_per_product_group";
                  $allOccupancy = $this->_getOccupancyProductGroup($monthYear);
            } else if ($type == "per_industri") { // untuk occupancy per produk grup
                  $page = "report/occupancy/excel_per_industry";
                  $allOccupancy = $this->_getOccupancyIndustry($monthYear);
            } else if ($type == "per_agency") { // untuk occupancy per produk grup
                  $page = "report/occupancy/excel_per_agency";
                  $allOccupancy = $this->_getOccupancyAgency($monthYear);
            } else if ($type == "per_client") { // untuk occupancy per produk grup
                  $page = "report/occupancy/excel_per_client";
                  $allOccupancy = $this->_getOccupancyClient($monthYear);
            }

            $explode = explode("-", $monthYear);
            $month = (strlen($explode[0]) == 1) ? "0" . $explode[0] : $explode[0];
            $year = $explode[1];

            $data["all_occupancy"] = $allOccupancy;
            $data["yearmonth"] = $year . "-" . $month;

            $this->load->view($page, $data);
      }

      private function _getOccupancyPosition($monthYear) {
            $explode = explode("-", $monthYear);
            $month = $explode[0];
            $year = $explode[1];

            $arrData = array();
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            //$monthYear = date("n-Y");

            $allProductGroup = $this->Report_Model->getAllProductGroup();
            foreach ($allProductGroup as $productGroup) {
                  $totDayPosition = 0;
                  $totDay = 0;

                  $arrPosition = explode(",", $productGroup->position_id);
                  $totDayPosition = count($arrPosition) * $daysInMonth; // untuk menghitung total hari sesuai dengan banyaknya posisi pada suatu product group
                  foreach ($arrPosition as $position_id) {
                        $totDay = array();

                        // mendapatkan tanggal-tanggal closing
                        $allClosing = $this->Report_Model->getClosing($productGroup->kanal_id, $productGroup->id, $position_id, $monthYear);
                        foreach ($allClosing as $closing) {
                              $start = (int) $closing->start_date;
                              $end = (int) $closing->end_date;

                              if (($monthYear <> $closing->start_month) and ($monthYear <> $closing->end_month)) {
                                    $start = 1;
                                    $end = $daysInMonth;
                              } else {
                                    //if ($end < $start or $end > $daysInMonth) {
                                    if ($closing->start_month <> $closing->end_month) {
                                          if ($monthYear == $closing->start_month)
                                                $end = $daysInMonth;
                                          else if ($monthYear == $closing->end_month)
                                                $start = 1;
                                    }
                              }

                              for ($n = $start; $n <= $end; $n++)
                                    array_push($totDay, $n);
                        }
                        // $totDay = count(array_unique($totDay));
                        $totDay = count($totDay);

                        /* foreach ($allData as $data) {
                          $start_date = new DateTime($data->start_date);
                          $end_date = new DateTime($data->end_date);
                          $interval = $start_date->diff($end_date);

                          // hitung total hari
                          $totDay += ($interval->d + 1);
                          } */

                        $kanal = $this->Report_Model->getKanal($productGroup->kanal_id);
                        $kanal_name = $kanal->name;

                        $position = $this->Report_Model->getPosition($position_id);
                        $position_name = (count($position) > 0) ? $position->name : "";

                        // hitung total hari dalam persen
                        $occupancy = round(($totDay / $totDayPosition) * 100);
                        //$occupancy = number_format($occupancy, 2);
                        // simpan data ke array
                        $data = array(
                            "kanal" => $kanal_name,
                            "product_group" => $productGroup->name,
                            "position" => $position_name,
                            "occupancy" => $occupancy,
                            "total_day" => $totDay,
                        );

                        array_push($arrData, $data);
                  }
            }

            // sort array terlebih dahulu
            $kanal = array();
            $product_group = array();
            $position = array();
            $occupancy = array();
            $total_day = array();
            foreach ($arrData as $key => $row) {
                  $kanal[$key] = $row["kanal"];
                  $product_group[$key] = $row["product_group"];
                  $position[$key] = $row["position"];
                  $occupancy[$key] = $row["occupancy"];
                  $total_day[$key] = $row["total_day"];
            }
            array_multisort($occupancy, SORT_NUMERIC, SORT_DESC, $arrData);

            return $arrData;
      }

      private function _getOccupancyKanal($monthYear) {
            $explode = explode("-", $monthYear);
            $month = $explode[0];
            $year = $explode[1];

            $arrData = array();
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            //$monthYear = date("n-Y");

            $allKanal = $this->Report_Model->getAllKanal();
            foreach ($allKanal as $kanal) {
                  $totDay = array();
                  $totDayPosition = 0;

                  $allPosition = $this->Report_Model->getProductGroupByKanal($kanal->id);
                  foreach ($allPosition as $position) {
                        $arrPosition = explode(",", $position->position_id);
                        $totDayPosition += count($arrPosition) * $daysInMonth; // untuk menghitung total hari sesuai dengan banyaknya posisi pada suatu product group
                  }
                  $totDayPosition = ($totDayPosition == 0) ? 1 : $totDayPosition;

                  // mendapatkan tanggal-tanggal closing
                  $allClosing = $this->Report_Model->getClosing($kanal->id, null, null, $monthYear);
                  foreach ($allClosing as $closing) {
                        $start = (int) $closing->start_date;
                        $end = (int) $closing->end_date;

                        if (($monthYear <> $closing->start_month) and ($monthYear <> $closing->end_month)) {
                              $start = 1;
                              $end = $daysInMonth;
                        } else {
                              //if ($end < $start or $end > $daysInMonth) {
                              if ($closing->start_month <> $closing->end_month) {
                                    if ($monthYear == $closing->start_month)
                                          $end = $daysInMonth;
                                    else if ($monthYear == $closing->end_month)
                                          $start = 1;
                              }
                        }

                        for ($n = $start; $n <= $end; $n++)
                              array_push($totDay, $n);
                  }
                  // $totDay = count(array_unique($totDay));
                  $totDay = count($totDay);

                  /* foreach ($allData as $data) {
                    $start_date = new DateTime($data->start_date);
                    $end_date = new DateTime($data->end_date);
                    $interval = $start_date->diff($end_date);

                    // hitung total hari
                    $totDay += ($interval->d + 1);
                    } */

                  // hitung total hari dalam persen
                  $occupancy = round(($totDay / $totDayPosition) * 100);
                  //$occupancy = number_format($occupancy, 2);
                  // simpan data ke array
                  $data = array(
                      "kanal" => $kanal->name,
                      "occupancy" => $occupancy,
                      "total_day" => $totDay,
                  );

                  array_push($arrData, $data);
            }

            // sort array terlebih dahulu
            $kanal = array();
            $occupancy = array();
            $total_day = array();
            foreach ($arrData as $key => $row) {
                  $kanal[$key] = $row["kanal"];
                  $occupancy[$key] = $row["occupancy"];
                  $total_day[$key] = $row["total_day"];
            }
            array_multisort($occupancy, SORT_NUMERIC, SORT_DESC, $arrData);

            return $arrData;
      }

      private function _getOccupancyProductGroup($monthYear) {
            $explode = explode("-", $monthYear);
            $month = $explode[0];
            $year = $explode[1];

            $arrData = array();
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            //$monthYear = date("n-Y");

            $allProductGroup = $this->Report_Model->getAllProductGroup();
            foreach ($allProductGroup as $productGroup) {
                  $totDayPosition = 0;
                  $totDay = 0;

                  $arrPosition = explode(",", $productGroup->position_id);
                  $totDayPosition = count($arrPosition) * $daysInMonth; // untuk menghitung total hari sesuai dengan banyaknya posisi pada suatu product group
                  foreach ($arrPosition as $position_id) {
                        $arrDay = array();

                        // mendapatkan tanggal-tanggal closing
                        $allClosing = $this->Report_Model->getClosing($productGroup->kanal_id, $productGroup->id, $position_id, $monthYear);
                        foreach ($allClosing as $closing) {
                              $start = (int) $closing->start_date;
                              $end = (int) $closing->end_date;

                              if (($monthYear <> $closing->start_month) and ($monthYear <> $closing->end_month)) {
                                    $start = 1;
                                    $end = $daysInMonth;
                              } else {
                                    //if ($end < $start or $end > $daysInMonth) {
                                    if ($closing->start_month <> $closing->end_month) {
                                          if ($monthYear == $closing->start_month)
                                                $end = $daysInMonth;
                                          else if ($monthYear == $closing->end_month)
                                                $start = 1;
                                    }
                              }

                              for ($n = $start; $n <= $end; $n++)
                                    array_push($arrDay, $n);
                        }
                        // $totDay = count(array_unique($arrDay));
                        $totDay += count($arrDay);
                  }

                  $kanal = $this->Report_Model->getKanal($productGroup->kanal_id);
                  $kanal_name = $kanal->name;

                  // hitung total hari dalam persen
                  $occupancy = round(($totDay / $totDayPosition) * 100);
                  //$occupancy = number_format($occupancy, 2);
                  // simpan data ke array
                  $data = array(
                      "kanal" => $kanal_name,
                      "product_group" => $productGroup->name,
                      "occupancy" => $occupancy,
                      "total_day" => $totDay,
                  );

                  array_push($arrData, $data);
            }

            // sort array terlebih dahulu
            $kanal = array();
            $product_group = array();
            $occupancy = array();
            $total_day = array();
            foreach ($arrData as $key => $row) {
                  $kanal[$key] = $row["kanal"];
                  $product_group[$key] = $row["product_group"];
                  $occupancy[$key] = $row["occupancy"];
                  $total_day[$key] = $row["total_day"];
            }
            array_multisort($occupancy, SORT_NUMERIC, SORT_DESC, $arrData);

            return $arrData;
      }

      private function _getOccupancyIndustry($monthYear) {
            $explode = explode("-", $monthYear);
            $month = $explode[0];
            $year = $explode[1];

            $arrData = array();
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            //$monthYear = date("n-Y");

            $allIndustry = $this->Report_Model->getAllIndustry();
            foreach ($allIndustry as $industry) {
                  $totDay = array();

                  // mendapatkan tanggal-tanggal closing
                  $allClosing = $this->Report_Model->getClosingIndustry($industry->id, $monthYear);
                  foreach ($allClosing as $closing) {
                        $start = (int) $closing->start_date;
                        $end = (int) $closing->end_date;

                        if (($monthYear <> $closing->start_month) and ($monthYear <> $closing->end_month)) {
                              $start = 1;
                              $end = $daysInMonth;
                        } else {
                              //if ($end < $start or $end > $daysInMonth) {
                              if ($closing->start_month <> $closing->end_month) {
                                    if ($monthYear == $closing->start_month)
                                          $end = $daysInMonth;
                                    else if ($monthYear == $closing->end_month)
                                          $start = 1;
                              }
                        }

                        for ($n = $start; $n <= $end; $n++)
                              array_push($totDay, $n);
                  }
                  $totDay = count(array_unique($totDay));

                  /* foreach ($allData as $data) {
                    $start_date = new DateTime($data->start_date);
                    $end_date = new DateTime($data->end_date);
                    $interval = $start_date->diff($end_date);

                    // hitung total hari
                    $totDay += ($interval->d + 1);
                    } */

                  // hitung total hari dalam persen
                  $occupancy = round(($totDay / $daysInMonth) * 100);
                  //$occupancy = number_format($occupancy, 2);
                  // simpan data ke array
                  $data = array(
                      "industry" => $industry->name,
                      "occupancy" => $occupancy,
                      "total_day" => $totDay,
                  );

                  array_push($arrData, $data);
            }

            // sort array terlebih dahulu
            $industry = array();
            $occupancy = array();
            $total_day = array();
            foreach ($arrData as $key => $row) {
                  $industry[$key] = $row["industry"];
                  $occupancy[$key] = $row["occupancy"];
                  $total_day[$key] = $row["total_day"];
            }
            array_multisort($occupancy, SORT_NUMERIC, SORT_DESC, $arrData);

            return $arrData;
      }

      private function _getOccupancyAgency($monthYear) {
            $explode = explode("-", $monthYear);
            $month = $explode[0];
            $year = $explode[1];

            $arrData = array();
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            //$monthYear = date("n-Y");

            $allAgency = $this->Report_Model->getAllAgency();
            foreach ($allAgency as $agency) {
                  $totDay = array();

                  // mendapatkan tanggal-tanggal closing
                  $allClosing = $this->Report_Model->getClosingAgency($agency->id, $monthYear);
                  foreach ($allClosing as $closing) {
                        $start = (int) $closing->start_date;
                        $end = (int) $closing->end_date;

                        if (($monthYear <> $closing->start_month) and ($monthYear <> $closing->end_month)) {
                              $start = 1;
                              $end = $daysInMonth;
                        } else {
                              //if ($end < $start or $end > $daysInMonth) {
                              if ($closing->start_month <> $closing->end_month) {
                                    if ($monthYear == $closing->start_month)
                                          $end = $daysInMonth;
                                    else if ($monthYear == $closing->end_month)
                                          $start = 1;
                              }
                        }

                        for ($n = $start; $n <= $end; $n++)
                              array_push($totDay, $n);
                  }
                  $totDay = count(array_unique($totDay));

                  /* foreach ($allData as $data) {
                    $start_date = new DateTime($data->start_date);
                    $end_date = new DateTime($data->end_date);
                    $interval = $start_date->diff($end_date);

                    // hitung total hari
                    $totDay += ($interval->d + 1);
                    } */

                  // hitung total hari dalam persen
                  $occupancy = round(($totDay / $daysInMonth) * 100);
                  //$occupancy = number_format($occupancy, 2);
                  // simpan data ke array
                  $data = array(
                      "agency" => $agency->name,
                      "occupancy" => $occupancy,
                      "total_day" => $totDay,
                  );

                  array_push($arrData, $data);
            }

            // sort array terlebih dahulu
            $agency = array();
            $occupancy = array();
            $total_day = array();
            foreach ($arrData as $key => $row) {
                  $agency[$key] = $row["agency"];
                  $occupancy[$key] = $row["occupancy"];
                  $total_day[$key] = $row["total_day"];
            }
            array_multisort($occupancy, SORT_NUMERIC, SORT_DESC, $arrData);

            return $arrData;
      }

      private function _getOccupancyClient($monthYear) {
            $explode = explode("-", $monthYear);
            $month = $explode[0];
            $year = $explode[1];

            $arrData = array();
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            //$monthYear = date("n-Y");

            $allClient = $this->Report_Model->getAllClient();
            foreach ($allClient as $client) {
                  $totDay = array();

                  // mendapatkan tanggal-tanggal closing
                  $allClosing = $this->Report_Model->getClosingClient($client->id, $monthYear);
                  foreach ($allClosing as $closing) {
                        $start = (int) $closing->start_date;
                        $end = (int) $closing->end_date;

                        if (($monthYear <> $closing->start_month) and ($monthYear <> $closing->end_month)) {
                              $start = 1;
                              $end = $daysInMonth;
                        } else {
                              //if ($end < $start or $end > $daysInMonth) {
                              if ($closing->start_month <> $closing->end_month) {
                                    if ($monthYear == $closing->start_month)
                                          $end = $daysInMonth;
                                    else if ($monthYear == $closing->end_month)
                                          $start = 1;
                              }
                        }

                        for ($n = $start; $n <= $end; $n++)
                              array_push($totDay, $n);
                  }
                  $totDay = count(array_unique($totDay));

                  /* foreach ($allData as $data) {
                    $start_date = new DateTime($data->start_date);
                    $end_date = new DateTime($data->end_date);
                    $interval = $start_date->diff($end_date);

                    // hitung total hari
                    $totDay += ($interval->d + 1);
                    } */

                  // hitung total hari dalam persen
                  $occupancy = round(($totDay / $daysInMonth) * 100);
                  //$occupancy = number_format($occupancy, 2);
                  // simpan data ke array
                  $data = array(
                      "client" => $client->name,
                      "occupancy" => $occupancy,
                      "total_day" => $totDay,
                  );

                  array_push($arrData, $data);
            }

            // sort array terlebih dahulu
            $client = array();
            $occupancy = array();
            $total_day = array();
            foreach ($arrData as $key => $row) {
                  $client[$key] = $row["client"];
                  $occupancy[$key] = $row["occupancy"];
                  $total_day[$key] = $row["total_day"];
            }
            array_multisort($occupancy, SORT_NUMERIC, SORT_DESC, $arrData);

            return $arrData;
      }

}