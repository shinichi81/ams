<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('in_login')){	
	function in_login($data='0') {
		$ci =& get_instance();
		$login = $ci->session->userdata('login');
		if($data == '1'){
			if($login != '' || !empty($login)){ 
				redirect(base_url().'admincontrol/admin_dashboard');
			}
		}else{
			if($login == '' || empty($login)){ 
				redirect(base_url());
			}
		}
	}
}
if (!function_exists('encrypt_url')){	
	function encrypt_url($string) {
	  $key = "JANNES_SANTOSO_KEY_999999";
	  $result = '';
	  $test = "";
	   for($i=0; $i<strlen($string); $i++) {
		 $char = substr($string, $i, 1);
		 $keychar = substr($key, ($i % strlen($key))-1, 1);
		 $char = chr(ord($char)+ord($keychar));

		 $test[$char]= ord($char)+ord($keychar);
		 $result.=$char;
	   }

	   return urlencode(base64_encode($result));
	}
}

if (!function_exists('decrypt_url')){
	function decrypt_url($string) {
		$key = "JANNES_SANTOSO_KEY_999999";
		$result = '';
		$string = base64_decode(urldecode($string));
	   for($i=0; $i<strlen($string); $i++) {
		 $char = substr($string, $i, 1);
		 $keychar = substr($key, ($i % strlen($key))-1, 1);
		 $char = chr(ord($char)-ord($keychar));
		 $result.=$char;
	   }
	   return $result;
	}
}

if (!function_exists('to_url')){	
	function to_url($questions_id,$segmen,$site_map='0') {
		if($segmen == 'polling'){
			$title = GetValue('questions','polling_questions',array('id'=>'where/'.$questions_id));
			$txt = str_replace(' ','.',$title);
			$txt = str_replace(',','',$txt);
			$txt = str_replace('&','',$txt);
			$txt = str_replace('amp;','',$txt);
			$txt = str_replace('quot;','',$txt);
			$txt = str_replace('=','',$txt);
			$txt = str_replace('#','',$txt);
			$txt = str_replace('!','',$txt);
			$txt = str_replace('@','',$txt);
			$txt = str_replace('(','',$txt);
			$txt = str_replace(')','',$txt);
			if($site_map == '1'){
				$url = 'http://sapaindonesia.com/polling/'.$questions_id.'/'.$txt;
			}else{
				$url = site_url('polling/'.$questions_id.'/'.$txt);
			}
		}elseif($segmen == 'tertangkap' || $segmen == 'cap'){
			$title = GetValue('text','api_instagram',array('id'=>'where/'.$questions_id));
			$rem = array(' ',',','&','amp','quot;','=','!','#','@','/',':','(',')',"'",'"');
			$txt = str_replace($rem,'.',$title);
			($segmen == 'tertangkap') ? $uri = 'tertangkap-basah' : $uri = 'cerita-akhir-pekan';
			if($site_map == '1'){
				$url = 'http://sapaindonesia.com/'.$uri.'/'.$questions_id.'/'.$txt;
			}else{
				$url = site_url($uri.'/'.$questions_id.'/'.$txt);
			}
		}elseif($segmen == 'ys' || $segmen == 'home'){
			$title = GetValue('title','api_youtube',array('id'=>'where/'.$questions_id));
			$rem = array(' ',',','&','amp','quot;','=','!','#','@','/',':','(',')',"'",'"');
			$txt = str_replace($rem,'.',$title);
			($segmen == 'ys') ? $uri = 'yang-seru' : $uri = 'live';
			if($site_map == '1'){
				$url = 'http://sapaindonesia.com/'.$uri.'/'.$questions_id.'/'.$txt;
			}else{
				$url = site_url($uri.'/'.$questions_id.'/'.$txt);
			}
		}else{
			$title = GetValue('title','article',array('id'=>'where/'.$questions_id));
			$txt = str_replace(' ','.',$title);
			$txt = str_replace(',','',$txt);
			$txt = str_replace('&','',$txt);
			$txt = str_replace('amp;','',$txt);
			$txt = str_replace('quot;','',$txt);
			$txt = str_replace('=','',$txt);
			$txt = str_replace('#','',$txt);
			$txt = str_replace('!','',$txt);
			$txt = str_replace('@','',$txt);
			$txt = str_replace('(','',$txt);
			$txt = str_replace(')','',$txt);
			if($site_map == '1'){
				$url = 'http://sapaindonesia.com/read/'.$questions_id.'/'.$segmen.'/'.$txt;
			}else{
				$url = site_url('read/'.$questions_id.'/'.$segmen.'/'.$txt);
			}
		}
		return $url;
	}
}

