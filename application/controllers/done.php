<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Done extends CI_Controller {
      /* Controller ini untuk menampilkan halaman done
       * Lokasi: ./application/controllers/Done.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model("Done_Model");
            $this->_access = get_access("ORDER_RECEIVE");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "done/index";
            $data["menu"] = "order";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Done_Model->get($no_paket);
            $allDetail = $this->Done_Model->getDetail($no_paket);
			$allProduction = $this->Done_Model->getProduction($no_paket);
			$allEvent = $this->Done_Model->getEvent($no_paket);
			$nameCatIndustry = $this->Done_Model->getNameCatIndustry($allData->industrycat_id);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Done_Model->getAds($detail->ads_id);
                  $kanal = $this->Done_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->Done_Model->getProductgroup($detail->product_group_id);
                  $position = $this->Done_Model->getPosition($detail->position_id);
                  $harga = $this->Done_Model->getHarga($detail->kanal_id,$detail->product_group_id,$detail->position_id);
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
                  $result[$n]["harga"] = $harga->harga;
                  $result[$n]["total"] = ($hari->days + 1) * $harga->harga;

                  $n += 1;
            }

		$arrProduction = array();
		$m = 0;
		foreach ($allProduction as $production) {
            $prod = $this->Done_Model->getSingleProduction($production->production_id);
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
            $data["read"] = $this->_access["read"];

            $this->load->view("done/show", $data);
      }

      public function insert_page() {
            $this->load->view("done/insert");
      }

      public function update_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Done_Model->get($no_paket);
            $allDetail = $this->Done_Model->getDetail($no_paket);
			$allProduction = $this->Done_Model->getProduction($no_paket);
			$allEvent = $this->Done_Model->getEvent($no_paket);
			$nameCatIndustry = $this->Done_Model->getNameCatIndustry($allData->industrycat_id);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Done_Model->getAds($detail->ads_id);
                  $kanal = $this->Done_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->Done_Model->getProductgroup($detail->product_group_id);
                  $position = $this->Done_Model->getPosition($detail->position_id);
                  $harga = $this->Done_Model->getHarga($detail->kanal_id,$detail->product_group_id,$detail->position_id);
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
                  $result[$n]["harga"] = $harga->harga;
                  $result[$n]["total"] = ($hari->days + 1) * $harga->harga;

                  $n += 1;
            }

		$arrProduction = array();
		$m = 0;
		foreach ($allProduction as $production) {
            $prod = $this->Done_Model->getSingleProduction($production->production_id);
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

            $this->load->view("done/update", $data);
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

            $this->load->view("done/update_brandcomm", $data);
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

            $allData = $this->Done_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Done_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];

            $this->load->view("done/content", $data);
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

            $this->load->view("done/content_brandcomm", $data);
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $no_paket = $arrParam[0];
            $no_paket_user = $arrParam[1];

            if (empty($no_paket) or empty($no_paket_user)) {
                  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($no_paket))
                        array_push($data["error"], "txtNoPaket");
                  if (empty($no_paket_user))
                        array_push($data["error"], "txtNoPaketUser");
            } else {
                  $update = $this->Done_Model->update($no_paket, $no_paket_user);

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

            $update = $this->Brandcomm_Model->updateStatus("DONE", "Y", $no_brandcomm);
            $update = $this->Brandcomm_Model->updateStatus("ENABLE_FEEDBACK", "Y", $no_brandcomm);

            $data["status"] = $update;

            echo json_encode($data);
            die;
      }

}