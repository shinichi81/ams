<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_Model extends CI_Model {
	public function transaction_start() {
		$this->db->trans_start();
	}
	
	public function transaction_complete() {
		$this->db->trans_complete();
	}
}	