<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Brandcomm extends CI_Controller {
      /* Controller ini untuk menampilkan halaman brandcomm
       * Lokasi: ./application/controllers/brandcomm.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Brandcomm_Model", "Transaction_Model"));
            $this->_access = get_access("BRANDCOMM");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "brandcomm/index";
            $data["menu"] = "order";

            $this->load->view("template", $data);
      }

      private function _generate() {
            $data = $this->Brandcomm_Model->getLastNoPaket();

            if (!empty($data)) {
                  $noPaket = $data->no_brandcomm;

                  $start = strpos($noPaket, "/") + 1;
                  $end = strrpos($noPaket, "/") + 1;

                  $number = substr($noPaket, $start, $end);
                  $number += 1;

                  if (strlen($number) == 1)
                        $number = "00" . $number;
                  else if (strlen($number) == 2)
                        $number = "0" . $number;

                  $newNoPaket = "B/" . $number . "/" . date("dmY");
            } else {
                  $newNoPaket = "B/001/" . date("dmY");
            }

            return $newNoPaket;
            /* echo "<input name='txtNoPaket' id='txtNoPaket' type='text' disabled='disabled' value='".$newNoPaket."' />";
              die; */
      }

      public function show_page() {
            $no_brandcomm = $this->input->post("id");

            $allData = $this->Brandcomm_Model->get($no_brandcomm);
            $allDetail = $this->Brandcomm_Model->getDetail($no_brandcomm);

            $data["all_data"] = $allData;
            $data["all_detail"] = $allDetail;
            $data["read"] = $this->_access["read"];

            $this->load->view("brandcomm/show", $data);
      }

      public function insert_page() {
            $allItem = $this->Brandcomm_Model->getAllItem();
            $totalNotFeedback = $this->Brandcomm_Model->getTotalNotFeedback();

            $data["all_item"] = $allItem;
            $data["total_not_feedback"] = $totalNotFeedback;
            $data["create"] = $this->_access["create"];

            $this->load->view("brandcomm/insert", $data);
      }

      public function update_page() {
            $no_brandcomm = $this->input->post("id");

            $allData = $this->Brandcomm_Model->get($no_brandcomm);
            $allDetail = $this->Brandcomm_Model->getDetail($no_brandcomm);

            $allItem = $this->Brandcomm_Model->getAllItem();

            $data["all_data"] = $allData;
            $data["all_detail"] = $allDetail;
            $data["all_item"] = $allItem;
            $data["update"] = $this->_access["update"];

            $this->load->view("brandcomm/update", $data);
      }

      public function search_page() {

            $allData = $this->Brandcomm_Model->getSearchSpace();

            $data["all_data"] = $allData;
            $data["create"] = $this->_access["create"];

            $this->load->view("brandcomm/search", $data);
      }

      public function progress_page() {
            $no_brandcomm = $this->input->post("id");

            $allData = $this->Brandcomm_Model->getProgress($no_brandcomm);

            $data["no_brandcomm"] = $no_brandcomm;
            $data["percent"] = $allData->progress;
            $data["progress"] = $this->_access["progress"];

            $this->load->view("brandcomm/progress", $data);
      }

      public function content() {
            $page = $this->input->post("page", 1);

            if ($page < 1)
                  $page = 1;
            else
                  $page -= 1;

            $startLimit = $page * $this->config->item("show_per_page");
            $endLimit = $this->config->item("show_per_page");

            $allData = $this->Brandcomm_Model->getAll($startLimit, $endLimit);

            // untuk mendapatkan total page
            $total = $this->Brandcomm_Model->getTotal();
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];
            $data["progress"] = $this->_access["progress"];

            $this->load->view("brandcomm/content", $data);
      }

      public function insert() {
            if ($this->_access["create"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $start_date = $arrParam[0];
            $end_date = $arrParam[1];
            $txtDetail = $arrParam[2];
            $hdItemId = $arrParam[3];
            $tempIdDateWrong = FALSE;
            $tempDetail = "";
            $totalNotFeedback = 0;

            // mengecek jika end_date < dari start_date
            $start_date_compare = strtotime($start_date);
            $end_date_compare = strtotime($end_date);
            $today_compare = strtotime(date("Y-m-d"));

            if ($end_date_compare < $start_date_compare or $start_date_compare < $today_compare or $end_date_compare < $today_compare)
                  $tempIdDateWrong = TRUE;

            for ($n = 0; $n < count($txtDetail); $n++) {
                  $detail = $txtDetail[$n]["value"];

                  if (empty($detail))
                        $tempDetail .= $n . ",";
            }

            if (!empty($tempDetail))
                  $tempDetail = substr($tempDetail, 0, -1); // untuk menghilangkan "," dibelakang

            $totalNotFeedback = $this->Brandcomm_Model->getTotalNotFeedback();

            if (empty($start_date) or empty($end_date) or $tempIdDateWrong === TRUE or $tempDetail <> "" or $totalNotFeedback >= $this->config->item("max_request_brandcomm")) {
                  $data["status"] = false;
                  $data["error"] = array();
                  $data["error"]["tot_row"] = count($txtDetail);
                  if (empty($start_date))
                        array_push($data["error"], "txtStartDate");
                  if (empty($end_date))
                        array_push($data["error"], "txtEndDate");
                  if (!empty($start_date) and !empty($end_date) and $tempIdDateWrong === TRUE)
                        array_push($data["error"], "txtWrongDateRange");
                  if ($tempDetail <> "") {
                        array_push($data["error"], "txtDetail");
                        $data["error"]["idItem"] = $tempDetail;
                  }
                  if ($totalNotFeedback >= $this->config->item("max_request_brandcomm"))
                        array_push($data["error"], "txtNotFeedback");
            } else {
                  $no_brandcomm = $this->_generate();

                  $this->Transaction_Model->transaction_start();
                  try {
                        $insert = $this->Brandcomm_Model->insertOrderbrandcomm($no_brandcomm, $start_date, $end_date);
                        if ($insert !== true)
                              throw new Exception($insert);

                        for ($n = 0; $n < count($txtDetail); $n++) {
                              $item_brandcomm_id = $hdItemId[$n]["value"];
                              $detail = $txtDetail[$n]["value"];

                              $insert = $this->Brandcomm_Model->insertOrderBrancommDetail($no_brandcomm, $item_brandcomm_id, $detail);
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
            $no_brandcomm = $arrParam[0];
            $start_date = $arrParam[1];
            $end_date = $arrParam[2];
            $txtDetail = $arrParam[3];
            $hdItemId = $arrParam[4];
            $feedback = trim($arrParam[5]);
            $hd_start_date = $arrParam[6];
            $hd_end_date = $arrParam[7];
            
            $tempIdDateWrong = FALSE;
            $tempDetail = "";
            $totalNotFeedback = 0;

            // mengecek jika end_date < dari start_date
            $start_date_compare = strtotime($start_date);
            $end_date_compare = strtotime($end_date);
            $today_compare = strtotime(date("Y-m-d"));

            if ($start_date <> $hd_start_date or $end_date <> $hd_end_date) {
                  if ($end_date_compare < $start_date_compare or $start_date_compare < $today_compare or $end_date_compare < $today_compare)
                        $tempIdDateWrong = TRUE;
            }

            for ($n = 0; $n < count($txtDetail); $n++) {
                  $detail = $txtDetail[$n]["value"];

                  if (empty($detail))
                        $tempDetail .= $n . ",";
            }

            if (!empty($tempDetail))
                  $tempDetail = substr($tempDetail, 0, -1); // untuk menghilangkan "," dibelakang

            $totalNotFeedback = $this->Brandcomm_Model->getTotalNotFeedback($no_brandcomm);

            if (empty($start_date) or empty($end_date) or $tempIdDateWrong === TRUE or $tempDetail <> "" or $totalNotFeedback >= $this->config->item("max_request_brandcomm") or $feedback == "") {
                  $data["status"] = false;
                  $data["error"] = array();
                  $data["error"]["tot_row"] = count($txtDetail);
                  if (empty($start_date))
                        array_push($data["error"], "txtStartDate");
                  if (empty($end_date))
                        array_push($data["error"], "txtEndDate");
                  if (!empty($start_date) and !empty($end_date) and $tempIdDateWrong === TRUE)
                        array_push($data["error"], "txtWrongDateRange");
                  if ($tempDetail <> "") {
                        array_push($data["error"], "txtDetail");
                        $data["error"]["idItem"] = $tempDetail;
                  }
                  if ($totalNotFeedback >= $this->config->item("max_request_brandcomm"))
                        array_push($data["error"], "txtNotFeedback");
                  if ($feedback == "")
                        array_push($data["error"], "txtFeedback");
            } else {
                  $this->Transaction_Model->transaction_start();
                  try {
                        $feedback = ($feedback == "null") ? "" : $feedback;
                        
                        $update = $this->Brandcomm_Model->updateOrderbrandcomm($no_brandcomm, $start_date, $end_date, $feedback);
                        if ($update !== true)
                              throw new Exception($update);

                        // delete semua paket ads berdasarkan no paketnya
                        $update = $this->Brandcomm_Model->deleteOrderPaketBrancomm($no_brandcomm);
                        if ($update !== true)
                              throw new Exception($update);

                        // insert paket ads yang di request
                        for ($n = 0; $n < count($txtDetail); $n++) {
                              $item_brandcomm_id = $hdItemId[$n]["value"];
                              $detail = $txtDetail[$n]["value"];

                              $update = $this->Brandcomm_Model->insertOrderBrancommDetail($no_brandcomm, $item_brandcomm_id, $detail);
                              if ($update !== true)
                                    throw new Exception($update);
                        }

                        // update kolom done = 'N'
                        $update = $this->Brandcomm_Model->updateStatus("DONE", "N", $no_brandcomm);
                        if ($update !== true)
                              throw new Exception($update);
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
            $no_brandcomm = $arrParam[0];
            $percent = $arrParam[1];

            $update = $this->Brandcomm_Model->progress($no_brandcomm, $percent);

            $data["status"] = $update;

            echo json_encode($data);
            die;
      }

      public function delete() {
            if ($this->_access["delete"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $no_paket = $arrParam[0];

            $delete = $this->Brandcomm_Model->delete($no_paket);

            $data["status"] = $delete;

            echo json_encode($data);
            die;
      }

      // public function get_brandcomm() {
      // $id = $this->input->get("term");
// 		
      // $allSpace = $this->Brandcomm_Model->getbrandcomm($id);
// 		
      // $arrData = array();
      // foreach ($allSpace as $space) {
      // $temp = array(
      // "label"				=>	$space->no_space,
      // "value"				=>	$space->no_space,
      // "agency_id"			=>	$space->agency_id,
      // "agency"			=>	$space->agency,
      // "client_id"			=>	$space->client_id,
      // "client"			=>	$space->client,
      // "is_restrict"		=>	$space->is_restrict,
      // "industry_id"		=>	$space->industry_id,
      // "ae_username"		=>	$space->order_by,
      // "ae_name"			=>	$space->name,
      // );
// 			
      // array_push($arrData, $temp);
      // }
// 		
      // echo json_encode($arrData);
      // die;
      // }
}