<?php

class js_load extends CI_Controller {
	
	function get_price_position(){
		$position_id = $_GET['position_id'];
		echo GetValue('price','tbl_position',array('id'=>'where/'.$position_id));
		die();
	}
}