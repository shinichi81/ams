<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeline extends CI_Controller {
	/* Controller ini untuk menampilkan halaman timeline
	 * Lokasi: ./application/controllers/Timeline.php 
	 */
	private $_access;
	
	public function __construct() {
		parent::__construct();
		check_session(); // jika session habis, redirect ke logout
		$this->load->model("Timeline_Model");
		$this->_access = get_access("TIMELINE");
		auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
	}
	
	public function index() {
		if ($this->input->post("btnSubmit")) {
			$selected_kanal = $this->input->post("selectKanal");
			$selected_product_group = $this->input->post("selectProductGroup");
			
			$allKanal = $this->Timeline_Model->getAllKanal();
			$allProductgroup = $this->Timeline_Model->getAllProductgroup($selected_kanal);
			
			// untuk mencari posisi dari produk grup yang dipilih
			$productgroup = $this->Timeline_Model->getProductgroup($selected_product_group);			
			$allPosition = $this->Timeline_Model->getAllPosition($productgroup->position_id);
		} else {			
			$allKanal = $this->Timeline_Model->getAllKanal();
			$allProductgroup = $this->Timeline_Model->getAllProductgroup($allKanal[0]->id);
			$allPosition = $this->Timeline_Model->getAllPosition($allProductgroup[0]->position_id);
			
			$selected_kanal = $allKanal[0]->id;
			$selected_product_group = $allProductgroup[0]->id;
		}
		
		$data["page"] = "timeline/index";
		$data["menu"] = "timeline";
		$data["all_kanal"] = $allKanal;
		$data["selected_kanal"] = $selected_kanal;
		$data["all_product_group"] = $allProductgroup;
		$data["selected_product_group"] = $selected_product_group;
		$data["all_position"] = $allPosition;
		$data["read"] = $this->_access["read"];
		
		$this->load->view("template", $data);
	}	
	
	public function show_timeline($kanal_id, $product_group_id, $position_id) {
		$data["kanal_id"] = $kanal_id;
		$data["product_group_id"] = $product_group_id;
		$data["position_id"] = $position_id;
		
		$this->load->view("timeline/show", $data);
	}
	
	public function get_data($kanal_id, $product_group_id, $position_id) {
		// ambil data paket yang statusnya sudah closing maupun yang statusnya masih booking
		$allPaket = $this->Timeline_Model->getDataPaket($kanal_id, $product_group_id, $position_id);
				
		// $data["dateTimeFormat"] = "iso8601";
		// $data["wikiURL"] = "http://simile.mit.edu/shelf/";
		// $data["wikiSection"] = "Simile Cubism Timeline";
		
		$data["events"] = array();
		foreach ($allPaket as $paket) {
			if ($paket->approve == "Y") {
				$status = "Closing";
				$color = "#FFDE00"; // orange
			} else {
				$status = "Booking";
				$color = "#12FF00"; // green
			}
			
			$start_date = format_date_timeline($paket->start_date);
			$end_date = format_date_timeline($paket->end_date);
			$description = "[ ".$status ." ]<br>".
						   "Sales : ". $paket->sales ."<br>".
						   "Agency : ". $paket->agency ."<br>".
						   "Client : ". $paket->client ."<br>".
						   "Budget : ". $paket->budget ."<br>".
						   "Diskon : ". $paket->diskon ."<br>".
						   "Benefit : ". $paket->benefit ."<br>".
						   "Imps Quota/Day: ". $paket->cpm_quota ."<br>".
						   "Tanggal : ". format_date($paket->start_date, TRUE) ." - ". format_date($paket->end_date, TRUE);
			
			$arrData = array (
				"start"			=>	$start_date,
				"title"			=>	"",
				"end"			=>	$end_date,
				"description"	=>	$description,
				"color"			=>	$color,
			);
			
			array_push($data["events"], $arrData);
		}
		
		// ambil data space yang belum booking di paket
		$allSpace = $this->Timeline_Model->getDataSpace($kanal_id, $product_group_id, $position_id);
		foreach ($allSpace as $space) {
			$start_date = format_date_timeline($space->start_date);
			$end_date = format_date_timeline($space->end_date);
			$description = "[ Booking ]<br>".
						   "Sales : ". $space->sales ."<br>".
						   "Agency : ". $space->agency ."<br>".
						   "Client : ". $space->client ."<br>".
						   "Tanggal : ". format_date($space->start_date, TRUE) ." - ". format_date($space->end_date, TRUE);
			
			$arrData = array (
				"start"			=>	$start_date,
				"title"			=>	"",
				"end"			=>	$end_date,
				"description"	=>	$description,
				"color"			=>	"#12FF00",  // green
			);
			
			array_push($data["events"], $arrData);
		}
		
		echo json_encode($data);
		die;
	}
	
	public function get_product_group($kanal_id) {
		$allProductGroup = $this->Timeline_Model->getAllProductgroup($kanal_id);
		
		$data = "";
		foreach ($allProductGroup as $productGroup)
			$data .= "<option value='".$productGroup->id."'>".$productGroup->name."</option>";
		
		echo $data;
		die;
	}
}