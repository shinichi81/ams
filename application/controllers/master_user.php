<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_User extends CI_Controller {
	/* Controller ini untuk menampilkan halaman master user
	 * Lokasi: ./application/controllers/Master_User.php 
	 */
	private $_access;
	
	public function __construct() {
		parent::__construct();
		check_session(); // jika session habis, redirect ke logout
		$this->load->model("User_Model");
		$this->_access = get_access("USER");
		auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
	}
	
	public function index() {
		$data["page"] = "master/user/index";
		$data["menu"] = "master";
		
		$this->load->view("template", $data);
	}
	
	public function show_page() {
		$id = $this->input->post("id");
		
		$allData = $this->User_Model->getDetail($id);
		
		$data["all_data"] = $allData;
		$data["read"] = $this->_access["read"];
		
		$this->load->view("master/user/show", $data);
	}
	
	public function insert_page() {
		$allDepartment = $this->User_Model->getAllDepartment();		
		$allLevel = $this->User_Model->getAllLevel();
		
		$data["all_department"] = $allDepartment;
		$data["all_level"] = $allLevel;
		$data["create"] = $this->_access["create"];
		
		$this->load->view("master/user/insert", $data);
	}
	
	public function update_page() {
		$id = $this->input->post("id");
		
		$allData = $this->User_Model->get($id);		
		$allDepartment = $this->User_Model->getAllDepartment();		
		$allLevel = $this->User_Model->getAllLevel();
		
		$data["all_data"] = $allData;
		$data["all_department"] = $allDepartment;
		$data["all_level"] = $allLevel;
		$data["update"] = $this->_access["update"];
		
		$this->load->view("master/user/update", $data);
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
		
		$allData = $this->User_Model->getAll($startLimit, $endLimit, $orderBy);
		
		// untuk mendapatkan total page
		$total = $this->User_Model->getTotal($orderBy);
		$totalPage = ceil($total / $this->config->item("show_per_page"));
		
		$data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
		$data["all_data"] = $allData;
		$data["total_page"] = $totalPage;
		$data["page"] = $page + 1;
        $data["order_by"] = $orderBy;
		$data["read"] = $this->_access["read"];
		$data["update"] = $this->_access["update"];
		$data["delete"] = $this->_access["delete"];
		
		$this->load->view("master/user/content", $data);
	}
	
	public function insert() {
		if ($this->_access["create"] <> "Y")
			redirect("dashboard", "refresh");
		
		$arrParam = $this->input->post("arrParam");
		$username = $arrParam[0];
		$password = $arrParam[1];
		$name = $arrParam[2];
		$email = $arrParam[3];
		$department_id = $arrParam[4];
		$level_id = $arrParam[5];
		$arrErr = array();
		
		if (empty($username) or empty($password)) {
			$data["status"] = false;
			$data["error"] = array();
			if (empty($username))
				array_push($data["error"], "txtUsername");
			if (empty($password))
				array_push($data["error"], "txtPassword");
		} else {
			$insert = $this->User_Model->insert($username, $password, $name, $email, $department_id, $level_id);
			
			$data["status"] = $insert;
		}
		
		echo json_encode($data);
		die;
	}
	
	public function update() {
		if ($this->_access["update"] <> "Y")
			redirect("dashboard", "refresh");
		
		$arrParam = $this->input->post("arrParam");
		$username = $arrParam[0];
		$password = $arrParam[1];
		$name = $arrParam[2];
		$email = $arrParam[3];
		$department_id = $arrParam[4];
		$level_id = $arrParam[5];
		
		if ($password == "true")
			$password = $this->config->item("reset_password");
		
		if (empty($username) or empty($password)) {
			$data["status"] = false;
			$data["error"] = array();
			if (empty($username))
				array_push($data["error"], "txtUsername");
			if (empty($password))
				array_push($data["error"], "txtPassword");
		} else {
			$update = $this->User_Model->update($username, $password, $name, $email, $department_id, $level_id);
			
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
		
		$delete = $this->User_Model->delete($id);
		
		$data["status"] = $delete;
		
		echo json_encode($data);
		die;
	}
}