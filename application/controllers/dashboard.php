<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	/* Controller ini untuk menampilkan halaman dashboard
	 * Lokasi: ./application/controllers/Dashboard.php 
	 */
	private $_accessPaket;
	private $_accessSpace;
	
	public function __construct() {
		parent::__construct();
		check_session(); // jika session habis, redirect ke logout
		$this->load->model(array("Dashboard_Model", "Order_Model", "Orderspace_Model", "Receive_Model"));
		$this->_accessPaket = get_access("PAKET");
		$this->_accessSpace = get_access("SPACE");
	}	
	
	public function index() {
		// untuk total order
		$bookingPaket = $this->Dashboard_Model->getTotalBookingPaket(date("n-Y"));
		$bookingSpace = $this->Dashboard_Model->getTotalBookingSpace(date("n-Y"));
		$paketClosing = $this->Dashboard_Model->getTotalPaketClosing(date("n-Y"));
		$totSpaceToPaket = $this->Dashboard_Model->getTotalSpaceToPaket(date("n-Y"));
		$paketExpired = $this->Dashboard_Model->getTotalPaketExpired(date("n-Y"));
		$spaceExpired = $this->Dashboard_Model->getTotalSpaceExpired(date("n-Y"));
		$orderExpired = $paketExpired->total + $spaceExpired->total;
		
		// untuk paket yang request tayang
		$orderApprove = $this->Dashboard_Model->getAllRequest(0, 5);
		
		// untuk order yang akan expired
		$paketWillExpired = $this->Dashboard_Model->getPaketWillExpired(0, 5);
		$spaceWillExpired = $this->Dashboard_Model->getSpaceWillExpired(0, 5);
		
		// tampung data ke array $arrDataWillExpired
		$arrWillExpired = array();
		foreach ($paketWillExpired as $paket) {
			$data = array(
				"from"			=>	"paket",
				"request_date"	=>	$paket->request_date,
				"nomor"			=>	$paket->no_paket,
				"agency"		=>	$paket->agency,
				"client"		=>	$paket->client,
				"progress"		=>	$paket->progress,
				"selisih"		=>	($paket->selisih_progress <= $paket->selisih_tanggal) ? $paket->selisih_progress : $paket->selisih_tanggal,
			);
			
			array_push($arrWillExpired, $data);
		}
		
		foreach ($spaceWillExpired as $space) {
			$data = array(
				"from"			=>	"space",
				"request_date"	=>	$space->request_date,
				"nomor"			=>	$space->no_space,
				"agency"		=>	$space->agency,
				"client"		=>	$space->client,
				"progress"		=>	$space->progress,
				"selisih"		=>	($space->selisih_progress <= $space->selisih_tanggal) ? $space->selisih_progress : $space->selisih_tanggal,
			);
			
			array_push($arrWillExpired, $data);
		}
		
		// sort array terlebih dahulu
		$from = array();
		$nomor = array();
		$agency = array();
		$client = array();
		$progress = array();
		$selisih = array();
		foreach ($arrWillExpired as $key => $row) {
			$from[$key] = $row["from"];
			$request_date[$key] = $row["request_date"];
			$nomor[$key] = $row["nomor"];
			$agency[$key] = $row["agency"];
			$client[$key] = $row["client"];
			$progress[$key] = $row["progress"];
			$selisih[$key] = $row["selisih"];
		}
		array_multisort($selisih, SORT_NUMERIC, SORT_ASC, $arrWillExpired);
		
		// untuk occupancy
		// Remark 5 Jan 2015 - $allOccupancy = $this->_getOccupancy();
		
		// untuk paket terbaru
		// $allLatest = $this->Order_Model->getAll(0, 5);
		$allLatest = $this->Dashboard_Model->getAllLatestPaket(0, 5);
		
		// untuk grafik performance
		// total order paket
		$arrOrderPaket = array();
		$arrPaketClosing = array();
		for($i=1; $i<=12; $i++) {
			$date = $i."-".date("Y");
			
			$paket = $this->Dashboard_Model->getTotalBookingPaket($date);
			$closing = $this->Dashboard_Model->getTotalPaketClosing($date);
			
			$arrOrderPaket[] = $paket->total;
			$arrPaketClosing[] = $closing->total;
		}
		// total booking space
		$arrBookingSpace = array();
		$arrSpaceToPaket = array();
		for($i=1; $i<=12; $i++) {
			$date = $i."-".date("Y");
			
			$space = $this->Dashboard_Model->getTotalBookingSpace($date);
			$spaceToPaket = $this->Dashboard_Model->getTotalSpaceToPaket($date);
			
			$arrBookingSpace[] = $space->total;
			$arrSpaceToPaket[] = $spaceToPaket->total;
		}

		$progress = "N";
		if ($this->_accessPaket["progress"] == "Y" or $this->_accessSpace["progress"] == "Y")
			$progress = "Y";
		
		$data["page"] = "dashboard/index";
		$data["menu"] = "dashboard";
		$data["total_booking_paket"] = $bookingPaket->total;
		$data["total_booking_space"] = $bookingSpace->total;
		$data["total_paket_closing"] = $paketClosing->total;
		$data["total_space_to_paket"] = $totSpaceToPaket->total;
		$data["total_order_expired"] = $orderExpired;
		$data["arr_will_expired"] = $arrWillExpired;
		$data["all_order_approve"] = $orderApprove;
		// Remark 5 Jan 2015 - $data["all_occupancy"] = $allOccupancy;
		$data["all_latest"] = $allLatest;
		$data["arr_order_paket"] = $arrOrderPaket;
		$data["arr_paket_closing"] = $arrPaketClosing;
		$data["arr_booking_space"] = $arrBookingSpace;
		$data["arr_space_to_paket"] = $arrSpaceToPaket;
		$data["progress"] = $progress;
		
		$this->load->view("template", $data);
	}
	
	public function show_expired_page() {
		$no = $this->input->post("id");
		$type = $this->input->post("type");
		
		$allDataBrandcomm = array();
		$allDetailBrandcomm = array();
		
		if ($type == "paket") {
			$allData = $this->Order_Model->get($no);		
			$allDetail = $this->Order_Model->getDetail($no);
			
			/* s: untuk menampilkan data brandcomm jika ada */
			if (!empty($allData->no_reference)) {
				$no_reference = $allData->no_reference;
				$noReferenceType = substr($no_reference, 0, 1);
				
				if ($noReferenceType == "B") {
					$this->load->model("Brandcomm_Model");
					
					$no_brandcomm = $no_reference;
					
					$allDataBrandcomm = $this->Brandcomm_Model->get($no_brandcomm);		
					$allDetailBrandcomm = $this->Brandcomm_Model->getDetail($no_brandcomm);
				}
			}
			/* e: untuk menampilkan data brandcomm jika ada */
		} else {
			$allData = $this->Orderspace_Model->get($no);		
			$allDetail = $this->Orderspace_Model->getDetail($no);
		}
		
		$arrAds = array();
		$arrKanal = array();
		$arrProductGroup = array();
		$arrPosition = array();
		$n = 0;
		foreach ($allDetail as $detail) {
			$arrAds[$n] = $this->Order_Model->getAds($detail->ads_id);
			$arrKanal[$n] = $this->Order_Model->getKanal($detail->kanal_id);
			$arrProductGroup[$n] = $this->Order_Model->getProductGroup($detail->product_group_id);
			$arrPosition[$n] = $this->Order_Model->getPosition($detail->position_id);
			
			$n += 1;
		}
		
		if ($type == "paket")
			$allProgress = $this->Order_Model->getProgress($no);
		else
			$allProgress = $this->Orderspace_Model->getProgress($no);
		
		$data["all_data"] = $allData;
		$data["all_detail"] = $allDetail;
		$data["all_data_brandcomm"] = $allDataBrandcomm;
		$data["all_detail_brandcomm"] = $allDetailBrandcomm;
		$data["arr_ads"] = $arrAds;
		$data["arr_kanal"] = $arrKanal;
		$data["arr_productgroup"] = $arrProductGroup;
		$data["arr_position"] = $arrPosition;
		$data["percent"] = $allProgress->progress;
		
		if ($type == "paket") {
			$data["progress"] = $this->_accessPaket["progress"];
			$this->load->view("dashboard/show_expired_paket", $data);
		} else {
			$data["progress"] = $this->_accessSpace["progress"];
			$this->load->view("dashboard/show_expired_space", $data);
		}
	}
	
	// public function show_approve_page() {
		// $id = $this->input->post("id");