if (!function_exists('curl_test')){	
	function curl_test($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}

if (!function_exists('parse_date')){	
	function parse_date($data='') {
		$dt = explode(' ',$data);
		$dt2 = explode('-',$dt[0]);
		return $dt2;
	}
}

if (!function_exists('get_instagram')){	
	function get_instagram($tag_not_use='') {
		$ci =& get_instance();
		
		## insert filtering data ##
			### typenya cap dan tertangkap ###
			### typenya instagram dan twitter ###
		$type = 'tertangkap';
		$api = 'twitter';
		$ci->db->where('type',$type);
		$ci->db->where('api',$api);
		$ci->db->delete('api_instagram');
		
		## if insgram using curl but twitter using getvalue ##
		if($api == 'instagram'){
			$tags = 'tertangkapbasah';
			$url = 'https://api.instagram.com/v1/tags/'.$tags.'/media/recent?client_id=48f465e1309248d4aee9383c889e1fa7';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,$url);
			$result=curl_exec($ch);
			curl_close($ch);
		}elseif($api == 'twitter'){
			$result = GetValue('api','api_twitter',array('type'=>'where/'.$type));
		}
		## if insgram using curl but twitter using getvalue ##
		
		
		//pre($result->result_array());die();
		// pre(json_decode($result,true));die();
		
		$decode = json_decode($result,true);
		if($api == 'instagram'){ $decode = $decode['data']; }
		
		if($api == 'instagram'){
			$ins = array();
			foreach($decode as $k=>$r){
				if($r['type'] == 'video' && $api == 'instagram'){
					$video_low_resolution = $r['videos']['low_resolution']['url'];
					$video_standard_resolution = $r['videos']['standard_resolution']['url'];
					$video_low_bandwidth = $r['videos']['low_bandwidth']['url'];
				}else{
					$video_low_resolution = '';
					$video_standard_resolution = '';
					$video_low_bandwidth = '';
				}
				$ins = array(
					'id_api'=>$r['id'],
					'images_low_resolution'=>$r['images']['low_resolution']['url'],
					'images_standard_resolution'=>$r['images']['standard_resolution']['url'],
					'text'=>$r['caption']['text'],
					'type'=>$type,
					'api'=>$api,
					'type_api'=>$r['type'],
					'username'=>$r['user']['username'],
					'full_name'=>$r['user']['full_name'],
					'profile_picture'=>$r['user']['profile_picture'],
					'video_low_resolution'=>$video_low_resolution,
					'video_standard_resolution'=>$video_standard_resolution,
					'video_low_bandwidth'=>$video_low_bandwidth,
					'create_date'=>date('Y-m-d H:i:s')
				);
				$ci->db->insert('api_instagram',$ins);
			}
		}elseif($api == 'twitter'){
			$ins = array();
			foreach($decode as $k=>$r){
				$video_low_resolution = '';
				$video_standard_resolution = '';
				$video_low_bandwidth = '';
				
				$ins = array(
					'id_api'=>$r['id_api'],
					'images_low_resolution'=>$r['images_low_resolution'],
					'images_standard_resolution'=>$r['images_standard_resolution'],
					'text'=>$r['text'],
					'type'=>$type,
					'api'=>$api,
					'type_api'=>'image',
					'username'=>$r['username'],
					'full_name'=>$r['full_name'],
					'profile_picture'=>$r['profile_picture'],
					'video_low_resolution'=>$video_low_resolution,
					'video_standard_resolution'=>$video_standard_resolution,
					'video_low_bandwidth'=>$video_low_bandwidth,
					'create_date'=>date('Y-m-d H:i:s')
				);
				$ci->db->insert('api_instagram',$ins);
			}
		}
		## insert filtering data ##
		
		die();
		//return json_decode($result,true);
		
		// $json = file_get_contents($url);
		// $decode = json_decode($json);
		// $decode = objectToArray($decode);
		// return $decode;
	}
}

if (!function_exists('objectToArray')){	
	function objectToArray($d) {
		if (is_object($d)) {
			$d = get_object_vars($d);
		}
		
		if (is_array($d)) {
			return array_map(__FUNCTION__, $d);
		}
		else {
			return $d;
		}
	}
}

if (!function_exists('valid_input_data')){	
	function valid_input_data($data) {
		$ci =& get_instance();
		$ci->security->xss_clean($data);
		$ci->security->sanitize_filename($data);
		
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		
		$c_remove = array("”",":","\"", "'", ",", "<", ">", "%", "&", "*", "(", ")", "$", "#", "-", "+", "!", "?");
		$data = preg_replace("/[^A-Za-z0-9!.@ ]/", "", $data);
		
		return $data;
	}
}

if (!function_exists('pre')){	
	function pre($data=array()) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}

if (!function_exists('generateRandomString')){
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
}

if (!function_exists('SelisihTgl')){	
	function SelisihTgl($tgl_dateline, $tgl_kembali,$status='week') {
		$tgl_dateline_pcs = explode ("-", $tgl_dateline);
		$tgl_dateline_pcs = $tgl_dateline_pcs[2]."-".$tgl_dateline_pcs[1]."-".$tgl_dateline_pcs[0];
		
		$tgl_kembali_pcs = explode ("-", $tgl_kembali);
		$tgl_kembali_pcs = $tgl_kembali_pcs[2]."-".$tgl_kembali_pcs[1]."-".$tgl_kembali_pcs[0];
		
		$selisih = strtotime ($tgl_kembali_pcs) - strtotime ($tgl_dateline_pcs);
		
		$selisih = $selisih / 86400;
		$hasil = floor($selisih);
		
		if($status == 'week'){
			$q = $hasil/7;
		}elseif($status == 'day'){
			$q = $hasil;
		}
		return floor($q);
	}
}

if (!function_exists('do_upload')){	
	function do_upload($config1,$name,$redirect){
		$ci =& get_instance();
		$result_array = array();
		$ci->load->library('upload',$config1);
		if(!empty($_FILES[$name]['name'])){
			$ci->upload->do_upload($name);
				array_push($result_array,$ci->upload->data());
				return $result_array;
		}/* else{
			$ci->general_lib->_flash_message('Anda Harus Mengupload Data',$redirect);
		} */
	
	}
}

