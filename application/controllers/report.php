<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
	/* Controller ini untuk menampilkan halaman report
	 * Lokasi: ./application/controllers/report.php 
	 */
	
	/* load index */
	public function index() {
		$data["page"] = "report/index";
		$data["menu"] = "report";
		
		$this->load->view("template", $data);
	}
	/* end load index */
}