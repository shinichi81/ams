<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_Harga extends CI_Controller {
	/* Controller ini untuk menampilkan halaman master harga
	 * Lokasi: ./application/controllers/Master_Harga.php 
	 */
	private $_access;
	
	public function __construct() {
		parent::__construct();
		check_session(); // jika session habis, redirect ke logout
		$this->load->model("Harga_Model");
		$this->_access = get_access("HARGA");
		auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
	}
	
	public function index() {
		$data["page"] = "master/harga/index";
		$data["menu"] = "master";
		
		$this->load->view("template", $data);
	}
	
	public function show_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Harga_Model->get($id);
		
		$data["all_data"] = $allData;
		$data["read"] = $this->_access["read"];
		
		$this->load->view("master/harga/show", $data);
	}
	
	public function insert_page() {
		$allKanal = $this->Harga_Model->getAllKanal();
		$allProduk = $this->Harga_Model->getAllProduk();
		$allPosition = $this->Harga_Model->getAllPosition();
		// $allHarga = $this->Harga_Model->getAllHarga($allKanal[0]->id, $allRubrik[0]->id);

		$data["all_kanal"] = $allKanal;
		$data["all_position"] = $allPosition;
		$data["all_produk"] = $allProduk;
		// $data["all_harga"] = $allHarga;
		$data["create"] = $this->_access["create"];
		
		$this->load->view("master/harga/insert", $data);
	}
	
	public function update_page() {
		$id = $this->input->post("id");
		
		$allData = $this->Harga_Model->get($id);
		$allKanal = $this->Harga_Model->getAllKanal();
		$allProduk = $this->Harga_Model->getAllProduk($allData->id_kanal, $allData->id_product);
		$allPosition = $this->Harga_Model->getAllPosition();
		
		$data["all_data"] = $allData;
		$data["all_kanal"] = $allKanal;
		$data["all_produk"] = $allProduk;
		$data["all_position"] = $allPosition;
		$data["update"] = $this->_access["update"];
		
		$this->load->view("master/harga/update", $data);
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
		
		$allData = $this->Harga_Model->getAll($startLimit, $endLimit, $orderBy);
		
		// untuk mendapatkan total page
		$total = $this->Harga_Model->getTotal($orderBy);
		$totalPage = ceil($total / $this->config->item("show_per_page"));
		
		$data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
		$data["all_data"] = $allData;
		$data["total_page"] = $totalPage;
		$data["page"] = $page + 1;
        $data["order_by"] = $orderBy;
		$data["read"] = $this->_access["read"];
		$data["update"] = $this->_access["update"];
		$data["delete"] = $this->_access["delete"];
		
		$this->load->view("master/harga/content", $data);
	}
	
	public function insert() {
		if ($this->_access["create"] <> "Y")
			redirect("dashboard", "refresh");
		
		$arrParam = $this->input->post("arrParam");
		$id_kanal = $arrParam[0];
		$id_produk = $arrParam[1];
		$id_position = $arrParam[2];
		$harga = $arrParam[3];
		
		if (empty($id_kanal) or empty($id_position)) {
			$data["status"] = false;
			$data["error"] = true;
		} else {
			$insert = $this->Harga_Model->insert($id_kanal, $id_produk, $id_position, $harga);
			
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
		$id_kanal = $arrParam[1];
		$id_produk = $arrParam[2];
		$id_position = $arrParam[3];
		$harga = $arrParam[4];
		
		if (empty($nama) or empty($harga)) {
			$data["status"] = false;
			$data["error"] = true;
		} else {
			$update = $this->Harga_Model->update($id, $id_kanal, $id_produk, $id_position, $harga);
			
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
		
		$delete = $this->Harga_Model->delete($id);
		
		$data["status"] = $delete;
		
		echo json_encode($data);
		die;
	}		
}