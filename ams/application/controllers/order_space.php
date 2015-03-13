<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Order_Space extends CI_Controller {
      /* Controller ini untuk menampilkan halaman order space
       * Lokasi: ./application/controllers/Order_Space.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Orderspace_Model", "Order_Model", "Transaction_Model"));
            $this->_access = get_access("SPACE");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "order_space/index";
            $data["menu"] = "order";

            $this->load->view("template", $data);
      }

      private function _generate() {
            $data = $this->Orderspace_Model->getLastNoSpace();

            if (!empty($data)) {
                  $noSpace = $data->no_space;

                  $start = strpos($noSpace, "/") + 1;
                  $end = strrpos($noSpace, "/") + 1;

                  $number = substr($noSpace, $start, $end);
                  $number += 1;

                  if (strlen($number) == 1)
                        $number = "00" . $number;
                  else if (strlen($number) == 2)
                        $number = "0" . $number;

                  $newNoSpace = "S/" . $number . "/" . date("dmY");
            } else {
                  $newNoSpace = "S/001/" . date("dmY");
            }

            return $newNoSpace;
            /* echo "<input name='txtNoSpace' id='txtNoSpace' type='text' disabled='disabled' value='".$newNoSpace."' />";
              die; */
      }

      public function show_page() {
            $no_space = $this->input->post("id");

            $allData = $this->Orderspace_Model->get($no_space);
            $allDetail = $this->Orderspace_Model->getDetail($no_space);
			$nameCatIndustry = $this->Orderspace_Model->getNameCatIndustry($allData->industrycat_id);

            $arrAds = array();
            $arrKanal = array();
            $arrProductGroup = array();
            $arrPosition = array();
            $n = 0;
            foreach ($allDetail as $detail) {
                  $arrAds[$n] = $this->Orderspace_Model->getAds($detail->ads_id);
                  $arrKanal[$n] = $this->Orderspace_Model->getKanal($detail->kanal_id);
                  $arrProductGroup[$n] = $this->Orderspace_Model->getProductGroup($detail->product_group_id);
                  $arrPosition[$n] = $this->Orderspace_Model->getPosition($detail->position_id);

                  $n += 1;
            }

            $data["all_data"] = $allData;
            $data["all_detail"] = $allDetail;
            $data["arr_ads"] = $arrAds;
            $data["arr_kanal"] = $arrKanal;
            $data["arr_productgroup"] = $arrProductGroup;
            $data["arr_position"] = $arrPosition;
            $data["read"] = $this->_access["read"];
			$data["name_cat_industry"] = $nameCatIndustry->industry_name;

            $this->load->view("order_space/show", $data);
      }

      public function insert_page() {
			$allIndustryCat = $this->Orderspace_Model->getAllIndustryCat();
            //$allIndustry = $this->Orderspace_Model->getAllIndustry();
			$allDataIndustry = $this->Order_Model->getAllIndustryCatId($allIndustryCat[0]->id);
            $allAds = $this->Orderspace_Model->getAllAds();
            $allKanal = $this->Orderspace_Model->getAllKanal();
            $allProductGroup = $this->Orderspace_Model->getAllProductGroup($allKanal[0]->id);
            $allPosition = $this->Orderspace_Model->getAllPosition($allProductGroup[0]->position_id);
            $allAgency = $this->Orderspace_Model->getAgency();
            $allClient = $this->Orderspace_Model->getClient();
			
			$arrExp = explode(",", $allDataIndustry->subindustry_id);

            $data = "";
			$tempData = array();
            foreach ($arrExp as $key => $industrycat) {
				  $getName = $this->Order_Model->getNameIndustry($industrycat);
                  
				  $tempData["id"] = $industrycat;
				  $tempData["name"] = $getName->name;
				  
				  // convert array jadi object
				  $allIndustry[$key] = (object) $tempData;
			}

            /* s: UNTUK MENDAPATKAN DEFAULT CPM POSITION */
            $allDefaultCpmPosition = $this->Order_Model->getCpmPosition($allKanal[0]->id, $allProductGroup[0]->id);
            //$noPaket = $this->_generate();

            $arrDefaultCpmPosition = array();
            foreach ($allDefaultCpmPosition as $defaultCpmPosition)
                  $arrDefaultCpmPosition[] = $defaultCpmPosition->position_id;
            /* e: UNTUK MENDAPATKAN DEFAULT CPM POSITION */

            $data["all_industry"] = $allIndustry;
            $data["all_industry_cat"] = $allIndustryCat;
            $data["all_ads"] = $allAds;
            $data["all_kanal"] = $allKanal;
            $data["all_productgroup"] = $allProductGroup;
            $data["all_position"] = $allPosition;
            $data["all_agency"] = $allAgency;
            $data["all_client"] = $allClient;
            $data["all_default_cpm_position"] = $arrDefaultCpmPosition;
            //$data["no_space"] = $noSpace;
            $data["create"] = $this->_access["create"];

            $this->load->view("order_space/insert", $data);
      }

      public function update_page() {
            $no_space = $this->input->post("id");

            $allData = $this->Orderspace_Model->get($no_space);
            $allDetail = $this->Orderspace_Model->getDetail($no_space);
			$allIndustryCat = $this->Orderspace_Model->getAllIndustryCat();
            //$allIndustry = $this->Orderspace_Model->getAllIndustry();
			$allDataIndustry = $this->Orderspace_Model->getAllIndustryCatId($allData->industrycat_id);
            $allAds = $this->Orderspace_Model->getAllAds();
            $allKanal = $this->Orderspace_Model->getAllKanal();
            $allAgency = $this->Orderspace_Model->getAgency();
            $allClient = $this->Orderspace_Model->getClient();
			
			$arrExp = explode(",", $allDataIndustry->subindustry_id);

            $data = "";
			$tempData = array();
            foreach ($arrExp as $key => $industrycat) {
				  $getName = $this->Orderspace_Model->getNameIndustry($industrycat);
                  
				  $tempData["id"] = $industrycat;
				  $tempData["name"] = $getName->name;
				  
				  // convert array jadi object
				  $allIndustry[$key] = (object) $tempData;
			}

            // list untuk tambah paket
            $allProductGroup = $this->Order_Model->getAllProductGroup($allKanal[0]->id);
            $allPosition = $this->Order_Model->getAllPosition($allProductGroup[0]->position_id);

            /* s: UNTUK MENDAPATKAN DEFAULT CPM POSITION */
            $allDefaultCpmPosition = $this->Order_Model->getCpmPosition($allKanal[0]->id, $allProductGroup[0]->id);
            //$noPaket = $this->_generate();

            $arrDefaultCpmPosition = array();
            foreach ($allDefaultCpmPosition as $defaultCpmPosition)
                  $arrDefaultCpmPosition[] = $defaultCpmPosition->position_id;
            /* e: UNTUK MENDAPATKAN DEFAULT CPM POSITION */

            $arrProductGroup = array();
            $arrPosition = array();
            $arrCpmPosition = array();
            $n = 0;
            foreach ($allDetail as $detail) {
                  /* s: UNTUK MENDAPATKAN CPM POSITION */
                  $allCpmPosition = $this->Order_Model->getCpmPosition($detail->kanal_id, $detail->product_group_id);

                  $m = 0;
                  foreach ($allCpmPosition as $cpmPosition) {
                        $arrCpmPosition[$n][$m] = $cpmPosition->position_id;
                        $m += 1;
                  }
                  /* e: UNTUK MENDAPATKAN CPM POSITION */

                  // untuk mendapatkan list product group dan disimpan di array
                  $arrProductGroup[$n] = $this->Order_Model->getAllProductGroup($detail->kanal_id);

                  // untuk mendapatkan list position dan disimpan di array
                  $productGroup = $this->Order_Model->getProductGroup($detail->product_group_id);
                  $arrPosition[$n] = $this->Order_Model->getAllPosition($productGroup->position_id);

                  $n += 1;
            }

            $data["all_data"] = $allData;
            $data["all_detail"] = $allDetail;
            $data["all_industry_cat"] = $allIndustryCat;
            $data["all_industry"] = $allIndustry;
            $data["all_ads"] = $allAds;
            $data["all_kanal"] = $allKanal;
            $data["all_productgroup"] = $allProductGroup;
            $data["all_position"] = $allPosition;
            $data["all_agency"] = $allAgency;
            $data["all_client"] = $allClient;
            $data["arr_productgroup"] = $arrProductGroup;
            $data["arr_position"] = $arrPosition;
            $data["all_default_cpm_position"] = $arrDefaultCpmPosition;
            $data["all_cpm_position"] = $arrCpmPosition;
            $data["update"] = $this->_access["update"];

            $this->load->view("order_space/update", $data);
      }

      public function progress_page() {
            $no_space = $this->input->post("id");

            $allData = $this->Orderspace_Model->getProgress($no_space);

            $data["no_space"] = $no_space;
            $data["percent"] = $allData->progress;
            $data["progress"] = $this->_access["progress"];

            $this->load->view("order_space/progress", $data);
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

            $allData = $this->Orderspace_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Orderspace_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];
            $data["progress"] = $this->_access["progress"];

            $this->load->view("order_space/content", $data);
      }

      public function insert() {
            if ($this->_access["create"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            //$no_space = $arrParam[0];
            $agency_id = $arrParam[0];
            $client_id = $arrParam[1];
            $selectAds = $arrParam[2];
            $selectKanal = $arrParam[3];
            $selectProductGroup = $arrParam[4];
            $selectPosition = $arrParam[5];
            $txtStartDate = $arrParam[6];
            $txtEndDate = $arrParam[7];
            $isRestrict = $arrParam[8];
            $industry_id = $arrParam[9];
            $misc_info = $arrParam[10];
            $miscInfoSpace = $arrParam[11];
            $cpmQuota = $arrParam[12];
            $industrycat_id = $arrParam[13];
            $date = true;
            $tempIdInUse = "";
            $tempIdConflict = "";
            $tempIdDateWrong = "";
            $tempIdCpmQuota = "";
            $tempIdCpmQuotaEmpty = "";

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
                              $cpm_quota = str_replace(".", "", $cpmQuota[$n]["value"]);

                              // mengecek jika end_date < dari start_date
                              $start_date_compare = strtotime($start_date);
                              $end_date_compare = strtotime($end_date);
                              $today_compare = strtotime(date("Y-m-d"));

                              if (!empty($start_date_compare) or !empty($end_date_compare)) {
                                    if ($end_date_compare < $start_date_compare or $start_date_compare < $today_compare or $end_date_compare < $today_compare)
                                          $tempIdDateWrong .= $n . ",";
                              }

                              // mengecek apakah posisi yang akan digunakan dapat ditimpa (allow override) atau tidak
//                              $position = $this->Order_Model->getPosition($position_id);
//                              $allow_override = $position->allow_override;
//                              if ($allow_override == "N") {
                              $isOverride = $this->Order_Model->isOverride($kanal_id, $product_group_id, $position_id);
                              if ($isOverride == 0) {
                                    // mengecek apakah posisi sudah digunakan sebelumnya (dari database)
                                    $positionInUse = $this->Order_Model->getPositionInUse($kanal_id, $product_group_id, $position_id, $start_date, $end_date);
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
                              } else {
                                    // untuk mengecek kuota CPM
                                    $dataCpmQuota = $this->Order_Model->getCpmQuota($kanal_id, $product_group_id, $position_id);
                                    $usedCpmQuota = $this->Order_Model->getUsedCpmQuota($kanal_id, $product_group_id, $position_id, $start_date, $end_date);

                                    $totCpmQuota = $dataCpmQuota->cpm_quota;
                                    $totUsedCpmQuota = 0;
                                    foreach ($usedCpmQuota as $used)
                                          $totUsedCpmQuota += $used->cpm_quota;

                                    $totUsedCpmQuota += $cpm_quota;

                                    if ($cpm_quota < 1)
                                          $tempIdCpmQuotaEmpty .= $n . ",";
                                    elseif ($totUsedCpmQuota > $totCpmQuota)
                                          $tempIdCpmQuota .= $n . ",";
                              }
                        }

                        if (!empty($tempIdDateWrong))
                              $tempIdDateWrong = substr($tempIdDateWrong, 0, -1); // untuk menghilangkan "," dibelakang
                        if (!empty($tempIdInUse))
                              $tempIdInUse = substr($tempIdInUse, 0, -1); // untuk menghilangkan "," dibelakang
                        if (!empty($tempIdCpmQuota))
                              $tempIdCpmQuota = substr($tempIdCpmQuota, 0, -1); // untuk menghilangkan "," dibelakang
                        if (!empty($tempIdCpmQuotaEmpty))
                              $tempIdCpmQuotaEmpty = substr($tempIdCpmQuotaEmpty, 0, -1); // untuk menghilangkan "," dibelakang
                  }

                  // mengecek paket conflict
                  if ($isRestrict == "true" and $date) {
                        for ($n = 0; $n < count($selectAds); $n++) {
                              $kanal_id = $selectKanal[$n]["value"];
                              $product_group_id = $selectProductGroup[$n]["value"];
                              $position_id = $selectPosition[$n]["value"];
                              $start_date = $txtStartDate[$n]["value"];
                              $end_date = $txtEndDate[$n]["value"];

                              $allPaketRestrict = $this->Order_Model->getAllPaketRestrict($industry_id, $kanal_id, $product_group_id, $start_date, $end_date);
                              $rule = $this->Order_Model->getAllRule($industry_id, $kanal_id, $product_group_id);

                              /* untuk mengambil nama posisi dari rule */
                              $arrTempRule = array();
                              $allRule = explode(":", $rule->position_id);

                              foreach ($allPaketRestrict as $paketRestrict) {
                                    foreach ($allRule as $positions) {
                                          $arrPosition = explode(",", $positions);

                                          //if (stristr($positions, $position_id) and stristr($positions, $paketRestrict->position_id)) {
                                          if (in_array($position_id, $arrPosition) and in_array($paketRestrict->position_id, $arrPosition)) {
                                                $tempIdConflict .= $n . ",";
                                                break 2;
                                          }
                                    }
                              }
                        }

                        if (!empty($tempIdConflict))
                              $tempIdConflict = substr($tempIdConflict, 0, -1); // untuk menghilangkan "," dibelakang
                  }
            } else {
                  $date = false;
            }

            if (empty($agency_id) or empty($client_id) or !$date or $tempIdConflict <> "" or $tempIdInUse <> "" or $tempIdCpmQuotaEmpty <> "" or $tempIdCpmQuota <> "" or $tempIdDateWrong <> "") {
                  $data["status"] = false;
                  $data["error"] = array();
                  $data["error"]["tot_row"] = count($selectAds);
                  /* if (empty($no_space))
                    array_push($data["error"], "txtNoSpace"); */
                  if (empty($agency_id))
                        array_push($data["error"], "txtAgency");
                  if (empty($client_id))
                        array_push($data["error"], "txtClient");
                  if (!$date)
                        array_push($data["error"], "txtDate");
                  if ($tempIdConflict <> "") {
                        array_push($data["error"], "txtConflict");
                        $data["error"]["idConflict"] = $tempIdConflict;
                  }
                  if ($tempIdInUse <> "") {
                        array_push($data["error"], "txtInUse");
                        $data["error"]["idInUse"] = $tempIdInUse;
                  }
                  if ($tempIdCpmQuotaEmpty <> "") {
                        array_push($data["error"], "txtCpmEmpty");
                        $data["error"]["idCpmQuotaEmpty"] = $tempIdCpmQuotaEmpty;
                  }
                  if ($tempIdCpmQuota <> "") {
                        array_push($data["error"], "txtCpm");
                        $data["error"]["idCpmQuota"] = $tempIdCpmQuota;
                  }
                  if ($tempIdDateWrong <> "") {
                        array_push($data["error"], "txtDateWrong");
                        $data["error"]["idDateWrong"] = $tempIdDateWrong;
                  }
            } else {
                  $no_space = $this->_generate();

                  $this->Transaction_Model->transaction_start();
                  try {
                        $insert = $this->Orderspace_Model->insertOrderSpace($no_space, $agency_id, $client_id, $isRestrict, $industry_id, $misc_info, $industrycat_id);
                        if ($insert !== true)
                              throw new Exception($insert);

                        for ($n = 0; $n < count($selectAds); $n++) {
                              $ads_id = $selectAds[$n]["value"];
                              $kanal_id = $selectKanal[$n]["value"];
                              $product_group_id = $selectProductGroup[$n]["value"];
                              $position_id = $selectPosition[$n]["value"];
                              $start_date = $txtStartDate[$n]["value"];
                              $end_date = $txtEndDate[$n]["value"];
                              $misc_info_space = $miscInfoSpace[$n]["value"];
                              $cpm_quota = str_replace(".", "", $cpmQuota[$n]["value"]);

                              $insert = $this->Orderspace_Model->insertOrderSpaceAds($no_space, $ads_id, $kanal_id, $product_group_id, $position_id, $start_date, $end_date, $misc_info_space, $cpm_quota);
                              if ($insert !== true)
                                    throw new Exception($insert);
                        }
                  } catch (Exception $e) {
                        $insert = $e->getMessage();
                  }
                  $this->Transaction_Model->transaction_complete();

                  $data["status"] = $insert;
            }

            echo json_encode($data);
            die;
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $no_space = $arrParam[0];
            $agency_id = $arrParam[1];
            $client_id = $arrParam[2];
            $selectAds = $arrParam[3];
            $selectKanal = $arrParam[4];
            $selectProductGroup = $arrParam[5];
            $selectPosition = $arrParam[6];
            $txtStartDate = $arrParam[7];
            $txtEndDate = $arrParam[8];
            $isRestrict = $arrParam[9];
            $industry_id = $arrParam[10];
            $misc_info = $arrParam[11];
            $miscInfoSpace = $arrParam[12];
            $cpmQuota = $arrParam[13];
            $industrycat_id = $arrParam[14];
            $date = true;
            $tempIdInUse = "";
            $tempIdConflict = "";
            $tempIdDateWrong = "";
            $tempIdCpmQuota = "";
            $tempIdCpmQuotaEmpty = "";

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
                              $cpm_quota = str_replace(".", "", $cpmQuota[$n]["value"]);

                              // mengecek jika end_date < dari start_date
                              $start_date_compare = strtotime($start_date);
                              $end_date_compare = strtotime($end_date);
                              $today_compare = strtotime(date("Y-m-d"));

                              if (!empty($start_date_compare) or !empty($end_date_compare)) {
                                    if ($end_date_compare < $start_date_compare or $start_date_compare < $today_compare or $end_date_compare < $today_compare)
                                          $tempIdDateWrong .= $n . ",";
                              }

                              // mengecek apakah posisi yang akan digunakan dapat ditimpa (allow override) atau tidak
