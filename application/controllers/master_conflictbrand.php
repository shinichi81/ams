<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_Conflictbrand extends CI_Controller {
	/* Controller ini untuk menampilkan halaman master conflict brand
	 * Lokasi: ./application/controllers/Master_Conflictbrand.php 
	 */
	private $_access;
	
	public function __construct() {
		parent::__construct();
		check_session(); // jika session habis, redirect ke logout
		$this->load->model("Conflictbrand_Model");
		$this->_access = get_access("CONFLICTBRAND");
		auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
	}
	
	public function index() {
		$data["page"] = "master/conflictbrand/index";
		$data["menu"] = "master";
		
		$this->load->view("template", $data);
	}
	
	public function show_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Conflictbrand_Model->get($id);
		
		$selectedIndustry = $this->Conflictbrand_Model->getIndustry($allData->industry_id);
		$selectedKanal = $this->Conflictbrand_Model->getKanal($allData->kanal_id);
		$selectedProductgroup = $this->Conflictbrand_Model->getProductgroup($allData->product_group_id);
		
		/* untuk mengambil nama posisi dari rule */
		$tempRuleName = "";
		$idNotIn = "";
		$allRuleName = array();
		$allRule = explode(":", $allData->position_id);
		foreach ($allRule as $position_id) {
			$tempRuleName = "";
			$idNotIn .= $position_id .",";
			
			$arrPosition = $this->Conflictbrand_Model->getAllPosition($position_id);
			foreach ($arrPosition as $position)
				$tempRuleName .= $position->name .",";			
			$tempRuleName = substr($tempRuleName, 0, -1); // untuk menghilangkan "," dibelakang
			array_push($allRuleName, $tempRuleName);			
		}

		$idNotIn = substr($idNotIn, 0, -1); // untuk menghilangkan "," dibelakang
		$productGroup = $this->Conflictbrand_Model->getProductgroup($allData->product_group_id);
		$allPosition = $this->Conflictbrand_Model->getAllPosition($productGroup->position_id, $idNotIn);
		
		$data["all_data"] = $allData;
		$data["all_rule_name"] = $allRuleName;
		$data["selected_industry"] = $selectedIndustry;
		$data["selected_kanal"] = $selectedKanal;
		$data["selected_product_group"] = $selectedProductgroup;
		$data["all_position"] = $allPosition;
		$data["read"] = $this->_access["read"];
		
		$this->load->view("master/conflictbrand/show", $data);
	}
	
	public function insert_page() {
		$allIndustry = $this->Conflictbrand_Model->getAllIndustry();
		$allKanal = $this->Conflictbrand_Model->getAllKanal();		
		$allProductgroup = $this->Conflictbrand_Model->getAllProductgroup($allKanal[0]->id);
		
		$position_id = (!empty($allProductgroup[0]->position_id)) ? $allProductgroup[0]->position_id : "''";
		$allPosition = $this->Conflictbrand_Model->getAllPosition($position_id);
		
		$data["all_industry"] = $allIndustry;
		$data["all_kanal"] = $allKanal;
		$data["all_productgroup"] = $allProductgroup;
		$data["all_position"] = $allPosition;
		$data["create"] = $this->_access["create"];
		
		$this->load->view("master/conflictbrand/insert", $data);
	}
	
	public function update_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Conflictbrand_Model->get($id);
		$allIndustry = $this->Conflictbrand_Model->getAllIndustry();
		$allKanal = $this->Conflictbrand_Model->getAllKanal();
		$allProductgroup = $this->Conflictbrand_Model->getAllProductgroup($allData->kanal_id);
		
		/* untuk mengambil nama posisi dari rule */
		$tempRuleName = "";
		$idNotIn = "";
		$allRuleName = array();
		$allRule = explode(":", $allData->position_id);
		foreach ($allRule as $position_id) {
			$tempRuleName = "";
			$idNotIn .= $position_id .",";
			
			$arrPosition = $this->Conflictbrand_Model->getAllPosition($position_id);
			foreach ($arrPosition as $position)
				$tempRuleName .= $position->name .",";			
			$tempRuleName = substr($tempRuleName, 0, -1); // untuk menghilangkan "," dibelakang
			array_push($allRuleName, $tempRuleName);			
		}

		$idNotIn = substr($idNotIn, 0, -1); // untuk menghilangkan "," dibelakang
		$productGroup = $this->Conflictbrand_Model->getProductgroup($allData->product_group_id);
		$allPosition = $this->Conflictbrand_Model->getAllPosition($productGroup->position_id);
		//$allPosition = $this->Conflictbrand_Model->getAllPosition($productGroup->position_id, $idNotIn);		
		
		$data["all_data"] = $allData;
		$data["all_rule"] = $allRule;
		$data["all_rule_name"] = $allRuleName;
		$data["all_industry"] = $allIndustry;
		$data["all_kanal"] = $allKanal;
		$data["all_product_group"] = $allProductgroup;
		$data["all_position"] = $allPosition;
		$data["update"] = $this->_access["update"];
		
		$this->load->view("master/conflictbrand/update", $data);
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
		
		$allData = $this->Conflictbrand_Model->getAll($startLimit, $endLimit, $orderBy);
		
		// untuk mendapatkan total page
		$total = $this->Conflictbrand_Model->getTotal($orderBy);
		$totalPage = ceil($total / $this->config->item("show_per_page"));
		
		$data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
		$data["all_data"] = $allData;
		$data["total_page"] = $totalPage;
		$data["page"] = $page + 1;
        $data["order_by"] = $orderBy;
		$data["read"] = $this->_access["read"];
		$data["update"] = $this->_access["update"];
		$data["delete"] = $this->_access["delete"];
		
		$this->load->view("master/conflictbrand/content", $data);
	}
	
	public function insert() {
		if ($this->_access["create"] <> "Y")
			redirect("dashboard", "refresh");
		
		$arrParam = $this->input->post("arrParam");
		$industry_id = $arrParam[0];
		$kanal_id = $arrParam[1];
		$product_group_id = $arrParam[2];
		$allRule = $arrParam[3];
		$position_id = "";
		$isEmpty = false;
		
		if (!empty($allRule)) {
			for ($n=0; $n<count($allRule); $n++) {
				if (empty($allRule[$n])) {
					$isEmpty = true;
					break;
				}
			}
		}
		
		if (empty($allRule) or $isEmpty) {
			$data["status"] = false;
			$data["error"] = array();
			if (empty($allRule))
				array_push($data["error"], "txtRule");
			if ($isEmpty)
				array_push($data["error"], "txtEmpty");
		} else {
			foreach ($allRule as $rule)
				$position_id .= $rule .":";
				
			$position_id = substr($position_id, 0, -1); // untuk menghilangkan ":" dibelakang
			
			$insert = $this->Conflictbrand_Model->insert($industry_id, $kanal_id, $product_group_id, $position_id);
			
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
		$industry_id = $arrParam[1];
		$kanal_id = $arrParam[2];
		$product_group_id = $arrParam[3];
		$allRule = $arrParam[4];
		$position_id = "";
		$isEmpty = false;
		
		if (!empty($allRule)) {
			for ($n=0; $n<count($allRule); $n++) {
				if (empty($allRule[$n])) {
					$isEmpty = true;
					break;
				}
			}
		}
		
		if (empty($allRule) or $isEmpty) {
			$data["status"] = false;
			$data["error"] = array();
			if (empty($allRule))
				array_push($data["error"], "txtRule");
			if ($isEmpty)
				array_push($data["error"], "txtEmpty");
		} else {
			foreach ($allRule as $rule)
				$position_id .= $rule .":";
				
			$position_id = substr($position_id, 0, -1); // untuk menghilangkan ":" dibelakang
			
			$update = $this->Conflictbrand_Model->update($id, $industry_id, $kanal_id, $product_group_id, $position_id);
			
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
		
		$delete = $this->Conflictbrand_Model->delete($id);
		
		$data["status"] = $delete;
		
		echo json_encode($data);
		die;
	}
	
	public function get_product_group($kanal_id) {
		$allProductGroup = $this->Conflictbrand_Model->getAllProductgroup($kanal_id);
		
		$data = "";
		foreach ($allProductGroup as $productGroup)
			$data .= "<option value='".$productGroup->id."'>".$productGroup->name."</option>";
		
		echo $data;
		die;
	}
	
	public function get_position($id) {
		$productGroup = $this->Conflictbrand_Model->getProductgroup($id);
		$allPosition = $this->Conflictbrand_Model->getAllPosition($productGroup->position_id);
		
		$data = "";
		foreach ($allPosition as $position)
			$data .= "<option value='".$position->id."'>".$position->name."</option>";
		
		echo $data;
		die;
	}
}