if (!function_exists('getIntMonth')){	
	function getIntMonth($val){
		$ci =& get_instance();
		if($val == 'Jan'){
			$rs = '01';
		}elseif($val == 'Feb'){
			$rs = '02';
		}elseif($val == 'Mar'){
			$rs = '03';
		}elseif($val == 'Apr'){
			$rs = '04';
		}elseif($val == 'May'){
			$rs = '05';
		}elseif($val == 'Jun'){
			$rs = '06';
		}elseif($val == 'Jul'){
			$rs = '07';
		}elseif($val == 'Aug'){
			$rs = '08';
		}elseif($val == 'Sep'){
			$rs = '09';
		}elseif($val == 'Oct'){
			$rs = '10';
		}elseif($val == 'Nov'){
			$rs = '11';
		}elseif($val == 'Dec'){
			$rs = '12';
		}
		return $rs;
	
	}
}

if (!function_exists('hari_an')){	
	function hari_an($d)
	{
		if($d == "Monday")
			$ds = "01";
		else if($d == "Tuesday")
			$ds = "02";
		else if($d == "Wednesday")
			$ds = "03";
		else if($d == "Thursday")
			$ds = "04";
		else if($d == "Friday")
			$ds = "05";
		else if($d == "Saturday")
			$ds = "06";
		else if($d == "Sunday")
			$ds = "07";
		
		return $ds;
	}
}

if (!function_exists('hari')){	
	function hari($d)
	{
		if($d == "01")
			$ds = "Mon";
		else if($d == "02")
			$ds = "Tue";
		else if($d == "03")
			$ds = "Wed";
		else if($d == "04")
			$ds = "Thu";
		else if($d == "05")
			$ds = "Fri";
		else if($d == "06")
			$ds = "Sat";
		else if($d == "07")
			$ds = "Sun";
		
		return $ds;
	}
}

if (!function_exists('arr_month')){	
	function arr_month($dt)
	{
		$arr = array(
			''=>$dt,
			'1'=>'Januari',
			'2'=>'Februari',
			'3'=>'Maret',
			'4'=>'April',
			'5'=>'Mei',
			'6'=>'Juni',
			'7'=>'Juli',
			'8'=>'Agustus',
			'9'=>'September',
			'10'=>'Oktober',
			'11'=>'November',
			'12'=>'Desember',
		);
		
		return $arr;
	}
}

if (!function_exists('month')){	
	function month($Bulan)
	{
		if($Bulan == "01")
			$Bulan = "Januari";
		else if($Bulan == "02")
			$Bulan = "Februari";
		else if($Bulan == "03")
			$Bulan = "Maret";
		else if($Bulan == "04")
			$Bulan = "April";
		else if($Bulan == "05")
			$Bulan = "Mei";
		else if($Bulan == "06")
			$Bulan = "Juni";
		else if($Bulan == "07")
			$Bulan = "Juli";
		else if($Bulan == "08")
			$Bulan = "Agustus";
		else if($Bulan == "09")
			$Bulan = "September";	
		else if($Bulan == "10")
			$Bulan = "Oktober";
		else if($Bulan == "11")
			$Bulan = "November";	
		else if($Bulan == "12")
			$Bulan = "Desember";

		return $Bulan;
	}
}

if (!function_exists('Rupiah')){
	function Rupiah($rp)
	{
		if($rp) return "Rp ".number_format($rp,0,",",".").",-";
		else return 0;
	}
}

if (!function_exists('GetTime')){	
	function GetTime($data)
	{
		$exp = explode(':',$data);
		$val = $exp[0].':'.$exp[1];
		return $val;
	}
}

if (!function_exists('do_upload')){	
	function do_upload($config1,$name,$redirect){
		$ci =& get_instance();
		$result_array = array();
		$ci->load->library('upload',$config1);
		if(!empty($_FILES[$name]['name'])){
			$ci->upload->do_upload($name);
				array_push($result_array,$ci->upload->data());
				return $result_array;
		}else{
			$ci->general_lib->_flash_message('Anda Harus Mengupload Data',$redirect);
		}
	
	}
}

if (!function_exists('to_excel')){
	function to_excel($content, $filename='xlsoutput')
	{
	  $headers = '';
	  header("Content-type: application/x-msdownload");
	  header("Content-Disposition: attachment; filename=$filename.xls");
	  echo "$headers\n$content";
	}
}

if (!function_exists('to_doc')){
	function to_doc($content, $filename='xlsoutput')
	{
	  $headers = '';
	  header("Content-type: application/x-msdownload");
	  header("Content-Disposition: attachment; filename=$filename.doc");
	  echo "$headers\n$content";
	}
}

if (!function_exists('js_GetCount')){
	function js_GetCount($kondisi=array(),$table)
	{
		$ci =& get_instance();
		foreach($kondisi as $key=>$val){
		$exp = explode("/",$val);
			if(isset($exp[1])){
				if($exp[0] == "where") $ci->db->where($key, $exp[1]);
				else if($exp[0] == "like") $ci->db->like($key, $exp[1]);
				else if($exp[0] == "order") $ci->db->order_by($key, $exp[1]);
				else if($key == "limit") $ci->db->limit($exp[1], $exp[0]);
			}
		}
		$count = $ci->db->count_all_results($table);
		return $count;
	}
}

