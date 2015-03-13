<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myaccount extends CI_Controller {
	/* Controller ini untuk menampilkan halaman myaccount
	 * Lokasi: ./application/controllers/Myaccount.php 
	 */
	
	public function __construct() {
		parent::__construct();
		check_session(); // jika session habis, redirect ke logout
		$this->load->model("Myaccount_Model");
	}
	
	public function index() {
		if ($this->session->flashdata("isError")) {
			$allData->{"name"} = $this->session->flashdata("name");
			$allData->{"email"} = $this->session->flashdata("email");
		} else
			$allData = $this->Myaccount_Model->get($this->session->userdata("username"));
		
		// if ($this->session->flashdata("isSuccess"))
			// $this->session->sess_destroy();
		
		$data["page"] = "myaccount/index";
		$data["menu"] = "myaccount";
		$data["all_data"] = $allData;
		$data["isError"] = $this->session->flashdata("isError");
		$data["isSuccess"] = $this->session->flashdata("isSuccess");
		
		$this->load->view("template", $data);
	}
	
	public function do_update() {
		if ($this->input->post("btnSubmit")) {
			$username = $this->session->userdata("username");
			$isChange = $this->input->post("chkChange");
			$oldPassword = $this->input->post("txtOldPassword");
			$newPassword = $this->input->post("txtNewPassword");
			$retypePassword = $this->input->post("txtRetypePassword");
			$name = $this->input->post("txtName");
			$email = $this->input->post("txtEmail");
			$validPassword = "false";
			$isError = false;
			
			$this->session->set_flashdata("isError", false);
			
			if ($isChange == "Y") {
				$account = $this->Myaccount_Model->getPassword($username);
				$password = $account->password;
				
				if (($password == md5($oldPassword)) and ($newPassword == $retypePassword))
					$validPassword = $newPassword;
				else
					$isError = true;
			}
			
			if ($isError) {
				$this->session->set_flashdata("isError", true);
				$this->session->set_flashdata("name", $name);
				$this->session->set_flashdata("email", $email);
			} else {
				$update = $this->Myaccount_Model->update($username, $validPassword, $name, $email);
				$this->session->set_flashdata("isSuccess", true);
			}
			
			redirect("myaccount/index", "refresh");
		}
	}
}