//                              $position = $this->Order_Model->getPosition($position_id);
//                              $allow_override = $position->allow_override;
//                              if ($allow_override == "N") {
                              $isOverride = $this->Order_Model->isOverride($kanal_id, $product_group_id, $position_id);
                              if ($isOverride == 0) {
                                    // mengecek apakah posisi sudah digunakan sebelumnya (dari database)
                                    $positionInUse = $this->Order_Model->getPositionInUse($kanal_id, $product_group_id, $position_id, $start_date, $end_date, $no_space);
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
                              } else {
                                    // untuk mengecek kuota CPM
                                    $dataCpmQuota = $this->Order_Model->getCpmQuota($kanal_id, $product_group_id, $position_id);
                                    $usedCpmQuota = $this->Order_Model->getUsedCpmQuota($kanal_id, $product_group_id, $position_id, $start_date, $end_date);

                                    $totCpmQuota = $dataCpmQuota->cpm_quota;
                                    $totUsedCpmQuota = 0;
                                    foreach ($usedCpmQuota as $used)
                                          $totUsedCpmQuota += $used->cpm_quota;

                                    $totUsedCpmQuota += $cpm_quota;

                                    if ($cpm_quota < 1)
                                          $tempIdCpmQuotaEmpty .= $n . ",";
                                    elseif ($totUsedCpmQuota > $totCpmQuota)
                                          $tempIdCpmQuota .= $n . ",";
                              }
                        }

                        if (!empty($tempIdDateWrong))
                              $tempIdDateWrong = substr($tempIdDateWrong, 0, -1); // untuk menghilangkan "," dibelakang
                        if (!empty($tempIdInUse))
                              $tempIdInUse = substr($tempIdInUse, 0, -1); // untuk menghilangkan "," dibelakang
                        if (!empty($tempIdCpmQuota))
                              $tempIdCpmQuota = substr($tempIdCpmQuota, 0, -1); // untuk menghilangkan "," dibelakang
                        if (!empty($tempIdCpmQuotaEmpty))
                              $tempIdCpmQuotaEmpty = substr($tempIdCpmQuotaEmpty, 0, -1); // untuk menghilangkan "," dibelakang
                  }

                  // mengecek paket conflict
                  if ($isRestrict == "true" and $date) {
                        for ($n = 0; $n < count($selectAds); $n++) {
                              $kanal_id = $selectKanal[$n]["value"];
                              $product_group_id = $selectProductGroup[$n]["value"];
                              $position_id = $selectPosition[$n]["value"];
                              $start_date = $txtStartDate[$n]["value"];
                              $end_date = $txtEndDate[$n]["value"];

                              $allPaketRestrict = $this->Order_Model->getAllPaketRestrict($industry_id, $kanal_id, $product_group_id, $start_date, $end_date, $no_space);
                              $rule = $this->Order_Model->getAllRule($industry_id, $kanal_id, $product_group_id);

                              /* untuk mengambil nama posisi dari rule */
                              $arrTempRule = array();
                              $allRule = explode(":", $rule->position_id);

                              foreach ($allPaketRestrict as $paketRestrict) {
                                    foreach ($allRule as $positions) {
                                          $arrPosition = explode(",", $positions);

                                          //if (stristr($positions, $position_id) and stristr($positions, $paketRestrict->position_id)) {
                                          if (in_array($position_id, $arrPosition) and in_array($paketRestrict->position_id, $arrPosition)) {
                                                $tempIdConflict .= $n . ",";
                                                break 2;
                                          }
                                    }
                              }
                        }

                        if (!empty($tempIdConflict))
                              $tempIdConflict = substr($tempIdConflict, 0, -1); // untuk menghilangkan "," dibelakang
                  }
            } else {
                  $date = false;
            }

            if (empty($agency_id) or empty($client_id) or !$date or $tempIdConflict <> "" or $tempIdInUse <> "" or $tempIdCpmQuotaEmpty <> "" or $tempIdCpmQuota <> "" or $tempIdDateWrong <> "") {
                  $data["status"] = false;
                  $data["error"] = array();
                  $data["error"]["tot_row"] = count($selectAds);
                  if (empty($agency_id))
                        array_push($data["error"], "txtAgency");
                  if (empty($client_id))
                        array_push($data["error"], "txtClient");
                  if (!$date)
                        array_push($data["error"], "txtDate");
                  if ($tempIdConflict <> "") {
                        array_push($data["error"], "txtConflict");
                        $data["error"]["idConflict"] = $tempIdConflict;
                  }
                  if ($tempIdInUse <> "") {
                        array_push($data["error"], "txtInUse");
                        $data["error"]["idInUse"] = $tempIdInUse;
                  }
                  if ($tempIdCpmQuotaEmpty <> "") {
                        array_push($data["error"], "txtCpmEmpty");
                        $data["error"]["idCpmQuotaEmpty"] = $tempIdCpmQuotaEmpty;
                  }
                  if ($tempIdCpmQuota <> "") {
                        array_push($data["error"], "txtCpm");
                        $data["error"]["idCpmQuota"] = $tempIdCpmQuota;
                  }
                  if ($tempIdDateWrong <> "") {
                        array_push($data["error"], "txtDateWrong");
                        $data["error"]["idDateWrong"] = $tempIdDateWrong;
                  }
            } else {
                  $this->Transaction_Model->transaction_start();
                  try {
                        $update = $this->Orderspace_Model->updateOrderSpace($no_space, $agency_id, $client_id, $isRestrict, $industry_id, $misc_info, $industrycat_id);
                        if ($update !== true)
                              throw new Exception($update);

                        // delete semua space ads yang sudah di order sesuai no spacenya
                        $update = $this->Orderspace_Model->deleteOrderSpaceAds($no_space);
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
                              $misc_info_space = $miscInfoSpace[$n]["value"];
                              $cpm_quota = str_replace(".", "", $cpmQuota[$n]["value"]);

                              $update = $this->Orderspace_Model->insertOrderSpaceAds($no_space, $ads_id, $kanal_id, $product_group_id, $position_id, $start_date, $end_date, $misc_info_space, $cpm_quota);
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

      public function progress() {
            if ($this->_access["progress"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $no_space = $arrParam[0];
            $percent = $arrParam[1];

            $update = $this->Orderspace_Model->progress($no_space, $percent);

            $data["status"] = $update;

            echo json_encode($data);
            die;
      }

      public function delete() {
            if ($this->_access["delete"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $id = $arrParam[0];

            $delete = $this->Orderspace_Model->delete($id);

            $data["status"] = $delete;

            echo json_encode($data);
            die;
      }

      public function get_product_group($kanal_id) {
            $allProductGroup = $this->Orderspace_Model->getAllProductGroup($kanal_id);

            $data = "";
            foreach ($allProductGroup as $productgroup)
                  $data .= "<option value='" . $productgroup->id . "'>" . $productgroup->name . "</option>";

            echo $data;
            die;
      }

      public function get_industrycat($industrycat_id) {
            $allIndustryCat = $this->Order_Model->getAllIndustryCatId($industrycat_id);
			
			$arrExp = explode(",", $allIndustryCat->subindustry_id);

            $data = "";
            foreach ($arrExp as $industrycat) {
				  $getName = $this->Order_Model->getNameIndustry($industrycat);
                  $data .= "<option value='" . $industrycat . "'>" . $getName->name . "</option>";
			}

            echo $data;
            die;
      }

      public function get_position($id) {
            $productGroup = $this->Orderspace_Model->getProductGroup($id);
            $allPosition = $this->Orderspace_Model->getAllPosition($productGroup->position_id);
            $allCpmPosition = $this->Order_Model->getCpmPosition($productGroup->kanal_id, $productGroup->id);

            // TAMPUNG POSISI CPM KE ARRAY
            $arrCpmPosition = array();
            foreach ($allCpmPosition as $cpmPosition)
                  $arrCpmPosition[] = $cpmPosition->position_id;

            $data = "";
            foreach ($allPosition as $position) {
                  $isCpm = (in_array($position->id, $arrCpmPosition)) ? "Y" : "N";

                  $data .= "<option value='" . $position->id . "' rel='" . $isCpm . "'>" . $position->name . "</option>";
            }

            echo $data;
            die;
      }

      public function get_agency() {
            $name = $this->input->get("term");

            $allAgency = $this->Orderspace_Model->getAgency($name);

            $arrData = array();
            foreach ($allAgency as $agency)
                  array_push($arrData, array("id" => $agency->id, "label" => $agency->name, "value" => $agency->name));

            echo json_encode($arrData);
            die;
      }

      public function get_client() {
            $name = $this->input->get("term");

            $allClient = $this->Orderspace_Model->getClient($name);

            $arrData = array();
            foreach ($allClient as $client)
                  array_push($arrData, array("id" => $client->id, "label" => $client->name, "value" => $client->name));

            echo json_encode($arrData);
            die;
      }

}