<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class PO extends CI_Controller {
      /* Controller ini untuk menampilkan halaman po
       * Lokasi: ./application/controllers/po.php 
       */

      private $_access;

      public function __construct() {
            parent::__construct();
            check_session(); // jika session habis, redirect ke logout
            $this->load->model(array("PO_Model", "Transaction_Model"));
			$this->load->helper(array('form', 'url'));
            $this->_access = get_access("PO");
            auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
      }

      public function index() {
            $data["page"] = "po/index";
            $data["menu"] = "order";

            $this->load->view("template", $data);
      }

      public function show_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->PO_Model->get($no_paket);
            $allDetail = $this->PO_Model->getDetail($no_paket);

            $n = 0;
            $arrDetail = array();
            foreach ($allDetail as $detail) {
                  $ads = $this->PO_Model->getAds($detail->ads_id);
                  $kanal = $this->PO_Model->getKanal($detail->kanal_id);
                  $productgroup = $this->PO_Model->getProductgroup($detail->product_group_id);
                  $position = $this->PO_Model->getPosition($detail->position_id);
                  $harga = $this->PO_Model->getHarga($detail->kanal_id,$detail->product_group_id,$detail->position_id);
				  $hari = date_diff(date_create($detail->start_date), date_create($detail->end_date));

                  $arrDetail[$n]["ads"] = $ads->name;
                  $arrDetail[$n]["kanal"] = $kanal->name;
                  $arrDetail[$n]["product_group"] = $productgroup->name;
                  $arrDetail[$n]["position"] = $position->name;
                  $arrDetail[$n]["cpm_quota"] = $detail->cpm_quota;
                  $arrDetail[$n]["start_date"] = $detail->start_date;
                  $arrDetail[$n]["end_date"] = $detail->end_date;
                  $arrDetail[$n]["misc_info"] = $detail->misc_info;
                  $arrDetail[$n]["harga"] = $harga->harga;
                  $arrDetail[$n]["total"] = ($hari->days + 1) * $harga->harga;

                  $n += 1;
            }

            $data["all_data"] = $allData;
            $data["all_detail"] = $arrDetail;
            $data["read"] = $this->_access["read"];

            $this->load->view("po/show", $data);
      }

      public function insert_page() {
            $this->load->view("po/insert");
      }

      public function update_page() {
            $no_paket = $this->input->post("id");

            $allData = $this->PO_Model->get($no_paket);
            
            $data["all_data"] = $allData;
            $data["update"] = $this->_access["update"];

            $this->load->view("po/update", $data);
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

            $allData = $this->PO_Model->getAll($startLimit, $endLimit, $orderBy);

            // untuk mendapatkan total page
            $total = $this->PO_Model->getTotal($orderBy);
            $totalPage = ceil($total / $this->config->item("show_per_page"));

            $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
            $data["all_data"] = $allData;
            $data["total_page"] = $totalPage;
            $data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
            $data["read"] = $this->_access["read"];
            $data["update"] = $this->_access["update"];
            $data["delete"] = $this->_access["delete"];

            $this->load->view("po/content", $data);
      }

      public function update() {
            if ($this->_access["update"] <> "Y")
                  redirect("dashboard", "refresh");

            $arrParam = $this->input->post("arrParam");
            $no_paket = $arrParam[0];
            $no_po = $arrParam[1];
            $no_so = $arrParam[2];
            // $bukti = $arrParam[3];
			$bukti = image_path("upload/".$arrParam[3]);

            $this->Transaction_Model->transaction_start();
                  
			$update = $this->PO_Model->update($no_paket, $no_po, $no_so, $bukti);

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
            
            $delete = $this->PO_Model->delete($id);
            
            $data["status"] = $delete;

            echo json_encode($data);
            die;
      }
	  
	  public function do_upload() {
        if($this->input->post('upload')){
			$this->load->library("upload");
			
			$dirPath = "./assets/images/upload/";
			
			$config["upload_path"] = $dirPath;
			$config["allowed_types"] = "gif|jpg|jpeg|png";
			$config["max_size"] = "2048";
			$config["overwrite"] = FALSE;
			$config["remove_spaces"] = TRUE;
			
			$this->upload->initialize($config);
			
			if($this->upload->do_multi_upload("bukti")){
                
                $data['upload_data'] = $this->upload->get_multi_upload_data();
                
                echo '<p class = "bg-success">' . count($data['upload_data']) . 'File(s) successfully uploaded.</p>';
                
            } else {    
                // Output the errors
                $errors = array('error' => $this->upload->display_errors('<p class = "bg-danger">', '</p>'));               
            
                foreach($errors as $k => $error){
                    echo $error;
                }
                
            }
			
			// if (!$this->upload->do_upload())
				// return false;
			
			// untuk mendapatkan filename setelah diupload
			// $arrRespond = $this->upload->data();
			// $filename = $arrRespond["file_name"];
			
			// echo $filename;
			// die;
		}
	  }
}