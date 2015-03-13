<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer_Position extends CI_Controller {
	/* Controller ini untuk menampilkan halaman order
	 * Lokasi: ./application/controllers/offer_position.php 
	 */
	private $_access;
	
	public function __construct() {
		parent::__construct();
		check_session(); // jika session habis, redirect ke logout
		$this->load->model(array("Offerposition_Model", "Order_Model", "Transaction_Model"));
		$this->_access = get_access("OFFER_POSITION");
		auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
	}
	
	public function index() {
		$data["page"] = "offer_position/index";
		$data["menu"] = "offer_position";
		
		$this->load->view("template", $data);
	}
	
	public function show_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Offerposition_Model->get($id);
		
		$data["all_data"] = $allData;
		$data["read"] = $this->_access["read"];
		
		$this->load->view("offer_position/show", $data);
	}
	
	public function insert_page() {
		$allAds = $this->Order_Model->getAllAds();
		$allKanal = $this->Order_Model->getAllKanal();
		$allProductGroup = $this->Order_Model->getAllProductGroup($allKanal[0]->id);
		$allPosition = $this->Order_Model->getAllPosition($allProductGroup[0]->position_id);
		
		$data["all_ads"] = $allAds;
		$data["all_kanal"] = $allKanal;
		$data["all_productgroup"] = $allProductGroup;
		$data["all_position"] = $allPosition;
		$data["create"] = $this->_access["create"];
		
		$this->load->view("offer_position/insert", $data);
	}
	
	public function update_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Offerposition_Model->get($id);
		$allAds = $this->Order_Model->getAllAds();
		$allKanal = $this->Order_Model->getAllKanal();		
		$allProductGroup = $this->Order_Model->getAllProductGroup($allData->kanal_id);
		
		// untuk mendapatkan list position
		$productGroup = $this->Order_Model->getProductGroup($allData->product_group_id);
		$allPosition = $this->Order_Model->getAllPosition($productGroup->position_id);
		
		$data["all_data"] = $allData;
		$data["all_ads"] = $allAds;
		$data["all_kanal"] = $allKanal;
		$data["all_productgroup"] = $allProductGroup;
		$data["all_position"] = $allPosition;
		$data["update"] = $this->_access["update"];
		
		$this->load->view("offer_position/update", $data);
	}
	
	public function content() {
		$page = $this->input->post("page", 1);
		// $orderBy = $this->input->post("orderby", "ALL");
		
		if ($page < 1)
			$page = 1;
		else
			$page -= 1;
		
		$startLimit = $page * $this->config->item("show_per_page");
		$endLimit = $this->config->item("show_per_page");
		
		$allData = $this->Offerposition_Model->getAll($startLimit, $endLimit);
		
		// untuk mendapatkan total page
		$total = $this->Offerposition_Model->getTotal();
		$totalPage = ceil($total / $this->config->item("show_per_page"));
		
		$data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
		$data["all_data"] = $allData;
		$data["total_page"] = $totalPage;
		$data["page"] = $page + 1;
		// $data["order_by"] = $orderBy;
		$data["read"] = $this->_access["read"];
		$data["update"] = $this->_access["update"];
		$data["delete"] = $this->_access["delete"];
		// $data["progress"] = $this->_access["progress"];
		
		$this->load->view("offer_position/content", $data);
	}
	
	public function insert() {
		if ($this->_access["create"] <> "Y")
			redirect("dashboard", "refresh");
		
		$arrParam = $this->input->post("arrParam");
		$ads_id = $arrParam[0];
		$kanal_id = $arrParam[1];
		$product_group_id = $arrParam[2];
		$position_id = $arrParam[3];
		$dimension = $arrParam[4];
		$txtSize = $arrParam[5];
		$rdbRatePeriod = $arrParam[6];
		$txtGrossRate = $arrParam[7];
		$txtPictureName = image_path("upload/".$arrParam[8]);
		$txtImp = $arrParam[9];
		$txtSov = $arrParam[10];
		
		// if (empty($name)) {
			// $data["status"] = false;
			// $data["error"] = true;
		// } else {			
			$insert = $this->Offerposition_Model->insert($ads_id, $kanal_id, $product_group_id, $position_id, $dimension, $txtSize, $rdbRatePeriod, $txtGrossRate, $txtPictureName, $txtImp, $txtSov);
			
			$data["status"] = $insert;
		// }
		
		echo json_encode($data);
		die;
	}
	
	public function update() {
		if ($this->_access["create"] <> "Y")
			redirect("dashboard", "refresh");
		
		$arrParam = $this->input->post("arrParam");
		$id = $arrParam[0];
		$ads_id = $arrParam[1];
		$kanal_id = $arrParam[2];
		$product_group_id = $arrParam[3];
		$position_id = $arrParam[4];
		$dimension = $arrParam[5];
		$txtSize = $arrParam[6];
		$rdbRatePeriod = $arrParam[7];
		$txtGrossRate = $arrParam[8];
		$txtPictureName = image_path("upload/".$arrParam[9]);
		$txtImp = $arrParam[10];
		$txtSov = $arrParam[11];
		
		// if (empty($name)) {
			// $data["status"] = false;
			// $data["error"] = true;
		// } else {
			$update = $this->Offerposition_Model->update($id, $ads_id, $kanal_id, $product_group_id, $position_id, $dimension, $txtSize, $rdbRatePeriod, $txtGrossRate, $txtPictureName, $txtImp, $txtSov);
			
			$data["status"] = $update;
		// }
		
		echo json_encode($data);
		die;
	}
	
	public function delete() {
		if ($this->_access["delete"] <> "Y")
			redirect("dashboard", "refresh");
		
		$arrParam = $this->input->post("arrParam");
		$no_paket = $arrParam[0];
		
		$delete = $this->Offerposition_Model->delete($no_paket);
		
		$data["status"] = $delete;
		
		echo json_encode($data);
		die;
	}
	
	public function do_upload() {
		$this->load->library("upload");
		
		$dirPath = "./assets/images/upload/";
		
		$config["upload_path"] = $dirPath;
		$config["allowed_types"] = "gif|jpg|png";
		$config["max_size"] = "1024";
		$config["overwrite"] = FALSE;
		
		$this->upload->initialize($config);
		
		if (!$this->upload->do_upload())
			return false;
		
		// untuk mendapatkan filename setelah diupload
		$arrRespond = $this->upload->data();
		$filename = $arrRespond["file_name"];
		
		echo $filename;
		die;
	}
}