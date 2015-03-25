<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {
    /* Controller ini untuk menampilkan halaman order
     * Lokasi: ./application/controllers/Order.php 
     */

    private $_access;

    public function __construct() {
        parent::__construct();
        check_session(); // jika session habis, redirect ke logout
        $this->load->model(array("Order_Model", "Transaction_Model", "Request_Model"));
        $this->_access = get_access("PAKET");
        auth($this->_access); // autentikasi menu apakah bisa diakses atau tidak
    }

    public function index() {
        $data["page"] = "order/index";
        $data["menu"] = "order";

        $this->load->view("template", $data);
    }

    private function _generate() {
        $data = $this->Order_Model->getLastNoPaket();

        if (!empty($data)) {
            $noPaket = $data->no_paket;

            $start = strpos($noPaket, "/") + 1;
            $end = strrpos($noPaket, "/") + 1;

            $number = substr($noPaket, $start, $end);
            $number += 1;

            if (strlen($number) == 1)
                $number = "00" . $number;
            else if (strlen($number) == 2)
                $number = "0" . $number;

            $newNoPaket = "P/" . $number . "/" . date("dmY");
        } else {
            $newNoPaket = "P/001/" . date("dmY");
        }

        return $newNoPaket;
        /* echo "<input name='txtNoPaket' id='txtNoPaket' type='text' disabled='disabled' value='".$newNoPaket."' />";
          die; */
    }

    public function cpm_page() {
        $this->load->model(array("Kanal_Model", "Productgroup_Model", "Position_Model"));

        $kanal_id = $this->input->post("kanal_id");
        $product_group_id = $this->input->post("product_group_id");
        $position_id = $this->input->post("position_id");
        $start_date = $this->input->post("start_date");
        $end_date = $this->input->post("end_date");
        $arrCpm = array();

        $dataCpmQuota = $this->Order_Model->getCpmQuota($kanal_id, $product_group_id, $position_id);
        $cpmQuota = $dataCpmQuota->cpm_quota;

        $detailKanal = $this->Kanal_Model->get($kanal_id);
        $detailProductgroup = $this->Productgroup_Model->get($product_group_id);
        $detailPosition = $this->Position_Model->get($position_id);

        $kanal = $detailKanal->name;
        $productGroup = $detailProductgroup->name;
        $position = $detailPosition->name;

        $allCpmUsed = $this->Order_Model->getUsedCpmQuota($kanal_id, $product_group_id, $position_id, $start_date, $end_date);
        foreach ($allCpmUsed as $cpmUsed) {
            $cpm_start_date = $cpmUsed->start_date;
            $cpm_end_date = $cpmUsed->end_date;
            $cpm_quota = $cpmUsed->cpm_quota;

            $arrDateRange = get_date_range($cpm_start_date, $cpm_end_date);
            foreach ($arrDateRange as $rangeDate) {
                $day = $rangeDate;
                $expDate = explode("-", $day);
                $year = $expDate[0];
                $month = $expDate[1];
                $date = $expDate[2];

                if (isset($arrCpm[$year][$month][$date]))
                    $arrCpm[$year][$month][$date] += $cpm_quota;
                else
                    $arrCpm[$year][$month][$date] = $cpm_quota;
            }
        }

        $arrDate = get_date_range($start_date, $end_date);

        $data["all_cpm"] = $arrCpm;
        $data["all_date"] = $arrDate;
        $data["cpm_quota"] = $cpmQuota;
        $data["kanal"] = $kanal;
        $data["product_group"] = $productGroup;
        $data["position"] = $position;
        $data["read"] = $this->_access["read"];

        $this->load->view("order/cpm", $data);
    }

    public function show_page() {
        $no_paket = $this->input->post("id");

        $allData = $this->Order_Model->get($no_paket);
        $allDetail = $this->Order_Model->getDetail($no_paket);
        $allProduction = $this->Order_Model->getProduction($no_paket);
        $allEvent = $this->Order_Model->getEvent($no_paket);
        $nameCatIndustry = $this->Order_Model->getNameCatIndustry($allData->industrycat_id);

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
			$harga[$n] = $this->Order_Model->getHarga($detail->position_id);

            $n += 1;
        }
		
		$arrProduction = array();
		$m = 0;
		foreach ($allProduction as $production) {
            $prod = $this->Order_Model->getSingleProduction($production->production_id);
			$arrProduction[$m]["production"] = $prod->nama;
			$arrProduction[$m]["quantity"] = $production->quantity;
			$arrProduction[$m]["harga"] = $production->harga;
			$arrProduction[$m]["harga_total"] = $production->harga_total;
			$arrProduction[$m]["keterangan"] = $production->keterangan;
			$m += 1;
		}

        /* s: untuk menampilkan data brandcomm jika ada */
        $allDataBrandcomm = array();
        $allDetailBrandcomm = array();
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

        $data["all_data"] = $allData;
        $data["all_detail"] = $allDetail;
        $data["all_data_brandcomm"] = $allDataBrandcomm;
        $data["all_detail_brandcomm"] = $allDetailBrandcomm;
        $data["arr_ads"] = $arrAds;
        $data["arr_kanal"] = $arrKanal;
        $data["arr_productgroup"] = $arrProductGroup;
        $data["arr_position"] = $arrPosition;
        $data["harga"] = $harga;
        $data["read"] = $this->_access["read"];
        $data["name_cat_industry"] = $nameCatIndustry->industry_name;
        $data["all_production"] = $arrProduction;

        $this->load->view("order/show", $data);
    }

    public function insert_page($type = "P") {
        $allIndustryCat = $this->Order_Model->getAllIndustryCat();
        //$allIndustry = $this->Order_Model->getAllIndustry();
        $allDataIndustry = $this->Order_Model->getAllIndustryCatId($allIndustryCat[0]->id);
        $allAds = $this->Order_Model->getAllAds();
        $allKanal = $this->Order_Model->getAllKanal();
        $allProductGroup = $this->Order_Model->getAllProductGroup($allKanal[0]->id);
        $allPosition = $this->Order_Model->getAllPosition($allProductGroup[0]->position_id);
        $allAgency = $this->Order_Model->getAgency();
        $allClient = $this->Order_Model->getClient();
		$harga = $this->Order_Model->getHarga(1,1,1);
        $allProduction = $this->Order_Model->getAllProd();
		$hargaProd = $this->Order_Model->getHargaProd(1);
        $allIndustry = array();

        $arrExp = explode(",", $allDataIndustry->subindustry_id);

        $data = "";
        $tempData = array();
        foreach ($arrExp as $key => $industrycat) {
            $getName = $this->Order_Model->getNameIndustry($industrycat);

            $tempData["id"] = $industrycat;
            $tempData["name"] = $getName->name;

            // convert array jadi object
            $allIndustry[$key] = (object) $tempData;
        }

        /* s: UNTUK MENDAPATKAN DEFAULT CPM POSITION */
        $allDefaultCpmPosition = $this->Order_Model->getCpmPosition($allKanal[0]->id, $allProductGroup[0]->id);
        //$noPaket = $this->_generate();

        $arrDefaultCpmPosition = array();
        foreach ($allDefaultCpmPosition as $defaultCpmPosition)
            $arrDefaultCpmPosition[] = $defaultCpmPosition->position_id;
        /* e: UNTUK MENDAPATKAN DEFAULT CPM POSITION */

        $data["type"] = $type;
        $data["all_industry"] = $allIndustry;
        $data["all_industry_cat"] = $allIndustryCat;
        $data["all_ads"] = $allAds;
        $data["all_kanal"] = $allKanal;
        $data["all_productgroup"] = $allProductGroup;
        $data["all_position"] = $allPosition;
        $data["all_agency"] = $allAgency;
        $data["all_client"] = $allClient;
        $data["all_default_cpm_position"] = $arrDefaultCpmPosition;
        $data["harga"] = $harga;
        $data["all_production"] = $allProduction;
        $data["harga_production"] = $hargaProd;
        //$data["no_paket"] = $noPaket;
        $data["create"] = $this->_access["create"];

        $this->load->view("order/insert", $data);
    }

    public function update_page() {
        $no_paket = $this->input->post("id");

        $allData = $this->Order_Model->get($no_paket);
        $allDetail = $this->Order_Model->getDetail($no_paket);
        //$allIndustry = $this->Order_Model->getAllIndustry();
        $allIndustryCat = $this->Order_Model->getAllIndustryCat();
        $allDataIndustry = $this->Order_Model->getAllIndustryCatId($allData->industrycat_id);
        $allAds = $this->Order_Model->getAllAds();
        $allKanal = $this->Order_Model->getAllKanal();
        $allAgency = $this->Order_Model->getAgency();
        $allClient = $this->Order_Model->getClient();
        $allIndustry = array();
        
        $arrExp = (isset($allDataIndustry->subindustry_id)) ? explode(",", $allDataIndustry->subindustry_id) : array();

        $data = "";
        $tempData = array();
        foreach ($arrExp as $key => $industrycat) {
            $getName = $this->Order_Model->getNameIndustry($industrycat);

            $tempData["id"] = $industrycat;
            $tempData["name"] = $getName->name;

            // convert array jadi object
            $allIndustry[$key] = (object) $tempData;
        }

        // list untuk tambah paket
        $allProductGroup = $this->Order_Model->getAllProductGroup($allKanal[0]->id);
        $allPosition = $this->Order_Model->getAllPosition($allProductGroup[0]->position_id);

        /* s: UNTUK MENDAPATKAN DEFAULT CPM POSITION */
        $allDefaultCpmPosition = $this->Order_Model->getCpmPosition($allKanal[0]->id, $allProductGroup[0]->id);
        //$noPaket = $this->_generate();

        $arrDefaultCpmPosition = array();
        foreach ($allDefaultCpmPosition as $defaultCpmPosition)
            $arrDefaultCpmPosition[] = $defaultCpmPosition->position_id;
        /* e: UNTUK MENDAPATKAN DEFAULT CPM POSITION */

        $arrProductGroup = array();
        $arrPosition = array();
        $arrCpmPosition = array();
        $n = 0;
        foreach ($allDetail as $detail) {
            /* s: UNTUK MENDAPATKAN CPM POSITION */
            $allCpmPosition = $this->Order_Model->getCpmPosition($detail->kanal_id, $detail->product_group_id);

            $m = 0;
            foreach ($allCpmPosition as $cpmPosition) {
                $arrCpmPosition[$n][$m] = $cpmPosition->position_id;
                $m += 1;
            }
            /* e: UNTUK MENDAPATKAN CPM POSITION */

            // untuk mendapatkan list product group dan disimpan di array
            $arrProductGroup[$n] = $this->Order_Model->getAllProductGroup($detail->kanal_id);

            // untuk mendapatkan list position dan disimpan di array
            $productGroup = $this->Order_Model->getProductGroup($detail->product_group_id);
            $arrPosition[$n] = $this->Order_Model->getAllPosition($productGroup->position_id);

			//tambahan untuk harga
			$harga = $this->Order_Model->getHarga($productGroup->position_id);

            $n += 1;
        }

        /* s: untuk menampilkan data brandcomm jika ada */
        $allDataBrandcomm = array();
        $allDetailBrandcomm = array();
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

        $data["all_data"] = $allData;
        $data["all_detail"] = $allDetail;
        $data["all_data_brandcomm"] = $allDataBrandcomm;
        $data["all_detail_brandcomm"] = $allDetailBrandcomm;
        $data["all_industry"] = $allIndustry;
        $data["all_industry_cat"] = $allIndustryCat;
        $data["all_ads"] = $allAds;
        $data["all_kanal"] = $allKanal;
        $data["all_productgroup"] = $allProductGroup;
        $data["all_position"] = $allPosition;
        $data["all_agency"] = $allAgency;
        $data["all_client"] = $allClient;
        $data["arr_productgroup"] = $arrProductGroup;
        $data["arr_position"] = $arrPosition;
        $data["all_cpm_position"] = $arrCpmPosition;
        $data["all_default_cpm_position"] = $arrDefaultCpmPosition;
        $data["harga"] = $harga;
        $data["update"] = $this->_access["update"];

        $this->load->view("order/update", $data);
    }

    public function search_page($type = "S") {
        if ($type == "S") {
            $allData = $this->Order_Model->getSearchSpace();
            $page = "order/search";
        } else {
            $allData = $this->Order_Model->getSearchBrandcomm();
            $page = "order/search_brandcomm";
        }

        $data["all_data"] = $allData;
        $data["create"] = $this->_access["create"];

        $this->load->view($page, $data);
    }

    public function insert_space_page() {
        $this->load->model("Orderspace_Model");

        $no_space = $this->input->post("id");

        $allData = $this->Orderspace_Model->get($no_space);
        $allDetail = $this->Order_Model->getSpaceDetail($no_space);
        $allIndustryCat = $this->Order_Model->getAllIndustryCat();
        //$allIndustry = $this->Orderspace_Model->getAllIndustry();
        $allDataIndustry = $this->Order_Model->getAllIndustryCatId($allData->industrycat_id);
        $allAds = $this->Orderspace_Model->getAllAds();
        $allKanal = $this->Orderspace_Model->getAllKanal();
        $allAgency = $this->Order_Model->getAgency();
        $allClient = $this->Order_Model->getClient();

        $arrExp = explode(",", $allDataIndustry->subindustry_id);

        $data = "";
        $tempData = array();
        foreach ($arrExp as $key => $industrycat) {
            $getName = $this->Order_Model->getNameIndustry($industrycat);

            $tempData["id"] = $industrycat;
            $tempData["name"] = $getName->name;

            // convert array jadi object
            $allIndustry[$key] = (object) $tempData;
        }

        //$noPaket = $this->_generate();
        // list untuk tambah space
        $allProductGroup = $this->Order_Model->getAllProductGroup($allKanal[0]->id);
        $allPosition = $this->Order_Model->getAllPosition($allProductGroup[0]->position_id);

        /* s: UNTUK MENDAPATKAN DEFAULT CPM POSITION */
        $allDefaultCpmPosition = $this->Order_Model->getCpmPosition($allKanal[0]->id, $allProductGroup[0]->id);
        //$noPaket = $this->_generate();

        $arrDefaultCpmPosition = array();
        foreach ($allDefaultCpmPosition as $defaultCpmPosition)
            $arrDefaultCpmPosition[] = $defaultCpmPosition->position_id;
        /* e: UNTUK MENDAPATKAN DEFAULT CPM POSITION */

        $arrProductGroup = array();
        $arrPosition = array();
        $arrCpmPosition = array();
        $n = 0;
        foreach ($allDetail as $detail) {
            /* s: UNTUK MENDAPATKAN CPM POSITION */
            $allCpmPosition = $this->Order_Model->getCpmPosition($detail->kanal_id, $detail->product_group_id);

            $m = 0;
            foreach ($allCpmPosition as $cpmPosition) {
                $arrCpmPosition[$n][$m] = $cpmPosition->position_id;
                $m += 1;
            }
            /* e: UNTUK MENDAPATKAN CPM POSITION */

            // untuk mendapatkan list product group dan disimpan di array
            $arrProductGroup[$n] = $this->Order_Model->getAllProductGroup($detail->kanal_id);

            // untuk mendapatkan list position dan disimpan di array
            $productGroup = $this->Order_Model->getProductGroup($detail->product_group_id);
            $arrPosition[$n] = $this->Order_Model->getAllPosition($productGroup->position_id);

            $n += 1;
        }

        $data["all_data"] = $allData;
        $data["all_detail"] = $allDetail;
        $data["all_industry_cat"] = $allIndustryCat;
        $data["all_industry"] = $allIndustry;
        $data["all_ads"] = $allAds;
        $data["all_kanal"] = $allKanal;
        $data["all_productgroup"] = $allProductGroup;
        $data["all_position"] = $allPosition;
        $data["arr_productgroup"] = $arrProductGroup;
        $data["arr_position"] = $arrPosition;
        $data["all_agency"] = $allAgency;
        $data["all_client"] = $allClient;
        $data["all_default_cpm_position"] = $arrDefaultCpmPosition;
        $data["all_cpm_position"] = $arrCpmPosition;
        //$data["no_paket"] = $noPaket;
        $data["create"] = $this->_access["create"];

        $this->load->view("order/insert_space", $data);
    }

    public function insert_brandcomm_page() {
        $this->load->model("Brandcomm_Model");

        $no_brandcomm = $this->input->post("id");

        $allIndustry = $this->Order_Model->getAllIndustry();
        $allAds = $this->Order_Model->getAllAds();
        $allKanal = $this->Order_Model->getAllKanal();
        $allProductGroup = $this->Order_Model->getAllProductGroup($allKanal[0]->id);
        $allPosition = $this->Order_Model->getAllPosition($allProductGroup[0]->position_id);
        $allAgency = $this->Order_Model->getAgency();
        $allClient = $this->Order_Model->getClient();

        /* s: UNTUK MENDAPATKAN DEFAULT CPM POSITION */
        $allDefaultCpmPosition = $this->Order_Model->getCpmPosition($allKanal[0]->id, $allProductGroup[0]->id);
        //$noPaket = $this->_generate();

        $arrDefaultCpmPosition = array();
        foreach ($allDefaultCpmPosition as $defaultCpmPosition)
            $arrDefaultCpmPosition[] = $defaultCpmPosition->position_id;
        /* e: UNTUK MENDAPATKAN DEFAULT CPM POSITION */

        $allData = $this->Brandcomm_Model->get($no_brandcomm);
        $allDetail = $this->Brandcomm_Model->getDetail($no_brandcomm);

        $allItem = $this->Brandcomm_Model->getAllItem();

        $data["all_data"] = $allData;
        $data["all_detail"] = $allDetail;
        $data["all_item"] = $allItem;
        $data["all_industry"] = $allIndustry;
        $data["all_ads"] = $allAds;
        $data["all_kanal"] = $allKanal;
        $data["all_productgroup"] = $allProductGroup;
        $data["all_position"] = $allPosition;
        $data["all_agency"] = $allAgency;
        $data["all_client"] = $allClient;
        $data["all_default_cpm_position"] = $arrDefaultCpmPosition;
        //$data["no_paket"] = $noPaket;
        $data["create"] = $this->_access["create"];

        $this->load->view("order/insert_brandcomm", $data);
    }

    public function progress_page() {
        $no_paket = $this->input->post("id");

        $allData = $this->Order_Model->getProgress($no_paket);

        $data["no_paket"] = $no_paket;
        $data["percent"] = $allData->progress;
        $data["progress"] = $this->_access["progress"];

        $this->load->view("order/progress", $data);
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

        $allData = $this->Order_Model->getAll($startLimit, $endLimit, $orderBy);

        // untuk mendapatkan total page
        $total = $this->Order_Model->getTotal($orderBy);
        $totalPage = ceil($total / $this->config->item("show_per_page"));

        $data["start_no"] = ($page * $this->config->item("show_per_page")) + 1;
        $data["all_data"] = $allData;
        $data["total_page"] = $totalPage;
        $data["page"] = $page + 1;
        $data["order_by"] = $orderBy;
        $data["read"] = $this->_access["read"];
        $data["update"] = $this->_access["update"];
        $data["delete"] = $this->_access["delete"];
        $data["progress"] = $this->_access["progress"];

        $this->load->view("order/content", $data);
    }

    public function insert() {
        if ($this->_access["create"] <> "Y")
            redirect("dashboard", "refresh");

        $arrParam = $this->input->post("arrParam");
        $packet_type = $arrParam[0];
        //$no_paket = $arrParam[1];
        $no = $arrParam[1];
        $agency_id = $arrParam[2];
        $client_id = $arrParam[3];
        $budget = $arrParam[4];
        $diskon = $arrParam[5];
        $benefit = $arrParam[6];
        $selectAds = $arrParam[7];
        $selectKanal = $arrParam[8];
        $selectProductGroup = $arrParam[9];
        $selectPosition = $arrParam[10];
        $txtStartDate = $arrParam[11];
        $txtEndDate = $arrParam[12];
        $isRestrict = $arrParam[13];
        $industry_id = $arrParam[14];
        $miscInfo = $arrParam[15];
        $miscInfoPaket = $arrParam[16];
        $miscInfoEvent = "";
        $miscInfoProductionCost = "";
        $cpmQuota = $arrParam[19];
        $industrycat_id = $arrParam[20];
        $harga_sistem = $arrParam[21];
        $harga_gross = $arrParam[22];
        $disc_nominal = $arrParam[23];
        $additional_disc = $arrParam[24];
        $additional_disc_nominal = $arrParam[25];
        $selectProduction = $arrParam[26];
        $txtQty = $arrParam[27];
        $txtHargaProd = $arrParam[28];
        $txtHargaProdTotal = $arrParam[29];
        $txtInfoProd = $arrParam[30];
        $txtEvent = $arrParam[31];
        $txtStartDateEvent = $arrParam[32];
        $txtEndDateEvent = $arrParam[33];
        $txtHargaEvent = $arrParam[34];
        $txtInfoEvent = $arrParam[35];
        $total_harga = $arrParam[36];
        $total_production = $arrParam[37];
        $total_event = $arrParam[38];
        $pajak = $arrParam[39];
        $total_semua = $arrParam[40];
        $date = true;
        $validNo = true;
        $tempIdInUse = "";
        $tempIdConflict = "";
        $tempIdDateWrong = "";
        $tempIdCpmQuota = "";
        $tempIdCpmQuotaEmpty = "";

        // mengecek apakah no space yang dimasukkan valid
        if ($packet_type == "N") {
            $space = $this->Order_Model->getSpace($no);
            $totSpace = count($space);
            if ($totSpace < 1)
                $validNo = false;
        } else if ($packet_type == "B") {
            $brandcomm = $this->Order_Model->getBrandcomm($no);
            $totBrandcomm = count($brandcomm);
            if ($totBrandcomm < 1)
                $validNo = false;
        }

        // mengecek apakah ada kolom isian yang kosong di paket
        if (!empty($selectAds)) {
            // for ($n=0; $n<count($selectAds); $n++) {
            // if (empty($txtStartDate[$n]["value"]) or empty($txtEndDate[$n]["value"])) {
            // $date = false;
            // break;
            // }
            // }
            // mengecek paket yang posisinya sudah digunakan
            if ($date) {
                for ($n = 0; $n < count($selectAds); $n++) {
                    $kanal_id = $selectKanal[$n]["value"];
                    $product_group_id = $selectProductGroup[$n]["value"];
                    $position_id = $selectPosition[$n]["value"];
                    $start_date = $txtStartDate[$n]["value"];
                    $end_date = $txtEndDate[$n]["value"];
                    $cpm_quota = str_replace(".", "", $cpmQuota[$n]["value"]);

                    // mengecek jika end_date < dari start_date
                    $start_date_compare = strtotime($start_date);
                    $end_date_compare = strtotime($end_date);
                    $today_compare = strtotime(date("Y-m-d"));

                    if (!empty($start_date_compare) or !empty($end_date_compare)) {
                        if ($end_date_compare < $start_date_compare or $start_date_compare < $today_compare or $end_date_compare < $today_compare)
                            $tempIdDateWrong .= $n . ",";
                    }

                    // mengecek apakah posisi yang akan digunakan dapat ditimpa (allow override) atau tidak
//                              $position = $this->Order_Model->getPosition($position_id);
//                              $allow_override = $position->allow_override;
//                              if ($allow_override == "N") {
                    $isOverride = $this->Order_Model->isOverride($kanal_id, $product_group_id, $position_id);
                    if ($isOverride == 0) {
                        // mengecek apakah posisi sudah digunakan sebelumnya (dari database)
                        $positionInUse = $this->Order_Model->getPositionInUse($kanal_id, $product_group_id, $position_id, $start_date, $end_date);
                        if (count($positionInUse) > 0)
                            $tempIdInUse .= $n . ",";

                        // untuk mengecek apakah posisi sudah digunakan sebelumnya (dari inputan baru)
                        for ($m = 0; $m < $n; $m++) {
                            $kanal_id_new = $selectKanal[$m]["value"];
                            $product_group_id_new = $selectProductGroup[$m]["value"];
                            $position_id_new = $selectPosition[$m]["value"];
                            $start_date_new = $txtStartDate[$m]["value"];
                            $end_date_new = $txtEndDate[$m]["value"];

                            // jika kanal, product_group, dan posisi sama, cek start_date dan end_date nya
                            if ($kanal_id == $kanal_id_new and $product_group_id == $product_group_id_new and $position_id == $position_id_new) {
                                $start_date_strtotime = strtotime($start_date);
                                $end_date_strtotime = strtotime($end_date);
                                $start_date_new_strtotime = strtotime($start_date_new);
                                $end_date_new_strtotime = strtotime($end_date_new);

                                // untuk mengecek apakah tanggal konflik
                                if (($start_date_strtotime >= $start_date_new_strtotime and $start_date_strtotime <= $end_date_new_strtotime) or ($end_date_strtotime >= $start_date_new_strtotime and $end_date_strtotime <= $end_date_new_strtotime))
                                    $tempIdInUse .= $n . ",";
                            }
                        }
                    } else {
                        // untuk mengecek kuota CPM
                        $dataCpmQuota = $this->Order_Model->getCpmQuota($kanal_id, $product_group_id, $position_id);
                        $usedCpmQuota = $this->Order_Model->getUsedCpmQuota($kanal_id, $product_group_id, $position_id, $start_date, $end_date);

                        $totCpmQuota = $dataCpmQuota->cpm_quota;
                        $totUsedCpmQuota = 0;
                        foreach ($usedCpmQuota as $used)
                            $totUsedCpmQuota += $used->cpm_quota;

                        $totUsedCpmQuota += $cpm_quota;

                        if ($cpm_quota < 1)
                            $tempIdCpmQuotaEmpty .= $n . ",";
                        elseif ($totUsedCpmQuota > $totCpmQuota)
                            $tempIdCpmQuota .= $n . ",";
                    }
                }

                if (!empty($tempIdDateWrong))
                    $tempIdDateWrong = substr($tempIdDateWrong, 0, -1); // untuk menghilangkan "," dibelakang
                if (!empty($tempIdInUse))
                    $tempIdInUse = substr($tempIdInUse, 0, -1); // untuk menghilangkan "," dibelakang					
                if (!empty($tempIdCpmQuota))
                    $tempIdCpmQuota = substr($tempIdCpmQuota, 0, -1); // untuk menghilangkan "," dibelakang
                if (!empty($tempIdCpmQuotaEmpty))
                    $tempIdCpmQuotaEmpty = substr($tempIdCpmQuotaEmpty, 0, -1); // untuk menghilangkan "," dibelakang
            }

            // mengecek paket conflict
            if ($isRestrict == "true" and $date) {
                for ($n = 0; $n < count($selectAds); $n++) {
                    $kanal_id = $selectKanal[$n]["value"];
                    $product_group_id = $selectProductGroup[$n]["value"];
                    $position_id = $selectPosition[$n]["value"];
                    $start_date = $txtStartDate[$n]["value"];
                    $end_date = $txtEndDate[$n]["value"];

                    $allPaketRestrict = $this->Order_Model->getAllPaketRestrict($industry_id, $kanal_id, $product_group_id, $start_date, $end_date);
                    $rule = $this->Order_Model->getAllRule($industry_id, $kanal_id, $product_group_id);

                    /* untuk mengambil nama posisi dari rule */
                    $arrTempRule = array();
                    $allRule = explode(":", $rule->position_id);

                    foreach ($allPaketRestrict as $paketRestrict) {
                        foreach ($allRule as $positions) {
                            $arrPosition = explode(",", $positions);

                            //if (stristr($positions, $position_id) and stristr($positions, $paketRestrict->position_id)) {
                            if (in_array($position_id, $arrPosition) and in_array($paketRestrict->position_id, $arrPosition)) {
                                $tempIdConflict .= $n . ",";
                                break 2;
                            }
                        }
                    }
                }

                if (!empty($tempIdConflict))
                    $tempIdConflict = substr($tempIdConflict, 0, -1); // untuk menghilangkan "," dibelakang
            }
        } else {
            $date = false;
        }

        if (($packet_type == "N" and empty($no)) or empty($agency_id) or empty($client_id) or empty($diskon) or empty($selectAds) or $tempIdConflict <> "" or $tempIdInUse <> "" or $tempIdCpmQuotaEmpty <> "" or $tempIdCpmQuota <> "" or $tempIdDateWrong <> "" or !$validNo or empty($industrycat_id) or empty($industry_id)) {
            $data["status"] = false;
            $data["error"] = array();
            $data["error"]["tot_row"] = count($selectAds);
            if ($packet_type <> "Y" and empty($no))
                array_push($data["error"], "txtNo");
            /* if (empty($no_paket))
              array_push($data["error"], "txtNoPaket"); */
            if (empty($agency_id))
                array_push($data["error"], "txtAgency");
            if (empty($client_id))
                array_push($data["error"], "txtClient");
            if (empty($diskon))
                array_push($data["error"], "txtDiskon");
            /* if (!$date)
              array_push($data["error"], "txtDate"); */
            if (empty($selectAds))
                array_push($data["error"], "txtDate");
            if ($tempIdConflict <> "") {
                array_push($data["error"], "txtConflict");
                $data["error"]["idConflict"] = $tempIdConflict;
            }
            if ($tempIdInUse <> "") {
                array_push($data["error"], "txtInUse");
                $data["error"]["idInUse"] = $tempIdInUse;
            }
            if ($tempIdCpmQuotaEmpty <> "") {
                array_push($data["error"], "txtCpmEmpty");
                $data["error"]["idCpmQuotaEmpty"] = $tempIdCpmQuotaEmpty;
            }
            if ($tempIdCpmQuota <> "") {
                array_push($data["error"], "txtCpm");
                $data["error"]["idCpmQuota"] = $tempIdCpmQuota;
            }
            if ($tempIdDateWrong <> "") {
                array_push($data["error"], "txtDateWrong");
                $data["error"]["idDateWrong"] = $tempIdDateWrong;
            }
            if (!$validNo)
                array_push($data["error"], "txtValidNo");
        } else {
            $no_paket = $this->_generate();

            if ($packet_type == "Y")
                $no = "";

            $this->Transaction_Model->transaction_start();
            try {
                $insert = $this->Order_Model->insertOrderPaket($no_paket, $agency_id, $client_id, $budget, $diskon, $benefit, $isRestrict, $industry_id, $no, $miscInfo, $miscInfoEvent, $miscInfoProductionCost, $industrycat_id, $harga_sistem, $harga_gross, $disc_nominal, $harga_disc, $pajak, $total_harga);
                if ($insert !== true)
                    throw new Exception($insert);

                for ($n = 0; $n < count($selectAds); $n++) {
                    $ads_id = $selectAds[$n]["value"];
                    $kanal_id = $selectKanal[$n]["value"];
                    $product_group_id = $selectProductGroup[$n]["value"];
                    $position_id = $selectPosition[$n]["value"];
                    $start_date = $txtStartDate[$n]["value"];
                    $end_date = $txtEndDate[$n]["value"];
                    $misc_info_paket = $miscInfoPaket[$n]["value"];
                    $cpm_quota = str_replace(".", "", $cpmQuota[$n]["value"]);

                    $insert = $this->Order_Model->insertOrderPaketAds($no_paket, $ads_id, $kanal_id, $product_group_id, $position_id, $start_date, $end_date, $misc_info_paket, $cpm_quota);
                    if ($insert !== true)
                        throw new Exception($insert);
                }
				
				if (count($selectProduction) > 0) {
					for ($m = 0; $m < count($selectProduction); $m++) {
						$production_id = $selectProduction[$m]["value"];
						$quantity = $txtQty[$m]["value"];
						$hargaProd = $txtHargaProd[$m]["value"];
						$hargaProd = str_replace(".", "", $hargaProd);
						$hargaProdTotal = $txtHargaProdTotal[$m]["value"];
						$hargaProdTotal = str_replace(".", "", $hargaProdTotal);
						$keterangan = $txtInfoProd[$m]["value"];
						
						$insertProd = $this->Order_Model->insertOrderProduction($no_paket, $production_id, $quantity, $hargaProd, $hargaProdTotal, $keterangan);
						if ($insertProd !== true)
							throw new Exception($insertProd);
					}					
				}
				
				if (count($txtEvent) > 0) {
					for ($o = 0; $o < count($txtEvent); $o++) {
						$event = $txtEvent[$o]["value"];
						$event_start = $txtStartDateEvent[$o]["value"];
						$event_end = $txtEndDateEvent[$o]["value"];
						$hargaEvent = $txtHargaEvent[$o]["value"];
						$infoEvent = $txtInfoEvent[$o]["value"];
						
						$insertEvent = $this->Order_Model->insertOrderEvent($no_paket, $event, $event_start, $event_end, $hargaEvent, $infoEvent);
						if ($insertEvent !== true)
							throw new Exception($insertEvent);
					}
				}
				
				$insertHarga = $this->Order_Model->insertOrderHarga($no_paket, $harga_sistem, $harga_gross, $disc_nominal, $additional_disc, $additional_disc_nominal, $total_harga, $total_production, $total_event, $pajak, $total_semua);
                if ($insertHarga !== true)
                    throw new Exception($insertHarga);

                if ($packet_type <> "Y") {
                    $insert = $this->Order_Model->updateStatusIsOrderPaket($no, $packet_type);
                    if ($insert !== true)
                        throw new Exception($insert);
                }
            } catch (Exception $e) {
                $insert = $e->getMessage();
            }
            $this->Transaction_Model->transaction_complete();

            $data["status"] = $insert;
        }

        echo json_encode($data);
        die;
    }

    public function update() {
        if ($this->_access["update"] <> "Y")
            redirect("dashboard", "refresh");

        $arrParam = $this->input->post("arrParam");
        $no_paket = $arrParam[0];
        $agency_id = $arrParam[1];
        $client_id = $arrParam[2];
        $budget = $arrParam[3];
        $diskon = $arrParam[4];
        $benefit = $arrParam[5];
        $selectAds = $arrParam[6];
        $selectKanal = $arrParam[7];
        $selectProductGroup = $arrParam[8];
        $selectPosition = $arrParam[9];
        $txtStartDate = $arrParam[10];
        $txtEndDate = $arrParam[11];
        $isRestrict = $arrParam[12];
        $industry_id = $arrParam[13];
        $miscInfo = $arrParam[14];
        $miscInfoPaket = $arrParam[15];
        $miscInfoEvent = $arrParam[16];
        $miscInfoProductionCost = $arrParam[17];
        $cpmQuota = $arrParam[18];
        $hdStartDate = $arrParam[19];
        $hdEndDate = $arrParam[20];
        $industrycat_id = $arrParam[21];
        $harga_sistem = $arrParam[22];
        $harga_gross = $arrParam[23];
        $disc_nominal = $arrParam[24];
        $harga_disc = $arrParam[25];
        $pajak = $arrParam[26];
        $total_harga = $arrParam[27];
        $date = true;
        $tempIdInUse = "";
        $tempIdConflict = "";
        $tempIdDateWrong = "";
        $tempIdCpmQuota = "";
        $tempIdCpmQuotaEmpty = "";
        
        // mengecek apakah ada kolom isian yang kosong di paket
        if (!empty($selectAds)) {
            // for ($n=0; $n<count($selectAds); $n++) {
            // if (empty($txtStartDate[$n]["value"]) or empty($txtEndDate[$n]["value"])) {
            // $date = false;
            // break;
            // }
            // }
            // mengecek paket yang posisinya sudah digunakan
            if ($date) {
                for ($n = 0; $n < count($selectAds); $n++) {
                    $kanal_id = $selectKanal[$n]["value"];
                    $product_group_id = $selectProductGroup[$n]["value"];
                    $position_id = $selectPosition[$n]["value"];
                    $start_date = $txtStartDate[$n]["value"];
                    $end_date = $txtEndDate[$n]["value"];
                    $cpm_quota = str_replace(".", "", $cpmQuota[$n]["value"]);
                    $hd_start_date = (isset($hdStartDate[$n]["value"])) ? $hdStartDate[$n]["value"] : "";
                    $hd_end_date = (isset($hdEndDate[$n]["value"])) ? $hdEndDate[$n]["value"] : "";

                    // mengecek jika end_date < dari start_date
                    $start_date_compare = strtotime($start_date);
                    $end_date_compare = strtotime($end_date);
                    $today_compare = strtotime(date("Y-m-d"));

                    if ($start_date <> $hd_start_date or $end_date <> $hd_end_date) {
                        if (!empty($start_date_compare) or !empty($end_date_compare)) {
                            if ($end_date_compare < $start_date_compare or $start_date_compare < $today_compare or $end_date_compare < $today_compare)
                                $tempIdDateWrong .= $n . ",";
                        }
                    }

                    // mengecek apakah posisi yang akan digunakan dapat ditimpa (allow override) atau tidak
//                              $position = $this->Order_Model->getPosition($position_id);
//                              $allow_override = $position->allow_override;
//                              if ($allow_override == "N") {
                    $isOverride = $this->Order_Model->isOverride($kanal_id, $product_group_id, $position_id);
                    if ($isOverride == 0) {
                        // mengecek apakah posisi sudah digunakan sebelumnya (dari database)
                        $positionInUse = $this->Order_Model->getPositionInUse($kanal_id, $product_group_id, $position_id, $start_date, $end_date, $no_paket);
                        if (count($positionInUse) > 0)
                            $tempIdInUse .= $n . ",";

                        // untuk mengecek apakah posisi sudah digunakan sebelumnya (dari inputan baru)
                        for ($m = 0; $m < $n; $m++) {
                            $kanal_id_new = $selectKanal[$m]["value"];
                            $product_group_id_new = $selectProductGroup[$m]["value"];
                            $position_id_new = $selectPosition[$m]["value"];
                            $start_date_new = $txtStartDate[$m]["value"];
                            $end_date_new = $txtEndDate[$m]["value"];

                            // jika kanal, product_group, dan posisi sama, cek start_date dan end_date nya
                            if ($kanal_id == $kanal_id_new and $product_group_id == $product_group_id_new and $position_id == $position_id_new) {
                                $start_date_strtotime = strtotime($start_date);
                                $end_date_strtotime = strtotime($end_date);
                                $start_date_new_strtotime = strtotime($start_date_new);
                                $end_date_new_strtotime = strtotime($end_date_new);

                                // untuk mengecek apakah tanggal konflik
                                if (($start_date_strtotime >= $start_date_new_strtotime and $start_date_strtotime <= $end_date_new_strtotime) or ($end_date_strtotime >= $start_date_new_strtotime and $end_date_strtotime <= $end_date_new_strtotime))
                                    $tempIdInUse .= $n . ",";
                            }
                        }
                    } else {
                        // untuk mengecek kuota CPM
                        $dataCpmQuota = $this->Order_Model->getCpmQuota($kanal_id, $product_group_id, $position_id);
                        $usedCpmQuota = $this->Order_Model->getUsedCpmQuota($kanal_id, $product_group_id, $position_id, $start_date, $end_date);

                        $totCpmQuota = $dataCpmQuota->cpm_quota;
                        $totUsedCpmQuota = 0;
                        foreach ($usedCpmQuota as $used)
                            $totUsedCpmQuota += $used->cpm_quota;

                        $totUsedCpmQuota += $cpm_quota;

                        if ($cpm_quota < 1)
                            $tempIdCpmQuotaEmpty .= $n . ",";
                        elseif ($totUsedCpmQuota > $totCpmQuota)
                            $tempIdCpmQuota .= $n . ",";
                    }
                }

                if (!empty($tempIdDateWrong))
                    $tempIdDateWrong = substr($tempIdDateWrong, 0, -1); // untuk menghilangkan "," dibelakang
                if (!empty($tempIdInUse))
                    $tempIdInUse = substr($tempIdInUse, 0, -1); // untuk menghilangkan "," dibelakang
                if (!empty($tempIdCpmQuota))
                    $tempIdCpmQuota = substr($tempIdCpmQuota, 0, -1); // untuk menghilangkan "," dibelakang
                if (!empty($tempIdCpmQuotaEmpty))
                    $tempIdCpmQuotaEmpty = substr($tempIdCpmQuotaEmpty, 0, -1); // untuk menghilangkan "," dibelakang
            }

            // mengecek paket conflict
            if ($isRestrict == "true" and $date) {
                for ($n = 0; $n < count($selectAds); $n++) {
                    $kanal_id = $selectKanal[$n]["value"];
                    $product_group_id = $selectProductGroup[$n]["value"];
                    $position_id = $selectPosition[$n]["value"];
                    $start_date = $txtStartDate[$n]["value"];
                    $end_date = $txtEndDate[$n]["value"];

                    $allPaketRestrict = $this->Order_Model->getAllPaketRestrict($industry_id, $kanal_id, $product_group_id, $start_date, $end_date, $no_paket);
                    $rule = $this->Order_Model->getAllRule($industry_id, $kanal_id, $product_group_id);

                    /* untuk mengambil nama posisi dari rule */
                    $arrTempRule = array();
                    $allRule = (isset($rule->position_id)) ? explode(":", $rule->position_id) : array();

                    foreach ($allPaketRestrict as $paketRestrict) {
                        foreach ($allRule as $positions) {
                            $arrPosition = explode(",", $positions);

                            //if (stristr($positions, $position_id) and stristr($positions, $paketRestrict->position_id)) {
                            if (in_array($position_id, $arrPosition) and in_array($paketRestrict->position_id, $arrPosition)) {
                                $tempIdConflict .= $n . ",";
                                break 2;
                            }
                        }
                    }
                }

                if (!empty($tempIdConflict))
                    $tempIdConflict = substr($tempIdConflict, 0, -1); // untuk menghilangkan "," dibelakang
            }
        } else {
            $date = false;
        }

        if (empty($no_paket) or empty($agency_id) or empty($client_id) or empty($diskon) or empty($selectAds) or $tempIdConflict <> "" or $tempIdInUse <> "" or $tempIdCpmQuotaEmpty <> "" or $tempIdCpmQuota <> "" or $tempIdDateWrong <> "") {
            $data["status"] = false;
            $data["error"] = array();
            $data["error"]["tot_row"] = count($selectAds);
            if (empty($no_paket))
                array_push($data["error"], "txtNoPaket");
            if (empty($agency_id))
                array_push($data["error"], "txtAgency");
            if (empty($client_id))
                array_push($data["error"], "txtClient");
            if (empty($diskon))
                array_push($data["error"], "txtDiskon");
            /* if (!$date)
              array_push($data["error"], "txtDate"); */
            if (empty($selectAds))
                array_push($data["error"], "txtDate");
            if ($tempIdConflict <> "") {
                array_push($data["error"], "txtConflict");
                $data["error"]["idConflict"] = $tempIdConflict;
            }
            if ($tempIdInUse <> "") {
                array_push($data["error"], "txtInUse");
                $data["error"]["idInUse"] = $tempIdInUse;
            }
            if ($tempIdCpmQuotaEmpty <> "") {
                array_push($data["error"], "txtCpmEmpty");
                $data["error"]["idCpmQuotaEmpty"] = $tempIdCpmQuotaEmpty;
            }
            if ($tempIdCpmQuota <> "") {
                array_push($data["error"], "txtCpm");
                $data["error"]["idCpmQuota"] = $tempIdCpmQuota;
            }
            if ($tempIdDateWrong <> "") {
                array_push($data["error"], "txtDateWrong");
                $data["error"]["idDateWrong"] = $tempIdDateWrong;
            }
        } else {
            $this->Transaction_Model->transaction_start();
            try {
                $update = $this->Order_Model->updateOrderPaket($no_paket, $agency_id, $client_id, $budget, $diskon, $benefit, $isRestrict, $industry_id, $miscInfo, $miscInfoEvent, $miscInfoProductionCost, $industrycat_id, $harga_sistem, $harga_gross, $disc_nominal, $harga_disc, $pajak, $total_harga);
                if ($update !== true)
                    throw new Exception($update);

                // delete semua paket ads berdasarkan no paketnya
                $update = $this->Order_Model->deleteOrderPaketAds($no_paket);
                if ($update !== true)
                    throw new Exception($update);

                // insert paket ads yang di request
                for ($n = 0; $n < count($selectAds); $n++) {
                    $ads_id = $selectAds[$n]["value"];
                    $kanal_id = $selectKanal[$n]["value"];
                    $product_group_id = $selectProductGroup[$n]["value"];
                    $position_id = $selectPosition[$n]["value"];
                    $start_date = $txtStartDate[$n]["value"];
                    $end_date = $txtEndDate[$n]["value"];
                    $misc_info_paket = $miscInfoPaket[$n]["value"];
                    $cpm_quota = str_replace(".", "", $cpmQuota[$n]["value"]);

                    $update = $this->Order_Model->insertOrderPaketAds($no_paket, $ads_id, $kanal_id, $product_group_id, $position_id, $start_date, $end_date, $misc_info_paket, $cpm_quota);
                    if ($update !== true)
                        throw new Exception($update);
                }
            } catch (Exception $e) {
                $update = $e->getMessage();
            }
            $this->Transaction_Model->transaction_complete();

            $data["status"] = $update;
        }

        echo json_encode($data);
        die;
    }

    public function progress() {
        if ($this->_access["progress"] <> "Y")
            redirect("dashboard", "refresh");

        $arrParam = $this->input->post("arrParam");
        $no_paket = $arrParam[0];
        $percent = $arrParam[1];

        $update = $this->Order_Model->progress($no_paket, $percent);

        $data["status"] = $update;

        echo json_encode($data);
        die;
    }

    public function delete() {
        if ($this->_access["delete"] <> "Y")
            redirect("dashboard", "refresh");

        $arrParam = $this->input->post("arrParam");
        $no_paket = $arrParam[0];

        $delete = $this->Order_Model->delete($no_paket);

        $data["status"] = $delete;

        echo json_encode($data);
        die;
    }

    public function get_product_group($kanal_id) {
        $allProductGroup = $this->Order_Model->getAllProductGroup($kanal_id);

        $data = "";
        foreach ($allProductGroup as $productgroup)
            $data .= "<option value='" . $productgroup->id . "'>" . $productgroup->name . "</option>";

        echo $data;
        die;
    }

    public function get_industrycat($industrycat_id) {
        $allIndustryCat = $this->Order_Model->getAllIndustryCatId($industrycat_id);

        $arrExp = explode(",", $allIndustryCat->subindustry_id);

        $data = "";
        foreach ($arrExp as $industrycat) {
            $getName = $this->Order_Model->getNameIndustry($industrycat);
            $data .= "<option value='" . $industrycat . "'>" . $getName->name . "</option>";
        }

        echo $data;
        die;
    }

    public function get_position($id) {
        $productGroup = $this->Order_Model->getProductGroup($id);
        $allPosition = $this->Order_Model->getAllPosition($productGroup->position_id);
        $allCpmPosition = $this->Order_Model->getCpmPosition($productGroup->kanal_id, $productGroup->id);

        // TAMPUNG POSISI CPM KE ARRAY
        $arrCpmPosition = array();
        foreach ($allCpmPosition as $cpmPosition)
            $arrCpmPosition[] = $cpmPosition->position_id;

        $data = "";
        foreach ($allPosition as $position) {
            $isCpm = (in_array($position->id, $arrCpmPosition)) ? "Y" : "N";

            $data .= "<option value='" . $position->id . "' rel='" . $isCpm . "'>" . $position->name . "</option>";
        }

        echo $data;
        die;
    }

    /* public function get_ae() {
      $name = $this->input->get("term");

      $allAe = $this->Order_Model->getAe($name);

      $arrData = array();
      foreach ($allAe as $ae)
      array_push($arrData, array("username" => $ae->username, "label" => $ae->name, "value" => $ae->name));

      echo json_encode($arrData);
      die;
      } */

    public function get_space() {
        $id = $this->input->get("term");

        $allSpace = $this->Order_Model->getSpace($id);

        $arrData = array();
        foreach ($allSpace as $space) {
            $temp = array(
                "label" => $space->no_space,
                "value" => $space->no_space,
                "agency_id" => $space->agency_id,
                "agency" => $space->agency,
                "client_id" => $space->client_id,
                "client" => $space->client,
                "is_restrict" => $space->is_restrict,
                "industrycat_id" => $space->industrycat_id,
                "industry_id" => $space->industry_id,
                    // "ae_username"		=>	$space->order_by,
                    // "ae_name"			=>	$space->name,
            );

            array_push($arrData, $temp);
        }

        echo json_encode($arrData);
        die;
    }

    public function get_space_detail() {
        $no_space = $this->input->post("id");

        $allDetail = $this->Order_Model->getSpaceDetail($no_space);
        $allAds = $this->Order_Model->getAllAds();
        $allKanal = $this->Order_Model->getAllKanal();

        // list untuk tambah space
        $allProductGroup = $this->Order_Model->getAllProductGroup($allKanal[0]->id);
        $allPosition = $this->Order_Model->getAllPosition($allProductGroup[0]->position_id);

        $arrProductGroup = array();
        $arrPosition = array();
        $arrCpmPosition = array();
        $n = 0;
        foreach ($allDetail as $detail) {
            /* s: UNTUK MENDAPATKAN CPM POSITION */
            $allCpmPosition = $this->Order_Model->getCpmPosition($detail->kanal_id, $detail->product_group_id);

            $m = 0;
            foreach ($allCpmPosition as $cpmPosition) {
                $arrCpmPosition[$n][$m] = $cpmPosition->position_id;
                $m += 1;
            }
            /* e: UNTUK MENDAPATKAN CPM POSITION */

            // untuk mendapatkan list product group dan disimpan di array
            $arrProductGroup[$n] = $this->Order_Model->getAllProductGroup($detail->kanal_id);

            // untuk mendapatkan list position dan disimpan di array
            $productGroup = $this->Order_Model->getProductGroup($detail->product_group_id);
            $arrPosition[$n] = $this->Order_Model->getAllPosition($productGroup->position_id);

            $n += 1;
        }

        $data["all_detail"] = $allDetail;
        $data["all_ads"] = $allAds;
        $data["all_kanal"] = $allKanal;
        $data["all_productgroup"] = $allProductGroup;
        $data["all_position"] = $allPosition;
        $data["arr_productgroup"] = $arrProductGroup;
        $data["arr_position"] = $arrPosition;
        $data["all_cpm_position"] = $arrCpmPosition;

        $this->load->view("order/detail", $data);
    }

    public function get_brandcomm() {
        $id = $this->input->get("term");

        $allBrandcomm = $this->Order_Model->getBrandcomm($id);

        $arrData = array();
        foreach ($allBrandcomm as $brandcomm) {
            $temp = array(
                "label" => $brandcomm->no_brandcomm,
                "value" => $brandcomm->no_brandcomm,
            );

            array_push($arrData, $temp);
        }

        echo json_encode($arrData);
        die;
    }

    public function get_brandcomm_detail() {
        $this->load->model("Brandcomm_Model");

        $no_brandcomm = $this->input->post("id");

        $allData = $this->Brandcomm_Model->get($no_brandcomm);
        $allDetail = $this->Brandcomm_Model->getDetail($no_brandcomm);

//            $allItem = $this->Brandcomm_Model->getAllItem();

        $data["all_data"] = $allData;
        $data["all_detail"] = $allDetail;
//            $data["all_item"] = $allItem;

        $this->load->view("order/detail_brandcomm", $data);
    }

    public function get_harga($idKanal, $idProduct, $idPosition) {
        $harga = $this->Order_Model->getHarga($idKanal, $idProduct, $idPosition);

        $data = '<input name="txtHarga" id="txtHarga" type="text" readonly="readonly" style="width: 70px;" value="' . number_format($harga->harga,0,",",".") . '" />';

        echo $data;
        die;
    }

    public function get_harga_total($idKanal, $idProduct, $idPosition) {
        $harga = $this->Order_Model->getHarga($idKanal, $idProduct, $idPosition);

        $data = '<input name="txtHargaTotal" id="txtHargaTotal" type="text" readonly="readonly" style="width: 70px;" value="' . number_format($harga->harga,0,",",".") . '" />';

        echo $data;
        die;
    }

    public function get_harga_prod($id) {
        $hargaProd = $this->Order_Model->getHargaProd($id);

        $data = '<input name="txtHarga" id="txtHarga" type="text" readonly="readonly" style="width: 90px;" value="' . number_format($hargaProd->harga,0,",",".") . '" />';

        echo $data;
        die;
    }

    public function get_harga_prod_total($id) {
        $hargaProd = $this->Order_Model->getHargaProd($id);

        $data = '<input name="txtHargaTotal" id="txtHargaTotal" type="text" readonly="readonly" style="width: 90px;" value="' . number_format($hargaProd->harga,0,",",".") . '" />';

        echo $data;
        die;
    }
}