if (!function_exists('cekIpad')){
	function cekIpad()
	{
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/ipad/i',$user_agent)) return TRUE;
		else return FALSE;
	}
}
	
if (!function_exists('permission')){
	function permission()
	{
		$CI =& get_instance();
		if(!$CI->session->userdata("webmaster_id")){
			redirect("login");
		}
		
		//$group = $CI->session->userdata('webmaster_grup');
		$ref_menu = $CI->uri->segment(2);
		if($ref_menu == "cuti" && $CI->uri->segment(2))
		$q_path = $CI->model_admin_menu->cekAccessMenu($ref_menu."/".$CI->uri->segment(2));
		else
		$q_path = $CI->model_admin_menu->cekAccessMenu($ref_menu);
		$jum = $q_path->num_rows();
		if($jum > 0){
			$row = $q_path->row();
			$id_menu_admin = $row->id;
			//$CI->db->where("id_admin_grup",$group);
			$CI->db->where("id_menu_admin",$id_menu_admin);
			$q_menu_admin = $CI->db->get("admin_auth");
			$jum_menu_admin = $q_menu_admin->num_rows();
			if($jum_menu_admin == 0 && ($group != "8910" && $group != "1" && $group != "4"))
			{
				redirect("forbiden");
			}
		}
		//else echo redirect("forbiden");
		
		return $CI->session->userdata("webmaster_id");
	}
}

if (!function_exists('permissionBiasa')){
	function permissionBiasa()
	{
		$CI =& get_instance();
		if(!$CI->session->userdata("webmaster_id")){
			redirect("login");
		}		
		return $CI->session->userdata("webmaster_id");
	}
}

if (!function_exists('GetUserID')){
	function GetUserID()
	{
		$CI =& get_instance();
		return $CI->session->userdata("webmaster_id");
	}
}

if (!function_exists('CekAdminKeuangan')){
	function CekAdminKeuangan($val)
	{
		$admin_keuangan = GetValue("id_admin_wp","admin", array("id"=> "where/".$val));
		return $admin_keuangan;
	}
}

if (!function_exists('CekAksesKegiatan')){
	function CekAksesKegiatan($tabel, $id)
	{
		$CI =& get_instance();
		$grup = $CI->session->userdata('webmaster_grup');
		$cek = CekAdminKeuangan(GetUserID());
		if($cek == 1) $cek_akses = GetValue("id_administrasi", $tabel, array("id"=> "where/".$id));
		else if($cek == 2) $cek_akses = GetValue("id_keuangan", $tabel, array("id"=> "where/".$id));
		else $cek_akses=0;
		
		if(!$cek_akses) $cek_akses = GetValue("id_pic", $tabel, array("id"=> "where/".$id));
		
		$cek_akses = str_replace(" ","",$cek_akses);
		$cek_akses = str_replace("-+1-","",$cek_akses);
		
		if($cek_akses && !preg_match("/-".GetUserID()."-/", $cek_akses) && ($grup != 1 && $grup != 2 && $grup != 5)) return 0;
		else return 1;
	}
}

if (!function_exists('permissionkaryawan')){
	function permissionkaryawan($id, $path)
	{
		$CI =& get_instance();
		$grup = $CI->session->userdata("webmaster_grup");
		if($grup != 1 && $grup != 2 && $grup != 4){
			if($path == "jobdesc")
			redirect("hris/jobdesc/main/".$id);
			else
			redirect("hris/personal/dashboard/".$id);
		}
	}
}

if (!function_exists('permissionaction')){
	function permissionaction()
	{
		$CI =& get_instance();
		$grup = $CI->session->userdata("webmaster_grup");
		if($grup != 1 && $grup != 4) return 0;
		else return 1;
	}
}

if (!function_exists('GetHeaderFooter')){	
	function GetHeaderFooter($flag_sidebar=NULL)
	{
		$CI =& get_instance();
		
		if($CI->session->userdata('webmaster_id'))
		{
			$data['dis_login'] = "display:'';";
			$data['nama_user'] = $CI->session->userdata('admin');
		}
		else
		{
			$data['dis_login'] = "display:none;";
			$data['nama_user'] = "";
		}
		
		$data['header'] = 'header';
		$data['menu'] = 'menu';
		//$data['sidebar'] = 'sidebar';
		$data['footer'] = 'footer';
		$data['breadcrumb'] = Breadcrumb();
		
		$data['spic']=$data['sd']=$data['dv']=$data['bln']=$data['thn']=$data['tp']="";
		return $data;
	}
}

if (!function_exists('cek_akses')){
	function cek_akses($db, $id_menu, $webmaster_grup)
	{
		$CI =& get_instance();
		$CI->db->where("id_admin_grup", $webmaster_grup);
		$CI->db->where("id_menu_admin", $id_menu);
		$q = $CI->db->get("admin_auth");
		if($q->num_rows() > 0) return true;
		else return false;
	}
}

