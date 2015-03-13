<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Master_Productgroup extends CI_Controller {
      /* Controller ini untuk menampilkan halaman master productgroup
       * Lokasi: ./application/controllers/Master_Productgroup.php 
       */
      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Productgroup_Model", "Transaction_Model"));
            $this->_access = get_access("PRODUKGRUP");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "master/productgroup/index";
            $data["menu"] = "master";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $id = $this->input->post("id");

            $allData = $this->Productgroup_Model->get($id);
            $allCpm = $this->Productgroup_Model->getCpm($id);
            $selectedKanal = $this->Productgroup_Model->getSelectedKanal($allData->kanal_id);
            $selectedRubrik = $this->Productgroup_Model->getSelectedRubrik($allData->rubrik_id);
            $selectedPosition = $this->Productgroup_Model->getSelectedPosition($allData->position_id);
            $selectedHarga = $this->Productgroup_Model->getPositionHarga($allData->kanal_id, $id, $allData->position_id);

            $data["all_data"] = $allData;
            $data["all_cpm"] = $allCpm;
            $data["selected_kanal"] = $selectedKanal;
            $data["selected_rubrik"] = $selectedRubrik;
            $data["selected_position"] = $selectedPosition;
            $data["selected_harga"] = $selectedHarga;
            $data["read"] = $this->_access["read"];

            $this->load->view("master/productgroup/show", $data);
      }

      public function insert_page() {
            $allKanal = $this->Productgroup_Model->getAllKanal();
            $allRubrik = $this->Productgroup_Model->getAllRubrik($allKanal[0]->id);
            $allPosition = $this->Productgroup_Model->getAllPosition();
			$allHarga = $this->Productgroup_Model->getAllHarga($allKanal[0]->id, $allRubrik[0]->id);

            $data["all_kanal"] = $allKanal;
            $data["all_rubrik"] = $allRubrik;
            $data["all_position"] = $allPosition;
            $data["all_harga"] = $allHarga;
            $data["create"] = $this->_access["create"];

            $this->load->view("master/productgroup/insert", $data);
      }

      public function update_page() {
            $id = $this->input->post("id");

            $allData = $this->Productgroup_Model->get($id);
            $allCpm = $this->Productgroup_Model->getCpm($id);
            $allKanal = $this->Productgroup_Model->getAllKanal();
            $allRubrik = $this->Productgroup_Model->getAllRubrik($allData->kanal_id, $allData->rubrik_id);
            $selectedRubrik = $this->Productgroup_Model->getSelectedRubrik($allData->rubrik_id);
            $allPosition = $this->Productgroup_Model->getAllPosition($allData->position_id);
            $selectedPosition = $this->Productgroup_Model->getSelectedPosition($allData->position_id);
            $allHarga = $this->Productgroup_Model->getAllHarga($allData->kanal_id, $allData->rubrik_id, $allData->position_id);
			// $allHarga = $this->Productgroup_Model->getAllHarga($allKanal[0]->id, $allRubrik[0]->id);
            $selectedHarga = $this->Productgroup_Model->getPositionHarga($allData->kanal_id, $id, $allData->position_id);
            
            $arrCpm = array();
            foreach ($allCpm as $cpm)
                  $arrCpm[] = $cpm->position_id;
            
            $data["all_data"] = $allData;
            $data["all_cpm"] = $arrCpm;
            $data["all_kanal"] = $allKanal;
            $data["all_rubrik"] = $allRubrik;
            $data["selected_rubrik"] = $selectedRubrik;
            $data["all_position"] = $allPosition;
            $data["selected_position"] = $selectedPosition;
            $data["all_harga"] = $allHarga;
            $data["selected_harga"] = $selectedHarga;
            $data["update"] = $this->_access["update"];

            $this->load->view("master/productgroup/update", $data);
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

            $allData = $this->Productgroup_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->Productgroup_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("master/productgroup/content", $data);
      }

      public function insert() {
            if ($this->_access["create"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $name = $arrParam[0];
            $misc_info = $arrParam[1];
            $kanal_id = $arrParam[2];
            $rubrik_id = $arrParam[3];
            $position_id = $arrParam[4];
            $cpm = $arrParam[5];

            if (empty($name) or empty($rubrik_id) or empty($position_id)) {
                  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($name))
                        array_push($data["error"], "txtName");
                  if (empty($rubrik_id))
                        array_push($data["error"], "txtRubrik");
                  if (empty($position_id))
                        array_push($data["error"], "txtPosition");
            } else {
                  $this->Transaction_Model->transaction_start();
                  
                  $insert = $this->Productgroup_Model->insert($name, $misc_info, $kanal_id, $rubrik_id, $position_id);

                  $product_group_id = $insert;

                  // INSERT KE TBL_CPM JIKA POSISI ADALAH POSISI CPM
                  for ($n = 0; $n < count($cpm); $n++) {
                        $position_id = $cpm[$n];

                        $insert = $this->Productgroup_Model->insertCpm($kanal_id, $product_group_id, $position_id);
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
            $id = $arrParam[0];
            $name = $arrParam[1];
            $misc_info = $arrParam[2];
            $kanal_id = $arrParam[3];
            $rubrik_id = $arrParam[4];
            $position_id = $arrParam[5];
            $cpm = $arrParam[6];

            if (empty($name) or empty($rubrik_id) or empty($position_id)) {
                  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($name))
                        array_push($data["error"], "txtName");
                  if (empty($rubrik_id))
                        array_push($data["error"], "txtRubrik");
                  if (empty($position_id))
                        array_push($data["error"], "txtPosition");
            } else {
                  $this->Transaction_Model->transaction_start();
                  
                  $update = $this->Productgroup_Model->update($id, $name, $misc_info, $kanal_id, $rubrik_id, $position_id);

                  $product_group_id = $id;
                  
                  // MENDAPATKAN SEMUA DATA CPM_QUOTA SEBELUMNYA
                  $arrCpm = array();
                  $allCpm = $this->Productgroup_Model->getCpm($product_group_id);
                  foreach ($allCpm as $dataCpm)
                        $arrCpm[$dataCpm->kanal_id][$dataCpm->product_group_id][$dataCpm->position_id] = $dataCpm->cpm_quota;
                  
                  // DELETE SEMUA POSISI CPM YANG PRODUCT GROUPNYA YANG LAGI DI EDIT
                  $delete = $this->Productgroup_Model->deleteCpm($product_group_id);

                  // INSERT KE TBL_CPM JIKA POSISI ADALAH POSISI CPM
                  for ($n = 0; $n < count($cpm); $n++) {
                        $position_id = $cpm[$n];
                        $cpm_quota = isset($arrCpm[$kanal_id][$product_group_id][$position_id]) ? $arrCpm[$kanal_id][$product_group_id][$position_id] : 0;
                        
                        $insert = $this->Productgroup_Model->insertCpm($kanal_id, $product_group_id, $position_id, $cpm_quota);
                  }
                  
                  $this->Transaction_Model->transaction_complete();
                  
                  $data["status"] = $update;
            }

            echo json_encode($data);
            die;
      }

      public function delete() {
            if ($this->_access["delete"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $id = $arrParam[0];
            
            $delete = $this->Productgroup_Model->delete($id);
            
            // DELETE SEMUA POSISI CPM YANG PRODUCT GROUPNYA AKAN DIHAPUS
            $delete = $this->Productgroup_Model->deleteCpm($id);

            $data["status"] = $delete;

            echo json_encode($data);
            die;
      }

      public function get_rubrik($kanal_id) {
            $allRubrik = $this->Productgroup_Model->getAllRubrik($kanal_id);

            $data = "";
            foreach ($allRubrik as $rubrik)
                  $data .= "<option value='" . $rubrik->id . "'>" . $rubrik->name . "</option>";

            echo $data;
            die;
      }

      public function get_harga($kanal_id) {
            $allHarga = $this->Productgroup_Model->getAllHarga($kanal_id);

            $data = "";
            foreach ($allHarga as $harga)
                  $data .= "<option value='" . $harga->id_position . "'>Rp. " . number_format($harga->harga, 0,",",".") . "</option>";

            echo $data;
            die;
      }

}