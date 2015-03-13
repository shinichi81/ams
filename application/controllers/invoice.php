<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Invoice extends CI_Controller {
      /* Controller ini untuk menampilkan halaman invoice
       * Lokasi: ./application/controllers/invoice.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Invoice_Model", "Transaction_Model"));
            $this->_access = get_access("INVOICE");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "invoice/index";
            $data["menu"] = "order";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Invoice_Model->get($no_paket);
            $allDetail = $this->Invoice_Model->getDetail($no_paket);

            $n = 0;
            $result = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->Invoice_Model->getAds($detail->ads_id);
                  $kanal = $this->Invoice_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->Invoice_Model->getProductgroup($detail->product_group_id);
                  $position = $this->Invoice_Model->getPosition($detail->position_id);

                  $result[$n]["ads"] = $ads->name;
                  $result[$n]["kanal"] = $kanal->name;
                  $result[$n]["product_group"] = $productgroup->name;
                  $result[$n]["position"] = $position->name;
                  $result[$n]["cpm_quota"] = $detail->cpm_quota;
                  $result[$n]["start_date"] = $detail->start_date;
                  $result[$n]["end_date"] = $detail->end_date;
                  $result[$n]["misc_info"] = $detail->misc_info;

                  $n += 1;
            }

            $arrDetail = $result;

            $data["all_data"] = $allData;
            $data["all_detail"] = $arrDetail;
            $data["read"] = $this->_access["read"];

            $this->load->view("invoice/show", $data);
      }

      public function insert_page() {
            $this->load->view("invoice/insert");
      }

      public function update_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->Invoice_Model->get($no_paket);
            
            $data["all_data"] = $allData;
            $data["update"] = $this->_access["update"];

            $this->load->view("invoice/update", $data);
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

            $allData = $this->Invoice_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Invoice_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("invoice/content", $data);
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $no_paket = $arrParam[0];
            $no_invoice = $arrParam[1];
            $jatuh_tempo = $arrParam[2];

                  $this->Transaction_Model->transaction_start();
                  
                  $update = $this->Invoice_Model->update($no_paket, $no_invoice, $jatuh_tempo);

                  $this->Transaction_Model->transaction_complete();
                  
                  $data["status"] = $update;

            echo json_encode($data);
            die;
      }

      public function delete() {
            if ($this->_access["delete"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $id = $arrParam[0];
            
            $delete = $this->Invoice_Model->delete($id);
            
            $data["status"] = $delete;

            echo json_encode($data);
            die;
      }
}