if (!function_exists('Breadcrumb')){
	function Breadcrumb()
	{
		$CI =& get_instance();
		$breadcrumb = "";//Home
		$flag=1;
		$id_menu = $id_menu_temp = GetValue("id","menu_admin", array("filez"=> "where/".$CI->uri->segment(1)/*, "category"=> "where/".$CI->uri->segment(1)*/));
		if($id_menu)
		{
			while($flag)
			{
				$CI->db->where("id", $id_menu);
				$q = $CI->db->get("menu_admin");
				foreach($q->result_array() as $r)
				{
					if($id_menu_temp == $id_menu) $breadcrumb = "<li>".$r['title']."</li>".$breadcrumb;
					else if($id_menu == 3) $breadcrumb = "<li><a href='".site_url($CI->uri->segment(1).'/'.$r['filez'].'/dashboard/'.$CI->uri->segment(4))."'><b>".$r['title']."</b></a></li>".$breadcrumb;
					else $breadcrumb = "<li><a href='".site_url($CI->uri->segment(1).'/'.$r['filez'])."'><b>".$r['title']."</b></a></li>".$breadcrumb;
					$id_menu=$r['id_parents'];
					if($r['id_parents'] == 0) $flag=0;
				}
			}
		}
		
		return "<li class='first'><a href='".site_url('home')."'>Home</a></li>".$breadcrumb;
		/*
		$sub_dir = $CI->uri->segment(1);
		$sub_bread = $here = "";
		$CI->db->where("category",strtoupper($sub_dir));
		$CI->db->where("filez",$CI->uri->segment(2));
		$q = $CI->db->get("menu_admin");
		foreach($q->result_array() as $r)
		{
			if($CI->uri->segment(3) && $CI->uri->segment(3) != "main")
			$here = "<li><a href='".base_url()."webmaster/".$sub_dir."/".$r['filez']."'>".$r['title']."</a></li><li class='active'><span class='divider'>/</span>".ucfirst($CI->uri->segment(3))."</li>";
			else if($CI->uri->segment(2) == "dashboard") $here = "";
			else
			$here = "<li class='active'>".$r['title']."</li>";
			if($r['id_parents'] > 0)
			{
				$CI->db->where("id",$r['id_parents']);
				$q = $CI->db->get("menu_admin");
				foreach($q->result_array() as $r)
				{
					if($r['filez'] == "#")
					$sub_bread .= "<li><span class='divider'>/</span><a href='#'>".$r['title']."</a></li>";
					else
					$sub_bread .= "<li><span class='divider'>/</span><a href='".base_url()."webmaster/".$r['filez']."'>".$r['title']."</a></li>";
					if($r['id_parents'] > 0)
					{
						$CI->db->where("id",$r['id_parents']);
						$q = $CI->db->get("menu_admin");
						foreach($q->result_array() as $r)
						{
							if($r['filez'] == "#")
							$sub_bread .= "<li><span class='divider'>/</span><a href='#'>".$r['title']."</a></li>";
							else
							$sub_bread .= "<li><span class='divider'>/</span><a href='".base_url()."webmaster/".$r['filez']."'>".$r['title']."</a></li>";
						}
					}
				}
			}
		}
		
		$data['breadcrumb'] = $breadcrumb.$sub_bread.$here;*/
		return $data['breadcrumb'];
	}
}

if (!function_exists('GetValue')){
	function GetValue($field,$table,$filter=array(),$order=NULL)
	{
		$CI =& get_instance();
		$CI->db->select($field);
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "order") $CI->db->order_by($key, $exp[1]);
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		if($order) $CI->db->order_by($order);
		$q = $CI->db->get($table);
		foreach($q->result_array() as $r)
		{
			return $r[$field];
		}
		return 0;
	}
}

if (!function_exists('GetAll')){
	function GetAll($tbl,$filter=array(),$filter_where_in=array(),$filter_where_not_in=array(),$dist='')
	{
		$CI =& get_instance();
		
		if($dist !== null){
			$CI->db->distinct();
			$CI->db->select($dist);
		}
		
		foreach($filter as $key=> $value)
		{
			// Multiple Like
			if(is_array($value))
			{
				$key = str_replace(" =","",$key);
				$like="";
				$v=0;
				foreach($value as $r=> $s)
				{
					$v++;
					$exp = explode("/",$s);
					if(isset($exp[1]))
					{
						if($exp[0] == "like")
						{
							if($key == "tanggal" || $key == "tahun")
							{
								$key = "tanggal";
								if(strlen($exp[1]) == 4)
								{
									if($v == 1) $like .= $key." LIKE '%".$exp[1]."-%' ";
									else $like .= " OR ".$key." LIKE '%".$exp[1]."-%' ";
								}
								else 
								{
									if($v == 1) $like .= $key." LIKE '%-".$exp[1]."-%' ";
									else $like .= " OR ".$key." LIKE '%-".$exp[1]."-%' ";
								}
							}
							else
							{
								if($v == 1) $like .= $key." LIKE '%".$exp[1]."%' ";
								else $like .= " OR ".$key." LIKE '%".$exp[1]."%' ";
							}
						}
					}
				}
				if($like) $CI->db->where("id > 0 AND ($like)");
				$exp[0]=$exp[1]="";
			}
			else {
			$exp = explode("/",$value);
			
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "or_where") $CI->db->or_where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "or_like") $CI->db->or_like($key, $exp[1]);
				else if($exp[0] == "like_after") $CI->db->like($key, $exp[1], 'after');
				else if($exp[0] == "like_before") $CI->db->like($key, $exp[1], 'before');
				else if($exp[0] == "not_like") $CI->db->not_like($key, $exp[1]);
				else if($exp[0] == "not_like_after") $CI->db->not_like($key, $exp[1], 'after');
				else if($exp[0] == "not_like_before") $CI->db->not_like($key, $exp[1], 'before');
				else if($exp[0] == "order")
				{
					$key = str_replace("=","",$key);
					$CI->db->order_by($key, $exp[1]);
				}
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			else if($exp[0] == "where") $CI->db->where($key);
			
			if($exp[0] == "group") $CI->db->group_by($key);
			}
		}
		
		foreach($filter_where_in as $key=> $value)
		{
			$CI->db->where_in($key, $value);
		}
		
		foreach($filter_where_not_in as $key=>$value){
			$CI->db->where_not_in($key, $value);
		}
		
		
		$q = $CI->db->get($tbl);
		//die($CI->db->last_query());
		
		return $q;
	}
}

