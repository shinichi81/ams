<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Approve_Manager extends CI_Controller {
      /* Controller ini untuk menampilkan halaman po
       * Lokasi: ./application/controllers/po.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Approve_Manager_Model", "Transaction_Model"));
            $this->_access = get_access("APPROVE_MANAGER");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "approve_manager/index";
            $data["menu"] = "order";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Approve_Manager_Model->get($no_paket);
            $allDetail = $this->Approve_Manager_Model->getDetail($no_paket);
        $allProduction = $this->Approve_Manager_Model->getProduction($no_paket);
        $allEvent = $this->Approve_Manager_Model->getEvent($no_paket);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Approve_Manager_Model->getAds($detail->ads_id);
                  $kanal = $this->Approve_Manager_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->Approve_Manager_Model->getProductgroup($detail->product_group_id);
                  $position = $this->Approve_Manager_Model->getPosition($detail->position_id);
                  $harga = $this->Approve_Manager_Model->getHarga($detail->kanal_id,$detail->product_group_id,$detail->position_id);
				  $hari = date_diff(date_create($detail->start_date), date_create($detail->end_date));

                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["misc_info"] = $detail->misc_info;
                  $result[$n]["harga"] = $harga->harga;
                  $result[$n]["total"] = ($hari->days + 1) * $harga->harga;

                  $n += 1;
            }

		$arrProduction = array();
		$m = 0;
		foreach ($allProduction as $production) {
            $prod = $this->Approve_Manager_Model->getSingleProduction($production->production_id);
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

			$data["all_data"] = $allData;
            $data["all_detail"] = $result;
            $data["read"] = $this->_access["read"];

            $this->load->view("approve_manager/show", $data);
      }

      public function insert_page() {
            $this->load->view("approve_manager/insert");
      }

      public function update_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Approve_Manager_Model->get($no_paket);
            
            $data["all_data"] = $allData;
            $data["update"] = $this->_access["update"];

            $this->load->view("approve_manager/update", $data);
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

            $allData = $this->Approve_Manager_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Approve_Manager_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("approve_manager/content", $data);
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $no_paket = $arrParam[0];
            $approve_manager = $arrParam[1];
            $alasan = $arrParam[2];

            $this->Transaction_Model->transaction_start();
                  
			$update = $this->Approve_Manager_Model->update($no_paket, $approve_manager, $alasan);

			$this->Transaction_Model->transaction_complete();
                  
			$data["status"] = $update;

            echo json_encode($data);
            die;
      }
}