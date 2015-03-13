<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Backdate_Request extends CI_Controller {
      /* Controller ini untuk menampilkan halaman request
       * Lokasi: ./application/controllers/backdate_request.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Backdaterequest_Model", "Order_Model", "Approve_Model", "Transaction_Model"));
            $this->_access = get_access("BACKDATE_REQUEST");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "backdate_request/index";
            $data["menu"] = "backdate";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $id = $this->input->post("id");

            $allData = $this->Backdaterequest_Model->getUpdate($id);
            $allDetail = $this->Backdaterequest_Model->getShowDetail($allData->id);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Backdaterequest_Model->getAdsName($detail->ads_id);
                  $kanal = $this->Backdaterequest_Model->getKanalName($detail->kanal_id);
                  $productgroup = $this->Backdaterequest_Model->getProductgroupName($detail->product_group_id);
                  $position = $this->Backdaterequest_Model->getPositionName($detail->position_id);

                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["misc_info"] = $detail->misc_info;
                  $result[$n]["approve"] = $detail->approve;
                  $result[$n]["new_start_date"] = $detail->new_start_date;
                  $result[$n]["new_end_date"] = $detail->new_end_date;

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

            $this->load->view("backdate_request/show", $data);
      }

      public function insert_page() {
            $data["create"] = $this->_access["create"];

            $this->load->view("backdate_request/insert", $data);
      }

      public function insert_request_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Order_Model->get($no_paket);
            $allDetail = $this->Backdaterequest_Model->getDetail($no_paket);
			$nameCatIndustry = $this->Backdaterequest_Model->getNameCatIndustry($allData->industrycat_id);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Backdaterequest_Model->getAdsName($detail->ads_id);
                  $kanal = $this->Backdaterequest_Model->getKanalName($detail->kanal_id);
                  $productgroup = $this->Backdaterequest_Model->getProductgroupName($detail->product_group_id);
                  $position = $this->Backdaterequest_Model->getPositionName($detail->position_id);

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
                  $result[$n]["backdate"] = $detail->backdate;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;

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

            $this->load->view("backdate_request/insert_order", $data);
      }

      /* public function update_page() {
        $id = $this->input->post("id");

        $allData = $this->Backdaterequest_Model->getUpdate($id);
        $allDetail = $this->Backdaterequest_Model->getDetail($allData->no_paket);

        $n = 0;
        $result = array();
        foreach ($allDetail as $detail) {
        $ads = $this->Backdaterequest_Model->getAdsName($detail->ads_id);
        $kanal = $this->Backdaterequest_Model->getKanalName($detail->kanal_id);
        $productgroup = $this->Backdaterequest_Model->getProductgroupName($detail->product_group_id);
        $position = $this->Backdaterequest_Model->getPositionName($detail->position_id);

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

        $this->load->view("backdate_request/update", $data);
        } */

      public function search_page() {
            $allData = $this->Backdaterequest_Model->getSearchPaket();

            $data["all_data"] = $allData;
            $data["create"] = $this->_access["create"];

            $this->load->view("backdate_request/search", $data);
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

            $allData = $this->Backdaterequest_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Backdaterequest_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            //$data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("backdate_request/content", $data);
      }

      public function insert() {
            if ($this->_access["create"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $no_paket = $arrParam[0];
            //$brand = $arrParam[1];
            $reason = trim($arrParam[1]);
            $chkRequest = $arrParam[2];
            $allRequest = $arrParam[3];
            $newStartDate = $arrParam[4];
            $newEndDate = $arrParam[5];
            // $allId = $arrParam[5];
            $validPaket = true;
            $date = true;
//            $arrRequest = array();
            $totalNotRequest = 0;
            $tempIdInUse = "";
            $tempIdConflict = "";
            $tempIdCpmQuota = "";
            $tempIdDateWrong = "";
            $passDone = TRUE;
            $passApprove = TRUE;

            // mengecek apakah no paket yang dimasukkan valid
            $paket = $this->Backdaterequest_Model->get($no_paket);
            $totPaket = count($paket);
            if ($totPaket < 1)
                  $validPaket = false;

            if (!empty($chkRequest)) {
                  // mengecek apakah tanggal yang akan di request sudah terisi semuanya
                  for ($n = 0; $n < count($chkRequest); $n++) {
//                        $new_start_date = $newStartDate[$n]["value"];
//                        $new_end_date = $newEndDate[$n]["value"];

                        if (empty($newStartDate[$n]["value"]) or empty($newEndDate[$n]["value"])) {
                              $date = false;
                              break;
                        }
//                        else {
//                              // mengecek jika end_date < dari start_date
//                              $start_date_compare = strtotime($new_start_date);
//                              $end_date_compare = strtotime($new_end_date);
////                              $today_compare = strtotime(date("Y-m-d"));
//
//                              if ($end_date_compare < $start_date_compare /* or $start_date_compare >= $today_compare or $end_date_compare >= $today_compare */)
//                                    $tempIdDateWrong .= $n . ",";
//                        }
                  }

//                  if (!empty($tempIdDateWrong))
//                        $tempIdDateWrong = substr($tempIdDateWrong, 0, -1); // untuk menghilangkan "," dibelakang

                  if ($date) {
                        $allData = $this->Approve_Model->get($no_paket);
                        $allDetail = $this->Approve_Model->getDetail($no_paket);

//                  if (!empty($arrPaketAds)) {
//                        foreach ($arrPaketAds as $paket)
//                              array_push($arrAdsSelected, $paket["value"]);
                        // mengecek paket yang posisinya sudah digunakan
                        $n = 0;
                        foreach ($allDetail as $detail) {
                              for ($m = 0; $m < count($chkRequest); $m++) {
                                    $idSelected = $chkRequest[$m]["value"];
                                    $new_start_date = $newStartDate[$m]["value"];
                                    $new_end_date = $newEndDate[$m]["value"];

//                              if (in_array($detail->id, $arrAdsSelected)) {
                                    if ($detail->id == $idSelected) {
                                          $kanal_id = $detail->kanal_id;
                                          $product_group_id = $detail->product_group_id;
                                          $position_id = $detail->position_id;
//                                          $start_date = $detail->start_date;
//                                          $end_date = $detail->end_date;
                                          $start_date = $new_start_date;
                                          $end_date = $new_end_date;
                                          $cpm_quota = $detail->cpm_quota;

                                          // mengecek jika end_date < dari start_date
                                          $start_date_compare = strtotime($new_start_date);
                                          $end_date_compare = strtotime($new_end_date);
//                              $today_compare = strtotime(date("Y-m-d"));

                                          if ($end_date_compare < $start_date_compare /* or $start_date_compare >= $today_compare or $end_date_compare >= $today_compare */)
                                                $tempIdDateWrong .= $n . ",";

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
                                          } else {
                                                // untuk mengecek kuota CPM
                                                $dataCpmQuota = $this->Order_Model->getCpmQuota($kanal_id, $product_group_id, $position_id);
                                                $usedCpmQuota = $this->Order_Model->getUsedCpmQuota($kanal_id, $product_group_id, $position_id, $start_date, $end_date);

                                                $totCpmQuota = $dataCpmQuota->cpm_quota;
                                                $totUsedCpmQuota = 0;
                                                foreach ($usedCpmQuota as $used)
                                                      $totUsedCpmQuota += $used->cpm_quota;

                                                $totUsedCpmQuota += $cpm_quota;

                                                if ($totUsedCpmQuota > $totCpmQuota)
                                                      $tempIdCpmQuota .= $n . ",";
                                          }
                                    }
                              }

                              $n += 1;
                        }

                        if (!empty($tempIdDateWrong))
                              $tempIdDateWrong = substr($tempIdDateWrong, 0, -1); // untuk menghilangkan "," dibelakang
                        if (!empty($tempIdInUse))
                              $tempIdInUse = substr($tempIdInUse, 0, -1); // untuk menghilangkan "," dibelakang					
                        if (!empty($tempIdCpmQuota))
                              $tempIdCpmQuota = substr($tempIdCpmQuota, 0, -1); // untuk menghilangkan "," dibelakang


                              
// mengecek paket conflict
                        $isRestrict = $allData->is_restrict;
                        $industry_id = $allData->industry_id;
                        if ($isRestrict == "Y") {
                              $n = 0;
                              foreach ($allDetail as $detail) {
                                    if (in_array($detail->id, $arrAdsSelected)) {
                                          $kanal_id = $detail->kanal_id;
                                          $product_group_id = $detail->product_group_id;
                                          $position_id = $detail->position_id;
                                          $start_date = $detail->start_date;
                                          $end_date = $detail->end_date;

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

                                    $n += 1;
                              }

                              if (!empty($tempIdConflict))
                                    $tempIdConflict = substr($tempIdConflict, 0, -1); // untuk menghilangkan "," dibelakang
                        }
//                  }
                  }
            } else {
                  $date = false;
            }

            // if (empty($no_paket) or empty($chkRequest) or !$validPaket) {
            if (empty($no_paket) or !$validPaket or $tempIdConflict <> "" or $tempIdInUse <> "" or $tempIdCpmQuota <> "" or !$date or $tempIdDateWrong <> "" or empty($reason)) {
                  $data["status"] = false;
                  $data["error"] = array();
                  $data["error"]["tot_row"] = count($allRequest);
                  if (empty($no_paket))
                        array_push($data["error"], "txtNoPaket");
                  if (!$date)
                        array_push($data["error"], "txtTotalRequest");
                  if (!$validPaket)
                        array_push($data["error"], "txtValidPaket");
                  if ($tempIdConflict <> "") {
                        array_push($data["error"], "txtConflict");
                        $data["error"]["idConflict"] = $tempIdConflict;
                  }
                  if ($tempIdInUse <> "") {
                        array_push($data["error"], "txtInUse");
                        $data["error"]["idInUse"] = $tempIdInUse;
                  }
                  if ($tempIdCpmQuota <> "") {
                        array_push($data["error"], "txtCpm");
                        $data["error"]["idCpmQuota"] = $tempIdCpmQuota;
                  }
                  if ($tempIdDateWrong <> "") {
                        array_push($data["error"], "txtDateWrong");
                        $data["error"]["idDateWrong"] = $tempIdDateWrong;
                  }
                  if (empty($reason))
                        array_push($data["error"], "txtReason");
            } else {
                  $this->Transaction_Model->transaction_start();

                  // mendapatkan total yang belum di request backdate
                  $totalNotRequest = $this->Backdaterequest_Model->getTotalNotRequest($no_paket);

                  $insert = $this->Backdaterequest_Model->insert($no_paket, $reason);

                  // id tabel tbl_request_backdate yang terakhir di insert
                  $id_header = $insert;

//                  foreach ($chkRequest as $key => $request) {
                  for ($n = 0; $n < count($chkRequest); $n++) {
                        $id = $chkRequest[$n]["value"];
                        $new_start_date = $newStartDate[$n]["value"];
                        $new_end_date = $newEndDate[$n]["value"];

                        $insert = $this->Backdaterequest_Model->insertRequestBackdateDetail($no_paket, $id, $id_header, $new_start_date, $new_end_date);
                        $insert = $this->Backdaterequest_Model->updateBackdateStatus($id, "Y", "DETAIL");
                  }

                  // update kolom is_request jika ada yang request tayang
//                  $insert = $this->Backdaterequest_Model->updateIsBackdate($no_paket, "Y");
                  // jika semua paket sudah direquest backdate, update value column 'backdate' jadi 'Y'
//                  if (count($chkRequest) == count($allRequest))
                  if ($totalNotRequest == count($chkRequest))
                        $insert = $this->Backdaterequest_Model->updateBackdateStatus($no_paket, "Y", "HEADER");

                  $this->Transaction_Model->transaction_complete();

                  // set kolom is_request_ads = 'Y' yang dicentang
                  /* foreach ($chkRequest as $request)
                    $update = $this->Backdaterequest_Model->updateRequestStatus($request["value"]); */

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
        $update = $this->Backdaterequest_Model->update($id, $brand, $request_type, $detail);

        // set semua kolom is_request_ads = 'N'
        $update = $this->Backdaterequest_Model->updateRequestStatusToN($no_paket);

        // set kolom is_request_ads = 'Y' yang dicentang
        foreach ($allRequest as $request)
        $update = $this->Backdaterequest_Model->updateRequestStatus($request["value"]);

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

            $allNoPaketAndIdOrder = $this->Backdaterequest_Model->getNoPaketAndIdOrder($id);

            foreach ($allNoPaketAndIdOrder as $noPaketAndIdOrder) {
                  $idOrderPaketAds = $noPaketAndIdOrder->id_order_paket_ads;

                  $delete = $this->Backdaterequest_Model->updateBackdateStatus($idOrderPaketAds, "N", "DETAIL");
            }

            $no_paket = $allNoPaketAndIdOrder[0]->no_paket;
            $delete = $this->Backdaterequest_Model->updateBackdateStatus($no_paket, "N", "HEADER");

            $delete = $this->Backdaterequest_Model->deleteDetail($id);
            $delete = $this->Backdaterequest_Model->deleteHeader($id);

//            // JIKA DI TABEL TBL_REQUEST_BACKDATE TIDAK ADA LAGI NO PAKET YANG SAMA, UPDATE KOLOM IS_BACKDATE = 'N' DI TBL_ORDER
//            $totalRemaining = $this->Backdaterequest_Model->getTotalRemaining($no_paket);
//            if ($totalRemaining == 0)
//                  $update = $this->Backdaterequest_Model->updateIsBackdate($no_paket, "N");

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
//            $allData = $this->Backdaterequest_Model->getSearchPaket($agency_id, $client_id);
//
//            $data["all_data"] = $allData;
//
//            $this->load->view("backdate_request/search_result", $data);
//      }

      public function get_data() {
            $no_paket = $this->input->get("term");

            $allData = $this->Backdaterequest_Model->get($no_paket);

            $arrData = array();
            $temp = array();
            foreach ($allData as $data) {
			
				  $detailIndustryCat = $this->Backdaterequest_Model->getNameCatIndustry($data->industrycat_id);
			
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
            $allDetail = $this->Backdaterequest_Model->getDetail($no_paket);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Backdaterequest_Model->getAdsName($detail->ads_id);
                  $kanal = $this->Backdaterequest_Model->getKanalName($detail->kanal_id);
                  $productgroup = $this->Backdaterequest_Model->getProductgroupName($detail->product_group_id);
                  $position = $this->Backdaterequest_Model->getPositionName($detail->position_id);

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
                  $result[$n]["backdate"] = $detail->backdate;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;

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

            $this->load->view("backdate_request/detail", $data);
      }

}