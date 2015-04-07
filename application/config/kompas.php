<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

$config['menu'] = array(
    'dashboard' => "Dashboard",
    'calendar' => "Kalender",
    'master' => "Master",
    'order' => "Order",
    'timeline' => "Timeline",
    'tayang' => "Tayang",
    'backdate' => "Backdate",
    'report' => "Report",
    'offer_position' => "Offer Position",
    'myaccount' => "Akun Saya",
    'logout' => "Logout",
);

$config['submenu'] = array(
    'calendar' => array(
        'calendar' => '',
    ),
    'master' => array(
        'client' => 'Brand',
        'agency' => 'Perusahaan',
        'level' => 'Level',
        'department' => 'Departemen',
        'user' => 'User',
        'iklan' => 'Iklan',
        'kanal' => 'Kanal',
        'posisi' => 'Posisi',
        'produkgrup' => 'Produk Grup',
		'harga' => 'Harga',
        'production' => 'Production',
        'categoryindustry' => 'Kategori Industri',
        'industry' => 'Sub Industri',
        'conflictbrand' => 'Conflict Brand',
        'masterbrandcomm' => 'Brandcomm',
        'cpm' => 'Cpm',
    ),
    'order' => array(
        'paket' => 'Paket',
        // 'space' => 'Space',
        'order_receive' => 'Receive',
        'approve' => 'Approve',
        // 'brandcomm' => 'Brandcomm',
        'po' => 'PO',
        'invoice' => 'Invoice',
        'approve_manager' => 'Approve Manager',
    ),
    'timeline' => array(
        'timeline' => '',
    ),
    'tayang' => array(
        'request' => 'Request',
        'receive' => 'Receive',
    ),
    'backdate' => array(
        'backdate_request' => 'Request',
        'backdate_receive' => 'Receive',
    ),
    'report' => array(
        'report_occupancy' => 'Occupancy',
        'report_order' => 'Order',
        'report_closing' => 'Closing',
        'report_expired' => 'Expired',
        'report_unapprove' => 'Unapprove',
    ),
    'offer_position' => array(
        'offer_position' => '',
    ),
);

$config['global_menu'] = array(
    'dashboard' => "Dashboard",
    'myaccount' => "Akun Saya",
    'logout' => "Logout",
);

$config['href'] = array(
    'dashboard' => "dashboard",
    'calendar' => "calendar",
    'master' => "master_client",
    'order' => "order",
    'timeline' => "timeline",
    'tayang' => "request",
    'report' => "report_occupancy",
    'offer_position' => "offer_position",
    'myaccount' => "myaccount",
    'logout' => "login/logout",
    'client' => 'master_client',
    'agency' => 'master_agency',
    'level' => 'master_level',
    'department' => 'master_department',
    'user' => 'master_user',
    'iklan' => 'master_ads',
    'kanal' => 'master_kanal',
    'posisi' => 'master_position',
    'produkgrup' => 'master_productgroup',
    'harga' => 'master_harga',
    'production' => 'master_production',
    'categoryindustry' => 'master_industry_cat',
    'industry' => 'master_industry',
    'conflictbrand' => 'master_conflictbrand',
    'masterbrandcomm' => 'master_brandcomm',
    'cpm' => 'master_cpm',
    'paket' => 'order',
    // 'space' => 'order_space',
    'order_receive' => 'done',
    'approve' => 'approve',
    // 'brandcomm' => 'brandcomm',
    'po' => 'po',
    'invoice' => 'invoice',
    'approve_manager' => 'approve_manager',
    'request' => 'request',
    'receive' => 'receive',
    'backdate_request' => 'backdate_request',
    'backdate_receive' => 'backdate_receive',
    'report_occupancy' => 'report_occupancy',
    'report_order' => 'report_order_ae',
    'report_closing' => 'report_closing_ae',
    'report_expired' => 'report_expired_ae',
    'report_unapprove' => 'report_unapprove',
);

$config['reset_password'] = "password"; // default password saat di reset
$config['show_per_page'] = 10;    // berapa data yang ditampilkan tiap halaman
$config['time_expired'] = 5;    // set waktu berapa lama paket / space expired
$config['max_request_brandcomm'] = 2;    // maksimal brandcomm yang di request yang harus di feedback