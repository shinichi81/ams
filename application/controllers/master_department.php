<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_Department extends CI_Controller {
	/* Controller ini untuk menampilkan halaman master department
	 * Lokasi: ./application/controllers/Master_Department.php 
	 */
	private $_access;
	
	public function __construct() {
		parent::__construct();
		check_session(); // jika session habis, redirect ke logout
		$this->load->model("Department_Model");
		$this->_access = get_access("DEPARTMENT");
		auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
	}
	
	public function index() {
		$data["page"] = "master/department/index";
		$data["menu"] = "master";
		
		$this->load->view("template", $data);
	}
	
	public function show_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Department_Model->get($id);
		
		$data["all_data"] = $allData;
		$data["read"] = $this->_access["read"];
		
		$this->load->view("master/department/show", $data);
	}
	
	public function insert_page() {
		$data["create"] = $this->_access["create"];
		
		$this->load->view("master/department/insert", $data);
	}
	
	public function update_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Department_Model->get($id);
		
		$data["all_data"] = $allData;
		$data["update"] = $this->_access["update"];
		
		$this->load->view("master/department/update", $data);
	}
	
	public function content() {
		$page = $this->input->post("page", 1);
		
		if ($page < 1)
			$page = 1;
		else
			$page -= 1;
			
		$startLimit = $page * $this->config->item("show_per_page");
		$endLimit = $this->config->item("show_per_page");
		
		$allData = $this->Department_Model->getAll($startLimit, $endLimit);
		
		// untuk mendapatkan total page
		$total = $this->Department_Model->getTotal();
		$totalPage = ceil($total / $this->config->item("show_per_page"));
		
		$data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
		$data["all_data"] = $allData;
		$data["total_page"] = $totalPage;
		$data["page"] = $page + 1;
		$data["read"] = $this->_access["read"];
		$data["update"] = $this->_access["update"];
		$data["delete"] = $this->_access["delete"];
		
		$this->load->view("master/department/content", $data);
	}
	
	public function insert() {
		if ($this->_access["create"] <> "Y")
			redirect("dashboard", "refresh");
		
		$arrParam = $this->input->post("arrParam");
		$name = $arrParam[0];
		
		if (empty($name)) {
			$data["status"] = false;
			$data["error"] = true;
		} else {
			$insert = $this->Department_Model->insert($name);
			
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
		
		if (empty($name)) {
			$data["status"] = false;
			$data["error"] = true;
		} else {
			$update = $this->Department_Model->update($id, $name);
			
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
		
		$delete = $this->Department_Model->delete($id);
		
		$data["status"] = $delete;
		
		echo json_encode($data);
		die;
	}
}