if (!function_exists('GetMax')){
	function GetMax($table='',$field='',$nm_field='')
	{
		$ci =& get_instance();
		$ci->db->select_max($field,$nm_field);
		$get = $ci->db->get($table);
		$rs = $get->result_array();
		$q = $rs[0][$nm_field];
		
		return $q;
	}
}

if (!function_exists('GetMaxLvl')){
	function GetMaxLvl($member_id=0,$ref_level_id=0,$table='sertifikat',$field='level_id',$nm_field='max_id')
	{
		$ci =& get_instance();
		$ci->db->where('member_id',$member_id);
		$ci->db->where('ref_level_id',$ref_level_id);
		$ci->db->select_max($field,$nm_field);
		$get = $ci->db->get($table);
		$rs = $get->result_array();
		$q = $rs[0][$nm_field];
		
		return $q;
	}
}

if (!function_exists('GetQuery')){
	function GetQuery($field,$table,$where='',$order='',$group='')
	{
		$CI =& get_instance();
		$where = !empty($where) ? "WHERE ".$where : "";
		$order = !empty($order) ? "ORDER BY ".$order : "";
		$group = !empty($group) ? "GROUP BY ".$group : "";		
		
		$q = $CI->db->query("SELECT $field FROM $table $where $order $group");
		
		return $q;
	}
}

if (!function_exists('GetJoin')){
	function GetJoin($tbl,$tbl_join,$condition,$type,$select,$filter=array(),$filter_where_in=array())
	{
		$CI =& get_instance();
		$CI->db->select($select);
		foreach($filter as $key=> $value)
		{
			// Multiple Like
			if(is_array($value))
			{
				if($key == "group") $CI->db->group_by($value);
				$exp[0]=$exp[1]="";
			}
			else $exp = explode("/",$value);
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "order") $CI->db->order_by($key, $exp[1]);
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		foreach($filter_where_in as $key=> $value)
		{
			$CI->db->where_in($key, $value);
		}
		
		$CI->db->join($tbl_join, $condition, $type);
		$q = $CI->db->get($tbl);
		//die($CI->db->last_query());
		
		return $q;
	}
}

if (!function_exists('GetSum')){
	function GetSum($table,$field,$filter=array())
	{
		$CI =& get_instance();
		$CI->db->select("SUM($field) as total");
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "order") $CI->db->order_by($key, $exp[1]);
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		$q = $CI->db->get($table);
		
		return $q;
	}
}

if (!function_exists('GetCount')){
	function GetCount($table,$field,$filter=array())
	{
		$CI =& get_instance();
		$CI->db->select("$field as label, COUNT($field) as total");
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "order") $CI->db->order_by($key, $exp[1]);
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		$q = $CI->db->get($table);
		
		return $q;
	}
}

if (!function_exists('GetColumns')){	
	function GetColumns($tbl)
	{
		$CI =& get_instance();
		if(substr($tbl,0,3) != "kg_") $tbl = "kg_".$tbl;
		$query = $CI->db->query("SHOW COLUMNS FROM ".$tbl);
		return $query->result_array();
	}
}
	
if (!function_exists('GetUrlDate')){	
	function GetUrlDate($date)
	{
		$exp1 = explode(" ", $date);
		$exp = explode("-",$exp1[0]);
		return $exp[2]."/".$exp[1]."/".$exp[0];
	}
}

if (!function_exists('ExplodeNameFile')){
	function ExplodeNameFile($source)
	{
		$ext = strrchr($source, '.');
		$name = ($ext === FALSE) ? $source : substr($source, 0, -strlen($ext));

		return array('ext' => $ext, 'name' => $name);
	}
}

if (!function_exists('GetThumb')){	
	function GetThumb($image, $path="_thumb")
	{
		$exp = ExplodeNameFile($image);
		return $exp['name'].$path.$exp['ext'];
	}
}

if (!function_exists('ResizeImage')){	
	function ResizeImage($up_file,$w,$h)
	{
		//Resize
		$CI =& get_instance();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $up_file;
		$config['dest_image'] = "./".$CI->config->item('path_upload')."/";
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE; //Width=Height
		$config['height'] = $h;
		$config['width'] = $w;
		
		$CI->load->library('image_lib', $config);
		if($CI->image_lib->resize()) return 1;
		else return 0; 
	}
}