// 		
		// $allData = $this->Receive_Model->get($id);
		// $allDetail = $this->Receive_Model->getDetail($allData->no_paket);
// 		
		// $n = 0;
		// $result = array();
		// foreach ($allDetail as $detail) {
			// $ads = $this->Receive_Model->getAds($detail->ads_id);
			// $kanal = $this->Receive_Model->getKanal($detail->kanal_id);
			// $productgroup = $this->Receive_Model->getProductgroup($detail->product_group_id);
			// $position = $this->Receive_Model->getPosition($detail->position_id);
// 			
			// $result[$n]["ads"] = $ads->name;
			// $result[$n]["kanal"] = $kanal->name;
			// $result[$n]["product_group"] = $productgroup->name;
			// $result[$n]["position"] = $position->name;
			// $result[$n]["start_date"] = $detail->start_date;
			// $result[$n]["end_date"] = $detail->end_date;
// 			
			// $n += 1;
		// }
// 		
		// $arrDetail = $result;
// 		
		// $data["all_data"] = $allData;
		// $data["all_detail"] = $arrDetail;
// 		
		// $this->load->view("dashboard/show_approve", $data);
	// }
// 	
	// public function show_paket_page() {
		// $no_paket = $this->input->post("id");
// 		
		// $allData = $this->Order_Model->get($no_paket);		
		// $allDetail = $this->Order_Model->getDetail($no_paket);
