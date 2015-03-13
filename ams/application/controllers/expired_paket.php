<?php

die;

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Expired_Paket extends CI_Controller {
      /* Controller ini untuk menampilkan halaman expired
       * Lokasi: ./application/controllers/expired.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Order_Model", "Expiredpaket_Model", "Transaction_Model"));
            $this->_access = get_access("PAKET");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "expired_paket/index";
            $data["menu"] = "order";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Expiredpaket_Model->get($no_paket);
            $allDetail = $this->Expiredpaket_Model->getDetail($no_paket);

            $arrAds = array();
            $arrKanal = array();
            $arrProductGroup = array();
            $arrPosition = array();
            $n = 0;
            foreach ($allDetail as $detail) {
                  $arrAds[$n] = $this->Order_Model->getAds($detail->ads_id);
                  $arrKanal[$n] = $this->Order_Model->getKanal($detail->kanal_id);
                  $arrProductGroup[$n] = $this->Order_Model->getProductGroup($detail->product_group_id);
                  $arrPosition[$n] = $this->Order_Model->getPosition($detail->position_id);

                  $n += 1;
            }

            $data["all_data"] = $allData;
            $data["all_detail"] = $allDetail;
            $data["arr_ads"] = $arrAds;
            $data["arr_kanal"] = $arrKanal;
            $data["arr_productgroup"] = $arrProductGroup;
            $data["arr_position"] = $arrPosition;
            $data["read"] = $this->_access["read"];

            $this->load->view("expired_paket/show", $data);
      }

      public function insert_page() {
            $this->load->view("expired_paket/insert");
      }

      public function update_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Expiredpaket_Model->get($no_paket);
            $allDetail = $this->Expiredpaket_Model->getDetail($no_paket);
            $allIndustry = $this->Order_Model->getAllIndustry();
            $allAds = $this->Order_Model->getAllAds();
            $allKanal = $this->Order_Model->getAllKanal();
            $allAgency = $this->Order_Model->getAgency();
            $allClient = $this->Order_Model->getClient();

            // list untuk tambah paket
            $allProductGroup = $this->Order_Model->getAllProductGroup($allKanal[0]->id);
            $allPosition = $this->Order_Model->getAllPosition($allProductGroup[0]->position_id);

            $arrProductGroup = array();
            $arrPosition = array();
            $n = 0;
            foreach ($allDetail as $detail) {
                  // untuk mendapatkan list product group dan disimpan di array
                  $arrProductGroup[$n] = $this->Order_Model->getAllProductGroup($detail->kanal_id);

                  // untuk mendapatkan list position dan disimpan di array
                  $productGroup = $this->Order_Model->getProductGroup($detail->product_group_id);
                  $arrPosition[$n] = $this->Order_Model->getAllPosition($productGroup->position_id);

                  $n += 1;
            }

            $data["all_data"] = $allData;
            $data["all_detail"] = $allDetail;
            $data["all_industry"] = $allIndustry;
            $data["all_ads"] = $allAds;
            $data["all_kanal"] = $allKanal;
            $data["all_productgroup"] = $allProductGroup;
            $data["all_position"] = $allPosition;
            $data["all_agency"] = $allAgency;
            $data["all_client"] = $allClient;
            $data["arr_productgroup"] = $arrProductGroup;
            $data["arr_position"] = $arrPosition;
            $data["update"] = $this->_access["update"];

            $this->load->view("expired_paket/update", $data);
      }

      public function content() {
            $page = $this->input->post("page", 1);
            $noPaket = ($this->input->post("orderby", "ALL") == "ALL") ? "" : $this->input->post("orderby");

            if ($page < 1)
                  $page = 1;
            else
                  $page -= 1;

            $startLimit = $page * $this->config->item("show_per_page");
            $endLimit = $this->config->item("show_per_page");

            $allData = $this->Expiredpaket_Model->getAll($startLimit, $endLimit, $noPaket);

            // untuk mendapatkan total page
            $total = $this->Expiredpaket_Model->getTotal($noPaket);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["no_paket"] = $noPaket;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];

            $this->load->view("expired_paket/content", $data);
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $no_paket = $arrParam[0];
            $agency_id = $arrParam[1];
            $client_id = $arrParam[2];
            $budget = $arrParam[3];
            $diskon = $arrParam[4];
            $benefit = $arrParam[5];
            $selectAds = $arrParam[6];
            $selectKanal = $arrParam[7];
            $selectProductGroup = $arrParam[8];
            $selectPosition = $arrParam[9];
            $txtStartDate = $arrParam[10];
            $txtEndDate = $arrParam[11];
            $isRestrict = $arrParam[12];
            $industry_id = $arrParam[13];
            $miscInfo = $arrParam[14];
            $miscInfoPaket = $arrParam[15];
            $date = true;
            $tempIdInUse = "";
            $tempIdConflict = "";
            $tempIdDateWrong = "";

            // mengecek apakah ada kolom isian yang kosong di paket
            if (!empty($selectAds)) {
                  for ($n = 0; $n < count($selectAds); $n++) {
                        if (empty($txtStartDate[$n]["value"]) or empty($txtEndDate[$n]["value"])) {
                              $date = false;
                              break;
                        }
                  }

                  // mengecek paket yang posisinya sudah digunakan
                  if ($date) {
                        for ($n = 0; $n < count($selectAds); $n++) {
                              $kanal_id = $selectKanal[$n]["value"];
                              $product_group_id = $selectProductGroup[$n]["value"];
                              $position_id = $selectPosition[$n]["value"];
                              $start_date = $txtStartDate[$n]["value"];
                              $end_date = $txtEndDate[$n]["value"];

                              // mengecek jika end_date < dari start_date
                              $start_date_compare = strtotime($start_date);
                              $end_date_compare = strtotime($end_date);

                              if ($end_date_compare < $start_date_compare)
                                    $tempIdDateWrong .= $n . ",";

                              // mengecek apakah posisi yang akan digunakan dapat ditimpa (allow override) atau tidak
                              $position = $this->Order_Model->getPosition($position_id);
                              $allow_override = $position->allow_override;
                              if ($allow_override == "N") {
                                    // mengecek apakah posisi sudah digunakan sebelumnya (dari database)
                                    $positionInUse = $this->Order_Model->getPositionInUse($kanal_id, $product_group_id, $position_id, $start_date, $end_date, $no_paket);
                                    if (count($positionInUse) > 0)
                                          $tempIdInUse .= $n . ",";

                                    // untuk mengecek apakah posisi sudah digunakan sebelumnya (dari inputan baru)
                                    for ($m = 0; $m < $n; $m++) {
                                          $kanal_id_new = $selectKanal[$m]["value"];
                                          $product_group_id_new = $selectProductGroup[$m]["value"];
                                          $position_id_new = $selectPosition[$m]["value"];
                                          $start_date_new = $txtStartDate[$m]["value"];
                                          $end_date_new = $txtEndDate[$m]["value"];

                                          // jika kanal, product_group, dan posisi sama, cek start_date dan end_date nya
                                          if ($kanal_id == $kanal_id_new and $product_group_id == $product_group_id_new and $position_id == $position_id_new) {
                                                $start_date_strtotime = strtotime($start_date);
                                                $end_date_strtotime = strtotime($end_date);
                                                $start_date_new_strtotime = strtotime($start_date_new);
                                                $end_date_new_strtotime = strtotime($end_date_new);

                                                // untuk mengecek apakah tanggal konflik
                                                if (($start_date_strtotime >= $start_date_new_strtotime and $start_date_strtotime <= $end_date_new_strtotime)
                                                        or ($end_date_strtotime >= $start_date_new_strtotime and $end_date_strtotime <= $end_date_new_strtotime))
                                                      $tempIdInUse .= $n . ",";
                                          }
                                    }
                              }
                        }

                        if (!empty($tempIdDateWrong))
                              $tempIdDateWrong = substr($tempIdDateWrong, 0, -1); // untuk menghilangkan "," dibelakang
                        if (!empty($tempIdInUse))
                              $tempIdInUse = substr($tempIdInUse, 0, -1); // untuk menghilangkan "," dibelakang
                  }

                  // mengecek paket conflict
                  if ($isRestrict == "true" and $date) {
                        for ($n = 0; $n < count($selectAds); $n++) {
                              $kanal_id = $selectKanal[$n]["value"];
                              $product_group_id = $selectProductGroup[$n]["value"];
                              $position_id = $selectPosition[$n]["value"];
                              $start_date = $txtStartDate[$n]["value"];
                              $end_date = $txtEndDate[$n]["value"];

                              $allPaketRestrict = $this->Order_Model->getAllPaketRestrict($industry_id, $kanal_id, $product_group_id, $start_date, $end_date, $no_paket);
                              if (count($allPaketRestrict) > 0) {
                                    $rule = $this->Order_Model->getAllRule($industry_id, $kanal_id, $product_group_id);

                                    /* untuk mengambil nama posisi dari rule */
                                    $arrTempRule = array();
                                    $allRule = explode(":", $rule->position_id);
                                    foreach ($allRule as $positions) {
                                          if (stristr($positions, $position_id))
                                                $tempIdConflict .= $n . ",";
                                    }
                              }
                        }

                        if (!empty($tempIdConflict))
                              $tempIdConflict = substr($tempIdConflict, 0, -1); // untuk menghilangkan "," dibelakang
                  }
            } else {
                  $date = false;
            }

            if (empty($no_paket) or empty($agency_id) or empty($client_id) or empty($diskon) or empty($selectAds) or $tempIdConflict <> "" or $tempIdInUse <> "" or $tempIdDateWrong <> "") {
                  $data["status"] = false;
                  $data["error"] = array();
                  $data["error"]["tot_row"] = count($selectAds);
                  if (empty($no_paket))
                        array_push($data["error"], "txtNoPaket");
                  if (empty($agency_id))
                        array_push($data["error"], "txtAgency");
                  if (empty($client_id))
                        array_push($data["error"], "txtClient");
                  if (empty($diskon))
                        array_push($data["error"], "txtDiskon");
                  /* if (!$date)
                    array_push($data["error"], "txtDate"); */
                  if (empty($selectAds))
                        array_push($data["error"], "txtDate");
                  if ($tempIdConflict <> "") {
                        array_push($data["error"], "txtConflict");
                        $data["error"]["idConflict"] = $tempIdConflict;
                  }
                  if ($tempIdInUse <> "") {
                        array_push($data["error"], "txtInUse");
                        $data["error"]["idInUse"] = $tempIdInUse;
                  }
                  if ($tempIdDateWrong <> "") {
                        array_push($data["error"], "txtDateWrong");
                        $data["error"]["idDateWrong"] = $tempIdDateWrong;
                  }
            } else {
                  $this->Transaction_Model->transaction_start();
                  try {
                        $update = $this->Order_Model->updateOrderPaket($no_paket, $agency_id, $client_id, $budget, $diskon, $benefit, $isRestrict, $industry_id, $miscInfo);
                        if ($update !== true)
                              throw new Exception($update);

                        // delete semua paket ads berdasarkan no paketnya
                        $update = $this->Order_Model->deleteOrderPaketAds($no_paket);
                        if ($update !== true)
                              throw new Exception($update);

                        // insert paket ads yang di request
                        for ($n = 0; $n < count($selectAds); $n++) {
                              $ads_id = $selectAds[$n]["value"];
                              $kanal_id = $selectKanal[$n]["value"];
                              $product_group_id = $selectProductGroup[$n]["value"];
                              $position_id = $selectPosition[$n]["value"];
                              $start_date = $txtStartDate[$n]["value"];
                              $end_date = $txtEndDate[$n]["value"];
                              $misc_info_paket = $miscInfoPaket[$n]["value"];

                              $update = $this->Order_Model->insertOrderPaketAds($no_paket, $ads_id, $kanal_id, $product_group_id, $position_id, $start_date, $end_date, $misc_info_paket);
                              if ($update !== true)
                                    throw new Exception($update);
                        }
                  } catch (Exception $e) {
                        $update = $e->getMessage();
                  }
                  $this->Transaction_Model->transaction_complete();

                  $data["status"] = $update;
            }

            echo json_encode($data);
            die;
      }

}