if (!function_exists('InputFile')){
	function InputFile($filez,$filesize=500)
	{
		$CI =& get_instance();
		$file_up = $_FILES[$filez]['name'];
		$file_up = date("YmdHis").".".str_replace("-","_",url_title($file_up));
		$myfile_up	= $_FILES[$filez]['tmp_name'];
		$ukuranfile_up = $_FILES[$filez]['size'];
		if($filez == "foto")
		$up_file = "./".$CI->config->item('path_upload')."/foto/".$file_up;
		else
		$up_file = "./".$CI->config->item('path_upload')."/".$file_up;
		
		$ext_file = strrchr($file_up, '.');
		if($ukuranfile_up < ($filesize * 1024))
		{
			if(strtolower($ext_file) == ".jpg" || strtolower($ext_file) == ".JPG" ||strtolower($ext_file) == ".jpeg" || strtolower($ext_file) == ".png")
			{
				if(copy($myfile_up, $up_file))
				{
					ResizeImage($up_file, 250, 250);
					return $file_up;
				}
			}
			//else if(strtolower($ext_file) == ".doc" || strtolower($ext_file) == ".docx" || strtolower($ext_file) == ".pdf")
			else
			{
				if(copy($myfile_up, $up_file))
				{
					return $file_up;
				}
				else return 3;
			}
			
		}
		else return 2;
	}
}

if (!function_exists('PageJquery')){
	function PageJquery($jum_all,$per_page,$id_link)
	{
		$per_link = $jum_all / $per_page;
		$opr_link = $per_link - $id_link;
		$pagination = '';
		if($jum_all == 0){
			$pagination .= '<input type="hidden" id="paging_id" value="1">';
			$pagination .= '<a href="javascript:page_load(1)">First</a>';
		}
		
		for($link=1;$link <= $per_link; $link++ ){
			$lnk = $link+1;
			if($link == $per_link){
				break;
			}elseif($link == 1){
				$pagination .= '<input type="hidden" id="paging_id" value="'.$link.'">';
				$pagination .= '<a href="javascript:page_load(1)">First</a>';
			}else{
				if($link < ($id_link-2) || ($link >= ($id_link+3) && $link <= ($opr_link-2))){
					$pagination .=  '..';
				}elseif($link == $id_link){
					if($id_link == '1'){
						$pagination .=  '<a href="#"><strong>'.$link.'</strong></a>';
					}else{
						$pagination .= '<input type="hidden" id="paging_id" value="'.$link.'">';
						$pagination .=  '<a href="#"><strong>'.$link.'</strong></a>';
					}
					
				}else{
					$pagination .= '<a href="javascript:page_load('.$link.')" >'.$link.'</a>';
				}
			}
			
		}
		return $pagination;
	}
}

if (!function_exists('PageJquery2')){
	function PageJquery2($jum_all,$per_page,$id_link,$ajax_function)
	{
		$per_link = $jum_all / $per_page;
		$opr_link = $per_link - $id_link;
		$pagination = '';
		for($link=0;$link <= $per_link; $link++ ){
			$lnk = $link+1;
			if($link == $per_link){
				break;
			}elseif($link == 0){
				$pagination .= '<a href="#" onClick="'.$ajax_function.'(0)">First</a>';
				
			}else{
				if($link < ($id_link-2) || ($link >= ($id_link+3) && $link <= ($opr_link-2))){
					$pagination .=  '';
				}elseif($link == $id_link){
					$pagination .=  '<a href="#" onClick="'.$ajax_function.'('.$link.')"><b>'.$lnk.'</b></a>';
				}else{
					$pagination .= '<a href="#" onClick="'.$ajax_function.'('.$link.')">'.$lnk.'</a>';
				}
			}
			
		}
		return $pagination;
	}
}

if (!function_exists('Page')){
	function Page($jum_record,$lmt,$pg,$path,$uri_segment)
	{
		$link = "";
		$config['base_url'] = $path;
		$config['total_rows'] = $jum_record;
		$config['per_page'] = $lmt;
		$config['num_links'] = 3;
		$config['cur_tag_open'] = '<li><strong>';
		$config['cur_tag_close'] = '</strong></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['uri_segment'] = $uri_segment;
		
		$CI =& get_instance();
		$CI->pagination->initialize($config);
		$link = $CI->pagination->create_links();
		return $link;
	}
}