// 		
		// $arrAds = array();
		// $arrKanal = array();
		// $arrProductGroup = array();
		// $arrPosition = array();
		// $n = 0;
		// foreach ($allDetail as $detail) {
			// $arrAds[$n] = $this->Order_Model->getAds($detail->ads_id);
			// $arrKanal[$n] = $this->Order_Model->getKanal($detail->kanal_id);
			// $arrProductGroup[$n] = $this->Order_Model->getProductGroup($detail->product_group_id);
			// $arrPosition[$n] = $this->Order_Model->getPosition($detail->position_id);
// 			
			// $n += 1;
		// }
// 		
		// $data["all_data"] = $allData;
		// $data["all_detail"] = $allDetail;
		// $data["arr_ads"] = $arrAds;
		// $data["arr_kanal"] = $arrKanal;
		// $data["arr_productgroup"] = $arrProductGroup;
		// $data["arr_position"] = $arrPosition;
// 		
		// $this->load->view("dashboard/show_paket", $data);
	// }	
	private function _getOccupancy() {
		$arrData = array();
		$daysInMonth = cal_days_in_month(CAL_GREGORIAN, date("n"), date("Y"));
		$monthYear = date("n-Y");
		
		$allProductGroup = $this->Dashboard_Model->getAllProductGroup();
		foreach ($allProductGroup as $productGroup) {
			$arrPosition = explode(",", $productGroup->position_id);
			foreach ($arrPosition as $position_id) {
				$totDay = array();
				
				// mendapatkan tanggal-tanggal closing
				$allClosing = $this->Dashboard_Model->getClosing($productGroup->kanal_id, $productGroup->id, $position_id, $monthYear);
				foreach ($allClosing as $closing) {
					$start = (int) $closing->start_date;
					$end = (int) $closing->end_date;
					
					if (($monthYear <> $closing->start_month) and ($monthYear <> $closing->end_month)) {
						$start = 1;
						$end = $daysInMonth;
					} else {
						//if ($end < $start or $end > $daysInMonth) {
						if ($closing->start_month <> $closing->end_month) {
							if ($monthYear == $closing->start_month)
								$end = $daysInMonth;
							else if ($monthYear == $closing->end_month)
								$start = 1;
						}
					}
					
					for ($n=$start; $n<=$end; $n++)
						array_push($totDay, $n);
				}			
				$totDay = count(array_unique($totDay));
				
				/*foreach ($allData as $data) {
					$start_date = new DateTime($data->start_date);
					$end_date = new DateTime($data->end_date);
					$interval = $start_date->diff($end_date);
					
					// hitung total hari
					$totDay += ($interval->d + 1);
				}*/
				
				$kanal = $this->Dashboard_Model->getKanal($productGroup->kanal_id);
				$kanal_name = $kanal->name;
				
				$position = $this->Dashboard_Model->getPosition($position_id);
				$position_name = (count($position) > 0) ? $position->name : "";
				
				// hitung total hari dalam persen
				$occupancy = round(($totDay / $daysInMonth) * 100);
				//$occupancy = number_format($occupancy, 2);
				
				// simpan data ke array
				$data = array(
					"kanal"			=>	$kanal_name,
					"product_group"	=>	$productGroup->name,
					"position"		=>	$position_name,
					"occupancy"		=>	$occupancy,
				);
				
				array_push($arrData, $data);
			}
		}
		
		// sort array terlebih dahulu
		$kanal = array();
		$product_group = array();
		$position = array();
		$occupancy = array();
		foreach ($arrData as $key => $row) {
			$kanal[$key] = $row["kanal"];
			$product_group[$key] = $row["product_group"];
			$position[$key] = $row["position"];
			$occupancy[$key] = $row["occupancy"];
		}
		array_multisort($occupancy, SORT_NUMERIC, SORT_DESC, $arrData);
		
		return $arrData;
	}
}