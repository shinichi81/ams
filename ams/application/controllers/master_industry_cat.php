<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Master_Industry_Cat extends CI_Controller {
      /* Controller ini untuk menampilkan halaman master industry_cat
       * Lokasi: ./application/controllers/Master_Industry_Cat.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("Industry_Cat_Model", "Transaction_Model"));
            $this->_access = get_access("PRODUKGRUP");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "master/industry_cat/index";
            $data["menu"] = "master";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $id = $this->input->post("id");

            $allData = $this->Industry_Cat_Model->get($id);
            $selectedSubIndustry = $this->Industry_Cat_Model->getSelectedSubIndustry($allData->subindustry_id);

            $data["all_data"] = $allData;
            $data["selected_subindustry"] = $selectedSubIndustry;
            $data["read"] = $this->_access["read"];

            $this->load->view("master/industry_cat/show", $data);
      }

      public function insert_page() {
            $allSubIndustry = $this->Industry_Cat_Model->getAllSubIndustry();

            $data["all_subindustry"] = $allSubIndustry;
            $data["create"] = $this->_access["create"];

            $this->load->view("master/industry_cat/insert", $data);
      }

      public function update_page() {
            $id = $this->input->post("id");

            $allData = $this->Industry_Cat_Model->get($id);
            $allSubIndustry = $this->Industry_Cat_Model->getAllSubIndustry($allData->subindustry_id);
            $selectedSubIndustry = $this->Industry_Cat_Model->getSelectedSubIndustry($allData->subindustry_id);
            
            $data["all_data"] = $allData;
            $data["all_subindustry"] = $allSubIndustry;
            $data["selected_subindustry"] = $selectedSubIndustry;
            $data["update"] = $this->_access["update"];

            $this->load->view("master/industry_cat/update", $data);
      }

      public function content() {
            $page = $this->input->post("page", 1);

            if ($page < 1)
                  $page = 1;
            else
                  $page -= 1;

            $startLimit = $page * $this->config->item("show_per_page");
            $endLimit = $this->config->item("show_per_page");

            $allData = $this->Industry_Cat_Model->getAll($startLimit, $endLimit);

            // untuk mendapatkan total page
            $total = $this->Industry_Cat_Model->getTotal();
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("master/industry_cat/content", $data);
      }

      public function insert() {
            if ($this->_access["create"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $name = $arrParam[0];
            $subindustry_id = $arrParam[1];

            if (empty($name) or empty($subindustry_id)) {
                  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($name))
                        array_push($data["error"], "txtName");
                  if (empty($subindustry_id))
                        array_push($data["error"], "txtSubIndustry");
            } else {
                  $insert = $this->Industry_Cat_Model->insert($name, $subindustry_id);

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
            $subindustry_id = $arrParam[2];

            if (empty($name) or empty($subindustry_id)) {
				  $data["status"] = false;
                  $data["error"] = array();
                  if (empty($name))
                        array_push($data["error"], "txtName");
                  if (empty($subindustry_id))
                        array_push($data["error"], "txtSubIndustry");
            } else {
                  $update = $this->Industry_Cat_Model->update($id, $name, $subindustry_id);
                  
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
            
            $delete = $this->Industry_Cat_Model->delete($id);

            $data["status"] = $delete;

            echo json_encode($data);
            die;
      }
}