if (!function_exists('CaptchaSecurityImages')){	
	function CaptchaSecurityImages($width='120',$height='40',$characters='6') 
	{
		$CI =& get_instance();
		$font = './assets/font/monofont.ttf';
		$code = generateCode($characters);
		/* font size will be 75% of the image height */
		$font_size = $height * 0.75;
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, 255, 255, 255);
		$text_color = imagecolorallocate($image, 20, 40, 100);
		$noise_color = imagecolorallocate($image, 100, 120, 180);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code) or die('Error in imagettftext function');
		
		
		/* output captcha image to browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
		$CI->session->set_userdata("security_code", $code);
	}
}

if (!function_exists('GetTanggal')){	
	function GetTanggal($tgl)
	{
		if(strlen($tgl) == 1) $tgl = "0".$tgl;
		return $tgl;
	}
}

if (!function_exists('GetBulanIndo')){	
	function GetBulanIndo($Bulan)
	{
		if($Bulan == "January")
			$Bulan = "Januari";
		else if($Bulan == "February")
			$Bulan = "Februari";
		else if($Bulan == "March")
			$Bulan = "Maret";
		else if($Bulan == "May")
			$Bulan = "Mei";
		else if($Bulan == "June")
			$Bulan = "Juni";
		else if($Bulan == "July")
			$Bulan = "Juli";
		else if($Bulan == "August")
			$Bulan = "Agustus";
		else if($Bulan == "October")
			$Bulan = "Oktober";
		else if($Bulan == "December")
			$Bulan = "Desember";

		return $Bulan;
	}
}

if (!function_exists('GetMonthIndex')){	
	function GetMonthIndex($var)
	{
		$bln = array("Jan"=> "01","Feb"=> "02","Mar"=> "03","Apr"=> "04","May"=> "05","Jun"=> "06","Jul"=> "07","Aug"=> "08","Sep"=> "09","Oct"=> "10","Nov"=> "11","Dec"=> "12");
		return $bln[$var];
	}
}

if (!function_exists('GetMonth')){	
	function GetMonth($id)
	{
		$bln = array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		//$bln = array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Dec");
		return $bln[$id];
	}
}

if (!function_exists('GetMonthFull')){	
	function GetMonthFull($id)
	{
		//$bln = array("","January","February","March","April","May","June","July","August","September","October","November","December");
		$bln = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		return $bln[$id];
	}
}

if (!function_exists('GetMonthShort')){	
	function GetMonthShort($val)
	{
		$bln = array("Januari"=> "Jan","Februari"=>"Feb","Maret"=>"Mar","April"=>"Apr","Mei"=>"May","Juni"=>"Jun","Juli"=>"Jul","Agustus"=>"Aug","September"=>"Sep","Oktober"=>"Oct","November"=>"Nov","Desember"=>"Dec");
		return $bln[$val];
	}
}

if (!function_exists('GetOptDate')){	
	function GetOptDate()
	{
		$opt[''] = "- Tanggal -";
		for($i=1;$i<=31;$i++)
		{
			if(strlen($i) == 1) $j = "0".$i;
			else $j=$i;
			$opt[$j] = $j;
		}
		return $opt;
	}
}

if (!function_exists('GetOptRange')){	
	function GetOptRange()
	{
		$opt[''] = "- Range -";
		$range = array(
			'01'=> 'Minggu 1 (tgl 01-07)',
			'02'=> 'Minggu 2 (tgl 08-14)',
			'03'=> 'Minggu 3 (tgl 15-21)',
			'04'=> 'Minggu 4 (tgl 22-31)'
		);
		foreach($range as $r=> $val)
		{
			$opt[$r] = $val;
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptMonth')){	
	function GetOptMonth()
	{
		$opt[''] = "- Bulan -";
		$bln = array("01"=> "Januari","02"=> "Februari","03"=> "Maret","04"=>"April","05"=>"Mei","06"=>"Juni",
		"07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
		//$bln = array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Dec");
		foreach($bln as $r=> $val)
		{
			$opt[$r] = $val;
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptMonthFull')){	
	function GetOptMonthFull()
	{
		$opt[''] = "- Bulan -";
		$bln = array("Januari"=> "Januari","Februari"=> "Februari","Maret"=> "Maret","April"=>"April","Mei"=>"Mei","Juni"=>"Juni",
		"Juli"=>"Juli","Agustus"=>"Agustus","September"=>"September","Oktober"=>"Oktober","November"=>"November","Desember"=>"Desember");
		//$bln = array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Dec");
		foreach($bln as $r=> $val)
		{
			$opt[$r] = $val;
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptYear')){	
	function GetOptYear()
	{
		if(date("m") == "10") $year = date("Y") + 1;
		else $year = date("Y");
		$opt[''] = "- Tahun -";
		for($i=$year;$i >=2011;$i--)
		{
			$opt[$i] = $i;
		}
		return $opt;
	}
}

if (!function_exists('GetOptYeari')){	
	function GetOptYeari()
	{
		$opt[''] = "- Tahun -";
		for($i=date("Y");$i >=2006;$i--)
		{
			$opt[$i] = $i;
		}
		return $opt;
	}
}

if (!function_exists('GetOptRencanaTanggal')){	
	function GetOptRencanaTanggal()
	{
		if(date("m") == "10") $year = date("Y") + 1;
		else $year = date("Y");
		$opt[''] = "- Rencana Tanggal -";
		for($i=date("Y");$i <=$year;$i++)
		{
			for($j=1;$j<=12;$j++)
			{
				$opt[GetMonthFull($j)." ".$i] = GetMonthFull($j)." ".$i;
			}
		}
		return $opt;
	}
}

if (!function_exists('GetKurikulum')){
	function GetKurikulum()
	{
		$ci =& get_instance();
		$get = GetAll('kurikulum',array('active_status'=>'where/yes'));
		$q = array();
		foreach($get->result_array() as $r){
			$q = $r['id'];
		}
		
		return $q;
	}
}

/* OPTIONS DROPDOWN */
if (!function_exists('GetOptAll')){
	function GetOptAll($tabel='',$judul=NULL,$field='title',$active='')
	{
		$filter = array();
		if($active != ''){
			$filter['is_active'] = 'where/'.$active;
		}
		$q = GetAll($tabel, $filter);
		if($judul) $opt[""] = $judul;
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] = $r[$field];
		}
		
		return $opt;
	}
}

if (!function_exists('GetOptParent')){
	function GetOptParent()
	{
		$q = GetAll('ref_menu',array(
			'is_parent'=>'where/yes'
		));
		$opt[''] = '- Select Parent -';
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] = $r['ref_title'];
		}
		
		return $opt;
	}
}

?>