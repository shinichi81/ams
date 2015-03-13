<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_Kanal extends CI_Controller {
	/* Controller ini untuk menampilkan halaman master kanal
	 * Lokasi: ./application/controllers/Master_Kanal.php 
	 */
	private $_access;
	
	public function __construct() {
		parent::__construct();
		check_session(); // jika session habis, redirect ke logout
		$this->load->model(array("Kanal_Model", "Transaction_Model"));
		$this->_access = get_access("KANAL");
		auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
	}
	
	public function index() {
		$data["page"] = "master/kanal/index";
		$data["menu"] = "master";
		
		$this->load->view("template", $data);
	}
	
	public function show_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Kanal_Model->get($id);		
		$allRubrik = $this->Kanal_Model->getRubrik($id);
		
		$data["all_data"] = $allData;
		$data["all_rubrik"] = $allRubrik;
		$data["read"] = $this->_access["read"];
		
		$this->load->view("master/kanal/show", $data);
	}
	
	public function insert_page() {
		$data["create"] = $this->_access["create"];
		
		$this->load->view("master/kanal/insert", $data);
	}
	
	public function update_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Kanal_Model->get($id);		
		$allRubrik = $this->Kanal_Model->getRubrik($id);
		
		$data["all_data"] = $allData;
		$data["all_rubrik"] = $allRubrik;
		$data["update"] = $this->_access["update"];
		
		$this->load->view("master/kanal/update", $data);
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
		
		$allData = $this->Kanal_Model->getAll($startLimit, $endLimit, $orderBy);
		
		// untuk mendapatkan total page
		$total = $this->Kanal_Model->getTotal($orderBy);
		$totalPage = ceil($total / $this->config->item("show_per_page"));
		
		$data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
		$data["all_data"] = $allData;
		$data["total_page"] = $totalPage;
		$data["page"] = $page + 1;
        $data["order_by"] = $orderBy;
		$data["read"] = $this->_access["read"];
		$data["update"] = $this->_access["update"];
		$data["delete"] = $this->_access["delete"];
		
		$this->load->view("master/kanal/content", $data);
	}
	
	public function insert() {
		if ($this->_access["create"] <> "Y")
			redirect("dashboard", "refresh");
		
		$arrParam = $this->input->post("arrParam");
		$name = $arrParam[0];
		$allRubrik = $arrParam[1];
		$rubrik = true;
		
		for ($n=0; $n<count($allRubrik); $n++) {
			if (empty($allRubrik[$n])) {
				$rubrik = false;
				break;
			}
		}
		
		if (empty($name) or !$rubrik) {
			$data["status"] = false;
			$data["error"] = array();
			if (empty($name))
				array_push($data["error"], "txtName");
			if (!$rubrik)
				array_push($data["error"], "txtRubrik");
		} else {
			$this->Transaction_Model->transaction_start();
			$insert = $this->Kanal_Model->insert($name);
			
			$kanal_id = $insert;
			foreach ($allRubrik as $rubrik)
				$insert = $this->Kanal_Model->insertRubrik($rubrik, $kanal_id);
			
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
		$allRubrik = $arrParam[2];
		$rubrik = true;
		
		for ($n=0; $n<count($allRubrik); $n++) {
			if (empty($allRubrik[$n])) {
				$rubrik = false;
				break;
			}
		}
		
		if (empty($name) or !$rubrik) {
			$data["status"] = false;
			$data["error"] = array();
			if (empty($name))
				array_push($data["error"], "txtName");
			if (!$rubrik)
				array_push($data["error"], "txtRubrik");
		} else {
			$this->Transaction_Model->transaction_start();
			$update = $this->Kanal_Model->update($id, $name);
			
			$kanal_id = $id;
			$update = $this->Kanal_Model->deleteRubrik($kanal_id);
			
			foreach ($allRubrik as $rubrik)
				$update = $this->Kanal_Model->insertRubrik($rubrik, $kanal_id);
			
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
		
		$delete = $this->Kanal_Model->delete($id);
		
		$data["status"] = $delete;
		
		echo json_encode($data);
		die;
	}
}