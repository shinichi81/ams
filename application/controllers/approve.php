<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Approve extends CI_Controller {
      /* Controller ini untuk menampilkan halaman approve
       * Lokasi: ./application/controllers/Approve.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Approve_Model", "Order_Model", "Transaction_Model"));
            $this->_access = get_access("APPROVE");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "approve/index";
            $data["menu"] = "order";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Approve_Model->get($no_paket);
            $allDetail = $this->Approve_Model->getDetail($no_paket);
			$allProduction = $this->Approve_Model->getProduction($no_paket);
			$allEvent = $this->Approve_Model->getEvent($no_paket);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Approve_Model->getAds($detail->ads_id);
                  $kanal = $this->Approve_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->Approve_Model->getProductgroup($detail->product_group_id);
                  $position = $this->Approve_Model->getPosition($detail->position_id);
                  $harga = $this->Approve_Model->getHarga($detail->kanal_id,$detail->product_group_id,$detail->position_id);
				  $hari = date_diff(date_create($detail->start_date), date_create($detail->end_date));

                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["misc_info"] = $detail->misc_info;
                  $result[$n]["approve"] = $detail->approve;
                  $result[$n]["no_po"] = $detail->no_po;
                  $result[$n]["harga"] = $harga->harga;
                  $result[$n]["total"] = ($hari->days + 1) * $harga->harga;

                  $n += 1;
            }

		$arrProduction = array();
		$m = 0;
		foreach ($allProduction as $production) {
            $prod = $this->Approve_Model->getSingleProduction($production->production_id);
			$arrProduction[$m]["production"] = $prod->nama;
			$arrProduction[$m]["quantity"] = $production->quantity;
			$arrProduction[$m]["harga"] = $prod->harga;
			$arrProduction[$m]["harga_total"] = (int)$production->quantity * (float)$prod->harga;
			$arrProduction[$m]["keterangan"] = $production->keterangan;
			$m += 1;
		}

		$arrEvent = array();
		$n = 0;
		foreach ($allEvent as $event) {
			$arrEvent[$n]["event"] = $event->event;
			$arrEvent[$n]["start_date"] = $event->start_date;
			$arrEvent[$n]["end_date"] = $event->end_date;
			$arrEvent[$n]["biaya"] = $event->biaya;
			$arrEvent[$n]["keterangan"] = $event->keterangan;
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
        $data["all_production"] = $arrProduction;
        $data["all_event"] = $arrEvent;
            $data["read"] = $this->_access["read"];

            $this->load->view("approve/show", $data);
      }

      public function insert_page() {
            $this->load->view("approve/insert");
      }

      public function update_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Approve_Model->get($no_paket);
            $allDetail = $this->Approve_Model->getDetail($no_paket);
			$nameCatIndustry = $this->Approve_Model->getNameCatIndustry($allData->industrycat_id);
			$allProduction = $this->Approve_Model->getProduction($no_paket);
			$allEvent = $this->Approve_Model->getEvent($no_paket);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Approve_Model->getAds($detail->ads_id);
                  $kanal = $this->Approve_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->Approve_Model->getProductgroup($detail->product_group_id);
                  $position = $this->Approve_Model->getPosition($detail->position_id);
                  $harga = $this->Approve_Model->getHarga($detail->kanal_id,$detail->product_group_id,$detail->position_id);
				  $hari = date_diff(date_create($detail->start_date), date_create($detail->end_date));

                  $result[$n]["id"] = $detail->id;
                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["approve"] = $detail->approve;
                  $result[$n]["misc_info"] = $detail->misc_info;
                  $result[$n]["no_po"] = $detail->no_po;
                  $result[$n]["request"] = $detail->request;
                  $result[$n]["harga"] = $harga->harga;
                  $result[$n]["total"] = ($hari->days + 1) * $harga->harga;

                  $n += 1;
            }

		$arrProduction = array();
		$m = 0;
		foreach ($allProduction as $production) {
            $prod = $this->Approve_Model->getSingleProduction($production->production_id);
			$arrProduction[$m]["production"] = $prod->nama;
			$arrProduction[$m]["quantity"] = $production->quantity;
			$arrProduction[$m]["harga"] = $prod->harga;
			$arrProduction[$m]["harga_total"] = (int)$production->quantity * (float)$prod->harga;
			$arrProduction[$m]["keterangan"] = $production->keterangan;
			$m += 1;
		}

		$arrEvent = array();
		$n = 0;
		foreach ($allEvent as $event) {
			$arrEvent[$n]["event"] = $event->event;
			$arrEvent[$n]["start_date"] = $event->start_date;
			$arrEvent[$n]["end_date"] = $event->end_date;
			$arrEvent[$n]["biaya"] = $event->biaya;
			$arrEvent[$n]["keterangan"] = $event->keterangan;
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
        $data["all_production"] = $arrProduction;
        $data["all_event"] = $arrEvent;
            $data["update"] = $this->_access["update"];

            $this->load->view("approve/update", $data);
      }

      public function update_page_brandcomm() {
            $this->load->model("Brandcomm_Model");

            $no_brandcomm = $this->input->post("id");

            $allData = $this->Brandcomm_Model->get($no_brandcomm);
            $allDetail = $this->Brandcomm_Model->getDetail($no_brandcomm);

            $allItem = $this->Brandcomm_Model->getAllItem();

            $data["all_data"] = $allData;
            $data["all_detail"] = $allDetail;
            $data["all_item"] = $allItem;
            $data["update"] = $this->_access["update"];

            $this->load->view("approve/update_brandcomm", $data);
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

            $allData = $this->Approve_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Approve_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];

            $this->load->view("approve/content", $data);
      }

      public function content_brandcomm() {
            $this->load->model("Brandcomm_Model");

            $page = $this->input->post("page", 1);

            if ($page < 1)
                  $page = 1;
            else
                  $page -= 1;

            $startLimit = $page * $this->config->item("show_per_page");
            $endLimit = $this->config->item("show_per_page");

            $allData = $this->Brandcomm_Model->getAll($startLimit, $endLimit, "Y");

            // untuk mendapatkan total page
            $total = $this->Brandcomm_Model->getTotal("Y");
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];

            $this->load->view("approve/content_brandcomm", $data);
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $this->load->model("Brandcomm_Model");

            $arrParam = $this->input->post("arrParam");
            $no_paket = $arrParam[0];
            $arrPaketAds = $arrParam[1];
            $arrNoPo = $arrParam[2];
            $arrAdsSelected = array();
            $tempIdInUse = "";
            $tempIdConflict = "";
            $tempIdCpmQuota = "";
            $totalEmptyNoPo = 0;
            $totalFillNoPo = 0;
            $passDone = TRUE;
            $passApprove = TRUE;

            $allData = $this->Approve_Model->get($no_paket);
            $allDetail = $this->Approve_Model->getDetail($no_paket);

            if ($allData->approve == "N") {
                  /* s: jika paket dibuat dari brandcomm */
                  $dataPaket = $this->Approve_Model->getNoRefence($no_paket);
                  if (count($dataPaket) > 0) {
                        $no_reference = $dataPaket->no_reference;
                        $noReferenceType = substr($no_reference, 0, 1);

                        if ($noReferenceType == "B") {
                              $totalPassDone = $this->Brandcomm_Model->getTotalPassDone($no_reference);
                              $totalPassApprove = $this->Brandcomm_Model->getTotalPassApprove($no_reference);

                              if ($totalPassDone == 0)
                                    $passDone = FALSE;
                              else if ($totalPassApprove == 0)
                                    $passApprove = FALSE;
                        }
                  }
                  /* e: jika paket dibuat dari brandcomm */
                  
                  if (!empty($arrPaketAds)) {
                        foreach ($arrPaketAds as $paket)
                              array_push($arrAdsSelected, $paket["value"]);

                        // mengecek paket yang posisinya sudah digunakan
                        $n = 0;
                        foreach ($allDetail as $detail) {
                              if (in_array($detail->id, $arrAdsSelected)) {
                                    $kanal_id = $detail->kanal_id;
                                    $product_group_id = $detail->product_group_id;
                                    $position_id = $detail->position_id;
                                    $start_date = $detail->start_date;
                                    $end_date = $detail->end_date;
                                    $cpm_quota = $detail->cpm_quota;

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

                              $n += 1;
                        }

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
                  }
            }

            if ((empty($arrPaketAds) and $allData->approve == "N") /* or (empty($no_po) and $allData->approve == "Y") */ or $tempIdConflict <> "" or $tempIdInUse <> "" or $tempIdCpmQuota <> "" or $passApprove === FALSE or $passDone === FALSE) {
                  $data["status"] = false;
                  $data["error"] = array();
                  $data["error"]["tot_row"] = count($allDetail);
                  if (empty($arrPaketAds) and $allData->approve == "N")
                        array_push($data["error"], "txtPaket");
//                  if (empty($no_po) and $allData->approve == "Y")
//                        array_push($data["error"], "txtNoPo");
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
                  if ($passApprove === FALSE)
                        array_push($data["error"], "txtPassApprove");
                  if ($passDone === FALSE)
                        array_push($data["error"], "txtPassDone");
            } else {
                  $this->Transaction_Model->transaction_start();

                  $update = $this->Approve_Model->updateStatusOrderPaket($no_paket);

                  foreach ($arrPaketAds as $paket)
                        $update = $this->Approve_Model->updateStatusOrderPaketAds($paket["value"]);

                  // mendapatkan total no_po yang masih kosong
                  if (!is_array($arrPaketAds))
                        $totalEmptyNoPo = $this->Approve_Model->getTotalEmptyNoPo($no_paket);

                  /* s: PROSES UPDATE NO PO */
                  foreach ($arrNoPo as $noPo) {
                        $id = $noPo["id"];
                        $no_po = trim($noPo["value"]);

                        if (!empty($no_po)) {
                              $update = $this->Approve_Model->updateStatusToY($no_paket, "IS_NOPO");
                              $update = $this->Approve_Model->updateNoPo($id, $no_po);
                              $totalFillNoPo += 1;
                        }
                  }
                  /* e: PROSES UPDATE NO PO */

                  // jika semua paket yang sudah di approve sudah diisi no po nya, update value column 'is_nopo' jadi 'Y'
                  if ($totalFillNoPo > 0) {
                        if ((is_array($arrPaketAds) and ($totalFillNoPo == count($arrPaketAds))) or ($totalFillNoPo == $totalEmptyNoPo))
                              $update = $this->Approve_Model->updateStatusToY($no_paket, "NOPO");
                  }

                  /* s: jika paket dibuat dari brandcomm, maka status approve di brandcomm juga di update jadi 'Y' */
                  $dataPaket = $this->Approve_Model->getNoRefence($no_paket);
                  if (count($dataPaket) > 0) {
                        $no_reference = $dataPaket->no_reference;
                        $noReferenceType = substr($no_reference, 0, 1);

                        if ($noReferenceType == "B")
                              $update = $this->Approve_Model->updateStatusOrderBrandcomm($no_reference);
                  }
                  /* e: jika paket dibuat dari brandcomm, maka status approve di brandcomm juga di update jadi 'Y' */

                  $this->Transaction_Model->transaction_complete();

                  $data["status"] = $update;
            }

            echo json_encode($data);
            die;
      }

      public function update_brandcomm() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $this->load->model("Brandcomm_Model");

            $arrParam = $this->input->post("arrParam");
            $no_brandcomm = $arrParam[0];

            $totalPassApprove = $this->Brandcomm_Model->getTotalPassApprove($no_brandcomm);

            if ($totalPassApprove == 0) {
                  $data["status"] = false;
                  $data["error"] = true;
            } else {
                  $update = $this->Brandcomm_Model->updateStatus("APPROVE", "Y", $no_brandcomm);

                  $data["status"] = $update;
            }

            echo json_encode($data);
            die;
      }

      public function unapprove() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $id = $arrParam[0];

            $this->Transaction_Model->transaction_start();
            $update = $this->Approve_Model->unapprovePaket($id);
            $update = $this->Approve_Model->unapprovePaketAds($id);
            $this->Transaction_Model->transaction_complete();

            $data["status"] = $update;

            echo json_encode($data);
            die;
      }

      public function unapprove_brandcomm() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $this->load->model("Brandcomm_Model");

            $arrParam = $this->input->post("arrParam");
            $no_brandcomm = $arrParam[0];

            $update = $this->Brandcomm_Model->unapproveBrandcomm($no_brandcomm);

            $data["status"] = $update;

            echo json_encode($data);
            die;
      }

}