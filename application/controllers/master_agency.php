<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_Agency extends CI_Controller {
	/* Controller ini untuk menampilkan halaman master agency
	 * Lokasi: ./application/controllers/Master_Agency.php 
	 */
	private $_access;
	
	public function __construct() {
		parent::__construct();
		check_session(); // jika session habis, redirect ke logout
		$this->load->model("Agency_Model");
		$this->_access = get_access("AGENCY");
		auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
	}
	
	public function index() {
		$data["page"] = "master/agency/index";
		$data["menu"] = "master";
		
		$this->load->view("template", $data);
	}
	
	public function show_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Agency_Model->get($id);
		
		$data["all_data"] = $allData;
		$data["read"] = $this->_access["read"];
		
		$this->load->view("master/agency/show", $data);
	}
	
	public function insert_page() {
		$data["create"] = $this->_access["create"];
		
		$this->load->view("master/agency/insert", $data);
	}
	
	public function update_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Agency_Model->get($id);
		
		$data["all_data"] = $allData;
		$data["update"] = $this->_access["update"];
		
		$this->load->view("master/agency/update", $data);
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
		
		$allData = $this->Agency_Model->getAll($startLimit, $endLimit, $orderBy);
		
		// untuk mendapatkan total page
		$total = $this->Agency_Model->getTotal($orderBy);
		$totalPage = ceil($total / $this->config->item("show_per_page"));
		
		$data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
		$data["all_data"] = $allData;
		$data["total_page"] = $totalPage;
		$data["page"] = $page + 1;
            $data["order_by"] = $orderBy;
		$data["read"] = $this->_access["read"];
		$data["update"] = $this->_access["update"];
		$data["delete"] = $this->_access["delete"];
		
		$this->load->view("master/agency/content", $data);
	}
	
	public function insert() {
		if ($this->_access["create"] <> "Y")
			redirect("dashboard", "refresh");
		
		$arrParam = $this->input->post("arrParam");
		$name = $arrParam[0];
		$address = $arrParam[1];
		$contact = $arrParam[2];
		
		if (empty($name)) {
			$data["status"] = false;
			$data["error"] = true;
		} else {
			$insert = $this->Agency_Model->insert($name, $address, $contact);
			
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
		$address = $arrParam[2];
		$contact = $arrParam[3];
		
		if (empty($name)) {
			$data["status"] = false;
			$data["error"] = true;
		} else {
			$update = $this->Agency_Model->update($id, $name, $address, $contact);
			
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
		
		$delete = $this->Agency_Model->delete($id);
		
		$data["status"] = $delete;
		
		echo json_encode($data);
		die;
	}
}